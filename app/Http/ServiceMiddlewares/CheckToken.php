<?php
namespace App\Http\ServiceMiddlewares;

use App\Lib\EnvConfig;
use App\Lib\ServiceHelper;
use App\Lib\ServiceSelector;
use App\Lib\TokenValidator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Bean\BeanFactory;
use Swoft\Context\Context;
use Swoft\Http\Message\Request;

/**
 * @Bean()
 * Class GetService
 * @package App\Http\ServiceMiddlewares
 */
class CheckToken implements MiddlewareInterface{

    /**
     * @Inject()
     * @var EnvConfig
     */
    protected $envConfig;

    /**
     * @Inject()
     * @var ServiceHelper
     */
    protected $servicHelper;

    /**
     * @Inject()
     *
     * @var ServiceSelector
     */
    private $selector;

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /** @var $route \Swoft\Http\Server\Router\Route */
        [$status,$path,$route] = $a = $request->getAttribute(Request::ROUTER_ATTRIBUTE);
//        vdump($a);
        $method = $route->getParam("method");
        $service = $route->getParam("service");
        $tags = $request->getAttribute("tags");
        if(isset($tags["tokenvalid"]) && isset($tags["tokenvalid"][$service])
            && in_array($method,$tags["tokenvalid"][$service])
        ){ //是否需要验证
            /** @var TokenValidator $r */
            $r=BeanFactory::getBean("TokenValidator");
            try{
                return $r->checkToken(function ($param=[]) use($handler,$request){
                    $ext=$request->getAttribute('ext',[]);
                    if($param && count($param)>0) $ext[]=$param;
                    return $handler->handle($request->withAttribute("ext",$ext));
                });
            }catch (\Exception $e){
                return Context::get()->getResponse()->withData(["error"=>$e->getMessage()]);
            }

        }
        return  $handler->handle($request);
    }
}
<?php
namespace App\Http\ServiceMiddlewares;

use App\Lib\EnvConfig;
use App\Lib\MyRateLimiter;
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
use Swoft\Limiter\Exception\RateLImiterException;

/**
 * @Bean()
 * Class GetService
 * @package App\Http\ServiceMiddlewares
 */
class CheckRateLimit implements MiddlewareInterface{

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

        if(isset($tags["ratelimiter"])){//如果设置了限流函数
            /** @var MyRateLimiter $r */
            $r=BeanFactory::getBean("MyRateLimiter");
            try{
               return $r->checkRate($service,$method,function () use ($handler,$request) {
                    return $handler->handle($request);
                },$tags["ratelimiter"]);
            }catch (RateLImiterException $e){
                return Context::get()->getResponse()->withData(["error"=>$e->getMessage()]);
            }
        }

        return  $handler->handle($request);
    }
}
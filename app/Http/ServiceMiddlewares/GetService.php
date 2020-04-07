<?php
namespace App\Http\ServiceMiddlewares;

use App\Lib\EnvConfig;
use App\Lib\ServiceHelper;
use App\Lib\ServiceSelector;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Http\Message\Request;

/**
 * @Bean()
 * Class GetService
 * @package App\Http\ServiceMiddlewares
 */
class GetService implements MiddlewareInterface{

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
        $prefix=$route->getParam("prefix");
        //真正服务名称api.myreader.com.course
        $serviceName = $this->envConfig->getServicePrefix().".".$prefix;
//            var_export($serviceName);
        $serviceList=$this->servicHelper->getService($serviceName);
//            vdump($serviceList);
        $getService=$this->selector->selectByRoundRobin($serviceList);//选取服务
//            vdump($getService);
        $tags=$this->servicHelper->parseTags($getService);
//            vdump($tags);
        $host="tcp://".$getService["Address"].":".$getService["Port"];
        return $handler->handle($request
            ->withAttribute("host",$host)
            ->withAttribute("tags",$tags)
            ->withAttribute("service",$getService)
        );
    }
}
<?php
namespace App\Http;

use App\Lib\EnvConfig;
use App\Lib\MyRateLimiter;
use App\Lib\TokenValidator;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Bean\BeanFactory;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\Middlewares;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use  Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use App\Http\ServiceMiddlewares\GetService;
use App\Http\ServiceMiddlewares\CheckToken;
use App\Http\ServiceMiddlewares\CheckRateLimit;
/**
 * 网关主类
 * @package App\Http
 * @Controller()
 * @Middlewares({
 *  @Middleware(GetService::class),
 *  @Middleware(CheckToken::class),
 *  @Middleware(CheckRateLimit::class),
 *     })
 */
class main{

    /**
     * @Inject()
     * @var EnvConfig
     */
    protected $envConfig;



    /**
     * @RequestMapping("/{prefix}/{service}/{method}",method={RequestMethod::POST,RequestMethod::OPTIONS})
     */
    public function router(string $prefix,string $service,string $method,Request $request){
        $params=jsonParams();//获取请求JSON参数，返回是一个数组
        try {

            $host=$request->getAttribute("host");
            $tags=$request->getAttribute("tags");
            $ext=$request->getAttribute("ext",[]);
            vdump($ext,time());
            $target=function() use($host,$tags,$service,$method,$params,$ext){
//                vdump($ext,time());
                return  requestRPC($host, chose($tags["NAMESPACE"],$this->envConfig->getNamespace())
                    ."\\". $service, $method, $params,'1.0',$ext);
            };

            return $target();//目标调用(RPC)
        } catch (\Exception $e) {
            $result=["error"=>$e->getMessage()];
        }
        return $result;
    }

    /**
     * @RequestMapping("/test")
     */
    public function test(){
        /** @var MyRateLimiter $r */
        $r=BeanFactory::getBean("MyRateLimiter");
        return $r->checkRate("abc","bcd",function(){
            return "success";
        },[
            'name'    =>'swoft:limiter',
            'rate'    => 1,
            'max'     =>5,
            'default' => 10,
        ]);
    }
}
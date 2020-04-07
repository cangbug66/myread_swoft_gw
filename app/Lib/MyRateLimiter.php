<?php
namespace App\Lib;

use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\BeanFactory;
use Swoft\Limiter\Exception\RateLImiterException;
use Swoft\Stdlib\Helper\Arr;

/**
 * Class MyRateLimiter
 * @package App\Lib
 * @Bean(name="MyRateLimiter")
 */
class MyRateLimiter{
    public function checkRate(string $className, string $method,callable  $doFunction,array $rateConfig=[])
    {
        if(!$rateConfig || count($rateConfig)==0){
            return $doFunction();//执行正式代码
        }
        $config=[
            "key"=>"test",
            "fallback"=>function(){
                 return "fallback";
            }
        ];
        $commonConfig = [
            'name'    =>'swoft:limiter',
            'rate'    => 1,
            'max'     =>5,
            'default' => 10,
        ];
        $config   = Arr::merge($commonConfig, $config);
        $config=Arr::merge($config, $rateConfig);
//        var_dump($config);
        $fallback = $config['fallback'] ?? '';


        $rateLimter=BeanFactory::getBean("redisRateLimiter");
        $ticket = $rateLimter->getTicket($config);
//        vdump($ticket);
        if ($ticket) { //有令牌，代表可以执行
            return $doFunction();
        }
        if (!empty($fallback)) {
            return $fallback();
        }
        throw new RateLImiterException(
            sprintf('Rate(%s->%s) to Limit!', $className, $method)
        );
    }
}
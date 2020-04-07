<?php
namespace App\Lib;
use App\Exception\Handler\HttpExceptionHandler;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * Class ServiceSelector
 * @package App\consul
 * @Bean()
 */
class ServiceSelector{

    private $nodeIndex=0;
    //随机算法
    public  function selectByRandom(array $serviceList){
        $getIndex=array_rand($serviceList);  //['prod-1'=>xxx]
        return $serviceList[$getIndex];
    }
    //iphash算法
    public  function selectByIPHash(string $ip,array $serviceList){
        $getIndex=crc32($ip)%count($serviceList);
        $getKey=array_keys($serviceList)[$getIndex];
        return $serviceList[$getKey];
    }
    //轮询算
    public  function selectByRoundRobin(array $serviceList){
        if (!$serviceList) throw new \Exception("获取的consul服务列表为空");
        $getKey=array_keys($serviceList)[$this->nodeIndex];
        $this->nodeIndex=($this->nodeIndex+1) % count($serviceList);
        return $serviceList[$getKey];
    }


}
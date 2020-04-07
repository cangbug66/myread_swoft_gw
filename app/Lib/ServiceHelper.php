<?php
namespace App\Lib;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Consul\Agent;
use Swoft\Consul\Health;

/**
 * Class ServiceHelper
 * @Bean()
 */
class ServiceHelper{
    /**
     * @Inject()
     *
     * @var Agent
     */
    private $agent;
    /**
     * @Inject()
     *
     * @var Health
     */
    private $health;

    //根据服务名 获取健康服务列表
    public function  getService(string $serviceName):array{
        $services=$this->agent->services()->getResult();
//        var_export($services);
        $checks=$this->health->checks($serviceName,["filter"=>"Status==passing"])->getResult();
//        var_export($checks);
        $passingNode=[]; //[0=>'se1',1=>'s2',2=>'s3']
        foreach($checks as $check){
            $passingNode[]=$check["ServiceID"];
        }
        if(count($passingNode)==0) return [];

       return  array_intersect_key($services,array_flip($passingNode));

    }

    public function parseTags($service){
        if(!$service || !is_array($service) || !isset($service["Tags"])) return [];
        $tags=$service["Tags"];
        $ret=[];
        foreach($tags as $tag){
            //gw.NAMESPACE=App.Rpc.Lib
            if(preg_match("/^gw\.(\w+)\=(.*)/i",$tag,$matchs)){
                $ret[$matchs[1]]=str_replace(".","\\",$matchs[2]);
                continue;
            }
            //gw.ratelimiter.key=xxxx
            if(preg_match("/^gw\.(\w+)\.(\w+)\=(.*)/i",$tag,$matchs)){
                if(!isset($ret[$matchs[1]]))
                    $ret[$matchs[1]]=[];
                //$ret[$matchs[1]][$matchs[2]]=str_replace(".","\\",$matchs[3]);
                $getTagValue=str_replace(".","\\",$matchs[3]);
                if(isset($ret[$matchs[1]][$matchs[2]])){
                    if(is_array($ret[$matchs[1]][$matchs[2]])){
                        $ret[$matchs[1]][$matchs[2]][]=$getTagValue;
                    }else{
                        $old=$ret[$matchs[1]][$matchs[2]];
                        $ret[$matchs[1]][$matchs[2]]=[$old,$getTagValue];
                    }
                }else{
                    $ret[$matchs[1]][$matchs[2]]=$getTagValue;
                }

                /**
                 * ['ratelimiter'=>{"key"=>xxxx,"rate"=>xxxx]
                 */
            }

        }
        return $ret;
    }

}
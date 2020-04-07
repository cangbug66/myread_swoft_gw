<?php
namespace App\Lib;
use Firebase\JWT\JWT;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Context\Context;
use Swoft\Redis\Redis;

/**
 * Class TokenValidator
 * @package App\Lib
 * @Bean("TokenValidator")
 */
class TokenValidator{
    public function checkToken(callable  $doFunction){
        //规则暂定是 url参数  ?token=xxx
        $getToken=Context::get()->getRequest()->get("token","");
//        vdump($getToken);
        if($getToken==""){
            throw new \Exception("invalid user");
        }

        $token=(array)jwt::decode($getToken,"abcde",['HS256']);
        $userName=isset($token["username"])?$token["username"]:"";
//        vdump($userName);
        if(!$userName){
            throw new \Exception("invalid username");
        }
        $redis_key="token_".$userName;
        $redis_token = Redis::get($redis_key);
//        vdump($getToken);
//        vdump($redis_token);

        if(!$redis_token ||  $redis_token!==$getToken){
            throw new \Exception("token expired");
        }

        return $doFunction(["token"=>$token]);
    }
}
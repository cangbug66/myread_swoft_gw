<?php
namespace App\Http;

use App\Models\UsersMain;
use Firebase\JWT\JWT;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use  Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Redis\Redis;
use Swoft\Validator\Exception\ValidatorException;

/**
 * Class accessToken
 * @package App\Http
 * @Controller()
 */
class AccessToken{
    /**
     * @RequestMapping(route="/access_token",method={RequestMethod::POST,RequestMethod::OPTIONS})
     */
    public function getToken(){
        $parms=jsonParams();
        $parms= validate($parms,"tokenValidator");
        ["username"=>$username,"userpwd"=>$userpwd]=$parms;
        /** @var UsersMain $getUser */
        $getUser=UsersMain::where("user_name",$username)
                ->select("user_pass")->first();
        $access_token="";
        if($getUser && password_verify($userpwd,$getUser->getUserPass())){
            $redis_key="token_".$username;
            $getTokenFromRedis=Redis::get($redis_key);
            if($getTokenFromRedis){//redis有，直接返回
                $access_token = $getTokenFromRedis;
            }else{
                $token=[
                    "username"=>$username,
                ];
                $access_token=JWT::encode($token,"abcde","HS256");
                Redis::setex($redis_key,60*60,$access_token);
            }
            return ["access_token"=>$access_token,
                "expire_in"=>Redis::ttl($redis_key),
                'dd'=>JWT::decode($access_token,"abcde",["HS256"])];
        }else{
            throw new ValidatorException("username or password error");
        }
    }
}
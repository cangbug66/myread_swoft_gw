<?php
namespace App\Lib;

class EnvConfig{
     protected $namespace; //好比是App\\Rpc\\Lib
     protected $host;
    protected $service_prefix;
     function init(){ //初始化Bean之后 自动执行
         $this->namespace=str_replace(".","\\",$this->namespace);
         $this->namespace=str_replace("\r","",$this->namespace);
     }

    /**
     * @return mixed
     */
    public function getServicePrefix()
    {
        return $this->service_prefix;
    }



    /**
     * @return mixed
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }//这是 rpc具体地址----后面要改


}
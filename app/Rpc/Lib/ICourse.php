<?php
namespace App\Rpc\Lib;
interface ICourse {
    public function list($size);
    public function get($id);
}
<?php
const RPC_EOL = "\r\n\r\n";
function request()  {
    return Swoft\Context\Context::get()->getRequest();
}
function jsonParams()
{
    $req = request();
    try {
        $contentType = $req->getHeader('content-type');
        if (!$contentType || false === stripos($contentType[0], \Swoft\Http\Message\ContentType::JSON)) {
            return [];
        }
        $raw = $req->getBody()->getContents();
        return json_decode($raw, true);// key=>value数组
    }
    catch (Exception $exception){
        return [];
    }
}

function requestRPC($host, $class, $method, $param, $version = '1.0', $ext = []) {
    $fp = stream_socket_client($host, $errno, $errstr);
    if (!$fp) {
        throw new Exception("stream_socket_client fail errno={$errno} errstr={$errstr}");
    }

    $req = [
        "jsonrpc" => '2.0',
        "method" => sprintf("%s::%s::%s", $version, $class, $method),
        'params' => $param,
        'id' => '',
        'ext' => $ext,
    ];
    $data = json_encode($req) . RPC_EOL;
    fwrite($fp, $data);

    $result = '';
    while (!feof($fp)) {
        $tmp = stream_socket_recvfrom($fp, 1024);

        if ($pos = strpos($tmp, RPC_EOL)) {
            $result .= substr($tmp, 0, $pos);
            break;
        } else {
            $result .= $tmp;
        }
    }

    fclose($fp);
    return json_decode($result, true);
}

function chose($v1,$v2){
    if($v1) return $v1;
    return $v2;
}


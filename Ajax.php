<?php
$data = daddslashes($_POST['data']);
$api = daddslashes($_POST['api']);
if (empty($data) && empty($api)){
    nathan_json('0','请确保必填项不为空');
}
if ($api == 1){
    $url = 'http://api.nanyinet.com/api/phone/Napi.php?api=1&data='.$data;
    $resultdata = curl_request($url);
    $resultdata = json_decode($resultdata, TRUE);
    if ($resultdata['code'] == 1){
        nathan_json('1',$resultdata['msg']);
    }else{
        nathan_json('0',$resultdata['msg']);
    }
}elseif ($api == 2){
    $url = 'http://api.nanyinet.com/api/phone/Napi.php?api=2&data='.$data;
    $resultdata = curl_request($url);
    $resultdata = json_decode($resultdata, TRUE);
    if ($resultdata['code'] == 1){
        nathan_json('1',$resultdata['msg']);
    }else{
        nathan_json('0',$resultdata['msg']);
    }
}elseif ($api == 3){
    $url = 'http://api.nanyinet.com/api/phone/Napi.php?api=3&data='.$data;
    $resultdata = curl_request($url);
    $resultdata = json_decode($resultdata, TRUE);
    if ($resultdata['code'] == 1){
        nathan_json('1',$resultdata['msg']);
    }else{
        nathan_json('0',$resultdata['msg']);
    }
}elseif ($api == 4){
    $url = 'http://api.nanyinet.com/api/phone/Napi.php?api=4&data='.$data;
    $resultdata = curl_request($url);
    $resultdata = json_decode($resultdata, TRUE);
    if ($resultdata['code'] == 1){
        nathan_json('1',$resultdata['msg']);
    }else{
        nathan_json('0',$resultdata['msg']);
    }
}elseif ($api == 5){
    $url = 'http://api.nanyinet.com/api/phone/Napi.php?api=5&data='.$data;
    $resultdata = curl_request($url);
    $resultdata = json_decode($resultdata, TRUE);
    if ($resultdata['code'] == 1){
        nathan_json('1',$resultdata['msg']);
    }else{
        nathan_json('0',$resultdata['msg']);
    }
}elseif ($api == 6){
    $url = 'http://api.nanyinet.com/api/phone/Napi.php?api=6&data='.$data;
    $resultdata = curl_request($url);
    $resultdata = json_decode($resultdata, TRUE);
    if ($resultdata['code'] == 1){
        nathan_json('1',$resultdata['msg']);
    }else{
        nathan_json('0',$resultdata['msg']);
    }
}elseif ($api == 7){
    $url = 'http://api.nanyinet.com/api/phone/Napi.php?api=7&data='.$data;
    $resultdata = curl_request($url);
    $resultdata = json_decode($resultdata, TRUE);
    if ($resultdata['code'] == 1){
        nathan_json('1',$resultdata['msg']);
    }else{
        nathan_json('0',$resultdata['msg']);
    }
}

function nathan_json($code, $msg = NULL) {
    $jsonData = array(
        'code' => $code,
        'msg' => $msg
    );
    exit(json_encode($jsonData));
}

function daddslashes($string, $force = 0, $strip = FALSE) {
    !defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
    if(!MAGIC_QUOTES_GPC || $force) {
        if(is_array($string)) {
            foreach($string as $key => $val) {
                $string[$key] = daddslashes($val, $force, $strip);
            }
        } else {
            $string = addslashes($strip ? stripslashes($string) : $string);
        }
    }
    return $string;
}

function curl_request($url, $post = '', $referer = '', $cookie = '', $returnCookie = 0, $ua = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0') {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_USERAGENT, $ua);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 60);
    curl_setopt($curl, CURLOPT_REFERER, $referer);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $httpheader[] = "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8";
    $httpheader[] = "Accept-Encoding:gzip, deflate";
    $httpheader[] = "Accept-Language:zh-CN,zh;q=0.9";
    $httpheader[] = "Connection:close";
    curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    if ($post) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
    }
    if ($cookie) {
        curl_setopt($curl, CURLOPT_COOKIE, $cookie);
    }
    curl_setopt($curl, CURLOPT_HEADER, $returnCookie);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_ENCODING, "gzip");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    if (curl_errno($curl)) {
        return curl_error($curl);
    }
    curl_close($curl);
    if ($returnCookie) {
        list($header, $body) = explode("\r\n\r\n", $data, 2);
        preg_match_all("/Set\-Cookie:([^;]*);/", $header, $matches);
        $info['cookie'] = substr($matches[1][1], 1);
        $info['content'] = $body;
        return $info;
    } else {
        return $data;
    }
}
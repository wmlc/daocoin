<?php
namespace App\Http\Helpers;

class CurlHelper{

    public static function http($url, $method = 'GET', $postfields = null, $header_array = array()) {
        $ch = curl_init();
        /* Curl 设置 */
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $method = strtoupper($method);
        switch ($method) {
            case 'GET':
                $url = is_array($postfields) ? $url . '?' . http_build_query($postfields) : $url;
                break;
            case 'POST':
                curl_setopt($ch, CURLOPT_POST, true);
                if (!empty($postfields)) {
                    $postfields = is_array($postfields) ? http_build_query($postfields) : $postfields;
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
                }
                break;
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                if (!empty($postfields)) {
                    $url = "{$url}?{$postfields}";
                }
        }
        $header_array2 = array();
        if (is_array($header_array)) {
            foreach ($header_array as $k => $v)
                array_push($header_array2, $k . ': ' . $v);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header_array2);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = curl_exec($ch);
        curl_close ($ch);
        return $response;
    }
}
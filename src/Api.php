<?php


namespace Justmd5\DaTaoKe;


use Hanson\Foundation\AbstractAPI;

class Api extends AbstractAPI
{

    const URL = 'https://openapi.dataoke.com/api';
    /**
     * @var string
     */
    private $key;
    /**
     * @var string
     */
    private $secret;
    /**
     * @var string
     */
    private $version;

    public function __construct($key, $secret, $version = 'v1.1.1')
    {
        $this->key = $key;
        $this->secret = $secret;
        $this->version = $version;
    }

    private function signature($params)
    {
        ksort($params);

        $sign = '';
        foreach ($params as $k => $v) {

            $sign .= '&' . $k . '=' . $v;
        }
        $sign = trim($sign, '&');

        return strtoupper(md5($sign . '&key=' . $this->secret));
    }

    public function request($method, $params, $files = [])
    {
        $http = $this->getHttp();

        $params['appKey'] = $this->key;
        if(!isset($params['version'])){
            $params['version'] =isset( $this->version)? $this->version : 'v1.1.1';
        }
        $params['sign'] = $this->signature($params);
        $extUrl = rtrim(str_replace('.', '/', $method), '/');
        $response = call_user_func_array([$http, 'get'], [sprintf('%s/%s', self::URL, $extUrl), $params, $files]);

        return json_decode(strval($response->getBody()), true);
    }

}
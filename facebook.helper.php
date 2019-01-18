<?php
/**
 * 簡易 Facebook Graph SDK (PHP 5.2)
 * 目前只針對 graphql 的 【GET】 method 可以使用
 * 詳細說明請查看gilab wiki
 * 
 * TODO: 將剩下的 POST DELETE PUT 完成
 */

class FacebookHelper{

    private $configs;
    protected $accessToken;

    public function __construct($config) {
        $this->configs();

        if ( empty($config['app_id']) ) {
            throw new Exception("Required \"app_id\" key not supplied in config and could not find fallback environment variable");
        }

        if ( empty($config['app_secret']) ) {
            throw new Exception("Required \"app_secret\" key not supplied in config and could not find fallback environment variable");
        }

        $this->getAccessToken($config);
    }

    private function configs () {
        $this->configs = new stdClass;
        $this->configs->graphApiUrl     = 'https://graph.facebook.com';
        $this->configs->oauthUrl        = $this->configs->graphApiUrl."/oauth";
        $this->configs->graphVersion    = 'v3.2';
    }

    public function getAccessToken ($config) {
        $result = $this->curl(
            $this->configs->oauthUrl."/access_token",
            array(
                'client_id'     => $config['app_id'],
                'client_secret' => $config['app_secret'],
                'grant_type'    => 'client_credentials'
            )
        );

        if($result->error) {
            throw new Exception($result->error->message);
        }
        $this->accessToken = $result->access_token;
    }

    public function get ($endpoint, $eTag = null) {
        $eTag['access_token'] = $this->accessToken;
        return $this->sendRequest(
            'GET',
            $endpoint,
            $eTag
        );
    }

    public function post () {
        throw new Exception('Not implemented');
    }

    public function put () {
        throw new Exception('Not implemented');
    }

    public function delete () {
        throw new Exception('Not implemented');
    }

    private function sendRequest ($method, $endpoint, $eTag){
        $url = $this->configs->graphApiUrl."/".$this->configs->graphVersion.$endpoint;
        return $this->curl($url, $eTag);
    }

    private function curl ($url, $data) {
        $url .= "?".http_build_query($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result);
    }
}

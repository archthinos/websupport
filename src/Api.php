<?php 
namespace Core;

class Api {
    public function __construct($config)
    {
        $this->config = $config;
    }

    // Fetch API
    public function call($method, $api, $path, $query, $data ){
        try {
            $time = time();
            $apiKey = $this->config[0]['API_KEY'];
            $secret = $this->config[0]['SECRET'];

            $canonicalRequest = sprintf('%s %s %s', $method, $path, $time);
            
            $signature = hash_hmac('sha1', $canonicalRequest, $secret);
            $ch = curl_init();

            // set curl options
            curl_setopt($ch, CURLOPT_URL, sprintf('%s%s%s', $api, $path, $query));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, $apiKey.':'.$signature);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Date: ' . gmdate('Ymd\THis\Z', $time),
                'Content-Type: application/json',
            ]);

            // if $data are set, send POST request
            if($data){
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
            
            $response = curl_exec($ch);
            curl_close($ch);

            return $response;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
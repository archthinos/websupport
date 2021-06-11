<?php 
namespace App\Models;

use Core\Api;
use Core\Config;

class Dns {
    public function __construct()
    {
        $this->config = new Config();
    }

    public function getDns($domain,$page){
        $api = new Api($this->config->load());

        $query = "?page=".$page."&pagesize=".$this->config->get('PAGE_SIZE');
        
        $response = json_decode(
            $api->call(
                'GET',
                $this->config->get('API_URL'),
                '/v1/user/self/zone/'.$domain.'/record',
                $query ,
                false)
            ,true);

        return $response;
    }

    public function deleteDns($domain, $id){
        $query = '';
        $api = new Api($this->config->load());

        $response =  json_decode(
            $api->call(
                'DELETE',
                $this->config->get('API_URL'),
                '/v1/user/self/zone/'.$domain.'/record/'.$id,
                $query,
                false),
            true);

        return $response;        
    }

    public function storeDns($domain, $data){
        $query = '';
        $api = new Api($this->config->load());

        $response = $api->call(
            'POST',
            $this->config->get('API_URL'),
            '/v1/user/self/zone/'.$domain.'/record',
            $query,
            json_encode($data['data']));

        return json_decode($response,true);
    }
}
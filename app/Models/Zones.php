<?php 
namespace App\Models;

use Core\Api;
use Core\Config;

class Zones {

    public function getZones($page){
        $config = new Config();
        $api = new Api($config->load());

        $query = "?page=".$page."&pagesize=".$config->get('PAGE_SIZE');
        
        $response =  json_decode(
            $api->call(
                'GET',
                $config->get('API_URL'),
                '/v1/user/self/zone',
                $query,
                false),
            true);

        return $response;
    }
}
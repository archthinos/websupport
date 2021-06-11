<?php 
namespace Core;

class Config {
    public $configuration = [];

    public function __construct()
    {
        $this->config = __DIR__.'/../config.php';
    }

    public function load(){

        if(!file_exists($this->config)){
            throw new \Exception('File $config not found');
        }
        $this->configuration[] = require($this->config);
        return $this->configuration;
    }

    public function get($key){
        return $this->configuration[0][$key];
    }





}
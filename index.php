<?php
error_reporting(E_ALL);

// test if CURL extension is installed/enabled 
if(function_exists('curl_init') === false) {
    die('Curl extension not enabled.');
}

use Core\Route;

require __DIR__ . '/vendor/autoload.php';

$route = new Route();

$route->add('/','ZonesController@index');
$route->add('zones','ZonesController@index');
$route->add('dns','DnsController@index');
$route->add('dns/create','DnsController@create');
$route->add('dns/store','DnsController@store');
$route->add('dns/destroy','DnsController@destroy');

$uri = (isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/');
$url = substr($uri,1);

$route->run($url);
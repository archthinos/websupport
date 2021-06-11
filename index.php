<?php
error_reporting(E_ALL | E_STRICT);

use Core\Route;

require __DIR__ . '/vendor/autoload.php';

$route = new Route();

$route->add('/','ZonesController@index');
$route->add('zones','ZonesController@index');
$route->add('dns','DnsController@index');
$route->add('dns/create','DnsController@create');
$route->add('dns/store','DnsController@store');
$route->add('dns/destroy','DnsController@destroy');

$uri = (isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/');
$url = substr($uri,1);

$route->run($url);
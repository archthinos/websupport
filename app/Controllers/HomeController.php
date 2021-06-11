<?php 

namespace App\Controllers;

use Core\View;

class HomeController extends \Core\Controller {
    
    public function index(){
        View::render('index',['test'=>'data']);
    }
}
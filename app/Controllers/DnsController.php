<?php 

namespace App\Controllers;

use Core\View;
use App\Models\Dns;
use Core\Validator;

class DnsController extends \Core\Controller {
   
    /**
     *  Return all DNS entries
     */ 

    public function index(){
        if(isset($_REQUEST['page'])? $page= $_REQUEST['page']: $page = 1);
        $response = (new Dns())->getDns($_REQUEST['domain'],$page);
 
        View::render('partials/menu',[
            'domain' => $_REQUEST['domain'],
        ]);

        View::render('dns',[
            'dns' => $response,
            'domain' => $_REQUEST['domain'],
        ]);

        View::render('partials/paginate',[
            'response' => $response,
            'domain' => $_REQUEST['domain'],
        ]);
    }

    /**
     * Show new entry page
     */

    public function create(){

        View::render('partials/menu',[
            'domain' => $_REQUEST['domain'],
        ]);
        
        View::render('forms/'.strtolower($_REQUEST['type']),[
            'domain' => $_REQUEST['domain'],
        ]);
    }

    /**
     *  Store entry, return errors 
     */

    public function store(){
        // validate request data
        $data = (new Validator())->validate($_POST);
        
        if(!$this->hasErrors($data)){
            // call api 
            $data = (new Dns())->storeDns($_REQUEST['domain'],$data);
        }

        // generate views
        if($this->hasErrors($data)){
            View::render('partials/menu',[
                'domain' => $_REQUEST['domain'],
            ]);

            View::render('partials/error',[
                'errors' => $this->hasErrors($data),
            ]);
            View::render('forms/'.strtolower($_REQUEST['type']),[
                'domain' => $_REQUEST['domain'],
                'old' => $_REQUEST,
            ]);
        }

        // Everything ok, redirect
        header("Location: /dns/?domain=".$_REQUEST['domain']);
    }

    /**
     * Delete DNS entry
     */

    public function destroy(){
        (new Dns())->deleteDns($_REQUEST['domain'],$_REQUEST['id']);

        header("Location: /dns/?domain=".$_REQUEST['domain']);
    }

    public function hasErrors($data){
        // validation error
        if(isset($data['errors'])){
            return $data['errors'];
        }
        // API validation error
        if(isset($data['errors']['content'])){
            return $data['errors']['content'];
        }

        // API messages
        if(isset($data['message'])) {
            return $data['message'];
        }        
    } 
}
<?php 

namespace App\Controllers;

use Core\View;
use App\Models\Dns;
use Core\Validator;

class DnsController extends \Core\Controller {

    public function __construct()
    {
        View::render('partials/menu',[
            'domain' => $_REQUEST['domain'],
        ]);
    }
    
    /**
     *  Return all DNS entries
     */ 

    public function index(){

        $dns = new Dns();

        if(isset($_REQUEST['page'])? $page= $_REQUEST['page']: $page = 1);
        $response = $dns->getDns($_REQUEST['domain'],$page);
        

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
        
        View::render('forms/'.strtolower($_REQUEST['type']),[
            'domain' => $_REQUEST['domain'],
        ]);
    }

    /**
     *  Store entry, return errors 
     */

    public function store(){
        $validator = new Validator();
        $dns = new Dns();

        // validate request data
        $data = $validator->validate($_REQUEST);
        // remove empty array items
        $errors = array_filter($data['errors']);  

        // if no validation errors call API 
        if(!$errors){
            $response = $dns->storeDns($_REQUEST['domain'],$data);
            
            $errors = $response['errors']['content'];
        }

        // API errors or messages
        if($response['message']) {
            $errors[] = $response['message'];
        }

        // generate views
        if($errors){
            View::render('partials/error',[
                'errors' => $errors,
            ]);
            View::render('forms/'.strtolower($_REQUEST['type']),[
                'domain' => $_REQUEST['domain'],
                'old' => $_REQUEST,
            ]);
        }

        // Everything ok, redirect
        if($response['status']==='success'){
            header("Location: /dns/?domain=".$_REQUEST['domain']."&message=success");
        }

    }

    /**
     * Delete DNS entry
     */

    public function destroy(){
        $dns = new Dns();
        $response = $dns->deleteDns($_REQUEST['domain'],$_REQUEST['id']);

        if($response['message']){
            header("Location: /dns/?domain=".$_REQUEST['domain']."&status=error&message=".$response['message']); 
        }

        header("Location: /dns/?domain=".$_REQUEST['domain']."&status=success");
    }
}
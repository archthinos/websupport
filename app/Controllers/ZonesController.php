<?php 

namespace App\Controllers;

use App\Models\Zones;
use Core\View;

class ZonesController extends \Core\Controller {
    
    /**
     *  Show all client Zones
     */
    public function index(){
        $zones = new Zones();
        
        if(isset($_REQUEST['page'])? $page= $_REQUEST['page']: $page = 1);

        $response = $zones->getZones($page);
        
        View::render('zones',[
            'zones' => $response,
        ]);
    }
}

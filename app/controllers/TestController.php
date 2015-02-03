<?php

namespace App\Controllers;

class TestController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        echo 'TEST MODE' . '<br/>';
        
        
        echo date('Y-m-d H:i:s',strtotime('2014-04-07 11:27:51')) . '<br/>';
        echo date('Y-m-d H:i:s',strtotime('2014-04-07 11:27:52')) . '<br/>';
        
        
        
        $selisih = \DB::select("select ((HOUR(TIMEDIFF('2014-04-07 11:29:50','2014-04-07 11:28:29'))*360)+(MINUTE(TIMEDIFF('2014-04-07 11:29:50','2014-04-07 11:28:29')) *60)+ SECOND(TIMEDIFF('2014-04-07 11:29:50','2014-04-07 11:28:29'))) as selisih  from dual");
        echo $selisih[0]->selisih;
        
    }

}

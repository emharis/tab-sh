<?php

namespace App\Models;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Biaya
 *
 * @author eries
 */
class Biaya extends \Eloquent{
    
    protected $table = 'psb_biaya';
    
    public function tapel(){
        return $this->belongsTo('App\Models\Tapel');
    }
    
}

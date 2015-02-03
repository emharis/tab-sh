<?php

namespace App\Models;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transaksi
 *
 * @author eries
 */
class Transaksi extends \Eloquent{
    
    protected $table = 'tab_transaksi';
    
    public function siswa(){
        return $this->belongsTo('App\Models\Siswa');
    }
    
}

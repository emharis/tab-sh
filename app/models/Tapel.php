<?php

namespace App\Models;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tapel
 *
 * @author eries
 */
class Tapel extends \Eloquent{
    
    protected $table = 'tahunajaran';
    
    public function biayas(){
        return $this->belongsToMany('App\Models\Biaya','psb_biaya_per_tahunajaran','tahunajaran_id','psbbiaya_id')->withTimestamps()->withPivot(array('nilai'));
    }
    
    /**
     * relasi dengan siswa untuk rombelsiswa
     */
    public function siswas(){
        return $this->belongsToMany('App\Models\Siswa', 'rombelsiswa', 'tahunajaran_id', 'siswa_id')->withTimestamps()->withPivot(array('rombel_id'));
    }
    
    
}

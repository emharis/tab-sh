<?php

namespace App\Models;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Siswa
 *
 * @author eries
 */
class Siswa extends \Eloquent {

    protected $table = 'siswa';

    public function rombels() {
        return $this->belongsToMany('App\Models\Rombel', 'rombelsiswa', 'siswa_id', 'rombel_id')->withTimestamps()->withPivot(array('tahunajaran_id'));
    }

    public function saldo() {
        return $this->hasOne('App\Models\Saldo');
    }

    public function transaksi() {
        return $this->hasMany('App\Models\Transaksi');
    }
    
    /**
     * relasi dengan tapel untuk rombelsiswa
     */
    public function tapels(){
        return $this->belongsToMany('App\Models\Tapel', 'rombelsiswa', 'siswa_id', 'tahunajaran_id')->withTimestamps()->withPivot(array('rombel_id'));
    }

}

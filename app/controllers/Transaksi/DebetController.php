<?php

namespace App\Controllers\Transaksi;

class DebetController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return \View::make('transaksi.debet.index');
    }
    
    public function datasiswa(){
        $tapelAktif = \App\Models\Tapel::whereAktif('Y')->first();
        $siswas = $tapelAktif->siswas()->orderBy('nisn','desc')->get();
        return \View::make('transaksi.debet.datasiswa')->with('siswas',$siswas);
    }
    
    public function siswabynis($nis){
        $siswa = \App\Models\Siswa::whereNisn($nis)->first();
        return ( $siswa ? $siswa->toJson() : null);
    }
    
    public function saldo($siswaid){
        $saldo = \App\Models\Saldo::whereSiswaId($siswaid)->first();
        return ($saldo ? $saldo->saldo : 0);
    }
    
    public function lasttrans($siswaid){
        $trans = \App\Models\Transaksi::whereSiswaId($siswaid)->orderBy('created_at','desc')->first();
        
        return ($trans ? $trans->toJson() : null);
    }
    
    public function debet(){
        //cek saldo
        $saldo = \App\Models\Saldo::whereSiswaId(\Input::get('siswaid'))->first();
        if($saldo == null){
            $saldo = new \App\Models\Saldo();
            $saldo->siswa_id = \Input::get('siswaid');
            $saldo->saldo = 0;
            $saldo->save();
        }
        
        //input transaksi
        $trans = new \App\Models\Transaksi();
        $trans->siswa_id = \Input::get('siswaid');
        $trans->tgl = date('Y-m-d',strtotime(\Input::get('tgl')));
        $trans->jenis = 'D';
        $trans->jumlah = \Input::get('jumlah');
        $trans->save();
        
        //update saldo
        $saldo->saldo += $trans->jumlah;
        $saldo->save();
        
        return ($trans ? $trans->toJson() : null);
    }
    
    public function kredit(){
        //cek saldo
        $saldo = \App\Models\Saldo::whereSiswaId(\Input::get('siswaid'))->first();
        
        //input transaksi
        $trans = new \App\Models\Transaksi();
        $trans->siswa_id = \Input::get('siswaid');
        $trans->tgl = date('Y-m-d',strtotime(\Input::get('tgl')));
        $trans->jenis = 'K';
        $trans->jumlah = \Input::get('jumlah');
        $trans->save();
        
        //update saldo
        $saldo->saldo -= $trans->jumlah;
        $saldo->save();
        
        return ($trans ? $trans->toJson() : null);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return \View::make('transaksi.debet.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        return \View::make('transaksi.debet.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}

<?php

namespace App\Controllers\Transaksi;

class TutupController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return \View::make('transaksi.tutup.index');
    }

    public function datasiswa() {
        $tapelAktif = \App\Models\Tapel::whereAktif('Y')->first();
        $siswas = $tapelAktif->siswas()->orderBy('nisn', 'desc')->get();
        return \View::make('transaksi.tutup.datasiswa')->with('siswas', $siswas);
    }

    public function siswabynis($nis) {
        $siswa = \App\Models\Siswa::whereNisn($nis)->first();
        return ( $siswa ? $siswa->toJson() : null);
    }

    public function saldo($siswaid) {
        $saldo = \App\Models\Saldo::whereSiswaId($siswaid)->first();
        return ($saldo ? $saldo->saldo : 0);
    }

    public function lasttrans($siswaid) {
        $trans = \App\Models\Transaksi::whereSiswaId($siswaid)->orderBy('created_at', 'desc')->first();

        return ($trans ? $trans->toJson() : null);
    }

    public function detilsiswa($id) {
        $siswa = \App\Models\Siswa::find($id);
        return \View::make('transaksi.tutup.siswa')->with('siswa', $siswa);
    }

    public function tutup() {
        //cek saldo
        $saldo = \App\Models\Saldo::whereSiswaId(\Input::get('siswaid'))->first();
        if ($saldo != null) {
            //tutup buku
            $trans = new \App\Models\Transaksi();
            $trans->siswa_id = \Input::get('siswaid');
            $trans->tgl = date('Y-m-d', strtotime(\Input::get('tgl')));
            $trans->jenis = 'K';
            $trans->jumlah = $saldo->saldo;
            $trans->tutup = 'Y';
            $trans->save();

            //update saldo
            $saldo->saldo = 0;
            $saldo->save();
        }

        return ($trans ? $trans->toJson() : null);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return \View::make('transaksi.tutup.create');
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
        return \View::make('transaksi.tutup.edit');
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

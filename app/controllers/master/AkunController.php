<?php

namespace App\Controllers\Master;

class AkunController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $rombels = \App\Models\Rombel::orderBy('jenjang')->get();
        $selectRombel[0] = 'Semua Rombel';
        foreach ($rombels as $dt) {
            $selectRombel[$dt->id] = $dt->nama;
        }
        return \View::make('master.akun.index')->with('selectRombel', $selectRombel);
    }

    /**
     * Menampilkan data akun siswa
     */
    public function listakun($rombelId) {
        $tapelAktif = \App\Models\Tapel::whereAktif('Y')->first();
        if ($rombelId == 0) {
            //tampilkan semua siswa
            $siswas = $tapelAktif->siswas;
        } else {
            $rombel = \App\Models\Rombel::find($rombelId);
            $siswas = $rombel->siswas()->where('tahunajaran_id', '=', $tapelAktif->id)->get();
        }

        return \View::make('master.akun.listakun')->with('siswas', $siswas)->with('isall', ($rombelId == 0 ? true : false));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return \View::make('master.akun.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $akun = new Akun();
        $akun->nama = \Input::get('nama');
        $akun->save();

        return \Redirect::route('master.akun.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $siswa = \App\Models\Siswa::find($id);
        $tapelAktif = \App\Models\Tapel::where('aktif','Y')->first();
        return \View::make('master.akun.show')->with('siswa', $siswa)->with('tapelAktif',$tapelAktif);
    }

    public function histori($siswaid) {
        $siswa = \App\Models\Siswa::find($siswaid);
        return \View::make('master.akun.histori')->with('siswa', $siswa);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        return \View::make('master.akun.edit')->with('akun', akun::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $akun = Akun::find($id);
        $akun->nama = \Input::get('nama');
        $akun->save();

        return \Redirect::route('master.akun.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        
    }

    public function delete() {
        //get data transaksi
        $id = \Input::get('id');
        $trans = \App\Models\Transaksi::find($id);
        $siswaid = \Input::get('siswaid');
        $siswa = \App\Models\Siswa::find($siswaid);

        //hapus transaksi
        $trans->delete();
        //update saldo
        $saldo = \App\Models\Saldo::whereSiswaId($trans->siswa->id)->first();
        $dbt = $siswa->transaksi()->where('jenis', 'D')->sum('jumlah');
        $kdt = $siswa->transaksi()->where('jenis', 'K')->sum('jumlah');
        $saldo->saldo = $dbt - $kdt;
        $saldo->save();

        return \Redirect::route('master.akun.index');
    }

    public function getsaldo($siswaid) {
        $saldo = \App\Models\Saldo::whereSiswaId($siswaid)->first();
        return $saldo->saldo;
    }

}

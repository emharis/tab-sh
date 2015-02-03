<?php

namespace App\Controllers\Rekap;

class RekapController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return \View::make('rekap.rekap.index')->with('transaksi', \App\Models\Transaksi::orderBy('created_at', 'desc')->get());
    }

    public function gettransaksi($awal, $akhir) {
        $transaksi = \App\Models\Transaksi::where('tgl', '>=', date('Y-m-d', strtotime($awal)))->where('tgl', '<=', date('Y-m-d', strtotime($akhir)))->get();

        if (count($transaksi) > 0) {
            return \View::make('rekap.rekap.datatransaksi')->with('transaksi', $transaksi);
        } else {
            return null;
        }
    }

    public function topdf($awal, $akhir) {
        $pdf = new \fpdf\Pdfetab();
        //set periode
        $pdf->setAwal($awal);
        $pdf->setAkhir($akhir);

        $pdf->SetAutoPageBreak(true, 10);
        $pdf->AddPage();

        //get data transaksi
        $transaksi = \App\Models\Transaksi::with('siswa')->where('tgl', '>=', date('Y-m-d', strtotime($awal)))->where('tgl', '<=', date('Y-m-d', strtotime($akhir)))->get();

        //generate table 
        //table header
        $colNo = 10;
        $colNis = 10;
        $colNama = 45;
        $colRombel = 45;
        $colTgl = 20;
        $colDebet = 30;
        $colKredit = 30;
        $stdFontSize = 10;

//        $pdf->SetFont('Courier', 'B', 12);
//        
//        $pdf->Cell($colNo, 8, 'NO', 1, 0, 'C');
//        $pdf->Cell($colNis, 8, 'NIS', 1, 0, 'C');
//        $pdf->Cell($colNama, 8, 'NAMA', 1, 0, 'C');
//        $pdf->Cell($colRombel, 8, 'ROMBEL', 1, 0, 'C');
//        $pdf->Cell($colTgl, 8, 'TGL', 1, 0, 'C');
//        $pdf->Cell($colDebet, 8, 'DEBET', 1, 0, 'C');
//        $pdf->Cell($colKredit, 8, 'KREDIT', 1, 1, 'C');
        ///generate data transaksi
        $rownum = 1;
        $pdf->SetFont('Courier', null, 10);
        $totDebet=0;
        $totKredit=0;

        foreach ($transaksi as $dt) {
            //initial
            $stdFontSize = 10;
            $pdf->SetFont('Courier', null, $stdFontSize);

            $pdf->Cell($colNo, 5, $rownum++, 1, 0, 'R');
            $pdf->Cell($colNis, 5, $dt->siswa->nisn, 1, 0, 'L');

            //looping nama untuk menentukan size font untuk menyesuaikan dengan lebar kolom
            $nama = $dt->siswa->nama;
            while ($pdf->GetStringWidth($nama) >= ($colNama - 1)) {
                $pdf->SetFont('Courier', null, $stdFontSize--);
            }
            $pdf->Cell($colNama, 5, $nama, 1, 0, 'L');

            //reinitial
            $stdFontSize = 10;
            $pdf->SetFont('Courier', null, $stdFontSize);
            $rombel = $dt->siswa->rombels()->orderBy('created_at', 'desc')->first()->nama;
            while ($pdf->GetStringWidth($rombel) >= ($colRombel - 1)) {
                $pdf->SetFont('Courier', null, $stdFontSize--);
            }
            $pdf->Cell($colRombel, 5, $rombel, 1, 0, 'L');

            //reinitial
            $stdFontSize = 10;
            $pdf->SetFont('Courier', null, $stdFontSize);
            $tgl = date('d-m-Y', strtotime($dt->tgl));
            while ($pdf->GetStringWidth($tgl) >= ($colTgl - 1)) {
                $pdf->SetFont('Courier', null, $stdFontSize--);
            }
            $pdf->Cell($colTgl, 5, $tgl, 1, 0, 'L');

            //reinitial
            $stdFontSize = 10;
            $pdf->SetFont('Courier', null, $stdFontSize);
            $pdf->Cell($colDebet, 5, ($dt->jenis == 'D' ? number_format($dt->jumlah, 0, ',', '.') : '-'), 1, 0, 'R');
            $pdf->Cell($colKredit, 5, ($dt->jenis == 'K' ? number_format($dt->jumlah, 0, ',', '.') : '-'), 1, 1, 'R');
            
            //kalkulasi total debet kredit
            if($dt->jenis == 'D'){
                $totDebet += $dt->jumlah;
            }else{
                $totKredit += $dt->jumlah;
            }
        }

        //show total
        $pdf->SetFont('Courier', 'B', 10);
        $pdf->Cell(0, 0.2, '', 1, 1);
        $pdf->Cell($colNo+$colNis+$colNama+$colRombel+$colTgl, 5, 'SUB TOTAL', 1, 0, 'R');
        $pdf->Cell($colDebet, 5, number_format($totDebet, 0, ',', '.') , 1, 0, 'R');
        $pdf->Cell($colKredit, 5, number_format($totKredit, 0, ',', '.'), 1, 1, 'R');
        
        //show grand total
        $pdf->Cell(0, 0.2, '', 1, 1);
        $pdf->Cell($colNo+$colNis+$colNama+$colRombel+$colTgl, 5, 'TOTAL', 1, 0, 'R');
        $pdf->Cell($colDebet+$colKredit, 5, number_format($totDebet-$totKredit, 0, ',', '.') , 1, 1, 'R');
        
        //show total saldo
        $saldo = \App\Models\Saldo::sum('saldo');
        $pdf->ln(5);
        $pdf->Cell($colNo+$colNis+$colNama, 5, 'TOTAL SALDO KEUANGAN TABUNGAN', 1, 1, 'L');
        $pdf->Cell($colNo+$colNis+$colNama, 5, 'Rp. ' . number_format($saldo, 0, ',', '.') , 1, 0, 'R');

        $pdf->Output('RekapTabungan' .  date('dmY_His') .'.pdf', 'D');
        //$pdf->Output('RekapTabungan' .  date('dmY_His') .'.pdf','I');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
//        return \View::make('master.rekap.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
//        $rekap = new Rekap();
//        $rekap->nama = \Input::get('nama');
//        $rekap->save();
//
//        return \Redirect::route('master.rekap.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
//        $siswa = \App\Models\Siswa::find($id);
//        return \View::make('master.rekap.show')->with('siswa',$siswa);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
//        return \View::make('master.rekap.edit')->with('rekap', rekap::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
//        $rekap = Rekap::find($id);
//        $rekap->nama = \Input::get('nama');
//        $rekap->save();
//
//        return \Redirect::route('master.rekap.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
//        Rekap::whereId($id)->delete();
//        return \Redirect::route('master.rekap.index');
    }

}

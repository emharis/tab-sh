<?php

namespace App\Controllers;

class MytoolsController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        echo '----------------------------------------------------------------------------------<br/>';
        echo '-------------------WELCOM TO WEB DEV TOOLS--------------------------<br/>';
        echo '----------------------------------------------------------------------------------<br/>';
        echo '<style type="text/css">'
        . 'table tbody tr td{'
        . 'border:thin solid whitesmoke;'
        . '}'
        . '</style>';
        echo '<table>'
        . '<tbody>'
        . '<tr>'
        . '<td>1</td>'
        . '<td>Normalize Saldo</td>'
        . '<td><a class="btn btn-success" href="' . \URL::to("mytools/normalizesaldo") . '" >do it now!!</a></td>'
        . '</tr>'
        . '</tbody>'
        . '</table>';
    }

    public function normalizesaldo() {
        echo 'Enter normalize process...</br>';
        echo 'Process it now...</br>';
        echo 'Congratz, Process has done..<br/>';

        //process normalisasi
        $siswa = \App\Models\Siswa::all();
        $dotProc = ".";
        foreach ($siswa as $sw) {
            echo $dotProc;

            $saldo = \App\Models\Saldo::whereSiswaId($sw->id)->first();
            if ($saldo) {
                $dbt = $sw->transaksi()->where('jenis', 'D')->sum('jumlah');
                $kdt = $sw->transaksi()->where('jenis', 'K')->sum('jumlah');
                $saldo->saldo = $dbt - $kdt;
                $saldo->save();
            }
            $dotProc .= ".";
        }

        echo '<a href="' . \URL::route('mytools.index') . '" >go back to main menu..</a>';
    }

}

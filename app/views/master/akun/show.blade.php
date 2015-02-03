@extends('_layouts.default')

@section('main')

<div class="span4">      	
    <div class="widget ">
        <div class="widget-header">
            <i class="icon-user"></i>
            <h3>Akun Siswa</h3>
        </div> <!-- /widget-header -->
        <div class="widget-content">
            <table class="table">
                <tbody>
                    <tr>
                        <td>NIS</td>
                        <td>:</td>
                        <td>{{ $siswa->nisn }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $siswa->nama }}</td>
                    </tr>
                    <tr>
                        <td>Rombel</td>
                        <td>:</td>
                        <td>
                            {{ $siswa->rombels()->where('tahunajaran_id',$tapelAktif->id)->first()->nama }}
                        </td>
                    </tr>
                    <tr style="background-color: #F0E5DF;color: orangered;">
                        <td><h4>Total Saldo<h4/></td>
                        <td>:</td>
                        <td style="text-align: right;"><h4 id="label-total-saldo">Rp. {{ number_format(($siswa->saldo ? $siswa->saldo->saldo : 0),0,',','.') }}<h4/></td>
                    </tr>
                </tbody>
            </table>
        </div> <!-- /widget-content -->

    </div> <!-- /widget -->

</div> <!-- /span8 -->

<div class="span8">      	
    <div class="widget ">
        <div class="widget-header">
            <i class="icon-list-alt"></i>
            <h3>Histori Transaksi</h3>
        </div> <!-- /widget-header -->
        <div class="widget-content ">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Debet</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                        <th class="td-actions"></th>
                    </tr>
                </thead>
                <tbody class="table-histori">
                    <?php $rownum = 1; ?>
                    <?php $saldo = 0; ?>
                    @foreach($siswa->transaksi as $dt)
                    <tr id="row_{{ $dt->id }}">
                        <td>{{ $rownum++ }}</td>
                        <td>{{ date('d-m-Y',strtotime($dt->tgl))   }}</td>
                        <td style="text-align: right;">
                            @if($dt->jenis == 'D')
                            {{ number_format($dt->jumlah,0,',','.') }}
                            <!--tambah jumlah saldo-->
                            <?php $saldo = $saldo + $dt->jumlah; ?>
                            @else
                            -
                            @endif
                        </td>
                        <td style="text-align: right;">
                            @if($dt->jenis == 'K')
                            {{ number_format($dt->jumlah,0,',','.') }}
                            <!--kurangi jumlah saldo-->
                            <?php $saldo = $saldo - $dt->jumlah; ?>
                            @else
                            -
                            @endif
                        </td>
                        <td style="text-align: right;">
                            {{ number_format($saldo,0,',','.') }}
                        </td>
                        <td>
                            @if($rownum-1 == count($siswa->transaksi))
                            <a class="btn btn-mini btn-danger btn-delete-akun" transaksiid="{{ $dt->id }}" siswaid ="{{ $siswa->id }}" >Delete</a>
                            @endif
                            <!--<a class="btn btn-mini btn-danger btn-delete-akun" transaksiid="{{ $dt->id }}" siswaid ="{{ $siswa->id }}" >Delete</a>-->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> <!-- /widget-content -->

    </div> <!-- /widget -->

</div> <!-- /span8 -->
<div id="hasil"></div>
@stop

@section('custom-script')
<script type="text/javascript">
    jQuery(document).ready(function() {
        /**
         * Delete transaksi akun
         */
        jQuery(document).on('click','.btn-delete-akun',function() {


            if (confirm('Anda akan menghapus data ini?')) {
                var postUrl = "{{ URL::to('master/akun/delete') }}";
                var transId = jQuery(this).attr('transaksiid');
                var siswaid = jQuery(this).attr('siswaid');

//                var totalSaldo = jQuery('#label-total-saldo').text();
//                totalSaldo = unformatRupiahVal(totalSaldo);

                jQuery.post(postUrl, {
                    id: transId,
                    siswaid:siswaid
                }, function(data) {
                    alert('Data transaksi akun telah dihapus.');
                    //remove row
                    jQuery('#row_' + transId).fadeOut(500);
                    //reload table histori
                    var historiUrl = "{{ URL::to('master/akun/histori') }}" + "/" + siswaid;
                    jQuery('.table-histori').html('<tr><td colspan="7"><div class="loader"></div></td></tr>').load(historiUrl);
                    //update total saldo
                        //get saldo sekarang
                        var getSaldoUrl = "{{ URL::to('master/akun/getsaldo') }}" + "/" + siswaid;
                        jQuery.get(getSaldoUrl,function(data){
                            var saldo = data;
                            //set to display
                            jQuery('#label-total-saldo').text(formatRupiahVal(saldo));
                        });
                }).fail(function() {
                    alert('Data transaksi GAGAL dihapus.');
                });
            }
        });
    });
</script>
@stop
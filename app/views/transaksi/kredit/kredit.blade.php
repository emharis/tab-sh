@extends('_layouts.default')

@section('main')
<div class="span6">      
    <div class="widget ">
        <div class="widget-header"> <i class="icon-list-alt"></i>
            <h3> HISTORI TRANSAKSI</h3>
        </div>
        <!-- /widget-header -->
        <div class="widget-content">
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Debet</th>
                        <th>Kredit</th>
                        <th>Saldo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $rownum = 1; ?>
                    <?php $sld = 0; ?>
                    @foreach($siswa->transaksi as $dtt)
                    <tr>
                        <td>{{ $rownum++ }}</td>
                        <td>{{ date('d-m-Y',strtotime($dtt->tgl)) }}</td>
                        <td class="uang">
                            @if($dtt->jenis == 'D')
                            {{ number_format($dtt->jumlah,0,',','.') }}
                            <?php $sld+=$dtt->jumlah; ?>
                            @else
                            -
                            @endif
                        </td>
                        <td class="uang">
                            @if($dtt->jenis == 'K')
                            {{ number_format($dtt->jumlah,0,',','.') }}
                            <?php $sld-=$dtt->jumlah; ?>
                            @else
                            -
                            @endif
                        </td>
                        <td class="uang">
                            {{ number_format($sld,0,',','.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="alert alert-info" style="text-align: right;font-size: x-large;" >
                TOTAL SALDO : Rp. {{ number_format(($siswa->saldo ? $siswa->saldo->saldo : 0),0,',','.') }}
            </div>
        </div>
        <!-- /widget-content --> 
    </div>

</div> <!-- /span8 -->

<div class="span6 prc-form">   

    <div class="widget">
        <div class="widget-header"> <i class="icon-user"></i>
            <h3> DATA SISWA</h3>
        </div>
        <!-- /widget-header -->
        <div class="widget-content">
            <table class="table">
                <tbody>
                    <tr>
                        <td>NIS</td>
                        <td>:</td>
                        <td>{{ $siswa->nisn }}</td>
                        <td></td>
                        <td>ROMBEL</td>
                        <td>:</td>
                        <td>{{ $siswa->rombels()->orderBy('created_at','desc')->first()->nama }}</td>
                    </tr>
                    <tr>
                        <td>NAMA</td>
                        <td>:</td>
                        <td>{{ $siswa->nama }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            
            <a class="btn btn-info pull-right" href="{{ URL::route('master.akun.show',$siswa->id) }}">DETIL AKUN >></a>
        </div>
        <!-- /widget-content --> 
    </div>
    <!--    <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-money"></i>
                <h3> SALDO</h3>
            </div>
             /widget-header 
            <div class="widget-content">
                <ul class="news-items">
                    <li>
    
                        <div style="text-align: center!important;"> 
                            <h2 class="label-saldo">Rp. 0</h2>
                        </div>
    
    
                    </li>
                </ul>
            </div>
             /widget-content  
        </div>-->

    <div class="widget widget-nopad">
        <div class="widget-header"> <i class="icon-upload-alt"></i>
            <h3>KREDIT</h3>
        </div>
        <!-- /widget-header -->
        <div class="widget-content ">
            <div class="form-horizontal">
                {{ Form::open(array('method' => 'post', 'route' => array('transaksi.kredit.store'),'class'=>'form-horizontal alert alert-danger')) }}
                <fieldset>
                    <div class="control-group">											
                        <label class="control-label">Input nominal</label>
                        <div class="controls">
                            {{ Form::hidden('siswaid',$siswa->id) }}
                            {{ Form::text('tgl',date('d-m-Y'),array('class'=>'input-small datepicker','id'=>'debet-tgl-text','required','autocomplete'=>'off','placeholder'=>'Tanggal')) }}
                            {{ Form::text('jumlah',null,array('class'=>'input-medium uang','id'=>'debet-text','required','autocomplete'=>'off','placeholder'=>'Nominal')) }}
                            {{ Form::submit('SIMPAN',array('class'=>'btn btn-success btn-simpan-kredits')) }}
                        </div> <!-- /controls -->				
                    </div> <!-- /control-group -->
                </fieldset>
                {{ Form::close() }}
            </div>


        </div>
        <!-- /widget-content --> 
    </div>
</div> <!-- /span8 -->
@stop

@section('custom-script')
<script type="text/javascript">
    jQuery(document).ready(function() {
        var berhasil = "{{ (isset($berhasil) ? $berhasil : 'false') }}";
        var error = "{{ (isset($errors) ? $errors->first() : '') }}";

//       function showAlertBerhasil(){
//           if(berhasil == 'true'){
//               alert('Data telah disimpan');
//           }
//       }
//       showAlertBerhasil();
//       
//       function showError(){
//           if(error != ''){
//               alert(error);
//           }
//       }
//       showError();

        function showAlert() {
            if (error != '') {
                alert(error);
            } else {
                if (berhasil == 'true') {
                    alert('Data telah disimpan');
                }
            }
        }
        ;
        showAlert();

    });
</script>
@stop
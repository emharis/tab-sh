@extends('_layouts.default')

@section('main')

<div class="span12">      		

    <div class="widget ">

        <div class="widget-header">
            <i class="icon-th-list"></i>
            <h3>Rekap Transaksi</h3>
            <div class="pull-right" style="padding-right: 10px;">
                <a class="btn btn-info btn-pdf">PDF</a>
            </div>
        </div> <!-- /widget-header -->

        <div class="widget-content">
            <div class="alert alert-info" >

                <table class="table table-form">
                    <tbody>
                        <tr>
                            <td>Tentukan rentang waktu </td>
                            <td>
                                <?php echo Form::text('awal', null, array('class' => 'input-medium datepicker', 'placeholder' => 'Tanggal Awal')); ?>
                            </td>
                            <td>-</td>
                            <td>
                                <?php echo Form::text('akhir', null, array('class' => 'input-medium datepicker', 'placeholder' => 'Tanggal Akhir')); ?>
                            </td>
                            <td>
                                <a class="btn btn-success btn-tampil">Tampilkan</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div id="list-data-transaksi">

            </div>
        </div> <!-- /widget-content -->

    </div> <!-- /widget -->

</div> <!-- /span8 -->

@stop

@section('custom-script')
<script type="text/javascript">
    jQuery(document).ready(function() {
        //hide tombol PDF
        jQuery('.btn-pdf').css('visibility', 'hidden');

        function clearResultTable() {
            jQuery('.btn-pdf').css('visibility', 'hidden');
            jQuery('#list-data-transaksi table').fadeOut(500, function() {
                jQuery(this).remove();
            });
        }

        jQuery('input[name=awal],input[name=akhir]').blur(function() {
            clearResultTable();
        });

        jQuery('.btn-tampil').click(function() {
            var awal = jQuery('input[name=awal]').attr('value');
            var akhir = jQuery('input[name=akhir]').attr('value');
            var getDataTransksiUrl = "{{ URL::to('rekap/rekap/gettransaksi') }}" + "/" + awal + "/" + akhir;
            clearResultTable();
            if (awal == '' || akhir == '') {
                alert('Lengkapi data yang kosong.');
            } else {
                jQuery.get(getDataTransksiUrl, function(data) {
                    jQuery('#list-data-transaksi table').remove();
                    if (data) {
                        jQuery('#list-data-transaksi').html('<div class="loader" ></div>').load(getDataTransksiUrl);
                        jQuery('.btn-pdf').css('visibility', 'visible');
                    } else {
                        alert('Tidak ada data yang ditemukan');
                    }

                }).fail(function(data) {
                    alert('Pengumpulan data gagal.');
                });
            }

        });

        /**
         * conver to pdf
         */
        jQuery('.btn-pdf').click(function() {
            var awal = jQuery('input[name=awal]').attr('value');
            var akhir = jQuery('input[name=akhir]').attr('value');
            var getConvertUrl = "{{ URL::to('rekap/rekap/topdf') }}" + "/" + awal + "/" + akhir;
            window.location.href = getConvertUrl;
        });
    });
</script>
@stop
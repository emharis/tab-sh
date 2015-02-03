@extends('_layouts.default')

@section('main')

<div class="span12">      		

    <div class="widget ">

        <div class="widget-header">
            <i class="icon-th-list"></i>
            <h3>Akun Siswa</h3>
        </div> <!-- /widget-header -->

        <div class="widget-content">
            <div id="div-option">
                <div class="span5 alert alert-info ">
                    <table class="table table-form">
                        <tbody>
                            <tr>
                                <td>Rombel</td>
                                <td><?php echo Form::select('rombel', $selectRombel, null, array('class' => 'input-large')); ?></td>
                                <td><a class="btn btn-info" id="btn-tampilkan-siswa">Tampilkan</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div> <!-- /widget-content -->

    </div> <!-- /widget -->

</div> <!-- /span8 -->

<div class="span12">      		

    <div class="widget ">

        <div class="widget-header">
            <i class="icon-th-list"></i>
            <h3>Daftar Akun</h3>
        </div> <!-- /widget-header -->

        <div class="widget-content" id="list-akun">
            
        </div>
    </div>
</div>

@stop

@section('custom-script')
<script type="text/javascript">
    jQuery(document).ready(function() {

        /**
         * Tampilkan Data Siswa
         * Setelah tombol tampilkan di klik
         */
        jQuery('#btn-tampilkan-siswa').click(function() {
            var rombelId = jQuery('select[name=rombel]').attr('value');
            var getUrl = "{{ URL::to('master/akun/listakun') }}" + "/" + rombelId;
            jQuery('#list-akun').html('<div class="loader"></div>').load(getUrl);
        });

    });
</script>
@stop
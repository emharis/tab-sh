@extends('_layouts.default')

@section('main')

<div class="span12">      		

    <div class="widget ">

        <div class="widget-header">
            <i class="icon-th-list"></i>
            <h3>Tutup Buku</h3>
            <div class="pull-right" style="padding-right: 10px;">

            </div>
        </div> <!-- /widget-header -->

        <div class="widget-content">
            <div class="alert alert-info" >
                <table class="table table-form">
                    <tbody>
                        <tr>
                            <td>NIS</td>
                            <td>                               
                                <div class="input-append">
                                    <?php echo Form::text('nis', null, array('class' => 'input-small')); ?>
                                    <a class="btn btn-search-nis" ><i class="icon-search"></i></a>
                                </div>
                                </div>	<!-- /controls -->			
                            </td>
                            <td>Nama Siswa</td>
                            <td><?php echo Form::text('namasiswa', null, array('class' => 'input-xlarge')); ?></td>
                            <td><a class="btn btn-success btn-show">Show</a></td>
                            <td><?php echo Form::text('idsiswa', null, array('class' => 'input-mini')); ?></td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <div>

            </div>
        </div> <!-- /widget-content -->

    </div> <!-- /widget -->

</div> <!-- /span8 -->

<div class="span4 prc-form">      		

    <div class="widget widget-nopad">
        <div class="widget-header"> <i class="icon-money"></i>
            <h3> SALDO</h3>
        </div>
        <!-- /widget-header -->
        <div class="widget-content">
            <ul class="news-items">
                <li>

                    <div style="text-align: center!important;"> 
                        <h2 class="label-saldo">Rp. 0</h2>
                    </div>


                </li>
            </ul>
        </div>
        <!-- /widget-content --> 
    </div>

    <div class="widget widget-nopad">
        <div class="widget-header"> <i class="icon-list-alt"></i>
            <h3> TRANSAKSI TERAKHIR</h3>
        </div>
        <!-- /widget-header -->
        <div class="widget-content">
            <ul class="news-items">
                <li>

                    <div class="news-item-date"> <span class="news-item-day" id="last-trans-day" ></span> <span class="news-item-month" id="last-trans-month">Feb</span> </div>
                    <div class="news-item-detail"> <a class="news-item-title" target="_blank" id="last-trans-jenis"></a>
                        <p class="news-item-preview" id="last-trans-jumlah"></p>
                    </div>

                </li>
            </ul>
        </div>
        <!-- /widget-content --> 
    </div>

</div> <!-- /span8 -->

<div class="span6 prc-form">      		

    <div class="widget widget-table action-table">
        <div class="widget-header"> <i class="icon-download-alt"></i>
            <h3>TUTUP BUKU</h3>
        </div>
        <!-- /widget-header -->
        <div class="widget-content" id="data-detil-siswa">
        </div>
        <!-- /widget-content --> 
    </div>
</div> <!-- /span8 -->

<div class="span2 prc-form">
    <div class="widget widget-nopad">
        <div class="widget-header"> <i class="icon-th-large"></i>
            <h3> OPTION</h3>
        </div>
        <!-- /widget-header -->
        <div class="widget-content">
            <ul class="news-items">
                <div class="shortcuts" id="shortcut-btn"  > 
                    <!--<a href="javascript:;" onclick="location.reload()" class="shortcut" style="width: 50%!important;background-color: #CD3F3F;"><i class="shortcut-icon icon-off" style="color: white;"></i><span class="shortcut-label" style="color:white;">Tutup</span> </a>-->
                    <br/>
                    <!-- /shortcuts --> 
            </ul>
        </div>
        <!-- /widget-content --> 
    </div>
</div>
<!-- Modal -->
<div id="modal-list-siswa" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close modal-supplier-close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Data Siswa</h3>
    </div>
    <div class="modal-body" id="table-data-siswa">

    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <!--<button class="btn btn-primary" id="btn-save-supplier" >Save</button>-->
    </div>
</div>

<div id="hasil">

</div>

@stop

@section('custom-script')
<script type="text/javascript">
    jQuery(document).ready(function() {
        var siswaid;
        var nis;
        var nama;
        var saldo;
        var lastTrans;

        //hide prc-form
        jQuery('.prc-form').css('visibility', 'hidden');
        jQuery('.prc-form').hide();

        //hide text-id-siswa
        jQuery('input[name=idsiswa]').css('visibility', 'hidden');

        /**
         * Search siswa by nis
         */
        jQuery('.btn-search-nis').click(function() {
            siswaid = jQuery('input[name=idsiswa]').attr('value');
            nis = jQuery('input[name=nis]').attr('value');
            nama = jQuery('input[name=namasiswa]').attr('value');

            //sembunyikan form prc
            clearPrcForm();

            if (nis != '') {
                //jika pencarian siswa melalui NIS
                //get data siswa
                //tampilkan transaksi terakhir
                jQuery.ajaxSetup({cache: false});
                jQuery.ajax({url: "{{ URL::to('transaksi/tutup/siswabynis') }}" + "/" + nis, dataType: "json", async: false,
                    success: function(data) {
                        //tampilkan data transaksi terakhir ke form
                        if (data != null) {
                            //tampilkan data siswa ke form
                            jQuery('input[name=namasiswa]').attr('value', data.nama);
                            jQuery('input[name=idsiswa]').attr('value', data.id);
                            //set to global variable
                            siswaid = jQuery('input[name=idsiswa]').attr('value');
                            nis = jQuery('input[name=nis]').attr('value');
                            nama = jQuery('input[name=namasiswa]').attr('value');
                        } else {
                            alert('Data Siswa tidak ditemukan.');
                        }
                    }}
                );
            } else {
                alert('Lengkapi data yang kosong.');
            }
        });

        /**
         * Menampilkan Data Akun Siswa
         */
        jQuery('.btn-show').click(function() {

            if (nis != '' && nama != '') {
                //tampilkan saldo siswa
                showSaldo();

                //tampilkan transaksi terakhir
                showLastTrans();

                //tampilkan detil siswa
                var getDetilsiswUrl = "{{ URL::to('transaksi/tutup/detilsiswa') }}" + "/" + siswaid;
                jQuery('#data-detil-siswa').load(getDetilsiswUrl, null, function(data) {
                    //jika saldo 0 disable fungsi tutup buku
                    if (saldo == 0) {
                        jQuery('.btn-tutup').hide();
                    }
                });

                //set btn detil akun
//                jQuery('#btn-detil-akun').removeAttr('href');
//                jQuery('#btn-detil-akun').attr('href', "{{ URL::to('master/akun') }}" + "/" + siswaid);
                var url = "{{ URL::to('master/akun') }}" + "/" + siswaid;
                jQuery('#shortcut-btn').html('<a href="javascript:;" onclick="location.reload()" class="shortcut" style="width: 50%!important;background-color: #CD3F3F;"><i class="shortcut-icon icon-off" style="color: white;"></i><span class="shortcut-label" style="color:white;">Tutup</span> </a><a href="' + url + '" id="btn-akun-detil" class="shortcut" style="width: 50%!important;background-color: #7DB115;"><i class="shortcut-icon icon-list-alt" style="color: white;"></i><span class="shortcut-label" style="color:white;">Detil Akun</span> </a>');


                jQuery('.prc-form').css('visibility', 'visible');
                jQuery('.prc-form').fadeIn(500);
            } else {
                //tampilkan pesan harus di isi dahulu
                alert('Lengkapi data yang kosong.');
            }

        });

        function showSaldo() {
            jQuery.get("{{ URL::to('transaksi/tutup/saldo') }}" + "/" + siswaid, function(data) {
                saldo = data;
                jQuery('.label-saldo').text(numberToRupiah(data));
            });
        }

        /**
         * Menampilkan data transaksi terakhir
         */
        function showLastTrans() {
            jQuery.ajaxSetup({cache: false});
            jQuery.ajax({url: "{{ URL::to('transaksi/tutup/lasttrans') }}" + "/" + siswaid, dataType: "json", async: false,
                success: function(data) {
                    //tampilkan data transaksi terakhir ke form
                    if (data != null) {
                        lastTrans = data;
                        jQuery('#last-trans-day').text(data.tgl.substr(8, 2));
                        var bulan = data.created_at.substr(5, 2);
                        var bulanText = '';
                        if (bulan == '1' || bulan == '01') {
                            bulanText = 'Jan';
                        } else if (bulan == '2' || bulan == '02') {
                            bulanText = 'Feb';
                        } else if (bulan == '3' || bulan == '03') {
                            bulanText = 'Mar';
                        } else if (bulan == '4' || bulan == '04') {
                            bulanText = 'Apr';
                        } else if (bulan == '5' || bulan == '05') {
                            bulanText = 'Mei';
                        } else if (bulan == '6' || bulan == '06') {
                            bulanText = 'Jun';
                        } else if (bulan == '7' || bulan == '07') {
                            bulanText = 'Jul';
                        } else if (bulan == '8' || bulan == '08') {
                            bulanText = 'Ags';
                        } else if (bulan == '9' || bulan == '09') {
                            bulanText = 'Sep';
                        } else if (bulan == '10' || bulan == '10') {
                            bulanText = 'Okt';
                        } else if (bulan == '11' || bulan == '11') {
                            bulanText = 'Nov';
                        } else if (bulan == '12' || bulan == '12') {
                            bulanText = 'Des';
                        }
                        jQuery('#last-trans-month').text(bulanText);
                        
                        if (data.tutup == 'Y') {
                            jQuery('#last-trans-jenis').text('TUTUP BUKU');
                        } else {
                            jQuery('#last-trans-jenis').text((data.jenis == 'D' ? 'Debet' : 'Kredit'));
                        }

                        jQuery('#last-trans-jumlah').text(numberToRupiah(data.jumlah));
                    } else {

                    }
                }}
            );
        }

        //menampilkan form search data siswa
        jQuery(document).on('focus', 'input[name=namasiswa]', function() {
            //fill data siswa ke tabel data siswa
            var getListsiswaUrl = "{{ URL::to('transaksi/tutup/datasiswa') }}";
            jQuery('#table-data-siswa').html('<div class="loader"></div>').load(getListsiswaUrl);
            jQuery('#modal-list-siswa').modal('show');
        });

        //set data siswa terpilih dari form search siswa
        jQuery(document).on('click', '.btn-pilih', function() {
            //sembunyikan form prc
            clearPrcForm();

            siswaid = jQuery(this).attr('siswaid');
            nis = jQuery(this).attr('nisn');
            nama = jQuery(this).attr('nama');
            //set data ke form
            jQuery('input[name=nis]').attr('value', nis);
            jQuery('input[name=namasiswa]').attr('value', nama);
            jQuery('input[name=idsiswa]').attr('value', siswaid);

        });

        function clearPrcForm() {
            jQuery('input[name=namasiswa]').removeAttr('value');
            jQuery('input[name=idsiswa]').removeAttr('value');
            jQuery('.prc-form').hide();
        }


        /**
         * TUTUP BUKU
         */
        jQuery(document).on('click', '.btn-tutup', function() {

            if (confirm('Anda akan melakukan proses TUTUP BUKU untuk data akun ini?')) {
                var tutupUrl = "{{ URL::to('transaksi/tutup/tutup') }}";

                jQuery.post(tutupUrl, {
                    siswaid: siswaid
                }, function() {
                    alert('Tutup buku telah berhasil dilakukan.');
                    //update saldo
                    showSaldo();
                    showLastTrans();
                }).fail(function(data) {
                    alert('Tutup buku GAGAL dilakukan.');
                    alert(data);
                });
            }
        });

    });
</script>
@stop
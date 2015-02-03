@extends('_layouts.default')

@section('main')

<div class="span12">      		

    <div class="widget ">

        <div class="widget-header">
            <i class="icon-th-list"></i>
            <h3>Calon Siswa</h3>
            <div class="pull-right" style="padding-right: 10px;">

            </div>
        </div> <!-- /widget-header -->

        <div class="widget-content">
            <div class="alert alert-info" >
                Tahun Pelajaran &nbsp;<?php echo Form::select('tapel', $selectTapel, null, array('class' => 'input-medium')); ?>
                <a class="btn btn-success">Tampilkan</a>
            </div>

            <div>
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tempat,Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Asal Sekolah</th>
                            <th class="td-actions"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Afia Najah</td>
                            <td>Surabaya, 15 Februari 2009</td>
                            <td><span class="btn-mini btn-warning">Perempuan</span></td>
                            <td>TK Al Badar Surabaya</td>
                            <td>
                                <a href="{{ URL::route('master.calonsiswa.edit',1) }}" class="btn btn-icon-only btn-info"><i class=" icon-edit"></i> </a>
                                <a href="#" class="btn btn-icon-only btn-warning"><i class=" icon-trash"></i> </a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Syamsul Ma'arif</td>
                            <td>Sidoarjo, 01 Januari 2009</td>
                            <td><span class="btn-mini btn-success">Laki-laki</span></td>
                            <td>TK Al Rahman Sidoarjo</td>
                            <td>
                                <a href="#" class="btn btn-icon-only btn-info"><i class=" icon-edit"></i> </a>
                                <a href="#" class="btn btn-icon-only btn-warning"><i class=" icon-trash"></i> </a>
                            </td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>Devina Pramawati</td>
                            <td>Surabaya, 15 Februari 2009</td>
                            <td><span class="btn-mini btn-warning">Perempuan</span></td>
                            <td>TK Al Badar Surabaya</td>
                            <td>
                                <a href="#" class="btn btn-icon-only btn-info"><i class=" icon-edit"></i> </a>
                                <a href="#" class="btn btn-icon-only btn-warning"><i class=" icon-trash"></i> </a>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Ali Nur Ramadhan</td>
                            <td>Sidoarjo, 01 Januari 2009</td>
                            <td><span class="btn-mini btn-success">Laki-laki</span></td>
                            <td>TK Al Rahman Sidoarjo</td>
                            <td>
                                <a href="#" class="btn btn-icon-only btn-info"><i class=" icon-edit"></i> </a>
                                <a href="#" class="btn btn-icon-only btn-warning"><i class=" icon-trash"></i> </a>
                            </td>
                        </tr>

                        <tr>
                            <td>5</td>
                            <td>Alifiah Annafisa</td>
                            <td>Surabaya, 15 Februari 2009</td>
                            <td><span class="btn-mini btn-warning">Perempuan</span></td>
                            <td>TK Al Badar Surabaya</td>
                            <td>
                                <a href="#" class="btn btn-icon-only btn-info"><i class=" icon-edit"></i> </a>
                                <a href="#" class="btn btn-icon-only btn-warning"><i class=" icon-trash"></i> </a>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Aulia Fitri Rachmania</td>
                            <td>Surabaya, 15 Februari 2009</td>
                            <td><span class="btn-mini btn-warning">Perempuan</span></td>
                            <td>TK Al Badar Surabaya</td>
                            <td>
                                <a href="#" class="btn btn-icon-only btn-info"><i class=" icon-edit"></i> </a>
                                <a href="#" class="btn btn-icon-only btn-warning"><i class=" icon-trash"></i> </a>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Dliyaul Haqqia</td>
                            <td>Sidoarjo, 01 Januari 2009</td>
                            <td><span class="btn-mini btn-success">Laki-laki</span></td>
                            <td>TK Al Rahman Sidoarjo</td>
                            <td>
                                <a href="#" class="btn btn-icon-only btn-info"><i class=" icon-edit"></i> </a>
                                <a href="#" class="btn btn-icon-only btn-warning"><i class=" icon-trash"></i> </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> <!-- /widget-content -->

    </div> <!-- /widget -->

</div> <!-- /span8 -->

@stop
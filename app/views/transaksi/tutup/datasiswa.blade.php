<table class="table table-bordered table-condensed datatable">
    <thead>
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Rombel</th>
            <th class="td-actions"></th>
        </tr>
    </thead>
    <tbody>
        <?php $rownum = 1; ?>
        @foreach($siswas as $dt)
        <tr>
            <td>{{ $rownum++ }}</td>
            <td>{{ $dt->nisn }}</td>
            <td>{{ $dt->nama }}</td>
            <td>{{ $dt->rombels()->orderBy('created_at','desc')->first()->nama }}</td>
            <td><a class="btn btn-mini btn-info btn-pilih" data-dismiss="modal" siswaid="{{ $dt->id }}" nisn="{{$dt->nisn}}" nama="{{ $dt->nama }}" >Pilih</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

<script type="text/javascript">
    jQuery(document).ready(function(){
       jQuery('.datatable').dataTable();
    });
    
</script>
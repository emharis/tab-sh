<table class="table table-bordered datatable">
    <thead>
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            @if($isall)
            <th>Rombel</th>
            @endif
            <th>Saldo (Rp)</th>
            <th class="td-actions"></th>
        </tr>
    </thead>
    <tbody>
        <?php $rownum=1; ?>
        @foreach($siswas as $dt)
        <tr>
            <td>{{ $rownum++ }}</td>
            <td>{{ $dt->nisn }}</td>
            <td>{{ $dt->nama }}</td>
            @if($isall)
            <td>
                {{$dt->rombels()->where('rombel_id',$dt->pivot->rombel_id)->first()->nama}}
            </td>
            @endif
            <td style="text-align: right;">{{ ($dt->saldo ? number_format($dt->saldo->saldo,0,',','.') : 0) }}</td>
            <td>
                <a class="btn btn-mini btn-success" href="{{ URL::route('master.akun.show',$dt->id) }}">Detil</a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

<script type="text/javascript">
    jQuery(document).ready(function(){
       jQuery('.datatable').dataTable();
    });
    
</script>
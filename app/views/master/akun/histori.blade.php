
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

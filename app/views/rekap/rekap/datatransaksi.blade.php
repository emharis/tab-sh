<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Rombel</th>
            <th>Tanggal</th>
            <th>Debet</th>
            <th>Kredit</th>
            <th class="td-actions"></th>
        </tr>
    </thead>
    <tbody>
        <?php $rownum = 1; ?>
        <?php $debet = 0; ?>
        <?php $kredit = 0; ?>
        @foreach($transaksi as $dt)
        <tr>
            <td>{{ $rownum++ }}</td>
            <td>{{ $dt->siswa->nisn }}</td>
            <td>{{ $dt->siswa->nama }}</td>
            <td>{{ $dt->siswa->rombels()->orderBy('created_at','desc')->first()->nama }}</td>
            <td>{{ date('d-m-Y',strtotime($dt->tgl)) }}</td>
            <td style="text-align: right;">
                @if($dt->jenis == 'D')
                {{ number_format($dt->jumlah,0,',','.') }}
                <?php $debet = $debet + $dt->jumlah; ?>
                @else
                -
                @endif
            </td>
            <td style="text-align: right;">
                @if($dt->jenis == 'K')
                {{ number_format($dt->jumlah,0,',','.') }}
                <?php $kredit = $kredit + $dt->jumlah; ?>
                @else
                -
                @endif
            </td>
            <td></td>
        </tr>
        @endforeach
        <!--TOTAL KOLOM-->
        <tr>
            <td colspan="5">TOTAL</td>
            <td style="text-align: right;">{{ number_format($debet,0,',','.') }}</td>
            <td style="text-align: right;">{{ number_format($kredit,0,',','.') }}</td>
            <td></td>
        </tr>
        <!--TOTAL SALDO-->
        <tr style="background-color: whitesmoke;">
            <td colspan="5" style="font-size: larger;">S A L D O</td>
            <td colspan="2" style="font-size: larger;text-align: right;">{{ number_format($debet-$kredit,0,',','.') }}</td>
            <td></td>
        </tr>
    </tbody>
</table>
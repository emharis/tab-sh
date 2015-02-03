Anda akan melakukan proses Tutup Buku untuk akun dibawah ini, klik tutup buku untuk melanjutkan!
<br/>
<br/>
<table class="table ">
    <tbody>
        <tr>
            <td>NIS</td>
            <td>:</td>
            <td id="label-nis">{{ $siswa->nisn }}</td>
        </tr>
        <tr>
            <td>NAMA</td>
            <td>:</td>
            <td id="label-nama">{{ $siswa->nama }}</td>
        </tr>
        <tr>
            <td>ROMBEL</td>
            <td>:</td>
            <td id="label-nama">{{ $siswa->rombels()->orderBy('created_at','desc')->first()->nama }}</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: center;">
                <a class="btn btn-warning btn-tutup" style="width:50%;">TUTUP BUKU</a>
            </td>
        </tr>
    </tbody>
</table>
<table>
    <tr>
        <th>Tanggal</th>
        <th>{{ $iDate }} - {{ $eDate }}</th>
    </tr>
</table>
<table>

</table>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Pelaporan</th>
            <th>Jenis Pelanggaran</th>
            <th>Nama Terlapor</th>
            <th>Lokasi Kejadian</th>
            <th>Uraian</th>
            <th>Tanggal Perkiraan Kejadian</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($complaint as $c)
            <tr>
                <td>{{ $c->rownum }}</td>
                <td>{{ $c->setDateFormat($c->CREATED_AT) }}</td>
                <td>{{ $c->violation->NAMA }}</td>
                <td>{{ $c->NAMA_TERLAPOR }}</td>
                <td>{{ $c->LOKASI }}</td>
                <td>{{ $c->URAIAN }}</td>
                <td>{{ $c->setDateFormat($c->TANGGAL) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

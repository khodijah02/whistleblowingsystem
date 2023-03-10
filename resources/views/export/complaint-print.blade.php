<html>

<head>
	<title></title>
	<style type="text/css">
		body {
			font-size: 10pt;
			font-family: "helvetica", Courier, monospace;
		}

		.line-title {
			border: 0;
			border-style: inset;
			border-top: 2px solid #000;
		}

		.table {
			border-collapse: collapse;
			width: 100%;
		}

		.table td, .table th {
			border: 1px solid #ddd;
			padding: 8px;
		}

		.table tr:nth-child(even){background-color: #f2f2f2;}

		.table th {
			padding-top: 12px;
			padding-bottom: 12px;
			text-align: center;
		}
	</style>
</head>

<body style="padding: 10px" onload="window.print()">
	<table width="100%">
		<tr>
			<td width="15%"><img style="width: 100px; align-items: center;" src="{{ asset('assets/images/logo/logo-rsud.png') }}"></td>
			<td width="80%" style="text-align: left;">
				<span style="font-weight: bold;">
					DETAIL PENGADUAN WHISLEBLOWINGSYSTEM
					<br>RUMAH SAKIT UMUM DAERAH KOTA BOGOR
				</span>
				<br>
				<span>Jl. DR. Sumeru No.120, RT.03/RW.20, Menteng, Kec. Bogor Bar., Kota Bogor, Jawa Barat 16112</span>
			</td>
		</tr>
	</table>
	<br>
	<hr class="line-title">
    <table class="table" width="100%">
        <thead>
            <tr>
                <th colspan="2">Data Pengaduan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="30%">Tanggal Pengaduan</td>
                <td width="70%">{{ $complaint->CREATED_AT }}</td>
            </tr>
            <tr>
                <td>Kode Pengaduan</td>
                <td>{{ $complaint->KODE_PENGADUAN }}</td>
            </tr>
            <tr>
                <td>Jenis Pelanggaran</td>
                <td>{{ $complaint->violation->NAMA }}</td>
            </tr>
            <tr>
                <td>Nama Terlapor</td>
                <td>{{ $complaint->NAMA_TERLAPOR }}</td>
            </tr>
            <tr>
                <td>Tanggal Perkiraan Kejadian</td>
                <td>{{ $complaint->TANGGAL }}</td>
            </tr>
            <tr>
                <td>Lokasi Kejadian</td>
                <td>{{ $complaint->LOKASI }}</td>
            </tr>
            <tr>
                <td>Uraian Kejadian</td>
                <td>{{ $complaint->URAIAN }}</td>
            </tr>
        </tbody>
    </table>
    <table class="table">
        <thead>
            <tr>
                <th colspan="2">Data Pelapor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="30%">Nama Pelapor</td>
                <td width="70%">{{ $complaint->NAMA_PELAPOR }}</td>
            </tr>
            <tr>
                <td>Provinsi</td>
                <td>{{ $complaint->province->NAMA }}</td>
            </tr>
            <tr>
                <td>Kabupaten</td>
                <td>{{ $complaint->regency->NAMA }}</td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>{{ $complaint->district->NAMA }}</td>
            </tr>
            <tr>
                <td>Kelurahan</td>
                <td>{{ $complaint->village->NAMA }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>{{ $complaint->ALAMAT }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>

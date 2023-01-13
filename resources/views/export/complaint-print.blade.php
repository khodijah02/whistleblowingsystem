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
			background-color: #877dff;
			color: white;
		}
	</style>
</head>

<body style="padding: 10px">
	<table width="100%">
		<tr>
			<td width="15%"><img style="width: 100px; align-items: center;" src="<?= base_url('assets/dist/img/lambang_kota_sukabumi.png') ?>"></td>
			<td width="80%" style="text-align: left;">
				<span style="font-weight: bold;">
					DRAFT PERTANYAAN <?= $title ?>
					<br>DINAS KESEHATAN KOTA SUKABUMI
				</span>
				<br>
				<span>Jl. Surya Kencana No.41, Selabatu, Kec. Cikole, Kota Sukabumi, Jawa Barat 43114</span>
			</td>
		</tr>
	</table>
	<br>
	<hr class="line-title">
	<?php foreach ($kategori as $k) { ?>
		<table class="table">
			<thead>
				<tr>
					<th colspan="3"><?= $k->category_code ?>. <?= $k->category_name ?></th>
				</tr>
			</thead>
			<tbody>
				<?php $pertanyaan = $this->CI->pertanyaan($k->id) ?>
				<?php foreach ($pertanyaan as $p) { ?>
				<tr>
					<td width="100%"><?= $p->question_name ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	<?php } ?>
</body>

</html>

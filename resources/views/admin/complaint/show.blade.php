@extends('layouts.admin.master')

@section('title', 'Complaint Detail')

@section('breadcrumb-title')
<h3>Complaint Detail</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href=""> Complaint Detail</i></a></li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
        <div class="col-12">
			<div class="card" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <div class="card-header">
                    <div class="btn-group">
                        <a href="{{ route('admin.complaint.download', $id) }}" target="_blank" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Download Bukti" download><i class="fa fa-download"></i></a>
                        <a href="{{ route('admin.complaint.print', $id) }}" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Laporan" target="_blank"><i class="fa fa-print"></i></a>
                        @if ($complaint->STATUS == 1)
                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Tindak Lanjut" id="proceed_complaint" data-id="{{ $id }}" data-status="2"><i class="fa fa-check"></i></button>
                        @else
                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Proses Laporan" id="swal_dummy_message"><i class="fa fa-pencil"></i></button>
                        @endif

                    </div>
                </div>
				<div class="card-body">
                    <div class="row">
                        <div class="table-rensponsive">
                            <table class="table">
                                <tr>
                                    <th colspan="2"><h5>Data Pengaduan</h5></th>
                                </tr>
                                <tr>
                                    <th>Tanggal Pengaduan</th>
                                    <td>{{ $complaint->CREATED_AT }}</td>
                                </tr>
                                <tr>
                                    <th>Kode Pengaduan</th>
                                    <td>{{ $complaint->KODE_PENGADUAN }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Pelanggaran</th>
                                    <td>{{ $complaint->violation->NAMA }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Terlapor</th>
                                    <td>{{ $complaint->NAMA_TERLAPOR }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Perkiraan Kejadian</th>
                                    <td>{{ $complaint->TANGGAL }}</td>
                                </tr>
                                <tr>
                                    <th>Lokasi Kejadian</th>
                                    <td>{{ $complaint->LOKASI }}</td>
                                </tr>
                                <tr>
                                    <th>Uraian Kejadian</th>
                                    <td>{{ $complaint->URAIAN }}</td>
                                </tr>
                                <tr>
                                    <th colspan="2"><h5>Data Pelapor</h5></th>
                                </tr>
                                <tr>
                                    <th>Nama Pelapor</th>
                                    <td>{{ $complaint->NAMA_PELAPOR }}</td>
                                </tr>
                                <tr>
                                    <th>Provinsi</th>
                                    <td>{{ $complaint->province->NAMA }}</td>
                                </tr>
                                <tr>
                                    <th>Kabupaten</th>
                                    <td>{{ $complaint->regency->NAMA }}</td>
                                </tr>
                                <tr>
                                    <th>Kecamatan</th>
                                    <td>{{ $complaint->district->NAMA }}</td>
                                </tr>
                                <tr>
                                    <th>Kelurahan</th>
                                    <td>{{ $complaint->village->NAMA }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $complaint->ALAMAT }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('after-css')
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
@endpush

@push('after-script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#proceed_complaint').on('click', function () {
                Swal.fire({
                    title: 'Proses?',
                    text: "Laporan Akan Dipindahkan Ke Tindak Lanjut",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $('#proceed_complaint').attr('data-id');
                        var status = $('#proceed_complaint').attr('data-status');

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            type: "post",
                            url: "{{ route('admin.complaint.update') }}",
                            data: {
                                id:id,
                                status:status
                            },
                            dataType: "json",
                            success: function (response) {
                                if (response.code == 200) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Sukses',
                                        text: 'Silhkan Cek Menu Tindak Lanjut',
                                    }).then((result) => {
                                        window.location.href = "{{ route('admin.complaint.followup') }}"
                                    });
                                }
                            },
                            error: function (response) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Ada Kesalahan, Silahkan Hubungi SIMRS',
                                    allowOutsideClick: false,
                                    allowEscapeKey: false,
                                }).then((result) => {
                                    location.reload()
                                });
                            }
                        });
                    }
                })
            });

            $('#swal_dummy_message').on('click', function () {
                Swal.fire({
                    title: 'Proses?',
                    text: "Laporan Akan Diproses",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: 'Silhkan Proses Laporan',
                        });
                    }
                })
            });
        });
    </script>
@endpush


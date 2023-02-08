@extends('layouts.admin.master')

@section('title', 'Dashboard')

@section('breadcrumb-title')
<h3>Dashboard</h3>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
        <div class="col-12">
			<div class="card" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <div class="card-header">
                    <h5>Complaint Table</h5>
                </div>
				<div class="card-body">
                    <div class="table-responsive">
                        <table class="display" id="complaint-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pengaduan</th>
                                    <th>Nama Terlapor</th>
                                    <th>Jenis Pelanggaran</th>
                                    <th>Tanggal Pelaporan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('before-style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
@endpush

@push('after-script')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#complaint-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
                beforeSend: function (response) {
                    response.setRequestHeader('Authorization', localStorage.getItem('token'));
                },
            },
            columns: [
                { data: 'rownum', name: 'rownum' },
                { data: 'KODE_PENGADUAN', name: 'KODE_PENGADUAN' },
                { data: 'NAMA_TERLAPOR', name: 'NAMA_TERLAPOR' },
                { data: 'violation', name: 'violation' },
                { data: 'date', name: 'date' },
                { data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });
        $(document).on('click', '.proceed_complaint', function () {
            Swal.fire({
                title: 'Proses?',
                text: 'Laporan Akan Diproses',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).attr('data-id');
                    var status = $(this).attr('data-status');

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
                        beforeSend: function (response) {
                            $('#proceed_complaint').attr('disabled', 'disabled');
                        },
                        success: function (response) {
                            if (response.code == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Sukses!',
                                    text: 'Silahkan Proses Laporan di Menu Tindak Lanjut',
                                }).then((result) => {
                                    location.reload()
                                });
                            }
                            $('#proceed_complaint').removeAttr('disabled', 'disabled');
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
    });
</script>
@endpush


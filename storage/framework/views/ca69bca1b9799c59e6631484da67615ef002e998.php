<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Dashboard</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="row">
        <div class="col-12">
			<div class="card" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <div class="card-header">
                    <h5>Incoming Complaint</h5>
                </div>
				<div class="card-body">
                    <div class="row">
                        <div class="col-xl-4">
                            <select name="status_filter" id="status_filter" class="form-select">
                                <option value="">-- Pilih Status Laporan --</option>
                                <option value="1">Laporan Masuk</option>
                                <option value="2">Laporan Diproses</option>
                                <option value="3">Laporan Diterima</option>
                                <option value="4">Laporan Ditolak</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="display" id="complaint_table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pengaduan</th>
                                    <th>Nama Terlapor</th>
                                    <th>Jenis Pelanggaran</th>
                                    <th>Tanggal Pelaporan</th>
                                    <th>Status</th>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('before-style'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vendors/datatables.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('after-script'); ?>
<script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#complaint-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ordering: true,
            ajax: {
                url: '<?php echo url()->current(); ?>',
            },
            columns: [
                { data: 'rownum', name: 'rownum' },
                { data: 'KODE_PENGADUAN', name: 'KODE_PENGADUAN' },
                { data: 'NAMA_TERLAPOR', name: 'NAMA_TERLAPOR' },
                { data: 'violation', name: 'violation' },
                { data: 'date', name: 'date' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });

        // $('#status_filter').on('change', function () {
        //     $('#complaint_table').on('preXhr.dt', function (e, settings, data) {
        //         data.status = $('#status_filter').val();
        //     });
        // });
    });
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\wbs\resources\views/admin/complaint/index-incoming.blade.php ENDPATH**/ ?>
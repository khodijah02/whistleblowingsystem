<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('breadcrumb-title'); ?>
<h3>Complaint Detail</h3>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb-items'); ?>
<li class="breadcrumb-item"><a href=""> Complaint Detail</i></a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="row">
        <div class="col-12">
			<div class="card" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5></h5>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-status">
                            Tutup Laporan
                        </button>
                    </div>
                </div>
				<div class="card-body">
                    <div class="row">
                        <div class="table-rensponsive">
                            <table class="table">
                                <tr>
                                    <th>Tanggal Pelaporan</th>
                                    <td><?php echo e($complaint->CREATED_AT); ?></td>
                                </tr>
                                <tr>
                                    <th>Kode Pelaporan</th>
                                    <td><?php echo e($complaint->KODE_PENGADUAN); ?></td>
                                </tr>
                                <tr>
                                    <th>Jenis Pelnggaran</th>
                                    <td><?php echo e($complaint->violation->NAMA); ?></td>
                                </tr>
                                <tr>
                                    <th>Nama Terlapor</th>
                                    <td><?php echo e($complaint->NAMA_TERLAPOR); ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Perkiraan Kejadian</th>
                                    <td><?php echo e($complaint->TANGGAL); ?></td>
                                </tr>
                                <tr>
                                    <th>Lokasi Kejadian</th>
                                    <td><?php echo e($complaint->LOKASI); ?></td>
                                </tr>
                                <tr>
                                    <th>Uraian Kejadian</th>
                                    <td><?php echo e($complaint->URAIAN); ?></td>
                                </tr>
                                <tr>
                                    <th>Lampiran Bukti</th>
                                    <td><a href="<?php echo e(asset('storage/'.$complaint->FILE)); ?>" target="_blank" class="btn btn-primary" download><i class="fa fa-download" aria-hidden="true"></i> Download</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-title" aria-hidden="true" id="modal-status">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title">Tutup Laporan</h4>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul id="error"></ul>
                    <form class="theme-form" id="form-close-complaint">
                        <div class="form-group mt-4">
                            <label for="degree">Keterangan Laporan</label>
                            <select class="form-select input-air-primary" name="degree" id="degree">
                                <option value="">-- Pilih Keterangan --</option>
                                <option value="2">Laporan Diterima</option>
                                <option value="3">Laporan Ditolak</option>
                            </select>
                        </div>
                        <div class="form-group mt-4">
                            <label for="degree">Catatan</label>
                            <select class="form-select input-air-primary" name="degree" id="degree">
                                <option value="">-- Pilih Catatan --</option>
                                <option value="2">Lampiran Bukti Kurang</option>
                                <option value="3">Lampiran Bukti Tidak Sesuai</option>
                                <option value="3">Karyawan Bersangkutan Akan Di Sanksi</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <button class="btn btn-primary btn-block" type="submit" id="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/font-awesome.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('after-script'); ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#submit').on('click', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Error',
                    text: 'Fungsi Tutup Laporan Belum Tersedia',
                    icon: 'error',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                }).then((result) => {
                    location.reload()
                })
            });
        });
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wbs\resources\views/admin/complaint/show.blade.php ENDPATH**/ ?>
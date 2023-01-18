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
                        <div class="btn-group">
                            <a href="<?php echo e(asset('storage/'.$complaint->FILE)); ?>" target="_blank" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Download Bukti" download><i class="fa fa-download"></i></a>
                            <a href="<?php echo e(route('admin.complaint.print', $complaint->ID)); ?>" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Laporan" target="_blank"><i class="fa fa-print"></i></a>
                            <?php if($complaint->STATUS == 1): ?>
                            <button class="btn btn-outline-primary" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Proses Laporan" id="proceed_complaint" data-id="<?php echo e($complaint->ID); ?>" data-status="2"><i class="fa fa-check"></i></button>
                            <?php elseif($complaint->STATUS == 2): ?>
                            <button class="btn btn-outline-primary" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Batalkan Laporan" id="proceed_complaint" data-id="<?php echo e($complaint->ID); ?>" data-status="1"><i class="fa fa-times"></i></button>
                            <?php endif; ?>
                        </div>
                        <div>
                            <span class="fw-bold">Status Laporan : </span>
                            <?php if($complaint->STATUS == 1): ?>
                            <span class="badge rounded-pill badge-warning">Laporan Masuk</span>
                            <?php elseif($complaint->STATUS == 2): ?>
                            <span class="badge rounded-pill badge-primary">Laporan Diproses</span>
                            <?php elseif($complaint->STATUS == 3): ?>
                            <span class="badge rounded-pill badge-success">Laporan Diterima</span>
                            <?php elseif($complaint->STATUS == 4): ?>
                            <span class="badge rounded-pill badge-danger">Laporan Ditolak</span>
                            <?php endif; ?>
                        </div>
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
                                    <td><?php echo e($complaint->CREATED_AT); ?></td>
                                </tr>
                                <tr>
                                    <th>Kode Pengaduan</th>
                                    <td><?php echo e($complaint->KODE_PENGADUAN); ?></td>
                                </tr>
                                <tr>
                                    <th>Jenis Pelanggaran</th>
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
                                    <th colspan="2"><h5>Data Pelapor</h5></th>
                                </tr>
                                <tr>
                                    <th>Nama Pelapor</th>
                                    <td><?php echo e($complaint->NAMA_PELAPOR); ?></td>
                                </tr>
                                <tr>
                                    <th>Provinsi</th>
                                    <td><?php echo e($complaint->province->NAMA); ?></td>
                                </tr>
                                <tr>
                                    <th>Kabupaten</th>
                                    <td><?php echo e($complaint->regency->NAMA); ?></td>
                                </tr>
                                <tr>
                                    <th>Kecamatan</th>
                                    <td><?php echo e($complaint->district->NAMA); ?></td>
                                </tr>
                                <tr>
                                    <th>Kelurahan</th>
                                    <td><?php echo e($complaint->village->NAMA); ?></td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td><?php echo e($complaint->ALAMAT); ?></td>
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


<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\wbs\resources\views/admin/complaint/show.blade.php ENDPATH**/ ?>
<table>
    <tr>
        <th>Tanggal</th>
        <th><?php echo e($iDate); ?> - <?php echo e($eDate); ?></th>
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
        <?php $__currentLoopData = $complaint; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($c->rownum); ?></td>
                <td><?php echo e($c->setDateFormat($c->CREATED_AT)); ?></td>
                <td><?php echo e($c->violation->NAMA); ?></td>
                <td><?php echo e($c->NAMA_TERLAPOR); ?></td>
                <td><?php echo e($c->LOKASI); ?></td>
                <td><?php echo e($c->URAIAN); ?></td>
                <td><?php echo e($c->setDateFormat($c->TANGGAL)); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH C:\xampp\htdocs\wbs\resources\views/export/complaint.blade.php ENDPATH**/ ?>
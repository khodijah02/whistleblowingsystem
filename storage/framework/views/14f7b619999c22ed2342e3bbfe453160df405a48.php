<?php $__env->startSection('content'); ?>
<div class="container-fluid p-0">
   <div class="row m-0">
      <div class="col-12 p-0">
         <div class="login-card">
            <div>
                <div>
                   <a class="logo" href="">
                        <img class="img-fluid for-light" src="https://via.placeholder.com/305x60.png?text=RSUD+Kota+Bogor" alt="logorsud">
                    </a>
                    
                </div>
                <div class="login-main">
                    <form class="theme-form" action="<?php echo e(route('login')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <h4>Masukan Akun</h4>
                        <?php if(session('status')): ?>
                            <div class="text-success">
                                <?php echo e(session('status')); ?>

                            </div>
                        <?php endif; ?>
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger mt-3">
                                <ul style="margin: 0;">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($e); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label class="col-form-label">Username</label>
                            <input class="form-control" type="text" name="username" >
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Password</label>
                            <input class="form-control" type="password" name="password" >
                        </div>
                        <div class="form-group mb-0 mt-4">
                            <button class="btn btn-primary btn-block" type="submit">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.authentication.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\wbs\resources\views/auth/login.blade.php ENDPATH**/ ?>
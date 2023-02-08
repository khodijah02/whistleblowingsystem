<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="icon" href="<?php echo e(asset('assets/images/logo/')); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo e(asset('assets/images/logo/logo-rsud.png')); ?>" type="image/x-icon">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <?php echo $__env->yieldPushContent('before-style'); ?>
    <?php echo $__env->make('layouts.admin.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldPushContent('after-style'); ?>
  </head>
  <body>
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <div class="page-header">
            <div class="header-wrapper row m-0">
                <div class="header-logo-wrapper col-auto p-0">
                    <div class="logo-wrapper"><a href=""><img class="img-fluid" src="<?php echo e(asset('assets/images/logo/logo.png')); ?>" alt=""></a></div>
                    <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
                </div>
                <div class="left-header col horizontal-wrapper ps-0">
                    <ul class="horizontal-menu">
                        <li class="mega-menu outside">
                            <a class="nav-link" href=""><i data-feather="layers"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="nav-right col-8 pull-right right-header p-0">
                    <ul class="nav-menus">
                        <li><div class="mode"><i class="fa fa-moon-o"></i></div></li>
                        <li class="maximize"><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
                        <li class="profile-nav onhover-dropdown p-0 me-0 float-right">
                            <div class="media profile-media">
                            <img class="b-r-10" src="https://ui-avatars.com/api/?name=Admin" alt="" style="width: 35px">
                            <div class="media-body">
                                <span>Admin</span>
                                <p class="mb-0 font-roboto">Admin<i class="middle fa fa-angle-down"></i></p>
                            </div>
                            </div>
                            <ul class="profile-dropdown onhover-show-div">
                                <li>
                                    <form action="<?php echo e(route('logout')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" style="all: unset; cursor: pointer;"><i data-feather="log-out"> </i><span>Keluar</span></button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <script class="result-template" type="text/x-handlebars-template">
                    <div class="ProfileCard u-cf">
                        <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
                        <div class="ProfileCard-details">
                            <div class="ProfileCard-realName">@admin</div>
                        </div>
                    </div>
                </script>
            </div>
        </div>
        <div class="page-body-wrapper">
            <?php echo $__env->make('layouts.admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <?php echo $__env->yieldContent('breadcrumb-title'); ?>
                            </div>
                            <div class="col-6">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.complaint')); ?>"> <i data-feather="home"></i></a></li>
                                    <?php echo $__env->yieldContent('breadcrumb-items'); ?>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo $__env->yieldContent('content'); ?>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                      <div class="row">
                            <div class="col-md-12 footer-copyright text-center">
                                  <p class="mb-0">Copyright <?php echo e(date('Y')); ?> © RSUD Kota Bogor</p>
                            </div>
                      </div>
                </div>
          </footer>
        </div>
    </div>

    <?php echo $__env->yieldPushContent('before-script'); ?>
    <?php echo $__env->make('layouts.admin.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldPushContent('after-script'); ?>

    <script type="text/javascript">
      if ($(".page-wrapper").hasClass("horizontal-wrapper")) {
            $(".according-menu.other" ).css( "display", "none" );
            $(".sidebar-submenu" ).css( "display", "block" );
      }
    </script>
  </body>
</html>
<?php /**PATH D:\xampp\htdocs\wbs\resources\views/layouts/admin/master.blade.php ENDPATH**/ ?>
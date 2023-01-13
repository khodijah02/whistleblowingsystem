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
<?php /**PATH D:\xampp\htdocs\wbs\resources\views/layouts/dashboard/header.blade.php ENDPATH**/ ?>
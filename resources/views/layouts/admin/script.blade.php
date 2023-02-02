<script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="{{asset('assets/js/scrollbar/simplebar.js')}}"></script>
<script src="{{asset('assets/js/scrollbar/custom.js')}}"></script>
<script id="menu" src="{{asset('assets/js/sidebar-menu.js')}}"></script>
<script type="text/javascript">
    if ($(".page-wrapper").hasClass("horizontal-wrapper")) {
          $(".according-menu.other" ).css( "display", "none" );
          $(".sidebar-submenu" ).css( "display", "block" );
    }
    feather.replace()
    AOS.init();
</script>

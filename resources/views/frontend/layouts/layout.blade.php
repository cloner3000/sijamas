@include('frontend.layouts.header')

@stack('style-css')


            @yield('content')

@include('frontend.layouts.footer')
@include('frontend.layouts.popup')

<!-- <script src="{{ asset(null) }}js/all.js"></script> -->
<!--js-->
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.js"></script>
<script src="{{ asset(null) }}frontend/js/vendor/modernizr-2.6.2.min.js"></script>
<script src="{{ asset(null) }}frontend/js/SmoothScroll.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bxslider/4.1.1/plugins/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="{{ asset(null) }}frontend/js/source/jquery.fancybox.js?v=2.1.5"></script>
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="{{ asset(null) }}frontend/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{ asset(null) }}frontend/js/material.min.js"></script>
<script src="{{ asset(null) }}frontend/js/material-kit.js" type="text/javascript"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bxslider/4.1.1/jquery.bxslider.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>

<script src="{{ asset(null) }}frontend/js/js_lib.js"></script>
<script src="{{ asset(null) }}frontend/js/js_run.js"></script>
<script src="{{ asset(null) }}frontend/js/apps.js"></script>
  <script src="{{ asset(null) }}frontend/assets/js/sweetalert.min.js"></script>
<script type="text/javascript">
	 $(document).ready(function() {
	 	//windowHeight();
		$('.datepicker_start').datepicker({
				changeMonth : true,
                changeYear : true,
                dateFormat : "dd/mm/yy",
		});
		$('.datepicker_end').datepicker({
				changeMonth : true,
                changeYear : true,
                dateFormat : "dd/mm/yy",
		});
		
	});
</script>
<?php
    $div = function($class,$msg){
        return '
            <script>
                swal({
                    title : "'.ucfirst($class).'",
                    type : "'.$class.'",
                    text : "'.$msg.'",
                    html : true
                });
            </script>

        ';
    };

    $actions = ['success','info','danger','warning'];

    foreach($actions as $row)
    {
        if(Session::has($row))
        {
            echo $div($row , Session::get($row));
        }
    }

?>
@stack('script-js')
</html>
@include('frontend.layouts.header')

@stack('style-css')


            @yield('content')

@if(Session::has('infos'))
<script type="text/javascript">
    swal({
        type: 'warning',
        title : 'Warning',
        text : '{{ Session::get("infos") }}',
    });
</script>

@endif
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
@stack('script-js')
</html>
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
@stack('script-js')
</html>
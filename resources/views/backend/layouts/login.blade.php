<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  <title>BSN CPanel</title>

  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">
  <link href="{{ asset(null) }}backend/assets/css/ionicons.min.css" rel="stylesheet" type="text/css">
  <link href="{{ asset(null) }}backend/assets/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  <link href="{{ asset(null) }}backend/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" class="px-demo-stylesheet-bs">
  <link href="{{ asset(null) }}backend/assets/css/admin.min.css" rel="stylesheet" type="text/css" class="px-demo-stylesheet-core">
  <link href="{{ asset(null) }}backend/assets/css/widgets.min.css" rel="stylesheet" type="text/css" class="px-demo-stylesheet-widgets">

  <link href="{{ asset(null) }}backend/assets/css/themes/white.min.css" rel="stylesheet" type="text/css" class="px-demo-stylesheet-theme">

  <link href="{{ asset(null) }}backend/assets/demo/demo.css" rel="stylesheet" type="text/css">
  <link href="{{ asset(null) }}backend/assets/demo/demo.css" rel="stylesheet" type="text/css">
  <link href="{{ asset(null) }}backend/assets/css/sweetalert.css" rel="stylesheet" type="text/css">
  <link href="{{ asset(null) }}backend/assets/css/style.css" rel="stylesheet" type="text/css">
  <link href="{{ asset(null) }}backend/assets/css/animate.css" rel="stylesheet" type="text/css">

  <script type="text/javascript" src="{{ asset(null) }}backend/assets/js/holder.js"></script>

  <!-- Pace.js -->
  <script src="{{ asset(null) }}backend/assets/pace/pace.min.js"></script>

  <script src="{{ asset(null) }}backend/assets/demo/demo.js"></script>
  <script src="{{ asset(null) }}backend/assets/js/sweetalert.min.js"></script>

  <!-- Custom styling -->
  <style>
    .page-header-form .input-group-addon,
    .page-header-form .form-control {
      background: rgba(0,0,0,.05);
    }
  </style>
  <!-- / Custom styling -->

    @stack('style-css')

</head>
<body>

            @yield('content')

  <!-- ==============================================================================
  |
  |  SCRIPTS
  |
  =============================================================================== -->

  <!-- jQuery -->
  <script src="{{ asset(null) }}backend/assets/js/jquery.min.js"></script>

  <script src="{{ asset(null) }}{{ asset(null) }}backend/assets/js/bootstrap.min.js"></script>
  <script src="{{ asset(null) }}{{ asset(null) }}backend/assets/js/admin.min.js"></script>

  <script type="text/javascript">
    // -------------------------------------------------------------------------
    // Initialize DEMO

    $(function() {
      var file = String(document.location).split('/').pop();

      // Remove unnecessary file parts
      file = file.replace(/(\.html).*/i, '$1');

      if (!/.html$/i.test(file)) {
        file = 'index.html';
      }

      // Activate current nav item
      $('body > .px-nav')
        .find('.px-nav-item > a[href="' + file + '"]')
        .parent()
        .addClass('active');

      $('body > .px-nav').pxNav();
      $('body > .px-footer').pxFooter();

      $('#navbar-notifications').perfectScrollbar();
      $('#navbar-messages').perfectScrollbar();
    });
  </script>

  <script>


    $(function() {
      $('[data-toggle="tooltip"]').tooltip();
    });
    $(function() {
      $('#support-tickets').perfectScrollbar();
      $('#comments').perfectScrollbar();
      $('#threads').perfectScrollbar();
    });
  </script>
    @stack('script-js')
</body>
</html>

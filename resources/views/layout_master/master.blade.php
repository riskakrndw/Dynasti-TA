<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield("title")</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{url('bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('dist/css/AdminLTE.min.css')}}">
    <!-- Toastr -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{url('dist/css/skins/_all-skins.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{url('plugins/iCheck/flat/blue.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{url('plugins/morris/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{url('plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{url('plugins/datepicker/datepicker3.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{url('plugins/daterangepicker/daterangepicker.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
    <link rel="stylesheet" href="{{url('plugins/datatables/dataTables.bootstrap.css')}}">

    
    
    <style type="text/css">
       .main-header .navbar {
          background-color: #cc5b09 !important;
          color: #ffffff !important;
        }
         .main-header .navbar .nav > li > a {
          color: #ffffff;
        }
         .main-header .navbar .nav > li > a:hover,
         .main-header .navbar .nav > li > a:active,
         .main-header .navbar .nav > li > a:focus,
         .main-header .navbar .nav .open > a,
         .main-header .navbar .nav .open > a:hover,
         .main-header .navbar .nav .open > a:focus,
         .main-header .navbar .nav > .active > a {
          background: rgba(0, 0, 0, 0.1);
          color: #f6f6f6;
        }
         .main-header .navbar .sidebar-toggle {
          color: #ffffff;
        }
         .main-header .navbar .sidebar-toggle:hover {
          background-color: #b75006 !important;
          color: #ffffff !important;
        }
         .main-header .navbar .sidebar-toggle {
          color: #fff;
        }
        @media (max-width: 767px) {
           .main-header .navbar .dropdown-menu li.divider {
            background-color: rgba(255, 255, 255, 0.1);
          }
           .main-header .navbar .dropdown-menu li a {
            color: #fff;
          }
           .main-header .navbar .dropdown-menu li a:hover {
            background: #367fa9;
          }
        }
         .main-header .logo {
          background-color: #cc5b09 !important;
          color: #ffffff !important;
          border-bottom: 0 solid transparent;
        }
         .main-header .logo:hover {
          background-color: #b75006 !important;
          color: #ffffff !important;
        }
         .main-header li.user-header {
          background-color: #f39c12 !important;
        }
         .content-header {
          background: transparent;
        }

        .main-sidebar .wrapper, .main-sidebar, .main-sidebar .left-side {
          background-color: white !important;
          border-right: 1px solid #d2d6de;
        }

        .main-sidebar .sidebar-menu>li:hover>a, .main-sidebar .sidebar-menu>li.active>a{
          color: #000000 !important;
          background: #fded5d !important;
          border-left-color: #cc5b09 !important;
          font-weight: bolder;
        }
        .main-sidebar .sidebar-menu>li>a, .main-sidebar .sidebar-menu>li>a{
          color: #000000 !important;
          background: #ffffff !important;
        }
        .main-sidebar .sidebar-menu>li.sidebar {
          color: #ffffff !important;
          background: #af9d00 !important;
        }
        .main-sidebar .sidebar-menu>li.header {
          color: #ffffff;
          background: #cc5b09;
        }
        .main-sidebar .treeview-menu>li>a {
          color: #ffffff;
          background: #2d2c26 !important;
        }
        .main-sidebar .treeview-menu>li:hover>a, .main-sidebar .treeview-menu>li.active>a {
          color: #fbbc35 !important;
          background: #2d2c26 !important;
        }
        .main-sidebar .sidebar-menu>li>.treeview-menu {
          margin: 0 1px;
          background: #2d2c26;
        }
        .skin-blue .sidebar-mini .wrapper, .wrapper .wrapper, .wrapper .left-side {
          background-color: #23221c !important;
        }
        .skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side {
          background-color: #ffffff;
          border-right: 1px solid #d2d6de;
        }

        .bg-aqua, .callout.callout-info, .alert-info, .label-info, .modal-info .modal-body {
          background-color: #ffffff !important;
          color: #444 !important;
          border-right: 1px solid #d2d6de;
          border-top: 1px solid #d2d6de;
          border-bottom: 1px solid #d2d6de;
        }

        .callout.callout-info {
          border-color: #e86200 !important;
        }

        .btn-primary {
          background-color: #ffffff !important;
          border-color: #367fa9 !important;
          color: #367fa9 !important;
        }

        .btn-primary:hover {
          background-color: #367fa9 !important;
          border-color: #084061 !important;
          color: #ffffff !important;
        }
    </style>

    @yield("moreasset")

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <!-- header -->
        @include("layout_master.header")
      <!-- header -->

      <!-- header -->
        @include("layout_master.sidebar")
      <!-- header -->

      <!-- content -->
        @yield("content")
      <!-- content -->

      <!-- script -->
        @include("layout_master.script")
      <!-- endscript -->

      <!-- more script -->
      @yield("morescript")
      <!-- /more script -->

      <!-- footer -->
        @include("layout_master.footer")
      <!-- endfooter -->

      <script>
        @if (Session::has('message'))
          var type = "{{ Session::get('alert-type', 'info') }}"

          switch(type){
            case 'info':
             toastr.info("{{ Session::get('message') }}");
             break;
            case 'success':
              toastr.success("{{ Session::get('message') }}");
              break;
            case 'error':
              toastr.error("{{ Session::get('message') }}");
              break;
          } 
        @endif
      </script>

  </body>
</html>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="UTF-8">
    <title>{{ $page_title or "Admin Dashboard" }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset("cssjs/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset("cssjs/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="{{ asset("cssjs/dist/css/skins/_all-skins.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="{{ asset("cssjs/plugins/iCheck/flat/blue.css")}}" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="{{ asset("cssjs/plugins/morris/morris.css")}}" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="{{ asset("cssjs/plugins/jvectormap/jquery-jvectormap-1.2.2.css")}}" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="{{ asset("cssjs/plugins/datepicker/datepicker3.css")}}" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="{{ asset("cssjs/plugins/daterangepicker/daterangepicker-bs3.css")}}" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="{{ asset("cssjs/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset("cssjs/plugins/jQuery/jQuery-2.1.4.min.js")}}"></script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue">
    <div class="wrapper">

      <!-- Header -->
      @if($role_id->role_id == 1 || $role_id->role_id == 2)
        @include('admin.header')
      @else
        @include('header')
      @endif

      <!-- Sidebar -->
      @if($role_id->role_id == 1 || $role_id->role_id == 2)
        @include('admin.sidebar')
      @else
        @include('sidebar')
      @endif

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

          <!-- You can dynamically generate breadcrumbs here -->
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">          
          <!-- Your Page Content Here -->
          @yield('content')

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Footer -->

    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->

    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script type="text/javascript">
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset("cssjs/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <!-- Sparkline -->
    <script src="{{ asset("cssjs/plugins/sparkline/jquery.sparkline.min.js")}}" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="{{ asset("cssjs/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js")}}" type="text/javascript"></script>
    <script src="{{ asset("cssjs/plugins/jvectormap/jquery-jvectormap-world-mill-en.js")}}" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->

    <script src="{{ asset("cssjs/plugins/knob/jquery.knob.js")}}" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="{{ asset("cssjs/plugins/daterangepicker/daterangepicker.js")}}" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="{{ asset("cssjs/plugins/datepicker/bootstrap-datepicker.js")}}" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset("cssjs/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")}}" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="{{ asset("cssjs/plugins/slimScroll/jquery.slimscroll.min.js")}}" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="{{ asset("cssjs/plugins/fastclick/fastclick.min.js")}}" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset("cssjs/dist/js/app.min.js")}}" type="text/javascript"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset("cssjs/dist/js/demo.js")}}" type="text/javascript"></script>

    <script src="{{ asset("cssjs/plugins/datatables/jquery.dataTables.min.js")}}" type="text/javascript"></script>

    <script src="{{ asset("cssjs/plugins/chartjs/Chart.min.js")}}" type="text/javascript"></script>
    <script src="{{ asset("cssjs/plugins/datatables/dataTables.bootstrap.min.js")}}" type="text/javascript"></script>
    <script src="{{ asset("cssjs/plugins/morris/morris.min.js")}}" type="text/javascript"></script>
  </body>
</html>
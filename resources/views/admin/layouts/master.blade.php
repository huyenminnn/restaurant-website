<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <meta name="csrf_token" content="{{ csrf_token() }}">


  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('admins/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admins/bower_components/fontawesome-free-5.0.10/web-fonts-with-css/css/fontawesome-all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('admins/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- jvectormap -->
  {{-- <link rel="stylesheet" href="{{ asset('admins/bower_components/jvectormap/jquery-jvectormap.css') }}"> --}}
  @yield('css.dataTable')
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admins/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('admins/dist/css/skins/_all-skins.min.css') }}">

  <link rel="stylesheet" href="{{ asset('admins/bower_components/toastr/build/toastr.min.css') }}">
  

  @yield('css')


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="{{ route('admin.home') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>T</b>ash</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Tash</b>RES</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class=" fas fa-bars" data-toggle="push-menu" role="button" style="font-size: 25px; padding: 12px; color: white">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fas fa-envelope"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fas fa-clock"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->                  
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fas fa-bell"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fas fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fas fa-flag"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('') }}@yield('admin_profile')" class="user-image" alt="User Image">
              <span class="hidden-xs">
                @yield('admin_name')
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset('') }}@yield('admin_profile')" class="img-circle" alt="User Image">

                <p>
                  @yield('admin_name')
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                 {{--  <a class="btn btn-default btn-flat" href="{{ route('admin.logout') }}">
                    {{ __('Logout') }}
                  </a> --}}
                  <a class="btn btn-default btn-flat" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>

                 {{--  <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form> --}}
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fas fa-gears"></i></a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('') }}@yield('admin_profile')" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>@yield('admin_name')</p>
          <a href="#"><i class="fas fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fas fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="{{ route('admin.home') }}">
            <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
            
          </a>
        </li>
        {{-- <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Layout Options</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
          </ul>
        </li> --}}
      
        <li class="treeview">
          <a href="#">
            <i class="fas fa-utensils"></i> <span>&nbsp;Restaurant</span>
            <span class="pull-right-container">
              <i class="fas fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.booking.list') }}"><i class="fas fa-check-circle"></i>&nbsp;Booking</a></li>
            <li><a href="#"><i class="fas fa-circle"></i>&nbsp;List table</a></li>
            {{-- <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i>Products
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i>Category</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i>Food</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li> --}}
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fab fa-product-hunt"></i> <span>&nbsp;Products</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.category.list') }}"><i class="fas fa-tags"></i>&nbsp;Category</a></li>
            <li><a href="{{ route('admin.product.list') }}"><i class="fas fa-bowling-ball"></i>&nbsp;Food & Drinks</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fas fa-users"></i>
            <span>&nbsp;User Management</span>
            <span class="pull-right-container">
              <i class="fas fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fas fa-user"></i> &nbsp;Users</a></li>
            <li><a href="{{ route('admin.admins.list') }}"><i class="fas fa-user-secret"></i> &nbsp;Admins</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fas fa-book"></i>
            <span>&nbsp;Page Management</span>
            <span class="pull-right-container">
              <i class="fas fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('admin.pages.slider') }}"><i class="fas fa-comment"></i> &nbsp;Slider</a></li>
            <li><a href="{{ route('admin.pages.aboutUs') }}"><i class="fas fa-comment"></i> &nbsp;About us</a></li>
          </ul>
        </li>
  
        {{-- <li><a href="https://adminlte.io/docs"><i class="fas fa-book"></i> <span>&nbsp;Documentation</span></a></li> --}}
        <li class="header">&nbsp;LABELS</li>
        <li><a href="#"><i class="fas fa-circle text-red"></i> <span>&nbsp;Important</span></a></li>
        <li><a href="#"><i class="fas fa-circle text-yellow"></i> <span>&nbsp;Warning</span></a></li>
        <li><a href="#"><i class="fas fa-circle text-aqua"></i> <span>&nbsp;Information</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('cate')
        {{-- <small>Version 2.0</small> --}}
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-dashboard"></i> Home</a></li>
        <li class="active">@yield('sup_cate')</li>
        <li class="active">@yield('cate')</li>
      </ol>
    </section>

    <!-- Main content -->
    @yield('content')
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.3.0
    </div>
    <strong>Copyright &copy; 2018 <a href=""></a>.</strong> Tash Restaurant
  </footer>

  <!-- Control Sidebar -->
 {{--  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fas fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fas fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fas fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->
      </div>
      <!-- /.tab-pane -->

      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

         
          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside> --}}
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('admins/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('admins/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
{{-- <script src="{{ asset('admins/bower_components/fastclick/lib/fastclick.js') }}"></script> --}}

@yield('js.dataTable')
<!-- AdminLTE App -->
<script src="{{ asset('admins/dist/js/adminlte.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('admins/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>

{{-- toastr --}}
<script src="{{ asset('admins/bower_components/toastr/build/toastr.min.js') }}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- jvectormap  -->
{{-- <script src="{{ asset('admins/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('admins/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script> --}}
<!-- SlimScroll -->
{{-- <script src="{{ asset('admins/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script> --}}
<!-- ChartJS -->
{{-- <script src="{{ asset('admins/bower_components/Chart.js/Chart.js') }}"></script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{ asset('admins/dist/js/pages/dashboard2.js') }}"></script> --}}
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ asset('admins/dist/js/demo.js') }}"></script> --}}
@yield('js')
</body>
</html>

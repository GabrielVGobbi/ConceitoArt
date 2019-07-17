<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/Ionicons/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/plugins/timepicker/bootstrap-timepicker.min.css">

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/dist/css/skins/_all-skins.min.css">

  <link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon">

  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/jquery/dist/jquery.min.js"></script>

  <script src="<?php echo BASE_URL; ?>node_modules/sweetalert/dist/sweetalert.min.js"></script>

  <script type="text/javascript">
    var BASE_URL = '<?php echo BASE_URL; ?>'
  </script>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/select2/dist/css/select2.min.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/template.css">
</head>
<?php 
?>
<body class="hold-transition skin-blue layout-top-nav">
  <div class="wrapper">

    <header class="main-header">
      <nav class="navbar ">
        <div class="container">
          <div class="navbar-header">
            <a href="/admin" class="navbar-brand"><b>Admin</b>Gallery</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">


    
              <?php if ($this->userInfo['user']->hasPermission('inventario_view')) : ?>
                <li class="active"><a href="<?php echo BASE_URL; ?>inventario">Obras <span class="sr-only">(current)</span></a></li>
              <?php endif; ?>
              <?php if ($this->userInfo['user']->hasPermission('mercadolivre_view')) : ?>
                <li class="active"><a href="<?php echo BASE_URL; ?>mercadolivre">Mercado Livre <span class="sr-only">(current)</span></a></li>
              <?php endif; ?>

              <?php if ($this->userInfo['user']->hasPermission('report_view')) : ?>
                <li class="active"><a href="<?php echo BASE_URL; ?>relatorio">Relatórios <span class="sr-only">(current)</span></a></li>
              <?php endif; ?>
              <?php if ($this->userInfo['user']->hasPermission('clientes_view')) : ?>
                <li class="active"><a href="<?php echo BASE_URL; ?>cliente">Clientes <span class="sr-only">(current)</span></a></li>
              <?php endif; ?>

              <?php if ($this->userInfo['user']->hasPermission('notas_view')) : ?>
                <li class="active"><a href="<?php echo BASE_URL; ?>notas">Notas <span class="sr-only">(current)</span></a></li>
              <?php endif; ?>

            </ul>

          </div>
          <!-- /.navbar-collapse -->
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu">
                <!-- Menu toggle button -->


              </li>
              <!-- /.messages-menu -->

              <!-- Notifications Menu -->
              <li class="dropdown notifications-menu">

              </li>
              <!-- Tasks Menu -->
              <li class="dropdown tasks-menu">


              </li>

              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="/admin/login/logout">
                  <!-- The user image in the navbar-->
                  <!-- <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"> <?php echo ucfirst($this->userInfo['userName']['login']); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <!-- <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->

                    <p>
                      <?php echo $this->userInfo['userName']['login']; ?>
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
                      <a href="<?php echo BASE_URL; ?>login/logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </div>
          <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
      </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper">
      <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 style="text-align: center;">

            <?php echo ucfirst($viewData['pageController']) ?>

          </h1>
        </section>

        <!-- Main content -->
        <section class="content">

          <?php $this->loadViewInTemplate($viewName, $viewData); ?>

        </section>
      </div>

    </div>

    <footer class="main-footer">
      <div class="container">
        <div class="pull-right hidden-xs">
          <b>Version</b> 0.0.1
        </div>
        <strong></strong> All rights reserved.
      </div>
      <!-- /.container -->
    </footer>
  </div>

  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- InputMask -->
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/plugins/input-mask/jquery.inputmask.js"></script>

  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>

  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <!-- date-range-picker -->

  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap datepicker -->
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- bootstrap color picker -->
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <!-- bootstrap time picker -->
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/plugins/timepicker/bootstrap-timepicker.min.js"></script>
  <!-- SlimScroll -->
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- iCheck 1.0.1 -->
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/plugins/iCheck/icheck.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/dist/js/demo.js"></script>




  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/select2/dist/js/select2.full.min.js"></script>

  <!-- date-range-picker -->
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/moment/min/moment.min.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/js/script.js"></script>


  <?php if (isset($_SESSION['form'])) : ?>
    <script type="text/javascript">
      var title = '<?php echo $_SESSION['form']['success']; ?>';
      var text = '<?php echo $_SESSION['form']['mensagem']; ?>';
      var icon = '<?php echo $_SESSION['form']['type']; ?>';
      var pageController = '<?php echo $viewData['pageController']; ?>';

      swal({
          title: title,
          text: text,
          icon: icon,
          buttons: 'OK',
        })
        .then((value) => {

          <?php unset($_SESSION['form']); ?>
          /*window.location.href = BASE_URL+pageController;*/
        });
    </script>

  <?php endif; ?>

</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title><?php echo $this->config->item('app_name');?></title>

  <!-- fullCalendar -->
  <link rel="stylesheet" href="<?php echo base_url('assets/theme_admin/');?>plugins/fullcalendar/main.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/theme_admin/');?>plugins/fullcalendar-daygrid/main.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/theme_admin/');?>plugins/fullcalendar-timegrid/main.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/theme_admin/');?>plugins/fullcalendar-bootstrap/main.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/theme_admin/');?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/theme_admin/');?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  
  <!-- Sweet Alert css -->
  <link href="<?php echo base_url();?>assets/sweet-alert/sweetalert2.min.css" rel="stylesheet" type="text/css" />
  
  <link href="<?php echo base_url();?>assets/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
	
<!-- daterange picker -->
<link rel="stylesheet" href="<?php echo base_url('assets/theme_admin/');?>plugins/daterangepicker/daterangepicker.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/theme_admin/');?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/theme_admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/theme_admin/dist/css/adminlte.min.css">
 <!-- Google Font: Source Sans Pro -->
 <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


<!-- jQuery -->
<script src="<?php echo base_url();?>assets/theme_admin/plugins/jquery/jquery.min.js"></script>

  <style>
    body{
      font-size:14px;
    }
    .scroll-x-table{
      overflow-x: auto;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini text-sm">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user" style="margin-right:2px;"></i>
          <?php echo $this->session->userdata('fullname');?>
        </a>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

 <?php $this->load->view('_sidebar');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $page_title;?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            
            <?php if(isset($content)){$this->load->view($content);}?>
          
          </div>
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  

  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>assets/theme_admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/theme_admin/dist/js/adminlte.min.js"></script>

<script src="<?php echo base_url();?>assets/datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/datepicker/locales/bootstrap-datepicker.id.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url('assets/theme_admin/');?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets/theme_admin/');?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/theme_admin/');?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url('assets/theme_admin/');?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- InputMask -->
<script src="<?php echo base_url('assets/theme_admin/');?>plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url('assets/theme_admin/');?>plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="<?php echo base_url('assets/theme_admin/');?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url('assets/theme_admin/');?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Loading Overlay Js  -->
<script src="<?php echo base_url();?>assets/loading_overlay/loadingoverlay.js"></script>

<!-- Sweet Alert Js  -->
<script src="<?php echo base_url();?>assets/sweet-alert/sweetalert2.min.js"></script>

<script>
	$(document).ready(function (){
		$('body').on('focus',".tanggal", function(){                     
			  $(this).datepicker({
					format: " dd/mm/yyyy",
					viewMode: "year",
					autoclose:true,
					todayHighlight:true,
					calendarWeeks:false,
					startView:0,
					todayBtn: "linked"
			});
		}); 

    $('[data-mask]').inputmask()

  
	});
</script>

</body>
</html>

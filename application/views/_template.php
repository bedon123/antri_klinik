<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Antrian</title>

    <!-- Sweet Alert css -->
    <link href="<?php echo base_url();?>assets/sweet-alert/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/theme_admin/plugins/toastr/toastr.min.css">
    
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
      /* background:#E3E5E1; */
    }
    .bg-color{
        background:#2C4E95;
        /* background:#FFCC00; */
    }
    .bg1{
        background:#2C4E95;
        /* background:#FFCC00; */
        color:black;
    }
    .card{
        /* border:#2C4E95 1px solid;
        color:#2C4E95; */

        border:#2C4E95 1px solid;
        color:#FFCC00;
    }
    .text-color1{
        color:white;
    }
    /* .alert-info {
        color: #31708f;
        background-color: #d9edf7;
        border-color: #bce8f1;
    } */
  </style>

</head>
<body>
<div class="wrapper">
    <?php $this->load->view($content);?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>assets/theme_admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/theme_admin/dist/js/adminlte.min.js"></script>

<!-- Loading Overlay Js  -->
<script src="<?php echo base_url();?>assets/loading_overlay/loadingoverlay.js"></script>

<!-- Sweet Alert Js  -->
<script src="<?php echo base_url();?>assets/sweet-alert/sweetalert2.min.js"></script>

<!-- Toastr -->
<script src="../../plugins/toastr/toastr.min.js"></script>

</body>
</html>

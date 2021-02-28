<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $this->config->item('app_name');?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/theme_admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/theme_admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/theme_admin/dist/css/adminlte.min.css">
  
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
 
  <!-- Sweet Alert css -->
  <link href="<?php echo base_url();?>assets/sweet-alert/sweetalert2.min.css" rel="stylesheet" type="text/css" />
  <!-- jQuery -->
<script src="<?php echo base_url();?>assets/theme_admin/plugins/jquery/jquery.min.js"></script>



</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo site_url();?>">Admin Panel</a>
  </div>
 <!-- /.login-logo -->
<div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form id="form1">
        <div class="input-group mb-3">
          <input type="uname" name="uname" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="pass" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      

     
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>assets/theme_admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/theme_admin/dist/js/adminlte.min.js"></script>

<!-- Loading Overlay Js  -->
<script src="<?php echo base_url();?>assets/loading_overlay/loadingoverlay.js"></script>

<!-- Sweet Alert Js  -->
<script src="<?php echo base_url();?>assets/sweet-alert/sweetalert2.min.js"></script>

<script>
$(function () {
	  $("#form1").submit(function (event) { 
        event.preventDefault();
        ajaxSubmit();
    }); 

})

function ajaxSubmit(){
    $.ajax({
        url: '<?php echo base_url($this->uri->segment(1));?>/ajax_submit',
        type: 'POST',
        data: $("#form1").serialize(),
        beforeSend: function() {
            $.LoadingOverlay("show");
        },
        complete: function() {
            $.LoadingOverlay("hide");
        },
        success: function(json) {
            $.LoadingOverlay("hide");
            if(json['status']=='sukses'){
                
               window.location.href="<?php echo site_url('petugas_loket');?>";

            }else{
                swal({
                    type: 'error',
                    title: 'Oops...',
                    html: json['data']
                })
            }
        },
        error: function() {
            $.LoadingOverlay("hide");
            swal({
                    type: 'error',
                    title: 'Oops...',
                    html: 'Error occured. Please try again or contact administrator'
                })	
            
        }
    });
}
</script>
</body>
</html>

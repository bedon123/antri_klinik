<div class="container">
    <div class="row" style="margin-top:10px;">
        <div class="col-md-12">
            <center>
                <img width="600px" src="<?php echo base_url('assets/logo.jpg');?>" alt="">
            </center>
        </div>
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fas fa-info"></i>Selamat Datang di Aplikasi Antrian Pengunjung. Silahkan pilih halaman yang ingin ditampilkan. 
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner" style="height:100px;padding-top:30px;">
                    <h4><b>Nomor Antrian</b></h4>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
                <a href="<?php echo site_url('pengunjung');?>" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner" style="height:100px;padding-top:30px;">
                    <h4><b>Dashboard Antrian</b></h4>
                </div>
                <div class="icon">
                    <i class="fa fa-tachometer-alt"></i>
                </div>
                <a href="<?php echo site_url('dashboard');?>" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner" style="height:100px;padding-top:30px;">
                    <h4><b>Petugas</b></h4>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href="<?php echo site_url('petugas');?>" class="small-box-footer">Pilih <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        
    </div>

</div>

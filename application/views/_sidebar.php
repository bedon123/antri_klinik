 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-light-warning elevation-4">
    <!-- Brand Logo -->
    <div style="padding:10px;">
      <div>
        <img width="100px" src="<?php echo base_url();?>assets/logo.jpg" alt="Logo">
      </div>
      <div>
        <?php echo $this->session->userdata('nama_lokasi');?>
      </div>
    </div>
    
    <div style="width:100%;border-bottom:1px solid grey;"></div>

    <!-- Sidebar -->
    <div class="sidebar">
    
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
             
          <li class="nav-item">
            <a href="<?php echo site_url('petugas_loket');?>" class="nav-link <?php echo (strtolower($this->uri->segment(1)=='petugas_loket'))?'active':'';?>">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Petugas
              </p>
            </a>
          </li>
          <?php if($this->session->userdata('role_id')=='1'):?>
          <li class="nav-item">
            <a href="<?php echo site_url('users');?>" class="nav-link <?php echo (strtolower($this->uri->segment(1)=='users'))?'active':'';?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <?php endif;?>

          <li class="nav-item">
            <a href="<?php echo site_url('change_password');?>" class="nav-link <?php echo (strtolower($this->uri->segment(1)=='change_password'))?'active':'';?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Ubah Password
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="<?php echo site_url('auth/logout');?>" class="nav-link ">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Keluar
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
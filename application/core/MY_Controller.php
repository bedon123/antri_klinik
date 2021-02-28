<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $role_id=$this->session->userdata('role_id');
        if($role_id==""){
            redirect('auth/login');
        }
        $uri_seg1=strtolower($this->uri->segment(1));
        $arr_role1=array('petugas_loket','users','change_password');
        $arr_role2=array('petugas_loket','change_password');
        if($role_id=="1"){
            if(!in_array($uri_seg1,$arr_role1)){
                redirect('auth/login');
            }
        }
        if($role_id=="2"){
            if(!in_array($uri_seg1,$arr_role2)){
                redirect('auth/login');
            }
        }
    }
    

}

/* End of file MY_Controller.php */

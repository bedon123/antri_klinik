<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_pengunjung extends CI_Controller {

    public function index()
    {
        $this->load->view('v_login_pengunjung');
    }

    public function ajax_submit(){
        if($this->input->post()){
            $id=$this->input->post('id');
            $this->form_validation->set_rules('uname', 'Username', 'trim|required|max_length[20]');
            $this->form_validation->set_rules('pass', 'Password', 'trim|required|min_length[8]|max_length[20]');
            
            if ($this->form_validation->run() == FALSE){
				$response=array('status'=>'error','data'=>validation_errors());
			}else{

				$uname=trim(strip_tags($this->input->post('uname')));
				$pass=trim(strip_tags($this->input->post('pass')));
                $user=$this->db->get_where('users',array('uname'=>$uname))->row_array();
                if($user){
                    if (password_verify($pass, $user['pass'])) {
                        $this->session->set_userdata('user_id',$user['id']);
                        $this->session->set_userdata('fullname',$user['fullname']);
                        $this->session->set_userdata('role_id',$user['role_id']);
                        $response=array('status'=>'sukses','data'=>'Berhasil');
                    } else {
                        $response=array('status'=>'error','data'=>'Password Salah');
                    }
                }else{
                    $response=array('status'=>'error','data'=>'Username tidak ditemukan');
                }
			}
			header('Content-Type: application/json');
			echo json_encode($response);
		}else{
			$response=array('status'=>'error','data'=>'Only POST Data');
			header('Content-Type: application/json');
			echo json_encode($response);
		}
    }

}

/* End of file Login_pengunjung.php */

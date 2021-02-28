<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_password extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_users');
        $this->load->model("M_cmb");
    }

    public function index()
    {
        $d['page_title']='Ubah Password';
        $d['content']='v_'.strtolower($this->uri->segment(1));
        $this->load->view('_template_admin',$d);
    }

    
    public function ajax_submit(){
        if($this->input->post()){
            $this->form_validation->set_rules('pass', 'Password', 'trim|required|min_length[8]|max_length[20]');
            $this->form_validation->set_rules('retype_pass', 'Ketik ulang Password', 'trim|required|min_length[8]|max_length[20]|matches[pass]');
            if ($this->form_validation->run() == FALSE){
				$response=array('status'=>'error','data'=>validation_errors());
			}else{
                $id=$this->session->userdata('user_id');
                $data['pass']=password_hash(trim(strip_tags($this->input->post('pass'))), PASSWORD_DEFAULT);;
                $data['updated_on']=date('Y-m-d H:i:s');
                $data['updated_by']=$this->session->userdata('user_id');
                $result=$this->model1->update($id,$data);
				if($result>0){
					$response=array('status'=>'success','data'=>'Berhasil ubah password');
				}else{
					$response=array('status'=>'error','data'=>'Gagal ubah password');
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

/* End of file Change_password.php */

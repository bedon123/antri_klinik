<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_'.strtolower($this->uri->segment(1)),'model1');
        $this->load->model("M_cmb");
    }
    
    public function index()
    {
        $d['page_title']='Users';
        $d['cb_roles']=$this->M_cmb->getRoles();
        $d['content']='v_'.strtolower($this->uri->segment(1));
        $this->load->view('_template_admin',$d);
    }

    
    function ajax_list(){
		$column_order = array(null,'uname','fullname','role','last_login',null); 
		
		$draw = $_REQUEST['draw'];
		$length = $_REQUEST['length'];
		$start = $_REQUEST['start'];
		$search = strip_tags(trim($_REQUEST['search']["value"]));
		
		$order = $_POST['order']['0']['column'];
		$dir = $_POST['order']['0']['dir'];		
        
		$query=$this->model1->getAll($start,$length,$column_order[$order],$dir,strtolower($search));
		$total=$this->model1->countAll(strtolower($search));  
	
		$output = array();
		$output['draw'] = $draw;
		$output['recordsTotal'] = $output['recordsFiltered'] = $total;
		$output['data'] = array();
        
        $nomor_urut = $start+1;
		foreach ($query as $row) {
            $id = $row['id'];
            $output['data'][] = array($nomor_urut
                                    ,$row['uname']
                                    ,$row['fullname']
                                    ,$row['role']
                                    ,$row['last_login']
                                    ,'
                                    <a href="javascript:void(0)" onclick="ajaxCp('.$id.')" class="btn btn-default btn-sm" style="margin-right:5px;"><i class="fa fa-unlock"></i></a> 
                                    <a href="javascript:void(0)" onclick="ajaxGetOne('.$id.')" class="btn btn-info btn-sm" style="margin-right:5px;"><i class="fa fa-edit"></i></a> 
                                    <a href="javascript:void(0)" onclick="ajaxDelete('.$id.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> 
                                    '
                                   );
			$nomor_urut++;
		}

		echo json_encode($output);	
    }

    public function ajax_submit(){
        if($this->input->post()){
            $id=$this->input->post('id');
            $this->form_validation->set_rules('uname', 'Username', 'trim|required|max_length[20]');
            $this->form_validation->set_rules('fullname', 'Nama Lengkap', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('role_id', 'Role', 'trim|required|numeric|max_length[50]');
            
            if($id==''){
                $this->form_validation->set_rules('pass', 'Password', 'trim|required|min_length[8]|max_length[20]');
            }
            if ($this->form_validation->run() == FALSE){
				$response=array('status'=>'error','data'=>validation_errors());
			}else{

				$data['uname']=trim(strip_tags($this->input->post('uname')));
				$data['fullname']=trim(strip_tags($this->input->post('fullname')));
                $data['role_id']=trim(strip_tags($this->input->post('role_id')));
                
                if($id==''){
                    $cek=$this->db->get_where('users',array('uname'=>$data['uname']))->row_array();
                    if($cek){
                        $response=array('status'=>'error','data'=>'Username '.$data['uname'].' sudah ada');
                        header('Content-Type: application/json');
                        echo json_encode($response);
                        die();
                    }else{
                        $data['pass']=password_hash(trim(strip_tags($this->input->post('pass'))), PASSWORD_DEFAULT);;
                        $data['created_on']=date('Y-m-d H:i:s');
                        $data['created_by']=$this->session->userdata('user_id');
                        $result=$this->model1->insert($data);
                        $res_msg="Tambah";
                    }
                    
                }else{
                    $this->db->where('id<>',$id);
                    $this->db->where('uname',$data['uname']);
                    $cek=$this->db->get('users')->row_array();
                    if($cek){
                        $response=array('status'=>'error','data'=>'Username '.$data['uname'].' sudah ada');
                        header('Content-Type: application/json');
                        echo json_encode($response);
                        die();
                    }else{
                        $data['updated_on']=date('Y-m-d H:i:s');
                        $data['updated_by']=$this->session->userdata('user_id');
                        $result=$this->model1->update($id,$data);
                        $res_msg="Ubah";
                    }
				}
				if($result>0){
					$response=array('status'=>'sukses','data'=>'Berhasil '.$res_msg.' data');
				}else{
					$response=array('status'=>'error','data'=>'Gagal '.$res_msg.' data');
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
    
    public function ajax_submit_cp(){
        if($this->input->post()){
            $id=$this->input->post('id');
            $this->form_validation->set_rules('pass', 'Password', 'trim|required|min_length[8]|max_length[20]');
            $this->form_validation->set_rules('retype_pass', 'Ketik Ulang Password', 'trim|required|min_length[8]|max_length[20]|matches[pass]');
            if ($this->form_validation->run() == FALSE){
				$response=array('status'=>'error','data'=>validation_errors());
			}else{

                $data['pass']=password_hash(trim(strip_tags($this->input->post('pass'))), PASSWORD_DEFAULT);;
                $data['updated_on']=date('Y-m-d H:i:s');
                $data['updated_by']=$this->session->userdata('user_id');
                $result=$this->model1->update($id,$data);
                if($result>0){
					$response=array('status'=>'sukses','data'=>'Berhasil Ubah password');
				}else{
					$response=array('status'=>'error','data'=>'Gagal Ubah password');
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

    public function ajax_get_one(){
        if($this->input->post()){
            $this->form_validation->set_rules('id', 'id', 'trim|required|numeric|max_length[10]');
			if ($this->form_validation->run() == FALSE){
				$response=array('status'=>'error','data'=>validation_errors());
			}else{
                $id=$this->input->post('id');
                $result=$this->model1->getOne($id);
                if($result){
                    $response=array('status'=>'sukses','data'=>$result);
				}else{
					$response=array('status'=>'error','data'=>"Data tidak ditemukan");
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

    public function ajax_delete(){
        if($this->input->post()){
            $this->form_validation->set_rules('id', 'id', 'trim|required|numeric|max_length[10]');
			if ($this->form_validation->run() == FALSE){
				$response=array('status'=>'error','data'=>validation_errors());
			}else{
                $id=$this->input->post('id');
                $result=$this->model1->delete($id);
				$response=array('status'=>'sukses','data'=>'Berhasil hapus data');
				
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

/* End of file Users.php */

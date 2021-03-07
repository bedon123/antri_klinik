<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengunjung extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $user_id=$this->session->userdata('user_id');
        if($user_id==""){
            redirect('login_pengunjung');
        }
    }
    
    public function index()
    {
        // $data['content']='v_pengunjung';
        // $this->load->view('_template',$data);
        $this->load->view('v_pengunjung');
    }

    function ajax_ambil_antrian(){
        $no_booking=$this->input->get('no_booking');
        $this->db->select('count(*) as jumlah');
        $this->db->where('no_booking',$no_booking);
        $this->db->where('is_done_ruangan','1');
        $cek=$this->db->get('antrian')->row()->jumlah;
        if($cek>0){
            $this->db->trans_rollback();
            $response = array('status'=>'error', 'data'=>'Nomor booking sudah pernah di proses'); 
            header('Content-Type: application/json');
		    echo json_encode($response);
            die();
        }
        $this->db->trans_begin();
            $this->db->where('tanggal',date('Y-m-d'));
            $this->db->order_by('no_antrian','DESC');
            $this->db->limit(1);
            $antrian=$this->db->get('antrian')->row_array();
            if($antrian){
                $no_antrian=$antrian['no_antrian']+1;
            }else{
                $no_antrian=1;
            }
            $this->db->insert('antrian',array(
                "tanggal"=>date('Y-m-d'),
                "no_antrian"=>$no_antrian,
                "no_booking"=>$no_booking,
                "created_on"=>date('Y-m-d H:i:s'),
            ));
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $response = array('status'=>'error', 'data'=>'Gagal ambil antrian'); 
        }else{
            $this->db->trans_commit();
            $response = array('status'=>'success', 'data'=>$no_antrian);
        }
        header('Content-Type: application/json');
		echo json_encode($response);
    }
}

/* End of file Pengunjung.php */

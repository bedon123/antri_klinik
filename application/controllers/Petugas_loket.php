<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas_loket extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_cmb');
    }
    
    public function index()
    {
        $data['page_title']='Antrian Loket';
        $data['content']='v_'.strtolower($this->uri->segment(1));
        $this->load->view('_template_admin',$data);
    }

    function ajax_get_jumlah_antrian(){
        
        $this->db->select('count(*) as jumlah');
        $this->db->where('tanggal',date('Y-m-d'));
        $this->db->where('is_cancel','0');
        $jumlah_antrian=$this->db->get('antrian')->row()->jumlah;

        $this->db->select('count(*) as jumlah');
        $this->db->where('tanggal',date('Y-m-d'));
        $this->db->where('is_panggil_loket','0');
        $this->db->where('is_cancel','0');
        $sisa_antrian=$this->db->get('antrian')->row()->jumlah;

        $response = array(
            'jumlah_antrian'=>$jumlah_antrian,
            'sisa_antrian'=>$sisa_antrian,
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function ajax_get_antrian_loket(){
        $this->db->select('*');
        $this->db->where('tanggal',date('Y-m-d'));
        $this->db->where('is_done_loket','0');
        $this->db->where('is_cancel','0');
        $this->db->order_by('no_antrian','ASC');
        $this->db->limit(10);
        $antrian=$this->db->get('antrian')->result_array();

        $jumlah_loket=$this->db->get_where('loket',array('tipe'=>'1'))->num_rows();
        $response=array(
            'antrian'=>$antrian,
            'jumlah_loket'=>$jumlah_loket,
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function ajax_panggil_antrian_loket(){
        $id=$this->input->get('id');
        $loket=$this->input->get('loket');
        if($id==''){
            $response=array('status'=>'error','data'=>'Gagal id antrian tidak ditemukan');
            header('Content-Type: application/json');
            echo json_encode($response);
            die();
        }
        if($loket==''){
            $response=array('status'=>'error','data'=>'Gagal loket tidak ditemukan');
            header('Content-Type: application/json');
            echo json_encode($response);
            die();
        }

        $this->db->trans_begin();
            $this->db->where('id',$id);
            $this->db->update('antrian',array(
                'is_panggil_loket'=>'1',
                'loket'=>$loket,
            ));

            $antrian=$this->db->get_where('antrian',array('id'=>$id))->row_array();
            $this->db->where('current_antrian',$antrian['no_antrian']);
            $this->db->update('loket',array(
                'current_antrian'=>null
            ));

            $this->db->where('nomor',$loket);
            $this->db->where('tipe','1');
            $this->db->update('loket',array(
                'current_antrian'=>$antrian['no_antrian'],
            ));

            $this->db->insert('antrian_loket',array(
                'id_antrian'=>$id,
                'no_loket'=>$loket,
                'remark'=>'loket',
            ));

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $response = array('status'=>'error', 'data'=>'Gagal updatedata'); 
        }else{
            $this->db->trans_commit();
            $response = array('status'=>'success', 'data'=>'success');
        }
        header('Content-Type: application/json');
		echo json_encode($response);
    }

    function ajax_selesai_loket(){
        $id=$this->input->get('id');
        if($id==''){
            $response=array('status'=>'error','data'=>'Gagal id antrian tidak ditemukan');
            header('Content-Type: application/json');
            echo json_encode($response);
            die();
        }

        $this->db->trans_begin();
            $this->db->where('id',$id);
            $this->db->update('antrian',array(
                'is_done_loket'=>'1',
            ));

            $antrian=$this->db->get_where('antrian',array('id'=>$id))->row_array();
            $this->db->where('nomor',$antrian['loket']);
            $this->db->where('tipe','1');
            $this->db->update('loket',array(
                'current_antrian'=>null,
            ));
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $response = array('status'=>'error', 'data'=>'Gagal update data'); 
        }else{
            $this->db->trans_commit();
            $response = array('status'=>'success', 'data'=>'success');
        }
        header('Content-Type: application/json');
		echo json_encode($response);
    }

    function ajax_cancel(){
        $id=$this->input->get('id');
        if($id==''){
            $response=array('status'=>'error','data'=>'Gagal id antrian tidak ditemukan');
            header('Content-Type: application/json');
            echo json_encode($response);
            die();
        }

        $this->db->trans_begin();
            $this->db->where('id',$id);
            $this->db->update('antrian',array(
                'is_cancel'=>'1',
            ));
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $response = array('status'=>'error', 'data'=>'Gagal update data'); 
        }else{
            $this->db->trans_commit();
            $response = array('status'=>'success', 'data'=>'success');
        }
        header('Content-Type: application/json');
		echo json_encode($response);
    }


    function ajax_get_antrian_tes(){
        $this->db->select('*');
        $this->db->where('tanggal',date('Y-m-d'));
        $this->db->where('is_done_loket','1');
        $this->db->where('is_done_ruangan','0');
        $this->db->where('is_cancel','0');
        $this->db->order_by('no_antrian','ASC');
        $this->db->limit(10);
        $antrian=$this->db->get('antrian')->result_array();

        $jumlah_loket=$this->db->get_where('loket',array('tipe'=>'2'))->num_rows();
        $response=array(
            'antrian'=>$antrian,
            'jumlah_loket'=>$jumlah_loket,
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function ajax_panggil_antrian_tes(){
        $id=$this->input->get('id');
        $loket=$this->input->get('loket');
        if($id==''){
            $response=array('status'=>'error','data'=>'Gagal id antrian tidak ditemukan');
            header('Content-Type: application/json');
            echo json_encode($response);
            die();
        }
        if($loket==''){
            $response=array('status'=>'error','data'=>'Gagal loket tidak ditemukan');
            header('Content-Type: application/json');
            echo json_encode($response);
            die();
        }

        $this->db->trans_begin();
            $this->db->where('id',$id);
            $this->db->update('antrian',array(
                'is_panggil_ruangan'=>'1',
                'ruangan'=>$loket,
            ));
            
            $antrian=$this->db->get_where('antrian',array('id'=>$id))->row_array();
            $this->db->where('current_antrian',$antrian['no_antrian']);
            $this->db->update('loket',array(
                'current_antrian'=>null
            ));

            $this->db->where('nomor',$loket);
            $this->db->where('tipe','2');
            $this->db->update('loket',array(
                'current_antrian'=>$antrian['no_antrian'],
            ));

            $this->db->insert('antrian_loket',array(
                'id_antrian'=>$id,
                'no_loket'=>$loket,
                'remark'=>'ruangan',
            ));
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $response = array('status'=>'error', 'data'=>'Gagal updatedata'); 
        }else{
            $this->db->trans_commit();
            $response = array('status'=>'success', 'data'=>'success');
        }
        header('Content-Type: application/json');
		echo json_encode($response);
    }

    function ajax_selesai_tes(){
        $id=$this->input->get('id');
        if($id==''){
            $response=array('status'=>'error','data'=>'Gagal id antrian tidak ditemukan');
            header('Content-Type: application/json');
            echo json_encode($response);
            die();
        }

        $this->db->trans_begin();
            $this->db->where('id',$id);
            $this->db->update('antrian',array(
                'is_done_ruangan'=>'1',
            ));
            $antrian=$this->db->get_where('antrian',array('id'=>$id))->row_array();
            $this->db->where('nomor',$antrian['ruangan']);
            $this->db->where('tipe','2');
            $this->db->update('loket',array(
                'current_antrian'=>null,
            ));
        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $response = array('status'=>'error', 'data'=>'Gagal update data'); 
        }else{
            $this->db->trans_commit();
            $response = array('status'=>'success', 'data'=>'success');
        }
        header('Content-Type: application/json');
		echo json_encode($response);
    }

}

/* End of file Petugas_loket.php */

<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function index()
    {
        $cek=$this->db->get_where('loket',array('updated_on>=',date('Y-m-d').' 00:00:00'))->row_array();
        if($cek){
            $this->db->where('updated_on>=',date('Y-m-d').' 00:00:00');
            $this->db->update('loket',array(
                'current_antrian'=>null,
            ));
        }
        $data['loket']=$this->db->get_where('loket',array('tipe'=>'1'))->result_array();
        $data['ruangan']=$this->db->get_where('loket',array('tipe'=>'2'))->result_array();
        $data['content']='v_dashboard';
        $this->load->view('_template',$data);
    }

    function ajax_get_antrian(){
        $loket=$this->db->get_where('loket',array('tipe'=>'1'))->result_array();
        $ruangan=$this->db->get_where('loket',array('tipe'=>'2'))->result_array();
        $current=$this->db->where('current_antrian is not null')->order_by('updated_on','desc')->limit(1)->get('loket')->row_array();
        if($current){
            $current_no_antrian=$current['current_antrian'];
            $current_loket=$current['nama'].' '.$current['nomor'];
        }else{
            $current_no_antrian=' - ';
            $current_loket=' - ';
        }
        $response=array(
            'loket'=>$loket,
            'ruangan'=>$ruangan,
            'current_no_antrian'=>$current_no_antrian,
            'current_loket'=>$current_loket,
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }

}

/* End of file Dashboard.php */

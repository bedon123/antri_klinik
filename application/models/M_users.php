<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model {

    function getAll($offset='',$limit='',$order='',$dir='',$keyword=""){
        if($offset==''){
			$offset=0;
		}
		if($limit==''){
			$limit=10;
		}
		if($order==''){
			$order='id';
		}
		if($dir==''){
			$dir='ASC';
        }
        $keyword=strtolower($keyword);
        $this->db->select('a.*,b.role,c.nama as nama_loket, nomor as nomor_loket');
        $this->db->from('users a');
        $this->db->join('roles b','a.role_id=b.id','inner');
        $this->db->join('loket c','a.id_loket=c.id','left outer');
        $this->db->like('a.uname',$keyword);
        $this->db->or_like('a.fullname',$keyword);
        $this->db->or_like('b.role',$keyword);
        $this->db->order_by($order,$dir);
        $this->db->limit($limit,$offset);
        return $this->db->get()->result_array();
    }

    function countAll($keyword=""){
        $keyword=strtolower($keyword);
        $this->db->select('count(*) as jumlah');
        $this->db->from('users a');
        $this->db->join('roles b','a.role_id=b.id','inner');
        $this->db->join('loket c','a.id_loket=c.id','left outer');
        $this->db->like('a.uname',$keyword);
        $this->db->or_like('a.fullname',$keyword);
        $this->db->or_like('b.role',$keyword);
        return $this->db->get()->row()->jumlah;
    }

    function getOne($id){
        return $this->db->get_where('users',array('id'=>$id))->row_array();
    }

    function insert($data){
        $this->db->insert('users',$data);
        return $this->db->affected_rows();
    }

    function update($id,$data){
        $this->db->where('id',$id);
        $this->db->update('users',$data);
        return $this->db->affected_rows();
    }

    function delete($id){
        $this->db->where('id',$id);
        $this->db->delete('users');
        $this->db->affected_rows();
    }

}

/* End of file M_users.php */

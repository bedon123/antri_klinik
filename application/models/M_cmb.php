<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_cmb extends CI_Model {
    function getRoles(){
        $result = $this->db->get('roles')->result();
		if($result)
		{
			foreach ($result as $key => $row)
			{
				$ret [$row->id] = $row->role;
			}
		}
		return $ret;
	}

    function getLoketPangil($tipe){
        $this->db->where('tipe',$tipe);
        $this->db->order_by('nomor','ASC');
		$result = $this->db->get('loket')->result();
		if($result)
		{
			$ret [''] ='--Pilih--';
			foreach ($result as $key => $row)
			{
				$ret [$row->nomor] = $row->nama.' '.$row->nomor;
			}
		}
		return $ret;
	}

}

/* End of file M_cmb.php */

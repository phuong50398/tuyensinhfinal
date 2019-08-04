<?php 	
	/**
	 * summary
	 */
	class Mxeplop extends MY_Model
	{
		public function get_sinhvien_chuaxeplop($arr_masv, $nganh) {
	    	$this->db->where('masv !=', "");
	    	$this->db->where('FK_sMaNganh', $nganh);
	    	$this->db->where_not_in('masv', $arr_masv);
	    	return $this->db->get('tbl_sinhvien')->result_array();
		}
	}
 ?>
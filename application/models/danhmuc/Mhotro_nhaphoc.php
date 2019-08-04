<?php 
 /**
  * summary
  */
 class Mhotro_nhaphoc extends MY_Model
 {

 	public function getToHop($sbd){
 		$this->db->select('tohop');
 		$this->db->where('tbl_sinhvien.soBD', $sbd);
 		$this->db->from('tbl_sinhvien');
 		$this->db->join('tbl_khoihoc', 'tbl_sinhvien.khoihoc = tbl_khoihoc.makhoi', 'inner');
 		return $this->db->get()->row_array();
 	}
 	public function getMon($tohop, $sbd){
 		$this->db->select($tohop, false);
 		$this->db->where('tbl_sinhvien.soBD', $sbd);
 		return $this->db->get('tbl_sinhvien')->row_array();
 	}

 }
 ?>
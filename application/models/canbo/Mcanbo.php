<?php 	
class Mcanbo extends MY_Model
{
	public function get_Khoa($manganh){
		$this->db->select('tenkhoa');
		$this->db->where('tbl_nganh.iMa_nganh', $manganh);
		$this->db->from('tbl_nganh');
		$this->db->join('dm_khoa', 'tbl_nganh.makhoa = dm_khoa.makhoa','inner');
		return $this->db->get()->row_array();
	}
	function getCB($ss, $pas)
	{
		$this->db->where('macb', $ss);
		$this->db->where('matkhau', sha1($pas));
		return $this->db->get('dm_canbo')->row_array();
	}
	function doiMk($ss, $pas)
	{
		$this->db->where('macb', $ss);
		$this->db->set('matkhau', sha1($pas));
		$this->db->update('dm_canbo');
		return $this->db->affected_rows();
	}

	function resetbuoctiep()
	{
		$this->db->set(array('buoctiep' => null, 'stt' => null));
		$this->db->update('tbl_sinhvien');

		$this->db->set(array('stt' => 0, 'goi' => 0));
		$this->db->update('tbl_goi');
		return $this->db->affected_rows();
	}
}
?>

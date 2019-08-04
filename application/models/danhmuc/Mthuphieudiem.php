<?php 	
class Mthuphieudiem extends MY_Model
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
	public function danhsach_thuphieudiem($ngaythu, $nguoithu, $thoigian){
		if($thoigian == 'sang')
		{
			$this->db->where('thoigian_thuphieudiem <', $ngaythu." 12:00:00");
			$this->db->where('thoigian_thuphieudiem >=', $ngaythu." 00:00:00");
		}
		if($thoigian == 'chieu')
		{
			$this->db->where('thoigian_thuphieudiem >=', $ngaythu." 12:00:00");
			$this->db->where('thoigian_thuphieudiem <=', $ngaythu." 23:59:59");
		}
		if($thoigian == 'cangay'){
			$this->db->like('thoigian_thuphieudiem', $ngaythu);
		}
		if($nguoithu != "all"){
			$this->db->where('nguoithu_phieudiem', $nguoithu);
		}else{
			$this->db->where('nguoithu_phieudiem !=',"");
		}
 		// $this->db->where('thoigian_thuphieudiem !=',"");
		return $this->db->get('tbl_sinhvien')->result_array();
	}
	public function danhsach_tragiaybao($ngaythu, $nguoithu, $thoigian){
		if($thoigian == 'sang')
		{
			$this->db->where('thoigian_tragiaybao <', $ngaythu." 12:00:00");
			$this->db->where('thoigian_tragiaybao >=', $ngaythu." 00:00:00");
		}
		if($thoigian == 'chieu')
		{
			$this->db->where('thoigian_tragiaybao >=', $ngaythu." 12:00:00");
			$this->db->where('thoigian_tragiaybao <=', $ngaythu." 23:59:59");
		}
		if($thoigian == 'cangay'){
			$this->db->like('thoigian_tragiaybao', $ngaythu);
		}
		if($nguoithu != "all"){
			$this->db->where('nguoitra_giaybao', $nguoithu);
		}else{
			$this->db->where('nguoitra_giaybao !=',"");
		}
		// $this->db->where('nguoitra_giaybao !=',"");
 		// return $this->db->get('tbl_sinhvien')->result_array();
		return $this->db->get('tbl_sinhvien')->result_array();
 		// pr($this->db->last_query());
	}
	public function dssv_thuphieudiem($date, $macb){
		$this->db->where('nguoithu_phieudiem ',$macb);
		$this->db->like('thoigian_thuphieudiem',$date);
		return $this->db->get('tbl_sinhvien')->result_array();
	}
	public function dssv_tragiaybao($date, $macb){
		$this->db->where('nguoitra_giaybao ',$macb);
		$this->db->like('thoigian_tragiaybao',$date);
		return $this->db->get('tbl_sinhvien')->result_array();
	}
	// public function hienthi_manhinh(){
	// 	$this->db->select('masv,hoten,ngaysinh,sohs_nh');
	// 	$this->db->order_by('thoigian_thuphieudiem', 'DESC');
	// 	$this->db->where('trangthai <',3);
	// 	$this->db->or_where('trangthai',null);
	// 	return $this->db->get('tbl_sinhvien')->result_array();
	// }
	public function getdssv_tragiaybao(){
		$this->db->where('trangthai <=',2);
		$this->db->or_where('trangthai >=',1);
		return $this->db->get('tbl_sinhvien')->result_array();
	}

	public function getSTT($ban){
		$this->db->select("max(tbl_goi.stt) + 1 as max");
		$this->db->where("ban", $ban);
		return $this->db->get('tbl_goi')->row_array();
		// $this->db->get('tbl_goi')->result_array();
	}
	public function getSTT5(){
		$this->db->select("max(tbl_goi.stt) + 1 as max");
		$this->db->where("ban", 'buoc5');
		return $this->db->get('tbl_goi')->row_array();
		// $this->db->get('tbl_goi')->result_array();
	}
	public function get_where_order_sv(){
		$this->db->where('buoctiep','buoc2');
		$this->db->order_by('stt','ASC');
		return $this->db->get('tbl_sinhvien')->result_array();
	}
	public function hienthi_manhinh(){
		$this->db->select('masv,hoten,ngaysinh,sohs_nh,stt');
		$this->db->order_by('stt', 'DESC');
		$this->db->where('trangthai <',3);
		$this->db->or_where('trangthai',null);
		return $this->db->get('tbl_sinhvien')->result_array();
	}
}
?>

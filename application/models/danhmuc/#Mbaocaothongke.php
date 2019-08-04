<?php 
 /**
  * summary
  */
 class Mbaocaothongke extends MY_Model
 {
 	// hùng
 	public function baocaothongke(){
 		$sql = "SELECT iMa_nganh,sTen_Nganh,
 		COUNT(tbl_sinhvien.FK_sMaNganh) AS tongsoluongtrungtuyen, 
 		COUNT(IF(tbl_sinhvien.trangthai=0,1,null)) AS tongsoluongdangky,
 		COUNT(IF(tbl_sinhvien.trangthai=2,1,null)) AS tongsoluongdatragiaybao,
 		COUNT(IF(tbl_sinhvien.trangthai=3,1,null)) AS tongsoluongdathuhoso,
 		COUNT(IF(tbl_sinhvien.trangthai=4,1,null)) AS tongsoluongdathuhocphi,
 		COUNT(IF(tbl_sinhvien.trangthai=5,1,null)) AS tongsoluongruthoso,
 		SUM(tbl_sinhvien.tongtien_dathu) AS tongsoluongtien
 		FROM tbl_nganh
 		LEFT JOIN tbl_sinhvien
 		ON tbl_nganh.iMa_nganh = tbl_sinhvien.FK_sMaNganh
 		GROUP BY sTen_Nganh";
 		$result = $this->db->query($sql);                      
		return $result->result_array();
 	}
 	public function baocaotheonganh($manganh,$trangthai){
 		$this->db->select('*');
 		$this->db->where('FK_sMaNganh',$manganh);
 		$this->db->where('trangthai',$trangthai);                    
		return $this->db->get('tbl_sinhvien')->result_array();
 	}
 	//Lấy danh sách sinh viên theo trạng thái nhập học
 	public function baocao($trangthai){
 		$this->db->select('*');
 		$this->db->where('trangthai',$trangthai);                    
		return $this->db->get('tbl_sinhvien')->result_array();
 	}
 	public function baocao_taichinh($nganh=null, $hocphi=null, $thoigian=null,$nguoithu=null,$type=null){
		if(!empty($nganh)){
			$this->db->where_in('FK_sMaNganh', $nganh);
 		}
 		if($type != "tatcathoigian")
 		{
 			if($type == 'sang' && $thoigian)
 			{
 				$this->db->where('thoigian_thuhs <',$thoigian." 12:00:00");
	 			$this->db->where('thoigian_thuhs >=',$thoigian." 00:00:00");
 			}
 			else if($type == 'chieu' && $thoigian)
 			{
	 			$this->db->where('thoigian_thuhs >=',$thoigian." 12:00:00");
	 			$this->db->where('thoigian_thuhs <=',$thoigian." 23:59:59");
 			}
 		}
 		if(!empty($hocphi)){
 			foreach ($hocphi as $key => $value) {
 				$this->db->like('hocphi', $value);
 			}
 		}
 		if(!empty($nguoithu)){
	 		$this->db->where('nguoithu_hocphi', $nguoithu);
	 	}

	 	$result =  $this->db->get('tbl_sinhvien')->result_array();
	 	return $result;
	 }
 	// lâm
 	public function get_Khoa($manganh){
 		$this->db->select('tenkhoa');
 		$this->db->where('tbl_nganh.iMa_nganh', $manganh);
 		$this->db->from('tbl_nganh');
 		$this->db->join('dm_khoa', 'tbl_nganh.makhoa = dm_khoa.makhoa','inner');
 		return $this->db->get()->row_array();
 	}
 }
 ?>
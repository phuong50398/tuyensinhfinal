<?php 
 /**
  * summary
  */
 class Mbaocaothongke extends MY_Model
 {
 	// lâm
 	public function baocaothongke($makhoa){
 		$this->db->select('tbl_nganh.iMa_nganh,tbl_nganh.sTen_Nganh,
 			COUNT(tbl_sinhvien.FK_sMaNganh) 										 AS tongsoluongtrungtuyen, 
 			COUNT(IF(tbl_sinhvien.trangthai=0,1,null)) 								 AS tongsoluongdangky,
 			COUNT(IF(tbl_sinhvien.trangthai=2 OR tbl_sinhvien.trangthai = 1,1,null)) AS tongsoluongdatragiaybao,
 			COUNT(IF(tbl_sinhvien.trangthai=3,1,null)) 				 				 AS tongsoluongdathuhoso,
 			COUNT(IF(tbl_sinhvien.trangthai=4,1,null)) 								 AS tongsoluongdathuhocphi,
 			COUNT(IF(tbl_sinhvien.trangthai=5,1,null)) 								 AS tongsoluongruthoso,
 			SUM(tbl_sinhvien.tongtien_dathu) AS tongsoluongtien');
 		$this->db->join('tbl_sinhvien', 'tbl_nganh.iMa_nganh = tbl_sinhvien.FK_sMaNganh', 'left');
 		$this->db->group_by('tbl_nganh.sTen_Nganh');
 		$this->db->order_by("tbl_sinhvien.masv");
 		if(!empty($makhoa)){
 			$this->db->where('makhoa', $makhoa);
 		}
 		return $this->db->get('tbl_nganh')->result_array();
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
 		$this->db->select('hocphi_sinhvien.masv,
 						   soBD,
 						   hoten,
 						   ngaysinh,
 						   gioitinh,
 						   CMND,
 						   FK_sMaNganh,
 						   sdt,
 						   hocphi_sinhvien.nguoithu_hocphi,
 						   hocphi_sinhvien.thoigian_thuhp,
 						   sohs_nh,
 						   hocphi_sinhvien.ghichu,
 						   tamthu_hp,
 						   tamthu_sk,
 						   tamthu_the,
 						   tamthu_yt,
 						   tamthu_tt1,
 						   tamthu_tt2,
 						   hocphi_sinhvien.hocphi,
 						   tongtien_thu,
 						   tongtien_dathu,
 						   soquyen,
 						   so');
 		if(!empty($nganh)){
 			$this->db->where_in('FK_sMaNganh', $nganh);
 		}
 		if($type != "tatcathoigian")
 		{
 			if($type == 'sang')
	 		{
				$this->db->where('thoigian_thuhp <', $thoigian." 12:00:00");
				$this->db->where('thoigian_thuhp >=', $thoigian." 00:00:00");
	 		}
	 		if($type == 'chieu')
			{
				$this->db->where('thoigian_thuhp >=', $thoigian." 12:00:00");
				$this->db->where('thoigian_thuhp <=', $thoigian." 23:59:59");
			}
	 		if($type == 'cangay'){
	 			$this->db->like('thoigian_thuhp', $thoigian);
	 		}
 		}
 		if(!empty($hocphi)){
 			foreach ($hocphi as $key => $value) {
 				$this->db->like('hocphi_sinhvien.hocphi', $value);
 			}
 		}
 		if(!empty($nguoithu)){
 			$this->db->where('hocphi_sinhvien.nguoithu_hocphi', $nguoithu);
 		}
 		$this->db->join('tbl_sinhvien','hocphi_sinhvien.masv = tbl_sinhvien.masv','inner');
 		$result =  $this->db->get('hocphi_sinhvien')->result_array();
 		// pr($this->db->last_query());
 		// $result =  $this->db->get('hocphi_sinhvien')->result_array();
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
 	// hùng
 	public function thongke_trangthainhaphoc($nganh,$trangthai){
 		$this->db->where('FK_sMaNganh',$nganh);
 		if($trangthai=='chuanhaphoc'){
 			$this->db->or_where('trangthai',null);
 			$this->db->where('trangthai <',4);
 		}
 		if($trangthai=='danhaphoc'){
 			$this->db->where('trangthai',4);
 		}
 		$result =  $this->db->get('tbl_sinhvien')->result_array();
 		// pr($this->db->last_query());
 		return $result;
 	}
 }
 ?>
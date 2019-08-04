<?php 
	/**
	 * summary
	 */
	class Mthutaichinh extends MY_Model
	{
		public function check_hp($masv, $hocphi){
			$this->db->where('masv', $masv);
			$this->db->where('hocphi', $hocphi);
			return $this->db->get('hocphi_sinhvien')->row_array();
		}
		 public function get_hocphi()
	    {
	        $this->db->order_by('stt','ASC');
	        return $this->db->get('tbl_hocphi')->result_array();
	    }
		public function delete_dshp($masv, $hocphi){
			$this->db->where('masv', $masv );
			$this->db->where('hocphi', $hocphi );
			$this->db->delete('hocphi_sinhvien');
			return $this->db->affected_rows();
		}
		public function get_Khoa($manganh){
			$this->db->select('tenkhoa');
			$this->db->where('tbl_nganh.iMa_nganh', $manganh);
			$this->db->from('tbl_nganh');
			$this->db->join('dm_khoa', 'tbl_nganh.makhoa = dm_khoa.makhoa','inner');
			return $this->db->get()->row_array();
		}
		public function get_dshpsv($masv){
			$this->db->select('hocphi');
			$this->db->where('masv', $masv);
			return $this->db->get('tbl_sinhvien')->row_array();
		}
		
		public function timKiemHTTC($hoten, $masv, $hienthi){
			if($masv !=''){
				$this->db->where('masv', $masv);
			}
			if($hoten !=''){
				$this->db->like('hoten', $hoten);
			}
			if($hienthi == 'all'){
				$this->db->where('trangthai >=',3);
			}else{
				if($hienthi != 4 && $hienthi != 3 ){
					$this->db->where('nguoithu_hocphi', $hienthi);
				}else{
					$this->db->where('trangthai', $hienthi);
				}
			}
			
			$this->db->order_by("SUBSTRING(`hoten`, CHAR_LENGTH(SUBSTRING_INDEX(`hoten`,' ',CHAR_LENGTH(`hoten`)- CHAR_LENGTH(REPLACE(`hoten`,' ','')))) + 1)");
			// $this->db->get('tbl_sinhvien')->result_array();
			return $this->db->get('tbl_sinhvien')->result_array();
			// pr($this->db->last_query());
		}
		public function update_hp($masv, $hocphi, $so){
			$this->db->where('masv', $masv);
			$this->db->where('hocphi', $hocphi);
			$this->db->set('so', $so);
			$this->db->update('hocphi_sinhvien');
			return $this->db->affected_rows();
		}
		function getThuHPTam($masv)
		{
			$this->db->select('sum(tamthu_hp1) as sum_tamthu_hp1,sum(tamthu_hp2) as sum_tamthu_hp2, sum(tamthu_sk) as sum_tamthu_sk, sum(tamthu_the) as sum_tamthu_the, sum(tamthu_yt) as sum_tamthu_yt, sum(tamthu_tt1) as sum_tamthu_tt1, sum(tamthu_tt2) as sum_tamthu_tt2 ');
			$this->db->where('masv', $masv);
			return $this->db->get('hocphi_sinhvien')->row_array();
		}
		function TongTienThu($gt, $hp)
		{
			$this->db->select('sum(giatri) as total');
			$this->db->where('mahp !=', $gt);
			$this->db->where('mahp !=', $hp);
			return $this->db->get('tbl_hocphi')->row_array();
		}
		public function getList($total, $start){
		 	$this->db->limit($total, $start);
		 	$this->db->where('buoctiep', 'buoc7');
		 	$this->db->order_by('stt');
		 // 	$this->db->where('trangthai >=',3);
			// $this->db->order_by("SUBSTRING(`hoten`, CHAR_LENGTH(SUBSTRING_INDEX(`hoten`,' ',CHAR_LENGTH(`hoten`)- CHAR_LENGTH(REPLACE(`hoten`,' ','')))) + 1)");
		 	$query = $this->db->get("tbl_sinhvien");
		 	return $query->result_array();
		}
		function get_where_orderasc($tbl, $col, $dk, $order)
		 {
		 	$this->db->where($col, $dk);
		 	$this->db->order_by($order);
		 	$query = $this->db->get($tbl);
		 	return $query->result_array();
		 }
		function goisv()
		 {
		 	// $this->db->where('ban','buoc7');
		 	// $buoc7 = $this->db->get('tbl_goi')->row_array();

		 	// $this->db->where('buoctiep','buoc7');
		 	// $this->db->where('stt',$buoc7['goi']+1);
		 	// $sinhvien =  $this->db->get('tbl_sinhvien')->result_array();
		 	// if(!empty($sinhvien[0])){
		 	// 	$this->db->where('ban','buoc7');
		 	// 	$this->db->set('goi', $buoc7['goi']+1);
		 	// 	$this->db->update('tbl_goi');
		 	// }
		 	// return $sinhvien;

		 	$sinhvien = [];
		 	while (1) {
		 	    $this->db->where('ban','buoc7');
			 	$buoc7 = $this->db->get('tbl_goi')->row_array();

			 	$this->db->where('buoctiep','buoc7');
			 	$this->db->where('stt',$buoc7['goi']+1);
			 	$sinhvien = $this->db->get('tbl_sinhvien')->result_array();
			 	if(!empty($sinhvien[0])){
			 		$this->db->where('ban','buoc7');
				 	$this->db->set('goi', $buoc7['goi']+1);
				 	$this->db->update('tbl_goi');
				 	break;
			 	}else{
			 		if($buoc7['stt']>$buoc7['goi']){
			 			$this->db->where('ban','buoc7');
				 		$this->db->set('goi', $buoc7['goi']+1);
				 		$this->db->update('tbl_goi');
			 		}else{
			 			break;
			 		}
			 	}
		 	}
		 	
			return $sinhvien;
		 }
	}
 ?>
<?php 
	/**
	 * summary
	 */
	class Mthuhoso_nhaphoc extends MY_MODEL
	{
	    /**
	     * summary
	     */
	    public function get_hoso()
	    {
	        $this->db->order_by('stt','ASC');
	        return $this->db->get('tbl_hoso')->result_array();
	    }
	    public function getDiemChuanSV($makhoi , $manganh){
			$this->db->select('diemchuan');
			$this->db->where('makhoi', $makhoi );
			$this->db->where('manganh', $manganh);
			return $this->db->get('tbl_diemchuan')->row_array();
		}
		public function check_hs($sobd, $hoso){
			$this->db->where('soBD', $sobd);
			$this->db->where('hoso', $hoso);
			return $this->db->get('hoso_sinhvien')->row_array();
		}
		public function get_Khoa($manganh){
			$this->db->select('tenkhoa');
			$this->db->where('tbl_nganh.iMa_nganh', $manganh);
			$this->db->from('tbl_nganh');
			$this->db->join('dm_khoa', 'tbl_nganh.makhoa = dm_khoa.makhoa','inner');
			return $this->db->get()->row_array();
		}
		public function delete_dshs($sbd, $hoso){
			$this->db->where('soBD', $sbd );
			$this->db->where('hoso', $hoso );
			$this->db->delete('hoso_sinhvien');
			return $this->db->affected_rows();
		}
		// tìm kiếm tên người thu hồ sơ
		public function timkiem_hoso($hoso, $sbd){
			$this->db->where('soBD', $sbd );
			$this->db->like('hoso', $hoso);
			return $this->db->get('hoso_sinhvien')->row_array();
		}
		public function timKiemthongtin($hoten, $sbd, $nguoithu, $hienthi){
			if($sbd !=''){
				$this->db->like('soBD', $sbd);
			}
			if($nguoithu !=''){
				$this->db->like('nguoithuhs', $nguoithu);
			}
			if($hoten !=''){
				$this->db->like('hoten', $hoten);
			}
			if($hienthi != 'all'){
				if($hienthi != '' && $hienthi < 3){
					$this->db->where('trangthai', $hienthi);
				}else{
					$this->db->where('trangthai >=', $hienthi);
				}

			}else{
				$this->db->where('trangthai >=', 2);
			}
			$this->db->order_by("SUBSTRING(`hoten`, CHAR_LENGTH(SUBSTRING_INDEX(`hoten`,' ',CHAR_LENGTH(`hoten`)- CHAR_LENGTH(REPLACE(`hoten`,' ','')))) + 1)");
			// $this->db->get('tbl_sinhvien')->result_array();
			return $this->db->get('tbl_sinhvien')->result_array();
			// pr($this->db->last_query());
		}
		public function renderMSV($masv){
			$this->db->select("max(SUBSTRING(masv, 8, 4))*1.0 as maxx");
			$this->db->like("masv", $masv,'after');
			return $this->db->get('tbl_sinhvien')->result_array();
		}
		 public function getList($total, $start){
		 	$this->db->limit($total, $start);
		 	$this->db->where('buoctiep', 'buoc5');
		 	$this->db->order_by('stt');
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
		 	$sinhvien = [];
		 	while (1) {
		 	    $this->db->where('ban','buoc5');
			 	$buoc5 = $this->db->get('tbl_goi')->row_array();

			 	$this->db->where('buoctiep','buoc5');
			 	$this->db->where('stt',$buoc5['goi']+1);
			 	$sinhvien = $this->db->get('tbl_sinhvien')->result_array();
			 	if(!empty($sinhvien[0])){
			 		$this->db->where('ban','buoc5');
				 	$this->db->set('goi', $buoc5['goi']+1);
				 	$this->db->update('tbl_goi');
				 	break;
			 	}else{
			 		if($buoc5['stt']>$buoc5['goi']){
			 			$this->db->where('ban','buoc5');
				 		$this->db->set('goi', $buoc5['goi']+1);
				 		$this->db->update('tbl_goi');
			 		}else{
			 			break;
			 		}
			 	}
		 	}
		 	
			return $sinhvien;
		 	
		 }
		 public function getSTT7(){
			$this->db->select("max(tbl_goi.stt) + 1 as max");
			$this->db->where("ban", 'buoc7');
			return $this->db->get('tbl_goi')->row_array();
			// $this->db->get('tbl_goi')->result_array();
		}
		function sv_nganh($sbd)
		{
			$this->db->where('soBD', $sbd);
			$this->db->join('tbl_nganh as n', 'sv.FK_sMaNganh = n.iMa_nganh');
			return $this->db->get('tbl_sinhvien as sv')->row_array();
		}
	}
 ?>
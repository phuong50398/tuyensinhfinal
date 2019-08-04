<?php 
	/**
	 * summary
	 */
	class Mdkttsv extends MY_Model
	{
		public function getToHop($makhoi){
			$this->db->select('tohop');
			$this->db->where('makhoi', $makhoi);
			return $this->db->get('tbl_khoihoc')->row_array();
		}
		public function getDiemToHop($sobd, $tohop){
			$this->db->select($tohop, false);
			$this->db->where('soBD', $sobd);
			return $this->db->get('tbl_sinhvien')->row_array();
		}
		public function get_hoso($soBD){
			$this->db->select('tbl_nganh.hoso');
			$this->db->where('tbl_sinhvien.soBD', $soBD);
			$this->db->from('tbl_sinhvien');
			$this->db->join('tbl_nganh','tbl_nganh.iMa_nganh = tbl_sinhvien.FK_sMaNganh');
			return $this->db->get()->row_array();
		}
		public function timKiemHTTC($hoten, $sbd, $nguoithu, $hienthi){
			if($sbd !=''){
				$this->db->where('soBD', $sbd);
			}
			if($nguoithu !=''){
				$this->db->where('nguoithuhs', $nguoithu);
			}
			if($hoten !=''){
				$this->db->where('hoten', $hoten);
			}
			if($hienthi != 'all'){
				if($hienthi != ''){
					$this->db->where('trangthai', $hienthi);
				}else{
				}
			}
			return $this->db->get('tbl_sinhvien')->result_array();
		}
		
	
		public function check_hs($sbd, $hs){
			$this->db->where('soBD', $sbd );
			$this->db->where('hoso', $hs);
			return $this->db->get('hoso_sinhvien')->result_array();
		}
		
		public function dshs_dot(){
			$this->db->from('hoso_sinhvien');
			$this->db->join('dm_dot', 'hoso_sinhvien.madot = dm_dot.id', 'inner');
			return $this->db->get()->result_array();
		}
		
		public function get_dshssv($sobd){
			$this->db->select('hoso');
			$this->db->where('soBD', $sobd);
			return $this->db->get('tbl_sinhvien')->row_array();
		}
		
		public function dshs_dot_sv($sobd){
			$this->db->where('hoso_sinhvien.soBD', $sobd);
			$this->db->where('dm_dot.trangthai',"");
			$this->db->from('hoso_sinhvien');
			$this->db->join('dm_dot', 'hoso_sinhvien.madot = dm_dot.id', 'inner');
			return $this->db->get()->result_array();
		}
	}
?>
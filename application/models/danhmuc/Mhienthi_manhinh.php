<?php 
	/**
	 * summary
	 */
	class Mhienthi_manhinh extends CI_Model
	{
		public function hienthi_manhinh(){
			$this->db->select('masv,hoten,ngaysinh,sohs_nh,stt,buoctiep');
			$this->db->order_by('stt', 'DESC');
			$this->db->where('buoctiep','buoc2');
			return $this->db->get('tbl_sinhvien')->result_array();
		}
		public function manhinh_thuhoso(){
			$this->db->select('masv,hoten,ngaysinh,sohs_nh,stt,buoctiep');
			$this->db->order_by('stt', 'DESC');
			$this->db->where('buoctiep','buoc5');
			return $this->db->get('tbl_sinhvien')->result_array();
		}
		public function manhinh_thutaichinh(){
			$this->db->select('masv,hoten,ngaysinh,sohs_nh,stt,buoctiep');
			$this->db->order_by('stt', 'DESC');
			$this->db->where('buoctiep','buoc7');
			return $this->db->get('tbl_sinhvien')->result_array();
		}
	}
	?>
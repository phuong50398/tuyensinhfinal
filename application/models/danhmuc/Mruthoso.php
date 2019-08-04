<?php 
	/**
	 * summary
	 */
	class Mruthoso extends MY_Model
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
		public function hocphi_dadong($masinhvien){
			$this->db->select(' masv,tongtien_thu, sum(`tamthu_hp1`)AS hp1, SUM(`tamthu_hp2`)as hp2 , SUM(`tamthu_sk`)  as sk, SUM(`tamthu_the`)  as the, SUM(`tamthu_yt`)  as yt, SUM(`tamthu_tt1` )as tt1, SUM(`tamthu_tt2`)  as tt2');
			$this->db->where('hocphi_sinhvien.masv', $masinhvien);
			$this->db->from('hocphi_sinhvien');
			$this->db->group_by('masv');
			return $this->db->get()->row_array();
		}
		public function getdata_sinhvien($sobaodanh){
			$this->db->select('tbl_sinhvien.*, ruthoso_sinhvien.hp1_tra ,ruthoso_sinhvien.hp2_tra, ruthoso_sinhvien.sk_tra, ruthoso_sinhvien.sk_tra, ruthoso_sinhvien.yt_tra, ruthoso_sinhvien.tt1_tra, ruthoso_sinhvien.tt2_tra, ruthoso_sinhvien.tongtra, ruthoso_sinhvien.hp1_con, ruthoso_sinhvien.hp2_con, ruthoso_sinhvien.hp2_con, ruthoso_sinhvien.the_con, ruthoso_sinhvien.yt_con, ruthoso_sinhvien.tt1_con, ruthoso_sinhvien.tt1_con, ruthoso_sinhvien.tongcon,ruthoso_sinhvien.nguoi_ruthoso,ruthoso_sinhvien.thoigian_ruthoso,ruthoso_sinhvien.the_tra,ruthoso_sinhvien.sk_con,ruthoso_sinhvien.tt2_con');
			$this->db->where('tbl_sinhvien.soBD',$sobaodanh);
			$this->db->join('ruthoso_sinhvien', 'tbl_sinhvien.soBD = ruthoso_sinhvien.soBD', 'left');
 		// $this->db->get('tbl_sinhvien');
 		// pr($this->db->last_query());
			return $this->db->get('tbl_sinhvien')->result_array();
		}
	}
	?>
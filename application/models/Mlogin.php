<?php 
 /**
  * summary
  */
 class Mlogin extends MY_Model
 {
     /**
      * summary
      */
     public function check_user($taikhoan, $matkhau){
        $this->db->from('dm_canbo');
        $this->db->where('macb', $taikhoan);
        $kt = $this->db->get()->row_array();
        if($kt){
            $this->db->where('macb', $taikhoan);
            $this->db->where('matkhau', sha1($matkhau));
            return $this->db->get('dm_canbo')->row_array();
        }else{
            $this->db->where('soBD', $taikhoan);
            $this->db->where('CMND', $matkhau);
            return $this->db->get('tbl_sinhvien')->row_array();
        }
     }
     public function check_exit($taikhoan){
        $this->db->from('dm_canbo');
        $this->db->where('macb', $taikhoan);
        $kt = $this->db->get()->row_array();
        if($kt){
            $this->db->where('macb', $taikhoan);
            // $this->db->where('matkhau', sha1($matkhau));
            return $this->db->get('dm_canbo')->row_array();
        }else{
            $this->db->where('soBD', $taikhoan);
            // $this->db->where('CMND', $matkhau);
            return $this->db->get('tbl_sinhvien')->row_array();
        }
     }
     public function checkPermission($maquyen, $segment){
          if($maquyen==1){
            return true;
          }else{
            $this->db->where('tbl_chucnang.sRoute', $segment);
            $this->db->where('tbl_chucnang.iMaQuyen', $maquyen);
            $this->db->from('tbl_chucnang');
            $result =  $this->db->get()->num_rows();
            return $result > 0 ? true : false;
          }
    }
 }
 ?>
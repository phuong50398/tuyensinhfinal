<?php 
class Cprint_hp extends CI_Controller
	{
	    /**
	     * summary
	     */
	    public function __construct()
	    {
	        parent::__construct();
	        $this->load->model('danhmuc/Mthutaichinh');
	    }
	    public function index(){
	    	$danhmuc 		= $this->getDanhmuc();
			$dstenhocphi    = $this->dstenhocphi();
			$session    	= $this->session->userdata('user');
			if($this->input->get('in_hoadon')){
	    		$this->in_hoadon($danhmuc, $session,  $dstenhocphi);
	    	}
	    }
	    public function in_hoadon($danhmuc, $session, $dstenhocphi){
	    	$masv    		= $this->input->get('in_hoadon');
	    	$title_hp 		= $this->Mthutaichinh->hocphi();
	    	$sinhvien 		= $this->Mthutaichinh->get_where_row('tbl_sinhvien', 'masv', $masv);
	    	// $msr       		= $this->save_checkedHP($masv, $session, $danhmuc);

	    	$title_quyen    = $this->Mthutaichinh->get_where_row('dm_canbo','macb', $session['macb']);
	    	$so = $title_quyen['so'] + 1;
	    	$update_quyenso = $this->Mthutaichinh->update_set('dm_canbo', 'macb', $session['macb'], array('so' => $title_quyen['so'] + 1));
	    	// if($msr['msr'] == 1){
	    	// 	$check_hp = $msr['hocphi'];
	    	// 	$tongtien = $msr['tongtien'];
	    	// }
	    	// foreach ($check_hp as $value) {
	    	// 	$arr[$value] = $value;
	    	// 	$arr_name[]  = $dstenhocphi['dsten_hp1'][$value];
	    	// 	$name_hp     = implode(",",$arr_name);
	    	// }
	    	// if(count($arr_name) > 3){
	    	// 	$name_hp = $arr_name[0].",".$arr_name[1].",".$arr_name[2]."...";
	    	// }else{
	    	// 	$name_hp = $name_hp;
	    	// }
	    	// $arr = array(
	    	// 	'tongtien_chu' => $this->VndText($tongtien),
	    	// 	'tongtien_so'  => number_format($tongtien,0, ',', ','),
	    	// );
	    	$update_quyenso = $this->Mthutaichinh->update_hp($masv, implode(",", $check_hp), $title_quyen['so']);

	    	$data = array(
	    		'danhmuc'	   		=> $danhmuc,
	    		'sinhvien_in'  		=> $sinhvien,
	    		'title_hp'     		=> $title_hp,
	    		'session'      		=> $session,
	    		'hpsv'              => $name_hp,
	    		'dstenhocphi'       => $dstenhocphi,
	    		'tongtien'          => $arr,
	    		'title_quyen'           => $title_quyen
	    	);
	    	$this->parser->parse('giayto/Vphieuthuhocphi', $data);
	    }
	    // public function save_checkedHP($masv, $session, $danhmuc){
	    // 	    $data = $this->input->post('data');
	    // 	    if(isset($data['tt1'])){
	    // 	    	$tamthu_tt1 = str_replace(",","", $data['tt1']);
	    // 	    }else{
	    // 	    	$tamthu_tt1 = 0;
	    // 	    }
	    // 	    if(isset($data['tt2'])){
	    // 	    	$tamthu_tt2 = str_replace(",","", $data['tt2']);
	    // 	    }else{
	    // 	    	$tamthu_tt2 = 0;
	    // 	    }
	    // 		foreach ($data as $key => $value) {
					// 	$arr[] = $key;
	    // 		}
	    // 		$tongtien = str_replace(",","", $this->input->post('tongtien'));
	    // 	    $hocphi = array(
	    // 	    	'tamthu_hp'  	   => str_replace(",","", $data['hp']),
	    // 	    	'tamthu_sk'  	   => str_replace(",","", $data['sk']),
	    // 	    	'tamthu_the' 	   => str_replace(",","", $data['the']),
	    // 	    	'tamthu_yt'  	   => str_replace(",","", $data['yt']),
	    // 	    	'tamthu_tt1' 	   => $tamthu_tt1 ,
	    // 	    	'tamthu_tt2' 	   => $tamthu_tt2 ,
	    // 	    	'masv' 			   => $masv,
	    // 			'hocphi' 		   => implode(",", $arr),
	    // 			'nguoithu_hocphi'  => $session['macb'],
	    // 			'thoigian_thuhp'   => date('Y/m/d H:i:s'),
	    // 			'tongtien_thu'	   => $tongtien,
	    // 			'ghichu'           => 'Người thu tiền Ngân hàng - '.$session['nguoithutien'],
	    // 	    );
	    // 		$data_sv = array(
	    // 			'hocphi'			 => $hocphi['hocphi'],
	    // 			'nguoithu_hocphi'    => $session['macb'],
	    // 			'nguoithuhp_nh'      => $session['nguoithutien'],
	    // 			'thoigian_hocphi'    => $hocphi['thoigian_thuhp'],
	    // 			'trangthai'          => 4, // đã thu tiền,
	    // 			'tongtien_dathu'     => $tongtien,
	    // 		);
	    // 	    $row 		     = $this->Mthutaichinh->insert('hocphi_sinhvien', $hocphi);

	    // 		$noihp = $this->Mthutaichinh->get_where('hocphi_sinhvien', 'masv', $hocphi['masv']);
		   //  	if(count($noihp) > 0){
		   //  		$tongtien = 0;
	    // 			foreach ($noihp as $key => $value) {
	    // 				if($key != 0){
	    // 					$noihp[0]['hocphi'] .= ','. $value['hocphi'];
	    // 				}
	    // 				$tongtien = $tongtien + $value['tongtien_thu'];
	    // 			}
	    // 			$noihp 	= array_unique(explode(",", $noihp[0]['hocphi']));
	    // 			$noihp  = implode(",", $noihp);
	    // 			$data_sv['hocphi'] 	       = $noihp;
			  //   	$data_sv['tongtien_dathu'] = $tongtien;
	    // 			$row_sv  = $this->Mthutaichinh->update_set('tbl_sinhvien','masv', $masv, $data_sv);
	    // 		}else{
	    // 			$row_sv = $this->Mthutaichinh->update_set('tbl_sinhvien','masv', $masv, $data_sv);
	    // 		}
	    // 		if($row > 0 && $row_sv > 0){
	    // 			$msr = array(
	    // 				'hocphi'   => $arr,
	    // 				'msr'      => 1,
	    // 				'tongtien' => $tongtien,
	    // 			);
	    // 		}else{
	    // 			$msr = 0; // lỗi
	    // 		}
	    // 		return $msr;
	    // }
	    public function getDanhmuc(){
	    	$nganh 			= $this->Mthutaichinh->get('tbl_nganh');
	    	$dantoc 		= $this->Mthutaichinh->get('dm_dantoc');
	    	$tongiao 		= $this->Mthutaichinh->get('dm_tongiao');
	    	$hoso           = $this->Mthutaichinh->get('tbl_hoso');
	    	$canbo          = $this->Mthutaichinh->get('dm_canbo');
	    	$data['hocphi'] = $this->Mthutaichinh->get_hocphi();
	    	$sum            = 0 ;
	    	$sum1            = 0 ;
	    	foreach ($data['hocphi'] as $value) {
	    		if($value['mahp'] != 'tt1'){
	    			$sum = $sum + $value['giatri'];
	    		}
	    		if($value['mahp'] != 'tt2'){
	    			$sum1 = $sum1 + $value['giatri'];
	    		}
	    	}
	    	$data['tongtienhp5nam'] = $sum; // tính  tổng tiền học phí 5 năm đối với các ngành 5 năm và ngược lại 4 năm
	    	$data['tongtienhp4nam'] = $sum1;
	    	foreach ($canbo as $value) {
	    		$data['canbo'][$value['macb']] = $value['tencb'];
	    		$data['soquyen'][$value['macb']] = $value['soquyen'];
	    	}
	    	foreach ($tongiao as $value) {
	    		$data['tongiao'][$value['madm_tongiao']] = $value['ten_tongiao'];
	    	}
	    	foreach ($dantoc as $value) {
	    		$data['dantoc'][$value['iMaDT']] = $value['sTenDT'];
	    	}
	    	foreach ($nganh as $value) {
	    		$data['nganh'][$value['iMa_nganh']] = $value['sTen_Nganh'];
	    		$data['khoa'][$value['iMa_nganh']]  = $this->Mthutaichinh->get_Khoa($value['iMa_nganh']) ;
	    	}
	    	return $data;
	    }
	    public function dstenhocphi(){
	    	$dsten_hp1 			= array(
	    		'hp'   => ' Học phí tạm thu kì I năm học '.date('Y')."-".(date('Y')+1),
	    		'sk'   => ' Khám sức khỏe',
	    		'the'  => ' Thẻ thư viện',
	    		'tt1'  => ' Bảo hiểm thân thể',
	    		'tt2'  => ' Bảo hiểm thân thể',
	    		'yt'   => ' Bảo hiểm y tế',
	    	);
	    	$dsten_hp2 			= array(
	    		'hp'   => ' Học phí tạm thu',
	    		'sk'   => ' Khám sức khỏe',
	    		'the'  => ' Thẻ thư viện',
	    		'tt1'  => ' Bảo hiểm thân thể',
	    		'tt2'  => ' Bảo hiểm thân thể',
	    		'yt'   => ' Bảo hiểm y tế',
	    	);
	    	$data = array(
	    		'dsten_hp1'  => $dsten_hp1,
	    		'dsten_hp2'  => $dsten_hp2,
	    	);
 	    	return $data;
	    }
	}
?>
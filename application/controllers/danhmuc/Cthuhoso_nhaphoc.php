<?php 
	/**
	 * summary
	 */
	class Cthuhoso_nhaphoc extends MY_Controller
	{
	    /**
	     * summary
	     */
	    public function __construct()
	    {
	    	date_default_timezone_set("Asia/Ho_Chi_Minh");
	        parent::__construct();
	        $this->load->Model('danhmuc/Mdkttsv');
	        $this->load->Model('danhmuc/Mthuhoso_nhaphoc');
	    }
	    public function index(){
	    	$danhmuc 		= $this->getDanhmuc();
	    	$session    	= $this->session->userdata('user');
	    	// $sinhvien   	= $this->Mdkttsv->get_where('tbl_sinhvien','trangthai >=',2);
	    	$data['dssv']   = $this->Mthuhoso_nhaphoc->get_where_orderasc('tbl_sinhvien','buoctiep', 'buoc5','stt');
	    	// phân trang
			$start = 0;
			$limit = 50;
			$data['stt'] = 1;
			if ($this->input->get('page')) {
			$data['page'] = $this->input->get('page');
			$start = ($data['page']-1) * $limit;
			if($start ==0){
			$data['stt'] = 1;
			}else{
			$data['stt'] = $start + 1;
			}
			}
			else{
			$data['page'] = 1;
			}
			$sum_record 				 = count($data['dssv']);
			$data['total_page'] 		 = CEIL($sum_record/$limit);
			$sinhvien 				     = $this->Mthuhoso_nhaphoc->getList($limit,$start);
			// end phân trang
	    	$dsten_hs 		= $this->dstenhoso();
	    	$ds_titleHS 	= $this->dsHS();
	    	$dshs_sinhvien 	= $this->getDSHS_Check();
	    	$tk_sinhvien 	= array();
	    	$chitiet_hssv   = array();
	    	if($this->input->post('timkiem-httc')){
	    		$tk_sinhvien = $this->timkiem();
	    	}
	    	$goi = '';
	    	$soban = '';
	    	if($this->input->get('soban')){
	    		$soban = $this->input->get('soban');
	    		$array = array(
	    			'soban' => $soban
	    		);
	    		
	    		$this->session->set_userdata( $array );
	    		// pr($this->session->userdata('soban'));
	    		$sinhvien = $this->Mthuhoso_nhaphoc->goisv();
	    	
	    		if(empty($sinhvien[0])){
	    			setMessages('warning','Đã hết sinh viên trong danh sách chờ gọi','Thông báo');
	    		}
	    		return redirect('Thu-ho-so?sbd='.$sinhvien[0]['soBD'].'&goisv=goisv');
	    		
	    	}
	    	if($this->input->get('sbd')){
	    		$sbd = $this->input->get('sbd');
	    		$sinhvien = $this->Mthuhoso_nhaphoc->get_where('tbl_sinhvien','soBD', $sbd);
	    	}
	    	if($this->input->get('goisv')){
	    		$goi = $sinhvien;
	    	}

	    	foreach ($sinhvien as $value) {
	    		$dscheck_hs[$value['soBD']] = $this->Mdkttsv->get_dshssv($value['soBD']);
	    		$chitiet_hssv[$value['soBD']] = $this->Mthuhoso_nhaphoc->get_where('hoso_sinhvien', 'soBD', $value['soBD']); 
	    	}
	    	$arr = array();
	    	foreach ($chitiet_hssv as $key => $value) {
	    		if(!empty($value)){
	    			foreach ($value as $k => $v) {
	    				if(!empty($v['hoso'])){
		    				$v['hoso'] = explode(",", $v['hoso']);
		    				$value[$k] = $v;
	    				}
	     			}
	    			$chitiet_hssv[$key] = $value;
	    		}else {
	    			$arr[$key] = array();
	    		}
	    	}
	    	if($this->input->post('inhoso')){
	    		$this->inhoso($session, $danhmuc, $dsten_hs);
	    		return;
	    	}
	    	if($this->input->get('giaycamdoan')){
	    		$this->ingiay_camdoan($dsten_hs, $danhmuc);
	    		return;
	    	}
	    	if($this->input->get('inkytucxa')){
	    		$this->kytucxa($dsten_hs, $danhmuc);
	    		return;
	    	}
	    	if($this->input->post('inct_hoso')){
	    		$this->inct_hoso($session, $danhmuc, $dsten_hs);
	    		return;
	    	}
	    	if($this->input->post('inallhs')){
	    		$this->in_allHS($session, $danhmuc, $dsten_hs);
	    		return;
	    	}
	    	if($this->input->post('huyhs')){
	    		$this->huyhs();
	    	}

	    	if($this->input->post('chuyentiep')){
	    		$this->chuyentiep();
	    	}


	    	$temp = array(
				'template' => 'danhmuc/Vthuhoso_nhaphoc',
				'data' => array(
					'message'  		 => getMessages(),
					'sinhvien' 		 => $sinhvien,
					'danhmuc'        => $danhmuc,
					'ds_titleHS'     => $ds_titleHS,
					'dshs_sinhvien'  => $dshs_sinhvien,
					'tk_sinhvien'    => $tk_sinhvien,
					'dsten_hs'		 => $dsten_hs,
					'chitiet_hssv'   => $chitiet_hssv,
					'total_page'     => $data['total_page'],
					'page'           => $data['page'],
					'stt'			 => $data['stt'],
					'goi'			 => $goi,
					'soban'			 => $this->session->userdata('soban')
   				),
			);
        	$this->load->view('layout/content', $temp);
	    }

	    function chuyentiep()
	    {
	    	$sobaodanh = $this->input->post('chuyentiep');
	    	$info 			 = $this->Mthuhoso_nhaphoc->get_where_row('tbl_sinhvien','soBD',$sobaodanh);
	    	// $explode         = explode("-", $info['sohs_nh']);
	    	// $ban 			 = 'ban'. substr($explode[0],1);
	    	$getSTT          = $this->Mthuhoso_nhaphoc->getSTT7();
	    	$stt 			 = $getSTT['max'];
	    	$tbl_goi = array(
	    		'stt' => $stt,
	    	);
	    	$data = array(
	    		'buoctiep' => 'buoc7',
	    		'stt' =>  $stt,
	    	);
	    	$row = $this->Mthuhoso_nhaphoc->update_set('tbl_goi','ban','buoc7',  $tbl_goi);
	    	$row = $this->Mthuhoso_nhaphoc->update_set(' tbl_sinhvien', 'soBD', $sobaodanh, $data);
	    	if(empty($info['masv'])){
    			$row_sv = $this->Mthuhoso_nhaphoc->update_set('tbl_sinhvien','soBD', $sobaodanh, array('masv' => $this->renderMSV($sobaodanh)));
    			// if()
    		}
	    	setMessages('warning','<p>Bạn vừa chuyển tiếp sinh viên đến bước Thu tài chính</p><p>Họ tên: '.$info['hoten'] .'</p><p> STT: '.$stt .'</p>',
	    		'Thông báo');
	   		return redirect('Thu-ho-so');
	    }
	    // hủy hồ sơ 
	    
	    public function huyhs(){
	    	$value = $this->input->post('huyhs');
	    	$soBD     = strstr($value, '_', true);
	    	$id_hs    = substr($value,strlen($soBD) + 1);
	    	$sinhvien = $this->Mthuhoso_nhaphoc->get_where_row('tbl_sinhvien', 'soBD', $soBD);

	    	$row1 = $this->Mthuhoso_nhaphoc->delete_many_where('hoso_sinhvien',array('soBD' => $soBD, 'id' => $id_hs));
	    	$hososv =	$this->Mthuhoso_nhaphoc->get_many_where('hoso_sinhvien',array('soBD' => $soBD, 'hoso!=' => ""));
	    	if(count($hososv) > 0){
	    		foreach ($hososv as $key => $value) {
	    			if($key != 0){
	    				$hososv[0]['hoso'] .= "," .$value['hoso'];
	    			}
	    		}
	    	}
	    	if(empty($hososv)){
	    		$data = array(
	    			'hoso'         	 => NULL,
	    			'nguoithuhs'   	 => NULL,
	    			'thoigian_thuhs' => NULL
	    		);
	    		if($sinhvien['trangthai'] < 4){
	    			$data['trangthai'] = 2;
	    		}
	    		$row  = $this->Mthuhoso_nhaphoc->update_set('tbl_sinhvien','soBD', $soBD, $data);
	    	}else{
		    	$dshs = $hososv[0]['hoso'];
		   		$data = array(
	    			'hoso'  => $dshs,
	    		);
		   		$row  = $this->Mthuhoso_nhaphoc->update_set('tbl_sinhvien','soBD', $soBD, $data);
	    	}
	   		if($row > 0){
	   			setMessages('success','Hủy hồ sơ thành công','Thông báo');
	   			return redirect('Thu-ho-so');
	   		}else{
	   			setMessages('error','Hủy hồ sơ thất bại','Thông báo');
	   			return redirect('Thu-ho-so');
	   		}
	    } 
	    
		//in giấy cam đoan sinh viên
	    public function ingiay_camdoan($dsten_hs, $danhmuc){
	    	$session        = $this->session->userdata('user');
	    	$hoso           = $this->Mthuhoso_nhaphoc->get('tbl_hoso');
	    	$sobd        	= $this->input->get('giaycamdoan');
	    	$sinhvien 		= $this->Mthuhoso_nhaphoc->get_where_row('tbl_sinhvien', 'soBD', $sobd);
	    	$data 			= array(
	    		'soBD'					   => $sobd,
	    		'nguoithu_giaycamdoan'     => $session['macb'],
	    		'thoigian_thugiaycamdoan'  => date('d/m/Y H:i:s'),
	    	);
	    	$check_sv = $this->Mthuhoso_nhaphoc->get_where('hoso_sinhvien', 'soBD', $sobd);
    		$row_sv   = $this->Mthuhoso_nhaphoc->insert('hoso_sinhvien',$data);
	    	if(empty($sinhvien['masv'])){
    			$row_sv = $this->Mthuhoso_nhaphoc->update_set('tbl_sinhvien','soBD', $sobd, array('masv' => $this->renderMSV($sobd)));
    			// if()
    		}
    		if($sinhvien['trangthai'] < 4){
    			$data_sv['trangthai'] = 3;
	    		$row_sv = $this->Mthuhoso_nhaphoc->update_set('tbl_sinhvien','soBD', $sobd, $data_sv);
    		}
    		$sinhvien 		= $this->Mthuhoso_nhaphoc->get_where_row('tbl_sinhvien', 'soBD', $sobd);
	    	$data = array(
	    		'sinhvien_in'  => $sinhvien,
	    		'hoso'		   => $hoso,
	    		'dshs'		   => $dsten_hs,
	    		'danhmuc'      => $danhmuc,
	    	);
	    	$this->parser->parse('giayto/Vgiaycamdoan', $data);
	    }
	     public function kytucxa($dsten_hs, $danhmuc){
	    	$sobd        	= $this->input->get('inkytucxa');
	    	$sinhvien 		= $this->Mthuhoso_nhaphoc->sv_nganh($sobd);
    		if(empty($info['masv'])){
    			$row_sv = $this->Mthuhoso_nhaphoc->update_set('tbl_sinhvien','soBD', $sobd, array('masv' => $this->renderMSV($sobd)));
    			// if()
    		}
	    	$data = array(
	    		'sinhvien'  => $sinhvien
	    	);
	    	$this->parser->parse('danhmuc/VDonXinKTX', $data);
	    }
	    public function inhoso($session, $danhmuc, $dsten_hs){
	    	$sobd     		= $this->input->post('inhoso');
	    	$sinhvien 		= $this->Mthuhoso_nhaphoc->get_where_row('tbl_sinhvien', 'soBD', $sobd);
	    	
	    	$diemchuan 		= $this->Mthuhoso_nhaphoc->getDiemChuanSV($sinhvien['khoihoc'], $sinhvien['FK_sMaNganh']);
	    	//lưu hồ sơ !
	    	if(empty($sinhvien['masv'])){
	    		$row_sv = $this->Mthuhoso_nhaphoc->update_set('tbl_sinhvien','soBD', $sobd, array('masv' => $this->renderMSV($sobd)));
	    	}
	    	$dscheck_hs = $this->input->post('check_hs_'.$sobd);
	    	if($dscheck_hs != NULL){
	    		$this->save_checkedHS($sobd, $session);
	    	}else{
	    		$sinhvien 		= $this->Mthuhoso_nhaphoc->get_where_row('tbl_sinhvien', 'soBD', $sobd);
	    		if(!empty($sinhvien['hoso'])){
	    			pr('Hồ sơ không được để trống xin mời bạn chọn hồ sơ!');
	    		}else{
	    			$data 			= array(
			    		'soBD'			     => $sobd,
			    		'nguoithu_hoso'      => $session['macb'],
			    		'thoigian_thuhs'     => date('Y/m/d H:i:s'),
			    		'ghichu'             => 'Không tích hồ sơ nào!',
			    	);
			    	$this->Mthuhoso_nhaphoc->insert('hoso_sinhvien', $data);
	    			if($sinhvien['trangthai'] < 4){
	    				$data_sv['trangthai'] = 3;
	    				$row_sv = $this->Mthuhoso_nhaphoc->update_set('tbl_sinhvien','soBD', $sobd, $data_sv);
	    			}
	    		}
	    	}
	    	$sinhvien 		= $this->Mthuhoso_nhaphoc->get_where_row('tbl_sinhvien', 'soBD', $sobd);
			$hoso_dacheck   = array();
	    	$chitiet = $this->Mthuhoso_nhaphoc->get_many_where('hoso_sinhvien', array('soBD' => $sobd, 'hoso !=' => ""));
	    	$arr = explode(",", $sinhvien['hoso']);
	    	foreach ($arr as $key => $value) {
	    		$nguoithuhs[$value] = $this->Mthuhoso_nhaphoc->timkiem_hoso($value, $sobd);
	    		if(!empty($value)){
	    			$hoso_dacheck[$value] = $nguoithuhs[$value];
	    		}
	    	}
	    	$data = array(
	    		'sinhvien_in'  => $sinhvien,
	    		'hoso_dacheck' => $hoso_dacheck,
	    		'danhmuc'      => $danhmuc,
	    		'diemchuan'    => $diemchuan,
	    		'dsten_hs'     => $dsten_hs,
	    		'chitiet'      => $chitiet,
	    		'session'      => $session,
	    	);
	    	$this->parser->parse('giayto/Vinhoso', $data);
	    }
	    // lưu người thu hồ sơ vừa check
	    public function save_checkedHS($sobd, $session){
	    	$dscheck_hs = $this->input->post('check_hs_'.$sobd);

	    	$data = array(
	    		'soBD' 			 => $sobd,
	    		'hoso' 			 => implode(",", $dscheck_hs),
	    		'nguoithu_hoso'  => $session['macb'],
	    		'thoigian_thuhs' => date('Y/m/d H:i:s')
	    	);
	    	$data_sv = array(
	    		'hoso' 			 => $data['hoso'],
	    		'nguoithuhs'     => $session['macb'],
	    		'thoigian_thuhs' => $data['thoigian_thuhs'],
    		);
    		$sinhvien 		= $this->Mthuhoso_nhaphoc->get_where_row('tbl_sinhvien', 'soBD', $sobd);
			if($sinhvien['trangthai'] < 4){
				$data_sv['trangthai'] = 3;// đã thu hồ sơ
			}
	    	$check_duplicate = $this->Mthuhoso_nhaphoc->check_hs($sobd, $data['hoso']);
	    	if(!empty($check_duplicate) > 0){
	    		$this->Mthuhoso_nhaphoc->delete_dshs($data['soBD'], $data['hoso']);
	    	}
	    	$row = $this->Mthuhoso_nhaphoc->insert('hoso_sinhvien', $data);
	    	$noihs = $this->Mthuhoso_nhaphoc->get_many_where('hoso_sinhvien', array('soBD' => $sobd, 'hoso !=' => ""));
	    	if(count($noihs) > 0){
	    		foreach ($noihs as $key => $value) {
	    			if($key != 0){
	    				$noihs[0]['hoso'] .= ','. $value['hoso'];
	    			}
	    		}
	    		$noihs = $noihs[0]['hoso'];
	    		$data_sv['hoso'] = $noihs;
	    		$row_sv  = $this->Mthuhoso_nhaphoc->update_set('tbl_sinhvien','soBD', $sobd, $data_sv);
	    	}else{
	    		$row_sv = $this->Mthuhoso_nhaphoc->update_set('tbl_sinhvien','soBD', $sobd, $data_sv);
	    	}
	    }
	    public function in_allHS($session, $danhmuc, $dsten_hs){
	    	$sobd 			= $this->input->post('inallhs');
	    	$sinhvien 		= $this->Mthuhoso_nhaphoc->get_where_row('tbl_sinhvien', 'soBD', $sobd);
	    	$diemchuan 		= $this->Mthuhoso_nhaphoc->getDiemChuanSV($sinhvien['khoihoc'], $sinhvien['FK_sMaNganh']);
	    	$arr = explode(",", $sinhvien['hoso']);
	    	foreach ($arr as $key => $value) {
	    		$nguoithuhs[$value] = $this->Mthuhoso_nhaphoc->timkiem_hoso($value, $sobd);
	    		if(!empty($value)){
	    			$hoso_dacheck[$value] = $nguoithuhs[$value];
	    		}
	    	}
	    	$data = array(
	    		'sinhvien_in'  => $sinhvien,
	    		'hoso_dacheck' => $hoso_dacheck,
	    		'danhmuc'      => $danhmuc,
	    		'diemchuan'    => $diemchuan,
	    		'dsten_hs'     => $dsten_hs
	    	);
	    	$this->parser->parse('giayto/Vinhoso', $data);
	    }
	    // tìm kiếm sinh viên
	    public function timkiem(){
	    	$data = array(
	    		'hoten'    => trim($this->input->post('hoten')),
	    		'sobd'     => trim($this->input->post('sobd')),
	    		'nguoithu' => trim($this->input->post('nguoithu')),
	    		'hienthi'  => trim($this->input->post('hienthi')),
	    	);
	    	$data['timkiem']  = $this->Mthuhoso_nhaphoc->timKiemthongtin($data['hoten'], $data['sobd'],$data['nguoithu'], $data['hienthi']);
	    	return $data;
	    } 
	    // lấy danh sách hồ sơ checked và disable the đợt
	    public function getDSHS_Check(){
	    	$data = array();
			// lấy danh sách hồ sơ sinh viên đã có để checked
	    	$hososv = $this->Mthuhoso_nhaphoc->get('tbl_sinhvien');
	    	foreach ($hososv as $value) {
	    		$hososv[$value['soBD']] = explode(",", $value['hoso']);
	    		$arrhs = [];
	    		foreach ($hososv[$value['soBD']] as $key => $v) {
	    			$arrhs[$v] = $v;
	    		}
	    		$data['_dscheck_hs'][$value['soBD']] = $arrhs;
	    	}
	    	// lấy danh sách hồ sơ sinh viên đã có để disable
    		return $data;
	    }
	    // lấy tất cả danh mục
	    public function getDanhmuc(){
	    	$nganh 				= $this->Mthuhoso_nhaphoc->get('tbl_nganh');
	    	$dantoc 			= $this->Mthuhoso_nhaphoc->get('dm_dantoc');
	    	$tongiao 			= $this->Mthuhoso_nhaphoc->get('dm_tongiao');
	    	$data['tbl_canbo'] 	= $this->Mthuhoso_nhaphoc->get('dm_canbo');
	    	$data['hoso']       = $this->Mthuhoso_nhaphoc->get_hoso();
	    	$sinhvien   		= $this->Mthuhoso_nhaphoc->get('tbl_sinhvien');
	    	foreach ($sinhvien as $value) {
	    		$data['diemchuan'][$value['soBD']] = $this->Mdkttsv->get_many_where('tbl_diemchuan',array('makhoi' => $value['khoihoc'], 'manganh' => $value['FK_sMaNganh']));
	    	}
	    	foreach ($data['tbl_canbo'] as $value) {
	    		$data['canbo'][$value['macb']] = $value['tencb'];
	    	}
	    	foreach ($tongiao as $value) {
	    		$data['tongiao'][$value['madm_tongiao']] = $value['ten_tongiao'];
	    	}
	    	foreach ($dantoc as $value) {
	    		$data['dantoc'][$value['iMaDT']] = $value['sTenDT'];
	    	}
	    	foreach ($nganh as $value) {
	    		$data['nganh'][$value['iMa_nganh']] = $value['sTen_Nganh'];
	    		$data['khoa'][$value['iMa_nganh']]  = $this->Mthuhoso_nhaphoc->get_Khoa($value['iMa_nganh']) ;
	    	}
	    	return $data;
	    }
	    // danh sách tên hồ sơ
	    public function dstenhoso(){
	    	$dsten_hs 			= array(
	    		'bshb' => ' Bản sao học bạ (Kèm bản chính)',
	    		'bsks' => 'Bản sao giấy khai sinh (Kèm bản chính)',
	    		'bstn' => 'Bản sao bằng tốt nghiệp THPT(Kèm bản chính)',
	    		'cntn' => 'Chứng nhận tốt nghiệp(Tạm thời)',
	    		'gbnh' => ' Giấy báo nhập học (bản chính)',
	    		'hstt' => ' Hồ sơ trúng tuyển(có xác nhận của ĐP)',
	    		'nvqs' => ' Giấy chứng nhận ĐK nghĩa vụ quân sự',
	    		'utdt' => ' Đối tượng (CLS, CTB,DT)',
	    		'utkv' => ' Khu vực (theo hộ khẩu)',
	    		'xnvm' => 'Giấy xác nhận đăng ký vắng mặt'
	    	);
	    	return $dsten_hs;
	    }
	    // danh sách hồ sơ in  giấy cam đoan
	    public function dsHS(){
	    	$dsten_hs 			= array(
	    		'bshb' => ' Bản sao học bạ',
	    		'bsks' => ' Bản sao khai sinh',
	    		'bstn' => ' Bản sao tốt nghiệp',
	    		'cntn' => ' Chứng nhận tốt nghiệp(Tạm thời)',
	    		'gbnh' => ' Giấy báo nhập học',
	    		'hstt' => ' Hồ sơ trúng tuyển',
	    		'nvqs' => ' Nghĩa vụ quân sự',
	    		'utdt' => ' Ưu tiên đối tượng',
	    		'utkv' => ' Ưu tiên khu vực',
	    		'xnvm' => ' Xác nhận vắng mặt'
	    	);
	    	return $dsten_hs;
	    }
	    public function renderMSV($sobd){

	    	$sinhvien = $this->Mthuhoso_nhaphoc->get_where_row('tbl_sinhvien', 'soBD', $sobd);
	    	$nganh    = $sinhvien['FK_sMaNganh'];
	    	$masv     = date('y')."A".$nganh."01";
	    	// $re=$this->db->query("SELECT max(SUBSTRING(masv, 8, 4))*1.0 as maxx FROM `tbl_sinhvien` WHERE `masv` like '$masv%'")->result_array();
	    	$re   = $this->Mthuhoso_nhaphoc->renderMSV($masv);
	    	$sott = $re[0]['maxx']+1;
	    	switch (strlen($sott)) {
	    		case 1:
	    			$sott='000'.$sott; 
	    			break;
	    		case 2:
	    			$sott='00'.$sott; 
	    			break;
	    		case 3:
	    			$sott='0'.$sott; 
	    			break; 
	    	}
	    	$msv = $masv.$sott;
	    	return $msv;
	    }
	}
 ?>
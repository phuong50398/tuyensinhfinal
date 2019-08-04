<?php 
	/**
	 * summary
	 */
	class Cthutaichinh extends MY_Controller
	{
	    /**
	     * summary
	     */
	    public function __construct()
	    {
	    	date_default_timezone_set("Asia/Ho_Chi_Minh");
	        parent::__construct();
	        $this->load->model('danhmuc/Mthutaichinh');
	    }
	    public function index(){
	    	$danhmuc = $this->getDanhmuc();
	    	$session    	= $this->session->userdata('user');
	    	$sinhvien   	= $this->Mthutaichinh->get_where_orderasc('tbl_sinhvien','buoctiep', 'buoc7','stt');

	    	// phân trang
			$start = 0;
			$limit = 100;
			$data['stt'] = 1;
			if ($this->input->get('page')) {
			$data['page'] = $this->input->get('page');
			$start = ($data['page']-1) * $limit;
			if($start == 0){
			$data['stt'] = 1;
			}else{
			$data['stt'] = $start + 1;
			}
			}
			else{
			$data['page'] = 1;
			}
			$sum_record 				 = count($sinhvien);
			$data['total_page'] 		 = CEIL($sum_record/$limit);
			$sinhvien 				     = $this->Mthutaichinh->getList($limit,$start);
			// $goi = '';
	  //   	$soban = '';
			// if($this->input->post('goisv')){
	  //   		// $sinhvien = $this->Mthutaichinh->goisv();
	  //   		$soban = $this->input->post('soban');
	  //   		$array = array(
	  //   			'soban' => $soban
	  //   		);
	    		
	  //   		$this->session->set_userdata( $array );
	  //   		// pr($this->session->userdata('soban'));
	  //   		$sinhvien = $this->Mthutaichinh->goisv();
	  //   		$goi = $sinhvien;
	  //   	}
			$goi = '';
	    	$soban = '';
	    	if($this->input->get('soban')){
	    		$soban = $this->input->get('soban');
	    		$array = array(
	    			'soban' => $soban
	    		);
	    		
	    		$this->session->set_userdata( $array );
	    		// pr($this->session->userdata('soban'));
	    		$sinhvien = $this->Mthutaichinh->goisv();
	    		if(empty($sinhvien[0])){
	    			setMessages('warning','Đã hết sinh viên trong danh sách chờ gọi','Thông báo');
	    		}
	    		// pr($sinhvien);
	    		return redirect('Thu-tai-chinh?sbd='.$sinhvien[0]['soBD'].'&goisv=goisv');
	    		
	    	}
	    	if($this->input->get('sbd')){
	    		$sbd = $this->input->get('sbd');
	    		$sinhvien = $this->Mthutaichinh->get_where('tbl_sinhvien','soBD', $sbd);
	    	}
	    	if($this->input->get('goisv')){
	    		$goi = $sinhvien;
	    	}

	    	$getDSHP  		= $this->getDSHS_Check();
	    	$dstenhocphi    = $this->dstenhocphi();
	    	$timkiem        = array();
	    	$ds 			= array();
	    	$chitiet_hspv   = array();
	    	$tongtiencanthu4 = $this->Mthutaichinh->TongTienThu('tt2','hp2');
	    	$tongtiencanthu5 = $this->Mthutaichinh->TongTienThu('tt1', 'hp1');
	    	foreach ($sinhvien as $ksv => $value) {
	    		$sinhvien[$ksv]['chitietthu'] = $this->Mthutaichinh->get_many_where('hocphi_sinhvien',array('masv' => $value['masv'], 'hocphi !=' =>""));
	    		$sinhvien[$ksv]['tongthu'] = $this->Mthutaichinh->getThuHPTam($value['masv']);
	    		if($value['FK_sMaNganh'] == 15 || $value['FK_sMaNganh'] == 63 || $value['FK_sMaNganh'] == 62 || $value['FK_sMaNganh'] == 61){
	    			if($tongtiencanthu5['total'] <= $value['tongtien_dathu']){
		    			$sinhvien[$ksv]['trangthai'] = 'du';
		    		}else{
		    			$sinhvien[$ksv]['trangthai'] = 'thieu';
		    		}
	    		}else{
	    			if($tongtiencanthu4['total'] <= $value['tongtien_dathu']){
		    			$sinhvien[$ksv]['trangthai'] = 'du';
		    		}else{
		    			$sinhvien[$ksv]['trangthai'] = 'thieu';
		    		}
	    		}
	    		// $dscheck_hs[$value['masv']] = $this->Mthutaichinh->get_dshpsv($value['masv']);
	    		// $chitiet_hspv[$value['masv']] = $this->Mthutaichinh->get_where('hocphi_sinhvien', 'masv', $value['masv']);
	    		$chitiet_hspv[$value['masv']] = $this->Mthutaichinh->get_many_where('hocphi_sinhvien',array('masv' => $value['masv'], 'hocphi !=' =>""));
	    		// $noihpsv[$value['masv']] = $this->Mthutaichinh->get_where('hocphi_sinhvien', 'masv', $value['masv']); 
	    	}
	    	$arr = array();
		    	foreach ($chitiet_hspv as $key => $value) {
	    			foreach ($value as $k => $v) {
	    				if($k != 0){
	    					$chitiet_hspv[$key][0]['tamthu_hp1']  += $v['tamthu_hp1'];
	    					$chitiet_hspv[$key][0]['tamthu_hp2']  += $v['tamthu_hp2'];
	    					$chitiet_hspv[$key][0]['tamthu_sk']  += $v['tamthu_sk'];
	    					$chitiet_hspv[$key][0]['tamthu_the'] += $v['tamthu_the'];
	    					$chitiet_hspv[$key][0]['tamthu_yt']  += $v['tamthu_yt'];
	    					$chitiet_hspv[$key][0]['tamthu_tt1'] += $v['tamthu_tt1'];
	    					$chitiet_hspv[$key][0]['tamthu_tt2'] += $v['tamthu_tt2'];
	    				}
    					$ds[$key] = array(
    						'hp1'  => $chitiet_hspv[$key][0]['tamthu_hp1'],
    						'hp2'  => $chitiet_hspv[$key][0]['tamthu_hp2'],
    						'sk'  => $chitiet_hspv[$key][0]['tamthu_sk'],
    						'the' => $chitiet_hspv[$key][0]['tamthu_the'],
    						'yt'  => $chitiet_hspv[$key][0]['tamthu_yt'],
    						'tt1' => $chitiet_hspv[$key][0]['tamthu_tt1'],
    						'tt2' => $chitiet_hspv[$key][0]['tamthu_tt2'],
    					);
	    			}
		    	}
		     // pr($sinhvien);
	    	if($this->input->post('action') == "set_session"){
	    		$nguoithutien = $this->input->post('value');
	    		if(!empty($nguoithutien)){
	    			if(!empty($nguoithutien)){
	    				$session['nguoithutien'] = $nguoithutien;
	    				$this->session->set_userdata('user',$session);
	    			}
	    		}
	    		exit();
	    	}
	    	if($this->input->post('in_hoadon')){
	    		$this->in_hoadon($danhmuc, $session,  $dstenhocphi);
	    		return;
	    	}
	    	if($this->input->post('timkiem')){
	    		$timkiem = $this->timkiem();
	    	}
	    	if($this->input->post('huyhp')){
	    		$this->huyHP($danhmuc, $session, $dstenhocphi);
	    	}
	    	if($this->input->get('chitiethpsv')){
	    		$masv = $this->input->get('chitiethpsv');
	    		$id = $this->input->get('id');
	    		$this->inct_hochphi($danhmuc, $session, $dstenhocphi,$masv, $id );
	    		return;
	    	}
	    	if($this->input->get('giaycamdoan')){
	    		$masv = $this->input->get('giaycamdoan');
	    		$this->giaycamdoan($dstenhocphi, $session,$masv, $danhmuc);
	    		return;
	    	}
	    	
	    	$temp = array(
				'template' => 'danhmuc/Vthutaichinh',
				'data' => array(
					'message'  		 => getMessages(),
					'sinhvien' 		 => $sinhvien,
					'danhmuc'        => $danhmuc,
					'dstenhocphi'    => $dstenhocphi,
					'getDSHP'        => $getDSHP,
					'timkiem'		 => $timkiem,
					'ds_hpdadong'    => $ds,
					'total_page'     => $data['total_page'],
					'page'           => $data['page'],
					'stt'			 => $data['stt'],
					'tongtiencanthu4' => $tongtiencanthu4,
					'tongtiencanthu5' => $tongtiencanthu5,
					'goi'			 => $goi,
					'soban'			 => $this->session->userdata('soban')
					// 'chitiet_hpsv'   => $chitiet_hspv 
   				),
			);
			// pr($sinhvien);
			$this->load->view('layout/content', $temp);
	    }
	    public function giaycamdoan($dstenhocphi, $session, $masv, $danhmuc){
	    	$sinhvien 		= $this->Mthutaichinh->get_where_row('tbl_sinhvien', 'masv', $masv);
	    	$hocphisv       = $this->Mthutaichinh->get_many_where('hocphi_sinhvien',array('masv' => $masv, 'hocphi !=' =>""));
	    	$arr_name = array();
	    	$name_hp  = "";
	    	$check_hp = explode(",", $sinhvien['hocphi']);
	    	foreach ($check_hp as $value) {
	    		if($value != NULL){
		    		$arr_name[] = $dstenhocphi['dsten_hp1'][$value];
		    		$name_hp = implode(",",$arr_name);
	    		}
	    	}
	    	if(count($arr_name) > 3){
	    		$tt = $arr_name[0].",".$arr_name[1].",".$arr_name[2]."...";
	    	}
	    	if($name_hp == NULL){
	    		$tt = "Chưa có khoản thu nào.";
	    	}else{
	    		$name_hp = 'Hiện nay sinh viên '.$sinhvien['hoten']. ' đã nộp các khoản như sau:<br>' .$name_hp;
	    	}
	    	$arr = array(
	    		'tongtien_chu' => $this->VndText($sinhvien['tongtien_dathu']),
	    		'tongtien_so'  => number_format($sinhvien['tongtien_dathu'],0, ',', ','),
	    	);
	    	if($arr['tongtien_chu'] == "Tiền phải là số nguyên dương lớn hơn số 0"){
	    		$arr['tongtien_chu'] = "Bạn chưa nộp khoản học phí nào.";
	    	}
	    	$dulieu = array(
	    		'nguoiin_giaycamdoan'     => $session['macb'], 
	    		'thoigianin_giaycamdoan'  => date('d/m/Y H:i:s'),
	    		'masv'                    => $masv,
	    	);
	    	$this->Mthutaichinh->insert('hocphi_sinhvien', $dulieu);
	    	$data = array(
	    		'danhmuc'	   		=> $danhmuc,
	    		'sinhvien_in'  		=> $sinhvien,
	    		'session'      		=> $session,
	    		'hpsv'              => $name_hp,
	    		'dstenhocphi'       => $dstenhocphi,
	    		'tongtien'          => $arr,
	    	);
	    	$this->parser->parse('giayto/Vphieucamdoan_hp', $data);
	    }
	    public function in_hoadon($danhmuc, $session, $dstenhocphi){
	    	$masv    		= $this->input->post('in_hoadon');
	    	$title_hp 		= $this->Mthutaichinh->hocphi();
	    	$sinhvien 		= $this->Mthutaichinh->get_where_row('tbl_sinhvien', 'masv', $masv);
	    	$msr       		= $this->save_checkedHP($masv, $session, $danhmuc);

	    	$title_quyen    = $this->Mthutaichinh->get_where_row('dm_canbo','macb', $session['macb']);
	    	$so 			= $title_quyen['so'] + 1;
	    	$update_quyenso = $this->Mthutaichinh->update_set('dm_canbo', 'macb', $session['macb'], array('so' => $title_quyen['so'] + 1));
	    	if($msr['msr'] == 1){
	    		$check_hp = $msr['hocphi'];
	    		$tongtien = $msr['tongtien'];
	    		$lanthu   = $msr['lanthu'];
	    	}
	    	foreach ($check_hp as $value) {
	    		$arr[$value] = $value;
	    		$arr_name[]  = $dstenhocphi['dsten_hp1'][$value];
	    		$name_hp     = implode(",",$arr_name);
	    	}
	    	// if(count($arr_name) > 3){
	    	// 	$name_hp = $arr_name[0].",".$arr_name[1].",".$arr_name[2]."...";
	    	// }else{
	    	// 	$name_hp = $name_hp;
	    	// }
	    	 if(count($arr_name) > 3){
	    		$tt = 1; // số lượng học phí thu lớn 3 
	    	}else{
	    		$tt = 0; // ngược lại
	    	}
	    	
	    	$lanthu = '(Lần thu ' .$lanthu .')';
	    	$data = $this->input->post('data');
	    	$arr = array(
	    		'tongtien_chu' => $this->VndText($tongtien),
	    		'tongtien_so'  => number_format($tongtien,0, ',', ','),
	    	);
	    	$update_quyenso = $this->Mthutaichinh->update_hp($masv, implode(",", $check_hp), $title_quyen['so']);

	    	$data = array(
	    		'danhmuc'	   		=> $danhmuc,
	    		'sinhvien_in'  		=> $sinhvien,
	    		'title_hp'     		=> $title_hp,
	    		'session'      		=> $session,
	    		'hpsv'              => $name_hp,
	    		'dstenhocphi'       => $dstenhocphi,
	    		'tongtien'          => $arr,
	    		'title_quyen'       => $title_quyen,
	    		'lanthu'            => $lanthu,
	    		'thongbao'          => $tt,
	    		'pos'				=> $this->input->post('pos')
	    	);
	    	$this->parser->parse('giayto/Vphieuthuhocphi', $data);
	    }
	    public function save_checkedHP($masv, $session, $danhmuc){
	    	    $data = $this->input->post('data');
	    	    if(isset($data['tt1'])){
	    	    	$tamthu_tt1 = str_replace(",","", $data['tt1']);
	    	    	$tamthu_hp1 = str_replace(",","", $data['hp1']);
	    	    }else{
	    	    	$tamthu_tt1 = 0;
	    	    	$tamthu_hp1 = 0;
	    	    }
	    	    if(isset($data['tt2'])){
	    	    	$tamthu_tt2 = str_replace(",","", $data['tt2']);
	    	    	$tamthu_hp2 = str_replace(",","", $data['hp2']);
	    	    }else{
	    	    	$tamthu_tt2 = 0;
	    	    	$tamthu_hp2 = 0;
	    	    }
	    		foreach ($data as $key => $value) {
					if(!empty($value) && $key != 'lanthu'){
						$arr[] = $key;
					}
	    		}
	    		$tongtien = str_replace(",","", $this->input->post('tongtien'));
	    	    $hocphi = array(
	    	    	'tamthu_hp1'  	   => $tamthu_hp1,
	    	    	'tamthu_hp2'  	   => $tamthu_hp2,
	    	    	'tamthu_sk'  	   => str_replace(",","", $data['sk']),
	    	    	'tamthu_the' 	   => str_replace(",","", $data['the']),
	    	    	'tamthu_yt'  	   => str_replace(",","", $data['yt']),
	    	    	'tamthu_tt1' 	   => $tamthu_tt1 ,
	    	    	'tamthu_tt2' 	   => $tamthu_tt2 ,
	    	    	'masv' 			   => $masv,
	    			'hocphi' 		   => implode(",", $arr),
	    			'nguoithu_hocphi'  => $session['macb'],
	    			'thoigian_thuhp'   => date('Y/m/d H:i:s'),
	    			'tongtien_thu'	   => $tongtien,
	    			'ghichu'           => $session['nguoithutien'],
	    			'soquyen'          => $session['soquyen'],
	    			'lanthu'		   => $data['lanthu'],
	    			'pos'				=> $this->input->post('pos')
	    	    );
	    	   	$tongtien_ht = $hocphi['tamthu_hp1'] + $hocphi['tamthu_hp2'] + $hocphi['tamthu_sk'] +  $hocphi['tamthu_the'] + $hocphi['tamthu_yt'] + $hocphi['tamthu_tt1'] +  $hocphi['tamthu_tt2'];
	    		$data_sv = array(
	    			'hocphi'			 => $hocphi['hocphi'],
	    			'nguoithu_hocphi'    => $session['macb'],
	    			'nguoithuhp_nh'      => $session['nguoithutien'],
	    			'thoigian_hocphi'    => $hocphi['thoigian_thuhp'],
	    			'trangthai'          => 4, // đã thu tiền,
	    			'tongtien_dathu'     => $tongtien,
	    		);
	    	    $row 		     = $this->Mthutaichinh->insert('hocphi_sinhvien', $hocphi);
	    		$noihp 		     = $this->Mthutaichinh->get_many_where('hocphi_sinhvien',array('masv' => $hocphi['masv'], 'hocphi !=' =>""));
		    	if(count($noihp) > 0){
		    		$tongtien = 0;
	    			foreach ($noihp as $key => $value) {
	    				if($key != 0){
	    					$noihp[0]['hocphi'] .= ','. $value['hocphi'];
	    				}
	    				$tongtien = $tongtien + $value['tongtien_thu'];
	    			}
	    			$noihp 	= array_unique(explode(",", $noihp[0]['hocphi']));
	    			$noihp  = implode(",", $noihp);
	    			$data_sv['hocphi'] 	       = $noihp;
			    	$data_sv['tongtien_dathu'] = $tongtien;
	    			$row_sv  = $this->Mthutaichinh->update_set('tbl_sinhvien','masv', $masv, $data_sv);
	    		}else{
	    			$row_sv = $this->Mthutaichinh->update_set('tbl_sinhvien','masv', $masv, $data_sv);
	    		}
	    		if($row > 0 && $row_sv > 0){
	    			$msr = array(
	    				'hocphi'   => $arr,
	    				'msr'      => 1,
	    				'tongtien' => $tongtien_ht,
	    				'lanthu'   => $hocphi['lanthu'],
	    			);
	    		}else{
	    			$msr = 0; // lỗi
	    		}
	    		return $msr;
	    }
	    public function inct_hochphi($danhmuc, $session, $dstenhocphi,$masv, $id){
	    	$id_hp    = $id;
	    	$sinhvien 		= $this->Mthutaichinh->get_where_row('tbl_sinhvien', 'masv', $masv);
	    	$title_hp 		= $this->Mthutaichinh->hocphi();
	    	$hocphisv =	$this->Mthutaichinh->get_many_where('hocphi_sinhvien',array('masv' => $masv, 'id' => $id_hp));
	    	$title_quyen = array(
	    		'soquyen' => $hocphisv[0]['soquyen'],
	    		'so'      => $hocphisv[0]['so'],
	    	);
	    	$check_hp = explode(",", $hocphisv[0]['hocphi']);
	    	foreach ($check_hp as $value) {
	    		$arr[$value] = $value;
	    		$arr_name[] = $dstenhocphi['dsten_hp1'][$value];
	    		$name_hp = implode(",",$arr_name);
	    	}
	    	if(count($arr_name) > 3){
	    		$tt = 1; // số lượng học phí thu lớn 3 
	    	}else{
	    		$tt = 0; // ngược lại
	    	}
	    	$lanthu = '(Lần thu ' .$hocphisv[0]['lanthu'] .')';
	    	$arr = array(
	    		'tongtien_chu' => $this->VndText($hocphisv[0]['tongtien_thu']),
	    		'tongtien_so'  => number_format($hocphisv[0]['tongtien_thu'],0, ',', ','),
	    	);
	    	$nguoithutien = $this->Mthutaichinh->get_where_row('hocphi_sinhvien','id', $id_hp);
	    	$data = array(
	    		'danhmuc'	   		=> $danhmuc,
	    		'sinhvien_in'  		=> $sinhvien,
	    		'title_hp'     		=> $title_hp,
	    		'session'      		=> $session,
	    		'hpsv'              => $name_hp,
	    		'dstenhocphi'       => $dstenhocphi,
	    		'tongtien'          => $arr,
	    		'title_quyen'       => $title_quyen,
	    		'nguoithutien'      => $nguoithutien,
	    		'lanthu'            => $lanthu,
	    		'thongbao'          => $tt,
	    		'pos'				=> $hocphisv[0]['pos']
	    	);
	    	$this->parser->parse('giayto/Vphieuthuhocphi', $data);
	    	
	    }
	    public function huyHP($danhmuc, $session, $dstenhocphi){
	    	$value = $this->input->post('huyhp');
	    	$masv     = strstr($value, '_', true);
	    	$id_hp    = substr($value,strlen($masv) + 1);
	    	$row1 = $this->Mthutaichinh->delete_many_where('hocphi_sinhvien',array('masv' => $masv, 'id' => $id_hp));
	    	$hocphisv =	$this->Mthutaichinh->get_many_where('hocphi_sinhvien',array('masv' => $masv,'hocphi!=' => ""));
	    	$sum = 0;
	    	if(count($hocphisv) > 0){
	    		foreach ($hocphisv as $key => $value) {
	    			if($key != 0 ){
	    				$hocphisv[0]['hocphi'] .= ",". $value['hocphi'];
	    			}
	    			$sum = $sum + $value['tongtien_thu'];
	    		}
	    		$noihp 	= array_unique(explode(",", $hocphisv[0]['hocphi']));
	    	}
	    	if(empty($hocphisv)){
	    		$data = array(
					'hocphi'          => $dshp, 
					'trangthai' 	  => 3, 
					'nguoithu_hocphi' => NULL,
					'nguoithuhp_nh'   => NULL,
					'tongtien_dathu'  => NULL,
					'thoigian_hocphi' => NULL,
					'hocphi'          => NULL
	    		);
	    		$row  = $this->Mthutaichinh->update_set('tbl_sinhvien','masv', $masv, $data);
	    	}else{
	    		$dshp = $hocphisv[0]['hocphi'];
	    		$data  = array(
	    			'hocphi'         => $dshp,
	    			'tongtien_dathu' => $sum,
	    		);
		   		$row  = $this->Mthutaichinh->update_set('tbl_sinhvien','masv', $masv,$data);
	    	}
	   		if($row > 0){
	   			setMessages('success','Hủy hóa đơn học phí thành công','Thông báo');
	   			return redirect('Thu-tai-chinh');
	   		}else{
	   			setMessages('error','Hủy hóa đơn học phí thất bại','Thông báo');
	   			return redirect('Thu-tai-chinh');
	   		}
	    }
	   public function timkiem(){
	    	$masv = trim($this->input->post('masv'));
	    	
	    	$data['hoten']   = trim($this->input->post('hoten'));
	    	$data['masv']    = $masv;
	    	$data['hienthi'] = $this->input->post('hienthi');
	    	$data['ttsv']    = $this->Mthutaichinh->timKiemHTTC($data['hoten'],$data['masv'], $data['hienthi']);
	    	$tongtiencanthu4 = $this->Mthutaichinh->TongTienThu('tt2','hp2');
	    	$tongtiencanthu5 = $this->Mthutaichinh->TongTienThu('tt1','hp1');

	    	foreach ($data['ttsv'] as $key => $value) {
	    		$data['ttsv'][$key]['chitietthu'] = $this->Mthutaichinh->get_where('hocphi_sinhvien', 'masv', $value['masv']);
	    		$data['ttsv'][$key]['tongthu'] = $this->Mthutaichinh->getThuHPTam($value['masv']);
	    		if($value['FK_sMaNganh'] == 15 || $value['FK_sMaNganh'] == 63 || $value['FK_sMaNganh'] == 62 || $value['FK_sMaNganh'] == 61){
	    			if($tongtiencanthu5['total'] <= $value['tongtien_dathu']){
		    			$data['ttsv'][$key]['trangthai'] = 'du';
		    		}else{
		    			$data['ttsv'][$key]['trangthai'] = 'thieu';
		    		}
	    		}else{
	    			if($tongtiencanthu4['total'] <= $value['tongtien_dathu']){
		    			$data['ttsv'][$key]['trangthai'] = 'du';
		    		}else{
		    			$data['ttsv'][$key]['trangthai'] = 'thieu';
		    		}
	    		}
	    	}
	    	return $data;
	    }
	    // lấy danh sách hồ sơ checked và disable the đợt
	    public function getDSHS_Check(){
	    	$data           = array();
			// lấy danh sách hồ sơ sinh viên đã có để checked
	    	$hososv = $this->Mthutaichinh->get('tbl_sinhvien');
	    	foreach ($hososv as $value) {
	    		$hososv[$value['masv']] = explode(",", $value['hocphi']);
	    		$arrhs = [];
	    		foreach ($hososv[$value['masv']] as $key => $v) {
	    			$arrhs[$v] = $v;
	    		}
	    		$data['_dscheck_hp'][$value['masv']] = $arrhs;
	    	}
    		return $data;
	    }
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
	    		'hp1'   => 'Học phí(1) tạm thu kì I: '.date('Y') .'-'.(date('Y')+1),
	    		'hp2'   => 'Học phí(2) tạm thu kì I: ' .date('Y') .'-'.(date('Y')+1),
	    		'sk'   => ' Khám sức khỏe',
	    		'the'  => ' Thẻ thư viện',
	    		'tt1'  => ' BH thân thể(1)',
	    		'tt2'  => ' BH thân thể(2)',
	    		'yt'   => ' BHYT',
	    	);
	    	$dsten_hp2 			= array(
	    		'hp1'   => ' Học phí 1',
	    		'hp2'   => ' Học phí 2',
	    		'sk'   => ' Khám sức khỏe',
	    		'the'  => ' Thẻ thư viện',
	    		'tt1'  => ' Bảo hiểm thân thể 1',
	    		'tt2'  => ' Bảo hiểm thân thể 2',
	    		'yt'   => ' BHYT',
	    	);
	    	$data = array(
	    		'dsten_hp1'  => $dsten_hp1,
	    		'dsten_hp2'  => $dsten_hp2,
	    	);
 	    	return $data;
	    }
	    public function VndText($amount){
			if($amount <=0)
			{
				return $textnumber="Tiền phải là số nguyên dương lớn hơn số 0";
			}
			$Text=array("không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín");
			$TextLuythua =array("","nghìn", "triệu", "tỷ", "ngàn tỷ", "triệu tỷ", "tỷ tỷ");
			$textnumber = "";
			$length = strlen($amount);

			for ($i = 0; $i < $length; $i++)
				$unread[$i] = 0;

			for ($i = 0; $i < $length; $i++)
			{               
				$so = substr($amount, $length - $i -1 , 1);                

				if ( ($so == 0) && ($i % 3 == 0) && ($unread[$i] == 0)){
					for ($j = $i+1 ; $j < $length ; $j ++)
					{
						$so1 = substr($amount,$length - $j -1, 1);
						if ($so1 != 0)
							break;
					}                       

					if (intval(($j - $i )/3) > 0){
						for ($k = $i ; $k <intval(($j-$i)/3)*3 + $i; $k++)
							$unread[$k] =1;
					}
				}
			}

			for ($i = 0; $i < $length; $i++)
			{        
				$so = substr($amount,$length - $i -1, 1);       
				if ($unread[$i] ==1)
					continue;

				if ( ($i% 3 == 0) && ($i > 0))
					$textnumber = $TextLuythua[$i/3] ." ". $textnumber;     

				if ($i % 3 == 2 )
					$textnumber = 'trăm ' . $textnumber;

				if ($i % 3 == 1)
					$textnumber = 'mươi ' . $textnumber;
					$textnumber = $Text[$so] ." ". $textnumber;
				}

		        //Phai de cac ham replace theo dung thu tu nhu the nay
			$textnumber = str_replace("không mươi", "lẻ", $textnumber);
			$textnumber = str_replace("lẻ không", "", $textnumber);
			$textnumber = str_replace("mươi không", "mươi", $textnumber);
			$textnumber = str_replace("một mươi", "mười", $textnumber);
			$textnumber = str_replace("mươi năm", "mươi năm", $textnumber);
			$textnumber = str_replace("mươi một", "mươi mốt", $textnumber);
			$textnumber = str_replace("mười năm", "mười năm", $textnumber);
			return ucfirst($textnumber."đồng");
		}
	}
 ?>
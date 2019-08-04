<?php 
	/**
	 * summary
	 */
	class Ctragiaybao extends MY_Controller
	{
	    /**
	     * summary
	     */
	    public function __construct()
	    {
	    	date_default_timezone_set("Asia/Ho_Chi_Minh");
	        parent::__construct();
	        $this->load->model('danhmuc/Mthuphieudiem');
	    }
	   public function index(){
	   		$action  = $this->input->post('action');
	   		$danhmuc = $this->getDanhmuc();
	   		switch ($action) {
	   			case 'load_tragiaybao':
	   				$this->load_tragiaybao();
	   				break;
	   			case 'trahoso':
	   				$this->trahoso();
	   				break;
	   			case 'timban':
	   				$this->timban();
	   				break;
	   			case 'chuyentiep':
	   				$this->chuyentiep();
	   				break;
	   			case 'boqua':
	   				$this->boqua();
	   				break;
	   		}
	    	$canbo  = $this->Mthuphieudiem->get('dm_canbo');
	    	foreach ($canbo as $value) {
	    		$canbo[$value['macb']] = $value['tencb'];
	    	}
	    	
	    	$temp = array(
				'template' => 'danhmuc/Vtragiaybao',
				'data' => array(
					'message'   => getMessages(),
					'canbo'		=> $canbo,
					'danhmuc'   => $danhmuc,
				),
			);
        	$this->load->view('layout/content', $temp);
	    }
	    public function chuyentiep(){
	    	$this->trahoso();
	    	$sobaodanh = $this->input->post('sobd');
	    	$info 			 = $this->Mthuphieudiem->get_where_row('tbl_sinhvien','soBD',$sobaodanh);
	    	$explode         = explode("-", $info['sohs_nh']);
	    	$ban 			 = 'ban'. substr($explode[0],1);
	    	$getSTT          = $this->Mthuphieudiem->getSTT5();
	    	$stt 			 = $getSTT['max'];
	    	$tbl_goi = array(
	    		'stt' => $stt,
	    	);
	    	$data = array(
	    		'buoctiep' => 'buoc5',
	    		'stt' =>  $stt,
	    	);
	    	$row = $this->Mthuphieudiem->update_set('tbl_goi','ban','buoc5',  $tbl_goi);
	    	$row = $this->Mthuphieudiem->update_set(' tbl_sinhvien', 'soBD', $sobaodanh, $data);
	    	// $dulieu  = array(
	    	// 	'stt' => $stt,
	    	// 	'ban' => substr($explode[0],1),
	    	// );

	    	// $sobaodanh = $this->input->post('sobd');
	    	// $session = $this->session->userdata('user');
	    	// $data = array(
	    	// 	'nguoitra_giaybao'    => $session['macb'],
	    	// 	'thoigian_tragiaybao' => date('Y/m/d H:i:s'),
	    	// 	'trangthai'			  => 2,
	    	// );
	    	// $row 					  = $this->Mthuphieudiem->update_set('tbl_sinhvien','soBD',$sobaodanh,$data);
    		// $sinhvien 				  = $this->Mthuphieudiem->get_where_row('tbl_sinhvien', 'soBD', $sobaodanh);
    		// $tensv[$sinhvien['soBD']] = $sinhvien['hoten'];

    		// lấy số thứ tự trong bảng sinh viên
    		
    		$dulieu  = array(
	    		'stt' => $stt,
	    		'ban' => substr($explode[0],1),
	    		'hoten' => $info['hoten']
	    	);
	    	echo json_encode($dulieu);
	    	exit();


	    }
	    public function boqua(){
	    	$this->trahoso();
	    	$sobaodanh = $this->input->post('sobd');
	    	$info 			 = $this->Mthuphieudiem->get_where_row('tbl_sinhvien','soBD',$sobaodanh);
	    	
	    	$data = array(
	    		'buoctiep' => 'boqua',
	    		'stt' =>  '',
	    	);
	    	$row = $this->Mthuphieudiem->update_set(' tbl_sinhvien', 'soBD', $sobaodanh, $data);
	    	echo json_encode($row);
	    	exit();
	    }
	    public function timban(){
	    	$nganh = $this->Mthuphieudiem->get('tbl_nganh');
	    	foreach ($nganh as $value) {
	    		$dsnganh[$value['iMa_nganh']] = $value['sTen_Nganh'];
	    	}
	    	$canbo  = $this->Mthuphieudiem->get('dm_canbo');
	    	foreach ($canbo as $value) {
	    		$canbo[$value['macb']] = $value['tencb'];
	    	}
	    	$data['nganh']  = $dsnganh;
	    	$data['canbo']  = $canbo;
	    	$soban = $this->input->post('ban');
		    $tbl_sinhvien = $this->Mthuphieudiem->get_where_order_sv();
	    	if($soban == "all"){
				$data['dssvban'] = $tbl_sinhvien; 
	    	}else{
		    	foreach ($tbl_sinhvien as $value) {
		    		$ds[$value['soBD']] = explode("-", $value['sohs_nh'])[0];
		    		if($ds[$value['soBD']] == $soban){
		    			$data['dssvban'][] = $value;
		    		}
		    	}
	    	}
	    	echo json_encode($data);
	    	exit();
	    }
	    public function load_tragiaybao(){
	    	global $start_time;
	    	$nganh = $this->Mthuphieudiem->get('tbl_nganh');
	    	foreach ($nganh as $value) {
	    		$dsnganh[$value['iMa_nganh']] = $value['sTen_Nganh'];
	    	}
	    	$canbo  = $this->Mthuphieudiem->get('dm_canbo');
	    	foreach ($canbo as $value) {
	    		$canbo[$value['macb']] = $value['tencb'];
	    	}
	    	$data['nganh']  = $dsnganh;
	    	$data['canbo']  = $canbo;
	    	$data['session']= $this->session->userdata('user');
	    	$dssv  = $tbl_sinhvien = $this->Mthuphieudiem->get_where_order_sv();
	    	foreach ($dssv as $k =>  $value) {
	    		$data['dssv'][$value['soBD']] = $value; 
	    		$data['dssv'][$value['soBD']]['thoigian_thuphieudiem'] = date('d/m/Y H:i:s', strtotime($value['thoigian_thuphieudiem'])); 
	    		if($value['trangthai'] == 2){
	    			$data['dssv'][$value['soBD']]['thoigian_tragiaybao'] = date('d/m/Y H:i:s', strtotime($value['thoigian_tragiaybao'])); 
	    		}
	    	}
	    	$cur_time = explode(' ', microtime());
			$cur_time = intval($cur_time[1]) + floatval($cur_time[0]);
			$data['loaded_in'] = $cur_time - $start_time;
	    	echo json_encode($data);
	    	exit();
	    }
	    public function trahoso(){
	    	$sobd = $this->input->post('sobd');
	    	$session = $this->session->userdata('user');
	    	$info 			 = $this->Mthuphieudiem->get_where_row('tbl_sinhvien','soBD',$sobd);
	    	if($info['trangthai']>2){
				$data = array(
		    		'nguoitra_giaybao'    => $session['macb'],
		    		'thoigian_tragiaybao' => date('Y/m/d H:i:s')
		    	);
	    	}else{
	    		$data = array(
		    		'nguoitra_giaybao'    => $session['macb'],
		    		'thoigian_tragiaybao' => date('Y/m/d H:i:s'),
		    		'trangthai'			  => 2,
		    	);
	    	}
	    	
	    	$row = $this->Mthuphieudiem->update_set('tbl_sinhvien','soBD',$sobd,$data);
    		// $sinhvien = $this->Mthuphieudiem->get_where_row('tbl_sinhvien', 'soBD', $sobd);
    		// $tensv[$sinhvien['soBD']] = $sinhvien['hoten'];
    		// if($row > 0){
	    	// 	$notification = array(
	    	// 		'success'  => 1,
	    	// 		'tensv'    => $tensv,
	    	// 	);
	    	// }else{
	    	// 	$notification = 0;
	    	// }
	    	// echo json_encode($notification);
	    	// exit();
	    }
	   
	    public function datragiaybao(){
	    	$danhmuc = $this->getDanhmuc();
	    	$data_tk = "";
	    	$sinhvien = $this->Mthuphieudiem->get_many_where('tbl_sinhvien', array('nguoitra_giaybao !=' => "",'thoigian_tragiaybao !=' => ""));
	    	$today = strtotime(date('Y-m-d'));
	    	$ds_sinhvien = array();
	    	if($this->input->post('timkiem')){
	    		$data = $this->timkiem();
	    		$data_tk = array(
	    			'data_timkiem' => $data['data_timkiem'],
					'ngaytimkiem'  => $data['ngaytimkiem'],
					'nguoithu'     => $data['nguoithu'],
	   				'thoigian'     => $data['thoigian'],
	    		);
	    	}
	    	$today = strtotime(date('Y-m-d'));
	    	$session = $this->session->userdata('user');
	    	$sinhvien = $this->Mthuphieudiem->dssv_tragiaybao(date('Y-m-d'), $session['macb']);
	    	$ds_sinhvien = array();
	    	foreach ($sinhvien as $key => $value) {
	    		$thoigian[$value['soBD']] = strtotime(substr($value['thoigian_tragiaybao'], 0,10)); 
	    		if($today == $thoigian[$value['soBD']]){
	    			$ds_sinhvien[] = $value;
	    		}
	    	}
	    	$temp = array(
				'template' => 'danhmuc/Vdatragiaybao',
				'data' => array(
					'message' 		=> getMessages(),
					'sinhvien' 		=> $ds_sinhvien,
					'danhmuc'  		=> $danhmuc,
					'data_timkiem'  => $data_tk,
				),
			);
        	$this->load->view('layout/content', $temp);
        	return;
	    }
	    public function timkiem(){
	   		$var 		= $this->input->post('ngaythu');
	   		$nguoithu   = $this->input->post('nguoithu');
	   		$thoigian   = $this->input->post('thoigian');
	    		//Convert dd/mm/yyyy => yyyy/mm/dd (giống trong mysql)
	   		$date = str_replace('/', '-', $var);
	   		$ngaythu = date('Y-m-d', strtotime($date));
	   		$data_danhsach = $this->Mthuphieudiem->danhsach_tragiaybao($ngaythu, $nguoithu, $thoigian);
	   		$ngaytimkiem = $this->input->post('ngaythu');
	   		$data = array(
	   			'data_timkiem'  => $data_danhsach,
	   			'ngaytimkiem'	=> $ngaytimkiem,
	   			'nguoithu'      => $nguoithu,
	   			'thoigian'      => $thoigian,
	   		);
	   		return $data;

	   	}
	    public function getDanhmuc(){
	    	if($this->input->post('action') == "huytrahoso"){
	    		$this->huytrahoso();
	    	}
	    	$nganh 				= $this->Mthuphieudiem->get('tbl_nganh');
	    	$dantoc 			= $this->Mthuphieudiem->get('dm_dantoc');
	    	$tongiao 			= $this->Mthuphieudiem->get('dm_tongiao');
	    	$data['tbl_canbo'] 	= $this->Mthuphieudiem->get('dm_canbo');
	    	$sinhvien   		= $this->Mthuphieudiem->get('tbl_sinhvien');
	    	foreach ($sinhvien as $value) {
	    		$data['diemchuan'][$value['soBD']] = $this->Mthuphieudiem->get_many_where('tbl_diemchuan',array('makhoi' => $value['khoihoc'], 'manganh' => $value['FK_sMaNganh']));
	    		$data['getban'][]  = explode("-", $value['sohs_nh'])[0];
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
	    	}
	    	return $data;
	    }
	     public function huytrahoso(){
	    	$sobd   = $this->input->post('sobd');
	    	$session = $this->session->userdata('user');
	    	$data = array(
	    		'nguoitra_giaybao'    => NULL,
	    		'thoigian_tragiaybao' => NULL,
	    		'trangthai'			  => 1,
	    	);
	    	$row = $this->Mthuphieudiem->update_set('tbl_sinhvien','soBD',$sobd,$data);
	    	$info 			 = $this->Mthuphieudiem->get_where_row('tbl_sinhvien','soBD',$sobd);
	    	$explode         = explode("-", $info['sohs_nh']);
	    	$ban 			 = 'ban'. substr($explode[0],1);
	    	$getSTT          = $this->Mthuphieudiem->getSTT($ban);
	    	$stt 			 = $getSTT['max'];
	    	$data = array(
	    		'buoctiep' => "buoc2",
	    		'stt'      => $stt,
	    	);
	    	$stt_all = $this->Mthuphieudiem->get_where_row('tbl_goi','ban', 'ban5');
	    	$tbl_goi = array(
	    		'stt'  => $stt,
	    	);
	    	$stt_all = array(
	    		'stt'  => $stt_all['stt'] + 1,
	    	);
	    	$row = $this->Mthuphieudiem->update_set('tbl_goi','ban','ban5', $stt_all);
	    	$row = $this->Mthuphieudiem->update_set('tbl_goi','ban',$ban,  $tbl_goi);
	    	$row = $this->Mthuphieudiem->update_set(' tbl_sinhvien', 'soBD', $sobd, $data);
    		if($row > 0){
	    		$notification = "success";
	    	}else{
	    		$notification = "error";
	    	}
	    	exit($notification);
	    }
	}
 ?>
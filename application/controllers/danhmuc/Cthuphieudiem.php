<?php 
	/**
	 * summary
	 */
	class Cthuphieudiem extends CI_Controller
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
	    	$notification 	 = "";
	    	$info 			 = "";
	    	$data 			 = "";
	    	$sobaodanh 		 ="";
	    	$canboxacnhan 	 = "";
	    	$nganhtrungtuyen = $this->Mthuphieudiem->get('tbl_nganh');
	    	$getMon 		 = array();
	    	$monhoc 		 = $this->monhoc();
	    	$session 		 = $this->session->userdata('user');
	    	$canbo 			 = $this->Mthuphieudiem->get('dm_canbo');
	    	
	    	foreach ($canbo as $value) {
	    		$canbo[$value['macb']] = $value['tencb'];
	    	}
	    	if($this->input->post('timkiem')){
	    		$sobaodanh = $this->input->post('sobaodanh');
	    		$info = $this->Mthuphieudiem->get_where('tbl_sinhvien','soBD',$sobaodanh);
	    		if(empty($info)){
	    			$notification = "Không có sinh viên trong danh sách nhập học!";
	    		}
	    		else{
	    			$tohop = $this->Mthuphieudiem->getToHop($sobaodanh);
	    			$getMon = $this->Mthuphieudiem->getMon($tohop, $sobaodanh);
	    			//Kiểm tra sinh viên đã được xác nhận hồ sơ chưa bằng cách kiểm tra có tồn tại giá trị nguoithuhs hay không.
	    			$explode         = explode("-", $info[0]['sohs_nh']);
	    			$ban 			 = 'ban'. substr($explode[0] ,1);
	    			$data 			 = $info[0];
	    			$data['ban']     = $ban;
	    		}
	    	}
	    	if($this->input->post('action') == "xacnhan"){
	    		$this->xacnhan();
	    	}
	    	if($this->input->post('action') == "chuyentiep"){
	    		$this->chuyentiep();
	    	}
	    	$temp = array(
	    		'template' => 'danhmuc/Vphieuthudiem',
	    		'data' => array(
	    			'data' 	   => $data,
	    			'message'  => getMessages(),
	    			'getMon'   			=> $getMon,
	    			'tenmon' 			=> $monhoc,
	    			'notification'      => $notification,
	    			'nganhtrungtuyen'	=> $nganhtrungtuyen,
	    			'canbo'				=> $canbo,
	    			'tenban'   			=> $this->tenban(),
	    			'danhmuc'		    => $this->getDanhmuc(),
	    		),
	    	);
	    	$this->load->view('layout/content', $temp);
	    }
	    public function chuyentiep(){
	    	$sobaodanh       = $this->input->post('sobd');
	    	$info 			 = $this->Mthuphieudiem->get_where_row('tbl_sinhvien','soBD',$sobaodanh);
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
	    	$row = $this->Mthuphieudiem->update_set(' tbl_sinhvien', 'soBD', $sobaodanh, $data);
	    	$dulieu  = array(
	    		'stt' => $stt,
	    		'ban' => substr($explode[0],1),
	    	);
	    	echo json_encode($dulieu);
	    	exit();
	    }
	    public function xacnhan(){
	    	$danhmuc 		 = $this->getDanhmuc();
	    	$sobaodanh       = $this->input->post('sobd');
	    	$buudien         = $this->input->post('buudien');
	    	$session         = $this->session->userdata('user');
	    	$info 			 = $this->Mthuphieudiem->get_where_row('tbl_sinhvien','soBD',$sobaodanh);
	    	if($info['trangthai']>1){
	    		$hoso = array(
		    		'nguoithu_phieudiem' 	 => $session['macb'],
		    		'thoigian_thuphieudiem'	 => date('Y-m-d H:i:s')
		    	);
	    	}else{
	    		$hoso = array(
		    		'nguoithu_phieudiem' 	 => $session['macb'],
		    		'thoigian_thuphieudiem'	 => date('Y-m-d H:i:s'),
		    		'trangthai'		         => 1,
		    	);
	    	}
	    	

	    	if(!empty($buudien)){
	    		$hoso['buudien']         = $buudien;
	    	}
	    	if(!empty($hoso['buudien'])){
	    		$session['buudien'] = $buudien;
	    		$this->session->set_userdata('user',$session);
	    	}
	    	else{
	    		unset($session['buudien']);
	    		$this->session->set_userdata('user', $session);
	    	}
	    	$explode         = explode("-", $info['sohs_nh']);
	    	$ban 			 = 'ban'. substr($explode[0],1);
	    	// if(!empty($buudien)){
		    	$getSTT          = $this->Mthuphieudiem->getSTT($ban);
		    	$stt 			 = $getSTT['max'];
		    	$data = array(
		    		'buoctiep' => "buoc2",
		    		'stt'      => $stt
		    	);
		    	$stt_all = $this->Mthuphieudiem->get_where_row('tbl_goi','ban', 'ban5');
		    	$tbl_goi = array(
		    		'stt'  => $stt
		    	);
		    	$stt_all   = array(
		    		'stt'  => $stt_all['stt'] + 1
		    	);
		    	$row = $this->Mthuphieudiem->update_set('tbl_goi','ban','ban5', $stt_all);
		    	$row = $this->Mthuphieudiem->update_set('tbl_goi','ban',$ban,  $tbl_goi);
		    	$row = $this->Mthuphieudiem->update_set(' tbl_sinhvien', 'soBD', $sobaodanh, $data);
	    	// }
	    	$row = $this->Mthuphieudiem->update_set('tbl_sinhvien','soBD',$sobaodanh,$hoso);
	    	if($row >= 0){
	    		$sinhvien = $this->Mthuphieudiem->get_where_row('tbl_sinhvien','soBD', $sobaodanh);
		    	$explode         = explode("-", $sinhvien['sohs_nh']);
		    	$ban 			 = 'ban'. substr($explode[0] ,1);
		    	$sinhvien['ban'] = $ban;
	    		$sinhvien['thoigian_thuphieudiem'] = date('d/m/Y H:i:s', strtotime($sinhvien['thoigian_thuphieudiem']));
	    		$sinhvien['nguoithu_phieudiem']    = $danhmuc['canbo'][$sinhvien['nguoithu_phieudiem']];
	    	}else{
	    		$sinhvien = 1;
	    	}
	    	$data = array(
	    		'sinhvien' => $sinhvien,
	    		'danhmuc'  => $danhmuc,
	    		'ban'      => substr($explode[0] ,1),
	    	);
	    	echo json_encode($data);
	    	exit();
	    }
	    public function danhsachthuphieudiem(){
	    	$data_danhsach 	= "";
	    	$ngaytimkiem 	= "";
	    	$data_tk 		= "";
	    	$danhmuc 		= $this->getDanhmuc();
	    	if($this->input->post('timkiem')){
	    		$data = $this->timkiem();
	    		$data_tk = array(
	    			'data_timkiem' => $data['data_timkiem'],
	    			'ngaytimkiem'  => $data['ngaytimkiem'],
	    			'nguoithu'     => $data['nguoithu'],
	    			'thoigian'     => $data['thoigian'],
	    		);
	    	}
	    	$today    = strtotime(date('Y-m-d'));
	    	$session  = $this->session->userdata('user');
	    	$sinhvien = $this->Mthuphieudiem->dssv_thuphieudiem(date('Y-m-d'), $session['macb']);
	    	$ds_sinhvien = array();
	    	foreach ($sinhvien as $key => $value) {
	    		$thoigian[$value['soBD']] = strtotime(substr($value['thoigian_thuphieudiem'], 0,10)); 
	    		if($today == $thoigian[$value['soBD']]){
	    			$ds_sinhvien[] = $value;
	    		}
	    	}
	    	$temp = array(
	    		'template' => 'danhmuc/Vdanhsachthuphieudiem',
	    		'data' => array(
	    			'message'  		=> getMessages(),
	    			'sinhvien' 		=> $ds_sinhvien,
	    			'data_timkiem' 	=> $data_tk,
	    			'danhmuc'   	=> $danhmuc
	    		),
	    	);
	    	$this->load->view('layout/content', $temp);
	    }
	    
	    // lấy tất cả danh mục
	    public function timkiem(){
	    	$var 		= $this->input->post('ngaythu');
	    	$nguoithu   = $this->input->post('nguoithu');
	    	$thoigian   = $this->input->post('thoigian');
	    		//Convert dd/mm/yyyy => yyyy/mm/dd (giống trong mysql)
	    	$date = str_replace('/', '-', $var);
	    	$ngaythu = date('Y-m-d', strtotime($date));
	    	$data_danhsach = $this->Mthuphieudiem->danhsach_thuphieudiem($ngaythu, $nguoithu, $thoigian);
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
	    	$nganh 				= $this->Mthuphieudiem->get('tbl_nganh');
	    	$dantoc 			= $this->Mthuphieudiem->get('dm_dantoc');
	    	$tongiao 			= $this->Mthuphieudiem->get('dm_tongiao');
	    	$data['tbl_canbo'] 	= $this->Mthuphieudiem->get('dm_canbo');
	    	$sinhvien   		= $this->Mthuphieudiem->get('tbl_sinhvien');
	    	$ban                = $this->Mthuphieudiem->get('tbl_goi');
	    	foreach ($ban as $value) {
	    		// $data['ban'][$value['ban']] = $value['stt'];
	    		$data['stt'][$value['ban']] = $value['stt'];
	    	}
	    	foreach ($sinhvien as $value) {
	    		$data['diemchuan'][$value['soBD']] = $this->Mthuphieudiem->get_many_where('tbl_diemchuan',array('makhoi' => $value['khoihoc'], 'manganh' => $value['FK_sMaNganh']));
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
	    public function monhoc(){
	    	$monhoc = array(
	    		'toan' 		=> 'Toán',
	    		'vatly' 	=> 'Vật Lý',
	    		'hoahoc' 	=> 'Hóa Học',
	    		'ngoaingu' 	=> 'Ngoai Ngữ',
	    		'sinhhoc' 	=> 'Sinh Học',
	    		'nguvan' 	=> 'Ngữ Văn',
	    		'lichsu' 	=> 'Lịch Sử',
	    		'dialy' 	=> 'Địa Lý',
	    		've'		=>	'Vẽ',
	    		'nangkhieu1'=>	'Năng khiếu 1',
	    		'nangkhieu2'=>	'Năng khiếu 2',
	    		'nangkhieu3'=>	'Năng khiếu 3',

	    	);
	    	return $monhoc;
	    }
	    public function tenban(){
	    	$arr = array(
	    		'ban1' => 'bàn số 1',
	    		'ban2' => 'bàn số 2',
	    		'ban3' => 'bàn số 3',
	    		'ban4' => 'bàn số 4',
	    		'ban5' => 'bàn số 5',
	    		'ban6' => 'bàn số 6',
	    		'ban7' => 'bàn số 7',
	    		'ban8' => 'bàn số 8',
	    		'ban9' => 'bàn số 9',
	    	);
	    	return $arr;
	    }
	}
	?>

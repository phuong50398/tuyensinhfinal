<?php 
	/**
	 * summary
	 */
	class Cthuphieudiem extends MY_Controller
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
	    			$data = $info[0];
	    		}
	    	}
	    	if($this->input->post('action') == "xacnhan"){
	    		$this->xacnhan();
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
	    		),
	    	);
	    	$this->load->view('layout/content', $temp);
	    }
	    public function xacnhan(){
	    	$sobaodanh       = $this->input->post('sobd');
	    	$session         = $this->session->userdata('user');
	    	$hoso = array(
	    		'nguoithu_phieudiem' 	 => $session['macb'],
	    		'thoigian_thuphieudiem'	 => date('Y-m-d H:i:s'),
	    		'trangthai'		         => 1
	    	);
	    	$danhmuc = $this->getDanhmuc();
	    	$row = $this->Mthuphieudiem->update_set('tbl_sinhvien','soBD',$sobaodanh,$hoso);
	    	if($row >= 0){
	    		$sinhvien = $this->Mthuphieudiem->get_where_row('tbl_sinhvien','soBD', $sobaodanh);
	    		$sinhvien['thoigian_thuphieudiem'] = date('d/m/Y H:i:s', strtotime($sinhvien['thoigian_thuphieudiem']));
	    		$sinhvien['nguoithu_phieudiem'] = $danhmuc['canbo'][$sinhvien['nguoithu_phieudiem']];
	    	}else{
				$sinhvien = 1;
	    	}
	    	echo json_encode($sinhvien);
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
	}
	?>

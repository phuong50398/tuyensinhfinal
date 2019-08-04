<?php 
	/**
	 * summary
	 */
	class Cruthoso extends MY_Controller
	{
	    /**
	     * summary
	     */
	    public function __construct()
	    {
	    	date_default_timezone_set("Asia/Ho_Chi_Minh");
	    	parent::__construct();
	    	$this->load->model('danhmuc/Mruthoso');

	    }
	    public function index(){
	    	$notification 	 = "";
	    	$info 			 = "";
	    	$data 			 = "";
	    	$sobaodanh 		 ="";
	    	$canboxacnhan 	 = "";
	    	$monhoc 		 = $this->monhoc();
	    	$nganhtrungtuyen = $this->Mruthoso->get('tbl_nganh');
	    	$getMon 		 = array();
	    	$session 		 = $this->session->userdata('user');
	    	$canbo 			 = $this->Mruthoso->get('dm_canbo');
	    	$hocphi 		 = $this->Mruthoso->get('tbl_hocphi');
	    	foreach ($hocphi as $key => $value) {
	    		$hocphi_hp[$value['mahp']] = $value['sTen_hocphi'];
	    	}
	    	$hocphi_dadong 	 = "";
	    	foreach ($canbo as $value) {
	    		$canbo[$value['macb']] = $value['tencb'];
	    	}
	    	if($this->input->post('timkiem')){
	    		$sobaodanh = $this->input->post('sobaodanh');
	    		$info = $this->Mruthoso->getdata_sinhvien($sobaodanh);
	    		// pr($info);
	    		if(empty($info)){
	    			$notification = "Không có sinh viên trong danh sách nhập học!";
	    		}
	    		else{
	    			$tohop = $this->Mruthoso->getToHop($sobaodanh);
	    			$getMon = $this->Mruthoso->getMon($tohop, $sobaodanh);
	    			$data 			 = $info[0];
	    			$hocphi_dadong = $this->Mruthoso->hocphi_dadong($data['masv']);
	    		}
	    	}
	    	if($this->input->post('action')=='ruthoso'){
	    		$this->ruthoso();
	    	}
	    	if($this->input->post('action')=='huyruthoso'){
	    		$this->huyruthoso();
	    	}
	    	$temp = array(
	    		'template' => 'danhmuc/Vruthoso',
	    		'data' => array(
	    			'data' 	  			=> $data,
	    			'getMon'   			=> $getMon,
	    			'tenmon' 			=> $monhoc,
	    			'hocphi' 			=> $hocphi_hp,
	    			'nganhtrungtuyen'	=> $nganhtrungtuyen,
	    			'hocphi_dadong'		=> $hocphi_dadong,
	    			'notification'      => $notification,
	    			'message'  			=> getMessages(),
	    		),
	    	);
	    	$this->load->view('layout/content', $temp);
	    }
	    public function ruthoso(){
            $session          = $this->session->userdata('user');
	    	$data_hocphi = "";
	    	$data = $this->input->post('data');
	    	foreach ($data as $key => $value) {
	    		$data_hocphi[$key] = str_replace(",", "", $value);
	    	}
	    	foreach ($data_hocphi as $key => $value) {
	    		if($value==""){
	    			$data_hocphi[$key] = 0;
	    		}
	    	}
	    	$data_hocphi['nguoi_ruthoso'] 	 = $session['tencb'];
	    	$data_hocphi['thoigian_ruthoso'] = date('Y-m-d H:i:s');
	    	$trangthai['trangthai'] = 5;
	    	$this->Mruthoso->insert('ruthoso_sinhvien',$data_hocphi);
	    	$this->Mruthoso->update('tbl_sinhvien','soBD',$data_hocphi['soBD'],$trangthai);
	    	$notification = "Rút hồ sơ thành công";
	    	$data = array(
	    		'notification' => $notification
	    	);
	    	echo json_encode($data);
	    	exit();
	    }
	    public function huyruthoso(){
	    	$data = $this->input->post('data');
	    	$trangthai['trangthai'] = 4;
	    	$this->Mruthoso->update('tbl_sinhvien','soBD',$data['soBD'],$trangthai);
	    	$this->Mruthoso->delete('ruthoso_sinhvien','soBD',$data['soBD']);
	    	$notification = "Hủy rút hồ sơ thành công";
	    	$data = array(
	    		'notification' => $notification
	    	);
	    	echo json_encode($data);
	    	exit();
	    }
	    public function getDanhmuc(){
	    	$nganh 				= $this->Mruthoso->get('tbl_nganh');
	    	$dantoc 			= $this->Mruthoso->get('dm_dantoc');
	    	$tongiao 			= $this->Mruthoso->get('dm_tongiao');
	    	$data['tbl_canbo'] 	= $this->Mruthoso->get('dm_canbo');
	    	$sinhvien   		= $this->Mruthoso->get('tbl_sinhvien');
	    	$ban                = $this->Mruthoso->get('tbl_goi');
	    	foreach ($ban as $value) {
	    		// $data['ban'][$value['ban']] = $value['stt'];
	    		$data['stt'][$value['ban']] = $value['stt'];
	    	}
	    	foreach ($sinhvien as $value) {
	    		$data['diemchuan'][$value['soBD']] = $this->Mruthoso->get_many_where('tbl_diemchuan',array('makhoi' => $value['khoihoc'], 'manganh' => $value['FK_sMaNganh']));
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
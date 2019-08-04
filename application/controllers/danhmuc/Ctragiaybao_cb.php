<?php 
	/**
	 * summary
	 */
	class Ctragiaybao_cb extends MY_Controller
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
	   		$dssv = $this->Mthuphieudiem->getdssv_tragiaybao();
	    	$canbo  = $this->Mthuphieudiem->get('dm_canbo');
	    	$timkiem = array();
	    	foreach ($canbo as $value) {
	    		$canbo[$value['macb']] = $value['tencb'];
	    	}
	    	if($this->input->post('timkiem')){
	    		$timkiem = $this->timkiem();
	    	}
	    	$temp = array(
				'template' => 'danhmuc/Vtragiaybao_cb',
				'data' => array(
					'message'   => getMessages(),
					'canbo'		=> $canbo,
					'danhmuc'   => $danhmuc,
					'dssv'      => $dssv,
					'timkiem'   => $timkiem,
				),
			);
        	$this->load->view('layout/content', $temp);
	    }
	    public function timkiem(){
	    	$data['soban'] = $this->input->post('chonban');
		    $tbl_sinhvien = $this->Mthuphieudiem->get_where('tbl_sinhvien','trangthai>=', 1);
		    $data['dssvban'] = array();
		    $dssv = $this->Mthuphieudiem->getdssv_tragiaybao();
	    	if($data['soban'] == "all"){
				$data['dssvban'] = $dssv; 
	    	}else{
		    	foreach ($tbl_sinhvien as $value) {
		    		$ds[$value['soBD']] = explode("-", $value['sohs_nh'])[0];
		    		if($ds[$value['soBD']] == $data['soban']){
		    			$data['dssvban'][] = $value;
		    		}
		    	}
	    	}
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
    		if($row > 0){
	    		$notification = "success";
	    	}else{
	    		$notification = "error";
	    	}
	    	exit($notification);
	    }
	}
 ?>
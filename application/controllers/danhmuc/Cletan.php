<?php 
	/**
	 * summary
	 */
	class Cletan extends MY_Controller
	{
	    /**
	     * summary
	     */
	    public function __construct()
	    {
	    	date_default_timezone_set("Asia/Ho_Chi_Minh");
	        parent::__construct();
	        $this->load->model('danhmuc/Mthuphieudiem');
	        $this->load->model('danhmuc/Mhotro_nhaphoc');
	        $this->load->model('danhmuc/Mthuhoso_nhaphoc');
	    }
	    public function index(){
	    	$monhoc = $this->monhoc();
	    	$data   = array(); 
	    	$getMon = array();
	    	if($this->input->get('sobd')){
	    		$sobd = $this->input->get('sobd');
	    		$data = $this->Mhotro_nhaphoc->get_where_row('tbl_sinhvien','soBD',$sobd);
	    		if(!empty($data)){
	    			$tohop = $this->Mhotro_nhaphoc->getToHop($sobd);
	    			$getMon = $this->Mhotro_nhaphoc->getMon($tohop, $sobd);
	    		}else{
	    			$notification = "Không có sinh viên trong danh sách nhập học!";
	    		}
	    	}
	    	if($this->input->get('tragiaybao')){
	    		$this->chuyentiep3();
	    	}
	    	if($this->input->get('thuhoso')){
	    		$this->chuyentiep5();
	    	}
	    	if($this->input->get('thutaichinh')){
	    		$this->chuyentiep7();
	    	}
	    	$temp = array(
				'template' => 'danhmuc/Vletan',
				'data' => array(
					'message'  => getMessages(),
					'data'      		=> $data,
	    			'getMon'   			=> $getMon,
	    			'tenmon' 			=> $monhoc,
	    			'danhmuc'			=> $this->getDanhmuc(),
				),
			);
        	$this->load->view('layout/content', $temp);
	    }
	    public function chuyentiep3(){
	    	$sobaodanh       = $this->input->get('tragiaybao');
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
	    	setMessages('warning','<p>Bạn vừa chuyển tiếp sinh viên đến bước Trả giấy báo</p><p>Họ tên: '.$info['hoten'] .'</p><p> Bàn: '.substr($explode[0],1) .'</p><p> STT: '.$stt .'</p>',
	    		'Thông báo');
	   		return redirect('tiepdon?sobd='. $sobaodanh);
	    }
	    public function chuyentiep5(){
	    	$sobaodanh = $this->input->get('thuhoso');
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
    		
    		$dulieu  = array(
	    		'stt' => $stt,
	    		'ban' => substr($explode[0],1),
	    		'hoten' => $info['hoten']
	    	);
	    	setMessages('warning','<p>Bạn vừa chuyển tiếp sinh viên đến bước Thu hồ sơ</p><p>Họ tên: '.$info['hoten'] .'</p><p> STT: '.$stt .'</p>',
	    		'Thông báo');
	   		return redirect('tiepdon?sobd='. $sobaodanh);
	    }
	    function chuyentiep7()
	    {
	    	$sobaodanh = $this->input->get('thutaichinh');
	    	$info 			 = $this->Mthuhoso_nhaphoc->get_where_row('tbl_sinhvien','soBD',$sobaodanh);
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
	    	setMessages('warning','<p>Bạn vừa chuyển tiếp sinh viên đến bước Thu tài chính</p><p>Họ tên: '.$info['hoten'] .'</p><p> STT: '.$stt .'</p>',
	    		'Thông báo');
	   		return redirect('tiepdon?sobd='. $sobaodanh);
	    }
	   public function getDanhmuc(){
	    	$nganh 				= $this->Mthuphieudiem->get('tbl_nganh');
	    	$dantoc 			= $this->Mthuphieudiem->get('dm_dantoc');
	    	$tongiao 			= $this->Mthuphieudiem->get('dm_tongiao');
	    	$data['tbl_canbo'] 	= $this->Mthuphieudiem->get('dm_canbo');
	    	$sinhvien   		= $this->Mthuphieudiem->get('tbl_sinhvien');
	    	$ban                = $this->Mthuphieudiem->get('tbl_goi');
	    	$data['tbl_nganh'] = $this->Mhotro_nhaphoc->get('tbl_nganh');
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
	}
 ?>
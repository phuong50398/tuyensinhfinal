<?php 
	/**
	 * summary
	 */
	class Cdkttsv extends MY_Controller
	{
	    /**
	     * summary
	     */
	    public function __construct()
	    {
	    	parent::__construct();
	    	$this->load->Model('danhmuc/Mdkttsv');
	    }
	    public function index(){
	    	$monhoc = array(
	    		'toan' 		=> 'Toán',
	    		'vatly' 	=> 'Vật Lý',
	    		'hoahoc' 	=> 'Hóa Học',
	    		'ngoaingu' 	=> 'Ngoai Ngữ',
	    		'sinhhoc' 	=> 'Sinh Học',
	    		'nguvan' 	=> 'Ngữ Văn',
	    		'lichsu' 	=> 'Lịch Sử',
	    		'dialy' 	=> 'Địa Lý',
	    		'nangkhieu1'=> 'Năng khiếu 1',
	    		'nangkhieu2'=> 'Năng khiếu 2',
	    		'nangkhieu3'=> 'Năng khiếu 3',
	    	);
	    	$session  		= $this->session->userdata('user');
	    	$sinhvien 		= $this->Mdkttsv->get_where_row('tbl_sinhvien','soBD', $session['soBD']);
	    	$get_khoihoc 	= $this->Mdkttsv->get('tbl_khoihoc');
	    	$nganhtrungtuyen = $this->Mdkttsv->get('tbl_nganh');
	    	$tohop 			= $this->Mdkttsv->getToHop($sinhvien['khoihoc']);
	    	$dantoc 		= $this->Mdkttsv->get('dm_dantoc');
	    	$tongiao 		= $this->Mdkttsv->get('dm_tongiao');
	    	$dmtinh	   		= $this->Mdkttsv->get('dm_tinh');
	    	$dmhuyen	    = $this->Mdkttsv->get('dm_huyen');
	    	$dmxa	   		= $this->Mdkttsv->get('dm_xa');
	    	if($this->input->post('action')=='get_huyen'){
	    		$matinh = $this->input->post('matinh');
	    		$data = $this->Mdkttsv->get_where('dm_huyen','matinh',$matinh);
	    		echo json_encode($data);
	    		exit();
	    	}
	    	if($this->input->post('action')=='get_xa'){
	    		$mahuyen = $this->input->post('mahuyen');
	    		$data = $this->Mdkttsv->get_where('dm_xa','mahuyen',$mahuyen);
	    		echo json_encode($data);
	    		exit();
	    	}
	    	if($this->input->post('xacnhan')){
	    		$this->xacnhan($session);
	    	}
	    	$temp = array(
	    		'template' => 'danhmuc/Vdkttsv',
	    		'data' => array(
	    			'getDiem'  => $this->Mdkttsv->getDiemToHop($session['soBD'], $tohop),
	    			'sinhvien' => $sinhvien,
	    			'message'  => getMessages(),
	    			'nganhtrungtuyen'   => $nganhtrungtuyen,
	    			'monhoc'   => $monhoc,
	    			'dantoc'   => $dantoc,
	    			'dmtinh'   	=> $dmtinh,
	    			'dmhuyen'   => $dmhuyen,
	    			'dmxa' 	  	=> $dmxa,
	    			'tongiao'  => $tongiao
	    		),
	    	);
	    	// pr($temp);
	    	$this->load->view('layout/content', $temp);
	    }
	    public function xacnhan($session){
	    	$data             		  	= $this->input->post('data');
	    	$data_sv['noisinh'] 		= $data['noisinh'];
	    	$data_sv['ngaycapcmnd'] 	= $data['ngaycapcmnd'];
	    	$data_sv['noicapcmnd'] 		= $data['noicapcmnd'];
	    	$data_sv['gioitinh'] 		= $data['gioitinh'];
	    	$data_sv['doan'] 			= $data['doan'];
	    	$data_sv['FK_tongiao'] 		= $data['FK_tongiao'];
	    	$data_sv['quequan'] 		= $data['quequan'];
	    	$data_sv['hokhau'] 			= $data['hokhau'];
	    	$data_sv['FK_Dantoc'] 		= $data['FK_Dantoc'];
	    	$data_sv['diachi']			= $data['diachi'];
	    	$data_sv['chucvu'] 			= $data['chucvu'];
	    	$data_sv['nangkhieu'] 		= $data['nangkhieu1'];
	    	$data_sv['noitotnghiep'] 	= $data['noitotnghiep'];
	    	$data_sv['email']			= $data['email'];
	    	$data_sv['sdt']				= $data['sdt'];
	    	$data_sv['hoten_bo'] 		= $data['hoten_bo'];
	    	$data_sv['namsinh_bo'] 		= $data['namsinh_bo'];
	    	$data_sv['nghenghiep_bo'] 	= $data['nghenghiep_bo'];
	    	$data_sv['sdt_bo'] 			= $data['sdt_bo'];
	    	$data_sv['hoten_me'] 		= $data['hoten_me'];
	    	$data_sv['namsinh_me']		= $data['namsinh_me'];
	    	$data_sv['nghenghiep_me'] 	= $data['nghenghiep_me'];
	    	$data_sv['sdt_me']			= $data['sdt_me'];
	    	$data_sv['tinh']			= $data['tinh'];
	    	$data_sv['huyen']			= $data['huyen'];
	    	$data_sv['xa']				= $data['xa'];
	    	// pr($data_sv);
	    	$row = $this->Mdkttsv->update('tbl_sinhvien','soBD', $session['soBD'], $data_sv);
	    	if($row >= 0){
	    		setMessages('success','Cập nhật thông tin thành công',' Thông báo');
	    		return redirect('Dang-ky-thong-tin-sinh-vien');
	    	}else{
	    		setMessages('error','Cập nhật thông tin thất bại',' Thông báo');
	    		return redirect('Dang-ky-thong-tin-sinh-vien');
	    	}
	    }
	    public function dangkythanhcong(){
	    	$temp = array(
	    		'template' => 'danhmuc/Vdangkyxong',
	    		'data' => array(
	    			'message'  => getMessages(),
	    		),
	    	);
	    	$this->load->view('layout/content', $temp);
	    	return;
	    }
	}
	?>
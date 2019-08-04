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
	        parent::__construct();
	        $this->load->model('Mthuphieudiem');
	    }
	    public function index(){
	    	$notification = "";
	    	$info = "";
	    	$data = "";
	    	$sobaodanh ="";
	    	$nganhtrungtuyen = $this->Mthuphieudiem->get('tbl_nganh');
	    	$getMon = array();
	    	$monhoc = array();
	    	if($this->input->post('timkiem')){
	    		$sobaodanh = $this->input->post('sobaodanh');
	    		$info = $this->Mthuphieudiem->get_where('tbl_sinhvien','soBD',$sobaodanh);
	    		if(empty($info)){
						$notification = "Không có sinh viên trong danh sách nhập học!";
	    		}
	    		else{
	    			$tohop = $this->Mthuphieudiem->getToHop($sobaodanh);
	    			$getMon = $this->Mthuphieudiem->getMon($tohop, $sobaodanh);
	    			$monhoc = array(
	    				'toan'     => 'Toán',
	    				'vatly'    => 'Lý',
	    				'hoahoc'   => 'Hóa',
	    				'ngoaingu' => 'Ngoại ngữ'
	    			);
	    			$data = $info[0];
	    		}
	    	}
	    	if($this->input->post('xacnhan')){
	    		$sobaodanh = $this->input->post('sobaodanh');
	    		$session = $this->session->userdata('user');
	    		$hoso = array(
	    		'nguoithuhs' 		=> $session['macb'],
	    		'thoigian_thuhs'	=> date('H:i:s d-m-Y')
	    		);

	    		$row = $this->Mthuphieudiem->update_set('tbl_sinhvien','soBD',$sobaodanh,$hoso);
	    		if($row >= 0){
	    		setMessages('success','Xác nhận hồ sơ thành công',' Thông báo');
	    		return redirect('Thu-phieu-diem');
	    		}else{
	    		setMessages('error','Xác nhận hồ sơ thất bại vui lòng kiểm tra lại !!!',' Thông báo');
	    		return redirect('Thu-phieu-diem');
	    	}
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
				),
			);
        	$this->load->view('layout/content', $temp);
	    }
	}
 ?>
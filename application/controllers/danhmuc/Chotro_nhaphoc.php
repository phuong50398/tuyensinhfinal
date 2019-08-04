<?php 
	/**
	 * Mạnh hùng -Zippy
	 * summary
	 */
	class Chotro_nhaphoc extends MY_Controller
	{
	    /**
	     * summary
	     */
	    public function __construct()
	    {
	    	parent::__construct();
	    	$this->load->model('danhmuc/Mhotro_nhaphoc');
			date_default_timezone_set('Asia/Ho_Chi_Minh');
	    }
	    public function index(){
	    	$nganhtrungtuyen = $this->Mhotro_nhaphoc->get('tbl_nganh');
	    	$dmdantoc = $this->Mhotro_nhaphoc->get('dm_dantoc');
	    	if($this->input->post('luuhoso')){
	    		$this->luuhoso();
	    	}
	    	//Dữ liệu sinh viên
	    	$data = array();
	    	$getMon = array();
	    	$monhoc = $this->monhoc();
	    	$dmtinh	   		= $this->Mhotro_nhaphoc->get('dm_tinh');
	    	$dmhuyen	    = $this->Mhotro_nhaphoc->get('dm_huyen');
	    	$dmxa	   		= $this->Mhotro_nhaphoc->get('dm_xa');
	    	$notification = '';
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
	    	if($this->input->post('action')=='get_huyen'){
	    		$matinh = $this->input->post('matinh');
	    		$data = $this->Mhotro_nhaphoc->get_where('dm_huyen','matinh',$matinh);
	    		echo json_encode($data);
	    		exit();
	    	}
	    	if($this->input->post('action')=='get_xa'){
	    		$mahuyen = $this->input->post('mahuyen');
	    		$data = $this->Mhotro_nhaphoc->get_where('dm_xa','mahuyen',$mahuyen);
	    		echo json_encode($data);
	    		exit();
	    	}
	    	$dmtongiao = $this->Mhotro_nhaphoc->get('dm_tongiao');
	    	$temp = array(
	    		'template' => 'danhmuc/Vhotro_nhaphoc',
	    		'data'     => array(
	    			'message' 			=> getMessages(),
	    			'nganhtrungtuyen'   => $nganhtrungtuyen,
	    			'dmdantoc'   		=> $dmdantoc,
	    			'dmtongiao'   		=> $dmtongiao,
	    			'data'      		=> $data,
	    			'getMon'   			=> $getMon,
	    			'tenmon' 			=> $monhoc,
	    			'dmtinh'   			=> $dmtinh,
	    			'dmhuyen'   		=> $dmhuyen,
	    			'dmxa' 	  			=> $dmxa,
	    			'notification'      => $notification,
	    		),
	    	);
	    	$this->load->view('layout/content', $temp);
	    }
	    public function luuhoso(){
	    	$session 					= $this->session->userdata('user');
	    	$data    					= $this->input->post('data');
	    	// pr($data);
	    	$data['nguoinhaphs'] 		= $session['tencb'];
	    	$data['thoigian_nhaphs']	= date('Y/m/d H:i:s');
	    	if (!empty($_FILES['photos']['name'])) {
	    		$this->save_anh();
	    	}
	    	$sobaodanh = $this->input->post('sobd');
	    	if(empty($sobaodanh)){
	    		setMessages('error','Không có số báo danh! Xin mời bạn nhập số báo danh.',' Thông báo');
	    		return redirect('Ho-tro-nhap-hoc');
	    	}
	    	$date = date('H:i:s d-m-Y', time());
	    	$row = $this->Mhotro_nhaphoc->update_set('tbl_sinhvien','soBD',$sobaodanh,$data);
	    	if($row >= 0){
	    		setMessages('success','Cập nhật thông tin thành công',' Thông báo');
	    		return redirect('Ho-tro-nhap-hoc?sobd='.$sobaodanh);
	    	}else{
	    		setMessages('error','Cập nhật thông tin thất bại',' Thông báo');
	    		return redirect('Ho-tro-nhap-hoc?sobd='.$sobaodanh);
	    	}
	    }
	    public function save_anh(){
	    		//Gán tên ảnh = số báo danh của sinh viên
	    		$ten_anh = $this->input->post('sobd');
	    		$config['upload_path'] = './public/sinhvien';
	    		$config['allowed_types'] = 'jpg|png|jpeg|gif';
	    		// File name = $ten_anh
	    		$config['file_name'] = $ten_anh.'.jpg';
	    		$this->load->library('upload', $config);
	    		$this->upload->initialize($config);
	    		//Kiểm tra xem file đã tồn tại trong thư mục chưa
	    		$name = './public/sinhvien/'.$ten_anh.'.jpg';
	    		if(file_exists($name)){
		    			unlink($name);
	    			if ($this->upload->do_upload('photos')){
		    			$uploadData 	    = $this->upload->data();
		    			$data["photos"] 	= $uploadData['file_name'];
	    			}
	    		}
	    		else{
	    			if ($this->upload->do_upload('photos')){
	    				$uploadData 	    = $this->upload->data();
	    				$data["photos"] 	= $uploadData['file_name'];
	    			}
	    		}
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
	    		'nangkhieu1'=> 'Năng khiếu 1',
	    		'nangkhieu2'=> 'Năng khiếu 2',
	    		'nangkhieu3'=> 'Năng khiếu 3',
	    	);
	    	return $monhoc;
	    }
	}
	?>
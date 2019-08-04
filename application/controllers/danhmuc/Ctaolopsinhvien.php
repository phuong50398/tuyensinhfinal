<?php 
	/**
	 * summary
	 */
	class Ctaolopsinhvien extends MY_Controller
	{
	    /**
	     * summary
	     */
	    public function __construct()
	    {
	    	date_default_timezone_set("Asia/Ho_Chi_Minh");
	        parent::__construct();
	        $this->load->model('danhmuc/Mxeplop');
	    }
	    public function index(){
	    	if($this->input->post('them')){
	    		$this->taolop();
	    	}
	    	$danhmuc  = $this->getDanhmuc();
	    	$sinhvien = $this->Mxeplop->get_where('tbl_sinhvien','masv !=', ""); 
	    	$temp = array(
				'template' => 'danhmuc/Vtaolopsinhvien',
				'data' => array(
					'message'  => getMessages(),
					'sinhvien' => $sinhvien,
					'danhmuc'  => $danhmuc
				),
			);
        	$this->load->view('layout/content', $temp);
	    }

	    public function taolop(){
	    	$data 				 = $this->input->post('data');
	    	$data['thoigiantao'] = date('d/m/Y H:i:s');
	    	$check 				 = $this->Mxeplop->get_many_where('tbl_lophoc',array('tenlop' => $data['tenlop'], 'FK_nganh' =>$data['FK_nganh'] ));
	    	$check_malop 				 = $this->Mxeplop->get_many_where('tbl_lophoc',array('malop' => $data['malop'] ));
	    	if(!empty($check) || !empty($check_malop)){
	    		setMessages('error','Lớp học đã bị trùng trong ngành học này hoặc mã lớp đã bị trùng! Xin vui lòng kiểm tra lại.',' Thông báo');
	    		return redirect('tao-lop-sinh-vien');
	    	}
	    	$row = $this->Mxeplop->insert('tbl_lophoc', $data);
	    	if($row > 0){
	    		setMessages('success','Tạo lớp thành công',' Thông báo');
	    		return redirect('tao-lop-sinh-vien');
	    	}else{
	    		setMessages('error','Tạo lớp thông tin thất bại',' Thông báo');
	    		return redirect('tao-lop-sinh-vien');
	    	}
	    }
	    // lấy tất cả danh mục
	    public function getDanhmuc(){
	    	$data['nganh']      =  $this->Mxeplop->get('tbl_nganh');
	    	$data['lophoc']     =  $this->Mxeplop->get_order('tbl_lophoc','tenlop','ASC');
	    	$dantoc 			= $this->Mxeplop->get('dm_dantoc');
	    	$tongiao 			= $this->Mxeplop->get('dm_tongiao');
	    	$data['tbl_canbo'] 	= $this->Mxeplop->get('dm_canbo');
	    	$sinhvien   		= $this->Mxeplop->get('tbl_sinhvien');
	    	foreach ($sinhvien as $value) {
	    		$data['diemchuan'][$value['soBD']] = $this->Mxeplop->get_many_where('tbl_diemchuan',array('makhoi' => $value['khoihoc'], 'manganh' => $value['FK_sMaNganh']));
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
	    	foreach ($data['nganh'] as $value) {
	    		$data['tennganh'][$value['iMa_nganh']] = $value['sTen_Nganh'];
	    		// $data['khoa'][$value['iMa_nganh']]  = $this->Mxeplop->get_Khoa($value['iMa_nganh']) ;
	    	}
	    	return $data;
	    }
	}
?>
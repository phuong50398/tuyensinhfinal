<?php 
	/**
	 * summary
	 */
	class Ccanbo extends CI_Controller
	{
	    /**
	     * summary
	     */
	    public function __construct()
	    {
	        parent::__construct();
	        $this->load->model('canbo/Mcanbo');
	    }
	    public function index(){
	    	$danhmuc      = $this->getDanhmuc();
	    	$timkiem      = array();
	    	if($this->input->post('dangkycanbo')){
	    		$this->themcanbo();
		    }
		    if($this->input->post('xoacb')){
		    	$macb = $this->input->post('xoacb');
	    		$this->xoacanbo($macb);
		    }
		    if($this->input->post('suacb')){
		    	$macb    = $this->input->post('suacb');
	    		$timkiem = $this->Mcanbo->get_where_row('dm_canbo', 'macb', $macb);
		    }
        	$temp = array(
	    		'template' => 'canbo/Vcanbo',
	    		'data'     => array(
	    			'canbo'       => $this->Mcanbo->get('dm_canbo'),
	    			'message' 	  => getMessages(),
	    			'danhmuc'	  => $danhmuc,
	    			'checkcb'     => $timkiem
	    		),
	    	);
        	$this->load->view('layout/content', $temp);
	    }
	    public function xoacanbo($macb){
	    	$row = $this->Mcanbo->delete('dm_canbo', 'macb',$macb);
	    	if($row > 0){
	    		setMessages('success','Xóa cán bộ thành công',' Thông báo');
	    		return redirect('Can-bo');
	    	}else{
	    		setMessages('error','Xóa cán bộ thất bại',' Thông báo');
	    		return redirect('Can-bo');
	    	}
	    }
	    public function themcanbo(){
			$data 			  = $this->input->post('data');
			$checkcb = $this->Mcanbo->get_where_row('dm_canbo', 'macb', $data['macb']);
			if(!empty($checkcb)){
				if(empty($data['matkhau'])){
					$data['matkhau']  = $checkcb['matkhau'];
				}else{
					$data['matkhau']  = sha1($data['matkhau']);
				}
				$row = $this->Mcanbo->update_set('dm_canbo','macb', $data['macb'], $data);	
				if($row >= 0){
					setMessages('success','Cập nhật thông tin thành công',' Thông báo');
					return redirect('Can-bo');
				}else{
					setMessages('error','Cập nhật thông tin thất bại',' Thông báo');
					return redirect('Can-bo');
				}
			}else {
				$data['matkhau']  = sha1($data['matkhau']);
				$row = $this->Mcanbo->insert('dm_canbo',$data);	
	    		if($row >= 0){
	    		setMessages('success','Thêm thông tin thành công',' Thông báo');
	    		return redirect('Can-bo');
		    	}else{
		    		setMessages('error','Thêm thông tin thất bại',' Thông báo');
		    		return redirect('Can-bo');
		    	}
			}
			
	    }
	      // lấy tất cả danh mục
	    public function getDanhmuc(){
	    	$nganh 				= $this->Mcanbo->get('tbl_nganh');
	    	$data['tbl_khoa']   = $this->Mcanbo->get('dm_khoa');
	    	$data['tbl_canbo'] 	= $this->Mcanbo->get('dm_canbo');
	    	$data['quyen']      = $this->Mcanbo->get('tbl_quyen');

	    	foreach ($data['tbl_canbo'] as $value) {
	    		$data['canbo'][$value['macb']] = $value['tencb'];
	    	}
	    	foreach ($nganh as $value) {
	    		$data['nganh'][$value['iMa_nganh']] = $value['sTen_Nganh'];
	    	}
	    	foreach ($data['tbl_khoa'] as $value) {
	    		$data['khoa'][$value['makhoa']] = $value['tenkhoa'];
	    	}
	    	return $data;
	    }
	}
 ?>
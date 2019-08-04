<?php 
	/**
	 * summary
	 */
	class Cdangkithongtin extends CI_Controller
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
	    	$session      = $this->session->userdata('user');
	    	if($this->input->post('capnhat')){
	    		$data = $this->input->post('data');
	    		$data['tencb'] = 'DKTT('.$data['tencb'].')';
	    		$session['tencb'] = $data['tencb'];
	    		$this->session->set_userdata('user',$session);
	    		$row = $this->Mcanbo->update_set('dm_canbo','macb', $session['macb'], $data);
	    		if ($row > 0){
	    			setMessages('success','Cập nhật thành công!', 'Thông báo');
	    			return redirect('Dang-ky-thong-tin-can-bo-nhap-hoc');
	    		}
	    	}
        	$temp = array(
	    		'template' => 'canbo/Vdangkythongtin',
	    		'data'     => array(
	    			'canbo'       => $this->Mcanbo->get('dm_canbo'),
	    			'message' 	  => getMessages(),
	    			'danhmuc'	  => $danhmuc,
	    		),
	    	);
        	$this->load->view('layout/content', $temp);
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
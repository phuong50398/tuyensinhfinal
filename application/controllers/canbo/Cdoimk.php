<?php 
	/**
	 * summary
	 */
	class Cdoimk extends My_Controller
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
	    	$timkiem      = array();
	    	if($this->input->post('doimk')){
	    		$this->doimk();
		    }


        	$temp = array(
	    		'template' => 'canbo/Vdoimk',
	    		'data'     => array(
	    			'canbo'       => $this->Mcanbo->get('dm_canbo'),
	    			'message' 	  => getMessages(),
	    			'checkcb'     => $timkiem
	    		),
	    	);
        	$this->load->view('layout/content', $temp);
	    }
	    public function doimk(){
			$ss =  $this->session->get_userdata('user')['user'];
			$password 			  = $this->input->post('password');
			$newpassword 			  = $this->input->post('newpassword');
			$repassword 			  = $this->input->post('repassword');
			if($newpassword!=$repassword){
				setMessages('error','Mật khẩu nhập lại không đúng',' Thông báo');
			}else{
				$checkuser = $this->Mcanbo->getCB($ss['macb'],$password);
				if(!empty($checkuser)){
					$doimk = $this->Mcanbo->doiMk($ss['macb'],$newpassword);
					if($doimk>0){
						setMessages('success','Đổi mật khẩu thành công',' Thông báo');
					}else{
						setMessages('error','Có lỗi xảy ra. Vui lòng thử lại sau',' Thông báo');
					}
				}else{
					setMessages('error','Mật khẩu hiện tại không chính xác, xin vui lòng thử lại',' Thông báo');
				}
			}
			return redirect('doimk');

			
			
	    }

	    function resetbuoctiep()
	    {
	    	if($this->input->post('resetbuoctiep')){
		    	// pr(1);
	    		$this->reset();
		    }
	    	$temp = array(
	    		'template' => 'canbo/Vresetbuoctiep',
	    		'data'     => array(
	    			'goi'       => $this->Mcanbo->get('tbl_goi'),
	    			'message' 	  => getMessages()
	    		),
	    	);
        	$this->load->view('layout/content', $temp);

	    	
	    }

	    function reset()
	    {
	    	$this->Mcanbo->resetbuoctiep();
	    	setMessages('success','Reset thành công',' Thông báo');
	    	return redirect('resetbuoctiep');
	    }
	    
	}
 ?>
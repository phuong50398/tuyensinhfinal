<?php 
	/**
	 * summary
	 */
	class Cthuhoso extends MY_Controller
	{
	    /**
	     * summary
	     */
	    public function __construct()
	    {
	        parent::__construct();
	    }
	    public function index(){

	    	if($this->input->get('inhoso')){
	    		pr(1);
	    	}
	    	$data['message'] = getMessages();
	    	$temp['data'] = $data;
        	$temp['template'] = 'danhmuc/Vthuhoso';
        	$this->load->view('layout/content', $temp);
	    }
	}
 ?>
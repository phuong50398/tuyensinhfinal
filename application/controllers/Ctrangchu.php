<?php 
	/**
	 * summary
	 */
	class Ctrangchu extends CI_Controller
	{
	    /**
	     * summary
	     */
	    public function __construct()
	    {
	        parent::__construct();
	    }
	    public function index(){
	    	$session          = $this->session->userdata('user');
	    	$data['message'] = getMessages();
	    	$temp['data'] = $data;
        	$temp['template'] = 'Vtrangchu';
        	$this->load->view('layout/content', $temp);
	    }
	}
 ?>
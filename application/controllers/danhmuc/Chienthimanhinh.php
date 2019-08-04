<?php 
	/**
	 * summary
	 */
	class Chienthimanhinh extends CI_Controller
	{
	    /**
	     * summary
	     */
	    public function __construct()
	    {
	    	date_default_timezone_set("Asia/Ho_Chi_Minh");
	    	parent::__construct();
	    	$this->load->model('danhmuc/Mhienthi_manhinh');
	    	
	    }
	    public function index(){
	    	
	    	if($this->input->post('action') == 'checkne'){
	    		$this->checkne();
	    	}
	    	$temp = array(
	    		'template' => 'hienthi_manhinh/Vhienthi',
	    		'data' => array(
	    			'message'  		=> getMessages(),
	    		),
	    	);
	    	$this->load->view('layout/content', $temp);
	    }
	    public function checkne(){
	    	$ban1 = $this->input->post('ban1');
	    	$ban2 = $this->input->post('ban2');
	    	$ban3 = $this->input->post('ban3');
	    	$ban4 = $this->input->post('ban4');
	    	$data = $this->Mhienthi_manhinh->hienthi_manhinh();
	    	foreach ($data as $key => $value) {
	    		$iparr = explode("-", $value['sohs_nh']);
	    		$data[$key]['soban']	= $iparr[0];
	    		$data[$key]['nganh'] 	= $iparr[1];
	    		$data[$key]['stt'] 		= $iparr[2]; 
	    	}
	    	foreach ($data as $key => $value) {
	    		if($data[$key]['soban'] == $ban1 || $data[$key]['soban'] == $ban2 || $data[$key]['soban'] == $ban3 || $data[$key]['soban'] == $ban4){
	    			$data_sv[$key] = $data[$key];
	    		}
	    	}
	    	if(isset($data_sv)){
	    		echo json_encode($data_sv);
	    		exit();
	    	}
	    	else{
	    		echo json_encode($data);
	    		exit();
	    	}
	    }
	    public function manhinh_thuhoso(){
	    	$data = "";
	    	if($this->input->post('action')=='manhinh_thuhoso'){
	    		$data = $this->Mhienthi_manhinh->manhinh_thuhoso();
	    	}
	    	if(!empty($data)){
	    		echo json_encode($data);
	    		exit();
	    	}
	    	$temp = array(
	    		'template' => 'hienthi_manhinh/VManhinh_thuhoso',
	    		'data' => array(
	    			'message'  		=> getMessages(),
	    		),
	    	);
	    	$this->load->view('layout/content', $temp);
	    }
	    public function manhinh_thutaichinh(){
	    	$data = "";
	    	if($this->input->post('action')=='manhinh_thutaichinh'){
	    		$data = $this->Mhienthi_manhinh->manhinh_thutaichinh();
	    	}
	    	if(!empty($data)){
	    		echo json_encode($data);
	    		exit();
	    	}
	    	$temp = array(
	    		'template' => 'hienthi_manhinh/VManhinh_thutaichinh',
	    		'data' => array(
	    			'message'  		=> getMessages(),
	    		),
	    	);
	    	$this->load->view('layout/content', $temp);
	    }
	}
	?>
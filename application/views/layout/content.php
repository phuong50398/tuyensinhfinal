<?php 
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$data['url'] = base_url();
	if(!empty($this->session->get_userdata('user')['user'])){
		$session= $this->session->get_userdata('user');
		$data['session'] 	  = $session['user'];
		$result = checkPermission($data['session']['maquyen'], getSegment());
		if (!$result){
			$this->session->sess_destroy();
			redirect(base_url().'403_Forbidden');
		}
		$this->parser->parse('layout/header', $data);
		$this->parser->parse($template, $data);
		$this->parser->parse('layout/footer', $data);
	}else{
		redirect(base_url());
	}

 ?>
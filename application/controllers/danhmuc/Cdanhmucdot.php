<?php 
class Cdanhmucdot extends MY_Controller
	{
	    /**
	     * summary
	     */
	    public function __construct()
	    {
	        parent::__construct();
	        $this->load->model('danhmuc/Mdanhmucdot');
	    }
	    public function index(){
	    	$dot = "";
	    	if($this->input->post('themdot')){
	    		$this->themdot();
	    	}
	    	if($this->input->post('update')){
	    		$this->update();
	    	}
	    	if($this->input->post('sua')){
	    		$madot       = $this->input->post('sua');
	    		$dot = $this->Mdanhmucdot->get_where_row('dm_dot','id', $madot);
	    	}
	    	if($this->input->get('xoadot')){
	    		$row = $this->Mdanhmucdot->delete('dm_dot','id', $this->input->get('xoadot'));
	    		if($row >= 0){
		    		setMessages('success','Xóa đơt thành công',' Thông báo');
		    		return redirect('Danh-muc-dot');
		    	}else{
		    		setMessages('error','Xóa đơt thất bại',' Thông báo');
		    		return redirect('Danh-muc-dot');
		    	}
	    	}
	    	$temp = array(
				'template' => 'canbo/Vdanhmucdot',
				'data' => array(
					'message'  		 => getMessages(),
					'dsdot'			 => $this->Mdanhmucdot->get('dm_dot'),
					'dot'			 => $dot
   				),
			);
			$this->load->view('layout/content', $temp);
	    }
	    public function themdot(){
	    	$data = $this->input->post('data');
	    	$check = $this->Mdanhmucdot->get_many_where('dm_dot',array('tendot' => $data['tendot'], 'thoigian' => $data['thoigian']));
	    	if(!empty($check)){
	    		setMessages('error','Tên đợt và thời gian đã tồn tại',' Thông báo');
	    		return redirect('Danh-muc-dot');
	    	}else{
	    		$row = $this->Mdanhmucdot->insert('dm_dot', $data);
		    	if($row >= 0){
		    		setMessages('success','Thêm đợt thành công',' Thông báo');
		    		return redirect('Danh-muc-dot');
		    	}else{
		    		setMessages('error','Thêm đợt thất bại',' Thông báo');
		    		return redirect('Danh-muc-dot');
		    	}
	    	}
	    	
	    }
	    public function update(){
	    	$madot = $this->input->post('madot');
	    	$data = $this->input->post('data');
	    	$check = $this->Mdanhmucdot->get_many_where('dm_dot',array('tendot' => $data['tendot'], 'thoigian' => $data['thoigian'], 'trangthai' => $data['trangthai']));
	    	if(!empty($check)){
	    		setMessages('error','Tên đợt và thời gian đã tồn tại',' Thông báo');
	    		return redirect('Danh-muc-dot');
	    	}else{
	    		$row = $this->Mdanhmucdot->update_set('dm_dot','id',$madot, $data);
		    	if($row >= 0){
		    		setMessages('success','Sửa đợt thành công',' Thông báo');
		    		return redirect('Danh-muc-dot');
		    	}else{
		    		setMessages('error','Sửa đợt thất bại',' Thông báo');
		    		return redirect('Danh-muc-dot');
		    	}
	    	}
	    }
	}
?>
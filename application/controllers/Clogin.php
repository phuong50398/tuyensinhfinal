<?php 
	/**
	 * summary
	 */
	class Clogin extends CI_Controller
	{
	    /**
	     * summary
	     */
	    public function __construct()
	    {
	        parent::__construct();
	        $this->load->model('Mlogin');
	    }
	    public function index(){
			$this->session->unset_userdata('user');
	    	if($this->input->post('submit'))
	        {
	        	$data['tb'] = $this->login();
	        }
	        $data['message'] = getMessages();
        	$this->parser->parse('Vlogin',$data);
	    }
	    public function login(){
        	$taikhoan = trim($this->input->post('taikhoan'));
        	$matkhau  = trim($this->input->post('matkhau'));
        	$check    = $this->Mlogin->check_user($taikhoan, $matkhau);

        	if($check == NULL){
        		$check_exit    = $this->Mlogin->check_exit($taikhoan);
        		if($check_exit == NULL){
        			$thongbao = "Số báo danh không nằm trong danh sách trúng tuyển, xin vui lòng kiểm tra lại!";
        		}else{
        			$thongbao = "Thông tin không chính xác, xin vui lòng kiểm tra lại!";
        		}
        		
        		return $thongbao;
        	}else{

        		if($check['FK_iMaQuyen'] != 7){

        			// pr($check);
					$session = array(
						'macb' 		=> $check['macb'],
						'tencb' 	=> $check['tencb'],
						'maquyen' 	=> $check['maquyen'],
						'makhoa' 	=> $check['makhoa'],
						'soquyen' 	=> $check['soquyen'],

					);
					$this->session->set_userdata('user',$session);
					setMessages('success','Đăng nhập thành công','Thông báo');
					if($session['maquyen'] == 6){
						return redirect('Thu-phieu-diem');
					}
					if($session['maquyen'] == 5){
						return redirect('Tra-giay-bao');
					}
					if($session['maquyen'] == 4){
						return redirect('Thu-ho-so');
					}
					if($session['maquyen'] == 3){
						return redirect('Thu-tai-chinh');
					}
		            if($session['maquyen'] == 1 || $session['maquyen'] == 8){
		                return redirect('Welcome');
		            }
		             if($session['maquyen'] ==9){
		                return redirect('Ho-tro-nhap-hoc');
		            }
		            if($session['maquyen'] ==10){
		                return redirect('tiepdon');
		            }
		            if($session['maquyen'] ==11){
		                return redirect('Rut-ho-so');
		            }
        		}else{

        			$session = array(
	                    'soBD' 		=> $check['soBD'],
	                    'hoten' 	=> $check['hoten'],
	                    'manganh' 	=> $check['FK_sMaNganh'],
	                    'maquyen' 	=> $check['FK_iMaQuyen']
	                );
        			$this->session->set_userdata('user',$session);
        			return redirect(base_url('Dang-ky-thong-tin-sinh-vien'));
        		}
        	}
        }
	    public function logout(){
	    	$this->session->userdata = array();
		    $this->session->sess_destroy();
		    $this->input->set_cookie('', '', time()-36000);
		    return redirect(base_url());
	    }
	}
 ?>
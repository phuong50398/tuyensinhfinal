<?php 
	/**
	 * summary
	 */
	class Cxeplop extends MY_Controller
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
	    	$danhmuc  = $this->getDanhmuc();
	    	$sinhvien = $this->Mxeplop->get_where('tbl_sinhvien','masv !=', ""); 
	    	if($this->input->post('action') == "xeplop"){
	    		$this->xeplop();
	    	}
	    	if($this->input->post('action') == "hienthi_lop"){
	    		$this->hienthi_lop();
	    	}
	    	if($this->input->post('action') == "get_lophoc_nganh"){
	    		$this->get_lophoc_nganh();
	    	}
	    	$temp = array(
				'template' => 'danhmuc/Vxeplop',
				'data' => array(
					'message'  => getMessages(),
					'sinhvien' => $sinhvien,
					'danhmuc'  => $danhmuc,
				),
			);
        	$this->load->view('layout/content', $temp);
	    }
	    /*
	    	Xếp lớp sinh viên đã có mã sv

	     */
	    
	    public function xeplop(){
	    	$arr_sv =  $this->input->post('arr_sv');
	    	$lop    = $this->input->post('lop');
	    	$delete = $this->Mxeplop->delete('tbl_sinhvien_lop','malop', $lop);
	    	if(!empty($arr_sv)){
	    		$row    = $this->Mxeplop->insert_batch('tbl_sinhvien_lop',$arr_sv);
	    		if($row > 0){
		    		$tb = 'thanhcong'; // 
		    	}else{
		    		$tb = 'loi'; // lỗi
		    	}
	    	}else{
	    		if($delete > 0){
		    		$tb = 'huythanhcong'; // 
		    	}else{
		    		$tb = 'loi'; // lỗi
		    	}
	    	}
	    	exit($tb);
	    }
	    // lấy tất cả danh mục
	    //hiển thị danh sách lớp
	    public function hienthi_lop(){
	    	$lop             = $this->input->post('lop');
	    	$nganh           = $this->input->post('nganh'); 
	    	$data['danhmuc'] = $this->getDanhmuc();
	    	$data['nganh']   = array();
	    	$data['dslop']   = $this->Mxeplop->get_where('tbl_sinhvien_lop','malop', $lop);
	    	$lophoc = $this->Mxeplop->get('tbl_sinhvien_lop');
	    	foreach ($lophoc as $value) {
	    		$dsvt_dacolop[] = $value['masv'];
	    	}
	    	if($nganh != 0){
	    		$dssv	 = $this->Mxeplop->get_many_where('tbl_sinhvien', array('masv !=' => "", 'FK_sMaNganh' => $nganh));
	    	}else{
	    		$dssv = $this->Mxeplop->get_many_where('tbl_sinhvien', array('masv !=' => ""));
	    	}
	    	foreach ($data['dslop'] as $value) {
	    		$data['nganh'][$value['masv']]   = $data['danhmuc']['tennganh'][$this->Mxeplop->get_where_row_select('tbl_sinhvien', 'FK_sMaNganh', 'masv', $value['masv'])['FK_sMaNganh']];
	    	}
	    	if(!empty($dsvt_dacolop)){
	    		if($nganh != 0){
	    			$data['svchuaxep'] = $this->Mxeplop->get_sinhvien_chuaxeplop($dsvt_dacolop, $nganh);
	    		}else{
	    			$data['svchuaxep'] = $dssv;
	    		}
	    	}else{
	    		$data['svchuaxep'] = $dssv;
	    	}
	    	echo json_encode($data);
	    	exit();
	    }

	    public function get_lophoc_nganh(){
	    	$nganh               = $this->input->post('manganh');
	    	$lophoc = $this->Mxeplop->get('tbl_sinhvien_lop');
	    	foreach ($lophoc as $value) {
	    		$dsvt_dacolop[] = $value['masv'];
	    	}
	    	$data['danhmuc'] 	 = $this->getDanhmuc();
	    	$data['lophoc']      = $this->Mxeplop->get_where('tbl_lophoc', 'FK_nganh', $nganh);
	    	$data['dssv_nganh']	 = $this->Mxeplop->get_sinhvien_chuaxeplop($dsvt_dacolop, $nganh);
	    	echo  json_encode($data);
	    	exit();
	    }
	    public function getDanhmuc(){
	    	$data['nganh']      = $this->Mxeplop->get('tbl_nganh');
	    	$dantoc 			= $this->Mxeplop->get('dm_dantoc');
	    	$tongiao 			= $this->Mxeplop->get('dm_tongiao');
	    	$data['lophoc']     =  $this->Mxeplop->get_order('tbl_lophoc','tenlop','ASC');
	    	$data['tbl_canbo'] 	= $this->Mxeplop->get('dm_canbo');
	    	$data['sinhvien']   = $this->Mxeplop->get('tbl_sinhvien');
	    	foreach ($data['sinhvien'] as $value) {
	    		$data['diemchuan'][$value['soBD']] = $this->Mxeplop->get_many_where('tbl_diemchuan',array('makhoi' => $value['khoihoc'], 'manganh' => $value['FK_sMaNganh']));
	    		$data['hoten'][$value['masv']] = $value['hoten'];
	    		$data['gioitinh'][$value['masv']] = $value['gioitinh'];
	    		$data['ngaysinh'][$value['masv']] = $value['ngaysinh'];

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
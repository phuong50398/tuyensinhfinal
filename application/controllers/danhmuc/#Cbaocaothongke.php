<?php 
    /**
     * summary
     */
    class Cbaocaothongke extends CI_Controller
    {
        /**
         * summary
         */
        public function __construct()
        {
            parent::__construct();
            $this->load->library('Excel');
            $this->load->model('danhmuc/Mbaocaothongke');
            date_default_timezone_set('Asia/Ho_Chi_Minh');
        }
        public function index(){
            $session          = $this->session->userdata('user');
            $notification     = "";
            $danhmuc          = $this->getDanhmuc();
            if($session['maquyen']==1 || $session['maquyen']==3){
              $baocaothongke    = $this->Mbaocaothongke->baocaothongke(null);
            }
            else {
                $baocaothongke    = $this->Mbaocaothongke->baocaothongke($session['makhoa']);
            }
            $nganh            = $this->Mbaocaothongke->get('tbl_nganh');
            $hocphi           = $this->Mbaocaothongke->get('tbl_hocphi');
            $sinhvien         = $this->Mbaocaothongke->get('tbl_sinhvien');
            $khoa             = $this->Mbaocaothongke->get_where('tbl_nganh','makhoa', $session['makhoa']);
            foreach ($khoa as $value) {
                $arr[$value['iMa_nganh']] = $value['sTen_Nganh'];
            }
            $temp = array(
                'template' => 'danhmuc/Vbaocaothongke',
                'data'     => array(
                    'message'           => getMessages(),
                    'nganh'             => $nganh,
                    'hocphi'            => $hocphi,
                    'notification'      => $notification,
                    'baocaothongke'     => $baocaothongke,
                    'khoa'              => $arr,
                ),
            );
            // hùng
            if(!$this->input->post('xuatbaocao_taichinh')){
                //Chọn ngành
                $nganh      = $this->input->post('nganh');
                //Chọn loại học phí
                $hocphi     = $this->input->post('hocphi');
                //Chọn khoảng thời gian (Cả ngày, sáng, chiều, toàn bộ thời gian);
                $khoang_thoigian    = $this->input->post('thoigian');
                //Chọn đối tượng thu học phí (Tất cả, chỉ mình tôi);
                $nguoithu   = $this->input->post('nguoithu');
                //Chọn ngày thu (data);
                $ngaythu    = $this->input->post('ngaythu');
                /*-------------------------------------------------------------------*/
                //Convert dd/mm/yyyy => yyyy/mm/dd (giống trong mysql)
                $var = $ngaythu[0];
                $date = str_replace('/', '-', $var);
                $ngaythu_hocphi = date('Y-m-d', strtotime($date));
                //Plunk type thời gian
                $type_ngaythu = $khoang_thoigian[0];
                //Tất cả hoặc chỉ mình tôi
                if($nguoithu[0]=="tatca"){
                    $get_TimKiem = $this->Mbaocaothongke->baocao_taichinh($nganh, $hocphi, $ngaythu_hocphi,null,$type_ngaythu);
                }
                if($nguoithu[0]=="minhtoi"){
                    $get_TimKiem = $this->Mbaocaothongke->baocao_taichinh($nganh, $hocphi, $ngaythu_hocphi,$session['macb'],$type_ngaythu);
                }
            }
            // lâm
            if($this->input->get('thongkesv')){
                $nganh = $this->input->get('thongkesv');
                $trangthai = $this->input->get('trangthai');
                $this->thongkesv($nganh,  $danhmuc, $session, $trangthai);
            }
            $this->load->view('layout/content', $temp);
        }
        public function thongkesv($nganh,  $danhmuc, $session,$trangthai){
            $this->load->library('Excel');
            $objPHPExcel                 = new PHPExcel(); 
            $nam                         = date('d/m/Y');
          
            $objPHPExcel->getProperties()->setCreator("Thông tin")
            ->setLastModifiedBy("Administrator")
            ->setTitle("Thông tin")
            ->setSubject("Thông tin");
            $objPHPExcel->getDefaultStyle()->getFont()->setName('Times new Roman')->setSize(13);
            // end dữ liệu
            /**********************************************************************
            ****************          FILE EXCEL 8.1               ****************
            ****************                                       ****************
            ***********************************************************************/
            $objPHPExcel->getActiveSheet()->setTitle("Thông tin");
            $session  = $this->session->userdata('user');
            if($trangthai == 'chuanhaphoc'){
                $sinhvien = $this->Mbaocaothongke->thongke_trangthainhaphoc($nganh,'chuanhaphoc');
                  $filename                    = 'DS sinh viên chưa nhập học '.$nam;
            }
            if($trangthai == 'danhaphoc'){
                $sinhvien = $this->Mbaocaothongke->thongke_trangthainhaphoc($nganh,'danhaphoc');
                $filename                    = 'DS sinh viên đã nhập học '.$nam;
            }
            $dem = count($sinhvien)+7;  
            //Border
            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            $objPHPExcel->getActiveSheet()->getStyle('A7:X'.$dem)->applyFromArray($styleArray);
            unset($styleArray);
            // Căn cỡ cột tự động
            foreach(range('A','Z') as $columnID){
                $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
            }

            // Căn cỡ hàng tự động
            foreach($objPHPExcel->getActiveSheet()->getRowDimensions() as $rd) {
                $rd->setRowHeight(-1);
            }

            //Xuống dòng
            $objPHPExcel->getActiveSheet()->getStyle('A7:J7')->getAlignment()->setWrapText(true);

            // Merge cell rộng rộng
            $array_merge = array('A1:D1','A2:D2','D4:K4','F5:H5');
            foreach($array_merge as $cell){
                $objPHPExcel->getActiveSheet()->mergeCells($cell);
            }
            // Căn giữa ngang
            $canngang= array('A7:X7','A1:D1','A2:D2','D4:K4','F5:H5','A7:A'.$dem,'E7:E'.$dem,'I7:K'.$dem,'F7:F'.$dem,'Q7:Q'.$dem,'G7:G'.$dem,'U7:V'.$dem);
            foreach($canngang as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            }

            // Căn giữa dọc
            $array_vertical_center = array('D4:K4','F5:H5', 'A7:X7','A1:D1','A2:D2');
            foreach($array_vertical_center as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            }

            // In đậm
            $array_bold = array('D4:K4', 'A7:X7', 'A7:A'.$dem,'A1:A2');
            foreach($array_bold as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
            }

            // In nghiêng
            $array_italic = array();
            foreach($array_italic as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setItalic(true);
            }

            // Chỉnh cỡ font
            $array_font_size = array(
                'A1'    => 14,
                'A2'    => 14,
                'A3'    => 11,
                'D4'    => 18,
                'F5'    => 11,
                'A7:X7' => 13
                // 'A5:H5' => 13
            );
            foreach($array_font_size as $key => $value){
                $objPHPExcel->getActiveSheet()->getStyle($key)->getFont()->setSize($value);
            }

            // Chỉnh cỡ cột
            $array_column = array(
                'A' => 6,
                'B' => 15,
                'C' => 20,
                'E' => 12,
                'F' => 11,
                'G' => 15,
                'I' => 10,
                'J' => 10,
                'K' => 10,
                'P' => 30,
                'Q' => 9,
                'T' => 20,
                'U' => 15,
                'V' => 12,
                'W' => 15,
            );
            foreach($array_column as $key => $value){
                $objPHPExcel->getActiveSheet()->getColumnDimension($key)->setAutoSize(false);
                $objPHPExcel->getActiveSheet()->getColumnDimension($key)->setWidth($value);
            }
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);

            //Chỉnh cỡ hàng fix cứng

            $array_row = array(
                '4' => 23

            );

            //*******************************************
            //************* NỘI DUNG ********************
            //*******************************************
            $array_content = array(
                'A1' => 'BỘ GIÁO DỤC VÀ ĐÀO TẠO',
                'A2' => 'TRƯỜNG ĐẠI HỌC MỞ HÀ NỘI',
                'A7' => 'STT',
                'D4' => 'DANH SÁCH SINH VIÊN CHƯA HOÀN THÀNH CÔNG TÁC NHẬP HỌC',
                'B7' => 'Số báo danh',
                'C7' => 'Mã sinh viên',
                'D7' => 'Họ tên',
                'E7' => 'Ngày sinh',
                'F5' => 'Tính đến thời gian: '.date('H:i:s d/m/Y'),
                'F7' => 'Giới tính',
                'G7' => 'CMND',
                'H7' => 'Ngành học',
                'I7' => 'Tôn giáo',
                'J7' => 'Dân tộc',
                'K7' => 'Đoàn/đảng',
                'L7' => 'Quê quán',
                'M7' => 'Hộ khẩu',
                'N7' => 'Địa chỉ',
                'O7' => 'Nơi sinh',
                'P7' => 'Bậc đã học',
                'Q7' => 'Năm TN',
                'R7' => 'Nơi TN',
                'S7' => 'Năng khiếu',
                'T7' => 'Số điện thoại',
                'U7' => 'Đối tượng',
                'V7' => 'Khu vực',
                'W7' => 'Chức vụ THPT',
                'X7' => 'Email',

            );

            $indexRow = 8;
            $session = $this->session->userdata('user');
            $stt = 1;
            foreach ($sinhvien AS $k => $v)
            {
                if(!empty($v['FK_tongiao'])){
                    $tongiao = $danhmuc['tongiao'][$v['FK_tongiao']];
                }else{
                     $tongiao = $v['FK_tongiao'];
                }
                if(!empty($v['FK_Dantoc'])){
                    $dantoc = $danhmuc['dantoc'][$v['FK_Dantoc']];
                }else{
                     $dantoc = $v['FK_Dantoc'];
                }
                $array_content['A'.$indexRow] = $stt++;
                $array_content['B'.$indexRow] = $v['soBD'];
                $array_content['C'.$indexRow] = $v['masv'];
                $array_content['D'.$indexRow] = $v['hoten'];
                $array_content['E'.$indexRow] = date('d/m/Y', strtotime($v['ngaysinh']));
                $array_content['F'.$indexRow] = $v['gioitinh'];
                $array_content['G'.$indexRow] = $v['CMND'];
                $array_content['H'.$indexRow] = $danhmuc['nganh'][$v['FK_sMaNganh']];
                $array_content['I'.$indexRow] = $tongiao;
                $array_content['J'.$indexRow] = $dantoc;
                $array_content['K'.$indexRow] = $v['doan'];
                $array_content['L'.$indexRow] = $v['quequan'];
                $array_content['M'.$indexRow] = $v['hokhau'];
                $array_content['N'.$indexRow] = $v['diachi'];
                $array_content['O'.$indexRow] = $v['noisinh'];
                $array_content['P'.$indexRow] = $v['bachoc'];
                $array_content['Q'.$indexRow] = $v['namtotnghiep'];
                $array_content['R'.$indexRow] = $v['noitotnghiep'];
                $array_content['S'.$indexRow] = $v['nangkhieu'];
                $array_content['T'.$indexRow] = $v['sdt'];
                $array_content['U'.$indexRow] = $v['doituong'];
                $array_content['V'.$indexRow] = $v['khuvuc'];
                $array_content['W'.$indexRow] = $v['chucvu'];
                $array_content['X'.$indexRow] = $v['email'];
                $indexRow++;
        }
            // Muốn thêm nội dung động thì foreach array push là xong.
            foreach($array_content as $key => $value){
                $objPHPExcel->getActiveSheet()->setCellValue($key,$value);
            }

            // End chỉnh sửa nội dung
            // ob_end_clean();
            if (ob_get_contents()) ob_end_clean();

            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment;filename=".$filename.".xls");
            header("Cache-Control: max-age=0");

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit();
        }
        public function excel(){
            $title = "";
            if($this->input->get('id')=="xuatbaocao_taichinh"){
                $this->xuatbaocao_taichinh();
            }
            if($this->input->get('id')=="trungtuyen"){
                $data = $this->Mbaocaothongke->get('tbl_sinhvien');
                $title = "DS Sinh viên trúng tuyển ".date('d/m/Y');
            }
            else if($this->input->get('id')=="datragiaybao"){
                $data = $this->Mbaocaothongke->baocao(2);
                $title = "DS Sinh viên đã trả giấy báo ".date('d/m/Y');
            }
            else if($this->input->get('id')=="dadangky"){
                $data = $this->Mbaocaothongke->baocao(3);
                $title = "DS Sinh viên đã đăng ký ".date('d/m/Y');
            }
            else if($this->input->get('id')=="dathuhocphi"){
                $data = $this->Mbaocaothongke->baocao(4);
                $title = "DS Sinh viên đã thu học phí ".date('d/m/Y');
            }
            else{
                $data = $this->Mbaocaothongke->baocaotheonganh($this->input->get('id'),0);
            }
            $objPHPExcel =new PHPExcel();
            $filename = $title;
            $objPHPExcel->getProperties()->setCreator("Tuyển sinh")
            ->setLastModifiedBy("Administrator")
            ->setTitle("Danh sách")
            ->setSubject("Phụ lục 8.1");
            $objPHPExcel->getDefaultStyle()->getFont()->setName('Times new Roman')->setSize(13);
            $objPHPExcel->getActiveSheet()->setTitle("Danh sách");
            $dem = count($data)+7;
            //Border
            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            $objPHPExcel->getActiveSheet()->getStyle('A7:X'.$dem)->applyFromArray($styleArray);
            unset($styleArray);
            // Căn cỡ cột tự động
            foreach(range('A','Z') as $columnID){
                $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
            }

            // Căn cỡ hàng tự động
            foreach($objPHPExcel->getActiveSheet()->getRowDimensions() as $rd) {
                $rd->setRowHeight(-1);
            }

            //Xuống dòng
            $objPHPExcel->getActiveSheet()->getStyle('A5:J7'.$dem)->getAlignment()->setWrapText(false);

            // Merge cell rộng rộng
            $array_merge = array('A1:D1','A2:D2','D4:K4','F5:H5');
            foreach($array_merge as $cell){
                $objPHPExcel->getActiveSheet()->mergeCells($cell);
            }
            // Căn giữa ngang
            $canngang= array('A5:A'.$dem,'B7:X7','A1:D1','A2:D2','D4:K4','A8:C'.$dem,'I8:L'.$dem,'T8:V'.$dem,'E8:G'.$dem,'Q8:Q'.$dem);
            foreach($canngang as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            }

            // Căn giữa dọc
            $array_vertical_center = array('A1:X7','A8:X'.$dem);
            foreach($array_vertical_center as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            }

            // In đậm
            $array_bold = array('A1','A2','A7:X7','D4:K4');
            foreach($array_bold as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
            }

            // In nghiêng
            $array_italic = array();
            foreach($array_italic as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setItalic(true);
            }

            // Chỉnh cỡ font
            $array_font_size = array(
                'A1' => 13,
                'A2' => 13,
                'A3' => 12,
                'D4' => 18,
                'F5' => 11,
                // 'A5:H5' => 13
            );
            foreach($array_font_size as $key => $value){
                $objPHPExcel->getActiveSheet()->getStyle($key)->getFont()->setSize($value);
            }

            // Chỉnh cỡ cột
            $array_column = array(
                'A' => 6,
                'B' => 20,
                'C' => 20,
                'E' => 15,
                'F' => 10,
                'G' => 20,
                'I' => 15,
                'J' => 15,
                'K' => 15,
                'Q' => 10,
                'T' => 15,
                'U' => 15,
                'V' => 15,
            );
            foreach($array_column as $key => $value){
                $objPHPExcel->getActiveSheet()->getColumnDimension($key)->setAutoSize(false);
                $objPHPExcel->getActiveSheet()->getColumnDimension($key)->setWidth($value);
            }
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);

            //Chỉnh cỡ hàng fix cứng

            $array_row = array(
                // '5' => 90,

            );
            foreach($array_row as $key => $value){
                $objPHPExcel->getActiveSheet()->getRowDimension($key)->setRowHeight($value);
            }

            //*******************************************
            //************* NỘI DUNG ********************
            //*******************************************
            $array_content = array(
                'A1' => 'BỘ GIÁO DỤC VÀ ĐÀO TẠO',
                'A2' => 'TRƯỜNG ĐẠI HỌC MỞ HÀ NỘI',
                'A7' => 'STT',
                'B7' => 'Số báo danh',
                'C7' => 'Mã sinh viên',
                'D7' => 'Họ tên',
                'E7' => 'Ngày sinh',
                'F5' => 'Tính đến thời gian: '.date('H:i:s d/m/Y'),
                'F7' => 'Giới tính',
                'G7' => 'CMND',
                'H7' => 'Ngành học',
                'I7' => 'Dân tộc',
                'J7' => 'Tôn giáo',
                'K7' => 'Đoàn/đảng',
                'L7' => 'Quê quán',
                'M7' => 'Hộ khẩu',
                'N7' => 'Địa chỉ',
                'O7' => 'Nơi sinh',
                'P7' => 'Bậc đã học',
                'Q7' => 'Năm TN',
                'R7' => 'Nơi TN',
                'S7' => 'Năng khiếu',
                'T7' => 'Số điện thoại',
                'U7' => 'Đối tượng',
                'V7' => 'Khu vực',
                'W7' => 'Chức vụ THPT',
                'X7' => 'Email',

            );
            if($this->input->get('id')=="trungtuyen"){
                $array_content['D4'] = 'DANH SÁCH SINH VIÊN TRÚNG TUYỂN '.date('d/m/Y');
            }
            else if($this->input->get('id')=="datragiaybao"){
                $array_content['D4'] = 'DANH SÁCH SINH VIÊN ĐÃ HOÀN THÀNH CÔNG TÁC TRẢ GIẤY BÁO '.date('d/m/Y');
            }
            else if($this->input->get('id')=="dadangky"){
                $array_content['D4'] = 'DANH SÁCH SINH VIÊN ĐÃ HOÀN THÀNH CÔNG TÁC ĐĂNG KÝ '.date('d/m/Y');
            }
            else if($this->input->get('id')=="dathuhocphi"){
                 $array_content['D4'] = 'DANH SÁCH SINH VIÊN ĐÃ HOÀN THÀNH CÔNG TÁC THU HỌC PHÍ '.date('d/m/Y');
            }
            
            $indexRow = 8;
            if($this->input->get('id')=="trungtuyen"){
                $data = $this->Mbaocaothongke->get('tbl_sinhvien');
            }
            else if($this->input->get('id')=="datragiaybao"){
                $data = $this->Mbaocaothongke->baocao(2);
            }
            else if($this->input->get('id')=="dadangky"){
                $data = $this->Mbaocaothongke->baocao(3);
            }
            else if($this->input->get('id')=="dathuhocphi"){
                $data = $this->Mbaocaothongke->baocao(4);
            }
            else{
                $data = $this->Mbaocaothongke->baocaotheonganh($this->input->get('id'),0);
            }
            // if (empty ($data))
            // {
            //     echo "
            //         Không có dữ liệu. Cán bộ vui lòng cập nhật dữ liệu vào
            //         các ô nhập liệu trước mới có thể xuất báo cáo.
            //         <br> Bấm <a href='".current_url()."'>vào đây</a> để trở về trang cập nhật kết quả
            //         nckh &amp; chuyển giao công nghệ
            //     ";
            //     exit;
            // }

            foreach ($data AS $k => $v)
            {
                $tennganh = $this->Mbaocaothongke->get_where_select1('tbl_nganh','sTen_Nganh','iMa_nganh',$v['FK_sMaNganh']);
                $tendantoc = $this->Mbaocaothongke->get_where_select1('dm_dantoc','sTenDT','iMaDT',$v['FK_Dantoc']);
                $tentongiao = $this->Mbaocaothongke->get_where_select1('dm_tongiao','ten_tongiao','madm_tongiao',$v['FK_tongiao']);
                $array_content['A'.$indexRow] = $k+1;
                $array_content['B'.$indexRow] = $v['soBD'];
                $array_content['C'.$indexRow] = $v['masv'];
                $array_content['D'.$indexRow] = $v['hoten'];
                $array_content['E'.$indexRow] = date('d/m/Y', strtotime($v['ngaysinh']));
                $array_content['F'.$indexRow] = $v['gioitinh'];
                $array_content['G'.$indexRow] = $v['CMND'];
                $array_content['H'.$indexRow] = $tennganh[0]['sTen_Nganh'];
                $array_content['I'.$indexRow] = $tendantoc[0]['sTenDT'];
                $array_content['J'.$indexRow] = $tentongiao[0]['ten_tongiao'];
                $array_content['K'.$indexRow] = $v['doan'];
                $array_content['L'.$indexRow] = $v['quequan'];
                $array_content['M'.$indexRow] = $v['hokhau'];
                $array_content['N'.$indexRow] = $v['diachi'];
                $array_content['O'.$indexRow] = $v['noisinh'];
                $array_content['P'.$indexRow] = $v['bachoc'];
                $array_content['Q'.$indexRow] = $v['namtotnghiep'];
                $array_content['R'.$indexRow] = $v['noitotnghiep'];
                $array_content['S'.$indexRow] = $v['nangkhieu'];
                $array_content['T'.$indexRow] = $v['sdt'];
                $array_content['U'.$indexRow] = $v['doituong'];
                $array_content['V'.$indexRow] = $v['khuvuc'];
                $array_content['W'.$indexRow] = $v['chucvu'];
                $array_content['X'.$indexRow] = $v['email'];
                $indexRow++;
            }

            // Muốn thêm nội dung động thì foreach array push là xong.
            foreach($array_content as $key => $value){
                $objPHPExcel->getActiveSheet()->setCellValue($key,$value);
            }

            // End chỉnh sửa nội dung
            // ob_end_clean();
            if (ob_get_contents()) ob_end_clean();

            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment;filename=".$filename.".xls");
            header("Cache-Control: max-age=0");

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit();
        }
        public function xuatbaocao_taichinh(){
            $session = $this->session->userdata('user');
            $objPHPExcel =new PHPExcel();
            $filename='Báo cáo tình hình thu tài chính '.date('d/m/Y');
            $danhmuc = $this->getDanhmuc();
            $objPHPExcel->getProperties()->setCreator("Tuyển sinh")
                                             ->setLastModifiedBy("Administrator")
                                             ->setTitle("Phụ lục 8.1")
                                             ->setSubject("Phụ lục 8.1");
            $objPHPExcel->getDefaultStyle()->getFont()->setName('Times new Roman')->setSize(13);
            $objPHPExcel->getActiveSheet()->setTitle("Baocaotaichinh");
                //Chọn ngành
                $nganh      = $this->input->post('nganh');
                //Chọn loại học phí
                $hocphi     = $this->input->post('hocphi');
                $tongtien = 0;
                if(!empty($hocphi)){
                    foreach ($hocphi as $key => $value) {
                        $arr[$value] = $value;
                    }
                }
                foreach ($danhmuc['tbl_hocphi'] as $key => $value) {
                    if(isset($arr[$value['mahp']])){
                        $tongtien = $tongtien + $value['giatri'];
                    }
                }
                //Chọn khoảng thời gian (Cả ngày, sáng, chiều, toàn bộ thời gian);
                $khoang_thoigian    = $this->input->post('thoigian');
                //Chọn đối tượng thu học phí (Tất cả, chỉ mình tôi);
                $nguoithu   = $this->input->post('nguoithu');
                //Chọn ngày thu (data);
                $ngaythu    = $this->input->post('ngaythu');
                /*-------------------------------------------------------------------*/
                //Convert dd/mm/yyyy => yyyy/mm/dd (giống trong mysql)
                $var = $ngaythu[0];
                $date = str_replace('/', '-', $var);
                $ngaythu_hocphi = date('Y-m-d', strtotime($date));
                //Plunk type thời gian
                $type_ngaythu = $khoang_thoigian[0];
                //Tất cả hoặc chỉ mình tôi
                if($nguoithu[0]=="tatca"){
                    $data = $this->Mbaocaothongke->baocao_taichinh($nganh, $hocphi, $ngaythu_hocphi,null,$type_ngaythu);
                }
                if($nguoithu[0]=="minhtoi"){
                    $data = $this->Mbaocaothongke->baocao_taichinh($nganh, $hocphi, $ngaythu_hocphi,$session['macb'],$type_ngaythu);
                }
                
                // pr($dssv_dot);
                // pr($data);
            $dem = count($data)+7;
            //Border
            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            $objPHPExcel->getActiveSheet()->getStyle('A7:V'.$dem)->applyFromArray($styleArray);
            unset($styleArray);
            // Căn cỡ cột tự động
            foreach(range('A','Z') as $columnID){
                    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
            }

            // Căn cỡ hàng tự động
            foreach($objPHPExcel->getActiveSheet()->getRowDimensions() as $rd) {
                $rd->setRowHeight(-1);
            }

            //Xuống dòng
            $objPHPExcel->getActiveSheet()->getStyle('A5:J'.$dem)->getAlignment()->setWrapText(true);

            // Merge cell
             $array_merge = array('A1:D1','A2:D2','G4:J4');
             foreach($array_merge as $cell){
                 $objPHPExcel->getActiveSheet()->mergeCells($cell);
            }
            // Căn giữa ngang
            $canngang= array('A5:A'.$dem,'D8:D'.$dem,'B7:V7','A1:D1','A2:D2','D4:K4','A8:V'.$dem,'G4:J4');
            foreach($canngang as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            }

            // Căn trái ngang
            $canngang= array('D8:D'.$dem,'H8:H'.$dem,'J8:J'.$dem,'L8:L'.$dem,'O8:O'.$dem);
            foreach($canngang as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            }

            // Căn giữa dọc
            $array_vertical_center = array('A1:V7','A8:C'.$dem,'D8:D'.$dem,'E8:E'.$dem,'F8:F'.$dem,'G8:G'.$dem,'H8:H'.$dem,'I8:I'.$dem,'V8:V'.$dem);
            foreach($array_vertical_center as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            }

            // In đậm
            $array_bold = array('A1','A2','A7:V7','D4:K4');
            foreach($array_bold as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
            }

            // In nghiêng
            $array_italic = array();
            foreach($array_italic as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setItalic(true);
            }
            // Chỉnh cỡ font
            $array_font_size = array(
                'A1' => 13,
                'A1' => 13,
                'D4' => 18,
                'A3' => 12,
                'G4' => 16,
                'G1' => 18,
            );
            foreach($array_font_size as $key => $value){
                $objPHPExcel->getActiveSheet()->getStyle($key)->getFont()->setSize($value);
            }

            // Chỉnh cỡ cột
            $array_column = array(
                'A' => 6,
                'B' => 20,
                'C' => 20,
                'D' => 25,
                'E' => 15,
                'F' => 10,
                'G' => 20,
                'H' => 24,
                'I' => 15,
                'J' => 20,
                'K' => 25,
                'L' => 20,
                'P' => 10,
                'Q' => 10,
                'R' => 10,
                'S' => 10,
                'T' => 10,
                'U' => 10,
                'V' => 15,
            );
            // pr($data);
            foreach($array_column as $key => $value){
                $objPHPExcel->getActiveSheet()->getColumnDimension($key)->setAutoSize(false);
                $objPHPExcel->getActiveSheet()->getColumnDimension($key)->setWidth($value);
            }
            // $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);

            //Chỉnh cỡ hàng fix cứng

            $array_row = array(
        
            );
            foreach($array_row as $key => $value){
                $objPHPExcel->getActiveSheet()->getRowDimension($key)->setRowHeight($value);
            }
            // $aaa = strlen('Công nghệ kỹ thuật điều khiển và tự động hóa');
            // pr($aaa);
            //*******************************************
            //************* NỘI DUNG ********************
            //*******************************************
            $array_content = array(
                'A1' => 'BỘ GIÁO DỤC VÀ ĐÀO TẠO',
                'A2' => 'TRƯỜNG ĐẠI HỌC MỞ HÀ NỘI',
                'A7' => 'STT',
                'B7' => 'Số báo danh',
                'C7' => 'Mã sinh viên',
                'G4' => 'BÁO CÁO THỐNG KÊ TÀI CHÍNH',
                'D7' => 'Họ tên',
                'E7' => 'Ngày sinh',
                // 'F5' => 'Tính đến thời gian:'.date('H:i:s d/m/Y'),
                'F7' => 'Giới tính',
                'G7' => 'CMND',
                'H7' => 'Ngành học',
                'I7' => 'Điện thoại',
                'J7' => 'Người nhập',
                'K7' => 'Thời gian nhập',
                'L7' => 'Người thu',
                'M7' => 'Thời gian thu',
                'N7' => 'SHĐ',
                'O7' => 'Ghi chú',
                'P7' => 'Học phí',
                'Q7' => 'Khám SK',
                'R7' => 'Thẻ',
                'S7' => 'BHYT',
                'T7' => 'BHTT1',
                'U7' => 'BHTT2',    
                'V7' => 'Tổng',
            );

            // pr($data);
            // $data = $this->Mtapchi->getDocument($session['baseId']);
            // if (empty ($data))
            // {
            //     echo "
            //         Không có dữ liệu. Cán bộ vui lòng cập nhật dữ liệu vào
            //         các ô nhập liệu trước mới có thể xuất báo cáo.
            //         <br> Bấm <a href='".current_url()."'>vào đây</a> để trở về trang cập nhật kết quả
            //         nckh &amp; chuyển giao công nghệ
            //     ";
            //     exit;
            // }
            $tongtien_dathu = 0;
            foreach ($data as $key => $value) {
                    $dssv_dot[$value['masv']][] = $value;
                }
            // pr($dssv_dot);
            $indexRow = 8;
            $array_merge = array();
            $sv_dotthu = array();
            $stt = 1;
            foreach ($dssv_dot AS $k => $value){
                $sv_dot = $value;
                $sodot = count($sv_dot);
                if($sodot != 1){
                    $mer = $indexRow + $sodot - 1;
                    array_push($array_merge, 
                            'A'.$indexRow.':A'.$mer,
                            'B'.$indexRow.':B'.$mer,
                            'C'.$indexRow.':C'.$mer,
                            'D'.$indexRow.':D'.$mer,
                            'E'.$indexRow.':E'.$mer,
                            'F'.$indexRow.':F'.$mer,
                            'G'.$indexRow.':G'.$mer,
                            'H'.$indexRow.':H'.$mer,
                            'I'.$indexRow.':I'.$mer,
                            'V'.$indexRow.':V'.$mer
                        );
                }
                foreach ($sv_dot as $key => $v) {
                    $tennganh = $this->Mbaocaothongke->get_where_select1('tbl_nganh','sTen_Nganh','iMa_nganh',$v['FK_sMaNganh']);
                                $array_content['A'.$indexRow] = $stt;
                                $array_content['B'.$indexRow] = $v['soBD'];
                                $array_content['C'.$indexRow] = $v['masv'];
                                $array_content['D'.$indexRow] = $v['hoten'];
                                $array_content['E'.$indexRow] = $v['ngaysinh'];
                                $array_content['F'.$indexRow] = $v['gioitinh'];
                                $array_content['G'.$indexRow] = $v['CMND'];
                                $array_content['H'.$indexRow] = $tennganh[0]['sTen_Nganh'];
                                $array_content['I'.$indexRow] = $v['sdt'];
                                $array_content['J'.$indexRow] = $v['nguoithu_hocphi'];
                                $array_content['K'.$indexRow] = date('H:i:s d/m/Y', strtotime($v['thoigian_thuhp']));
                                $array_content['L'.$indexRow] = $v['nguoithu_hocphi'];
                                $array_content['M'.$indexRow] = date('H:i:s d/m/Y', strtotime($v['thoigian_thuhp']));
                                $array_content['N'.$indexRow] = "Quyển số: ".$v['soquyen']." Số:".$v['so'];
                                $array_content['O'.$indexRow] = $v['ghichu'];
                                $array_content['P'.$indexRow] = $v['tamthu_hp'];
                                $array_content['Q'.$indexRow] = $v['tamthu_sk'];
                                $array_content['R'.$indexRow] = $v['tamthu_the'];
                                $array_content['S'.$indexRow] = $v['tamthu_yt'];
                                $array_content['T'.$indexRow] = $v['tamthu_tt1'];
                                $array_content['U'.$indexRow] = $v['tamthu_tt2'];
                                $array_content['V'.$indexRow] = $v['tongtien_dathu'];
                                $indexRow++;
                }
                    $stt  = $stt + 1;

            }
            foreach($array_content as $key => $value){
                $objPHPExcel->getActiveSheet()->setCellValue($key,$value);
            }
            array_push($array_merge);
            foreach($array_merge as $cell){
            $objPHPExcel->getActiveSheet()->mergeCells($cell);
            }
            if (ob_get_contents()) ob_end_clean();
            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment;filename=".$filename.".xls");
            header("Cache-Control: max-age=0");

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit();
        }
        public function getDanhmuc(){
            $nganh              = $this->Mbaocaothongke->get('tbl_nganh');
            $dantoc             = $this->Mbaocaothongke->get('dm_dantoc');
            $tongiao            = $this->Mbaocaothongke->get('dm_tongiao');
            $data['tbl_canbo']  = $this->Mbaocaothongke->get('dm_canbo');
            $data['tbl_canbo']  = $this->Mbaocaothongke->get('dm_canbo');
            $data['tbl_hocphi'] = $this->Mbaocaothongke->get('tbl_hocphi');
            $sinhvien           = $this->Mbaocaothongke->get('tbl_sinhvien');
            foreach ($sinhvien as $value) {
                $data['diemchuan'][$value['soBD']] = $this->Mbaocaothongke->get_many_where('tbl_diemchuan',array('makhoi' => $value['khoihoc'], 'manganh' => $value['FK_sMaNganh']));
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
            foreach ($nganh as $value) {
                $data['nganh'][$value['iMa_nganh']] = $value['sTen_Nganh'];
                $data['khoa'][$value['iMa_nganh']]  = $this->Mbaocaothongke->get_Khoa($value['iMa_nganh']) ;
            }
            return $data;
        }
    }
    ?>
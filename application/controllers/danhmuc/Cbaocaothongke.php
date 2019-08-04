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
            $this->load->model('danhmuc/Mhotro_nhaphoc');
            date_default_timezone_set('Asia/Ho_Chi_Minh');
        }
        public function index(){
            $notification     = "";
            $session          = $this->session->userdata('user');
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
        public function thongkesv($nganh, $danhmuc, $session,$trangthai){
            $this->load->library('Excel');
            $title = "";
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
                  $title                        = 'DANH SÁCH SINH VIÊN CHƯA HOÀN THÀNH CÔNG TÁC NHẬP HỌC';
            }
            if($trangthai == 'danhaphoc'){
                $sinhvien = $this->Mbaocaothongke->thongke_trangthainhaphoc($nganh,'danhaphoc');
                 $filename                    = 'DS sinh viên đã nhập học '.$nam;
                $title                        = 'DANH SÁCH SINH VIÊN ĐÃ HOÀN THÀNH CÔNG TÁC NHẬP HỌC';
            }
            $dem = count($sinhvien)+8;  
            //Border
            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            $objPHPExcel->getActiveSheet()->getStyle('A8:BB'.$dem)->applyFromArray($styleArray);
            unset($styleArray);
           
            // Căn cỡ hàng tự động
            foreach($objPHPExcel->getActiveSheet()->getRowDimensions() as $rd) {
                $rd->setRowHeight(-1);
            }

            //Xuống dòng
            $objPHPExcel->getActiveSheet()->getStyle()->getAlignment()->setWrapText(true);

            // Merge cell rộng rộng
            $array_merge = array('B6:D6', 'A1:D1','A2:D2','I4:M4','F5:H5', 'I5:M5');
            foreach($array_merge as $cell){
                $objPHPExcel->getActiveSheet()->mergeCells($cell);
            }
            // Căn giữa ngang
            $canngang= array('B6:D6', 'A8:BB8', 'I4:M4','M1:M2','F5:H5','I5:M5','M6', 'F8:V'.$dem,'X8:BB'.$dem, );
            foreach($canngang as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            }

            // Căn giữa dọc
            $array_vertical_center = array('A8:BB8', 'B6:D6','I5:M5', 'M6', 'I4:M4','F5:H5', 'A1:D1','A2:D2');
            foreach($array_vertical_center as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            }

            // In đậm
            $array_bold = array('I4:M4','A8:BB8', 'A8:A'.$dem, 'A1:A2', 'B6:D6', 'K1:M1', 'K2:M2', 'I5:M5','L6:N6');
            foreach($array_bold as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
            }

            // In nghiêng
            $array_italic = array('I5:M5');
            foreach($array_italic as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setItalic(true);
            }

            // Chỉnh cỡ font
            $array_font_size = array(
                'A1'     => 10,
                'A2'     => 10,
                'A3'     => 11,
                'D4'     => 18,
                'F5'     => 11,
                'A8:BB8' => 10,
                'M1'     => 12,
                'M2'     => 12,
                'I5:M5'  => 10,
                'I4:M4'  => 13,
                'B6:D6'  => 10,
                'L6:N6'  => 10,
                'A8:AR'.$dem => 10,
                'AS8:BB'.$dem => 10,
            );


            foreach($array_font_size as $key => $value){
                $objPHPExcel->getActiveSheet()->getStyle($key)->getFont()->setSize($value);
            }

            // Chỉnh cỡ cột
            $array_column = array(
                'A'  => 4,
                'B'  => 10,
                'C'  => 11,
                'D'  => 18,
                'E'  => 8,
                'F'  => 11,
                'G'  => 7,
                'H'  => 14,
                'I'  => 13,
                'J'  => 15,
                'K'  => 7,
                'L'  => 9,
                'M'  => 35,
                'N'  => 9,
                'O'  => 8,
                'P'  => 10,
                'Q'  => 9,
                'R'  => 8,
                'S'  => 8,
                'T'  => 8,
                'U'  => 9,
                'V'  => 9,
                'W'  => 39,
                'X'  => 13,
                'Y'  => 32,
                'Z'  => 8,
                'AA' => 30,
                'AB' => 40,
                'AC' => 29,
                'AD' => 15,
                'AE' => 8,
                'AF' => 15,
                'AG' => 17,
                'AH' => 14,
                'AI' => 20,
                'AJ' => 18,
                'AK' => 17,
                'AL' => 12,
                'AM' => 20,
                'AN' => 12,
                'AO' => 14,
                'AP' => 9,
                'AQ' => 11,
                'AR' => 14,
                'AS' => 12,
                'AT' => 12,
                'AU' => 10,
                'AV' => 12,
                'AW' => 21,
                'AX' => 12,
                'AY' => 12,
                'AZ' => 12,
                'BA' => 12,
                'BB' => 12,
            );
            foreach($array_column as $key => $value){
                $objPHPExcel->getActiveSheet()->getColumnDimension($key)->setAutoSize(false);
                $objPHPExcel->getActiveSheet()->getColumnDimension($key)->setWidth($value);
            }

            $array_row = array(
                '4' => 23
            );

            //*******************************************
            //************* NỘI DUNG ********************
            //*******************************************
            $array_content        = $this->tieude($title);
            $dshs                 = $this->dsHS();
            $array_content['AS8'] = $dshs['hstt'];
            $array_content['AT8'] = $dshs['gbnh'];
            $array_content['AU8'] = $dshs['bshb'];
            $array_content['AV8'] = $dshs['bsks'];
            $array_content['AW8'] = $dshs['cntn'];
            $array_content['AX8'] = $dshs['bstn'];
            $array_content['AY8'] = $dshs['utkv'];
            $array_content['AZ8'] = $dshs['utdt'];
            $array_content['BA8'] = $dshs['nvqs'];
            $array_content['BB8'] = $dshs['xnvm'];
            if($trangthai == "danhaphoc"){
                $array_content['BC8'] = "Học phí 1";
                $array_content['BD8'] = "Học phí 2";
                $array_content['BE8'] = 'Khám SK';
                $array_content['BF8'] = 'Thẻ';
                $array_content['BG8'] = 'BHYT';
                $array_content['BH8'] = 'BHTT1';
                $array_content['BI8'] = 'BHTT2';
                $array_content['BJ8'] = 'Tổng';
                //Border
                $styleArray = array(
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle('A8:BJ'.$dem)->applyFromArray($styleArray);
                unset($styleArray);
                $array_bold = array('A8:BJ8');
                foreach($array_bold as $cell){
                    $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
                }
                 // Chỉnh cỡ font
                $array_font_size = array(
                    'A8:BJ8'     => 10,
                    'A8:BJ'.$dem => 10,
                );
                foreach($array_font_size as $key => $value){
                    $objPHPExcel->getActiveSheet()->getStyle($key)->getFont()->setSize($value);
                }
                 // Căn giữa ngang
                $canngang= array('BC8:BJ'.$dem);
                foreach($canngang as $cell){
                    $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                }
            }
            $indexRow = 9;
            $session = $this->session->userdata('user');
            $stt = 1;
            $monhoc = $this->monhoc();
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
                $tohop[$v['soBD']]    = $this->Mhotro_nhaphoc->getToHop($v['soBD']);
                $tachmon[$v['soBD']]  = explode(",",  $tohop[$v['soBD']]['tohop']);
                $getMon[$v['soBD']]   = $this->Mhotro_nhaphoc->getMon($tohop[$v['soBD']], $v['soBD']);
                $array_content['R8'] = "Môn 1";
                $array_content['S8'] = "Môn 2";
                $array_content['T8'] = "Môn 3";
                $hs[$v['soBD']][]     = explode(",", $v['hoso']);
                foreach ($hs[$v['soBD']] as $key => $value) {
                    $arr[$v['soBD']] = $value;
                    foreach ($arr[$v['soBD']] as $v1) {
                        $hoso[$v['soBD']][$v1] = $v1;
                    }
                }
                if(!empty($v['thoigian_nhaphs'])){
                    $tg_nhap = date('d/m/Y H:i:s', strtotime($v['thoigian_nhaphs']));
                }else{
                    $tg_nhap = "";
                }
                if(isset($danhmuc['getLop'][$v['masv']])){
                    $lop = $danhmuc['getLop'][$v['masv']];
                }else{
                    $lop = "";
                }
                $array_content['A'.$indexRow]  = $stt++;
                $array_content['B'.$indexRow]  = $lop;
                $array_content['C'.$indexRow]  = $v['masv'];
                $array_content['D'.$indexRow]  = substr($v['hoten'],0, strlen($v['hoten']) - strlen(strrchr($v['hoten']," "))) ;
                $array_content['E'.$indexRow]  = trim(strrchr($v['hoten']," "));
                $array_content['F'.$indexRow]  = $v['ngaysinh'];
                $array_content['G'.$indexRow]  = $v['gioitinh'];
                $array_content['H'.$indexRow]  = $v['CMND'];
                $array_content['I'.$indexRow]  = $v['ngaycapcmnd'];
                $array_content['J'.$indexRow]  = $v['noicapcmnd'];
                $array_content['K'.$indexRow]  = $dantoc;
                $array_content['L'.$indexRow]  = $tongiao;
                $array_content['M'.$indexRow]  = $v['hokhau'];
                $array_content['N'.$indexRow]  = $v['doituong'];
                $array_content['O'.$indexRow]  = $v['khuvuc'];
                $array_content['P'.$indexRow]  = $v['soBD'];
                $array_content['Q'.$indexRow]  = $v['khoihoc'];
                $array_content['R'.$indexRow]  = $getMon[$v['soBD']][$tachmon[$v['soBD']][0]];
                $array_content['S'.$indexRow]  = $getMon[$v['soBD']][$tachmon[$v['soBD']][1]];
                $array_content['T'.$indexRow]  = $getMon[$v['soBD']][$tachmon[$v['soBD']][2]];
                $array_content['U'.$indexRow]   = $v['tongdiem_xettuyen'];
                $array_content['V'.$indexRow]   = $v['FK_sMaNganh'];
                $array_content['W'.$indexRow]   =  $danhmuc['nganh'][$v['FK_sMaNganh']];
                $array_content['X'.$indexRow]   = $v['sdt'];
                $array_content['Y'.$indexRow]   = $v['email'];
                $array_content['Z'.$indexRow]   = $v['doan'];
                $array_content['AA'.$indexRow]   = $v['quequan'];
                $array_content['AB'.$indexRow]  = $v['diachi'];
                $array_content['AC'.$indexRow]  = $v['noisinh'];
                $array_content['AD'.$indexRow]  = $v['bachoc'];
                $array_content['AE'.$indexRow]  = $v['namtotnghiep'];
                $array_content['AF'.$indexRow]  = $v['noitotnghiep'];
                $array_content['AG'.$indexRow]  = $v['nangkhieu'];
                $array_content['AH'.$indexRow]  = $v['chucvu'];
                if(!empty($danhmuc['canbo'][$v['nguoinhaphs']])){
                    $array_content['AI'.$indexRow]  = $v['nguoinhaphs'];
                }
                else{
                    $array_content['AI'.$indexRow]  = $v['nguoinhaphs'];   
                }
                $array_content['AJ'.$indexRow]  = $tg_nhap;
                $array_content['AK'.$indexRow]  = $v['hoten_bo'];
                $array_content['AL'.$indexRow]  = $v['namsinh_bo'];
                $array_content['AM'.$indexRow]  = $v['nghenghiep_bo'];
                $array_content['AN'.$indexRow]  = $v['sdt_bo'];
                $array_content['AO'.$indexRow]  = $v['hoten_me'];
                $array_content['AP'.$indexRow]  = $v['namsinh_me'];
                $array_content['AQ'.$indexRow]  = $v['nghenghiep_me'];
                $array_content['AR'.$indexRow]  = $v['sdt_me'];
                if(isset($hoso[$v['soBD']]['hstt'])){
                    $array_content['AS'.$indexRow] = "X";
                }
                if(isset($hoso[$v['soBD']]['gbnh'])){
                    $array_content['AT'.$indexRow] = "X";
                }
                if(isset($hoso[$v['soBD']]['bshb'])){
                   $array_content['AU'.$indexRow] = "X";
                }
                if(isset($hoso[$v['soBD']]['bsks'])){
                    $array_content['AV'.$indexRow] = "X";
                }
                if(isset($hoso[$v['soBD']]['cntn'])){
                    $array_content['AW'.$indexRow] = "X";
                }
                if(isset($hoso[$v['soBD']]['bstn'])){
                     $array_content['AX'.$indexRow] = "X";
                }
                if(isset($hoso[$v['soBD']]['utkv'])){
                     $array_content['AY'.$indexRow] = "X";
                }
                if(isset($hoso[$v['soBD']]['utdt'])){
                     $array_content['AZ'.$indexRow] = "X";
                }
                if(isset($hoso[$v['soBD']]['nvqs'])){
                    $array_content['BA'.$indexRow] = "X";
                }
                if(isset($hoso[$v['soBD']]['xnvm'])){
                      $array_content['BB'.$indexRow] = "X";
                }

                // đổ ra học phí
                if($trangthai == 'danhaphoc'){
                    $chitiet_hspv[$v['masv']] = $this->Mbaocaothongke->get_many_where('hocphi_sinhvien',array('masv' => $v['masv'], 'hocphi !=' =>""));
                     if(!empty($chitiet_hspv[$v['masv']])){
                        foreach ($chitiet_hspv as $key => $value) {
                            foreach ($value as $k1 => $v1) {
                                if($k1 != 0){
                                    $chitiet_hspv[$v['masv']][0]['tamthu_hp1']  += $v1['tamthu_hp1'];
                                    $chitiet_hspv[$v['masv']][0]['tamthu_hp2']  += $v1['tamthu_hp2'];
                                    $chitiet_hspv[$v['masv']][0]['tamthu_sk']  += $v1['tamthu_sk'];
                                    $chitiet_hspv[$v['masv']][0]['tamthu_the'] += $v1['tamthu_the'];
                                    $chitiet_hspv[$v['masv']][0]['tamthu_yt']  += $v1['tamthu_yt'];
                                    $chitiet_hspv[$v['masv']][0]['tamthu_tt1'] += $v1['tamthu_tt1'];
                                    $chitiet_hspv[$v['masv']][0]['tamthu_tt2'] += $v1['tamthu_tt2'];
                                }
                                $ds[$v['masv']] = array(
                                    'hp1'  => $chitiet_hspv[$v['masv']][0]['tamthu_hp1'],
                                    'hp2'  => $chitiet_hspv[$v['masv']][0]['tamthu_hp2'],
                                    'sk'  => $chitiet_hspv[$v['masv']][0]['tamthu_sk'],
                                    'the' => $chitiet_hspv[$v['masv']][0]['tamthu_the'],
                                    'yt'  => $chitiet_hspv[$v['masv']][0]['tamthu_yt'],
                                    'tt1' => $chitiet_hspv[$v['masv']][0]['tamthu_tt1'],
                                    'tt2' => $chitiet_hspv[$v['masv']][0]['tamthu_tt2'],
                                );
                            }
                        }
                     }
                     // 
                    if($v['FK_sMaNganh'] == 15 || $v['FK_sMaNganh'] == 63 || $v['FK_sMaNganh'] == 62 || $v['FK_sMaNganh'] == 61)
                    {
                       $array_content['BC'.$indexRow]   = 0;
                       $array_content['BD'.$indexRow]   = $ds[$v['masv']]['hp2'];
                       $array_content['BH'.$indexRow]   = 0;
                       $array_content['BI'.$indexRow]   = $ds[$v['masv']]['tt2'];
                    }else{
                        $array_content['BC'.$indexRow]  = $ds[$v['masv']]['hp1'];
                        $array_content['BD'.$indexRow]  = 0;
                        $array_content['BH'.$indexRow]  = $ds[$v['masv']]['tt1'];
                        $array_content['BI'.$indexRow]  = 0;
                    }
                    $array_content['BE'.$indexRow]  = $ds[$v['masv']]['sk'];
                    $array_content['BF'.$indexRow]  = $ds[$v['masv']]['the'];
                    $array_content['BG'.$indexRow]  = $ds[$v['masv']]['yt'];
                    $array_content['BJ'.$indexRow]  = $v['tongtien_dathu'];
                }
                //end học phí
                $indexRow++;
            }

            $objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setAutoSize(true);

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
            $danhmuc          = $this->getDanhmuc();
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
            else if($this->input->get('id')=="dathuruthoso"){
                $data = $this->Mbaocaothongke->ruthoso();
                $title = "DS Sinh viên đã rút hồ sơ ".date('d/m/Y');
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
            $dem = count($data)+8;  
            //Border
            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            if($this->input->get('id')=="dathuruthoso"){
            $objPHPExcel->getActiveSheet()->getStyle('A8:BJ'.$dem)->applyFromArray($styleArray);
            unset($styleArray);
            }
            else{
                $objPHPExcel->getActiveSheet()->getStyle('A8:BB'.$dem)->applyFromArray($styleArray);
            unset($styleArray);
            }
           
            // Căn cỡ hàng tự động
            foreach($objPHPExcel->getActiveSheet()->getRowDimensions() as $rd) {
                $rd->setRowHeight(-1);
            }

            //Xuống dòng
            $objPHPExcel->getActiveSheet()->getStyle()->getAlignment()->setWrapText(true);

            // Merge cell rộng rộng
            $array_merge = array('B6:D6', 'A1:D1','A2:D2','I4:M4','F5:H5', 'I5:M5');
            foreach($array_merge as $cell){
                $objPHPExcel->getActiveSheet()->mergeCells($cell);
            }
            // Căn giữa ngang
            $canngang= array('B6:D6', 'A8:BB8', 'I4:M4','M1:M2','F5:H5','I5:M5','M6', 'F8:V'.$dem,'X8:BJ'.$dem, );
            foreach($canngang as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            }

            // Căn giữa dọc
            $array_vertical_center = array('A8:BJ8', 'B6:D6','I5:M5', 'M6', 'I4:M4','F5:H5', 'A1:D1','A2:D2');
            foreach($array_vertical_center as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            }

            // In đậm
            $array_bold = array('I4:M4','A8:BJ8', 'A8:A'.$dem, 'A1:A2', 'B6:D6', 'K1:M1', 'K2:M2', 'I5:M5','L6:N6');
            foreach($array_bold as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
            }

            // In nghiêng
            $array_italic = array('I5:M5');
            foreach($array_italic as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setItalic(true);
            }

            // Chỉnh cỡ font
            $array_font_size = array(
                'A1'     => 10,
                'A2'     => 10,
                'A3'     => 11,
                'D4'     => 18,
                'F5'     => 11,
                'A8:BJ8' => 12,
                'M1'     => 12,
                'M2'     => 12,
                'I5:M5'  => 10,
                'I4:M4'  => 13,
                'B6:D6'  => 10,
                'L6:N6'  => 10,
                'A8:AR'.$dem => 10,
                'AS8:BJ'.$dem => 10,
            );


            foreach($array_font_size as $key => $value){
                $objPHPExcel->getActiveSheet()->getStyle($key)->getFont()->setSize($value);
            }

            // Chỉnh cỡ cột
            $array_column = array(
                'A'  => 4,
                'B'  => 10,
                'C'  => 11,
                'D'  => 18,
                'E'  => 8,
                'F'  => 11,
                'G'  => 7,
                'H'  => 18,
                'I'  => 13,
                'J'  => 15,
                'K'  => 7,
                'L'  => 9,
                'M'  => 35,
                'N'  => 9,
                'O'  => 8,
                'P'  => 10,
                'Q'  => 9,
                'R'  => 8,
                'S'  => 8,
                'T'  => 8,
                'U'  => 9,
                'V'  => 9,
                'W'  => 39,
                'X'  => 13,
                'Y'  => 32,
                'Z'  => 8,
                'AA' => 30,
                'AB' => 40,
                'AC' => 29,
                'AD' => 15,
                'AE' => 8,
                'AF' => 15,
                'AG' => 17,
                'AH' => 14,
                'AI' => 20,
                'AJ' => 18,
                'AK' => 17,
                'AL' => 12,
                'AM' => 20,
                'AN' => 12,
                'AO' => 14,
                'AP' => 12,
                'AQ' => 15,
                'AR' => 14,
                'AS' => 15,
                'AT' => 15,
                'AU' => 15,
                'AV' => 15,
                'AW' => 15,
                'AX' => 15,
                'AY' => 15,
                'AZ' => 15,
                'BA' => 15,
                'BB' => 15,
                'BC' => 15,
                'BD' => 15,
                'BE' => 15,
                'BF' => 15,
                'BG' => 15,
                'BH' => 15,
                'BI' => 15,
                'BJ' => 15
            );
            foreach($array_column as $key => $value){
                $objPHPExcel->getActiveSheet()->getColumnDimension($key)->setAutoSize(false);
                $objPHPExcel->getActiveSheet()->getColumnDimension($key)->setWidth($value);
            }

            $array_row = array(
                '4' => 23
            );

            //*******************************************
            //************* NỘI DUNG ********************
            //*******************************************
            $array_content = $this->tieude("");
            if($this->input->get('id')=="dathuruthoso"){
                $array_content['AS8'] = "Học phí loại 1 đã trả";
                $array_content['AT8'] = "Học phí loại 2 đã trả";
                $array_content['AU8'] = "Sức khỏe đã trả";
                $array_content['AV8'] = "Thẻ đã trả";
                $array_content['AW8'] = "Y tế đã trả";
                $array_content['AX8'] = "Thân thể loại 1 đã trả";
                $array_content['AY8'] = "Thân thể loại 2 đã trả";
                $array_content['AZ8'] = "Tổng tiền đã trả";
                $array_content['BA8'] = "Học phí loại 1 còn lại";
                $array_content['BB8'] = "Học phí loại 2 còn lại";
                $array_content['BC8'] = "Sức khỏe còn lại";
                $array_content['BD8'] = "Thẻ còn lại";
                $array_content['BE8'] = "Y tế còn lại";
                $array_content['BF8'] = "Thân thể loại 1 còn lại";
                $array_content['BG8'] = "Thân thể loại 2 còn lại";
                $array_content['BH8'] = "Tổng tiền còn lại";
                $array_content['BI8'] = "Cán bộ rút hồ sơ";
                $array_content['BJ8'] = "Thời gian rút hồ sơ";

            }


            $dshs                 = $this->dsHS();
            if($this->input->get('id')=="dadangky" || $this->input->get('id') == "dathuhocphi"){
                $array_content['AS8'] = $dshs['hstt'];
                $array_content['AT8'] = $dshs['gbnh'];
                $array_content['AU8'] = $dshs['bshb'];
                $array_content['AV8'] = $dshs['bsks'];
                $array_content['AW8'] = $dshs['cntn'];
                $array_content['AX8'] = $dshs['bstn'];  
                $array_content['AY8'] = $dshs['utkv'];
                $array_content['AZ8'] = $dshs['utdt'];
                $array_content['BA8'] = $dshs['nvqs'];
                $array_content['BB8'] = $dshs['xnvm'];
                    //Border
                $styleArray = array(
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle('A8:BB'.$dem)->applyFromArray($styleArray);
            }
            if($this->input->get('id') == "dathuhocphi"){
                $array_content['BC8'] = "Học phí 1";
                $array_content['BD8'] = "Học phí 2";
                $array_content['BE8'] = 'Khám SK';
                $array_content['BF8'] = 'Thẻ';
                $array_content['BG8'] = 'BHYT';
                $array_content['BH8'] = 'BHTT1';
                $array_content['BI8'] = 'BHTT2';
                $array_content['BJ8'] = 'Tổng';
                //Border
                $styleArray = array(
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
                );
                $objPHPExcel->getActiveSheet()->getStyle('A8:BJ'.$dem)->applyFromArray($styleArray);
                unset($styleArray);
                $array_bold = array('A8:BJ8');
                foreach($array_bold as $cell){
                    $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
                }
                 // Chỉnh cỡ font
                $array_font_size = array(
                    'A8:BJ8'     => 10,
                    'A8:BJ'.$dem => 10,
                );
                foreach($array_font_size as $key => $value){
                    $objPHPExcel->getActiveSheet()->getStyle($key)->getFont()->setSize($value);
                }
                 // Căn giữa ngang
                $canngang= array('BC8:BJ'.$dem);
                foreach($canngang as $cell){
                    $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                }
            }
            if($this->input->get('id')=="trungtuyen"){
                $array_content['I4'] = 'DANH SÁCH SINH VIÊN TRÚNG TUYỂN ';
            }
            else if($this->input->get('id')=="datragiaybao"){
                $array_content['I4'] = 'DANH SÁCH SINH VIÊN ĐÃ HOÀN THÀNH CÔNG TÁC TRẢ GIẤY BÁO ';
            }
            else if($this->input->get('id')=="dadangky"){
                $array_content['I4'] = 'DANH SÁCH SINH VIÊN ĐÃ HOÀN THÀNH CÔNG TÁC ĐĂNG KÝ ';
            }
            else if($this->input->get('id')=="dathuhocphi"){
                 $array_content['I4'] = 'DANH SÁCH SINH VIÊN ĐÃ HOÀN THÀNH CÔNG TÁC THU HỌC PHÍ ';
            }
            else if($this->input->get('id')=="dathuruthoso"){
                 $array_content['I4'] = 'DANH SÁCH SINH VIÊN ĐÃ RÚT HỒ SƠ';
            }
            $indexRow = 9;
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
            else if($this->input->get('id')=="dathuruthoso"){
                $data = $this->Mbaocaothongke->ruthoso();
            }
            else{
                $data = $this->Mbaocaothongke->baocaotheonganh($this->input->get('id'),0);
            }
            $stt = 1;
            // pr($data);
            foreach ($data AS $k => $v)
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
                $tohop[$v['soBD']]    = $this->Mhotro_nhaphoc->getToHop($v['soBD']);
                $tachmon[$v['soBD']]  = explode(",",  $tohop[$v['soBD']]['tohop']);
                $getMon[$v['soBD']]   = $this->Mhotro_nhaphoc->getMon($tohop[$v['soBD']], $v['soBD']);
                $array_content['R8'] = "Môn 1";
                $array_content['S8'] = "Môn 2";
                $array_content['T8'] = "Môn 3";
                $hs[$v['soBD']][]     = explode(",", $v['hoso']);
                foreach ($hs[$v['soBD']] as $key => $value) {
                    $arr[$v['soBD']] = $value;
                    foreach ($arr[$v['soBD']] as $v1) {
                        $hoso[$v['soBD']][$v1] = $v1;
                    }
                }
                if(!empty($v['thoigian_nhaphs'])){
                    $tg_nhap = date('d/m/Y H:i:s', strtotime($v['thoigian_nhaphs']));
                }else{
                    $tg_nhap = "";
                }
                if(isset($danhmuc['getLop'][$v['masv']])){
                    $lop = $danhmuc['getLop'][$v['masv']];
                }else{
                    $lop = "";
                }
                if(isset($danhmuc['canbo'][$v['nguoinhaphs']])){
                    $nguoinhaphs = $v['nguoinhaphs'];
                }else{
                    $nguoinhaphs = $v['nguoinhaphs'];
                }
                $array_content['A'.$indexRow]  = $stt++;
                $array_content['B'.$indexRow]  = $lop;
                $array_content['C'.$indexRow]  = $v['masv'];
                $array_content['D'.$indexRow]  = substr($v['hoten'],0, strlen($v['hoten']) - strlen(strrchr($v['hoten']," "))) ;
                $array_content['E'.$indexRow]  = trim(strrchr($v['hoten']," "));
                $array_content['F'.$indexRow]  = $v['ngaysinh'];
                $array_content['G'.$indexRow]  = $v['gioitinh'];
                $array_content['H'.$indexRow]  = $v['CMND'];
                $array_content['I'.$indexRow]  = $v['ngaycapcmnd'];
                $array_content['J'.$indexRow]  = $v['noicapcmnd'];
                $array_content['K'.$indexRow]  = $dantoc;
                $array_content['L'.$indexRow]  = $tongiao;
                $array_content['M'.$indexRow]  = $v['hokhau'];
                $array_content['N'.$indexRow]  = $v['doituong'];
                $array_content['O'.$indexRow]  = $v['khuvuc'];
                $array_content['P'.$indexRow]  = $v['soBD'];
                $array_content['Q'.$indexRow]  = $v['khoihoc'];
                $array_content['R'.$indexRow]  = $getMon[$v['soBD']][$tachmon[$v['soBD']][0]];
                $array_content['S'.$indexRow]  = $getMon[$v['soBD']][$tachmon[$v['soBD']][1]];
                $array_content['T'.$indexRow]  = $getMon[$v['soBD']][$tachmon[$v['soBD']][2]];
                $array_content['U'.$indexRow]   = $v['tongdiem_xettuyen'];
                $array_content['V'.$indexRow]   = $v['FK_sMaNganh'];
                $array_content['W'.$indexRow]   =  $danhmuc['nganh'][$v['FK_sMaNganh']];
                $array_content['X'.$indexRow]   = $v['sdt'];
                $array_content['Y'.$indexRow]   = $v['email'];
                $array_content['Z'.$indexRow]   = $v['doan'];
                $array_content['AA'.$indexRow]  = $v['quequan'];
                $array_content['AB'.$indexRow]  = $v['diachi'];
                $array_content['AC'.$indexRow]  = $v['noisinh'];
                $array_content['AD'.$indexRow]  = $v['bachoc'];
                $array_content['AE'.$indexRow]  = $v['namtotnghiep'];
                $array_content['AF'.$indexRow]  = $v['noitotnghiep'];
                $array_content['AG'.$indexRow]  = $v['nangkhieu'];
                $array_content['AH'.$indexRow]  = $v['chucvu'];
                $array_content['AI'.$indexRow]  = $v['nguoinhaphs'];
                $array_content['AJ'.$indexRow]  = $tg_nhap;
                $array_content['AK'.$indexRow]  = $v['hoten_bo'];
                $array_content['AL'.$indexRow]  = $v['namsinh_bo'];
                $array_content['AM'.$indexRow]  = $v['nghenghiep_bo'];
                $array_content['AN'.$indexRow]  = $v['sdt_bo'];
                $array_content['AO'.$indexRow]  = $v['hoten_me'];
                $array_content['AP'.$indexRow]  = $v['namsinh_me'];
                $array_content['AQ'.$indexRow]  = $v['nghenghiep_me'];
                $array_content['AR'.$indexRow]  = $v['sdt_me'];
                if($this->input->get('id')=="dathuruthoso"){
                    $ruths = $this->Mbaocaothongke->get_where('ruthoso_sinhvien','soBD', $v['soBD'])[0];
                    // pr($ruths);
                    $array_content['AS'.$indexRow] = $ruths['hp1_tra'];
                    $array_content['AT'.$indexRow] = $ruths['hp2_tra'];
                    $array_content['AU'.$indexRow] = $ruths['sk_tra'];
                    $array_content['AV'.$indexRow] = $ruths['the_tra'];
                    $array_content['AW'.$indexRow] = $ruths['yt_tra'];
                    $array_content['AX'.$indexRow] = $ruths['tt1_tra'];
                    $array_content['AY'.$indexRow] = $ruths['tt2_tra'];
                    $array_content['AZ'.$indexRow] = $ruths['tongtra'];
                    $array_content['BA'.$indexRow] = $ruths['hp1_con'];
                    $array_content['BB'.$indexRow] = $ruths['hp2_con'];
                    $array_content['BC'.$indexRow] = $ruths['sk_con'];
                    $array_content['BD'.$indexRow] = $ruths['the_con'];
                    $array_content['BE'.$indexRow] = $ruths['yt_con'];
                    $array_content['BF'.$indexRow] = $ruths['tt1_con'];
                    $array_content['BG'.$indexRow] = $ruths['tt2_con'];
                    $array_content['BH'.$indexRow] = $ruths['tongcon'];
                    $array_content['BI'.$indexRow] = $ruths['nguoi_ruthoso'];
                    $array_content['BJ'.$indexRow] =  date('d/m/Y H:i:s', strtotime($ruths['thoigian_ruthoso']));
                }
                if($this->input->get('id')=="dadangky" || $this->input->get('id')=="dathuhocphi"){
                     if(isset($hoso[$v['soBD']]['hstt'])){
                        $array_content['AS'.$indexRow] = "X";
                    }
                    if(isset($hoso[$v['soBD']]['gbnh'])){
                        $array_content['AT'.$indexRow] = "X";
                    }
                    if(isset($hoso[$v['soBD']]['bshb'])){
                       $array_content['AU'.$indexRow] = "X";
                    }
                    if(isset($hoso[$v['soBD']]['bsks'])){
                        $array_content['AV'.$indexRow] = "X";
                    }
                    if(isset($hoso[$v['soBD']]['cntn'])){
                        $array_content['AW'.$indexRow] = "X";
                    }
                    if(isset($hoso[$v['soBD']]['bstn'])){
                         $array_content['AX'.$indexRow] = "X";
                    }
                    if(isset($hoso[$v['soBD']]['utkv'])){
                         $array_content['AY'.$indexRow] = "X";
                    }
                    if(isset($hoso[$v['soBD']]['utdt'])){
                         $array_content['AZ'.$indexRow] = "X";
                    }
                    if(isset($hoso[$v['soBD']]['nvqs'])){
                        $array_content['BA'.$indexRow] = "X";
                    }
                    if(isset($hoso[$v['soBD']]['xnvm'])){
                          $array_content['BB'.$indexRow] = "X";
                    }
                }
               

                // đổ ra học phí
                $ds[$v['masv']] = "";
                $ds[$v['masv']]['hp1'] = "";
                $ds[$v['masv']]['tt1'] = "";
                if($this->input->get('id')=="dathuhocphi"){
                    $chitiet_hspv[$v['masv']] = $this->Mbaocaothongke->get_many_where('hocphi_sinhvien',array('masv' => $v['masv'], 'hocphi !=' =>""));
                     if(!empty($chitiet_hspv[$v['masv']])){
                        foreach ($chitiet_hspv as $key => $value) {
                            foreach ($value as $k1 => $v1) {
                                if($k1 != 0){
                                    $chitiet_hspv[$v['masv']][0]['tamthu_hp1']  += $v1['tamthu_hp1'];
                                    $chitiet_hspv[$v['masv']][0]['tamthu_hp2']  += $v1['tamthu_hp2'];
                                    $chitiet_hspv[$v['masv']][0]['tamthu_sk']  += $v1['tamthu_sk'];
                                    $chitiet_hspv[$v['masv']][0]['tamthu_the'] += $v1['tamthu_the'];
                                    $chitiet_hspv[$v['masv']][0]['tamthu_yt']  += $v1['tamthu_yt'];
                                    $chitiet_hspv[$v['masv']][0]['tamthu_tt1'] += $v1['tamthu_tt1'];
                                    $chitiet_hspv[$v['masv']][0]['tamthu_tt2'] += $v1['tamthu_tt2'];
                                }
                                $ds[$v['masv']] = array(
                                    'hp1'  => $chitiet_hspv[$v['masv']][0]['tamthu_hp1'],
                                    'hp2'  => $chitiet_hspv[$v['masv']][0]['tamthu_hp2'],
                                    'sk'  => $chitiet_hspv[$v['masv']][0]['tamthu_sk'],
                                    'the' => $chitiet_hspv[$v['masv']][0]['tamthu_the'],
                                    'yt'  => $chitiet_hspv[$v['masv']][0]['tamthu_yt'],
                                    'tt1' => $chitiet_hspv[$v['masv']][0]['tamthu_tt1'],
                                    'tt2' => $chitiet_hspv[$v['masv']][0]['tamthu_tt2'],
                                );
                            }
                        }
                     }
                     // 
                    if($v['FK_sMaNganh'] == 15 || $v['FK_sMaNganh'] == 63 || $v['FK_sMaNganh'] == 62 || $v['FK_sMaNganh'] == 61)
                    {
                       $array_content['BC'.$indexRow]   = 0;
                       $array_content['BD'.$indexRow]   = $ds[$v['masv']]['hp2'];
                       $array_content['BH'.$indexRow]   = 0;
                       $array_content['BI'.$indexRow]   = $ds[$v['masv']]['tt2'];
                    }else{
                        $array_content['BC'.$indexRow]  = $ds[$v['masv']]['hp1'];
                        $array_content['BD'.$indexRow]  = 0;
                        $array_content['BH'.$indexRow]  = $ds[$v['masv']]['tt1'];
                        $array_content['BI'.$indexRow]  = 0;
                    }
                    $array_content['BE'.$indexRow]  = $ds[$v['masv']]['sk'];
                    $array_content['BF'.$indexRow]  = $ds[$v['masv']]['the'];
                    $array_content['BG'.$indexRow]  = $ds[$v['masv']]['yt'];
                    $array_content['BJ'.$indexRow]  = $v['tongtien_dathu'];
                }
                //end học phí
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
            $danhmuc = $this->getDanhmuc();
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
                $var  = $ngaythu[0];
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
                
            $dem = count($data)+8;  
            //Border
            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            $objPHPExcel->getActiveSheet()->getStyle('A8:BK'.$dem)->applyFromArray($styleArray);
            unset($styleArray);
            // Căn cỡ cột tự động
            // foreach(range('A','AB') as $columnID){
            //     $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
            // }
            // for ($i = 'AZ'; $i !=  $objPHPExcel->getActiveSheet()->getHighestColumn(); $i++) {
            //     $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
            // }
            // Căn cỡ hàng tự động
            foreach($objPHPExcel->getActiveSheet()->getRowDimensions() as $rd) {
                $rd->setRowHeight(-1);
            }

            //Xuống dòng
            $objPHPExcel->getActiveSheet()->getStyle()->getAlignment()->setWrapText(true);

            // Merge cell rộng rộng
            $array_merge = array('B6:D6', 'A1:D1','A2:D2','I4:M4','F5:H5', 'I5:M5');
            foreach($array_merge as $cell){
                $objPHPExcel->getActiveSheet()->mergeCells($cell);
            }


            // Căn giữa ngang
            $canngang= array('B6:D6', 'A8:BB8', 'I4:M4','M1:M2','F5:H5','I5:M5','M6', 'F8:V'.$dem,'X8:BK'.$dem);
            foreach($canngang as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            }

            // Căn giữa dọc
            $array_vertical_center = array('A9:BK'.$dem);
            foreach($array_vertical_center as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            }


            // In đậm
            $array_bold = array('I4:M4','A8:BJ8', 'A8:A'.$dem, 'A1:A2', 'B6:D6', 'K1:M1', 'K2:M2', 'I5:M5','L6:N6');
            foreach($array_bold as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setBold(true);
            }

            // In nghiêng
            $array_italic = array('I5:M5');
            foreach($array_italic as $cell){
                $objPHPExcel->getActiveSheet()->getStyle($cell)->getFont()->setItalic(true);
            }

            // Chỉnh cỡ font
            $array_font_size = array(
                'A1'     => 14,
                'A2'     => 10,
                'A3'     => 11,
                'D4'     => 18,
                'F5'     => 11,
                'A8:BB8' => 10,
                'M1'     => 12,
                'M2'     => 12,
                'I5:M5'  => 10,
                'I4:M4'  => 16,
                'B6:D6'  => 10,
                'L6:N6'  => 10,
                'A8:BK'.$dem => 12,
            );


            foreach($array_font_size as $key => $value){
                $objPHPExcel->getActiveSheet()->getStyle($key)->getFont()->setSize($value);
            }

            // Chỉnh cỡ cột
            $array_column = array(
                'A'  => 4,
                'B'  => 10,
                'C'  => 13,
                'D'  => 18,
                'E'  => 8,
                'F'  => 11,
                'G'  => 8,
                'H'  => 20,
                'I'  => 13,
                'J'  => 15,
                'K'  => 7,
                'L'  => 9,
                'M'  => 35,
                'N'  => 9,
                'O'  => 8,
                'P'  => 10,
                'Q'  => 9,
                'R'  => 8,
                'S'  => 8,
                'T'  => 8,
                'U'  => 12,
                'V'  => 9,
                'W'  => 39,
                'X'  => 13,
                'Y'  => 32,
                'Z'  => 8,
                'AA' => 30,
                'AB' => 40,
                'AC' => 29,
                'AD' => 16,
                'AE' => 8,
                'AF' => 15,
                'AG' => 27,
                'AH' => 14,
                'AI' => 24,
                'AJ' => 18,
                'AK' => 17,
                'AL' => 12,
                'AM' => 20,
                'AN' => 12,
                'AO' => 14,
                'AP' => 14,
                'AQ' => 14,
                'AR' => 14,
                'AS' => 15,
                'AT' => 15,
                'AU' => 15,
                'AV' => 15,
                'AW' => 28,
                'AX' => 15,
                'AY' => 15,
                'AZ' => 15,
                'BA' => 15,
                'BB' => 15,
                'BC' => 12,
                'BD' => 12,
                'BE' => 15,
                'BF' => 15,
                'BG' => 15,
                'BH' => 15,
                'BI' => 15,
                'BJ' => 15,
                'BK' => 15,
            );
            foreach($array_column as $key => $value){
                $objPHPExcel->getActiveSheet()->getColumnDimension($key)->setAutoSize(false);
                $objPHPExcel->getActiveSheet()->getColumnDimension($key)->setWidth($value);
            }

            $array_row = array(
                '4' => 23
            );

            //Chỉnh cỡ hàng fix cứng

            // $aaa = strlen('Công nghệ kỹ thuật điều khiển và tự động hóa');
            // pr($aaa);
            //*******************************************
            //************* NỘI DUNG ********************
            //*******************************************
            $array_content = $this->tieude("BÁO CÁO TÌNH HÌNH THU TÀI CHÍNH");


            $monhoc               = $this->monhoc();


            $dshs                 = $this->dsHS();
            $array_content['AS8'] = $dshs['hstt'];
            $array_content['AT8'] = $dshs['gbnh'];
            $array_content['AU8'] = $dshs['bshb'];
            $array_content['AV8'] = $dshs['bsks'];
            $array_content['AW8'] = $dshs['cntn'];
            $array_content['AX8'] = $dshs['bstn'];
            $array_content['AY8'] = $dshs['utkv'];
            $array_content['AZ8'] = $dshs['utdt'];
            $array_content['BA8'] = $dshs['nvqs'];
            $array_content['BB8'] = $dshs['xnvm'];


            $dshp                 = $this->dsHocPhi();
            $array_content['BC8'] = $dshp['hp1'];
            $array_content['BD8'] = $dshp['hp2'];
            $array_content['BE8'] = $dshp['sk'];
            $array_content['BF8'] = $dshp['the'];
            $array_content['BG8'] = $dshp['tt1'];
            $array_content['BH8'] = $dshp['tt2'];
            $array_content['BI8'] = $dshp['yt'];
            $array_content['BJ8'] = "Số giao dịch";
            $array_content['BK8'] = "Tổng tiền";
            $tt = 1;
            $tongtien_dathu = 0;
            foreach ($data as $key => $value) {
                    $dssv_dot[$value['masv']][] = $value;
                }
            $indexRow = 9;
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
                            'J'.$indexRow.':J'.$mer,
                            'K'.$indexRow.':K'.$mer,
                            'L'.$indexRow.':L'.$mer,
                            'M'.$indexRow.':M'.$mer,
                            'N'.$indexRow.':N'.$mer,
                            'O'.$indexRow.':O'.$mer,
                            'P'.$indexRow.':P'.$mer,
                            'Q'.$indexRow.':Q'.$mer,
                            'R'.$indexRow.':R'.$mer,
                            'S'.$indexRow.':S'.$mer,
                            'T'.$indexRow.':T'.$mer,
                            'U'.$indexRow.':U'.$mer,
                            'V'.$indexRow.':V'.$mer,
                            'W'.$indexRow.':W'.$mer,
                            'X'.$indexRow.':X'.$mer,
                            'Y'.$indexRow.':Y'.$mer,
                            'Z'.$indexRow.':Z'.$mer,
                            'AA'.$indexRow.':AA'.$mer,
                            'AB'.$indexRow.':AB'.$mer,
                            'AC'.$indexRow.':AC'.$mer,
                            'AD'.$indexRow.':AD'.$mer,
                            'AE'.$indexRow.':AE'.$mer,
                            'AF'.$indexRow.':AF'.$mer,
                            'AG'.$indexRow.':AG'.$mer,
                            'AH'.$indexRow.':AH'.$mer,
                            'AI'.$indexRow.':AI'.$mer,
                            'AJ'.$indexRow.':AJ'.$mer,
                            'AK'.$indexRow.':AK'.$mer,
                            'AL'.$indexRow.':AL'.$mer,
                            'AM'.$indexRow.':AM'.$mer,
                            'AN'.$indexRow.':AN'.$mer,
                            'AO'.$indexRow.':AO'.$mer,
                            'AP'.$indexRow.':AP'.$mer,
                            'AQ'.$indexRow.':AQ'.$mer,
                            'AR'.$indexRow.':AR'.$mer,
                            //
                            'AS'.$indexRow.':AS'.$mer,
                            'AT'.$indexRow.':AT'.$mer,
                            'AU'.$indexRow.':AU'.$mer,
                            'AV'.$indexRow.':AV'.$mer,
                            'AW'.$indexRow.':AW'.$mer,
                            'AX'.$indexRow.':AX'.$mer,
                            'AY'.$indexRow.':AY'.$mer,
                            'AZ'.$indexRow.':AZ'.$mer,
                            'BA'.$indexRow.':BA'.$mer,
                            'BB'.$indexRow.':BB'.$mer,
                            'BK'.$indexRow.':BK'.$mer
                        );
                }
                $tongtien_sinhvien  = 0;
                foreach ($sv_dot as $key => $v) {
                    $tongtien_sinhvien = $tongtien_sinhvien + $v['tongtien_thu'];
                }
                foreach ($sv_dot as $key => $v) {
                      if(isset($danhmuc['getLop'][$v['masv']])){
                        $lop = $danhmuc['getLop'][$v['masv']];
                    }else{
                        $lop = "";
                    }
                    $tohop[$v['soBD']]    = $this->Mhotro_nhaphoc->getToHop($v['soBD']);
                    $tachmon[$v['soBD']]  = explode(",",  $tohop[$v['soBD']]['tohop']);
                    $getMon[$v['soBD']]   = $this->Mhotro_nhaphoc->getMon($tohop[$v['soBD']], $v['soBD']);
                    $array_content['R8'] = "Môn 1";
                    $array_content['S8'] = "Môn 2";
                    $array_content['T8'] = "Môn 3";
                    $hs[$v['soBD']][]     = explode(",", $v['hoso']);
                    foreach ($hs[$v['soBD']] as $key => $value) {
                        $arr[$v['soBD']] = $value;
                        foreach ($arr[$v['soBD']] as $v1) {
                            $hoso[$v['soBD']][$v1] = $v1;
                        }
                    }
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
                    $tennganh = $this->Mbaocaothongke->get_where_select1('tbl_nganh','sTen_Nganh','iMa_nganh',$v['FK_sMaNganh']);
                                $array_content['A'.$indexRow]  = $stt;
                                $array_content['B'.$indexRow]  = $lop ;
                                $array_content['C'.$indexRow]  = $v['masv'];
                                $array_content['D'.$indexRow]  = substr($v['hoten'],0, strlen($v['hoten']) - strlen(strrchr($v['hoten']," "))) ;
                                $array_content['E'.$indexRow]  = trim(strrchr($v['hoten']," "));
                                $array_content['F'.$indexRow]  = $v['ngaysinh'];
                                $array_content['G'.$indexRow]  = $v['gioitinh'];
                                $array_content['H'.$indexRow]  = $v['CMND'];
                                $array_content['I'.$indexRow]  = $v['ngaycapcmnd'];
                                $array_content['J'.$indexRow]  = $v['noicapcmnd'];
                                $array_content['K'.$indexRow]  = $dantoc;
                                $array_content['L'.$indexRow]  = $tongiao;
                                $array_content['M'.$indexRow]  = $v['hokhau'];
                                $array_content['N'.$indexRow]  = $v['doituong'];
                                $array_content['O'.$indexRow]  = $v['khuvuc'];
                                $array_content['P'.$indexRow]  = $v['soBD'];
                                $array_content['Q'.$indexRow]  = $v['khoihoc'];
                                $array_content['R'.$indexRow]  = $getMon[$v['soBD']][$tachmon[$v['soBD']][0]];
                                $array_content['S'.$indexRow]  = $getMon[$v['soBD']][$tachmon[$v['soBD']][1]];
                                $array_content['T'.$indexRow]  = $getMon[$v['soBD']][$tachmon[$v['soBD']][2]];
                                $array_content['U'.$indexRow]   = $v['tongdiem_xettuyen'];
                                $array_content['V'.$indexRow]   = $v['FK_sMaNganh'];
                                $array_content['W'.$indexRow]   =  $danhmuc['nganh'][$v['FK_sMaNganh']];
                                $array_content['X'.$indexRow]   = $v['sdt'];
                                $array_content['Y'.$indexRow]   = $v['email'];
                                $array_content['Z'.$indexRow]   = $v['doan'];
                                $array_content['AA'.$indexRow]   = $v['quequan'];
                                $array_content['AB'.$indexRow]  = $v['diachi'];
                                $array_content['AC'.$indexRow]  = $v['noisinh'];
                                $array_content['AD'.$indexRow]  = $v['bachoc'];
                                $array_content['AE'.$indexRow]  = $v['namtotnghiep'];
                                $array_content['AF'.$indexRow]  = $v['noitotnghiep'];
                                $array_content['AG'.$indexRow]  = $v['nangkhieu'];
                                $array_content['AH'.$indexRow]  = $v['chucvu'];
                                $array_content['AI'.$indexRow]  = $danhmuc['canbo'][$v['nguoithu_hocphi']];
                                // $array_content['AI'.$indexRow]  = $danhmuc['canbo'][$v['nguoinhaphs']];
                                $array_content['AJ'.$indexRow]  = date('H:i:s d/m/Y', strtotime($v['thoigian_hocphi']));
                                $array_content['AK'.$indexRow]  = $v['hoten_bo'];
                                $array_content['AL'.$indexRow]  = $v['namsinh_bo'];
                                $array_content['AM'.$indexRow]  = $v['nghenghiep_bo'];
                                $array_content['AN'.$indexRow]  = $v['sdt_bo'];
                                $array_content['AO'.$indexRow]  = $v['hoten_me'];
                                $array_content['AP'.$indexRow]  = $v['namsinh_me'];
                                $array_content['AQ'.$indexRow]  = $v['nghenghiep_me'];
                                $array_content['AR'.$indexRow]  = $v['sdt_me'];
                                $array_content['BC'.$indexRow]  = $v['tamthu_hp1'];
                                $array_content['BD'.$indexRow]  = $v['tamthu_hp2'];
                                $array_content['BE'.$indexRow]  = $v['tamthu_sk'];
                                $array_content['BF'.$indexRow]  = $v['tamthu_the'];
                                $array_content['BG'.$indexRow]  = $v['tamthu_tt1'];
                                // pr($v['tamthu_tt2']);
                                $array_content['BH'.$indexRow]  = $v['tamthu_tt2'];
                                $array_content['BI'.$indexRow]  = $v['tamthu_yt'];
                                $array_content['BJ'.$indexRow]  = $v['pos'];
                                $array_content['BK'.$indexRow]  = $tongtien_sinhvien;
                
                                if(isset($hoso[$v['soBD']]['hstt'])){
                                    $array_content['AS'.$indexRow] = "X";
                                }
                                if(isset($hoso[$v['soBD']]['gbnh'])){
                                    $array_content['AT'.$indexRow] = "X";
                                }
                                if(isset($hoso[$v['soBD']]['bshb'])){
                                   $array_content['AU'.$indexRow] = "X";
                                }
                                if(isset($hoso[$v['soBD']]['bsks'])){
                                    $array_content['AV'.$indexRow] = "X";
                                }
                                if(isset($hoso[$v['soBD']]['cntn'])){
                                    $array_content['AW'.$indexRow] = "X";
                                }
                                if(isset($hoso[$v['soBD']]['bstn'])){
                                     $array_content['AX'.$indexRow] = "X";
                                }
                                if(isset($hoso[$v['soBD']]['utkv'])){
                                     $array_content['AY'.$indexRow] = "X";
                                }
                                if(isset($hoso[$v['soBD']]['utdt'])){
                                     $array_content['AZ'.$indexRow] = "X";
                                }
                                if(isset($hoso[$v['soBD']]['nvqs'])){
                                    $array_content['BA'.$indexRow] = "X";
                                }
                                if(isset($hoso[$v['soBD']]['xnvm'])){
                                      $array_content['BB'.$indexRow] = "X";
                                }
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
        public function dsHocPhi(){
            $dsten_hp = array(
                'hp1'   => 'Học phí 1',
                'hp2'   => 'Học phí 2',
                'sk'    => 'Khám sức khỏe',
                'the'   => 'Thẻ thư viện',
                'tt1'   => 'Bảo hiểm thân thể 1',
                'tt2'   => 'Bảo hiểm thân thể 2',
                'yt'    => 'Bảo hiểm y tế'
            );
            return $dsten_hp;
        }
        public function getDanhmuc(){
            $nganh              = $this->Mbaocaothongke->get('tbl_nganh');
            $dantoc             = $this->Mbaocaothongke->get('dm_dantoc');
            $tongiao            = $this->Mbaocaothongke->get('dm_tongiao');
            $data['tbl_canbo']  = $this->Mbaocaothongke->get('dm_canbo');
            $data['tbl_canbo']  = $this->Mbaocaothongke->get('dm_canbo');
            $data['tbl_hocphi'] = $this->Mbaocaothongke->get('tbl_hocphi');
            $sinhvien           = $this->Mbaocaothongke->get('tbl_sinhvien');
            $getLop             = $this->Mbaocaothongke->getLop();
            foreach ($getLop as $value) {
                 $data['getLop'][$value['masv']] = $value['tenlop'];
            }
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
          // danh sách hồ sơ in  giấy cam đoan
        public function dsHS(){
            $dsten_hs           = array(
                'bshb' => ' Bản sao học bạ',
                'bsks' => ' Bản sao khai sinh',
                'bstn' => ' Bản sao tốt nghiệp',
                'cntn' => ' Chứng nhận tốt nghiệp(Tạm thời)',
                'gbnh' => ' Giấy báo nhập học',
                'hstt' => ' Hồ sơ trúng tuyển',
                'nvqs' => ' Nghĩa vụ quân sự',
                'utdt' => ' Ưu tiên đối tượng',
                'utkv' => ' Ưu tiên khu vực',
                'xnvm' => ' Xác nhận vắng mặt'
            );
            return $dsten_hs;
        }
        public function monhoc(){
            $monhoc = array(
                'toan'      => 'Toán',
                'vatly'     => 'Vật Lý',
                'hoahoc'    => 'Hóa Học',
                'ngoaingu'  => 'Ngoai Ngữ',
                'sinhhoc'   => 'Sinh Học',
                'nguvan'    => 'Ngữ Văn',
                'lichsu'    => 'Lịch Sử',
                'dialy'     => 'Địa Lý',
                'nangkhieu1'=> 'Năng khiếu 1',
                'nangkhieu2'=> 'Năng khiếu 2',
                'nangkhieu3'=> 'Năng khiếu 3',
            );
            return $monhoc;
        }
        public function tieude($title){
             $data = array(
                'A1' => 'BỘ GIÁO DỤC VÀ ĐÀO TẠO',
                'A2' => 'TRƯỜNG ĐẠI HỌC MỞ HÀ NỘI',
                'A8' => 'STT',
                'I4' =>  $title,
                'I5' => '(Kèm theo Quyết định số:/QĐ-ĐHM ngày '.date('d').' tháng ' .date('m').' năm '.date('Y').')',
                'B6' => 'HỆ: CHÍNH QUY',
                'M6' => 'KHÓA HỌC:'.date('Y') .'-'.(date('Y') + 1) ,
                'B8' => 'Lớp',
                'M1' => 'CỘNG HOÀ XÃ HỘI CHỦ NGHĨA VIỆT NAM',
                'M2' => 'Độc lập - Tự do - Hạnh phúc',
                'C8' => 'Mã SV',
                'D8' => 'Họ và',
                'E8' => 'Tên',
                'F8' => 'Ngày sinh',
                'G8' => 'Giới tính',
                'H8' => 'CMTND/Thẻ căn cước',
                'I8' => 'Ngày cấp',
                'J8' => 'Nơi cấp',
                'K8' => 'Dân tộc',
                'L8' => 'Tôn giáo',
                'M8' => 'Hộ khẩu',
                'N8' => 'Đối tượng',
                'O8' => 'Khu vực',
                'P8' => 'SBD',
                'Q8' => 'THXT',
                'U8' => 'Tổng điển XT',
                'V8' => 'Mã ngành',
                'W8' => 'Ngành',
                'X8' => 'SĐT',
                'Y8' => 'Email',
                'Z8' => 'Đoàn',
                'AA8' => 'Quê quán',
                'AB8' => 'Địa chỉ',
                'AC8' => 'Nơi sinh',
                'AD8' => 'Bậc đã học',
                'AE8' => 'Năm TN',
                'AF8' => 'Nơi TN',
                'AG8' => 'Năng khiếu',
                'AH8' => 'Chức vụ',
                'AI8' => 'Người nhập',
                'AJ8' => 'Thời gian nhập',
                'AK8' => 'Họ tên bố',
                'AL8' => 'Năm sinh bố',
                'AM8' => 'Nghề nghiệp bố',
                'AN8' => 'SĐT bố',
                'AO8' => 'Họ tên mẹ',
                'AP8' => 'Năm sinh mẹ',
                'AQ8' => 'Nghề nghiệp mẹ',
                'AR8' => 'SĐT mẹ',
            );
             return $data;
        }
    }
    ?>
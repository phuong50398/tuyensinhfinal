<!DOCTYPE html>
<html lang="">
    <head>
    <meta http-equiv="Pragma" content="no-cache">
        <meta charset="utf-8">
        <title>IN HÓA ĐƠN</title>
    </head>
    <style type="text/css">
        page.page{
            min-height: 370px !important;
        }
        *{
            margin: 0;
            padding: 0;
        }
        .title-lien{
            text-align: right;
        }
        .col-md-6{
            width: 50%;
            float: left;
        }
        .col-md-12{
            width: 100%;
            clear: both;
        }
        .title-left,.title-right{
            text-align: center;
        }
        .phieuthu{
            text-align: center;
            margin-bottom: 3px;
        }
        p{
            margin-top:5px;
            margin-bottom:5px;
            font-size: 13px;
        }
        .title-left-1{
            font-size: 14px;
        }
        .title-right-1, .thongtin_sv p, .title-truong, .thongtinhp-right, .title-lien{
            font-size: 15px;
        }
        .thongtinhp{
            margin-top: 88px;
        }
        .thongtinhp p{
            text-align: center;
            font-size: 15px;
        }
        .thongtinhp-right{
            float: right;
        }

        .page:before{
            content: url(http://localhost:8080/Tuyensinh/public/images/DV01.png);
            opacity: 0.1;
            position: absolute;
            left: 27%;
        }
            
        @media print {
            *{
                -webkit-print-color-adjust: exact;
            }
             @page:before{
                padding: 1em;
                 content: url(http://localhost:8080/Tuyensinh/public/images/DV01.png);
                opacity: 0.1;
                position: absolute;
                left: 27%;
            }
            @page{
              margin-left:0;
            }
        }
        .col-md-2{
            width: 18%;
            float: left;
        }
        .col-md-10{
            width: 82%;
            float: left;

        }
        .thongtin_sv{
            margin-left: 50px;
        }
         .thongtin_sv p{
            margin-top: 0;
         }
         .thongtin_sv > .col-md-2 p{
            margin-bottom: 5px;
         }
         .thongtin_sv > .col-md-10 p{
            margin-bottom: 3px;
            border-bottom: 2px solid #ccc;
         }

         .col-md-4{
            width: 33.33333333333333%;
            float: left;
         }
         .kyten{
            margin-top: 9em;
         }
         .kyten-left p, .kyten-center p, .kyten-right p{
            font-size: 16px;
            text-align: center;
         }
         .kyten-left p:nth-child(2), .kyten-center p:nth-child(2), .kyten-right p:nth-child(2){
            margin-bottom:60px;
         }
         .kyten-center{
            width: 33%;
         }
         .ndthu{
            height: 40px;
         }
         .henngaynop{
            height: 15px;
         }
    </style>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
   
    <body>
        {for $i=1 to 3}
            <page size="A5" class="page">
                <div class="row"  style="min-height: 500px;">
                    <div class="col-md-12">
                        <p class="title-lien">Liên: {$i}</p>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-6 title-left">
                            <p class="title-truong"><b>TRƯỜNG ĐẠI HỌC MỞ HÀ NỘI</b></p>
                            <p class="title-left-1">Nhà B101 Bách Khoa Hà Nội</p>
                            <p class="title-left-1">Tel:(024)3868 3007-Fax:(024)3623 0393 </p>
                        </div>
                        <div class="col-md-6 title-right">
                            <p class="title-right-1">Mẫu số C40-BB</p>
                            <p class="title-right-1"><i>(Ban hành theo QĐ số 107/2017/TT-BTC</i> ngày 10/10/2017 của Bộ Tài chính)</p>
                        </div>
                    </div>
                    <div class="col-md-12 thongtinhp">
                        <h2 class="phieuthu">GIẤY CAM ĐOAN</h2>
                        <p>(Lưu hành nội bộ)</p>
                        <p><i>Ngày {date('d')} tháng {date('m')} năm {date('Y')}</i></p>
                    </div>
                   <div class="col-md-12 thongtin_sv">
                    <div class="col-md-2">
                            <p>- Họ và tên:</p>
                            <p>- Địa chỉ:</p>
                            <p>- Ngành:</p>
                            <p class="ndthu">- Nội dung:</p>
                            <p>- Tổng tiền đã nộp:</p>
                            <p>- Viết bằng chữ: </p>
                            <p>- Hẹn ngày nộp: </p>
                        </div>
                        <div class="col-md-10">
                            <p><b>{$sinhvien_in.hoten} --({$sinhvien_in.masv})--({$sinhvien_in.ngaysinh}) --({$sinhvien_in.sdt})</b></p>
                            <p><b>{$sinhvien_in.diachi}</b></p>
                            <p><b>{$danhmuc['nganh'][$sinhvien_in.FK_sMaNganh]}</b></p>
                             <p class="ndthu"><b>{$hpsv} 
                            </b></p>
                            <p><b>{$tongtien['tongtien_so']} đồng</b></p>
                            <p><b>{$tongtien['tongtien_chu']}</b></p>
                            <p class="henngaynop">......../........../.......... Để nộp các khoản tiền còn thiếu.</p>
                        </div>
                    </div>
                    <div class="col-md-12 kyten">
                        <div class="col-md-6 kyten-left">
                            <p><b>Người lập phiếu</b></p>
                            <p><i>(Ký, họ tên)</i></p>
                            <p><b>{$danhmuc['canbo'][$session['macb']]}</b></p>
                        </div>
                        <div class="col-md-6 kyten-right">
                            <p><b>Thí sinh</b></p>
                            <p><i>(Ký, họ tên)</i></p>
                            <p><b>{$sinhvien_in.hoten}</b></p>
                        </div>
                    </div>
                </div>
            </page>
       {/for}
    </body>
        <script type="text/javascript">
            window.print();
        window.onafterprint = function(){
                location.href= window.location.origin+window.location.pathname+"?sbd="+{$sinhvien_in.soBD};
          }
    </script>
</html>
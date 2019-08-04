<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hệ thống hỗ trợ tuyển sinh Trường Đại Học Mở Hà Nội</title>
    <link rel="icon" href="{$url}public/images/DV01.png">
    <link rel="stylesheet" href="{$url}public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{$url}public/css/style.css">
    <link rel="stylesheet" type="text/css" href="{$url}public/css/animate.css">
    <script src="{$url}public/jquery/jquery.js"></script>
    <script src="{$url}public/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.min.css">
<!--         <link rel="stylesheet" type="text/css" href="{$url}public/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="{$url}public/css/component.css" /> -->
    <link rel="stylesheet" href="{$url}public/css/dataTables.bootstrap.min.css">
    <script src="{$url}public/jquery/jquery.dataTables.min.js"></script>
    <script src="{$url}public/jquery/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="{$url}public/select2/dist/js/select2.js"></script>
    <link rel="stylesheet" type="text/css" href="{$url}public/select2/dist/css/select2.css">
    <link href="{$url}public/plugin/style.css" rel="stylesheet">
    <link href="{$url}public/plugin/bootstrap-datepicker.min.css" rel="stylesheet">
    <script src="{$url}public/plugin/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{$url}public/Toastr/toastr.css">
    <script type="text/javascript" src="{$url}public/Toastr/tienganh.js"></script>
    <script type="text/javascript" src="{$url}public/Toastr/toastr.js"></script>
</head>
<body>
        {if $session['maquyen'] !=7}
            <div class="container-fluid menutop" >
                <div class="container fixdisplay" style="padding-top: 0;">
                    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                           <div class="disang do"></div>
                           <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <a class="navbar-brand" href="{base_url('Welcome')}" id="home"><i class="fa fa-home fa-1x" aria-hidden="true" style="font-size: 34px;margin-top: -9px;"></i></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav navbar-nav">
                        {if $session['maquyen'] == 6}
                         <li class="dropdown">
                                <a href="{$url}Thu-phieu-diem"><span class="glyphicon glyphicon-ok"></span>&nbsp;Thu phiếu điểm</a>
                         </li>
                          <li class="dropdown">
                                <a href="{$url}Danh-sach-thu-phieu-diem"><span class="glyphicon glyphicon-ok"></span>&nbsp;Danh sách đã thu phiếu điểm</a>
                         </li>
                        <!--  <li class="dropdown">
                                <a href="{$url}Hien-thi-man-hinh"><span class="glyphicon glyphicon-ok"></span>&nbsp;Hiển thị màn hình</a>
                         </li> -->
                        {/if}
                        {if $session['maquyen'] == 5}
                            <li class="dropdown">
                                <a href="{$url}Tra-giay-bao"><span class="glyphicon glyphicon-ok"></span>&nbsp;Trả giấy báo</a>
                            </li>
                            <li class="dropdown">
                                <a href="{$url}Da-tra-giay-bao"><span class="glyphicon glyphicon-ok"></span>&nbsp;Đã trả giấy báo</a>
                            </li>
                        {/if}
                        {if $session['maquyen'] == 4 }
                            
                            <li class="dropdown">
                               <a href="{$url}Thu-ho-so"><i class="fa fa-university" aria-hidden="true"></i>&nbsp;Thu hồ sơ</a>
                           </li>
                        {/if}
                        {if $session['maquyen'] == 3}
                            <li class="dropdown">
                                <a href="{$url}Thu-tai-chinh"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;Thu tài chính</a>
                            </li>
                             <li class="dropdown">
                                <a href="{$url}Bao-cao-thong-ke"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Báo cáo thống kê</a>
                            </li>
                        {/if}
                        {if $session['maquyen'] == 8}
                             <li class="dropdown">
                                <a href="{$url}Bao-cao-thong-ke"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Báo cáo thống kê</a>
                            </li>
                        {/if}
                         {if $session['maquyen'] == 9}
                            <li class="dropdown">
                                <a href="{$url}Ho-tro-nhap-hoc"><span class="glyphicon glyphicon-ok"></span>&nbsp;Đăng ký thông tin sinh viên</a>
                            </li>
                            <li class="dropdown">
                                <a href="{$url}Tra-giay-bao-can-bo"><span class="glyphicon glyphicon-ok"></span>&nbsp;Danh sách sinh viên</a>
                            </li>
                            <li class="dropdown">
                                <a href="{$url}Dang-ky-thong-tin-can-bo-nhap-hoc"><span class="glyphicon glyphicon-ok"></span>&nbsp;Cập nhật thông tin cán bộ</a>
                            </li>
                        {/if}
                        {if $session['maquyen'] == 1}
                             <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hệ thống <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown">
                                        <a href="{$url}Can-bo"><span class="glyphicon glyphicon-user"></span>&nbsp;Cán bộ</a>
                                    </li>
                                     <li class="dropdown">
                                        <a href="{$url}Ho-tro-nhap-hoc"><span class="glyphicon glyphicon-ok"></span>&nbsp;Đăng ký thông tin sinh viên</a>
                                    </li>
                                     <li class="dropdown">
                                        <a href="{$url}resetbuoctiep"><span class="glyphicon glyphicon-ok"></span>&nbsp;Reset bước tiếp</a>
                                    </li>

                                </ul>
                            </li>
                          
                             <li class="dropdown">
                               <a href="{$url}Thu-ho-so"><span class="glyphicon glyphicon-ok"></span>&nbsp;Thu hồ sơ</a>
                            </li>
                           <li class="dropdown">
                                <a href="{$url}Thu-tai-chinh"><i class="fa fa-usd" aria-hidden="true"></i>&nbsp;Thu tài chính</a>
                            </li>
                            <li class="dropdown">
                                <a href="{$url}Bao-cao-thong-ke"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Báo cáo thống kê</a>
                            </li>
                              <li class="dropdown">
                                <a href="{$url}Rut-ho-so"><i class="fa fa-exchange" aria-hidden="true"></i>&nbsp;Rút hồ sơ</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hiển thị màn hình <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown">
                                        <a href="http://hdgsnn2.gov.vn/tuyensinh/giaybao1" target="_blank">&nbsp;Hiển thị trả giấy báo (1,2)</a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="http://hdgsnn2.gov.vn/tuyensinh/giaybao2" target="_blank">&nbsp;Hiển thị trả giấy báo (3,4)</a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="http://hdgsnn2.gov.vn/tuyensinh/goitragiaybao" target="_blank">&nbsp;Gọi trả giấy báo</a>
                                    </li>
                                     <li class="dropdown">
                                        <a href="http://hdgsnn2.gov.vn/tuyensinh/thuhs" target="_blank">&nbsp;Hiển thị thu hồ sơ</a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="http://hdgsnn2.gov.vn/tuyensinh/goithuhs" target="_blank">&nbsp;Đọc thu hồ sơ</a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="http://hdgsnn2.gov.vn/tuyensinh/thutc" target="_blank">&nbsp;Hiển thị thu tài chính</a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="http://hdgsnn2.gov.vn/tuyensinh/goithutc" target="_blank">&nbsp;Đọc thu tài chính</a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="http://hdgsnn2.gov.vn/tuyensinh/" target="_blank">&nbsp;Hiển thị all</a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="http://hdgsnn2.gov.vn/tuyensinh/reset" target="_blank">&nbsp;Reset</a>
                                    </li>

                                    <li class="dropdown">
                                        <a href="{$url}Hien-thi-man-hinh" target="_blank">&nbsp;Hiển thị trả giấy báo (part 2)</a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="{$url}Hien-thi-man-hinh-thu-ho-so" target="_blank">&nbsp;Hiển thị thu hồ sơ (part 2)</a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="{$url}Hien-thi-man-hinh-thu-tai-chinh" target="_blank">&nbsp;Hiển thị thu tài chính (part 2)</a>
                                    </li>ư
                                </ul>
                            </li>
                           <!--  <li class="dropdown">
                                <a href="{$url}xep-lop-sinh-vien"><i class="fa fa-exchange" aria-hidden="true"></i>&nbsp;Xếp lớp sinh viên</a>
                            </li> -->
                        {/if}
                        {if $session['maquyen'] == 10}
                            <li class="dropdown">
                                <a href="{$url}tiepdon"><span class="glyphicon glyphicon-ok"></span>&nbsp;Tiếp đón và điều hướng</a>
                            </li>
                        {/if}
                        {if $session['maquyen'] == 11}
                             <li class="dropdown">
                                <a href="{$url}Rut-ho-so"><i class="fa fa-exchange" aria-hidden="true"></i>&nbsp;Rút hồ sơ</a>
                            </li>
                        {/if}
                        <li class="dropdown">
                                <a href="{$url}doimk"><span class="glyphicon glyphicon-ok"></span>&nbsp;Đổi mật khẩu</a>
                            </li>
                        </ul>
                    <ul class="nav navbar-nav navbar-right">
                      <li><a href="#"><span class="glyphicon glyphicon-user"></span> {$session['tencb']}</a></li>
                      <li style="margin-right: 50px;"><a href="{$url}login"><span class="glyphicon glyphicon-log-in"></span> Đăng xuất</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
            </div>
        </div>
    {/if}
     <!-- <div class="container-fluid" style="background: url('/Tuyensinh/public/images/1.jpg') no-repeat center center fixed; background-size: cover; min-height: 580px;"> -->
<style>
    .navbar-default .navbar-nav>li>a {
    color: white;
    transition: all 1s;
    font-size: 15px;
}
.toast.toast-warning {
    opacity: 1 !important;
}
</style>
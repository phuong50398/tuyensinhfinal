
     <div class="container fixdisplay">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <h5><b>Chào mừng {$session['tencb']} đến với hệ thống tuyển sinh - Trường Đại Học Mở Hà Nội</b></h5></div>
                <div class="panel-body" style="min-height: 400px;">
                 <div class="col-sm-12 text-center">
                    <!-- <h4>Xin chào: <label class="tien">{$session['tencb']}</label>
                    </h4> -->
                 </div>
                 <div class="col-md-12 text-center" style="padding-top: 100px">
                    {if $session['maquyen'] == 1}
                    <a href="{$url}Can-bo" title="">
                        <div class="col-md-3">
                            <img src="{$url}public/images/icon/girl.png" alt="" width="40%">
                            <h5>Cán bộ</h5>
                        </div>
                    </a>
                    <a href="{$url}Thu-ho-so" title="">
                        <div class="col-md-3">
                            <img src="{$url}public/images/icon/folder.png" alt="" width="40%">
                            <h5>Thu hồ sơ</h5>
                        </div>
                    </a>
                    <a href="{$url}Thu-tai-chinh" title="">
                        <div class="col-md-3">
                            <img src="{$url}public/images/icon/money-bag.png" alt="" width="40%">
                            <h5>Thu tài chính</h5>
                        </div>
                    </a>
                    <a href="{$url}Bao-cao-thong-ke" title="">
                        <div class="col-md-3">
                            <img src="{$url}public/images/icon/graph.png" alt="" width="40%">
                            <h5>Báo cáo thống kê</h5>
                        </div>
                    </a>
                    {/if}
                    {if $session['maquyen'] == 6}
                    <div class="col-md-2"></div>
                     <a href="{$url}Thu-phieu-diem" title="">
                        <div class="col-md-4">
                            <img src="{$url}public/images/icon/a.png" alt="" width="40%">
                            <h5>Thu phiếu điểm</h5>
                        </div>
                    </a>
                    <a href="{$url}Danh-sach-thu-phieu-diem" title="">
                        <div class="col-md-4">
                            <img src="{$url}public/images/icon/list.png" alt="" width="40%">
                            <h5>Danh sách phiếu điểm</h5>
                        </div>
                    </a>

                    {/if}
                    {if $session['maquyen'] == 5}
                        <div class="col-md-2"></div>
                         <a href="{$url}Tra-giay-bao" title="">
                            <div class="col-md-4">
                                <img src="{$url}public/images/icon/checklist.png" alt="" width="40%">
                                <h5>Trả giấy báo</h5>
                            </div>
                        </a>
                        <a href="{$url}Da-tra-giay-bao" title="">
                            <div class="col-md-4">
                                <img src="{$url}public/images/icon/list.png" alt="" width="40%">
                                <h5>Đã trả giấy báo</h5>
                            </div>
                        </a>
                    {/if}
                    {if $session['maquyen'] == 4 }
                    <div class="col-md-4"></div>
                       <a href="{$url}Thu-ho-so" title="">
                            <div class="col-md-4">
                                <img src="{$url}public/images/icon/folder.png" alt="" width="40%">
                                <h5>Thu hồ sơ</h5>
                            </div>
                        </a>
                    {/if}
                    {if $session['maquyen'] == 3}
                    <div class="col-md-3"></div>
                        <a href="{$url}Thu-tai-chinh" title="">
                        <div class="col-md-3">
                            <img src="{$url}public/images/icon/money-bag.png" alt="" width="40%">
                            <h5>Thu tài chính</h5>
                        </div>
                    </a>
                    <a href="{$url}Bao-cao-thong-ke" title="">
                        <div class="col-md-3">
                            <img src="{$url}public/images/icon/graph.png" alt="" width="40%">
                            <h5>Báo cáo thống kê</h5>
                        </div>
                    </a>
                    {/if}
                    {if $session['maquyen'] == 8}
                    <div class="col-md-4"></div>
                         <a href="{$url}Bao-cao-thong-ke" title="">
                            <div class="col-md-4">
                                <img src="{$url}public/images/icon/graph.png" alt="" width="40%">
                                <h5>Báo cáo thống kê</h5>
                            </div>
                        </a>
                    {/if}
                     {if $session['maquyen'] == 9}
                         <div class="col-md-2"></div>
                        <a href="{$url}Ho-tro-nhap-hoc" title="">
                            <div class="col-md-4">
                                <img src="{$url}public/images/icon/document.png" alt="" width="40%">
                                <h5>Đăng ký thông tin sinh viên</h5>
                            </div>
                        </a>
                        <a href="{$url}Dang-ky-thong-tin-can-bo-nhap-hoc" title="">
                            <div class="col-md-4">
                                <img src="{$url}public/images/icon/girl.png" alt="" width="40%">
                                <h5>Đăng ký thông tin cán bộ</h5>
                            </div>
                        </a>
                    {/if}
                 </div>
             </div>
                <div class="panel-footer">
                    <small> <!-- Remove this notice or replace it with whatever you want -->
                        <b>Phát triển và xây dựng bởi <span class="glyphicon glyphicon-heart" style="color: red;" aria-hidden="true"></span> Tổ phát triển Khoa CNTT - Trường Đại học Mở Hà Nội</b>
                        <br>
                        <!-- <em>Điện thoại hỗ trợ:</em><strong> 091.760.0946</strong> -->
                    </small>
                </div>
            </div>
    </div>
<style>
 .panel-default>.panel-heading {
    color: #fff;
    background-color: #707cd2;
    border-color: #707cd2;
    padding: 15px;
}
.panel-default h5 {
    /*box-shadow: 0px 0px 10px 0px #ccc;*/
    font-size: 25px;
}
</style>
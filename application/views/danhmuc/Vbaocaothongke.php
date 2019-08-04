<div class="container fixdisplay">
    <div class="panel panel-default">
        <div class="panel-heading text-left">
            <h5><b>Thống kê nhập học</b></h5></div>
            <div class="panel-body">
                {if $session['maquyen'] == 1 || $session['maquyen'] != 3}
                <div class="row">
                    <table class="table table-bordered">
                        <tbody>
                            <th class="text-center th_table">STT</th>
                            <th class="th_table">Ngành</th>
                            <th>
                                <a href="{$url}Excel/?id=trungtuyen"  title="Tải file">
                                    SL trúng tuyển
                                </a>
                            </th>
                            <th>
                                <a href="{$url}Excel/?id=datragiaybao"  title="Tải file">
                                    SL đã <!-- thu phiếu điểm & --> trả giấy báo
                                </a>
                            </th>
                            <!-- SL đã đăng ký là SL đã nộp Hồ sơ -->
                            <th>
                                <a href="{$url}Excel/?id=dadangky"  title="Tải file">
                                    SL đã thu hồ sơ
                                </a>
                            </th>
                            <th>
                                <a href="{$url}Excel/?id=dathuhocphi"  title="Tải file">
                                    SL đã thu học phí
                                </a>
                            </th>
                            <th>
                                <a href="{$url}Excel/?id=dathuruthoso"  title="Tải file">
                                    SL đã rút hồ sơ 
                                </a>
                            </th>
                            <th class="th_table">
                            Tổng tiền   
                            </th>
                            <th class="th_table" style="width: 10%">
                                Thao tác
                            </th>
                            {$stt = 1}
                            {$tongsoluongtrungtuyen = 0}
                            {$tongsoluongdatragiaybao = 0}
                            {$tongsoluongdathuhoso = 0}
                            {$tongsoluongdathuhocphi = 0}
                            {$tongsoluongruthoso = 0}
                            {$tongsoluongtien = 0}
                            {foreach $baocaothongke as $bc}
                                {$tongsoluongtrungtuyen = $bc.tongsoluongtrungtuyen + $tongsoluongtrungtuyen}
                                {$tongsoluongdatragiaybao = $bc.tongsoluongdatragiaybao + $tongsoluongdatragiaybao}
                                {$tongsoluongdathuhoso = $bc.tongsoluongdathuhoso + $tongsoluongdathuhoso}
                                {$tongsoluongdathuhocphi = $bc.tongsoluongdathuhocphi + $tongsoluongdathuhocphi}
                                {$tongsoluongruthoso = $bc.tongsoluongruthoso + $tongsoluongruthoso}
                                {$tongsoluongtien = $bc.tongsoluongtien + $tongsoluongtien}
                            {/foreach}
                            <tr>
                                <td></td>
                                <td>Tổng</td>
                                <td class="text-center"><b>{$tongsoluongtrungtuyen}</b></td>
                                <td class="text-center"><b>{$tongsoluongdatragiaybao}</b></td>
                                <td class="text-center"><b>{$tongsoluongdathuhoso}</b></td>
                                <td class="text-center"><b>{$tongsoluongdathuhocphi}</b></td>
                                <td class="text-center"><b>{$tongsoluongruthoso}</b></td>
                                <td class="text-center"><b>{number_format($tongsoluongtien,0, ',', ',')}</b></td>
                                <td class="text-center"><b></b></td>
                            </tr>
                            {foreach $baocaothongke as $bc}
                            <tr>
                                <td class="text-center">{$stt}</td>
                                <td><p href="" name="excel" type="submit" target="blank">{$bc.sTen_Nganh}</p></td>
                                <td class="text-center">{$bc.tongsoluongtrungtuyen}</td>
                                <td class="text-center">{$bc.tongsoluongdatragiaybao}</td>
                                <td class="text-center">{$bc.tongsoluongdathuhoso}</td>
                                <td class="text-center">{$bc.tongsoluongdathuhocphi}</td>
                                <td class="text-center">{$bc.tongsoluongruthoso}</td>
                                <td class="text-center">{if empty($bc.tongsoluongtien)}0{else}{number_format($bc.tongsoluongtien,0, ',', ',')}{/if}</td>
                                <td>
                                    <div class="text-center">
                                    <a href="{$url}Bao-cao-thong-ke?thongkesv={$bc.iMa_nganh}&trangthai=chuanhaphoc" class="btn btn-primary btn-sm "  data-toggle="tooltip" title="Danh sách sinh viên chưa hoàn thành công tác nhập học">
                                       &nbsp;<i class="fa fa-download" aria-hidden="true"></i>&nbsp;
                                    </a> 
                                    <a href="{$url}Bao-cao-thong-ke?thongkesv={$bc.iMa_nganh}&trangthai=danhaphoc" class="btn btn-success btn-sm " data-toggle="tooltip" title="Danh sách sinh viên đã nộp tài chính">
                                      &nbsp;<i class="fa fa-usd" aria-hidden="true"></i>&nbsp;
                                    </a>
                                    </div>
                                </td>
                                {$tongsoluongtrungtuyen = $tongsoluongtrungtuyen + $tongsoluongtrungtuyen}
                                {$tongsoluongdatragiaybao = $tongsoluongdatragiaybao + $tongsoluongdatragiaybao}
                                {$tongsoluongdathuhoso = $tongsoluongdathuhoso + $tongsoluongdathuhoso}
                                {$tongsoluongdathuhocphi = $tongsoluongdathuhocphi + $tongsoluongdathuhocphi}
                                {$tongsoluongtien = $tongsoluongtien + $tongsoluongtien}
                            </tr>
                            {$stt = $stt + 1}
                            {/foreach}
                        </tbody>
                    </table>
                </div>
                {/if}
                {if $session['maquyen'] == 1 || $session['maquyen'] == 3}
                <form action="{$url}Excel/?id=xuatbaocao_taichinh" method="post">
                    <div class="row" >
                        <hr>
                        <h3 class="text-center"><b>BÁO CÁO TÌNH HÌNH THU TÀI CHÍNH</b></h3>
                        <br>
                        <div class="col-md-6 col-lg-offset-3 table_thongke">
                            <div class="col-md-6 table_thongke-left">
                                <p class="title_thongke  text-center"><b>Ngành</b></p>
                                {foreach $nganh as $key => $ng}
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox_{$key}" class="checkbox1" value="{$ng.iMa_nganh}" type="checkbox" name="nganh[]">
                                    <label for="checkbox_{$key}">{$ng.sTen_Nganh}</label>
                                </div>
                               {/foreach}
                            </div>
                            <div class="col-md-6 ">
                                <p class="title_thongke text-center"><b>Các khoản thu</b></p>
                                {foreach $hocphi as $key => $hp}
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox11_{$key}" type="checkbox" name="hocphi[]" value="{$hp.mahp}">
                                    <label for="checkbox11_{$key}">{$hp.sTen_hocphi}</label>
                                </div>
                                 {/foreach}
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-offset-3 ">
                            <br> 
                            <label for="">Chọn thời gian</label><br>
                            <div class="radio radio-primary radio1">
                                <input type="radio" name="thoigian[]" id="radio6" value="tatcathoigian"  checked="">
                                <label for="radio6"><b> Toàn bộ thời gian</b> </label>
                            </div>
                            <div class="radio radio-primary radio1">
                                <input type="radio" name="thoigian[]" id="radio7"  value="cangay">
                                <label for="radio7"><b> Cả ngày</b> </label>
                            </div>
                            <div class="radio radio-primary radio1">
                                <input type="radio" name="thoigian[]" id="radio8" value="sang">
                                <label for="radio8"><b>Sáng</b> </label>
                            </div>
                            <div class="radio radio-primary radio1">
                                <input type="radio" name="thoigian[]" id="radio9" value="chieu">
                                <label for="radio9"><b> Chiều</b> </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-offset-3 ">
                            <div class="col-md-6">
                               <label for="">Ngày thu</label>
                               <input  type="text" class="form-control datepicker" id="ngaythu" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" name="ngaythu[]" autocomplete="off" >
                           </div>
                           <div class="col-md-6 luachon">
                             <div class="radio radio-primary">
                                <input type="radio" name="nguoithu[]" id="radio3" value="tatca">
                                <label for="radio3"> <b>Tất cả</b> </label>
                            </div>
                            <div class="radio radio-primary radio1">
                                <input type="radio" name="nguoithu[]" id="radio4" value="minhtoi"  checked="">
                                <label for="radio4" ><b> Mình tôi</b> </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" name="xuatbaocao_taichinh" value="xuatbaocao_taichinh" class="btn btn-primary xuatfile_thongke"><i class="fa fa-file-excel-o" style="font-size:18px"></i>&nbsp;Xuất file</button>
                        </div>
                    </div>
                </div>
                </form>
                {/if}
        </div>
        <div class="panel-footer">
            <small> <!-- Remove this notice or replace it with whatever you want -->
                <b>Phát triển và xây dựng bởi <span class="glyphicon glyphicon-heart" style="color: red;" aria-hidden="true"></span> Tổ phát triển Khoa CNTT -  Trường Đại học Mở Hà Nội </b>
                <br>
                <!-- <em>Điện thoại hỗ trợ:</em><strong> 091.760.0946</strong> -->
            </small>
        </div>
    </div>
    <style type="text/css">
        .th_table{
            line-height: 2 !important;
        }
        tbody th a{
            font-size: 10px !important;
        }
        input[type=checkbox] {
            margin: 0px 0 0;
            width: 26px;
            height: 14px;
            line-height: normal;
        } 
        tbody th a {
        font-size: 13px !important;
        }
        .fix-width{
            width: 110px;
            margin-top: 3px;
        }
    </style>
    <script>
        $(document).ready(function () {
            var ckbox = $('#radio6');
            $('input').on('change',function () {
                if (ckbox.is(':checked')) {
                    $('input[name="ngaythu[]"]').removeAttr("required",true);
                    $('input[name="ngaythu[]"]').val("");
                } else {
                    $('input[name="ngaythu[]"]').attr("required",true);
                    $('input[name="ngaythu[]"]').val("{date('d/m/Y')}");
                    // $("#ngaythu").removeAttr("required");
                }
            });
        });
    </script>
    
<div class="container-fluid fixdisplay" style="margin: 10px;">
    <div class="panel panel-default">
        <div class="panel-heading text-left">
            <h5><b>Hỗ trợ tài chính nhập học</b></h5></div>
            <div class="panel-body" style="padding: 18px;">
                <div class="col-md-12 text-center">
                    <p class="tthp">
                        <b>
                            {$sum = 0}
                            {foreach $danhmuc['hocphi'] as $key => $val}
                            <span> {$dstenhocphi['dsten_hp1'][$val.mahp]}: </span><span class="tien">{number_format($val.giatri)}.</span>
                            {/foreach}
                        </b>
                    </p>
                </div>
                <form method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tt">
                                <div class="col-md-3">
                                    <label for="">Họ tên SV</label>
                                    <span><input type="text" name="hoten" class="form-control" value="{if isset($timkiem['hoten'])}{$timkiem['hoten']}{/if}"></span>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Mã SV</label>
                                    <span><input type="text" name="masv" class="form-control" value="{if isset($timkiem['masv'])}{$timkiem['masv']}{/if}"></span>
                                </div>
                                <div class="col-md-6 hienthi-tc">
                                    <label for="">Hiển thị</label>
                                    <label class="radio-inline">
                                        <div class="radio radio-primary">
                                            <input type="radio" name="hienthi" id="tatca" checked="" value="all" {if isset($timkiem['hienthi']) && $timkiem['hienthi'] == "all"}checked=""{/if}>
                                            <label for="tatca"> <b>Tất cả</b> </label>
                                        </div>
                                    </label>
                                    <label class="radio-inline">
                                        <div class="radio radio-primary">
                                            <input type="radio" name="hienthi" id="hddain" value="4" {if isset($timkiem['hienthi']) && $timkiem['hienthi'] == 4}checked=""{/if}>
                                            <label for="hddain"> <b>HĐ đã in</b> </label>
                                        </div>
                                    </label>
                                     <label class="radio-inline">
                                        <div class="radio radio-primary">
                                            <input type="radio" name="hienthi" id="hdchuain" value="3" {if isset($timkiem['hienthi']) && $timkiem['hienthi'] == 3}checked=""{/if}>
                                            <label for="hdchuain"> <b>HĐ chưa in</b> </label>
                                        </div>
                                    </label>
                                    <label class="radio-inline">
                                        <div class="radio radio-primary">
                                            <input type="radio" name="hienthi" id="toidain" value="{$session['macb']}" {if isset($timkiem['hienthi']) && $timkiem['hienthi'] == $session['macb']}checked=""{/if}>
                                            <label for="toidain"> <b>Tôi đã in</b> </label>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-md-1 text-right">
                                    <input type="hidden" name="timkiem" value="1">
                                    <button type="submit" class="btn btn-primary timkiem-httc"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Tìm kiếm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                    <div class="row">
                        <div class="col-md-3 col-lg-offset-9">
                            <label for="">Người thu tiền</label>
                            <span><input type="text" name="nguoithuhp_nh" class="form-control" value="{if isset($session['nguoithutien'])}{$session['nguoithutien']}{/if}"></span>
                        </div>
                    </div>
                    <div class="row ttsv_tc-nh">
                        <form action="" method="get" accept-charset="utf-8">
                            <button type="submit" class="btn btn-danger" name="goisv" value="goisv" style="float: right; margin-bottom: 20px;">Gọi sinh viên tiếp</button>
                            <select name="soban" class="form-control" style="width: 14%;float: right;">
                                <option value="">--Chọn bàn--</option>
                                <option value="01" {($soban=='01') ? "selected" : ""}>01</option>
                                <option value="02" {($soban=='02') ? "selected" : ""}>02</option>
                                <option value="03" {($soban=='03') ? "selected" : ""}>03</option>
                                <option value="04" {($soban=='04') ? "selected" : ""}>04</option>
                                <option value="05" {($soban=='05') ? "selected" : ""}>05</option>
                                <option value="06" {($soban=='06') ? "selected" : ""}>06</option>
                            </select>
                        </form>
                        <table class="table table-striped table-bordered"  id="{if !empty($timkiem) &&  $timkiem['hienthi'] != "all" && $timkiem['hienthi'] != "4"}table_id{/if}">
                            <thead>
                                <th class="text-center">STT</th>
                                <th>Mã SV</th>
                                <th>Họ và tên</th>
                                <th>Ngày sinh</th>
                                <th>Ngành học</th>
                                {foreach $danhmuc['hocphi'] as $key => $val}
                                <th>{$val.mahp}</th>
                                {/foreach}
                                <th>Người lập hoá đơn</th>
                                <th class="text-center" style="width: 10%;">Hóa đơn</th>
                            </thead>
                            <tbody>
                                {if !empty($timkiem)}
                                {$data = $timkiem['ttsv']}
                                {else}
                                {$data = $sinhvien}
                                {/if}
                                {foreach $data as $key => $val}
                                <tr>
                                    <td class="text-center lg" ><b>{$stt++}</b></td>
                                    <td class="lg"><a data-toggle="modal" data-target="#myModal-{$val.masv}" class="xemchitiet_hs">{$val.masv}</a></td>
                                    <td class="lg">
                                    <a href="{base_url('Ho-tro-nhap-hoc')}?sobd={$val.soBD}" target="blank" class="tt_sinhvien" style="cursor: pointer;" 
                                    > {$val.hoten}</a>
                                    </td>
                                    <td class="lg">{$val.ngaysinh}</td>
                                    <td class="lg"><b>{$danhmuc['nganh'][$val.FK_sMaNganh]}</b></td>
                                    {foreach $danhmuc['hocphi'] as $k => $v}
                                    <td class="lg">
                                        {if $val.FK_sMaNganh == 15 || $val.FK_sMaNganh == 63 || $val.FK_sMaNganh == 62 || $val.FK_sMaNganh == 61}
                                            {if $v.mahp != "tt1" && $v.mahp != "hp1"}
                                                {if isset($ds_hpdadong[$val.masv])}
                                                    {number_format($ds_hpdadong[$val.masv][$v.mahp])}
                                                {else}
                                                    0
                                                {/if}
                                            {else}
                                            <div class="disabled">
                                            </div>
                                            {/if}
                                        {else}
                                            {if $v.mahp != "tt2" && $v.mahp != "hp2"}
                                                {if isset($ds_hpdadong[$val.masv])}
                                                    {number_format($ds_hpdadong[$val.masv][$v.mahp])}
                                                {else}
                                                    0
                                                {/if}
                                            {else}
                                            <div class="disabled">
                                            </div>
                                            {/if}
                                        {/if}
                                    </td>
                                    {/foreach}
                                    <td class="lg">{if !empty($val.nguoithu_hocphi)}{$danhmuc['canbo'][$val.nguoithu_hocphi]}{/if}</td>
                                    <td class="text-center">
                                        {if $val.FK_sMaNganh == 15 || $val.FK_sMaNganh == 63 || $val.FK_sMaNganh == 62 || $val.FK_sMaNganh == 61}
                                            <button type="button" class="btn btn-primary fix-width btn-sm" name="thuhocphi" value="{$val.masv}" data-sbd="{$val.soBD}" data-toggle="modal"  data-target="#myModal-inhoso-{$val.masv}" data-tienphaithu="{$tongtiencanthu5['total']}" data-info="{$val.masv}">Thu học phí</button>
                                            <span>
                                                <a href="{base_url()}Thu-tai-chinh?giaycamdoan={$val.masv}"  class="btn btn-sm btn-success fix-width" >Giấy cam đoan</a>
                                            </span>
                                        {else}
                                            <button type="button" class="btn btn-primary fix-width btn-sm" name="thuhocphi" data-sbd="{$val.soBD}" value="{$val.masv}" data-toggle="modal" data-target="#myModal-inhoso-{$val.masv}" data-tienphaithu="{$tongtiencanthu4['total']}" data-info="{$val.masv}">Thu học phí</button>
                                            <span>
                                               <a href="{base_url()}Thu-tai-chinh?giaycamdoan={$val.masv}"  class="btn btn-sm btn-success fix-width">Giấy cam đoan</a>
                                            </span>
                                        {/if}
                                       
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div id="myModal-inhoso-{$val.masv}" class="modal fade" role="dialog">
                                    <input type="hidden" value="{$val.tongtien_dathu}" name="tongtiendathu_{$val.masv}">
                                     <div class="modal-dialog" style="width: 1000px !important;">
                                          <div class="modal-content">
                                            <form method="post" onsubmit="return check_tien()">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h3 class="modal-title" id="myModalLabel">Các khoản học phí của sinh viên <span class="tien" style="font-size: 23px;"><b>{$val.hoten}</b></span></h3>
                                                    </div>

                                                   <!--  <div class="row" style="margin: 0; margin-top: 10px;">
                                                        <div class="col-md-12">
                                                            <div class="col-md-2">
                                                                <p class="ttsv"><span style=""><b>Mã sinh viên</b></span> </p>
                                                                <h4 class="ttsv"> {$val.masv}</h4>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <p class="ttsv"><span style=""><b>Họ và tên</b></span> </p>
                                                                <h4 class="ttsv"> {$val.hoten}</h4>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <p class="ttsv"><span style=""><b>Ngày sinh</b></span> </p>
                                                                <h4 class="ttsv">{date('m/d/Y', strtotime({$val.ngaysinh}))}</h4>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <p class="ttsv"><span style=""><b>Ngành</b></span> </p>
                                                                <h4 class="ttsv"> {$danhmuc['nganh'][$val.FK_sMaNganh]}</h4>
                                                            </div>
                                                             <div class="col-md-12 ">
                                                                <p class="ttsv"  style="text-align: left;"><span ><b>Mã HS</b></span> </p>
                                                                <h4 class="ttsv tien" style="text-align: left;">{$val.sohs_nh}</h4>
                                                            </div>
                                                        </div>
                                                    </div> -->

                                                     <!-- <hr style="margin-bottom: 0px;"> -->

                                                    <div class="row example" style="margin-top:10px;margin-left: 0; margin-right: 0">
                                                        <div class="col-md-3">
                                                            <h4 class="text-left" style="margin-left: 20px;"><span class="gachchan">Thu học phí</span></h4>
                                                            {foreach $danhmuc['hocphi'] as $k => $v}
                                                            {if $val.FK_sMaNganh == 15 || $val.FK_sMaNganh == 63 || $val.FK_sMaNganh == 62 || $val.FK_sMaNganh == 61}
                                                                {if $v.mahp != "tt1" && $v.mahp != "hp1"}
                                                                <div class="form-group">
                                                                    <label class="col-md-12 control-label"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;{$dstenhocphi['dsten_hp2'][$v.mahp]} (<span class="tien {$v.mahp}_{$val.masv}">{$v.giatri}</span>)</label>
                                                                </div>
                                                                {/if}
                                                                {else}
                                                                {if $v.mahp != "tt2" && $v.mahp != "hp2"}
                                                                <div class="form-group">
                                                                    <label class="col-md-12 control-label"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;{$dstenhocphi['dsten_hp2'][$v.mahp]} (<span class="tien {$v.mahp}_{$val.masv}">{$v.giatri}</span>)</label>
                                                                </div>
                                                                {/if}
                                                            {/if}
                                                            {/foreach}
                                                        </div>

                                                        {foreach $val.chitietthu as $kct => $vct}
                                                            <div class="col-md-2">
                                                                <h4 class="text-left"><span class="gachchan">Lần {$kct+1}</span></h4>
                                                                <div class="input-many">
                                                                   {if $val.FK_sMaNganh == 15 || $val.FK_sMaNganh == 63 || $val.FK_sMaNganh == 62 || $val.FK_sMaNganh == 61}
                                                                       <div class="form-group">
                                                                          <input type="text" class="form-control hp2_{$val.masv}"  value="{number_format($vct['tamthu_hp2'])}" disabled>
                                                                       </div>
                                                                       <div class="form-group">
                                                                          <input type="text" class="form-control sk_{$val.masv}"  value="{number_format($vct['tamthu_sk'])}" disabled>
                                                                       </div>
                                                                       <div class="form-group">
                                                                          <input type="text" class="form-control the_{$val.masv}" value="{number_format($vct['tamthu_the'])}" disabled>
                                                                       </div>
                                                                       <div class="form-group">
                                                                          <input type="text" class="form-control yt_{$val.masv}" value="{number_format($vct['tamthu_yt'])}" disabled>
                                                                       </div>
                                                                       <div class="form-group">
                                                                          <input type="text" class="form-control tt2_{$val.masv}"  value="{number_format($vct['tamthu_tt2'])}" disabled>
                                                                       </div>
                                                                    {else}
                                                                        <div class="form-group">
                                                                          <input type="text" class="form-control hp1_{$val.masv}" value="{number_format($vct['tamthu_hp1'])}" disabled>
                                                                       </div>
                                                                       <div class="form-group">
                                                                          <input type="text" class="form-control sk_{$val.masv}"  value="{number_format($vct['tamthu_sk'])}" disabled>
                                                                       </div>
                                                                       <div class="form-group">
                                                                          <input type="text" class="form-control the_{$val.masv}"  value="{number_format($vct['tamthu_the'])}" disabled>
                                                                       </div>
                                                                       <div class="form-group">
                                                                          <input type="text" class="form-control yt_{$val.masv}"  value="{number_format($vct['tamthu_yt'])}" disabled>
                                                                       </div>
                                                                       <div class="form-group">
                                                                          <input type="text" class="form-control tt1_{$val.masv}"  value="{number_format($vct['tamthu_tt1'])}" disabled>
                                                                       </div>
                                                                    {/if}
                                                                </div>
                                                                 <div class="input-many">
                                                                    <label class="col-md-3 control-label" style="font-size: 12px;padding-left: 0;">Tổng</label>
                                                                    <div class="col-md-9" style="padding: 0;">
                                                                        <input type="text" class="form-control tongtiendanop" placeholder="Tổng tiền" disabled="" value="{number_format($vct['tamthu_hp1'] + $vct['tamthu_hp2']+$vct['tamthu_sk']+$vct['tamthu_the']+$vct['tamthu_yt']+$vct['tamthu_tt1']+$vct['tamthu_tt2'])}">
                                                                    </div>
                                                                      <p>&nbsp;</p>
                                                                </div>
                                                                <div class="input-many">
                                                                    <!-- <label class="col-md-4 control-label text-left" style="font-size: 12px;padding-left: 0;">Số GD</label> -->
                                                                    <div class="col-md-12" style="padding: 0;">
                                                                        <input type="text" class="form-control"name="sogiaodich" placeholder="Số giao dịch" disabled="" value="{$vct['pos']}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        {/foreach}
                                                        {if $val.trangthai == 'thieu'}
                                                         <div class="col-md-2">
                                                            <h4 class="text-left"><span class="gachchan">Lần {count($val.chitietthu)+1}</span></h4>
                                                            <div class="input-many">
                                                                {if $val.FK_sMaNganh == 15 || $val.FK_sMaNganh == 63 || $val.FK_sMaNganh == 62 || $val.FK_sMaNganh == 61}
                                                               <div class="form-group">
                                                                  <input type="text" class="form-control hp2_{$val.masv} giatri input{$val.masv} {$kct+1}" name="data[hp2]">
                                                               </div>
                                                               {else}
                                                              <div class="form-group">
                                                                  <input type="text" class="form-control hp1_{$val.masv} giatri input{$val.masv} {$kct+1}" name="data[hp1]">
                                                               </div>
                                                               {/if}
                                                                
                                                               <div class="form-group">
                                                                  <input type="text" class="form-control sk_{$val.masv} giatri input{$val.masv} {$kct+1}" name="data[sk]">
                                                               </div>
                                                               <div class="form-group">
                                                                  <input type="text" class="form-control the_{$val.masv} giatri input{$val.masv} {$kct+1}" name="data[the]">
                                                               </div>
                                                               <div class="form-group">
                                                                  <input type="text" class="form-control yt_{$val.masv} giatri input{$val.masv} {$kct+1}" name="data[yt]" >
                                                               </div>
                                                               <input type="hidden" value="{count($val.chitietthu)+1}" name="data[lanthu]">
                                                               {if $val.FK_sMaNganh == 15 || $val.FK_sMaNganh == 63 || $val.FK_sMaNganh == 62 || $val.FK_sMaNganh == 61}
                                                               <div class="form-group">
                                                                  <input type="text" class="form-control tt2_{$val.masv} giatri input{$val.masv} {$kct+1}" name="data[tt2]">
                                                               </div>
                                                               {else}
                                                               <div class="form-group">
                                                                  <input type="text" class="form-control tt1_{$val.masv} giatri input{$val.masv} {$kct+1}" name="data[tt1]">
                                                               </div>
                                                               {/if}
                                                            </div>
                                                             <div class="input-many">
                                                                <label class="col-md-3 control-label" style="font-size: 12px;padding-left: 0;">Tổng</label>
                                                                <div class="col-md-9" style="padding: 0;">
                                                                    <input type="text" class="form-control tongtien{$val.masv}" placeholder="Tổng tiền" readonly="" name="tongtien">
                                                                </div>
                                                                 <p>&nbsp;</p>
                                                            </div>
                                                            <div class="input-many">
                                                                <!-- <label class="col-md-4 control-label text-left" style="font-size: 12px;padding-left: 0;">Số GD</label> -->
                                                                <div class="col-md-12" style="padding: 0;">
                                                                    <input type="text" class="form-control" placeholder="Số giao dịch" name="pos">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {/if}
                                                    </div>
                                                    <div class="modal-footer-ttbang text-right x-them">
                                                        <div class="themtv  text-right">
                                                           <button type="button" class="btn btn-default" data-dismiss="modal" style=" margin-bottom:10px;">Đóng</button>
                                                           {if $val.trangthai == 'thieu'}
                                                           <button style="margin-right:10px; margin-bottom:10px;" type="submit" class="btn btn-success btn-flat" title="In hóa đơn" name="in_hoadon" value="{$val.masv}"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;In hóa dơn</button>
                                                           {/if}
                                                       </div>
                                                   </div>

                                            </form>
                                          </div>
                                     </div>
                                </div>
                                <!-- Modal -->
                                <div id="myModal-{$val.masv}" class="modal fade" role="dialog">
                                  <div class="modal-dialog" style="width: 1000px !important;">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <form method="post">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h3 class="modal-title" id="myModalLabel">Chi tiết học phí của sinh viên <span class="tien" style="font-size: 23px;"><b>{$val.hoten}</b></span></h3>
                                        </div>
                                        <div class="row" style="margin: 0; margin-top: 10px;">
                                           <!--  <div class="col-md-12">
                                                <div class="col-md-2">
                                                    <p class="ttsv"><span style=""><b>Mã sinh viên</b></span> </p>
                                                    <h4 class="ttsv"> {$val.masv}</h4>
                                                </div>
                                                <div class="col-md-3">
                                                    <p class="ttsv"><span style=""><b>Họ và tên</b></span> </p>
                                                    <h4 class="ttsv"> {$val.hoten}</h4>
                                                </div>
                                                <div class="col-md-2">
                                                    <p class="ttsv"><span style=""><b>Ngày sinh</b></span> </p>
                                                    <h4 class="ttsv">{date('m/d/Y', strtotime({$val.ngaysinh}))}</h4>
                                                </div>
                                                <div class="col-md-5">
                                                    <p class="ttsv"><span style=""><b>Ngành</b></span> </p>
                                                    <h4 class="ttsv"> {$danhmuc['nganh'][$val.FK_sMaNganh]}</h4>
                                                </div>
                                                <div class="col-md-12 text-right">
                                                    <p class="ttsv" style="text-align: left; font-size: 18px;"><span style=""><b>Mã HS</b></span> </p>
                                                    <h4 class="ttsv tien" style="text-align: left;"><span style="border-bottom: 1px solid green;">{$val.sohs_nh}</span></h4>
                                                </div>
                                            </div> -->
                                            {if !empty($val.chitietthu)}
                                            <div class="row example" style="margin-top:10px;margin-left: 0; margin-right: 0">
                                                        <div class="col-md-3">
                                                            <h4 class="text-left" style="margin-left: 20px;"><span class="gachchan">Thu học phí</span></h4>
                                                            {foreach $danhmuc['hocphi'] as $k => $v}
                                                            {if $val.FK_sMaNganh == 15 || $val.FK_sMaNganh == 63 || $val.FK_sMaNganh == 62 || $val.FK_sMaNganh == 61}
                                                                {if $v.mahp != "tt1" && $v.mahp != "hp1"}
                                                                <div class="form-group">
                                                                    <label class="col-md-12 control-label"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;{$dstenhocphi['dsten_hp2'][$v.mahp]} ( <span class="tien ">{$v.giatri}</span>)</label> 
                                                                </div>
                                                                {/if}
                                                                {else}
                                                                {if $v.mahp != "tt2" && $v.mahp != "hp2"}
                                                                <div class="form-group">
                                                                    <label class="col-md-12 control-label"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp;{$dstenhocphi['dsten_hp2'][$v.mahp]} (<span class="tien }">{$v.giatri}</span>)</label>
                                                                </div>
                                                                {/if}
                                                            {/if}
                                                            {/foreach}
                                                        </div>
                                                        {foreach $val.chitietthu as $kct => $vct}
                                                            <div class="col-md-2">
                                                                <h4 class="text-left"><span class="gachchan">Lần {$kct+1}</span>
                                                                    <span>
                                                                        <a href="{base_url()}Thu-tai-chinh?chitiethpsv={$val.masv}&id={$vct.id}"  class="btn btn-sm btn-primary"><i class="fa fa-print" aria-hidden="true"></i></a>
                                                                    </span>
                                                                    {if $session['maquyen'] == 1}
                                                                    <span>
                                                                        <button type="submit" class="btn btn-danger btm-xs" name="huyhp" onclick="return confirm('Bạn có chắc chắn muôn hủy học phí này không?')" value="{$val.masv}_{$vct.id}" style="padding: 4px 9px;"><i class="fa fa-window-close" aria-hidden="true"></i></button>
                                                                    </span>
                                                                    {/if}
                                                                </h4>
                                                                <div class="input-many">
                                                                   {if $val.FK_sMaNganh == 15 || $val.FK_sMaNganh == 63 || $val.FK_sMaNganh == 62 || $val.FK_sMaNganh == 61}
                                                                       <div class="form-group">
                                                                          <input type="text" class="form-control " value="{number_format($vct['tamthu_hp2'])}" disabled>
                                                                       </div>
                                                                       <div class="form-group">
                                                                          <input type="text" class="form-control "  value="{number_format($vct['tamthu_sk'])}" disabled>
                                                                       </div>
                                                                       <div class="form-group">
                                                                          <input type="text" class="form-control" value="{number_format($vct['tamthu_the'])}" disabled>
                                                                       </div>
                                                                       <div class="form-group">
                                                                          <input type="text" class="form-control"  value="{number_format($vct['tamthu_yt'])}" disabled>
                                                                       </div>
                                                                       <div class="form-group">
                                                                          <input type="text" class="form-control " value="{number_format($vct['tamthu_tt2'])}" disabled>
                                                                       </div>
                                                                    {else}
                                                                        <div class="form-group">
                                                                          <input type="text" class="form-control " value="{number_format($vct['tamthu_hp1'])}" disabled>
                                                                       </div>
                                                                       <div class="form-group">
                                                                          <input type="text" class="form-control "  value="{number_format($vct['tamthu_sk'])}" disabled>
                                                                       </div>
                                                                       <div class="form-group">
                                                                          <input type="text" class="form-control " value="{number_format($vct['tamthu_the'])}" disabled>
                                                                       </div>
                                                                       <div class="form-group">
                                                                          <input type="text" class="form-control " value="{number_format($vct['tamthu_yt'])}" disabled>
                                                                       </div>
                                                                       <div class="form-group">
                                                                          <input type="text" class="form-control }" value="{number_format($vct['tamthu_tt1'])}" disabled>
                                                                       </div>
                                                                    {/if}
                                                                </div>
                                                                 <div class="input-many">
                                                                    <label class="col-md-3 control-label" style="font-size: 12px;padding-left: 0;">Tổng</label>
                                                                    <div class="col-md-9" style="padding: 0;">
                                                                        <input type="text" class="form-control" placeholder="Tổng tiền" disabled="" value="{number_format($vct['tamthu_hp1']+$vct['tamthu_hp2']+$vct['tamthu_sk']+$vct['tamthu_the']+$vct['tamthu_yt']+$vct['tamthu_tt1']+$vct['tamthu_tt2'])}">
                                                                    </div>
                                                                      <p>&nbsp;</p>
                                                                </div>
                                                                 <div class="input-many">
                                                                    <!-- <label class="col-md-4 control-label text-left" style="font-size: 12px;padding-left: 0;">Số GD</label> -->
                                                                    <div class="col-md-12" style="padding: 0;">
                                                                        <input type="text" class="form-control"name="sogiaodich" placeholder="Số giao dịch" disabled="" value="{$vct['pos']}">
                                                                        <br>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        {/foreach}
                                                        <div class="row example" style="margin-top:10px;margin-left: 0; margin-right: 0">
                                                            <div class=" col-md-12 gachchan" style="margin-bottom: 20px;"></div>
                                                            <div class="col-md-12" style="margin-bottom: 20px;">
                                                                  <h3 class="modal-title" id="myModalLabel"><span class="tien" style="font-size: 23px;"><b>Chi tiết người thu học phí:</b>  </span>
                                                                  </h3>
                                                            </div>
                                                            {foreach $val.chitietthu as $kct => $vct}
                                                                 <div class="col-md-3" style="border: 1px solid #ccc; margin-left: 10px; padding: 10px;">
                                                                    <p>
                                                                        <span class="tien"><b>Thu học phí Lần {$kct+1}</b></span>
                                                                    </p>
                                                                   
                                                                    <p>Người thu học phí: </p>
                                                                    <p>
                                                                       <b> <span class="tien">{$danhmuc['canbo'][$vct.nguoithu_hocphi]}</span>
                                                                       </b>
                                                                    </p>
                                                                    <p>Thời gian thu: </p>
                                                                    <p>
                                                                        <b>
                                                                            <span class="tien">{date('d/m/Y H:i:s',strtotime({$vct.thoigian_thuhp}))}</span>
                                                                        </b>
                                                                    </p>
                                                                 </div>
                                                            {/foreach}
                                                        </div>
                                            </div>
                                            {else}
                                            <!-- <h3 class="alert alert-danger">Chưa có học phí của sinh viên</h3>   -->
                                            {/if}
                                        </div>

                                        <hr style="margin-bottom: 0px;">

                                       </form>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>

                                  </div>
                                </div>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                       {if empty($timkiem) || $timkiem['hienthi'] == "all" ||  $timkiem['hienthi'] == "4"}
                    <div class="row">
                        <div class="bs-example text-center">
                            <ul class="pagination">
                                {if ($total_page > 1)}
                                {if ($page > 1)}
                                <li><a href="{base_url('Thu-tai-chinh')}?page={($page-1)}"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a></li>
                                {/if}
                                {for $i=1 to $total_page}
                                {if ($i == $page)}
                                <li class="active"><span class="page active">{$i}</span></li>
                                {else}
                                <li><a class="page gradient" href="{base_url('Thu-tai-chinh')}?page={$i}">{$i}</a></li>
                                {/if}
                                {/for}
                                {if ($page < $total_page)}
                                <li><a class="page gradient" href="{base_url('Thu-tai-chinh')}?page={($page+1)}"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
                                {/if}
                                {/if}
                            </ul>   
                        </div>
                    </div>
                    {/if}
            </div>
            <div class="panel-footer">
                <small> 
                    <b>Phát triển và xây dựng bởi <span class="glyphicon glyphicon-heart" style="color: red;" aria-hidden="true"></span> Tổ phát triển Khoa CNTT - Trường Đại học Mở Hà Nội</b>
                    <br>
                </small>
            </div>
        </div>
<link rel="stylesheet" type="text/css" href="{base_url()}public/css/danhmuc.css">
<script type="text/javascript" src="{base_url()}public/js/simple.money.format.js"></script>
<script type="text/javascript" src="{base_url()}public/js/thutaichinh.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.dev.js"></script>
<style type="text/css">
    .fix-width{
        width: 110px !important;
        margin-top: 5px;
    }
    .lg{
        /*line-height: 75px !important;*/   
    }
</style>
<script type="text/javascript">
    $('button[name="thuhocphi"]').on('click', function(){
        var socket = io("https://hdgsnn2.gov.vn/", {
          transports: ["websocket"]
         });
         var data = [$(this).attr('data-sbd')];
         console.log(data);
         socket.emit("Client-sent-data-delete",data);
    });
</script>
{if !empty($goi)}
<script>
    var socket = io("https://hdgsnn2.gov.vn/", {
          transports: ["websocket"]
     });
     var data = [{$goi[0].stt}, {$goi[0].soBD}, '{$goi[0].hoten}', 'Nộp Tài Chính', '{$soban}', '{$soban}'];
     console.log(data);
     socket.emit("Client-sent-data", data);
    
</script>
{/if}
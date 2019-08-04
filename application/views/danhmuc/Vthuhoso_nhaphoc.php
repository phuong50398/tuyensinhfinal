<div class="container-fluid fixdisplay" style="padding: 30px;">
	<div class="panel panel-default">
		<div class="panel-heading text-left">
			<h5><b>Thu hồ sơ nhập học dành cho sinh viên</b></h5>
		</div>
		<div class="panel-body">
			<form method="post" accept-charset="utf-8">
				<div class="col-md-12 text-center">
					<p class="tthp">
						<b>
							{foreach $danhmuc['hoso'] as $value}
							<span> {$ds_titleHS[$value.mahs]} </span><span class="tien">{$value.mahs}.</span>
							{/foreach}
						</b>
					</p>
				</div>
				  <div class="row">
                    <div class="col-md-12">
                        <div class="tt">
                            <div class="col-md-4">
                                <label for="">Họ tên SV</label>
                                <span><input type="text" name="hoten" class="form-control" value="{if !empty($tk_sinhvien['hoten'])}{$tk_sinhvien['hoten']}{/if}" placeholder="Họ và tên..."></span>
                            </div>
                            <div class="col-md-4">
                                <label for="">Số báo danh</label>
                                <span><input type="text" name="sobd" class="form-control" value="{if !empty($tk_sinhvien['sobd'])}{$tk_sinhvien['sobd']}{/if}" placeholder="Số báo danh..."></span>
                            </div>
                            <div class="col-md-4">
                                <label for="">Người thu hồ sơ</label>
                                <select name="nguoithu" class="form-control" >
                                    <option value="" selected>--------------Tất cả--------------</option>
                                    {foreach $danhmuc['tbl_canbo'] as $value}
                                    {if $value['maquyen'] == 4 || $value['maquyen'] == 1}
                                    <option value="{$value.macb}" {if !empty($tk_sinhvien['nguoithu']) && $tk_sinhvien['nguoithu'] == $value.macb} selected{/if}>{$value.tencb}</option>
                                    {/if}
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <div class="tt">
                            <div class="col-md-7 hienthi-tc">
                                <label for="">Hiển thị</label>
                                <label class="radio-inline">
                                    <div class="radio radio-primary">
                                        <input type="radio" {if !isset($tk_sinhvien[hienthi])} checked{/if} name="hienthi" id="tatca" value="all" {if isset($tk_sinhvien[hienthi]) && $tk_sinhvien[hienthi] == 'all'} checked{/if} >
                                        <label for="tatca"> <b>Tất cả</b> </label>
                                    </div>
                                </label>
                                <label class="radio-inline">
                                    <div class="radio radio-primary">
                                        <input type="radio" {if  isset($tk_sinhvien['hienthi'])&&  $tk_sinhvien['hienthi'] == '2'}checked{/if} name="hienthi"  id="hddain" value="2" >
                                        <label for="hddain"> <b>Chưa có HS</b> </label>
                                    </div>
                                </label>
                                <label class="radio-inline">
                                    <div class="radio radio-primary">
                                        <input type="radio" {if isset($tk_sinhvien['hienthi']) && $tk_sinhvien['hienthi'] == '3'} checked{/if} name="hienthi" id="toidain" value="3">
                                        <label for="toidain" > <b>Đã có HS hoặc đã có Giấy cam đoan</b> </label>
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-5 text-left" style="margin-top: -6px;">
                                <input type="hidden" value="1" name="timkiem-httc">
                                <button type="submit" class="btn btn-primary timkiem-httc" ><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Tìm kiếm</button>
                            </div>

                        </div>
                    </div>
                </div>
			</form>
			<hr>
			<form method="get">
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
				
			<form method="post" accept-charset="utf-8" onsubmit="return checkvalidate()">
				<div class="row ttsv_tc-nh">
					
					<table class="table table-striped table-bordered" id="{if !empty($tk_sinhvien) &&  $tk_sinhvien['nguoithu'] != "" }table_id{/if}">
						<thead>
							<th class="text-center" style="width: 5%">STT</th>
							<th>SBD</th>
							<th style="width: 12%">Họ và tên</th>
							<th>Ngày sinh</th>
							<!-- <th>Giới tính</th> -->
							{foreach $danhmuc['hoso'] as $key => $val}
							<th>{$val['mahs']}</th>
							{/foreach}
							<th>Người thu HS gần nhất</th>
							<th style="width: 10%">Hồ sơ</th>
						</thead>
						<tbody>
							{if !empty($tk_sinhvien)}
							{$data = $tk_sinhvien['timkiem']}
							{else}
							{$data = $sinhvien}
							{/if}
							{foreach $data as $k => $val}
							<tr {if !empty($danhmuc['diemchuan'][$val.soBD])} {if $val.tongdiem_goc < $danhmuc['diemchuan'][$val.soBD][0]['diemchuan']}class="todo"{/if}{/if}>
								<td class="text-center lg">{$val.stt}</td>
								<td class="lg"><a data-toggle="modal" data-target="#myModal-{$val.soBD}" class="xemchitiet_hs">{$val.soBD}</a></td>
								<td class="lg">
									<a href="{base_url('Ho-tro-nhap-hoc')}?sobd={$val.soBD}" target="blank" class="tt_sinhvien" style="cursor: pointer;" 
									> {$val.hoten}</a>
								</td>
								<td class="lg">{$val.ngaysinh}</td>
								{foreach $danhmuc['hoso'] as $k => $v}
								<td>
									{if $v.ghichu == "Nam" && $val.gioitinh =="Nữ"}
									{else}
									<div class="checkbox checkbox-primary">
										<input  type="checkbox" 
	                                    id="{$k}_{$v['mahs']}_{$val.soBD}" 
	                                    name="check_hs_{$val.soBD}[]" 
	                                    value="{$v['mahs']}" 
	                                    {if isset($dshs_sinhvien['_dscheck_hs'][$val.soBD][$v['mahs']])}
	                                    checked disabled 
	                                    {/if} 
	                                    >
	                                    <label for="{$k}_{$v['mahs']}_{$val.soBD}" ></label>
									</div> 
									{/if}
								</td>
								{/foreach}
								<td class="lg">{if !empty($val.nguoithuhs)} {$danhmuc['canbo'][$val.nguoithuhs]}{/if}</td>
								<td>
									<button type="submit" name="inhoso" class="btn btn btn-primary bt_print btn-sm" value="{$val.soBD}" formtarget="_blank" ><i class="fa fa-print" aria-hidden="true"></i>&nbsp;In hồ sơ</button>
									 <a href="{base_url()}Thu-ho-so?giaycamdoan={$val.soBD}" class="btn btn-success btn-sm"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;In giấy cam đoan</a>
									 <a href="{base_url()}Thu-ho-so?inkytucxa={$val.soBD}"  style="margin-top: 10px;" class="btn btn-info btn-sm"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;Ký túc xá</a>
									 <button type="submit" name="chuyentiep" class="btn btn btn-warning bt_print btn-sm" value="{$val.soBD}"  style="margin-top: 10px;"><i class="fa fa-share" aria-hidden="true"></i>&nbsp;Chuyển tiếp</button>
								</td>
							</tr>
							<!-- Modal -->
							<div id="myModal-{$val.soBD}" class="modal fade" role="dialog">
							  <div class="modal-dialog">
							    <!-- Modal content-->
								<form method="post">
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								       <h3 class="modal-title" id="myModalLabel">Thông tin chi tiết hồ sơ của sinh viên <span class="tien" style="font-size: 20px;">{$val.hoten}</span></h3>
								      </div>
								      <div class="modal-body">
									      	<div class="row">
									      		<!-- {if !empty($val.nguoithuhs)}
									      		<div class="col-md-7">
									        		<p class="ttct_hssv">Người thu hồ sơ gần nhất: <span class="tien" style="font-size: 17px;">{if !empty($val.nguoithuhs)}&nbsp;{$danhmuc['canbo'][$val.nguoithuhs]}{/if}</span></p>
									      			<p  class="ttct_hssv"> Thời gian nhận hồ sơ: {if !empty($val.nguoithuhs)}&nbsp;<span class="tien" style="font-size: 17px;">{date('d/m/Y H:i:s', strtotime({$val.thoigian_thuhs}))}{/if}</span></p>
									      		</div>
									      		<div class="col-md-5">
									      			<p class="ttct_hssv">Họ và tên: <span class="tien" style="font-size: 19px;">{if !empty($val.nguoithuhs)}&nbsp;{$val.hoten}{/if}</span></p>
									      			<p class="ttct_hssv">Ngày sinh: <span class="tien" style="font-size: 19px;">{if !empty($val.nguoithuhs)}&nbsp;{date('m/d/Y', strtotime({$val.ngaysinh}))}{/if}</span></p>
									      		</div>
									      		{/if} -->
									      		<div class="col-md-12 ge-border">
								      				<h3>
								      					<div class="col-md-5 tien text-left" style="margin-bottom: 20px;"><b>1. Danh sách hồ sơ</b></div>
														<div class="col-md-7">
															<div class="col-md-6 text-right" >
										      					<span class="ttct_dshssv1">Mã hồ sơ: </span><span class="tien" style="font-size: 16px;"><b>{$val.sohs_nh}</b></span>
										      				</div>
										      				<div class="col-md-6 text-right" >
										      					{if !empty($val.nguoithuhs)}
																<button type="submit" class="btn btn-warning btn-sm" name="inallhs" value="{$val.soBD}" formtarget="blank" style="font-size: 11px;">
																	<i class="fa fa-print" aria-hidden="true"></i>&nbsp; In tất cả hồ sơ
																</button>
																{/if}
										      				</div>
														</div>
								      				</h3>
								      				<div class="col-md-12">
									      				<div class="col-md-6 genal-border" style="border-top: 1px solid #CCc;border-left: 1px solid #CCc; border-bottom: 1px solid #CCc;padding: 10px;">
									      					<span class="ttct_dshssv1">Thông tin: </span>
									      				</div>
									      				<div class="col-md-6 genal-border" style="border-top: 1px solid #CCc;border-left: 1px solid #CCc; border-right: 1px solid #CCc;padding: 10px;">
									      					<span class="ttct_dshssv1">Hồ sơ đã thu </span>
									      				</div>
									      				
								      				</div>	

								      				{foreach $chitiet_hssv[$val.soBD] as $key => $v}
								      				{if !empty($v.hoso) }
									      				<div class="col-md-12" >
									      					<div class="col-md-6 genal-border" style="bborder-top: 1px solid #CCc;border-left: 1px solid #CCc; border-bottom: 1px solid #CCc; padding: 10px; min-height:{count($v.hoso)*40 + 22}px">
									      						<p  class="text-left ttct_dshssv1">
									      						 <span>Thời gian: {date('d/m/Y H:i:s', strtotime({$v.thoigian_thuhs}))}</span>
										      				   </p>
										      				   <p class="text-left ttct_dshssv1">
																<span class="ttct_dshssv1">Người thu hồ sơ: </span>
																<span class="tien">{if !empty($v.nguoithu_hoso)}&nbsp;{$danhmuc['canbo'][$v.nguoithu_hoso]}{/if}</span>
																<br>
															 </p>
										      				    <p  class="text-left ttct_dshssv1"><span>Tổng số hồ sơ: <span class="tien">{count($v.hoso)} (Hồ sơ)</span>
										      				   </p>
									      					</div>
									      					<div class="col-md-6 genal-border" style="border-top: 1px solid #CCc;border-left: 1px solid #CCc; border-right: 1px solid #CCc; {if (count($v.hoso)*40 + 22) >112 }min-height:{count($v.hoso)*40 + 22}px"{else}min-height:112px"{/if}>
									      						{foreach $v.hoso as $v1}
															 	<p><span class="tien"><i class="fa fa-circle" aria-hidden="true"></i>&nbsp; {$dsten_hs[$v1]}</span>
																	</p>	
																{/foreach}
									      					</div>
									      				</div>
								      				{/if}
								      				{/foreach}
								      			</div>
								      			
								      			<!-- // giấy cam đoan -->
								      			<div class="col-md-12">
								      				<h3><div class="col-md-12 tien text-left" style="margin-bottom: 20px;"><b>2. Giấy cam đoan</b></div></h3>
								      				<div class="col-md-12">
									      				<div class="col-md-6" style="border-top: 1px solid #CCc;border-left: 1px solid #CCc; border-bottom: 1px solid #CCc;padding: 10px;">
									      					<span class="ttct_dshssv1">Người in giấy cam đoan </span>
									      				</div>
									      				<div class="col-md-6" style="border: 1px solid #ccc; padding: 10px;">
									      					<span class="ttct_dshssv1">Thời gian in</span>
									      				</div>
								      				</div>	

								      				{foreach $chitiet_hssv[$val.soBD] as $key => $v}
								      				{if empty($v.hoso) && !empty($v.nguoithu_giaycamdoan) && !empty($v.thoigian_thugiaycamdoan)}
									      				<div class="col-md-12" >
									      					<div class="col-md-6" style="border-top: 1px solid #CCc;border-left: 1px solid #CCc; border-bottom: 1px solid #CCc;padding: 10px;">
									      						 <span class="tien" style="font-size: 16px;">{if !empty($v.nguoithu_giaycamdoan)}&nbsp;{$danhmuc['canbo'][$v.nguoithu_giaycamdoan]}{/if}</span>
									      					</div>
									      					<div class="col-md-6" style="border: 1px solid #ccc; padding: 10px;">
									      						<span class="tien" style="font-size: 16px;">{$v.thoigian_thugiaycamdoan}</span>
									      					</div>
									      				</div>
								      				{/if}
								      				{/foreach}
								      			</div>

									      	</div>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								      </div>
								    </div>
								</form>
							  </div>
							</div>
							{/foreach}
						</tbody>
					</table>
				</div>
			</form>
			{if empty($tk_sinhvien) || $tk_sinhvien['nguoithu'] == ""}
			<div class="row">
				<div class="bs-example text-center">
					<ul class="pagination">
						{if ($total_page > 1)}
						{if ($page > 1)}
						<li><a href="{base_url('Thu-ho-so')}?page={($page-1)}"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a></li>
						{/if}
						{for $i=1 to $total_page}
						{if ($i == $page)}
						<li class="active"><span class="page active">{$i}</span></li>
						{else}
						<li><a class="page gradient" href="{base_url('Thu-ho-so')}?page={$i}">{$i}</a></li>
						{/if}
						{/for}
						{if ($page < $total_page)}
						<li><a class="page gradient" href="{base_url('Thu-ho-so')}?page={($page+1)}"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
						{/if}
						{/if}
					</ul>	
				</div>
			</div>
			{/if}
		</div>
		<div class="modal fade" id="meModal-1" role="dialog">
		<div class="panel-footer">
			<small> <!-- Remove this notice or replace it with whatever you want -->
				<b>Phát triển và xây dựng bởi <span class="glyphicon glyphicon-heart" style="color: red;" aria-hidden="true"></span> Tổ phát triển Khoa CNTT - Trường Đại học Mở Hà Nội</b>
				<br>
				<!-- <em>Điện thoại hỗ trợ:</em><strong> 091.760.0946</strong> -->
			</small>
		</div>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="{base_url()}public/css/danhmuc.css">
<style type="text/css">
	 .lg{
        /*line-height: 75px !important;*/
    }
   /* .genal-border:last-child{
    	border-bottom: 1px solid #ccc !important;
    }*/
  .ge-border .col-md-12:last-child .genal-border{
  		border-bottom: 1px solid #ccc !important;
  }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.dev.js"></script>
<script type="text/javascript">
	function checkvalidate(){
		// checkbox  = $('input[type="checkbox"]');
		// console.log(checkbox);
		return true;
	}
    $(document).on('change', 'select[name="nguoithu"]', function(){
        value = $(this).val();
        if(value == ""){
            $('input[type="text"]').val("");
        }
    });
    $('button[name="inhoso"]').on('click', function(){
        setTimeout(function(){
           location.href= window.location.origin+window.location.pathname+"?sbd="+{$sinhvien[0].soBD};
        }, 500);
    });
    $('button[name="chuyentiep"]').on('click', function(){
        var socket = io("https://hdgsnn2.gov.vn/", {
          transports: ["websocket"]
	     });
	     var data = [$(this).val()];
	     console.log(data);
	     socket.emit("Client-sent-data-delete",data);
    });
</script>

{if !empty($goi)}
<script>
	var socket = io("https://hdgsnn2.gov.vn/", {
          transports: ["websocket"]
     });
     var data = [{$goi[0].stt}, {$goi[0].soBD}, '{$goi[0].hoten}', 'Nộp Hồ Sơ', '{$soban}', '{$soban}'];
     console.log(data);
     socket.emit("Client-sent-data", data);
	
</script>
{/if}
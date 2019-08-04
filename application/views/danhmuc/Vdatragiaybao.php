<div class="container-fluid fixdisplay" style="margin: 20px;">
	<div class="panel panel-default">
		<div class="panel-heading text-left">
			<h5><b>Danh sách sinh viên đã trả giấy báo</b></h5></div>
			<div class="panel-body">
				<div class="row">
					<form method="post">
						<div class="col-md-3 ngaythuphieudiem">
							<label for="">Ngày trả giấy báo</label>
							<div class="form-group">
								 <input type="text" class="form-control datepicker" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" name="ngaythu" autocomplete="off"  {if !empty($data_timkiem)} value="{$data_timkiem['ngaytimkiem']}" {else} value="{date('d/m/Y')}"{/if}>
							</div>
						</div>
						<div class="col-md-5 thoigianphieudiem">
                            <label for="">Chọn thời gian</label><br>
                              <div class="radio radio-primary radio1">
                                <input type="radio" name="thoigian" id="all" {if !empty($data_timkiem) && $data_timkiem.thoigian == "all"}checked=""{/if} value="all">
                                <label for="all"><b> Toàn bộ thời gian</b> </label>
                            </div>
                            <div class="radio radio-primary radio1">
                                <input type="radio" name="thoigian" id="radio7" value="cangay" {if !empty($data_timkiem) && $data_timkiem.thoigian == "cangay"}checked=""{/if}{if empty($data_timkiem)}checked=""{/if}>
                                <label for="radio7"><b> Cả ngày</b> </label>
                            </div>
                            <div class="radio radio-primary radio1">
                                <input type="radio" name="thoigian" id="radio8" value="sang" {if !empty($data_timkiem) && $data_timkiem.thoigian == "sang"}checked=""{/if}>
                                <label for="radio8"><b>Sáng</b> </label>
                            </div>
                            <div class="radio radio-primary radio1">
                                <input type="radio" name="thoigian" id="radio9" value="chieu" {if !empty($data_timkiem) && $data_timkiem.thoigian == "chieu"}checked=""{/if}>
                                <label for="radio9"><b> Chiều</b> </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                        	<label>Người trả giấy báo</label>
                        	<select name="nguoithu" class="form-control">
                        		<option value="all">Tất cả</option>
                        		{foreach $danhmuc['tbl_canbo'] as $k => $v}
	                        		{if $v.maquyen == 5}
		                        		<option value="{$v.macb}" {if $v.macb == $session['macb'] && empty($data_timkiem)} selected{else}{if !empty($data_timkiem) && $data_timkiem.nguoithu == $v.macb}selected{/if}{/if}> {$v.tencb}</option>
	                        		{/if}
                        		{/foreach} 
                        	</select>
                        </div>
                        <!--  -->
						<div class="col-md-1">
							<label>Tìm kiếm</label>
							<div class="form-group">
								<button name="timkiem" value="timkiem" class="btn btn-primary" type="submit">Tìm kiếm</button>
							</div>
						</div>
					</form>
				</div>
				<div class="dsdatragiaybao">
					<div class="col-md-7 col-lg-offset-3">
					</div>
					<table class="table table-bordered" id="table_id">
						<thead>
							<tr>
								<th class="text-center">STT</th>
								<th class="text-center">Số BD</th>
								<th class="text-center">Họ và tên</th>
								<th class="text-center">Giới tính</th>
								<th class="text-center">Ngày sinh</th>
								<th class="text-center">Ngành</th>
								<th>Người thu phiếu điểm</th>
								<th class="text-center">Mã hồ sơ</th>
								<th class="text-center">Người trả GB</th>
								<th class="text-center">Thời gian trả GB</th>
								<th class="text-center">Trạng thái</th>
								<th class="text-center">Tác vụ</th>
							</tr>
						</thead>
						<tbody >
							{if !empty($data_timkiem)}
							{$data = $data_timkiem['data_timkiem']}
							{else}
							{$data = $sinhvien}
							{/if}
							{$stt = 1}
							{foreach $data as $key => $val}
							{if !empty($val.sohs_nh) && !empty($val.nguoitra_giaybao) && !empty($val.thoigian_tragiaybao)}
							<tr>
								<td class="text-center"><b>{$stt++}</b></td>
								<td>{$val.soBD}</td>
								<td>{$val.hoten}</td>
								<td>{$val.gioitinh}</td>
								<td>{$val.ngaysinh}</td>
								<td>{$danhmuc['nganh'][$val.FK_sMaNganh]}</td>
								<td>{$danhmuc['canbo'][$val.nguoithu_phieudiem]}</td>
								<td>{$val.sohs_nh}</td>
								<td>{$danhmuc['canbo'][$val.nguoitra_giaybao]}</td>
								<td>{date('H:i:s d/m/Y', strtotime({$val.thoigian_tragiaybao}))}</td>
								<td><label class="label label-success">Đã trả giấy báo </label></td>
								<td>
									{if $session['macb']  == $val.nguoitra_giaybao && $val.trangthai < 3}
									<button type="submit" class="btn btn-danger btn-sm" name="huyhs" value="{$val.soBD}">Hủy giấy báo</button>
									{else}
									<button type="button" class="btn btn-danger btn-sm" disabled>Hủy giấy báo</button>
									{/if}
								</td>
							</tr>
							{/if}
							{/foreach}
						</tbody>
					</table>
				</div>
			</div>
			<div class="panel-footer">
				<small> <!-- Remove this notice or replace it with whatever you want -->
					<b>Phát triển và xây dựng bởi <span class="glyphicon glyphicon-heart" style="color: red;" aria-hidden="true"></span> Tổ phát triển Khoa CNTT - Trường Đại học Mở Hà Nội</b>
					<br>
					<!-- <em>Điện thoại hỗ trợ:</em><strong> 091.760.0946</strong> -->
				</small>
				<input type="hidden" value="{date('d/m/Y')}" name="date">
			</div>
		</div>
	</div>
	<script type="text/javascript" src="{base_url()}public/js/danhmuc.js"></script>
	<style>
		.dssv_chuagb{
			border-bottom: 1px solid red;
		}
		.phieuthudiem{
			margin-left: 20px;
			margin-right: 20px;
			padding: 20px;
			margin-top: 20px;
			box-shadow: 0px 0px 10px 0px #ccc;
		}
		.dsgiaybao .col-md-7, .dsdatragiaybao .col-md-7{
			margin-bottom: 30px;
		}
		.dsgiaybao h2{
			font-family: 'Time New Romans';font-weight: 500;line-height: 1.1;color: #a400c1;border-bottom: 1px solid;font-size: 32px;
		}
		.dsdatragiaybao h2{
			font-family: 'Time New Romans';font-weight: 500;line-height: 1.1;color: #169e6d;border-bottom: 1px solid;font-size: 32px;
		}
	</style>
	<script type="text/javascript">

		$(function () {
	        $('#table_id').DataTable({
	            ordering: true,
	            paging: true,
	            "pageLength": 100
	        })
	    })
	     // $('input[name="ngaythu"]').val($('input[name="date"]').val());
        $(document).on('change','input[name="thoigian"]', function(){
        	thoigian = $(this).val();
        	if(thoigian == "all"){
        		$('input[name="ngaythu"]').val("");
        		$('input[name="ngaythu"]').attr("disabled",true);
        		$('input[name="ngaythu"]').attr("placeholder","Tất cả ngày ");
        	}else{
        		$('input[name="ngaythu"]').attr("disabled",false);
        		// $('input[name="ngaythu"]').val($('input[name="date"]').val());
        	}
        });
	</script>
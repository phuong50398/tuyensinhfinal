<div class="container-fluid" style="background: aliceblue;">
	<div class="container fixdisplay" >
	<div class="panel panel-default">
		<div class="panel-heading text-left">
			<h5><b>Danh sách sinh viên đã thu phiếu điểm</b></h5></div>
			<div class="panel-body">
				<div class="row">
					<form method="post">
						<div class="col-md-3 ngaythuphieudiem">
							<label for="">Ngày thu phiếu điểm</label>
							<div class="form-group">
								 <input type="text" class="form-control datepicker" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask=""name="ngaythu" autocomplete="off"  {if !empty($data_timkiem)} value="{$data_timkiem['ngaytimkiem']}" {else} value="{date('d/m/Y')}"{/if}>
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
                        	<label>Người thu phiếu điểm</label>
                        	<select name="nguoithu" class="form-control">
                        		<option value="all">Tất cả</option>
                        		{foreach $danhmuc['tbl_canbo'] as $k => $v}
	                        		{if $v.maquyen == 6}
		                        		<option value="{$v.macb}" {if $v.macb == $session['macb'] && empty($data_timkiem)} selected{else}{if !empty($data_timkiem) && $data_timkiem.nguoithu == $v.macb}selected{/if}{/if}>{$v.tencb}</option>
	                        		{/if}
                        		{/foreach} 
                        	</select>
                        </div>
						<div class="col-md-1">
							<label>Tìm kiếm</label>
							<div class="form-group">
								<button name="timkiem" value="timkiem" class="btn btn-primary" type="submit">Tìm kiếm</button>
							</div>
						</div>
					</form>
				</div>
						<hr>
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
								<th>Người thu phiếu điểm</th>
								<th>Thời gian thu phiếu điểm</th>
							</tr>
						</thead>
						<tbody>
							{if !empty($data_timkiem)}
								{$data = $data_timkiem['data_timkiem']}
							{else}
								{$data = $sinhvien}
							{/if}
								{foreach $data as $key => $val}
								<tr>
									<td class="text-center"><b>{$key+1}</b></td>
									<td>{$val.soBD}</td>
									<td>{$val.hoten}</td>
									<td>{$val.gioitinh}</td>
									<td>{$val.ngaysinh}</td>
									<td>{$danhmuc['canbo'][$val.nguoithu_phieudiem]}</td>
									<td>{date('H:i:s d/m/Y', strtotime({$val.thoigian_thuphieudiem}))}</td>
								</tr>
								{/foreach}
						</tbody>
					</table>
				</div>
			</div>
			<div class="panel-footer">
				<small> <!-- Remove this notice or replace it with whatever you want -->
					<b>Phát triển và xây dựng bởi <span class="glyphicon glyphicon-heart" style="color: red;" aria-hidden="true"></span> Tổ phát triển Khoa CNTT - Trường ĐH Mở HN</b>
					<br>
					<!-- <em>Điện thoại hỗ trợ:</em><strong> 091.760.0946</strong> -->
				</small>
			</div>
			<input type="hidden" value="{date('d/m/Y')}" name="date">
		</div>
	</div>
	<script type="text/javascript">
		 $(function () {
	        $('#table_id').DataTable({
	            ordering: true,
	            paging: true,
	            "pageLength": 100
	        })
	    })
	</script>
	 <script type="text/javascript">
        $('.js-example-basic-multiple').select2();
        $('.datepicker').datepicker({
          format: 'dd/mm/yyyy',
          autoclose: true
      });
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
</div>
<style type="text/css">
	.panel-heading h5{
		font-family: "Time News Romans";
		font-size: 23px;
		/*text-transform: uppercase;*/
	}
</style>

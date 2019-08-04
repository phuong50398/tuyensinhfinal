<div class="container-fluid fixdisplay" style="margin: 20px;">
	<div class="panel panel-default">
		<div class="panel-heading text-left">
			<h5><b>Danh sách sinh viên</b></h5>
		</div>
		<div class="row">
			<br>
			<form method="post">
				<div class="col-md-12">
					<div class="col-md-4">
						<div class="input-group">
							<label>Chọn bàn</label>
							<select name="chonban" class="form-control">
								<option value="all" selected>Tất cả</option>
								{for $i = 1 to 4}
									<option value="{$i}" {if !empty($timkiem) && $timkiem['soban'] == $i} selected{/if}>{$i}</option>
								{/for}
							</select>
							<span class="input-group-btn loading">
								<input type="submit" name="timkiem" class="btn btn-primary" value="Tìm kiếm" style="margin-top: 25px;">
							</span>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="panel-body">
			<table class="table table-bordered"  id="table_id">
			<thead>
				<tr>
					<th class="text-center">STT</th>
					<th class="text-center">Số BD</th>
					<th class="text-center">Họ và tên</th>
					<th class="text-center">Giới tính</th>
					<th class="text-center">Ngày sinh</th>
					<th class="text-center">Ngành</th>
				<!-- 	<th>Người thu phiếu điểm</th>
					<th>Thời gian thu phiếu điểm</th> -->
					<th class="text-center">Mã hồ sơ</th>
					<th class="text-center">Tác vụ</th>
				</tr>
			</thead>
			<tbody>
				{$stt = 1}
				{if !empty($timkiem) && $timkiem['soban'] != "all"}
					{$data = $timkiem['dssvban']}
				{else}
					{$data = $dssv}
				{/if}
				{foreach $data as $key => $val}
					<tr>
						<td>{$stt++}</td>
						<td>{$val.soBD}</td>
						<td>{$val.hoten}</td>
						<td>{$val.ngaysinh}</td>
						<td>{$val.gioitinh}</td>
						<td>{$val.FK_sMaNganh}</td>
				<!-- 		<td>{$danhmuc['canbo'][$val.nguoithu_phieudiem]}</td>
						<td>{date('d/m/Y H:i:s', strtotime({$val.thoigian_thuphieudiem}))}</td> -->
						<td>{$val.sohs_nh}</td>
						<td>
							<a href="{base_url('Ho-tro-nhap-hoc')}?sobd={$val.soBD}" target="blank" class="btn btn-primary">Cập nhật thông tin</a>
						</td>
					</tr>
				{/foreach}
			</tbody>
		</div>
	</div>
</div>
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
	.dsgiaybao .col-md-8{
		margin-bottom: 30px;
	}
	.dsgiaybao h2{
		font-family: 'Time New Romans';font-weight: 500;line-height: 1.1;color: #a400c1;border-bottom: 1px solid;font-size: 32px;
	}
</style>


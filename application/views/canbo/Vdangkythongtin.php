<div class="container phieuthudiem">
	<br>
	<form method="post">
		<h3 class="text-center"><span class="gachchan"> Thông tin cán bộ nhập học Tuyển sinh năm {date('Y')} - {date('Y')+1}</span></h3>
		<br>
		<div class="col-md-6 col-lg-offset-3">
			<div class="form-group">
				<label>Họ và tên</label>
				<input type="text" class="form-control" required="" name="data[tencb]">
			</div>
			<div class="form-group">
				<label>Lớp</label>
				<input type="text" class="form-control" name="data[lop]">
			</div>
			<div class="form-group">
				<label>Ngày sinh</label>
				  <input type="text" class="form-control datepicker" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask=""name="data[ngaysinh]" autocomplete="off" >
			</div>
		</div>
		<div class="col-md-6 col-lg-offset-3" style="margin-bottom: 20px;">
			<button class="btn btn-primary" name="capnhat" value="1">
				Cập nhật
			</button>
		</div>
	</form>
</div>
<style>
	.gachchan{
		border-bottom: 1px solid red;
		font-size: 30px;
	}
	.phieuthudiem{
		margin-top: 20px;
		box-shadow: 0px 0px 10px 0px #ccc;
		    background: ghostwhite;
	}
</style>

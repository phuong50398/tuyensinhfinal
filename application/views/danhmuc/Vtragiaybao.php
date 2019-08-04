<div class="container-fluid fixdisplay" style="margin: 20px;">
	<div class="panel panel-default">
		<div class="panel-heading text-left">
			<h5><b>Danh sách sinh viên chưa lấy giấy báo</b></h5>
		</div>
		<div class="row">
			<br>
			<div class="col-md-12">
				<div class="col-md-3">
						<label>Chọn bàn</label>
						<select name="chonban" class="form-control">
							<option value="all" selected>Tất cả</option>
							{for $i = 1 to 4}
								<option value="{$i}">{$i}</option>
							{/for}
						</select>
						
				</div>
				<div class="col-md-2" style="padding: 0;">
					<span class="input-group-btn loading">

					</span>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<table class="table table-bordered">
			<thead>
				<tr>
					<th class="text-center">STT</th>
					<th class="text-center">Số BD</th>
					<th class="text-center">Họ và tên</th>
					<th class="text-center">Giới tính</th>
					<th class="text-center">Ngày sinh</th>
					<th class="text-center">Ngành</th>
					<th class="text-center">Mã hồ sơ</th>
					<th class="text-center">Trạng thái</th>
					<th class="text-center" style="width: 9%;">Tác vụ</th>
				</tr>
			</thead>
			<tbody id="tb">
			</tbody>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.dev.js"></script>
<script type="text/javascript" src="{base_url()}public/js/danhmuc.js"></script>
<script type="text/javascript">
	  $(function() {
        // $('#tb').DataTable();
        // $('#tableleft').DataTable();
        // $('#tableright').DataTable();
    })
</script>
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
	.fix{
		width: 100px;
	}
</style>


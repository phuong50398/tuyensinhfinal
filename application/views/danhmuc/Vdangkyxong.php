<div class="container-fulid">
	<div class="container text-center main_dktc">
		<h4 class="alert alert-info">Cảm ơn bạn đã đăng ký thông tin thành công! Xin mời bạn đến nhập học đúng giờ nhé!</h4>
		<a href="{base_url('Dang-ky-thong-tin-sinh-vien')}" class="btn btn-primary"><i class="fa fa-reply" aria-hidden="true"></i>&nbsp;Quay lại</a>
		<a href="{base_url('login')}" class="btn btn-danger"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;Đăng xuất</a>
		<hr>
		<div class="row luy">
			<p class="chuy"> <u><b>Chú ý:</b></u> Sau khi cập nhật thành công thông tin, các thí sinh vẫn phải đến trường nộp phiếu điểm và làm thủ tục nhập học.</p>
		</div>
		<hr>
		<div class="panel-footer">
			<small> 
				<b>Phát triển và xây dựng bởi <span class="glyphicon glyphicon-heart" style="color: red;" aria-hidden="true"></span> Tổ phát triển Khoa CNTT - Trường Đại học Mở Hà Nội</b>
				<br>
			</small>
		</div>
	</div>
	<canvas id="canvas"></canvas>
</div>
<script type="text/javascript" src="{$url}public/jquery/mousehoa.js"></script>


<style type="text/css">
	canvas {
		/*cursor: crosshair;*/
		display: block;
		top: 0;
		width: 100%;	
	}
	.dangkythongtinsv, .color-1{
		display: none;
	}
	.luy{
		padding: 10px;
	}
	.main_dktc{
		margin-top: 20px;
		/*margin-left: 20px;*/
		/*margin-right: 20px;*/
		box-shadow: 0px 0px 10px 0px #ccc;
	}

</style>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>In giấy VietComBank</title>
	<style>
		body {
			line-height: 1;
			font-family: arial;
		}

		h3 {
			margin: 0 0 5px 0;
		}

		h4 {
			margin-bottom: 0;
			margin-top: 2px;
		}

		page {
			background: white;
			display: block;
			margin: 0 auto;
			margin-bottom: 0.5cm;
			/*box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);*/
		}

		page[size="A4"] {
			width: 21cm;
			height: 29.7cm;
		}

		page[size="A4"][layout="landscape"] {
			width: 29.7cm;
			height: 21cm;
		}

		@media print {
			@page {
				size: A4;
				/* DIN A4 standard, Europe */
				margin-top: 0 10px 0 10px !important;
			}
			body,
			page {
				margin: 0;
				/*box-shadow: 0;*/
			}
		}

		$darkgray: #808080;
		$gray:#B3B2B3;
		$lightgray: #E5E5E4;
		$darkblue: #115980;
		$blue: #2A95D2;
		$lightblue: #92D9F8;
		div.checkbox-example-wrap {
			width: 260px;
			margin: 20px;
			p {
				padding: 0 20px;
				color: #444;
			}
		}

		label {
			line-height: 1.5em;
			font-size: 18px;
		}

		.checkbox-example {
			position: relative;
			/*width: 200px;*/
			/*background: #EEE;*/
			/*padding: 20px;*/
			/*margin: 0px;*/
			display: block;
		}
		/*// Fancy Checkmark*/

		input[type="checkbox"].fancy-checkbox {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute !important;
			height: 1px;
			width: 1px;
			overflow: hidden;
		}

		label.fancy-checkbox-label {
			display: block;
			cursor: pointer;
			color: $darkgray
		}

		label.fancy-checkbox-label:before {
			position: absolute;
			top: 20px;
			right: 30px;
			display: block;
			width: 20px;
			height: 20px;
			border: 2px solid $darkgray;
			background: #FFF;
			content: " ";
		}

		label.fancy-checkbox-label:after {
			position: absolute;
			top: 20px;
			right: 18px;
			width: 29px;
			height: 8px;
			content: " ";
			transform: rotate(-45deg);
			opacity: 0;
		}

		input:checked + label.fancy-checkbox-label {
			color: $darkgray;
		}

		input:checked + label.fancy-checkbox-label:after {
			opacity: 1;
			border: 2px solid $darkgray;
			transform: rotate(-45deg);
			border-top: none;
			border-right: none;
		}

		input:checked + label.fancy-checkbox-label:before {
			border: 2px solid $darkgray;
		}
		/*// Checkbox with an 'X'*/

		input[type="checkbox"].xcheckbox {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute !important;
			height: 1px;
			width: 1px;
			overflow: hidden;
		}

		label.xcheckbox-label {
			display: block;
			cursor: pointer;
			color: $darkgray
		}

		label.xcheckbox-label:before {
			position: absolute;
			top: -5px;
			right: 9px;
			display: block;
			width: 20px;
			height: 20px;
			border: 2px solid #808080;
			background: #FFF;
			content: " ";
		}

		label.xcheckbox-label:after {
			position: absolute;
			top: -6px;
			right: -3px;
			width: 29px;
			height: 8px;
			content: "x";
			opacity: 0;
		}

		input:checked + label.xcheckbox-label {
			color: #808080;
		}

		input:checked + label.xcheckbox-label:after {
			opacity: 1;
		}
		/* Customize the label (the container) */

		.container {
			display: block;
			position: relative;
			padding-left: 30px;
			/*margin-bottom: 12px;*/
			margin-right: 2px;
			cursor: pointer;
			font-size: 17px;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
		/* Hide the browser's default checkbox */

		.container input {
			position: absolute;
			opacity: 0;
			cursor: pointer;
			height: 0;
			width: 0;
		}
		/* Create a custom checkbox */

		.checkmark {
			position: absolute;
			top: 0px;
			left: 6px;
			height: 20px;
			width: 20px;
			border: 1px solid black;
		}
		/* On mouse-over, add a grey background color */

		.container:hover input ~ .checkmark {}
		/* When the checkbox is checked, add a blue background */

		.container input:checked ~ .checkmark {}
		/* Create the checkmark/indicator (hidden when not checked) */

		.checkmark:after {
			content: "";
			position: absolute;
			display: none;
		}
		/* Show the checkmark when checked */

		.container input:checked ~ .checkmark:after {
			display: block;
		}
		/* Style the checkmark/indicator */

		.container .checkmark:after {
			left: 6px;
			top: 2px;
			width: 5px;
			height: 10px;
			border: solid black;
			border-width: 0 3px 3px 0;
			-webkit-transform: rotate(45deg);
			-ms-transform: rotate(45deg);
			transform: rotate(45deg);
		}
		/*SẸCC	*/

		.cangiua {
			text-align: center;
		}

		.tieude {}

		.canphai {
			text-align: right;
		}

		.cantrai {
			text-align: left;
		}

		.cachdong {
			display: inline-block;
			margin-bottom: 5px;
			display: flex;
			width: 100%;
		}

		.cachdongp2 {
			display: inline-block;
			margin-bottom: 3.5px;
			display: flex;
			width: 100%;
		}
	</style>
</head>
<body>
	<page size="A4">
		<br>
		<div style="width: 30%; float: left;">
			<img src="{base_url()}public/images/vcb.png" alt="" style="width: 100%;">
		</div>
		<br>
		<br>
		<br>
		<div style="width: 70%; float: left;">
			<h3 class="cangiua">GIẤY ĐỀ NGHỊ MỞ TÀI KHOẢN CÁ NHÂN</h3>
			<h3 class="cangiua">VÀ PHÁT HÀNH THẺ LIÊN KẾT SINH VIÊN</h3>
			<br>
			<br>
			<br>
			<br>
		</div>

		<div class="cangiua"> <b><i>Kính gửi: Ngân hàng TCMP Ngoại Thương Việt Nam - Chi nhánh Hoàn Kiếm</i></b></div>
		<div>
			<br>
			<h4>THÔNG TIN VỀ KHÁCH HÀNG</h4>
		</div>
		<div class="cachdongp2">
			<div style="width: 40%;">
				<p>Họ và Tên: <b>{$sinhvien_in.hoten}</b></p>
			</div>
			<div style="width: 40%;">
				<p>Tên viết tắt:............</p>
			</div>
		</div>
		<div class="cachdongp2">
			<div style="width:50%;">
				Ngày sinh <b>{date('d/m/Y', strtotime({$sinhvien_in.ngaysinh}))}</b>
			</div>
			<div style="width: 50%;">
				<b>Tình trạng hôn nhân</b>
			</div>
		</div>
		<div class="cachdongp2">
			<div style="width:50%;">
				<br>
				<div style="float:left; "><span>Cư trú </span> &nbsp;</div>
				<div style="float: left;">
					<label class="container">Có
						<input type="checkbox" checked="">
						<span class="checkmark"></span>
					</label>
				</div>
				<div style="float: left;">
					<label class="container">Không
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</div>
			</div>
			<div style="width:50%; text-align: right;">
				<div style="float: left;">
					<label class="container">Độc thân
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</div>
				<div style="float: left;">
					<label class="container">Có gia đình
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</div>
				<div style="float: left;">
					<label class="container">Li dị
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</div>
				<div style="float: left;">
					<label class="container">Góa
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</div>
			</div>
		</div>
		<div class="cachdongp2">
			<div style="width:70%;">
				Quốc tịch: <b>Việt Nam</b>
			</div>
			<div style="width: 30%;">
				<b>Trình độ học vấn</b>
			</div>
		</div>
		<div class="cachdongp2">
			<div style="width:65%;">
				<div style="float:left; "><span>Giới tính</span> &nbsp;</div>
				<div style="float: left;">
					<label class="container">Nam
						<input type="checkbox" checked="">
						<span class="checkmark"></span>
					</label>
				</div>
				<div style="float: left;">
					<label class="container">Nữ
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</div>
			</div>
			<div style="width: 35%;">
				<div style="float: left;">
					<label class="container">Sau đại học
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</div>
				<div style="float: left;">
					<label class="container">Đại học
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</div>
			</div>
		</div>
		<div class="cachdongp2">
			<div style="width:65%;">
				<div style="float: left;">
					<label class="container">CMND/Thẻ căn cước công dân
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</div>
				<div style="float: left;">
					<label class="container">Hộ chiếu
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</div>
			</div>
			<div style="width: 35%;">
				<div style="float: left;">
					<label class="container">Cao đẳng
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</div>
				<div style="float: left;">
					<label class="container">THPT,Trung cấp
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</div>
			</div>
		</div>
		<div class="cachdongp2">
			<div style="width:65%;">
				Số:<b>001200017264</b> Ngày cấp..........................Nơi cấp............................
			</div>
			<div style="width: 35%;">
				&nbsp;<b>Nghề nghiệp</b>
			</div>
		</div>
		<div class="cachdongp2">
			<div style="width:65%;">
				Địa chỉ liên hệ: Số nhà 21, Ngõ 202 Định Công Hạ, Hoàng Mai, Hà Nội
			</div>
			<div style="width: 35%;">
				<div style="float: left;">
					<label class="container">Sinh viên
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</div>
			</div>
		</div>
		<div class="cachdongp2">
			<div style="width:65%;">
				Địa chỉ thường chú: Cẩm Phú, thành phố Cẩm Phả, tỉnh Quảng Ninh
			</div>
			<div style="width: 35%;">
				<div style="float: left;">
					<label class="container">Học viên
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</div>
			</div>
		</div>
		<div class="cachdongp2">
			<div style="width:65%;">
				Điện thoại di động: 0869013780 Email
			</div>
			<div style="width: 35%;">
				<div style="float: left;">
					<label class="container">Khác
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</div>
			</div>
		</div>
		<h4>THÔNG TIN VỀ KHÁCH HÀNG CHO MỤC ĐÍCH TUÂN THỦ FATCA</h4>
		<br>
		<div class="cachdongp2">
			<div style="width:65%;">
				1. Quý khách là Công dân Hoa Kỳ hoặc đối tượng cư trú tại Hoa Kỳ
			</div>
			<div style="width: 35%;">
				<div style="float: left;">
					<label class="container">Có
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</div>
				<div style="float: left;">
					<label class="container">Không
						<input type="checkbox" checked="">
						<span class="checkmark"></span>
					</label>
				</div>
			</div>
		</div>
		<div class="cachdongp2">
			<div style="width:65%;">
				2. Quý khách có nơi sinh tại Hoa Kỳ
			</div>
			<div style="width: 35%;">
				<div style="float: left;">
					<label class="container">Có
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</div>
				<div style="float: left;">
					<label class="container">Không
						<input type="checkbox" checked="">
						<span class="checkmark"></span>
					</label>
				</div>
			</div>
		</div>
		<div class="cachdongp2">
			<div style="width:65%;">
				3. Quý khách có địa chỉ nhận thư hoặc địa chỉ thường trú tại Hoa Kỳ
			</div>
			<div style="width: 35%;">
				<div style="float: left;">
					<label class="container">Có
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</div>
				<div style="float: left;">
					<label class="container">Không
						<input type="checkbox" checked="">
						<span class="checkmark"></span>
					</label>
				</div>
			</div>
		</div>
		<div class="cachdongp2">
			<div style="width:65%;">
				4. Quý khách có số điện thoại liên lạc sẵn tại Hoa Kỳ
			</div>
			<div style="width: 35%;">
				<div style="float: left;">
					<label class="container">Có
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</div>
				<div style="float: left;">
					<label class="container">Không
						<input type="checkbox" checked="">
						<span class="checkmark"></span>
					</label>
				</div>
			</div>
		</div>
		<div class="cachdongp2">
			<div style="width:65%;">
				5. Quý khách có chỉ định định kỳ chuyển khoản vào một tài khoản mở tại Hoa Kỳ hay định kì nhận tiền từ một đối tượng có địa chỉ tại Hoa Kỳ
			</div>
			<div style="width: 35%;">
				<div style="float: left;">
					<label class="container">Có
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</div>
				<div style="float: left;">
					<label class="container">Không
						<input type="checkbox" checked="">
						<span class="checkmark"></span>
					</label>
				</div>
			</div>
		</div>
		<div class="cachdongp2">
			<div style="width:65%;">
				6. Quý khách có ủy quyền hoặc cấp thẩm quyền còn hiệu lực đối với khoản tài chính cho một đối tượng tại Hoa Kỳ
			</div>
			<div style="width: 35%;">
				<div style="float: left;">
					<label class="container">Có
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</div>
				<div style="float: left;">
					<label class="container">Không
						<input type="checkbox" checked="">
						<span class="checkmark"></span>
					</label>
				</div>
			</div>
		</div>
		<div class="cachdongp2">
			<div style="width:65%;">
				7. Quý khách có địa chỉ nhận thư hộ hoặc thư giữ tại Hoa Kỳ
			</div>
			<div style="width: 35%;">
				<div style="float: left;">
					<label class="container">Có
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</div>
				<div style="float: left;">
					<label class="container">Không
						<input type="checkbox" checked="">
						<span class="checkmark"></span>
					</label>
				</div>
			</div>
		</div>
		<h4>TÔI ĐỀ NGHỊ VIETCOMBANK CUNG CẤP CÁC DỊCH VỤ SAU ĐÂY </h4>
		<h4>THÔNG TIN TÀI KHOẢN</h4>
		<div class="cachdongp2"></div>
		<div class="cachdongp2">
			<div style="width:65%;">
				<div style="float:left; "><span>Loại tiền</span> &nbsp;</div>
				<div style="float: left;">
					<label class="container">VNĐ
						<input type="checkbox" checked="">
						<span class="checkmark"></span>
					</label>
				</div>
				<div style="float: left;">
					<label class="container">USD
						<input type="checkbox">
						<span class="checkmark"></span>
					</label>
				</div>
			</div>
		</div>
		<h4>YÊU CẦU PHÁT HÀNH THẺ LIÊN KẾT SINH VIÊN </h4>
		<div class="cachdongp2"></div>
		<div class="cachdongp2"></div>
		<div class="cachdongp2">
			<b>Tên chủ thẻ </b>(in trên thẻ, tối đa 20 ký tự hoa):<b>{$sinhvien_in.hoten}</b>
		</div>
		<div class="cachdong2">
			Tôi đồng ý và ủy quyền cho đại diện hợp pháp của <b>Trường Đại học Mở Hà Nội</b> theo công văn/giấy tờ
		</div>
		<div class="cachdongp2">
			số:......................................., thay mặt Tôi thực hiện công tác nhận thẻ được phát hành với các thông tin nêu trên và các tài liệu liên quan khác do Ngân hàng cung cấp.
		</div>
		<div class="cachdongp2">
			Tôi cam kết hoàn toàn chịu trách nhiệm và không có bất kì khiếu nại nào liên quan tới ủy quyền nêu trên
		</div>
		<h4>ĐĂNG KÍ SỬ DỤNG DỊCH VỤ KHÁC</h4>
		<div class="cachdong"></div>
		<div class="cachdong">
			<b>Đề nghị đánh dấu (V) vào ô trống để xác nhận yêu cầu dịch vụ, đánh dấu (X) vào ô trống nếu không sử dụng dịch vụ </b>
		</div>
		<div class="cachdongp2">
			<div style="width:50%;">
				<div style="float: left;">
					<label class="container">Dịch vụ Ngân hàng trên điện thoại di động (VCB-Mobile B@nking) (miễn phí 1 năm)
						<input type="checkbox" checked="">
						<span class="checkmark"></span>
					</label>
				</div>
			</div>
			<div style="width:50%;">
				<div style="float: left;">
					<label class="container">Dịch vụ Ngân hàng qua tin nhắn di động (VCB-SMS B@nking) (Miễn phí 3 tháng)
						<input type="checkbox" checked="">
						<span class="checkmark"></span>
					</label>
				</div>
			</div>
		</div>
		<div class="cachdongp2">
			<div style="width:50%;">
				<div style="float: left;">
					<label class="container">Dịch vụ thanh toán trên điện thoại di động cho thuê bao Viettel (Mobile BankPlus) (Miễn phí 1 năm)
						<input type="checkbox" checked="">
						<span class="checkmark"></span>
					</label>
				</div>
			</div>
			<div style="width:50%;">
				<div style="float: left;">
					<label class="container">Dịch vụ Ngân hàng trực tuyến (VCB-iB@nking)
						<input type="checkbox" checked="">
						<span class="checkmark"></span>
					</label>
				</div>
			</div>
		</div>
	</page>
</body>
<script type="text/javascript">
	window.print();
	window.onafterprint = function() {
		window.close();
	};
</script>
</html>
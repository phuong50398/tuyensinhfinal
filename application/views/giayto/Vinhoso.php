<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>IN  TỜ KHAI NHẬP HỌC</title>
	<style>
		.tonhat{
			color: #c3c3c3;
    		font-size: 9px;
		}
		body {
			/*line-height: 1;*/
			font-family: arial;
		}

		h3 {
			margin: 0 0 8px 0		}

		h4 {
			margin-bottom: 2px;
			margin-top: 8px;
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
			body{
			}
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
			padding-left: 33px;
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
			margin-bottom: 10px;
			display: flex;
			width: 100%;
		}

		.cachdongp2 {
			display: inline-block;
			margin-bottom: 3.5px;
			display: flex;
			width: 100%;
		}
		.dandong{
			margin-bottom: 20px;
		}
	</style>
</head>
<body>
	{for $i = 1 to 2}
	<page size="A4">
		<div class="cangiua">
			<br><br><br>
			<h3>TỜ KHAI NHẬP HỌC</h3>
			<h3>VÀO TRƯỜNG ĐẠI HỌC MỞ HÀ NỘI NĂM 2019</h3>
		</div>
		<div class="canphai">
			<p>Số HS:<b>{$sinhvien_in.sohs_nh}</b></p>
		</div>
		<div>
			<h4>A. THÔNG TIN CÁ NHÂN:</h4>
		</div>
		<div style="width: 85%; float: left;">
			<p>Ngành đào tạo: {$danhmuc['nganh'][$sinhvien_in.FK_sMaNganh]} - Điểm chuẩn: {$diemchuan.diemchuan}</p>
			<div style="width: 33%; float: left;">Hệ: {$sinhvien_in.hedaotao}</div>
			<div style="width: 33%; float: left;">Khối thi: {$sinhvien_in.khoihoc}</div>
			<div style="width: 33%; float: left;">Tổng điểm xét tuyển: {{$sinhvien_in.tongdiem_xettuyen}}</div>
			<br>
			<hr style="width: 100%;float: right;">
			<div style="width: 75%; float: left;">Họ và Tên: <b>{$sinhvien_in.hoten}</b></div>
			<p>SBD: {$sinhvien_in.soBD}</p>
			<div class="cachdong dandong" style=" width: 100%;">
				<div style="width: 33%; float: left;">Giới tính: {$sinhvien_in.gioitinh}</div>
				<div style="width: 33%; float: left;">Dân tộc: {if !empty($sinhvien_in.FK_Dantoc)}{$danhmuc['dantoc'][$sinhvien_in.FK_Dantoc]}{/if}</div>
				<div style="width: 34%; float: left;">Ngày sinh: {$sinhvien_in.ngaysinh}</div>
			</div>
			<div class="cachdong dandong" style=" width: 100%;">
				<div style="width: 33%; float: left;">Khu vực: {$sinhvien_in.khuvuc}</div>
				<div style="width: 33%; float: left;">Đối tượng: {$sinhvien_in.doituong}</div>
			</div>
			<div class="cachdong dandong" style=" width: 100%;">
				<div style="width: 66%; float: left;">Mã SV/Tài khoản đăng nhập hệ thống: {$sinhvien_in.masv}</div>
				<div style="width: 33%; float: left;">Số CMTND:{$sinhvien_in.CMND}</div>
			</div>
			<div class="cachdong dandong" style=" width: 100%;">
				<div style="width: 66%; float: left;">Ngày cấp CMND: {$sinhvien_in.ngaycapcmnd}</div>
					<div style="width: 66%; float: left;">Nơi cấp CMND: {$sinhvien_in.noicapcmnd}</div>
			</div>
			<div class="cachdong dandong" style=" width: 100%;">
				<div style="width: 100%; float: left;">Năm tốt nghiệp trung học phổ thông (hoặc tương đương): {$sinhvien_in.namtotnghiep}</div>
			</div>
			<div class="cachdong dandong" style=" width: 100%;">
				<div style="width: 100%; float: left;">Nơi tốt nghiệp: {$sinhvien_in.noitotnghiep}</div>
			</div>
			<div class="cachdong dandong" style=" width: 100%;">
				<div style="width: 100%; float: left;">HK thường trú: {$sinhvien_in.hokhau}</div>
			</div>
			<div class="cachdong dandong" style=" width: 100%;">
				<div style="width: 100%; float: left;">Thông tin liên hệ (hoặc báo tin): {$sinhvien_in.hoten_bo}</div>
			</div>
			<div class="cachdong dandong" style=" width: 100%;">
				<div style="width: 100%; float: left;">Địa chỉ: {$sinhvien_in.diachi}</div>
			</div>
		</div>
		<div style="width:15%; float: right;">
			<div style="height: 211px; width: 160px;background: #f3f3f3;">
				<img src="{base_url()}public/sinhvien/{$sinhvien_in.soBD}.jpg" alt="" width="100%">
			</div>
			<p class="text-center" style="margin-left: 10px;margin-top: 42px;"> <b>MHN.{$sinhvien_in.masv}</b></p>
		</div>
		<div class="cachdong dandong" style=" width: 100%;">
			<div style="width: 50%; float: left;">Điện thoại liên lạc: {$sinhvien_in.sdt}</div>
		</div>
		<br>
		<h4>B. HỒ SƠ NHẬP HỌC</h4>
		<br>
		</div>
		{foreach $danhmuc['hoso'] as $key => $val}
		<!-- // mạnh inline -->
		<div style="width: 50%;float: left;margin-top: 5px;">
			<div style="width: 90%;float: left; font-size: 14px;height: 44px;">{$key+1}. <b>{$dsten_hs[$val.mahs]}</b>
				{if isset($hoso_dacheck[$val['mahs']])}
				<p class="tonhat">Người thu hồ sơ:{$danhmuc['canbo'][$hoso_dacheck[$val['mahs']]['nguoithu_hoso']]} - {date('d/m/Y H:i:s', strtotime({$hoso_dacheck[$val['mahs']]['thoigian_thuhs']}))}</p>
				{/if}
			</div>
			<div class="xbox-checkbox checkbox-example" style="width: 6%; float: left;margin-bottom: 10px;">
				{if isset($hoso_dacheck[$val['mahs']])}
				<img src="{base_url()}public/images/check.png" width="100%"> 
				{else}
				<img src="{base_url()}public/images/uncheck.png" width="100%"> 
				{/if}
			</div>
		</div>
		{/foreach}
		
		{$count = count($hoso_dacheck)}
		
		<div style=" width: 100%;clear: both;">
			<p><b><i>Số giấy tờ đã thu {$count}/{count($danhmuc['hoso'])}</i></b></p>
			<hr>
		</div>
		<div style="display: flex; width: 100%;">
			<div style="width: 50%;">
			</div>
			<div style="width: 50%;" class="cangiua">
				<span>Hà Nội, ngày {date('d')} tháng {date('m')} năm {date('Y')}</span>
			</div>
		</div>
		<div style="display: flex; width: 100%;">
			<div style="width: 60%;">
				<p class="cangiua"><b>Cán bộ nhận hồ sơ</b></p>
			</div>
			<div style="width: 40%;">
				<p class="cangiua"><b>Người khai</b></p>
			</div>
		</div>
		<br>
		<br>
		<br>
		<br>
		<div style="display: flex; width: 100%; margin-top: -20px;">
			<div style="width: 60%;">
				<p class="cangiua"><b>{if !empty($sinhvien_in['nguoithuhs'])} {$danhmuc['canbo'][$sinhvien_in['nguoithuhs']]}{else}{$session['tencb']}{/if}</b>
				</p>
				<small>Cán bộ nhận hồ sơ: {if !empty($sinhvien_in['nguoithuhs'])} {$danhmuc['canbo'][$sinhvien_in['nguoithuhs']]}{else}{$session['tencb']}{/if} - {if !empty($sinhvien_in['thoigian_thuhs'])} {date('d/m/Y H:i:s', strtotime({$sinhvien_in['thoigian_thuhs']}))}{else}{date('d/m/Y H:i:s')}{/if} </small>
				
			</div>
			<div style="width: 40%;">
				<p class="cangiua"><b>{$sinhvien_in['hoten']}</b></p>
			</div>
		</div>
	</page>
	<br><br>
	{/for}
	 <page size="A4">
            <br> <br> <br> <br> <br>
            <div style="width: 30%; float: left;">
                <img src="{base_url()}public/images/vcb.png" alt="" style="width: 100%;">
            </div>
            <br> <br>
            <div style="width: 70%; float: left;">
            	<br>
                <h3 class="cangiua">GIẤY ĐỀ NGHỊ MỞ TÀI KHOẢN CÁ NHÂN</h3>
                <h3 class="cangiua">VÀ PHÁT HÀNH THẺ LIÊN KẾT SINH VIÊN</h3>
                <br>
                <br>
                
            </div>
            <div class="cangiua" style=" float: left; margin-bottom: 5px;"> <b><i style="margin-left: 100px;">Kính gửi: Ngân hàng TCMP Ngoại Thương Việt Nam - Chi nhánh Hoàn Kiếm</i></b><br></div>
            <div>
                <br>
                <h4 style="float:left; text-align: center;">THÔNG TIN VỀ KHÁCH HÀNG</h4>
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
                    Ngày sinh <b>{$sinhvien_in.ngaysinh}</b>
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
                            <input type="checkbox" checked="" disabled="">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div style="float: left;">
                        <label class="container">Không
                            <input>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div style="width:50%; text-align: right;">
                    <div style="float: left;">
                        <label class="container">Độc thân
                            <input type="checkbox" disabled="" checked="">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div style="float: left;">
                        <label class="container">Có gia đình
                            <input>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div style="float: left;">
                        <label class="container">Li dị
                            <input>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div style="float: left;">
                        <label class="container">Góa
                            <input>
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
                            <input type="checkbox" disabled="" {if $sinhvien_in.gioitinh == "Nam"} checked{/if}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div style="float: left;">
                        <label class="container">Nữ
                            <input type="checkbox" disabled="" {if $sinhvien_in.gioitinh == "Nữ"} checked{/if}>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div style="width: 35%;">
                    <div style="float: left;">
                        <label class="container">Sau đại học
                            <input>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div style="float: left;">
                        <label class="container">Đại học
                            <input type="checkbox" disabled="" checked="">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="cachdongp2">
                <div style="width:65%;">
                    <div style="float: left;">
                        <label class="container">CMND/Thẻ căn cước công dân
                            <input type="checkbox" disabled="" checked="">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div style="float: left;">
                        <label class="container">Hộ chiếu
                            <input>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div style="width: 35%;">
                    <div style="float: left; margin-right: 10px;">
                        <label class="container">Cao đẳng
                            <input >
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div style="float: left;">
                        <label class="container">THPT,Trung cấp
                            <input>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="cachdongp2">
                <div style="width:65%;">
                    Số:<b>{$sinhvien_in.CMND}</b> Ngày cấp: <b>{$sinhvien_in.ngaycapcmnd}</b>
                </div>
                <div style="width: 35%;">
                    &nbsp;<b>Nghề nghiệp</b>
                </div>
            </div>
            <div class="cachdongp2">
                <div style="width:65%;">
                    Nơi cấp:  <b>{$sinhvien_in.noicapcmnd}</b> 
                </div>
                <div style="width: 35%;">
                    <div style="float: left;">
                        <label class="container">Sinh viên
                            <input type="checkbox" disabled="" checked="">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="cachdongp2">
                <div style="width:65%;">
                    Địa chỉ thường chú: {$sinhvien_in.diachi}
                </div>
                <div style="width: 35%;">
                    <div style="float: left;">
                        <label class="container">Học viên
                            <input>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="cachdongp2">
                <div style="width:65%;">
                    Điện thoại di động: {$sinhvien_in.sdt} -  Email : {$sinhvien_in.email}
                </div>
                <div style="width: 35%;">
                    <div style="float: left;">
                        <label class="container">Khác
                            <input>
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
                            <input>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div style="float: left;">
                        <label class="container">Không
                            <input type="checkbox" checked="" disabled="">
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
                            <input>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div style="float: left;">
                        <label class="container">Không
                            <input type="checkbox" checked="" disabled="">
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
                            <input>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div style="float: left;">
                        <label class="container">Không
                            <input type="checkbox" checked="" disabled="">
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
                            <input>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div style="float: left;">
                        <label class="container">Không
                            <input type="checkbox" checked="" disabled="">
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
                            <input>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div style="float: left;">
                        <label class="container">Không
                            <input type="checkbox" checked="" disabled="">
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
                            <input>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div style="float: left;">
                        <label class="container">Không
                            <input type="checkbox" checked="" disabled="">
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
                            <input>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div style="float: left;">
                        <label class="container">Không
                            <input type="checkbox" checked="" disabled="">
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
                            <input type="checkbox" checked="" disabled="">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div style="float: left;">
                        <label class="container">USD
                            <input >
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
            <h4>YÊU CẦU PHÁT HÀNH THẺ LIÊN KẾT SINH VIÊN </h4>
            <div class="cachdongp2"></div>
            <div class="cachdongp2"></div>
            <div class="cachdongp2">
                <b>Tên chủ thẻ </b>(in trên thẻ, tối đa 20 ký tự hoa): &nbsp;<b>{$sinhvien_in.hoten}</b>
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
                            <input type="checkbox" checked="" disabled="">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div style="width:50%;">
                    <div style="float: left;">
                        <label class="container">Dịch vụ Ngân hàng qua tin nhắn di động (VCB-SMS B@nking) (Miễn phí 3 tháng)
                            <input type="checkbox" checked="" disabled="">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="cachdongp2">
                <div style="width:50%;">
                    <div style="float: left;">
                        <label class="container">Dịch vụ thanh toán trên điện thoại di động cho thuê bao Viettel (Mobile BankPlus) (Miễn phí 1 năm)
                            <input type="checkbox" checked="" disabled="">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
                <div style="width:50%;">
                    <div style="float: left;">
                        <label class="container">Dịch vụ Ngân hàng trực tuyến (VCB-iB@nking)
                            <input type="checkbox" checked="" disabled="">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
        </page>
        <page size="A4">
            <br><br><br><br><br><br><br><br><br><br><br><br><br>
            <div class="cachdong">
                <div style="width:100%;">
                    <div style="float: left;">
                        <label class="container">
                            <h4>THANH TOÁN HỌC PHÍ ĐỊNH KÌ </h4>
                            <input type="checkbox" checked="" disabled="">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="cachdong">
                Tôi đề nghị Vietcombank cung cấp dịch vụ Thanh toán học phí qua hình thức khẩu trừ tài khoản tự động và ủy quyền cho Vietcombank - Chi nhánh Hoàn Kiếm, khi đến kì thu học phí Trường Đại học Mở Hà Nội thông báo, tự động trích Nợ tài khoản tiền gửi số.............................................của tôi mở tại NHNT - Chi nhánh Hoàn Kiếm để thanh toán học phí theo các yêu cầu như sau:
            </div>
            <div class="cachdong">
                - Họ và tên sinh viên/học sinh:&nbsp;&nbsp;<b>{$sinhvien_in.hoten}</b>
            </div>
            <div class="cachdong">
                - Mã khách hàng:......................................................................................
            </div>
            <div class="cachdong">
                - Địa chỉ: &nbsp;&nbsp;<b>{$sinhvien_in.diachi}</b>
            </div>
            <div class="cachdong">
                <div style="float:left; "><span>- Đơn vị thụ hưởng:</span></div>
                <div style="float: left;">
                    <label class="container"><b>Trường Đại học Mở Hà Nội</b>
                        <input type="checkbox" checked="" disabled="">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="cachdong">
                - Số tiền thanh toán: Số tiền học phí theo yêu cầu từ Trường học + Phí dịch vụ (nếu có)
            </div>
            <div class="cachdong">
                - Thời gian ủy quyền: Từ ngày &nbsp;<b>01/09/{date('Y')}&nbsp;</b>đến ngày <b>&nbsp;30/06/{date('Y') + 4}</b>
            </div>
            <div class="cachdong">
                <h4>CAM KẾT CỦA KHÁCH HÀNG</h4>
            </div>
            <div class="cachdong">
                1. Tôi cam đoan mọi thông tin đưa ra tại đều đầy đủ và trung thực. Đề nghị Ngân hàng TMCP Ngoại Thương Việt Nam (Vietcombank) mở tài khoản và cung cấp các dịch vụ mà tôi đã đăng kí ở trên
            </div>
            <div class="cachdong">
                2. Tôi thừa nhận là đã nhận được Qui định, Hợp đồng áp dụng cho việc mở, quản lý và sử dụng tài khoản cũng như các dịch vụ đăng ký ở trên và đã đọc, hiểu rõ và cam kết tuân thủ mọi điều kiện, điều khoản
            </div>
            <div class="cachdong">
                3. Tôi cam kết và chịu trách nhiệm quản lý và sử dụng tài khoản theo các quy định cụ thể của Vietcombank, qui chế của Ngân hàng Nhà nước Việt Nam và luật pháp của nước Cộng hòa xã hội chủ nghĩa Việt Nam.
            </div>
            <div class="cachdong">
                <h4>CHỮ KÍ MẪU</h4>
            </div>
            <div class="cachdong">
                <div style="width:50%;">
                    <br>
                    <b class="text-center" style="padding-left: 113px">Chữ ký mẫu thứ nhất</b>
                </div>
                <div style="width:50%;">
                    <br>
                    <div style="float: left;" class="cangiua">
                        <b class="text-center" style="padding-left: 113px">Chữ ký mẫu thứ hai</b>
                    </div>
                </div>
            </div>
            <div class="cachdong">
                <div style="width:50%;">
                    <br>
                    <div style="width: 257px;height: 120px;border: 1px dotted black; margin-left: 70px; ">

                    </div>
                </div>
                <div style="width:50%;">
                    <br>
                    <div style="width: 257px;height: 120px;border: 1px dotted black; margin-left: 70px; ">

                    </div>
                </div>
            </div>
            <div class="cachdong">
                <div style="width:50%;">

                </div>
                <div style="width:50%;">
                    <br>
                    <div style="float: left; padding-left: 100px" class="cangiua">
                        <b>Ngày {date('d')} tháng {date('m')} năm {date('Y')}</b>
                    </div>
                </div>
            </div>
            <div class="cachdong">
                <div style="width:50%;  ">
                    <br>
                    <h4>THÔNG TIN SINH VIÊN </h4>
                </div>
                <div style="width:50%;">
                    <br>
                    <div style=" padding-left: 130px; ">
                        <h4>XÁC NHẬN CỦA TRƯỜNG</h4>
                    </div>
                </div>
            </div>
            <div class="cachdong">
                <div style="width:50%; ">
                    <b>Tên trường:</b>Trường Đại học Mở Hà Nội
                </div>
                <div style="width:50%; padding-left: 221px;">
                    <b>Ngày {date('d')} tháng {date('m')} năm {date('Y')}</b>
                </div>
            </div>
            <div class="cachdong">
                <div style="width:50%; ">
                    <b>Lớp:</b>..................................
                </div>
                <div style="width:50%; padding-left: 172px;">
                    (Ký tên, đóng dấu)
                </div>
            </div>
            <div class="cachdong">
                <b>Khoa:</b>&nbsp;{$danhmuc['nganh'][$sinhvien_in.FK_sMaNganh]}
            </div>
            <div class="cachdong">
                <b>Ngành học:</b>&nbsp;{$danhmuc['khoa'][$sinhvien_in.FK_sMaNganh]['tenkhoa']}
            </div>
            <div class="cachdong">
            	{if $sinhvien_in.FK_sMaNganh == 15 || $sinhvien_in.FK_sMaNganh == 63 || $sinhvien_in.FK_sMaNganh == 62 || $sinhvien_in.FK_sMaNganh == 61}
                	<b>Khóa học:</b> &nbsp;{date('Y')} - {date('Y') + 5}
            	{else}
                	<b>Khóa học:</b> &nbsp;{date('Y')} - {date('Y') + 4}
            	{/if}
            </div>
            <div class="cachdong">
                <b>Mã sinh viên:</b>{$sinhvien_in.masv}
            </div>
            <div class="cachdong">
                <div style="width:50%; ">
                </div>
                <div style="width:50%; padding-left: 172px;">
                    <h4>BỘ PHẬN TIẾP NHẬN VÀ XỬ LÝ</h4>
                </div>
            </div>
            <div class="cachdong">
                <div style="width:50%; ">
                </div>
                <div style="width:50%; padding-left: 125px;">
                    Cán bộ tiếp nhận &nbsp;Cán bộ xử lý &nbsp; Vietcombank
                </div>
            </div>
            <div class="cachdong">
                <h4>PHẦN DÀNH CHO NGÂN HÀNG </h4>
            </div>
            <div class="cachdong"><b>Số HSKH:</b>.................................................................... </div>
            <div class="cachdong"><b>Số TK VNĐ:</b>................................................................. </div>
            <div class="cachdong"><b>Số TK NT:</b>.................................................................... </div>
            <div class="cachdong">
                <div style="width:60%; ">
                    <b>Tên truy cập:</b>...............................................................
                </div>
                <div style="width:40%; padding-left: 0; float: right;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Họ tên &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Họ tên &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Họ tên
                </div>
            </div>
            <div class="cachdong">
                <div style="width:67%; ">
                    <b>Hiệu lực từ ngày:</b>:..........................................................
                </div>
                <div style="width:33%; padding-left: 0; float: right;">
                    Ngày........./........../...........
                </div>
            </div>
        </page>
</body>
<script type="text/javascript">
	window.print();
	window.onafterprint = function() {
		// window.close();
	};
</script>
</html>
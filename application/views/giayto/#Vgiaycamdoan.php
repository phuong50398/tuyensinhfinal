<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> IN GIẤY CAM ĐOAN</title>
<style>
	body {
			line-height: 1;
		  	font-family: arial;
		}
		h3{
			margin: 0 0 5px 0;
		}
		h4{
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
		      size: A4; /* DIN A4 standard, Europe */
		      margin-top:0 10px 0 10px !important;
		    }
		  body, page {
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
		  line-height:1.5em;
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
.container:hover input ~ .checkmark {
}

/* When the checkbox is checked, add a blue background */
.container input:checked ~ .checkmark {
}

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
		.cangiua
		{
			text-align: center;
		}	
		.tieude
		{

		}
		.canphai
		{
			text-align: right;
		}
		.cantrai
		{
			text-align: left;
		}
		.cachdong
		{
 			display: inline-block;
 			margin-bottom:5px;
 			display: flex; 
 			width: 100%;
		}
		.cachdongp2
		{
 			display: inline-block;
 			margin-bottom:3.5px;
 			display: flex; 
 			width: 100%;
		}
	</style>
</html>
    <page size="A4">
		<h3 class="cangiua">CỘNG HOÀ XÃ HỘI CHỦ NGHĨA VIỆT NAM </h3>
		<h3 class="cangiua">Độc lập – Tự do – Hạnh phúc</h3>
		<br> <br> <br>
		<h2 class="cangiua">GIẤY CAM ĐOAN</h2>
		<div class="cachgiua">
			Kính gửi: <b>Hội đồng tuyển sinh Trường Đại học Mở Hà Nội </b> 
		</div>
		<div class="cachdong">
			<div style="width:100%; ">
				<div >
					<br>
				Họ và tên tôi là: <b>{$sinhvien_in.hoten}</b>
				</div>
				<div >
					<br>
				Giới tính: <b>{$sinhvien_in.gioitinh}</b>
				</div>
				<div >
					<br>
				Ngày sinh: <b>{date('d/m/Y', strtotime({$sinhvien_in.ngaysinh}))} </b>
				</div>
				<div >
					<br>
				Số CMTND: <b>{$sinhvien_in.CMND}  </b>
				</div>
				<div >
					<br>
				Điện thoại: <b>{$sinhvien_in.sdt}  </b>
				</div>
				<div>
					<br>
				SBD: <b>{$sinhvien_in.soBD}   </b>
				</div>
				<div >
					<br>
				Địa chỉ Email:  {$sinhvien_in.email} <b></b>
				</div>
				<div >
					<br>
				Thí sinh Khoa (Ngành): {$danhmuc['khoa'][$sinhvien_in.FK_sMaNganh]['tenkhoa']}<b></b>
				</div>
				<div >
					<br>
				
				</div>
			</div>
		<div class="cachdong">
			
		</div>


			<div style="width:35%; height: 100%; padding-left: 0; float: right;">
				<img src="{base_url()}public/sinhvien/{$sinhvien_in.soBD}.jpg" alt="" width="100%">
					<p class="text-center"><b>MHN.{$sinhvien_in.soBD}</b></p>
				
			</div>
		</div>
		<div class="cangiua">
			<h2>Danh sách hồ sơ còn thiếu</h2>
		</div>
		{foreach $hoso as $key => $val}
		<!-- // mạnh hùng inline -->
			<div  style="width: 50%;float: left;margin-bottom: 10px;margin-top: 5px;"> 
				<div style="width: 90%;float: left; font-size: 14px;">{$key+1}. <b>{$dshs[$val.mahs]}</b></div>
				<div class="xbox-checkbox checkbox-example" style="width: 6%; float: left;margin-bottom: 10px;">
					<img src="{base_url()}public/images/uncheck.png" width="100%">
				</div>
			</div>
		{/foreach}
		<div class="cachdong">
				Trước ngày 30/09/{date('Y')}. Nếu sai tôi xin chịu trách nhiệm trước HĐTS Trường ĐH Mở Hà Nội (Xóa tên khỏi danh sách trúng tuyển)
		</div>
		<div class="cachdong">
			<div style="width:55%; float: right;"></div>
			<div style="width:45%; float: right;">
				<br> <br>
				<i>Hà Nội, ngày {date('d')} tháng {date('m')} năm {date('Y')} </i>
			</div>
		</div>
		<div class="cachdong">
			<div style="display: flex; width: 100%;">
				<div  style="width: 50%;">
				</div> 
				<div  style="width: 50%;">
					<p class="cangiua"><b>Thí sinh</b></p>
				</div>
			</div>
		</div>
		<br> <br> <br> <br> <br>
		<div class="cachdong">
			<div style="display: flex; width: 100%;">
				<div  style="width: 50%;">
				</div> 
				<div  style="width: 50%;">
					<p class="cangiua"><b>{$sinhvien_in.hoten}</b></p>
				</div>
			</div>
		</div>
	</page>
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script type="text/javascript">
        jQuery(document).ready(function() {
            window.print();
            dscheck_hs = ""
            soBD = "";
            $.ajax({
                url: window.location.pathname,
                type: 'post',
                data: {
                    'action': 'save_hssv',
                    'dscheck_hs': dscheck_hs,
                    'soBD': soBD
                },
                success: function(data) {
                    // $('paper-button.action-button').click();
                }
            });
            window.onafterprint = function() {
            	window.close();
            };
        });
    </script>
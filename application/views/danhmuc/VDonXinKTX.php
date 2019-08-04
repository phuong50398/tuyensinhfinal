<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ĐƠN ĐỀ NGHỊ THUÊ NHÀ Ở SINH VIÊN</title>
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
		.anhhs{
			height: 211px; width: 160px;background: #f3f3f3;
		}
		@media print {
			@page {
				size: A4; /* DIN A4 standard, Europe */
				margin-top:0 10px 0 10px !important;

			}
			.anhhs{
				height: 211px; width: 160px;background: #f3f3f3;
			}
			body, page {
				margin: 0;
				/*box-shadow: 0;*/
			}
		}
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
		.paddingleft100{
			padding-left: 100px;
		}
		.paddingright100{
			padding-right: 100px;
		}
		.paddingleft50{
			padding-left: 50px;
		}
		.paddingleft50fontsize12{
			padding-left: 50px;
			font-size: 12px;
		}
		.paddingleft50fontsize14{
			padding-left: 50px;
			font-size: 14px;
		}
		.width250{
			width: 250px;
		}
		.marginleft155{
			margin-left: 155px;
		}
		.marginleft140{
			margin-left: 140px;
		}
	</style>
</html>
	<page size="A4">
		<br> <br> 
		<h3 class="cangiua">CỘNG HOÀ XÃ HỘI CHỦ NGHĨA VIỆT NAM </h3>
		<h3 class="cangiua">Độc lập – Tự do – Hạnh phúc</h3>
		<hr class="width250">
		<br> <br>
		<h2 class="cangiua">ĐƠN ĐỀ NGHỊ THUÊ NHÀ Ở SINH VIÊN</h2>
		<br><br>
		<p class="paddingleft100">Kính gửi: Ban Quản lý Vận hành Khu nhà ở sinh viên Pháp Vân . (1)</p>
		<br>
		<p class="paddingleft100">Tên tôi là: {$sinhvien.hoten} <span style="padding-left: 100px">(Nam/Nữ): {$sinhvien.gioitinh}</span></p>
		<p class="paddingleft100">CMTND số: {$sinhvien.CMND} <span style="padding-left: 30px"> cấp ngày: {$sinhvien.ngaycapcmnd} </span> <span style="padding-left: 30px">nơi cấp: {$sinhvien.noicapcmnd} </span></p>
		<p class="paddingleft100">Hộ khẩu thường trú: {$sinhvien.hokhau}</p>
		<p class="paddingleft100">Sinh viên, học sinh năm thứ: nhất <span style="padding-left: 30px">lớp:......... </span><span style="padding-left: 30px"> khóa: 
			{if $sinhvien.makhoa == 10 || $sinhvien.makhoa == 6}
			 {date('Y',time())}  - {date('Y',time())+5}
			 {else}
			 {date('Y',time())}  - {date('Y',time())+4} 
			 {/if}
			</span>
		</p>
		<p class="paddingleft50">ngành (khoa): {$sinhvien.sTen_Nganh}<span style="padding-left: 30px"> Trường: Đại học Mở Hà Nội </span> </p>
		<p class="paddingleft100">Số thẻ sinh viên, học sinh (nếu có): {$sinhvien.masv}</p>
		<p class="paddingleft100">Đối tượng ưu tiên (nếu có) (2): {$sinhvien.doituong}</p>
		<p class="paddingleft100">Tôi làm đơn này đề nghị: Ban QLVH Khu nhà ở xét duyệt cho tôi được thuê nhà ở </p>
		<p class="paddingleft50">tại Khu nhà ở sinh viên Pháp Vân - Tứ Hiệp.</p>
		<p class="paddingleft100">Tôi đã đọc Bản nội quy sử dụng nhà ở sinh viên và cam kết tuân thủ nội quy sử </p>
		<p class="paddingleft50">dụng nhà ở sinh viên; cam kết trả tiền thuê nhà đầy đủ, đúng thời hạn khi được thuê nhà ở.</p>
		<p class="paddingleft100">Tôi cam đoan những lời kê khai trong đơn là đúng sự thật, tôi xin chịu trách nhiệm </p>
		<p class="paddingleft50">trước pháp luật về các nội dung đã kê khai.</p>
		<p class="canphai paddingright100"><i>Hà Nội, ngày {date('d',time())} tháng {date('m',time())} năm {date('Y',time())}</i></p>
		<p class="paddingleft100"><b>Xác nhận của cơ sở đào tạo(3) <span class="marginleft155">Người viết đơn</span></b></p>
		<p class="paddingleft50fontsize14"><i>(Ký, ghi rõ họ tên, chức vụ người ký, đóng dấu) <span class="marginleft140">(Ký và ghi rõ họ tên)</span></i></p>
		<br><br><br> <br>  <br>
		<p style="padding-left: 495px;
    font-size: 18px;"> {$sinhvien.hoten}</p>
		 <br> 
		<p class="paddingleft50fontsize12">(1) Ghi tên đơn vị quản lý vận hành nhà ở sinh viên;</p>
		<p class="paddingleft50fontsize12">(2) Ghi rõ thuộc đối tượng ưu tiên quy định tại khoản 1, khoản 2, Điều 9 Quy chế quản lý sử dụng, vận hành khai thác nhà ở sinh </p>
		<p class="paddingleft50fontsize12">viên trên địa bàn thành phố Hà Nội ban hành kèm theo Quyết định số 29/2013/QĐ-UBND ngày 01/8/2013 của UBND Thành phố</p>
		<p class="paddingleft50fontsize12">(3) Xác nhận là sinh viên thuộc trường và thuộc đối tượng ưu tiên quy định tại Khoản 1, Khoản 2 Điều 9 Quy chế quản lý sử dụng, </p>
		<p class="paddingleft50fontsize12">vận hành khai thác nhà ở sinh viên trên địa bàn thành phố Hà Nội ban hành kèm theo Quyết định số 29/2013/QĐ-UBND ngày </p>
		<p class="paddingleft50fontsize12">01/8/2013 của UBND Thành phố</p>
	</page>
	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script type="text/javascript">
            window.print();
        window.onafterprint = function(){
		        location.href= window.location.origin+window.location.pathname+"?sbd="+{$sinhvien.soBD};
		  }
    </script>
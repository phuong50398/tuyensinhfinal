<div class="container">
	<!-- Tìm kiếm số bàn hiện tại -->
	<div class="col-md-12">
		<div class="form-group">
			<div class="col-md-4">
			</div>
			<div class="col-md-4">
			</div>
		</div>
	</div> <!-- END Tìm kiếm số bàn hiện tại -->
</div>
<br> 
<h1 class="text-center thongtin_sv"><b>DANH SÁCH SINH VIÊN ĐANG CHỜ NHẬN NỘP HỒ SƠ</b></h1>
<br> <br>
<div class="container">
	<!-- Hiển thị danh sách sinh viên tại bàn đó  -->
	<div class="col-md-12">
		<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="thongtin_sv kevien">STT</th>
					<th class="thongtin_sv kevien">HỌ TÊN</th>
					<th class="thongtin_sv kevien text-center">NGÀY SINH</th>
				</tr>
			</thead>
			<tbody id="tbody">
				
			</tbody>
		</table>
	</div><!-- END Hiển thị danh sách sinh viên tại bàn đó  -->
</div>
<style>
	.thongtin_sv{
		font-size: 46px;
	}
	body{
		background-color: #fff;
	}
	.kevien{
		border: 1px solid #000 !important;
	}
	h2{
		-webkit-animation: color-change 1s infinite;
		-moz-animation: color-change 1s infinite;
		-o-animation: color-change 1s infinite;
		-ms-animation: color-change 1s infinite;
		animation: color-change 1s infinite;
	}

	@-webkit-keyframes color-change {
		0% { color: red; }
		50% { color: blue; }
		100% { color: red; }
	}
	@-moz-keyframes color-change {
		0% { color: red; }
		50% { color: blue; }
		100% { color: red; }
	}
	@-ms-keyframes color-change {
		0% { color: red; }
		50% { color: blue; }
		100% { color: red; }
	}
	@-o-keyframes color-change {
		0% { color: red; }
		50% { color: blue; }
		100% { color: red; }
	}
	@keyframes color-change {
		0% { color: red; }
		50% { color: blue; }
		100% { color: red; }
	}
</style>
<script>
	$( ".menutop" ).hide();
	load();
	function load(){
		$.ajax({
			url : window.location.pathname,
			type:'post',
			data:{
				'action' : 'manhinh_thuhoso',
			},
			success:function(data){
				data = JSON.parse(data);
				html ="";
				$.each(data, function(index,el){
					html += '<tr>';
					html += '<td class="thongtin_sv kevien text-center">'+el['stt']+'</td>';
					html += '<td class="thongtin_sv kevien">'+el['hoten']+'</td>';
					html += '<td class="thongtin_sv kevien text-center ">'+el['ngaysinh']+'</td>';
					html += '</tr>';
				});
				$('#tbody').html(html);
			},
			complete: function () {
				setTimeout(load, 4567);
			}
		});
	}
</script>
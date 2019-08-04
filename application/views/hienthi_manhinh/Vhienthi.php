<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
<div class="container">
	<!-- Tìm kiếm số bàn hiện tại -->
	<div class="col-md-12">
		<div class="form-group">
			<div class="col-md-4">
			</div>
			<button class="btn btn-primary text-center" name="hienthi"><i class="glyphicon glyphicon-search"> </i> Hiển thị</button>
			<div class="col-md-4">
				<div class="row">
					<form action="" method="post">
						<div class="input-group">
						</div>
						<div class="checkbox" style="float: left;">
							<input type="checkbox" id="optinosCheckbox1"  name="ban1" value="" class="ban">
							<label for="optinosCheckbox1">
								Bàn 1
							</label>
						</div>
						<div class="checkbox" style="float: left;">
							<input type="checkbox" id="optinosCheckbox2"  name="ban2" value="" class="ban">
							<label for="optinosCheckbox2">
								Bàn 2
							</label>
						</div>
						<div class="checkbox" style="float: left;">
							<input type="checkbox" id="optinosCheckbox3"  name="ban3" value="" class="ban">
							<label for="optinosCheckbox3">
								Bàn 3
							</label>
						</div>
						<div class="checkbox" style="margin-left: 5px;">
							<input type="checkbox" id="optinosCheckbox4"  name="ban4" value="" class="ban">
							<label for="optinosCheckbox4">
								Bàn 4
							</label>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> <!-- END Tìm kiếm số bàn hiện tại -->
</div>
<br> 
<h1 class="text-center thongtin_sv"><b>DANH SÁCH SINH VIÊN ĐANG CHỜ NHẬN GIẤY BÁO</b></h1>
<br> <br>
<div class="container">
	<!-- Hiển thị danh sách sinh viên tại bàn đó  -->
	<div class="col-md-12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="thongtin_sv kevien">STT</th>
					<th class="thongtin_sv kevien">HỌ TÊN</th>
					<th class="thongtin_sv kevien text-center">NGÀY SINH</th>
					<th class="thongtin_sv kevien text-center">BÀN</th>
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
		background-color: #e6f7ff;
	}
	.kevien{
		border: 1px solid #000 !important;
	}
	.checkbox+.checkbox {
		margin-top: 10px;
		margin-right: 16px;
	}
	.checkbox {
		input {
			&:checked {
				+ label {
					&::before {
						border-color: @theme-color;
						background-color: @theme-color;
					}
					&::after {
						content: "\f00c";
						font-family: FontAwesome;
						font-size: @font-size;
						color: #fff;
						top: 0;
						left: 1px;
						border-color: transparent;
						background-color: transparent;
					}
				}
			}
		}
		label {
			&::before {
				border-radius: @border-radius-small;
			}
		}
	}
</style>
{literal}
<script>
	$( ".menutop" ).hide();
	var ban1;
	var ban2;
	var ban3;
	var ban4;
	$(document).on('change','.ban', function(){
			//bàn 1
			if ($('input[name="ban1"]').is(':checked')) {
				$('input[name="ban1"]').val("01");
			}
			else {
				$('input[name="ban1"]').val("");
			}
			//bàn 2
			if ($('input[name="ban2"]').is(':checked')) {
				$('input[name="ban2"]').val("02");
			}
			else {
				$('input[name="ban2"]').val("");
			}
			//bàn 3
			if ($('input[name="ban3"]').is(':checked')) {
				$('input[name="ban3"]').val("03");
			}
			else {
				$('input[name="ban3"]').val("");
			}
			//bàn 4
			if ($('input[name="ban4"]').is(':checked')) {
				$('input[name="ban4"]').val("04");
			}
			else {
				$('input[name="ban4"]').val("");
			}
			ban1 = $('input[name="ban1"]').val();
			ban2 = $('input[name="ban2"]').val();
			ban3 = $('input[name="ban3"]').val();
			ban4 = $('input[name="ban4"]').val();
		});
	load();
	function load(){
		$.ajax({
			url : window.location.pathname,
			type:'post',
			data:{
				'action' : 'checkne',
				'ban1'   : ban1,
				'ban2'   : ban2,
				'ban3'   : ban3,
				'ban4'   : ban4,
			},
			success:function(data){
				data = JSON.parse(data);
				html ="";
				$.each(data, function(index,el){
					html += '<tr>';
					html += '<td class="thongtin_sv kevien text-center">'+el['stt']+'</td>';
					html += '<td class="thongtin_sv kevien">'+el['hoten']+'</td>';
					html += '<td class="thongtin_sv kevien text-center ">'+el['ngaysinh']+'</td>';
					html += '<td class="thongtin_sv kevien text-center">'+el['soban']+'</td>';
					html += '</tr>';
				});
				$('#tbody').html(html);
				html = '';
				html +='<i class="glyphicon glyphicon-search"></i>Tìm kiếm';
				$('button[name="hienthi"]').html(html);	
				$( "tr:eq( 2 )").attr("class","border");
			},
			complete: function () {
				setTimeout(load, 4567);
			}
		});
	}

	$(document).on('click','button[name="hienthi"]', function(){
		html ="";
		html +='<i class="glyphicon glyphicon-search"></i>Tìm kiếm &nbsp; <i class="fa fa-spinner fa-spin"></i>';
		$(this).html(html);			
	});
	// });
</script>
{/literal}
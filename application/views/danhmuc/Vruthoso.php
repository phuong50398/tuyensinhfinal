<div class="container">
	<br>
	<form method="post">
		<div class="col-md-5" style="padding: 0;">
			<div class="form-group">
				<label>&nbsp;Số báo danh</label>
				<input type="text" name="sobaodanh" class="form-control" placeholder="Số báo danh..." >

			</div>
		</div>
		<div class="col-md-5">
			<div class="form-group">
				<br>
				<button type="submit" name="timkiem" value="timkiem" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Tìm kiếm</button>
			</div>
		</div>
		<div class="col-md-2">	
			<div class="form-group">
				<br>
			</div>
		</div>
	</form>
	<br> <br> <br> <br> 
	<p class="text-danger" id="nhapnhay">&nbsp;&nbsp;{if isset($notification)}{$notification}{/if}</p> <br>
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label>Số báo danh</label>
				<input type="text" name="sbd"  class="form-control"  value="{if !empty($data)}{$data.soBD}{/if}" readonly>
				<input type="hidden" name="masinhvien" value="{if !empty($data)}{$data.masv}{/if}">
				<input type="hidden" name="manganh" value="{if !empty($data)}{$data.FK_sMaNganh}{/if}">
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label>Họ và Tên</label>
				<input type="text" class="form-control" value="{if !empty($data)}{$data.hoten}{/if}" disabled="">
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label>Giới tính</label>
				<input type="text" class="form-control" value="{if !empty($data)}{$data.gioitinh}{/if}" disabled="">
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label>Ngày sinh</label>
				<input type="text" class="form-control" value="{if !empty($data)}{$data.ngaysinh}{/if}" disabled="">
			</div>
		</div>
	</div>
	<div class="row">
		{$sum = 0}
		{if !empty($data)}
		{foreach $getMon as $key => $val}
		<div class="col-md-3">
			<label for="">Môn {$tenmon[$key]}</label>
			<span><input type="text" disabled name="mon1" class="form-control" value="{$val}"></span>
		</div>
		{$sum = $sum +  $data[$key]}
		{/foreach}
		{else}
		<div class="col-md-3">
			<label for="">Môn 1</label>
			<span><input type="text" disabled name="mon1" class="form-control" ></span>
		</div>
		<div class="col-md-3">
			<label for="">Môn 2</label>
			<span><input type="text" disabled name="mon1" class="form-control" ></span>
		</div>
		<div class="col-md-3">
			<label for="">Môn 3</label>
			<span><input type="text" disabled name="mon1" class="form-control" ></span>
		</div>
		{/if}
		<div class="col-md-3">
			<div class="form-group">
				<label>Tổng điểm thi</label>
				<input type="text" class="form-control" value="{$sum}" disabled="">
			</div>
		</div>
	</div>
	<div class="row">
		{if !empty($data)}
		<div class="col-md-3">
			<label for="">Ngành trúng tuyển</label>
			<select disabled class="form-control">
				{foreach $nganhtrungtuyen as $ntt}
				<option value="{$ntt.iMa_nganh}" {if $data['FK_sMaNganh'] == $ntt.iMa_nganh} selected {/if}>{$ntt.sTen_Nganh}</option>
				{/foreach}
			</select>
		</div>
		{else}
		<div class="col-md-3">
			<label for="">Ngành trúng tuyển</label>
			<select disabled class="form-control"  disabled>
				<option value=""></option>  
			</select>
		</div>
		{/if}
		<div class="col-md-3">
			<div class="form-group">
				<label>CMND/Thẻ căn cước</label>
				<input type="text" class="form-control" value="{if !empty($data)}{$data.CMND}{/if}" disabled="">
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label>Đối tượng</label>
				<input type="text" class="form-control" value="{if !empty($data)}{$data.doituong}{/if}" disabled="">
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label>Khu vực</label>
				<input type="text" class="form-control" value="{if !empty($data)}{$data.khuvuc}{/if}" disabled="">
			</div>
		</div>
	</div>
</div>
<br> <br>
{if !empty($data)}
<form action="" method="post">
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				<p style="margin-bottom: 12px;">Các loại học phí</p>
				<hr>
				{if $data.FK_sMaNganh == 15 || $data.FK_sMaNganh == 63 || $data.FK_sMaNganh == 62 || $data.FK_sMaNganh == 61}
				<p class="tenhp">{$hocphi['hp2']}</p>
				{else}
				<p class="tenhp">{$hocphi['hp1']}</p>
				{/if}
				<p class="tenhp">{$hocphi['sk']}</p>
				<p class="tenhp">{$hocphi['the']}</p>
				<p class="tenhp">{$hocphi['yt']}</p>
				{if $data.FK_sMaNganh == 15 || $data.FK_sMaNganh == 63 || $data.FK_sMaNganh == 62 || $data.FK_sMaNganh == 61}
				<p class="tenhp">{$hocphi['tt2']}</p>
				{else}
				<p class="tenhp">{$hocphi['tt1']}</p>
				{/if}
				<p class="tenhp">Tổng</p>
			</div>
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-4">
						<p>Học phí đã nộp</p>
						<hr>
						<div class="form-group">
							{if $data.FK_sMaNganh == 15 || $data.FK_sMaNganh == 63 || $data.FK_sMaNganh == 62 || $data.FK_sMaNganh == 61}
							<input type="text" class="form-control hocphi" value="{number_format($hocphi_dadong['hp2'])}" readonly>
							{else}
							<input type="text" class="form-control hocphi" value="{number_format($hocphi_dadong['hp1'])}" readonly>
							{/if}
						</div>
						<div class="form-group">
							<input type="text" class="form-control suckhoe" value="{number_format($hocphi_dadong['sk'])}" readonly>
						</div>
						<div class="form-group">
							<input type="text" class="form-control the" value="{number_format($hocphi_dadong['the'])}" readonly>
						</div>
						<div class="form-group">
							<input type="text" class="form-control yte" value="{number_format($hocphi_dadong['yt'])}" readonly>
						</div>
						<div class="form-group">
							{if $data.FK_sMaNganh == 15 || $data.FK_sMaNganh == 63 || $data.FK_sMaNganh == 62 || $data.FK_sMaNganh == 61}
							<input type="text" class="form-control thanthe" value="{number_format($hocphi_dadong['tt2'])}" readonly>
							{else}
							<input type="text" class="form-control thanthe" value="{number_format($hocphi_dadong['tt1'])}" readonly> 
							{/if}
						</div>
						<div class="form-group">
							<input type="text" class="form-control tongtien_dadong" value="{number_format($hocphi_dadong['tongtien_thu'])}" readonly>
						</div>
					</div>
					<div class="col-md-4">
						<p>Học phí trả</p>
						<hr>
						<div class="form-group">
							{if $data.FK_sMaNganh == 15 || $data.FK_sMaNganh == 63 || $data.FK_sMaNganh == 62 || $data.FK_sMaNganh == 61}
							<input type="text" class="form-control hptra hocphitra hocphi" value="{if !empty($data)}{number_format($data.hp2_tra)}{/if}" name="hocphi_tra[hp2]">
							{else}
							<input type="text" class="form-control hptra hocphitra hocphi" value="{if !empty($data)}{number_format($data.hp1_tra)}{/if}" name="hocphi_tra[hp1]">
							{/if}
						</div>
						<div class="form-group">
							<input type="text" class="form-control hptra suckhoetra suckhoe" value="{if !empty($data)}{number_format($data.sk_tra)}{/if}" name="hocphi_tra[sk]">
						</div>
						<div class="form-group">
							<input type="text" class="form-control hptra thetra the" value="{if !empty($data)}{number_format($data.the_tra)}{/if}" name="hocphi_tra[the]">
						</div>
						<div class="form-group">
							<input type="text" class="form-control hptra ytetra yte" value="{if !empty($data)}{number_format($data.yt_tra)}{/if}" name="hocphi_tra[yt]">
						</div>
						<div class="form-group">
							{if $data.FK_sMaNganh == 15 || $data.FK_sMaNganh == 63 || $data.FK_sMaNganh == 62 || $data.FK_sMaNganh == 61}
							<input type="text" class="form-control hptra thanthetra thanthe" value="{if !empty($data)}{number_format($data.tt2_tra)}{/if}" name="hocphi_tra[tt2]">
							{else}
							<input type="text" class="form-control hptra thanthetra thanthe" value="{if !empty($data)}{number_format($data.tt1_tra)}{/if}" name="hocphi_tra[tt1]">
							{/if}
						</div>
						<div class="form-group">
							<input type="text" class="form-control hptra tongtra" readonly value="{if !empty($data)}{number_format($data.tongtra)}{/if}" name="hocphi_tra[tongtra]">
						</div>
					</div>
					<div class="col-md-4">
						<p>Học phí còn lại</p>
						<hr>
						<div class="form-group">
							{if $data.FK_sMaNganh == 15 || $data.FK_sMaNganh == 63 || $data.FK_sMaNganh == 62 || $data.FK_sMaNganh == 61}
							<input type="text" class="form-control hpcon conlai hocphicl" value="{if !empty($data)}{number_format($data.hp2_con)}{/if}" readonly name="hocphi_con[hp2]"> 
							{else}
							<input type="text" class="form-control hpcon conlai hocphicl" readonly value="{if !empty($data)}{number_format($data.hp1_con)}{/if}" name="hocphi_con[hp1]">
							{/if}
						</div>
						<div class="form-group">
							<input type="text" class="form-control skcon conlai suckhoecl" value="{if !empty($data)}{number_format($data.sk_con)}{/if}" readonly name="hocphi_con[sk]">
						</div>
						<div class="form-group">
							<input type="text" class="form-control thecon conlai thecl" value="{if !empty($data)}{number_format($data.the_con)}{/if}" readonly name="hocphi_con[the]">
						</div>
						<div class="form-group">
							<input type="text" class="form-control ytcon conlai ytecl" value="{if !empty($data)}{number_format($data.yt_con)}{/if}" readonly name="hocphi_con[yt]">
						</div>
						<div class="form-group">
							{if $data.FK_sMaNganh == 15 || $data.FK_sMaNganh == 63 || $data.FK_sMaNganh == 62 || $data.FK_sMaNganh == 61}
							<input type="text" class="form-control ttcon conlai thanthecl" value="{if !empty($data)}{number_format($data.tt2_con)}{/if}" readonly name="hocphi_con[tt2]">
							{else}
							<input type="text" class="form-control ttcon conlai thanthecl" value="{if !empty($data)}{number_format($data.tt1_con)}{/if}" readonly name="hocphi_con[tt1]">
							{/if}
						</div>
						<div class="form-group">
							<input type="text" class="form-control tongcon conlai" value="{if !empty($data)}{number_format($data.tongcon)}{/if}" readonly name="hocphi_con[tongcon]">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row text-center">
			<div class="row text-center">
				<div class="form-group">
					<div class="checkbox checkbox-primary" id="nut_chuaaj" >
						{if $data.trangthai < 5}
						<button type="button"  class="btn btn-success" value="xacnhan" name="xacnhan"><span class="glyphicon glyphicon-ok"></span>&nbsp;Xác nhận rút hồ sơ</button>
						{else}
						<div type="button"  style="font-size: 12px;" class="label label-warning"><span class="glyphicon glyphicon-ok"></span>&nbsp;Sinh viên này đã rút hồ sơ</div>
						{/if}
					</div>
					<div class=" checkbox checkbox-primary" id="nut_daaj" >
					</div>
					{if $session['maquyen']==1}
					<div class="huyruthoso">
						
					</div>
					{/if}
					{if $data.trangthai == 5 && $session['maquyen']==1}
						<button type="button"  class="btn btn-danger" onclick="confirm('Bạn có chắc Hủy hồ sơ này')" value="huyruthoso" name="huyruthoso">&nbsp;Hủy rút hồ sơ&nbsp;</button>
					{/if}
				</div>
			</div>
			<br>
		</div>
	</div>
</form>
<script type="text/javascript" src="{base_url()}public/js/simple.money.format.js"></script>
{/if}
<script>
	hp  = parseInt($('.hocphi').val().replace(/\,/g, ''));
	sk  = parseInt($('.suckhoe').val().replace(/\,/g, ''));
	the = parseInt($('.the').val().replace(/\,/g, ''));
	yt  = parseInt($('.yte').val().replace(/\,/g, ''));
	tt  = parseInt($('.thanthe').val().replace(/\,/g, ''));
	tongtien_dadong  = parseInt($('.tongtien_dadong').val().replace(/\,/g, ''));
	$(document).on('keyup', '.hptra', function() {
		$('.hptra').simpleMoneyFormat();
		hd = 0;
		classs = $(this).attr('class');
		classs = classs.split(" ");
		giatri = classs[3];
		tien = parseInt($('.'+ giatri).val().replace(/\,/g, ''));
		tongconlai = parseInt(tien) - parseInt($(this).val().replace(/\,/g, ''));
		tong = giatri + "cl";
		if(isNaN(tongconlai) || tongconlai<0){
			tongconlai = 0;
			$('.' + tong).val(tongconlai);
		}
		$('.' + tong).val(tongconlai);

		input = $('.conlai');
		tong = 0;
		let arr = [];
		for(var i = 0; i < input.length-1; i++) {
			arr.push({
				'giatri': parseInt(input[i].value.replace(/\,/g, ''))
			});
		}
		var sum = 0;
		for(var i = 0; i < arr.length; i++) {
			if(!isNaN(arr[i]['giatri'])) {
				sum += arr[i]['giatri'];
			}
		}
		$('.tongcon').val(sum);
		$('.tongcon').simpleMoneyFormat();


		// console.log(sum);
		// $('.tongcon').val(sum);
	    //
	    input_tra = $('.hptra');
	    tong = 0;
	    let arr_tra = [];
	    for(var i = 0; i < input_tra.length-1; i++) {
	    	arr_tra.push({
	    		'giatri': parseInt(input_tra[i].value.replace(/\,/g, ''))
	    	});
	    }
	    var sum_tra = 0;
	    for(var i = 0; i < arr.length; i++) {
	    	if(!isNaN(arr_tra[i]['giatri'])) {
	    		sum_tra += arr_tra[i]['giatri'];
	    	}
	    }
	    $('.tongtra').val(sum_tra);
	    $('.tongtra').simpleMoneyFormat();

	    // $('.hptra').simpleMoneyFormat();
	    $('.conlai').simpleMoneyFormat();
		 // $('.tongcon').attr('value',sum);
		});
	$(document).on('click','button[name="xacnhan"]', function(){
		masinhvien = $('input[name = "masinhvien"]').val();
		manganh    = $('input[name = "manganh"]').val();
		soBD 	   = $ ('input[name = "sbd"]').val();
		$.ajax({
			url : window.location.pathname,
			type:'post',
			data:{
				'action'  : 'ruthoso',
				data:{
					'masv'	  	    : masinhvien,
					'soBD'			: soBD,
					//
					'hp2_tra' 	    : $('input[name = "hocphi_tra[hp2]"]').val(),
					'hp1_tra' 	    : $('input[name = "hocphi_tra[hp1]"]').val(),
					'sk_tra' 	    : $('input[name = "hocphi_tra[sk]"]').val(),
					'the_tra'       : $('input[name = "hocphi_tra[the]"]').val(),
					'yt_tra'	    : $('input[name = "hocphi_tra[yt]"]').val(),
					'tt2_tra'        : $('input[name = "hocphi_tra[tt2]"]').val(),
					'tt1_tra'        : $('input[name = "hocphi_tra[tt1]"]').val(),
					'tongtra'       : $('input[name = "hocphi_tra[tongtra]"]').val(),
					//
					'hp2_con' 	    : $('input[name = "hocphi_con[hp2]"]').val(),
					'hp1_con' 	    : $('input[name = "hocphi_con[hp1]"]').val(),
					'sk_con' 	    : $('input[name = "hocphi_con[sk]"]').val(),
					'the_con'       : $('input[name = "hocphi_con[the]"]').val(),
					'yt_con'	    : $('input[name = "hocphi_con[yt]"]').val(),
					'tt2_con'        : $('input[name = "hocphi_con[tt2]"]').val(),
					'tt1_con'        : $('input[name = "hocphi_con[tt1]"]').val(),
					'tongcon'       : $('input[name = "hocphi_con[tongcon]"]').val(),
				}
			},
			success:function(data){
				data = JSON.parse(data);
				
				html = '';
				html = '<div type="button" style="font-size: 12px;"  class="label label-warning"><span class="glyphicon glyphicon-ok"></span>&nbsp;Sinh viên này đã rút hồ sơ</div>';
				$('#nut_chuaaj').hide();
				$('#nut_daaj').html(html);
				html ='';
				html = '<button type="button" onclick="confirm("Bạn có chắc Hủy hồ sơ này")"  class="btn btn-danger" value="huyruthoso" name="huyruthoso">&nbsp;Hủy rút hồ sơ</button>';
				$('.huyruthoso').html(html);
				$('button[name = "huyruthoso"]').show();
				toastr.success(data['notification']);
			},
		});
	});
	$(document).on('click','button[name="huyruthoso"]', function(){
		masinhvien = $('input[name = "masinhvien"]').val();
		soBD 	   = $ ('input[name = "sbd"]').val();
		$.ajax({
			url : window.location.pathname,
			type:'post',
			data:{
				'action'  : 'huyruthoso',
				data:{
					'masv'	  	    : masinhvien,
					'soBD'			: soBD,
				}
			},
			success:function(data){
				data = JSON.parse(data);
				toastr.success(data['notification']);
				$('.huyruthoso').hide();
				$('#nut_chuaaj').hide();
				$('button[name = "huyruthoso"]').hide();
				html = '';
				html = '<button type="button"  class="btn btn-success" value="xacnhan" name="xacnhan"><span class="glyphicon glyphicon-ok"></span>&nbsp;Xác nhận rút hồ sơ</button>';
				$('#nut_daaj').html(html);
			},
		});
	});
</script>
<style>
	p.tenhp {
		margin-bottom: 31px;
	}
	#nhapnhay{
		color: red;
	/*	-webkit-animation: color-change 1s infinite;
		-moz-animation: color-change 1s infinite;
		-o-animation: color-change 1s infinite;
		-ms-animation: color-change 1s infinite;
		animation: color-change 1s infinite;*/
	}

	@-webkit-keyframes color-change {
		0% { color: red; }
		14% { color: orange}
		28% { color: yellow; }
		42% { color: green; }
		56% { color: blue; }
		70% { color: indigo; }
		100% { color: violet; }
	}
	@-moz-keyframes color-change {
		0% { color: red; }
		14% { color: orange}
		28% { color: yellow; }
		42% { color: green; }
		56% { color: blue; }
		70% { color: indigo; }
		100% { color: violet; }
	}
	@-ms-keyframes color-change {
		0% { color: red; }
		14% { color: orange}
		28% { color: yellow; }
		42% { color: green; }
		56% { color: blue; }
		70% { color: indigo; }
		100% { color: violet; }
	}
	@-o-keyframes color-change {
		0% { color: red; }
		14% { color: orange}
		28% { color: yellow; }
		42% { color: green; }
		56% { color: blue; }
		70% { color: indigo; }
		100% { color: violet; }
	}
	@keyframes color-change {
		0% { color: red; }
		14% { color: orange}
		28% { color: yellow; }
		42% { color: green; }
		56% { color: blue; }
		70% { color: indigo; }
		100% { color: violet; }
	}
</style>

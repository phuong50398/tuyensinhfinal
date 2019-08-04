<div class="container phieuthudiem">
	<br>
	<form method="post">
		<div class="col-md-5">
			<div class="form-group">
				<label>Số báo danh</label>
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
				<label>Mã số cấp</label>
				<br>
				<input type="text" name="masocap" value="{if !empty($data)}{$data.sohs_nh}{/if}" class="form-control" autocomplete="off" disabled>
			</div>
		</div>
	</form>	
	<p class="text-danger">&nbsp;&nbsp;{if isset($notification)}{$notification}{/if}</p>
	<form method="post">
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label>Số báo danh</label>
					<input type="text" name="sbd"  class="form-control"  value="{if !empty($data)}{$data.soBD}{/if}" readonly>
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
					<label>CMND</label>
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
		<div class="row daxacnhan">
			{if !empty($data)}
				{if !empty($data.nguoithu_phieudiem) && !empty($data.thoigian_thuphieudiem) && $data.trangthai > 0}
					{if $data.buoctiep  == "buoc2"}
						<div class="col-md-12 text-center chuyentiep" style="margin:20px 0;">
						<p class="label label-success" style="font-size: 18px;">Xin mời bạn đến  {$tenban[$data['ban']]} với số thứ tự {$data.stt} để nhận giấy báo và chờ nhập thông tin.</p>
						</div>
					{else}
						{if $data.buudien  == 1 || $data.buoctiep  == null}
							<div class="col-md-12 text-center chuyentiep" style="margin:20px 0;">
								<button type="button" class="btn btn-warning" value="chuyentiep" name="chuyentiep"><i class="fa fa-share" aria-hidden="true"></i>&nbsp;Chuyển tiếp</button>
							</div>
						{/if}
					{/if}
					<div class="col-md-12">
						<h4 style="color:#ec0d0d;">Người thu phiếu điểm: {$canbo[$data.nguoithu_phieudiem]}</h4>
						<h4 style="color:#ec0d0d;">Thời gian thu phiếu điểm: {date('d/m/Y H:i:s', strtotime({$data.thoigian_thuphieudiem}))}</h4>
						<p class="label label-primary">Đã xác nhận</p>
					</div>
				{/if}
			{/if}
		</div>

		<div class="row text-center">
			<div class="row text-center">
			{if !empty($data)}
				{if empty($data.nguoithu_phieudiem) && empty($data.thoigian_thuphieudiem)}
				<div class="form-group">
					<div class="checkbox checkbox-primary">
						<input id="buudien" class="checkbox1" value="1" type="checkbox" name="buudien" {if isset($session['buudien'])} checked{/if}>
						<label for="buudien"><b>Bưu điện</b></label>
						&nbsp;&nbsp;&nbsp;
						<button type="button" class="btn btn-success" value="xacnhan" name="xacnhan"><span class="glyphicon glyphicon-ok"></span>&nbsp;Xác nhận</button>
					</div>
				</div>
				{/if}
			{/if}
		</div>
		<br>
	</form>
</div>
<style>
	.phieuthudiem{
		margin-top: 20px;
		box-shadow: 0px 0px 10px 0px #ccc;
		    /*background: ghostwhite;*/
	}
</style>
<script type="text/javascript">
	
	$(document).on('click','button[name="xacnhan"]', function(){
		sobaodanh = $('input[name="sbd"]').val();
		if($('input[name="buudien"]')[0].checked == true){
			buudien   = $('input[name="buudien"]').val();
		}else{
			buudien = '';
		}
		$.ajax({
			url : window.location.pathname,
			type:'post',
			data:{
				'action' : 'xacnhan',
				'sobd'   : sobaodanh,
				'buudien' : buudien,
			},
			success:function(data){
				data = JSON.parse(data);
				html = "";
				if (data['sinhvien'].buudien  == 1){ 
					html += '<div class="col-md-12">';
					html += '<h4 style="color:#ec0d0d;">Người thu phiếu điểm:'+ data['sinhvien']['nguoithu_phieudiem']+'</h4>';
					html += '<h4 style="color:#ec0d0d;">Thời gian thu phiếu điểm: '+ data['sinhvien']['thoigian_thuphieudiem']+'</h4>';
					html += '<p class="label label-primary">Đã xác nhận</p>';
					html += '</div>';
				}else{
					// html+= '<div class="col-md-12 text-center chuyentiep" style="margin:20px 0;">';
					// html+= '<button type="button" class="btn btn-warning" value="chuyentiep" name="chuyentiep"><i class="fa fa-share" aria-hidden="true"></i>&nbsp;Chuyển tiếp</button>';
					// html+= '</div>';

					html = '<div class="col-md-12 text-center chuyentiep" style="margin:20px 0;"><p class="label label-success" style="font-size: 18px;">Xin mời bạn đến bàn số '+data['ban']+' với số thứ tự '+ data['sinhvien']['stt']+' để chờ nhập thông tin.</p></div>';
					html += '<div class="col-md-12">';
					html += '<h4 style="color:#ec0d0d;">Người thu phiếu điểm: '+ data['sinhvien']['nguoithu_phieudiem']+'</h4>';
					html += '<h4 style="color:#ec0d0d;">Thời gian thu phiếu điểm: '+ data['sinhvien']['thoigian_thuphieudiem']+'</h4>';
					html += '<p class="label label-primary">Đã xác nhận</p>';
					html += '</div>';

					// $('.chuyentiep').html(tbao);
				}
				$('.daxacnhan').html(html);
				$('.checkbox-primary').remove();
				if(data['sinhvien'].buudien  == 1){
					toastr.success('Xác nhận thu phiếu điểm thành công!','Thông báo');
				}
			}
		});
	});
	$(document).on('click','button[name="chuyentiep"]', function(){
		sobaodanh = $('input[name="sbd"]').val();
		$.ajax({
			url : window.location.pathname,
			type:'post',
			data:{
				'action' : 'chuyentiep',
				'sobd'   : sobaodanh,
			},
			success:function(data){
				data = JSON.parse(data);
				$('button[name="chuyentiep"]').remove();
				html = '<p class="label label-success" style="font-size: 18px;">Xin mời bạn đến bàn số '+data['ban']+' với số thứ tự '+ data['stt']+' để chờ nhập thông tin.</p>';
				$('.chuyentiep').html(html);
				toastr.success('Xác nhận thu phiếu điểm thành công!','Thông báo');

			}
		});
	});
</script>
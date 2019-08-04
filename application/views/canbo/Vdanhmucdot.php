<div class="container" style="box-shadow: 0px 0px 10px 0px #ccc">
	<div class="container fixdisplay">
		<div class="panel panel-default">
			<div class="panel-heading text-left">
				<h5><b>Danh mục đợt sinh viên</b></h5>
			</div>
			<div class="panel-body">
				<form method="post">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>Tên đợt</label>
								<input type="text" name="data[tendot]" class="form-control" required="" value="{if !empty($dot)}{$dot.tendot}{/if}">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Thời gian</label>
								 <input type="text" class="form-control datepicker" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" value="{date('d/m/Y')}" name="data[thoigian]" autocomplete="off" value="{if !empty($dot)}{$dot.thoigian}{/if}">
							</div>
						</div>
						<div class="col-md-3">
							<label>Trạng thái</label>
							<div class="form-group">
								<label class="radio-inline">
									<div class="radio radio-primary">
										<input type="radio" value="active" checked="" name="data[trangthai]" id="acitve" {if !empty($dot) && $dot.trangthai == "active"}checked {/if}>
										<label for="acitve"> <b>acitve</b> </label>
									</div>
								</label>
								<label class="radio-inline">
									<div class="radio radio-primary">
										<input type="radio" value="" {if !empty($dot) && $dot.trangthai == ""}checked {/if} name="data[trangthai]" id="khong">
										<label for="khong"> <b>Không acitve</b> </label>
									</div>
								</label>
							</div>
						</div>
						<div class="col-md-3
						">
						<br>
						<input type="hidden" value="{if !empty($dot)}{$dot.id}{/if}" name="madot">
						<input type="submit" class="btn btn-primary" name="{if !empty($dot)}update{else} themdot{/if}" value="{if !empty($dot)}Sửa đợt{else} Thêm đợt{/if}">
					</div>
				</div>
			</form>
				<hr>
			<form method="post">
				<table class="table table-bordered table-hover">
					<thead>
						<th class="text-center">STT</th>
						<th>Tên đợt</th>
						<th>Thời gian</th>
						<th>Trạng thái</th>
						<th class="text-center">Tác vụ</th>
					</thead>
					<tbody>
						{foreach $dsdot as $key => $val}
							<tr>
								<td class="text-center"><b>{$key+1}</b></td>
								<td>{$val.tendot}</td>
								<td>{$val.thoigian}</td>
								<td>{$val.trangthai}</td>
								<td class="text-center">
									<button type="submit" class="btn btn-info" name="sua" value="{$val.id}">Sửa</button>
									<a href="{base_url()}Danh-muc-dot?xoadot={$val.id}" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa đợt này không?')">Xóa</a>
								</td>
							</tr>
						{/foreach}
					</tbody>
				</table>
			</form>
		</div>
	</div>
	<div class="panel-footer">
		<small> 
			<b>Phát triển và xây dựng bởi <span class="glyphicon glyphicon-heart" style="color: red;" aria-hidden="true"></span> Tổ phát triển Khoa CNTT - Trường Đại học Mở Hà Nội</b>
			<br>
		</small>
	</div>
</div>

</div>
<script type="text/javascript">
	$('.js-example-basic-multiple').select2();
	$('.datepicker').datepicker({
		format: 'dd/mm/yyyy',
		autoclose: true
	})
</script>
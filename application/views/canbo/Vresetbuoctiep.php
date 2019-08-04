<div class="container" style="margin-top: 50px">
	<center>
		<form action="" method="post" accept-charset="utf-8">
			<button type="submit" class="btn btn-warning btn-lg" name="resetbuoctiep" value="resetbuoctiep">RESSET BƯỚC TIẾP</button>
		</form>
	</center>
	
	<div class="col-md-4"></div>
	<div class="col-md-4" style="margin-top: 20px">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Bàn</th>
					<th>STT</th>
					<th>Gọi</th>
				</tr>
			</thead>
			<tbody>
				{foreach $goi as $k => $v}
				<tr>
					<td>{$v.ban}</td>
					<td>{$v.stt}</td>
					<td>{$v.goi}</td>
				</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
</div>
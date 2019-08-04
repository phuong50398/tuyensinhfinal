<div class="container-fluid fixdisplay" style="margin: 10px;">
    <div class="panel panel-default">
        <div class="panel-heading text-left">
            <h5><b>Tiếp đón và Điều hướng</b></h5>
        </div>
        <div class="panel-body" style="padding: 18px;">
             <div class="panel panel-warning" style="min-height: 400px">
                <div class="panel-body" style="padding: 15px;">
                    <div class="row">
                 		<form method="get">
                 			<div class="col-md-4">
	                 			<div class="input-group">
	                 				<input type="text" name="sobd" class="form-control" placeholder="Nhập số báo danh">
	                 				<span class="input-group-btn">
	                 					<input type="submit" name="timkiem" class="btn btn-warning" value="Tìm kiếm">
	                 				</span>
	                 			</div>
                 			</div>
                 			<div class="col-md-6">
                 				<button type="submit" name="tragiaybao" class="btn btn-info" value="{if !empty($data)}{$data['soBD']}{/if}"><i class="fa fa-share" aria-hidden="true"></i>&nbsp; 3. Trả giấy báo</button>
                 				<button type="submit" name="thuhoso" class="btn btn-primary" value="{if !empty($data)}{$data['soBD']}{/if}"><i class="fa fa-level-up" aria-hidden="true"></i>&nbsp; 5. Thu hồ sơ</button>
                 				<button type="submit" name="thutaichinh" class="btn btn-vk" value="{if !empty($data)}{$data['soBD']}{/if}"><i class="fa fa-level-up" aria-hidden="true"></i>&nbsp; 7. Thu tài chính</button>
                 			</div>
                 		</form>   	
                    </div>
                </div>
                 	<div class="panel-body" style="padding: 15px;">
	                    {if !empty($data)}
	                    <div class="row">
	                    	<div class="col-md-12 text-center">
	                    		<h1><span style="border-bottom: 1px solid red;">Thông tin sinh viên</span></h1>
	                    	</div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-md-12">
		                    	<div class="row ttsv">
		                            <div class="col-md-2">
		                                <label for="">SBD</label>
		                                <span><input type="text" readonly name="sobd" class="form-control" value="{if !empty($data)}{$data['soBD']}{/if}"></span>
		                            </div>
		                            <div class="col-md-2">
		                                <label for="">Khối</label>
		                                <span><input type="text" disabled name="khoi" class="form-control" value="{if !empty($data)}{$data['khoihoc']}{/if}"></span>
		                            </div>
		                                {$sum = 0}
		                            {if !empty($data)}
		                                {foreach $getMon as $key => $val}
		                                    <div class="col-md-2">
		                                        <label for="">Môn {$tenmon[$key]}</label>
		                                        <span><input type="text" disabled name="mon1" class="form-control" 
		                                            value="{$val}">
		                                        </span>
		                                    </div>
		                                    {$sum = $sum +  $data[$key]}
		                                {/foreach}
		                            {else}
		                                    <div class="col-md-2">
		                                        <label for="">Môn 1</label>
		                                        <span><input type="text" disabled name="mon1" class="form-control" >
		                                        </span>
		                                    </div>
		                                    <div class="col-md-2">
		                                        <label for="">Môn 2</label>
		                                        <span><input type="text" disabled name="mon1" class="form-control" >
		                                        </span>
		                                    </div>
		                                    <div class="col-md-2">
		                                        <label for="">Môn 3</label>
		                                        <span><input type="text" disabled name="mon1" class="form-control" >
		                                        </span>
		                                    </div>
		                            {/if}
		                            <div class="col-md-2">
		                                <label for="">Tổng điểm</label>
		                                <span><input type="text" disabled name="tongdiem" class="form-control" value="{$sum}"></span>
		                            </div>
		                        </div>
		                        <div class="row ttsv">
		                            {if !empty($data)}
		                                <div class="col-md-4">
		                                    <label for="">Ngành trúng tuyển</label>
		                                    <select disabled class="form-control" name="nganhtrungtuyen">
		                                    {foreach $danhmuc['tbl_nganh'] as $ntt}
		                                        <option value="{$ntt.iMa_nganh}" {if $data['FK_sMaNganh'] == $ntt.iMa_nganh} selected {/if}>{$ntt.sTen_Nganh}</option>
		                                    {/foreach}
		                                    </select>
		                                </div>
		                            {else}
		                                <div class="col-md-4">
		                                    <label for="">Ngành trúng tuyển</label>
		                                    <select disabled class="form-control" name="nganhtrungtuyen" disabled>
		                                        <option value=""></option>  
		                                    </select>
		                                </div>
		                            {/if}
		                            <div class="col-md-4">
		                                <label for="">Hệ đào tạo</label>
		                                <select class="form-control" name="hedaotao" disabled>
		                                    <option value="chinhquy">Chính quy</option>
		                                </select>
		                            </div>
		                            <div class="col-md-4">
		                                <label for="">Trình độ</label>
		                                <select class="form-control" name="trinhdo" disabled>
		                                    <option value="daihoc">Đại học</option>
		                                </select>
		                            </div>
		                        </div>

		                        <div class="row ttsv">
		                            <div class="col-md-4">
		                                <label for="">Họ tên</label>
		                                <span><input type="text" name="hoten" class="form-control" value="{if !empty($data)}{$data['hoten']}{/if}" disabled></span>
		                            </div>
		                            <div class="col-md-4">
		                                <label for="">Ngày sinh</label>
		                                <span>
		                         <input type="text" class="form-control datepicker" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask=""name="ngaysinh"  value="{if !empty($data)}{$data['ngaysinh']}{/if}" disabled>
		                            </span>
		                            </div>
		                            <div>
		                                <div class="main_anh">
		                                  {if isset($notification)}
		                                    <br>
		                                    {/if}
		                                </div>
		                                <div class="form-group hidden-md hidden-xs hidden-sm">
		                                    
		                                    <div class="box-upload">
		                                        <input type="file" name="photos" id="uploadanh" class="inputfile" onchange="readURL(this);" title="Click để chọn ảnh">
		                                        <label for="uploadanh" class="uploadanh"><i class="fa fa-file-image-o" aria-hidden="true"></i>
		                                            <br><span>Click để chọn ảnh<span></span></span>
		                                        </label>
		                                        {if !empty($data)}
		                                            <img src="public/sinhvien/{$data['soBD']}.jpg"  id="anh" class="anhsv">
		                                        {/if}
		                                        <br>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                        <div class="row ttsv">
		                             <div class="col-md-4">
		                                <label for="">CMND/Thẻ căn cước</label>
		                                <span><input type="text" name="cmnd" class="form-control" value="{if !empty($data)}{$data['CMND']}{/if}" disabled></span>
		                            </div>
		                            <div class="col-md-4">
		                                <label for="">Đối tượng</label>
		                                <span><input type="text" name="doituong" class="form-control" value="{if !empty($data)}{$data['doituong']}{/if}" disabled></span>
		                            </div>
		                        </div>
		                        <div class="row ttsv">
		                             <div class="col-md-4">
		                                <label for="">Năm tốt nghiệp</label>
		                                <span><input type="text" name="namtotnghiep" class="form-control" value="{if !empty($data)}{$data['namtotnghiep']}{/if}" disabled ></span>
		                        </div>
	                            <div class="col-md-4">
	                                <label for="">Khu vực</label>
	                                <span><input type="text" name="khuvuc" disabled="" class="form-control" value="{if !empty($data)}{$data['khuvuc']}{/if}"></span>
	                            </div>
		                        </div>
		                        <div class="row ttsv">
		                            <div class="col-md-4">
		                                <label for="">Ngày cấp CMND/Thẻ căn cước</label>
		                                <input type="text" name="data[ngaycapcmnd]" class="form-control datepicker" value="{if !empty($data)}{$data['ngaycapcmnd']}{/if}" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" autocomplete="off" >
		                            </div>  
		                            <div class="col-md-4">
		                                <label for="">Nơi cấp CMND/Thẻ căn cước</label>
		                                <span><input type="text" name="data[noicapcmnd]" class="form-control" value="{if !empty($data)}{$data.noicapcmnd}{/if}"></span>
		                            </div>
		                        </div>
							</div>
	                    </div>
	                    {/if}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 {if $session['maquyen'] != 9 && $session['maquyen'] != 1}
        <script type="text/javascript">
            $('input[name="data[ngaycapcmnd]"]').attr('disabled', true);
            $('input[name="data[noicapcmnd]"]').attr('disabled', true);
            $('select').attr('disabled', true);
            $('input[type="radio"]').attr('disabled', true);
            $('input[type="file"]').attr('disabled', true);
        </script>
    {/if}
<style type="text/css">
	.box-upload {
	    top: 161px;
	    right: 106px;
	}
</style>
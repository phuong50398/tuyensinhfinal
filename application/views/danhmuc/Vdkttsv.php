<style type="text/css">
	
	.top{
		border-top: 7px solid #707cd2 !important;
	}
</style>
<div class="container-fluid top"></div>
<div class="container dangkythongtinsv">
	<h3 class="text-center title-dk">
		CẬP NHẬT THÔNG TIN TRƯỚC KHI NHẬP HỌC - TRƯỜNG ĐẠI HỌC MỞ HÀ NỘI - {date('Y')}
	</h3>
  <div class="row">
      <div class="panel panel-primary">
        <div class="panel-heading text-left">
          <h4>Thông tin cá nhân</h4>
      </div>
      <div class="panel-body">
        <form method="post" onsubmit="return checkvalidate()">
         <div class="row ttsv">
            <div class="col-md-2">
                <label for="">SBD</label>
                <span><input type="text" class="form-control" value="{$sinhvien.soBD}" disabled></span>
            </div>
            <div class="col-md-2">
                <label for="">Khối</label>
                <span><input type="text"  class="form-control" value="{$sinhvien.khoihoc}" disabled ></span>
            </div>
            {$sum = 0}
            {foreach $getDiem as $k => $val}
            <div class="col-md-2">
                <label for="">Môn {$monhoc[$k]}</label>
                <span><input type="text" class="form-control" value="{$val}" disabled></span>
            </div>
            {$sum = $sum + $sinhvien[$k]}
            {/foreach}
            <div class="col-md-2">
                <label for="">Tổng điểm</label>
                <span>
                    <input type="text" class="form-control" value="{$sum}" disabled>
                </span>
            </div>
        </div>
        <div class="row ttsv">
           {if !empty($sinhvien)}
           <div class="col-md-4">
            <label for="">Ngành trúng tuyển</label>
            <select disabled class="form-control" name="nganhtrungtuyen">
                {foreach $nganhtrungtuyen as $ntt}
                <option value="{$ntt.iMa_nganh}" {if $sinhvien['FK_sMaNganh'] == $ntt.iMa_nganh} selected {/if}>{$ntt.sTen_Nganh}</option>
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
            <span><input type="text"  class="form-control"  value="{$sinhvien.hedaotao}" disabled></span>
        </div>
        <div class="col-md-4">
            <label for="">Trình độ</label>
            <select class="form-control" disabled>
                <option value="{$sinhvien['trinhdo']}">{$sinhvien['trinhdo']}</option>
            </select>
        </div>
    </div>
    <div class="row ttsv">
        <div class="col-md-4">
            <label for="">Họ tên</label>
            <span><input type="text"  class="form-control" value="{$sinhvien.hoten}" disabled></span>
        </div>
        <div class="col-md-4">
            <label for="">Ngày sinh</label>
            <span><input type="text"  class="form-control" value="{$sinhvien.ngaysinh}" disabled></span>
        </div>
        <div class="col-md-4">
            <label for="">Đối tượng</label>
            <span><input type="text" name="data[doituong]" value="{$sinhvien['doituong']}" disabled class="form-control" ></span>
        </div>
    </div>
    <div class="row ttsv">
     <div class="col-md-4">
        <label for="">Khu vực</label>
        <span><input type="text" name="data[khuvuc]" value="{$sinhvien['khuvuc']}" disabled class="form-control" ></span>
    </div>
    <div class="col-md-4">
        <label for="">Năm tốt nghiệp</label>
        <span><input type="text" value="{$sinhvien['namtotnghiep']}" disabled class="form-control" ></span>
    </div>
    <div class="col-md-4">
        <label for="">Nơi sinh</label>
        <span><input type="text" name="data[noisinh]" class="form-control" placeholder="Nhập tên tỉnh..." value="{$sinhvien['noisinh']}"></span>
    </div>
</div>
<div class="row ttsv">
    <div class="col-md-4">
        <label for="">Số CMND/Thẻ căn cước</label>
        <span><input type="text"  class="form-control" value="{$sinhvien.CMND}" disabled></span>
    </div>
    <div class="col-md-4">
        <label for="">Ngày cấp CMND/Thẻ căn cước</label>
        <span>
            <input type="text" class="form-control datepicker" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" value="{$sinhvien['ngaycapcmnd']}" name="data[ngaycapcmnd]" autocomplete="off" >
        </div>
        <div class="col-md-4">
            <label for="">Nơi cấp CMND/Thẻ căn cước</label>
            <span><input type="text" value="{$sinhvien.noicapcmnd}" name="data[noicapcmnd]" class="form-control" ></span>
        </div>

    </div>

    <div class="row ttsv">
       <div class="col-md-4 gt">
        <label for="">Giới tính</label><br>
        <label class="radio-inline">
            <div class="radio radio-primary">
                <input type="radio" value="Nam" name="data[gioitinh]" id="Nam" {if $sinhvien['gioitinh'] == 'Nam'}checked=""{/if}>
                <label for="Nam"> <b>Nam</b> </label>
            </div>
        </label>
        <label class="radio-inline">
            <div class="radio radio-primary">
                <input type="radio" value="Nữ" name="data[gioitinh]" id="Nu"{if $sinhvien['gioitinh'] == 'Nữ'}checked=""{/if}>
                <label for="Nu"> <b>Nữ</b> </label>
            </div>
        </label>
    </div>
    <div class="col-md-4 dang">
        <label for="">Đoàn/Đảng</label><br>
        <label class="radio-inline">
            <div class="radio radio-primary">
                <input type="radio" name="data[doan]" id="Đoàn"  {if $sinhvien.doan == 'Đoàn'}checked=""{/if} value="Đoàn">
                <label for="Đoàn"> <b>Đoàn</b> </label>
            </div>
        </label>
        <label class="radio-inline">
            <div class="radio radio-primary">
                <input type="radio" name="data[doan]" id="Đảng" value="Đảng" {if $sinhvien.doan == 'Đảng'}checked=""{/if}>
                <label for="Đảng"> <b>Đảng</b> </label>
            </div>
        </label>
        <label class="radio-inline">
            <div class="radio radio-primary">
                <input type="radio" name="data[doan]" value="Chưa" id="Chưa" {if $sinhvien.doan != 'Đoàn' && $sinhvien.doan != 'Đảng'}checked=""{/if}>
                <label for="Chưa"> <b>Chưa</b> </label>
            </div>
        </label>
    </div>
    <div class="col-md-4">
        <label for="">Tôn giáo</label>
        <select class="js-example-basic-multiple" required="" name="data[FK_tongiao]">
            <option disabled selected="">Chọn tôn giáo</option>
            {foreach $tongiao as $key => $val}
            <option value="{$val['madm_tongiao']}" {if $val['madm_tongiao'] == ""}selected=""{/if} {if $sinhvien['FK_tongiao'] == $val['madm_tongiao']}selected=""{/if}>{$val['ten_tongiao']} </option>
            {/foreach}
        </select>
    </div>

</div>
<div class="row ttsv">
 <div class="col-md-4">
    <label for="">Quê quán</label>
    <input type="text" class="form-control" name="data[quequan]" value="{$sinhvien['quequan']}" placeholder="Quê quán">
</div>
<div class="col-md-4">
    <label for="">Hộ khẩu</label>
    <span><input type="text" name="data[hokhau]" placeholder="Ghi như trong hộ khẩu.." class="form-control" value="{$sinhvien['hokhau']}"></span>
</div>
<div class="col-md-4">
    <label for="">Dân tộc</label>
    <select class="js-example-basic-multiple" required name="data[FK_Dantoc]">
        <option disabled selected="">Chọn dân tộc</option>
        {foreach $dantoc as $key => $val}
        <option value="{$val['iMaDT']}" {if $val['iMaDT'] == ""}selected=""{/if}{if $sinhvien['FK_Dantoc'] == $val['iMaDT']}selected=""{/if}>{$val['sTenDT']}</option>
        {/foreach}
    </select>
</div>

</div>
<!-- Đổ tỉnh huyện xã -->
<div class="row ttsv">
    <div class="col-md-4 form-group">
        <label for="">Tỉnh</label>
        <select name="data[tinh]" class="js-example-basic-multiple">
            <option value="" disabled="" selected="" id="tinh">---Chọn tỉnh---</option>
            {foreach $dmtinh as $tinh}
            <option value="{$tinh.matinh}" {if !empty($sinhvien['tinh']) && $sinhvien['tinh'] == $tinh.matinh} selected {/if}>{$tinh.tentinh}</option>
            {/foreach}
            option
        </select>
    </div>
    <div class="col-md-4 form-group">
        <label for="">Huyện</label>
        <select name="data[huyen]" class="js-example-basic-multiple" id="huyen">
            <option value="" disabled="" selected="" >---Chọn huyện---</option>
            {if !empty($sinhvien['huyen'])}
            {foreach $dmhuyen as $huyen}
            {if $huyen['matinh']==$sinhvien['tinh']}
            <option value="{$huyen.mahuyen}" {if $sinhvien['huyen'] == $huyen.mahuyen} selected {/if}>{$huyen.tenhuyen}</option>
            {/if}
            {/foreach}
            {/if}
        </select>
    </div>
    <div class="col-md-4 form-group">
        <label for="">Xã</label>
        <select name="data[xa]" class="js-example-basic-multiple" id="xa">
            <option value="" disabled="" selected="">---Chọn xã---</option>
            {if !empty($sinhvien['xa'])}
            {foreach $dmxa as $xa}
            {if $xa['maxa']==$sinhvien['xa']}
            <option value="{$xa.maxa}" {if $sinhvien['xa'] == $xa.maxa} selected {/if}>{$xa.tenxa}</option>
            {/if}
            {/foreach}
            {/if}
        </select>
    </div>
</div>
<div class="row ttsv">

    <div class="col-md-4">
        <label for="">Địa chỉ</label>
        <span><input type="text" name="data[diachi]" value="{$sinhvien['diachi']}" class="form-control" ></span>
    </div>

    <div class="col-md-4">
        <label for="">Chức vụ PT</label>
        <span><input type="text" name="data[chucvu]" placeholder="Lớp trưởng, lớp phó, bí thư..." class="form-control" value="{$sinhvien['chucvu']}"></span>
    </div>
    <div class="col-md-4">
        <label for="">Năng khiếu</label>
        <span><input type="text" name="data[nangkhieu1]" placeholder="Ca hát, nhảy, múa..." class="form-control" value="{$sinhvien['nangkhieu1']}" ></span>
    </div>
</div>
<div class="row ttsv">

    <div class="col-md-4">
        <label for="">Nơi tốt nghiệp</label>
        <span><input type="text" name="data[noitotnghiep]" class="form-control"  placeholder="Tên trường THPT cấp 3..." value="{$sinhvien['noitotnghiep']}"></span>
    </div>
    <div class="col-md-4">
        <label for="">Email</label>
        <span><input type="text" name="data[email]" value="{$sinhvien['email']}" class="form-control" placeholder="Email..." ></span>
    </div>
    <div class="col-md-4">
        <label for=""><span style="color:red; font-size: 20px;"><b>*</b></span>Số điện thoại</label>
        <span><input type="text" name="data[sdt]" value="{$sinhvien['sdt']}"  class="form-control" placeholder="Số điện thoại"></span>
    </div>
</div>
<hr>
<div class="row ttgd">
 <h3 class="text-left">Thông tin gia đình</h3>
</div>
<div class="row ttsv">
    <div class="col-md-2">
        <label for="">Tên quan hệ</label>
        <span><input type="text"  class="form-control" value="Bố"  disabled></span>
    </div>
    <div class="col-md-3">
        <label for="">Họ tên</label>
        <span><input type="text" name="data[hoten_bo]" value="{$sinhvien['hoten_bo']}" class="form-control" ></span>
    </div>
    <div class="col-md-2">
        <label for="">Năm sinh</label>
        <span><input type="text" name="data[namsinh_bo]" value="{$sinhvien['namsinh_bo']}" class="form-control" ></span>
    </div>
    <div class="col-md-3">
        <label for="">Nghề nghiệp</label>
        <span><input type="text" value="{$sinhvien['nghenghiep_bo']}" name="data[nghenghiep_bo]" class="form-control" ></span>
    </div>
    <div class="col-md-2">
        <label for="">Số điện thoại</label>
        <span><input type="text" value="{$sinhvien['sdt_bo']}" name="data[sdt_bo]" class="form-control" ></span>
    </div>
</div>

<div class="row ttsv">
    <div class="col-md-2">
        <label for="">Tên quan hệ</label>
        <span><input type="text" class="form-control" value="Mẹ"  disabled></span>
    </div>
    <div class="col-md-3">
        <label for="">Họ tên</label>
        <span><input type="text" name="data[hoten_me]" value="{$sinhvien['hoten_me']}" class="form-control"></span>
    </div>
    <div class="col-md-2">
        <label for="">Năm sinh</label>
        <span><input type="text" name="data[namsinh_me]" value="{$sinhvien['namsinh_me']}" class="form-control" ></span>
    </div>
    <div class="col-md-3">
        <label for="">Nghề nghiệp</label>
        <span><input type="text" value="{$sinhvien['nghenghiep_me']}" name="data[nghenghiep_me]" class="form-control" ></span>
    </div>
    <div class="col-md-2">
        <label for="">Số điện thoại</label>
        <span><input type="text" value="{$sinhvien['sdt_me']}" name="data[sdt_me]" class="form-control" ></span>
    </div>
</div>
<div class="row ttsv">
    <p class="chuy"> <u><b>Chú ý:</b></u> Sau khi cập nhật thành công thông tin, các thí sinh vẫn phải đến trường nộp phiếu điểm và làm thủ tục nhập học.</p>
</div>
<div class="row ttsv text-center">
    <input type="hidden" name="xacnhan" value="xacnhan">
    {if empty($sinhvien.masv) && $sinhvien.trangthai <3}
    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span>&nbsp;Cập nhật</button>
    {else}
    <div class="col-md-12 text-center">
        <p class="alert alert-danger">Thông tin sinh viên đã được hoàn thành. Nếu có vấn đề phát sinh xin vui lòng liên hệ với ban tư vấn tuyển sinh để được trợ giúp!</p>
    </div>
    {/if}
    <a href="{base_url('login')}" class="btn btn-danger"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;Đăng xuất</a>
</div>
</form>
</div>
<div class="panel-footer">
  <small> 
   <b>Phát triển và xây dựng bởi <span class="glyphicon glyphicon-heart" style="color: red;" aria-hidden="true"></span> Tổ phát triển Khoa CNTT - Trường Đại học Mở Hà Nội</b>
   <br>
</small>
</div>
</div>
</div>
{if empty($sinhvien.masv) && $sinhvien.trangthai <3}

{/if}
<script type="text/javascript">
    function checkvalidate(){
        if($('input[name="data[sdt]"]').val() == "" ){
            toastr.error('Số điện thoại không được để trống!', 'Thông báo');
            return false;
        }
                // có điều kiện gì hãy thêm ở đây.
                return true;
            } 
            $(document).on('change', 'select[name="data[tinh]"]', function() {
             $( "#xa" ).html('<option value="">---Chọn xã---</option>');
             value = $(this).val();
             console.log(value);
             $.ajax({
              url: window.location.pathname,
              type: 'post',
              data: {
                'action': 'get_huyen',
                'matinh': value,
            },
            success:function(data){
                data = JSON.parse(data);
                html = '';
                html = '<option value="">---Chọn huyện---</option>';
                $.each(data, function(index,el){
                    html += '<option value="'+el['mahuyen']+'">'+el['tenhuyen']+'</option>';
                });
                $('#huyen').html(html);
                // console.log('1');
            }
        });
         });
            $(document).on('change', 'select[name="data[huyen]"]', function() {
                value = $(this).val();
                console.log(value);
                $.ajax({
                  url: window.location.pathname,
                  type: 'post',
                  data: {
                    'action': 'get_xa',
                    'mahuyen': value,
                },
                success:function(data){
                    data = JSON.parse(data);
                    html = '';
                    html = '<option value="">---Chọn xã---</option>';
                    $.each(data, function(index,el){
                        html += '<option class = "selectxa" value="'+el['maxa']+'">'+el['tenxa']+'</option>';
                    });
                    $('#xa').html(html);
                // console.log('1');
            }
        });
            });
        </script>
    </div>

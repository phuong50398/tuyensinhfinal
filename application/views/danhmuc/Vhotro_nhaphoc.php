

<div class="container fixdisplay">
    <div class="panel panel-default">
        <div class="panel-heading text-left">
            <h5><b>Đăng Ký Thông Tin Nhập Học</b></h5></div>
            <div class="panel-body">
                <form action="" method="get" accept-charset="utf-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-9">
                                    <label for="">Số báo danh của sinh viên:</label>
                                    <input type="text" name="sobd" class="form-control" placeholder="Nhập số báo danh..."  required="" {if isset($noidungtimkiem)}value=" {$noidungtimkiem}"{/if}>
                                    <p class="text-danger">{if isset($notification)}{$notification}{/if}</p>
                                </div>
                                <div class="col-md-3" style="margin-top: 25px;">
                                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
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
                                {foreach $nganhtrungtuyen as $ntt}
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
                               <input type="text" class="form-control datepicker" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask=""name="ngaysinh"  value="{if !empty($data)}{date('m/d/Y', strtotime($data['ngaysinh']))}{/if}" disabled>
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
    <div class="row ttsv">
       <div class="col-md-4 gt">
        <label for="">Giới tính</label><br>
        <label class="radio-inline">
            <div class="radio radio-primary">
                <input type="radio" value="Nam" name="data[gioitinh]" id="Nam" checked="" {if !empty($data['gioitinh']) && $data['gioitinh'] == "Nam"}checked{/if}>
                <label for="Nam"> <b>Nam</b> </label>
            </div>
        </label>
        <label class="radio-inline">
            <div class="radio radio-primary">
                <input type="radio" {if !empty($data['gioitinh']) && $data['gioitinh'] == "Nữ"}checked{/if} value="Nữ" name="data[gioitinh]" id="Nu">
                <label for="Nu"> <b>Nữ</b> </label>
            </div>
        </label>
    </div>
    <div class="col-md-4 gt">
        <label for="">Đoàn/Đảng</label><br>
        <label class="radio-inline">
            <div class="radio radio-primary">
                <input type="radio" value="Đoàn" name="data[doan]" id="Đoàn" checked="" {if !empty($data['doan']) && $data['doan'] == "Đoàn"}checked{/if}>
                <label for="Đoàn"> <b>Đoàn</b> </label>
            </div>
        </label>
        <label class="radio-inline">
            <div class="radio radio-primary">
                <input type="radio" value="Đảng" name="data[doan]" id="Đảng" {if !empty($data['doan']) && $data['doan'] == "Đảng"}checked{/if}>
                <label for="Đảng"> <b>Đảng</b> </label>
            </div>
        </label>
        <label class="radio-inline">
            <div class="radio radio-primary">
                <input type="radio" value="Không" name="data[doan]" id="Chưa" {if !empty($data['doan']) && $data['doan'] == "Chưa" || empty($data['doan'])}checked{/if}>
                <label for="Chưa"> <b>Chưa</b> </label>
            </div>
        </label>
    </div>
</div>

<div class="row ttsv">
    <div class="col-md-4 form-group">
        <label for="">Tôn giáo</label>
        <select name="data[FK_tongiao]" class="js-example-basic-multiple">
            <option value="" disabled="" selected="">---Chọn tôn giáo---</option>
            {foreach $dmtongiao as $tg}
            <option value="{$tg.madm_tongiao}"  {if isset($data) && $data['FK_tongiao'] == $tg.madm_tongiao} selected {/if} {if empty($data['FK_tongiao']) && $tg.madm_tongiao=="khong"}selected{/if}>{$tg.ten_tongiao}</option>
            {/foreach}
            option
        </select>
    </div>
    <div class="col-md-4 form-group">
        <label for="">Dân tộc</label>
        <select name="data[FK_Dantoc]" class="js-example-basic-multiple">
            <option value="" disabled="" selected="">---Chọn dân tộc---</option>
            {foreach $dmdantoc as $val}
            <option value="{$val.iMaDT}"  {if isset($data) && $data['FK_Dantoc'] == $val.iMaDT} selected {/if} {if empty($data['FK_Dantoc']) && $val.iMaDT=="29"}selected{/if}>{$val.sTenDT}</option>
            {/foreach}
            option
        </select>
    </div>
    <div class="col-md-4">
        <label for="">Hộ khẩu</label>
        <span><input type="text" name="data[hokhau]" class="form-control" value="{if !empty($data)}{$data['hokhau']}{/if}"></span>
    </div>
</div>
<!-- Đổ tỉnh huyện xã -->
<div class="row ttsv">
    <div class="col-md-4 form-group">
        <label for="">Tỉnh</label>
        <select name="data[tinh]" class="js-example-basic-multiple">
            <option value="" disabled="" selected="" id="tinh">---Chọn tỉnh---</option>
            {foreach $dmtinh as $tinh}
            <option value="{$tinh.matinh}" {if !empty($data['tinh']) && $data['tinh'] == $tinh.matinh} selected {/if}>{$tinh.tentinh}</option>
            {/foreach}
            option
        </select>
    </div>
    <div class="col-md-4 form-group">
        <label for="">Huyện</label>
        <select name="data[huyen]" class="js-example-basic-multiple" id="huyen">
            <option value="" disabled="" selected="" >---Chọn huyện---</option>
            {if !empty($data['huyen'])}
            {foreach $dmhuyen as $huyen}
            {if $huyen['matinh']==$data['tinh']}
            <option value="{$huyen.mahuyen}" {if $data['huyen'] == $huyen.mahuyen} selected {/if}>{$huyen.tenhuyen}</option>
            {/if}
            {/foreach}
            {/if}
        </select>
    </div>
    <div class="col-md-4 form-group">
        <label for="">Xã</label>
        <select name="data[xa]" class="js-example-basic-multiple" id="xa">
            <option value="" disabled="" selected="">---Chọn xã---</option>
            {if !empty($data['xa'])}
            {foreach $dmxa as $xa}
            {if $xa['maxa']==$data['xa']}
            <option value="{$xa.maxa}" {if $data['xa'] == $xa.maxa} selected {/if}>{$xa.tenxa}</option>
            {/if}
            {/foreach}
            {/if}
        </select>
    </div>
</div>
<div class="row ttsv">
 
    <div class="col-md-4">
        <label for="">Địa chỉ</label>
        <span><input type="text" name="data[diachi]" class="form-control" value="{if !empty($data)}{$data['diachi']}{/if}"></span>
    </div>
    <div class="col-md-4">
        <label for="">Quê quán</label>
        <span><input type="text" name="data[quequan]" class="form-control" value="{if !empty($data)}{$data['quequan']}{/if}"></span>
    </div>
    <div class="col-md-4">
        <label for="">Nơi tốt nghiệp</label>
        <span><input type="text" name="data[noitotnghiep]" class="form-control" value="{if !empty($data)}{$data['noitotnghiep']}{/if}"></span>
    </div>
</div>

<div class="row ttsv">
    <div class="col-md-4">
        <label for="">Chức vụ THPT</label>
        <span><input type="text" name="data[chucvu]" class="form-control"  value="{if !empty($data)}{$data['chucvu']}{/if}"></span>
    </div>
    <div class="col-md-4">
        <label for="">Năng khiếu</label>
        <span><input type="text" name="data[nangkhieu]" class="form-control" value="{if !empty($data)}{$data['nangkhieu']}{/if}"></span>
    </div>
    <div class="col-md-4">
        <label for="">Email</label>
        <span><input type="text" name="data[email]" class="form-control" value="{if !empty($data)}{$data['email']}{/if}"></span>
    </div>
</div>

<div class="row ttsv">
    <div class="col-md-4">
        <label for=""><span style="color:red; font-size: 20px;"><b>*</b></span> Số điện thoại</label>
        <span><input type="text" name="data[sdt]" class="form-control" value="{if !empty($data)}{$data['sdt']}{/if}" required=""></span>
    </div>
</div>
<hr>
<div class="row ttsv">
    <div class="col-md-2">
        <label for="">Tên quan hệ</label>
        <span><input type="text" name="" class="form-control" value="Bố"  disabled=""></span>
    </div>
    <div class="col-md-3">
        <label for="">Họ tên</label>
        <span><input type="text" name="data[hoten_bo]" class="form-control" value="{if !empty($data)}{$data['hoten_bo']}{/if}"></span>
    </div>
    <div class="col-md-2">
        <label for="">Năm sinh</label>
        <span><input type="text" name="data[namsinh_bo]" class="form-control" value="{if !empty($data)}{$data['namsinh_bo']}{/if}"></span>
    </div>
    <div class="col-md-3">
        <label for="">Nghề nghiệp</label>
        <span><input type="text" name="data[nghenghiep_bo]" class="form-control" value="{if !empty($data)}{$data['nghenghiep_bo']}{/if}"></span>
    </div>
    <div class="col-md-2">
        <label for="">Số điện thoại</label>
        <span><input type="text" name="data[sdt_bo]" class="form-control" class="form-control"  value="{if !empty($data)}{$data['sdt_bo']}{/if}"></span>
    </div>
</div>

<div class="row ttsv">
    <div class="col-md-2">
        <label for="">Tên quan hệ</label>
        <span><input type="text" name="" class="form-control" value="Mẹ"  disabled=""></span>
    </div>
    <div class="col-md-3">
        <label for="">Họ tên</label>
        <span><input type="text" name="data[hoten_me]" class="form-control" value="{if !empty($data)}{$data['hoten_me']}{/if}"></span>
    </div>
    <div class="col-md-2">
        <label for="">Năm sinh</label>
        <span><input type="text" name="data[namsinh_me]" class="form-control" value="{if !empty($data)}{$data['namsinh_me']}{/if}"></span>
    </div>
    <div class="col-md-3">
        <label for="">Nghề nghiệp</label>
        <span><input type="text" name="data[nghenghiep_me]" class="form-control" value="{if !empty($data)}{$data['nghenghiep_me']}{/if}"></span>
    </div>
    <div class="col-md-2">
        <label for="">Số điện thoại</label>
        <span><input type="text" name="data[sdt_me]" class="form-control" value="{if !empty($data)}{$data['sdt_me']}{/if}"></span>
    </div>
</div>

</div>
{if !empty($data) && $data.trangthai < 3 && empty($data.masv)}
{if $session['maquyen'] == 9}
<div class="row text-center">
    <button type="submit" name="luuhoso" value="luuhoso" class="btn btn-info"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Lưu hồ sơ</button>
</div>
{/if}
{else}
{if $session['maquyen'] != 1}
<div class="col-md-12 text-center">
    <p class="alert alert-danger">Thông tin sinh viên đã được hoàn thành. Nếu có vấn đề phát sinh xin vui lòng liên hệ với ban tư vấn tuyển sinh để được trợ giúp!</p>
</div>
<br><br><br>
{/if}
{/if}
{if $session['maquyen'] == 1}
<div class="row text-center">
    <button type="submit" name="luuhoso" value="luuhoso" class="btn btn-info"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Lưu hồ sơ</button>
</div>
{/if}
<br>
</form>
<div class="panel-footer">
    <small> <!-- Remove this notice or replace it with whatever you want -->
        <b>Phát triển và xây dựng bởi <span class="glyphicon glyphicon-heart" style="color: red;" aria-hidden="true"></span> Tổ phát triển Khoa CNTT - Trường Đại học Mở Hà Nội</b>
        <br>
        <!-- <em>Điện thoại hỗ trợ:</em><strong> 091.760.0946</strong> -->
    </small>
</div>
</div>
</div>
</div>
{if $session['maquyen'] != 9 && $session['maquyen'] != 1}
<script type="text/javascript">
    $('input[type="text"]').attr('disabled', true);
    $('select').attr('disabled', true);
    $('input[type="radio"]').attr('disabled', true);
    $('input[type="file"]').attr('disabled', true);
</script>
{/if}
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            console.log($('input[name="photos"')[0]);
            _linkanh = $('input[name="photos"')[0].files[0].name;
            linkanh = $('input[name="photos"]')[0].files[0].name.split(".");
            $('#anh').remove();
            $('#linkanh').remove();
            var reader = new FileReader();
            reader.onload = function(e) {
                var html = '';
                var h ='';
                html += '<img src=""  id="anh" class="anhsv">';
                html += '<input type="hidden" id = "linkanh" name="linkanh" value="'+ linkanh[0] +'">';
                $('.box-upload').append(html); $('.main_anh').html(h);
                $('.anhsv').val(_linkanh);
                $('#anh').attr('src', e.target.result);

            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('.js-example-basic-multiple').select2();
    $('.datepicker').datepicker({
      format: 'dd/mm/yyyy',
      autoclose: true
  });
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


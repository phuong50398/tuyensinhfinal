<div class="container fixdisplay">
    <div class="panel panel-default">
        <div class="panel-heading text-left">
            <h5><b>Tạo lớp sinh viên</b></h5>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <form method="post" onsubmit="return check()">
                    <div class="row">
                            <div class="row ttsv">
                                <div class="col-md-3">
                                    <label for="">Mã lớp</label>
                                    <span><input type="text" name="data[malop]" class="form-control"  required="" value="" autocomplete="off" placeholder="Mã lớp..."></span>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Tên lớp</label>
                                    <span><input type="text" name="data[tenlop]" class="form-control"  required="" value="" autocomplete="off" placeholder="Tên lớp..."></span>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Ngành học</label>
                                    <select  class="form-control" required="" name="data[FK_nganh]">
                                        <option selected="" disabled="">----Chọn ngành----</option>
                                        {foreach $danhmuc['nganh'] as $val}
                                            <option value="{$val.iMa_nganh}">{$danhmuc['tennganh'][$val.iMa_nganh]}</option>
                                        {/foreach}
                                    </select>
                                </div>
                                <div class="col-md-3 text-left">
                                   <button type="submit" class="btn btn-success" name="them" value="dangkycanbo" style="margin-top: 25px;"><i class="fa fa-check-circle" aria-hidden="true"></i> Tạo lớp</button>
                                </div>
                            </div>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <h3 class="text-center">Danh sách lớp</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">STT</th>
                            <th>Mã lớp</th>
                            <th>Tên lớp</th>
                            <th>Ngành học</th>
                            <th>Thời gian tạo</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $danhmuc['lophoc'] as $key => $val}
                            <tr>
                                <td class="text-center"><b>{$key+1}</b></td>
                                <td>{$val.malop}</td>
                                <td>{$val.tenlop}</td>
                                <td>{$danhmuc['tennganh'][$val.FK_nganh]}</td> 
                                <td>{$val.thoigiantao}</td>                        
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
         </div>
    </div>
</div>
<script type="text/javascript">
    function check(){
        if($('select[name="data[FK_nganh]"]').val() == null){
            toastr.error('Ngành học không được để trống!', 'Thông báo');
            return false;
        }else{
            return true;
        }
    }
</script>
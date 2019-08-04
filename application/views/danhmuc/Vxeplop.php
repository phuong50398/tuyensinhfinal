<div class="container-fluid fixdisplay" style="margin: 10px;">
    <div class="panel panel-default">
        <div class="panel-heading text-left">
            <h5><b>Xếp lớp sinh viên nhập học</b></h5>
        </div>
        <div class="panel-body" style="padding: 18px;">
             <div class="panel panel-warning">
                    <div class="panel-body" style="padding: 15px;">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Ngành học</label>
                                <select  class="form-control" required="" name="nganhhoc">
                                    <option selected="" disabled="">----Chọn Ngành học----</option>
                                    {foreach $danhmuc['nganh'] as $val}
                                        <option value="{$val.iMa_nganh}">{$val.sTen_Nganh}</option>
                                    {/foreach}
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="">Lớp học</label>
                                <select  class="form-control" required="" name="lophoc">
                                    <option selected="" disabled="">----Chọn lớp học----</option>
                                    {foreach $danhmuc['lophoc'] as $val}
                                        <option value="{$val.malop}">{$val.tenlop}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-5" style="padding: 0px;">
                            <div class="form-group">
                                <input type="text" name="search-left" class="form-control" placeholder="Tìm kiếm..." id="myInput">
                            </div>
                            <table class="table table-bordered table-hover" id="tableleft">
                                <thead>
                                    <tr>
                                        <th class="col-md-1" style="text-align: center;">
                                             <div class="checkbox checkbox-primary">
                                                <input type="checkbox" id="checkall_left">
                                                <label for="checkall_left"></label>
                                            </div>
                                        </th>
                                        <th style="text-align: center;">Họ và tên</th>
                                        <th style="text-align: center;">Ngành</th>
                                        <th style="text-align: center;">Ngày sinh</th>
                                        <th style="text-align: center;">Giới tính</th>
                                    </tr>
                                </thead>
                                <tbody id="tb">
                
                                </tbody>
                                </table>
                            </div>
                            <div class="col-md-2" style="text-align: center; margin-top: 110px;">
                                <button type="button" class="btn btn-warning" id="go-to-right" title="Chuyển sang phải">
                                    <span class="glyphicon glyphicon-arrow-right hidden-xs" aria-hidden="true"></span>
                                    <span class="glyphicon glyphicon-arrow-down hidden-md hidden-lg hidden-sm" aria-hidden="true"></span>
                                </button>
                                <button type="button" class="btn btn-warning" id="go-to-left" title="Chuyển sang trái">
                                    <span class="glyphicon glyphicon-arrow-left hidden-xs" aria-hidden="true"></span>
                                    <span class="glyphicon glyphicon-arrow-up hidden-md hidden-lg hidden-sm" aria-hidden="true"></span>
                                </button><br>
                                 <button type="button" class="btn btn-success" id="luumon" style="margin-top: 10px;">
                                   <i class="fa fa-check-circle" aria-hidden="true"></i> Lưu
                                </button>
                            </div>
                            <div class="col-md-5" style="padding: 0px;">
                                <div class="form-group">
                                    <input type="text" name="search-right" class="form-control" placeholder="Tìm kiếm..." id="search-right">
                                </div>
                                <table class="table table-bordered table-hover" id="tableright">
                                    <thead>
                                    <tr>
                                        <th class="col-md-1" style="text-align: center;">
                                             <div class="checkbox checkbox-primary">
                                                <input type="checkbox" id="checkall_right">
                                                <label for="checkall_right"></label>
                                            </div>
                                        </th>
                                        <th style="text-align: center;">Họ và tên</th>
                                        <th style="text-align: center;">Ngành</th>
                                        <th style="text-align: center;">Ngày sinh</th>
                                        <th style="text-align: center;">Giới tính</th>
                                    </tr>
                                </thead>
                                <tbody id="tb1">
                                        <tr>
                                            
                                        </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
<script type="text/javascript" src="{base_url()}public/js/xeplop.js"></script>
<style type="text/css">
    .radio, .checkbox {
        margin-top: -7px;
    }
    input[type=radio], input[type=checkbox] {
        height: 0px;
    }
</style>

<div class="container-fluid fixdisplay" style="padding: 30px;">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            <h5><b>Hỗ trợ thu phí nhập học</b></h5>
        </div>
        <div class="panel-body">
            <form action="" accept-charset="utf-8">
                <div class="col-md-12 text-center">
                    <p class="tthp">
                        <b>
                        <span> Hồ sơ trúng tuyển: </span><span class="tien">hstt.</span>
                        <span> Giấy báo nhập học: </span><span class="tien">gbnh.</span>
                        <span> Bản sao học bạ: </span><span class="tien">bshb.</span>
                        <span> Bản sao khai sinh: </span><span class="tien">bsks.</span>
                        <span> Chứng nhận tốt nghiệp(Tạm thời): </span><span class="tien">cntn.</span>
                        <span> Bản sao tốt nghiệp: </span><span class="tien">bstn.</span>
                        <span> Nghĩa vụ quân sự: </span><span class="tien">bstn.</span>
                        <span> Xác nhận vắng mặt: </span><span class="tien">xnvm.</span>
                        <span> Ưu tiên khu vực: </span><span class="tien">utkv.</span>
                        <span> Ưu tiên đối tượng: </span><span class="tien">utdt.</span>
                     </b>
                    </p>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-xs-4 col-sm-4 col-md-5 col-lg-5">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg12">
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <label class="control-label">Họ Tên SV:</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                        <div class="form-group">
                                            <input type="text" value="Trần Mạnh Hùng" class="form-control">
                                        </div>
                                    </div> <!-- Hết một phần -->
                                </div>
                            </div> 
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg12">
                                <div class="row">
                                    <br>
                                    <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <label class="control-label">Hiện thị:</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-9 col-lg-9">
                                            <label class="radio-inline">
                                                <div class="radio radio-primary">
                                                    <input type="radio" name="thoigian" id="toidain">
                                                    <label for="toidain"> <b>Tất cả</b> </label>
                                                </div>
                                            </label>
                                            <label class="radio-inline">
                                                <div class="radio radio-primary">
                                                    <input type="radio" name="thoigian" id="toidain">
                                                    <label for="toidain"> <b>Đã có HS</b> </label>
                                                </div>
                                            </label>
                                             <label class="radio-inline">
                                                <div class="radio radio-primary">
                                                    <input type="radio" name="thoigian" id="toidain">
                                                    <label for="toidain"> <b>Chưa có HS</b> </label>
                                                </div>
                                            </label>
                                    </div>
                                </div>
                            </div> 
                        </div><!-- hết một phần -->
                        <div class="col-xs-4 col-sm-4 col-md-5 col-lg-5">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">SBD:</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                        <div class="form-group">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div> <!-- Hết một phần -->
                                </div>
                            </div>  <br>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">Người thu HS: </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-8 col-lg-8">
                                        <div class="form-group">
                                            <select class="form-control" id="sel1">
                                                <option>Văn Lâm 1</option>
                                                <option>Mạnh Hùng 2</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div><!-- hết một phần -->
                        <div class="col-xs-4 col-sm-4 col-md-2 col-lg-2">
                            <div class="text-center">
                                <button class="btn btn-primary">Tìm kiếm</button>
                            </div>
                        </div>  <!-- hết một phần -->
                    </div> <!--  Hết phần form-group to để bao mấy cái ô input -->
                </div>
            </form>
             <hr>
                <form method="post">
                    <div class="row ttsv_tc-nh">
                        <table class="table table-striped table-bordered" id="table_id">
                            <thead>
                               <th class="text-center">STT</th>
                                <th>SBD</th>
                                <th>Họ và tên</th>
                                <th>Ngày sinh</th>
                                <th>hstt</th>
                                <th>gbnh</th>
                                <th>bshb</th>
                                <th>bsks</th>
                                <th>cntn</th>
                                <th>bstn</th>
                                <th>nvqs</th>
                                <th>xnvm</th>
                                <th>utkv</th>
                                <th>utdt</th>
                                <th>Người lập hồ sơ</th>
                                <th>Hồ sơ</th>
                            </thead>
                            <tbody>
                               <tr>
                                    <td class="text-center"><b>1</td>
                                         <td><a href="">17A10010247</a></td>
                                        <td>Nguyễn Văn Lâm</td>
                                        <td>24/04/1999</td>
                                        <td class="text-center">
                                           <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" checked="">
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" checked="">
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" checked="">
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" >
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                             <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" >
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                             <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" >
                                                <label for="checkbox7"></label>
                                            </div>  
                                        </td>
                                        <td class="text-center">
                                           <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" checked="">
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                           <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" checked="">
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                           <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" checked="">
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                           <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" checked="">
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td>
                                           <p>Nguyễn Văn Lâm</p>
                                        </td>
                                        <td class="text-center">
                                            <a href="{$url}Thu-ho-so?inhoso=2" class="btn btn-primary btn-sm"><i class="fa fa-print" aria-hidden="true"></i></a>
                                            <a href="" class="btn btn-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i></a>
                                        </td>
                                </tr>
                                <tr>
                                       <td class="text-center"><b>2</b></td>
                                    <td><a href=""> 17A10010216</a></td>
                                    <td>Trần Mạnh Hùng</td>
                                    <td>02/10/1999</td>
                                    <td class="text-center">
                                           <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" checked="">
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" checked="">
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" checked="">
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" >
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                             <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" >
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                             <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" >
                                                <label for="checkbox7"></label>
                                            </div>  
                                        </td>
                                        <td class="text-center">
                                           <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" checked="">
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                           <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" checked="">
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                           <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" checked="">
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                           <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" checked="">
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                    <td>
                                      <p>Trần Mạnh Hùng</p>
                                    </td>
                                    <td class="text-center">
                                        <a href="" class="btn btn-primary btn-sm"><i class="fa fa-print" aria-hidden="true"></i></a>
                                        <a href="" class="btn btn-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                       <td class="text-center"><b>3</b></td>
                                    <td><a href=""> 17A10010216</a></td>
                                    <td>Nguyễn Đình Thi</td>
                                    <td>02/10/1999</td>
                                     <td class="text-center">
                                           <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" checked="">
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" checked="">
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" checked="">
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" >
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                             <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" >
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                             <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" >
                                                <label for="checkbox7"></label>
                                            </div>  
                                        </td>
                                        <td class="text-center">
                                           <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" checked="">
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                           <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" checked="">
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                           <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" checked="">
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                           <div class="checkbox checkbox-primary">
                                                <input id="checkbox7" type="checkbox" checked="">
                                                <label for="checkbox7"></label>
                                            </div>
                                        </td>
                                    <td>
                                      <p>Thi Đình Nguyễn</p>
                                    </td>
                                    <td class="text-center">
                                        <a href="" class="btn btn-primary btn-sm"><i class="fa fa-print" aria-hidden="true"></i></a>
                                        <a href="" class="btn btn-danger btn-sm"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
        </div>
        <div class="panel-footer">
            <small> <!-- Remove this notice or replace it with whatever you want -->
                <b>Phát triển và xây dựng bởi <span class="glyphicon glyphicon-heart" style="color: red;" aria-hidden="true"></span> Tổ phát triển Khoa CNTT - Trường ĐH Mở HN</b>
                <br>
                <!-- <em>Điện thoại hỗ trợ:</em><strong> 091.760.0946</strong> -->
            </small>
        </div>
    </div>
</div>
<style type="text/css">
    input[type=checkbox] {
        margin: 0px 0 0;
        width: 26px;
        height: 14px;
        line-height: normal;
    }    
</style>
<script type="text/javascript">
  $(function () {
    $('#table_id').DataTable()
  })
</script>

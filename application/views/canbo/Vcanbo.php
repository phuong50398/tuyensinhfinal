 <div class="container fixdisplay">
    <div class="panel panel-default">
        <div class="panel-heading text-left">
            <h5><b>Danh mục cán bộ</b></h5></div>
            <div class="panel-body">
                <div class="col-md-12">
                    <form method="post">
                        <div class="row">
                            <div class="row ttsv">
                                <div class="col-md-2">
                                    <label for="">Mã cán bộ</label>
                                    <span><input type="text" name="data[macb]" class="form-control"  {if !empty($checkcb)}value="{$checkcb.macb}"  readonly="" {/if} required=""></span>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Tên cán bộ</label>
                                    <span><input type="text" name="data[tencb]" class="form-control"  required="" value="{if !empty($checkcb)}{$checkcb.tencb}{/if}" autocomplete="off"></span>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Mật khẩu</label>
                                    <span><input type="password" name="data[matkhau]" class="form-control" autocomplete="off"></span>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Quyền truy cập</label>
                                    <select name="data[maquyen]" class="form-control" required="">
                                        <option selected="" disabled="">----Chọn quyền----</option>
                                        {foreach $danhmuc['quyen'] as $qu}
                                        {if $qu['iMa_Quyen'] !=1}
                                            <option value="{$qu.iMa_Quyen}" {if !empty($checkcb) && $checkcb.maquyen == $qu.iMa_Quyen} selected="" {/if}>{$qu.sTenquyen}</option>
                                        {/if}
                                        {/foreach}
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Khoa</label>
                                    <select name="data[makhoa]" class="form-control" required="">
                                        <option selected="" disabled="">----Chọn Khoa----</option>
                                        {foreach $danhmuc['tbl_khoa'] as $kh}
                                            <option value="{$kh.makhoa}" {if !empty($checkcb) && $checkcb.makhoa == $kh.makhoa} selected="" {/if}>{$kh.tenkhoa}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 text-right">
                               <button type="submit" class="btn {if !empty($checkcb) } btn-success{else}btn-primary{/if}" name="dangkycanbo" value="dangkycanbo">{if !empty($checkcb) }Cập nhật{else}Đăng ký{/if}</button>
                            </div>
                        </div>
                    </form>

                        <hr>
                        <div class="row">
                            <table class="table table-responsive table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th class="text-center">STT</th>
                                        <th>Mã cán bộ</th>
                                        <th>Tên cán bộ</th>
                                        <th>Ngành</th>
                                        <th class="text-center">Tác vụ</th>
                                    </tr>
                                    {$stt = 1}
                                    {foreach $canbo as $key => $cb}
                                        <tr>
                                            <td class="text-center"><b>{$stt}</b></td>
                                            <td><b>{$cb.macb}</b></td>
                                            <td>{$cb.tencb}</td>
                                            <td>{$danhmuc['khoa'][$cb.makhoa]}</td>
                                            <td class="text-center">
                                                <form method="post">
                                                    {if $cb.macb != "admin"}
                                                    <button type="submit" class="btn btn-primary btn-flat" name="suacb" data-toggle="tooltip" data-original-title="Sửa cán bộ" value="{$cb.macb}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                        <button type="submit" name="xoacb" class="btn btn-danger xoacb" data-toggle="tooltip" data-original-title="Xóa cán bộ" value="{$cb.macb}" onclick="return confirm('Bạn có chắc chắn muốn xóa cán bộ này không?')"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                    {/if}

                                                </form>
                                            </td>
                                        </tr>
                                        {$stt = $stt +1}
                                    {/foreach}
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
            <div class="panel-footer">
                <small> <!-- Remove this notice or replace it with whatever you want -->
                    <b>Phát triển và xây dựng bởi <span class="glyphicon glyphicon-heart" style="color: red;" aria-hidden="true"></span> Tổ phát triển Khoa CNTT - Trường Đại học Mở Hà Nội</b>
                    <br>
                    <!-- <em>Điện thoại hỗ trợ:</em><strong> 091.760.0946</strong> -->
                </small>
            </div>
        </div>
    </div>

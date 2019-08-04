$(document).ready(function() {
     load_tragiaybao();
     function load_tragiaybao(){
     	$.ajax({
     		url  : window.location.pathname,
     		type : 'post',
     		data :{
     			'action' : 'load_tragiaybao',
     		},
     		success:function(data){
     			data = JSON.parse(data);
     			html = '';
     			h    = '';
     			stt1  = 1;
                    stt2  = 1;
     			$.each(data['dssv'], function(index, el) {
     				if(el['sohs_nh'] != null && el['nguoitra_giaybao'] == null && el['thoigian_tragiaybao'] == null && el['trangthai'] == 1){
                              var tg    = el['thoigian_thuphieudiem'].split('-');
     					html += '<tr>';
		     			html += '<td class="text-center"><b>' + [stt1++] + '</b></td>';
		     			html += '<td>' + el['soBD'] + '</td>';
		     			html += '<td><b>' + el['hoten'] + '</b></td>';
		     			html += '<td>' + el['gioitinh']+ '</td>';
		     			html += '<td>' +  el['ngaysinh'] + '</td>';
		     			html += '<td>' + data['nganh'][el['FK_sMaNganh']] + '</td>';
		     			html += '<td>' + data['canbo'][el['nguoithu_phieudiem']] + '</td>';
                              html += '<td>' + el['thoigian_thuphieudiem'] + '</td>';
		     			html += '<td>' + el['sohs_nh'] + '</td>';
		     			html += '<td class="text-center"><label class="label label-primary">Chưa xử lý </label> </td>';
		     			html += '<td><button type="submit" name="trahoso" class="btn btn-primary btn-xs" value="'+el['soBD']+'">Trả hồ sơ</button>  </td>';
		     			html += '</tr>';
     				}
     				if(el['sohs_nh'] != null && el['nguoitra_giaybao'] != null && el['thoigian_tragiaybao'] != null && el['trangthai'] >= 2){
                              var parts = el['ngaysinh'].split('-');
     					h += '<tr>';
		     			h += '<td class="text-center"><b>' + [stt2++] + '</b></td>';
		     			h += '<td>' + el['soBD'] + '</td>';
		     			h += '<td width="11%"><b>' + el['hoten'] + '</b></td>';
		     			h += '<td>' + el['gioitinh'] +'</td>';
		     			h += '<td>' +  el['ngaysinh'] + '</td>';
		     			h += '<td>' + data['nganh'][el['FK_sMaNganh']] + '</td>';
		     			h += '<td>' + data['canbo'][el['nguoithu_phieudiem']] + '</td>';
		     			h += '<td>' + el['sohs_nh'] + '</td>';
		     			h += '<td>' + data['canbo'][el['nguoitra_giaybao']]  + '</td>';
		     			h += '<td>' + el['thoigian_tragiaybao'] + '</td>';
		     			h += '<td class="text-center"><label class="label label-warning">Đã trả hồ sơ </label> </td>';
                              if(el['nguoitra_giaybao'] == data['session']['macb']){
     		     			if(el['trangthai'] > 2){
                                        h += '<td class="text-center"><button type="submit" class="btn btn-danger btn-xs" name="huytrahs" value="'+el['soBD']+'" disabled>Hủy hồ sơ</button></td>';
                                   }else{
                                        h += '<td class="text-center"><button type="submit" class="btn btn-danger btn-xs" name="huytrahs" value="'+el['soBD']+'" disabled>Hủy hồ sơ</button></td>';
                                   }
                              }else{
                                  h += '<td class="text-center"><button type="submit" class="btn btn-danger btn-xs" disabled >Hủy hồ sơ</button></td>'; 
                              }
		     			h += '</tr>';
     				}
     			});
     			$('#tb').html(html);
     			$('#datrabg').html(h);
     		},
     		complete: function () {
				setTimeout(load_tragiaybao, 3000);
			}
     	});
     }
     $(document).on('click', 'button[name="trahoso"]', function(){
     	sobd = $(this).val();
     	$.ajax({
     		url  : window.location.pathname,
     		type : 'post',
     		data : {
     			'action' : 'trahoso',
     			'sobd'   : sobd
     		}, 
     		success:function(data){
     			if(data == 'success'){
     				tt = 'success';
     				toastr.success('Trả giấy báo sinh viên thành công');
     			}else{
     				toastr.error('Trả giấy báo sinh viên thất bại xin lòng kiểm tra lại!','Thông báo');
     			}
     		},
     	});
     });
        $(document).on('click','button[name="huyhs"]', function(){
               if(confirm('Bạn có chắc chắn muốn hủy trả hồ sơ không')){
                    sobd = $(this).val();
                    $.ajax({
                         url  : window.location.pathname,
                         type : 'post',
                         data : {
                              'action' : 'huytrahoso',
                              'sobd'   : sobd
                         }, 
                         success:function(data){
                              if(data == 'success'){
                                   toastr.success('Hủy trả giấy báo sinh viên thành công');
                                   setTimeout(function(){
                                        location.reload();
                                   }, 1000);
                              }else{
                                   toastr.error('Hủy trả giấy báo sinh viên thất bại xin lòng kiểm tra lại!','Thông báo');
                              }
                         },
                    });
               }
          });
});

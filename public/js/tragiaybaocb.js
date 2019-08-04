$(document).ready(function() {
     var arr_remove = [];
     var ban = $( 'select[name="chonban"]').val();
      // mạnh hùng said
     $(document).on('change', 'select[name="chonban"]', function(){
          ban = $(this).val();
          $('.loading').html('<button type="submit" value="timkiem" name="khoa" class="btn btn-primary" style="margin-top:25px; ">Đang tải dữ liệu &nbsp; <i class="fa fa-spinner fa-spin"></i></button>');
          setTimeout(function(){
               load_tragiaybao();
          }, 1000);
     });
     function load_tragiaybao(){
          if(ban == "all"){
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
                              html += ' </td></tr>';
                         }
                         
                    });
                         $('#tb').html(html);
                    }
               });
          }else{
             $.ajax({
                    url  : window.location.pathname,
                    type : 'post',
                    data :{
                         'action' : 'timban',
                         'ban'     : ban,
                    },
                    success:function(data){
                         data = JSON.parse(data);
                         html = '';
                         h    = '';
                         stt1  = 1;
                         stt2  = 1;
                         $.each(data['dssvban'], function(index, el) {
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
                              html += '<td class="text-center"><button type="submit" name="trahoso" class="btn btn-primary btn-sm tragiaybao" value="'+el['soBD']+'"  data-sbd = "'+el['soBD']+'"  data-ban = "'+el['sohs_nh'].substring(0, 1)+'">Trả giấy báo</button> ';
                              if(arr_remove.indexOf(el['soBD'])==-1){
                                    html +=' <button type="submit" data-sbd = "'+el['soBD']+'"  data-hoten = "'+el['hoten']+'"  data-ban = "'+el['sohs_nh'].substring(0, 1)+'" name="thongbao" class="btn btn-warning btn-sm thongbao m-t-20" value="'+el['soBD']+'">Thông báo</button>';
                              }
                             
                              html += ' </td></tr>';
                         }
                         
                    });
                         $('#tb').html(html);
                    },
                    complete: function () {
                        $('.loading').html('');
                    }
               });
          }
     }

     $(document).on('click', 'button[name="trahoso"]', function(){
          button = $('button[name="trahoso"]');
          sobd = $(this).val();
          for (var i = 0; i < button.length; i++) {
               if(sobd != button[i].value)
               {
                    button[i].disabled = true;
               }
          }
          // $(this).attr("class","btn");
          html ="";
          html +='Trả giấy báo &nbsp; <i class="fa fa-spinner fa-spin"></i>';
          $(this).html(html);
          $.ajax({
               url  : window.location.pathname,
               type : 'post',
               data : {
                    'action' : 'trahoso',
                    'sobd'   : sobd
               }, 
               success:function(data){
                    data = JSON.parse(data);
                    if(data['success'] == 1){
                         tt = 'success';
                              toastr.success('Trả giấy báo cho sinh viên ' + data['tensv'][sobd] +' thành công');
                         setTimeout(function(){
                              location.reload();
                         }, 3000)
                    }else{
                         toastr.error('Trả giấy báo sinh viên thất bại xin lòng kiểm tra lại!','Thông báo');
                    }
               },
          });
     });
     $(document).on('click','button[name="huyhs"]', function(){
          sobd = $(this).val();
          button = $('button[name="huyhs"]');
          sobd = $(this).val();
          for (var i = 0; i < button.length; i++) {
               if(sobd != button[i].value)
               {
                    button[i].disabled = true;
               }
          }
          html ="";
          html +='Trả giấy báo &nbsp; <i class="fa fa-spinner fa-spin"></i>';
          $(this).html(html);
          if(confirm('Bạn có chắc chắn muốn hủy trả hồ sơ của sinh viên có số báo danh: '+sobd + " không?")){
               $.ajax({
                    url  : window.location.pathname,
                    type : 'post',
                    data : {
                         'action' : 'huytrahoso',
                         'sobd'   : sobd
                    }, 
                    success:function(data){
                         if(data == 'success'){
                                   toastr.success('Hủy trả giấy báo sinh viên thành công','Thông báo');
                              setTimeout(function(){
                                   location.reload();
                              }, 2000);
                         }else{
                              toastr.error('Hủy trả giấy báo sinh viên thất bại xin lòng kiểm tra lại!','Thông báo');
                         }
                    },
               });
          }
     });

     
        $(document).on('click', '.thongbao', function(event) {
          var socket = io("https://hdgsnn2.gov.vn/", {
               transports: ["websocket"]
             });
          manhinh = 'manhinh' + $(this).attr('data-ban');
               var tablewait = $("#tablewait").val();
               var data = [$(this).attr('data-sbd'), $(this).attr('data-hoten'), $(this).attr('data-ban'),manhinh];
               console.log(data);
               socket.emit("Client-sent-data", data);
               arr_remove.push($(this).attr('data-sbd'));
               $(this).remove();
        });
        
        $(document).on('click', '.tragiaybao', function(event) {
          var socket = io("https://hdgsnn2.gov.vn/", {
               transports: ["websocket"]
             });
          manhinh = 'manhinh' + $(this).attr('data-ban');
               var data = [$(this).attr('data-sbd'),manhinh];
               console.log(data);
          socket.emit("Client-sent-data-delete",data);
        });
});

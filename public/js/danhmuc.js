$(document).ready(function() {
     var arr_remove = [];
     var ban = $( 'select[name="chonban"]').val();
      // mạnh hùng said
      $(document).on('change', 'select[name="chonban"]', function(){
          ban = $(this).val();
          $('.loading').html('<button type="submit" value="timkiem" name="khoa" class="btn btn-primary" style="margin-top:25px; ">Đang tải dữ liệu &nbsp; <i class="fa fa-spinner fa-spin"></i></button>');
        load_tragiaybao();
     });
      load_tragiaybao();
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
                         tragiaybao ="";

                         $.each(data['dssv'], function(index, el) {
                              html += '<tr>';
                              html += '<td class="text-center"><b>' + [stt1++] + '</b></td>';
                              html += '<td>' + el['soBD'] + '</td>';
                              html += '<td><b>' + el['hoten'] + '</b></td>';
                              html += '<td class="text-center">' + el['gioitinh']+ '</td>';
                              html += '<td>' +  el['ngaysinh'] + '</td>';
                              html += '<td>' + data['nganh'][el['FK_sMaNganh']] + '</td>';
                              html += '<td class="text-center">' + el['sohs_nh'] + '</td>';
                              html += '<td class="text-center"><label class="label label-primary">Chưa xử lý </label> </td>';
                              // if(el['nguoitra_giaybao'] == null && el['thoigian_tragiaybao'] == null){
                              //      tragiaybao = '<button type="submit" name="trahoso" class="fix btn btn-primary btn-sm tragiaybao" style="margin-bottom:3px" value="'+el['soBD']+'"  data-sbd = "'+el['soBD']+'"  data-ban = "'+el['sohs_nh'].substring(0, 2)+'"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Trả giấy báo</button>';
                              // }
                              html +='<td class="">';
                              if(arr_remove.indexOf(el['soBD'])==-1){
                                  html +='<button style="margin-bottom:3px; " type="submit" data-sbd = "'+el['soBD']+'"  data-hoten = "'+el['hoten']+'" data-stt = "'+el['stt']+'"  data-ban = "'+el['sohs_nh'].substring(0, 2)+'" name="thongbao" class="fix btn btn-warning btn-sm thongbao m-t-20" value="'+el['soBD']+'"><i class="fa fa-bell" aria-hidden="true"></i>&nbsp;Thông báo</button>';
                             }
                              html += ''+tragiaybao+'<button type="submit" name="chuyentiep" class="fix btn btn-success btn-sm tragiaybao" style="margin-bottom:3px; width:auto" value="'+el['soBD']+'"  data-sbd = "'+el['soBD']+'"  data-ban = "'+el['sohs_nh'].substring(0, 2)+'"><i class="fa fa-share" aria-hidden="true"></i>&nbsp; Trả GB & Chuyển tiếp</button> <button type="submit" name="boqua" data-hoten = "'+el['hoten']+'"  class="fix btn btn-info btn-sm tragiaybao" style="margin-bottom:3px; width:auto" value="'+el['soBD']+'"  data-sbd = "'+el['soBD']+'"  data-ban = "'+el['sohs_nh'].substring(0, 2)+'"><i class="fa fa-bus" aria-hidden="true"></i>&nbsp;  Trả GB & Đi về</button></td>';

                             
                             
                             html += ' </td></tr>';
                        });
                         $('#tb').html(html);
                    },
                    complete: function () {
                     setTimeout(load_tragiaybao, 5000);
                     $('.loading').html(" ");
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
                    console.log(data['dssvban']);
                    $.each(data['dssvban'], function(index, el) {
                         // var tg    = el['thoigian_thuphieudiem'].split('-');
                         html += '<tr>';
                         html += '<td class="text-center"><b>' + [stt1++] + '</b></td>';
                         html += '<td>' + el['soBD'] + '</td>';
                         html += '<td><b>' + el['hoten'] + '</b></td>';
                         html += '<td>' + el['gioitinh']+ '</td>';
                         html += '<td class="text-center">' +  el['ngaysinh'] + '</td>';
                         html += '<td>' + data['nganh'][el['FK_sMaNganh']] + '</td>';
                         html += '<td class="text-center">' + el['sohs_nh'] + '</td>';
                         html += '<td class="text-center"><label class="label label-primary">Chưa xử lý </label> </td>';
                         // if(el['nguoitra_giaybao'] == null && el['thoigian_tragiaybao'] == null){
                         //      tragiaybao = '<button type="submit" name="trahoso" class="fix btn btn-primary btn-sm tragiaybao" style="margin-bottom:3px" value="'+el['soBD']+'"  data-sbd = "'+el['soBD']+'"  data-ban = "'+el['sohs_nh'].substring(0, 2)+'"><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Trả giấy báo</button>';
                         // }
                          html +='<td class="">';
                         if(arr_remove.indexOf(el['soBD'])==-1){
                          html +='<button style="margin-bottom:3px" type="submit" data-sbd = "'+el['soBD']+'"  data-hoten = "'+el['hoten']+'"  data-ban = "'+el['sohs_nh'].substring(0, 2)+'" data-stt = "'+el['stt']+'" name="thongbao" class="fix btn btn-warning btn-sm thongbao m-t-20" value="'+el['soBD']+'"><i class="fa fa-bell" aria-hidden="true"></i>&nbsp;Thông báo</button>';
                        }
                         html += ''+tragiaybao+'<button type="submit" name="chuyentiep" class="fix btn btn-success btn-sm tragiaybao" style="margin-bottom:3px; width:auto" value="'+el['soBD']+'"  data-sbd = "'+el['soBD']+'"  data-ban = "'+el['sohs_nh'].substring(0, 2)+'"><i class="fa fa-share" aria-hidden="true"></i>&nbsp; Trả GB & Chuyển tiếp</button> <button type="submit" name="boqua" data-hoten = "'+el['hoten']+'" class="fix btn btn-info btn-sm tragiaybao" style="margin-bottom:3px; width:auto" value="'+el['soBD']+'"  data-sbd = "'+el['soBD']+'"  data-ban = "'+el['sohs_nh'].substring(0, 2)+'"><i class="fa fa-bus" aria-hidden="true"></i>&nbsp; Trả GB & Đi về</button></td>';
                         

                     html += ' </td></tr>';
                });
                    $('#tb').html(html);
               },
               complete: function () {
                   setTimeout(load_tragiaybao, 5000);
                   $('.loading').html(" ");
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
                         setTimeout(function(){
                              toastr.success('Trả giấy báo cho sinh viên ' + data['tensv'][sobd] +' thành công');
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
     var data = [$(this).attr('data-stt'), $(this).attr('data-sbd'), $(this).attr('data-hoten'), $(this).attr('data-ban'),manhinh];
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
     var data = [$(this).attr('data-sbd')];
     console.log(data);
     socket.emit("Client-sent-data-delete",data);
});
  $(document).on('click', 'button[name="chuyentiep"]', function() {
     sobd = $(this).val();
     $.ajax({
          url  : window.location.pathname,
          type : 'post',
          data : {
               'action' : 'chuyentiep',
               'sobd'   : sobd
          }, 
          success:function(data){
            res = JSON.parse(data);
            console.log(res);
            alert("Chuyển tiếp thành công! Mời sinh viên "+res['hoten']+" lên nộp hồ sơ với STT: "+res['stt']);
          },
     });
  });
  $(document).on('click', 'button[name="boqua"]', function() {
    // cf = confirm("Bạn có chắc chắn muốn bỏ qua sinh viên này?");
    // if(cf){
      sobd = $(this).val();
      hoten = $(this).attr('data-hoten');
      $(this).html('Trả GB & Đi về &nbsp; <i class="fa fa-spinner fa-spin"></i>')
       $.ajax({
            url  : window.location.pathname,
            type : 'post',
            data : {
                 'action' : 'boqua',
                 'sobd'   : sobd
            }, 
            success:function(data){
              toastr.success('Bạn vừa bỏ qua sinh viên '+hoten,'Thông báo');
            },
       });
    // }
     
  });
});

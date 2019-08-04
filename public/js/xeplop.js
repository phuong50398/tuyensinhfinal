$(document).ready(function($) {
	// hiện thị danh sách lớp
	var manganh = 0;
	$(document).on('change','select[name="nganhhoc"]', function(){
		manganh = $(this).val();
		$('#tb1 tr').remove();
		$.ajax({
			'url'  : window.location.pathname,
			'type' : 'post',
			 data  : {
			 	'action'  : 'get_lophoc_nganh',
			 	'manganh' : manganh
			 },
			 success:function(data){
			 	data = JSON.parse(data);
			 	html = '';
			 	html += '<option selected="" disabled="">----Chọn lớp học----</option>';
			 	$.each(data['lophoc'], function(index, el) {
			 		html += '<option value="'+el['malop']+'">'+el['tenlop']+'</option>';
			 	});
			 	table = '';
			 	$.each(data['dssv_nganh'], function(index, el) {
					table += '<tr>';
					table += '<td  style="text-align: center;">';
					table += '<div class="checkbox checkbox-primary">';
					table += '<input type="checkbox" id="'+index+'_right_'+el['masv']+'" class="check" value="'+el['masv']+'">';
					table += '<label for="'+index+'_right_'+el['masv']+'"></label>';
					table += '</div>';
					table += '</td>';
					table += '<td>'+ data['danhmuc']['hoten'][el['masv']] +'</td>';
					table += '<td>'+ data['danhmuc']['tennganh'][el['FK_sMaNganh']] +'</td>';
					table += '<td>'+ data['danhmuc']['ngaysinh'][el['masv']] +'</td>';
					table += '<td>'+ data['danhmuc']['gioitinh'][el['masv']] +'</td>';
					table += '</tr>';
				});
			 	$('#tb').html(table);
			 	$('select[name="lophoc"]').html(html);
			 }
		});
	});
	$(document).on('change', 'select[name="lophoc"]', function(){
		lop     = $(this).val();
		$.ajax({
			url  : window.location.pathname,
			type : 'post',
			data:{
				'action' : 'hienthi_lop',
				'lop'    : lop,
				'nganh'  : manganh
			},
			success:function(data){
				data = JSON.parse(data);
				var html = '';
				$.each(data['dslop'], function(index, el) {
					html += '<tr>';
					html += '<td  style="text-align: center;">';
					html += '<div class="checkbox checkbox-primary">';
					html += '<input type="checkbox" id="'+index+'_right_'+el['masv']+'" class="check" value="'+el['masv']+'">';
					html += '<label for="'+index+'_right_'+el['masv']+'"></label>';
					html += '</div>';
					html += '</td>';
					html += '<td>'+ data['danhmuc']['hoten'][el['masv']] +'</td>';
					html += '<td>'+ data['nganh'][el['masv']] +'</td>';
					html += '<td>'+ data['danhmuc']['ngaysinh'][el['masv']] +'</td>';
					html += '<td>'+ data['danhmuc']['gioitinh'][el['masv']] +'</td>';
					html += '</tr>';
				});
				var table = '';
				$.each(data['svchuaxep'], function(index, el) {
					table += '<tr>';
					table += '<td  style="text-align: center;">';
					table += '<div class="checkbox checkbox-primary">';
					table += '<input type="checkbox" id="'+index+'_right_'+el['masv']+'" class="check" value="'+el['masv']+'">';
					table += '<label for="'+index+'_right_'+el['masv']+'"></label>';
					table += '</div>';
					table += '</td>';
					table += '<td>'+ data['danhmuc']['hoten'][el['masv']] +'</td>';
					table += '<td>'+ data['danhmuc']['tennganh'][el['FK_sMaNganh']] +'</td>';
					table += '<td>'+ data['danhmuc']['ngaysinh'][el['masv']] +'</td>';
					table += '<td>'+ data['danhmuc']['gioitinh'][el['masv']] +'</td>';
					table += '</tr>';
				});
				$('#tb').html(table);
				$('#tb1').html(html);
			},
		});
	});


	$('#checkall_left').change(function(event) {
		tr = $('#tb').find('tr');
		for (var i = 0; i < tr.length; i++) {
			if(tr.eq(i).css('display') != 'none'){
				tr.eq(i).find('.check').prop('checked',$(this).prop("checked")); 
			}
		}
	});
	$('#checkall_right').change(function(event) {
		tr = $('#tb1').find('tr');
		for (var i = 0; i < tr.length; i++) {
			if(tr.eq(i).css('display') != 'none'){
				tr.eq(i).find('.check').prop('checked',$(this).prop("checked")); 
			}
		}
	});
	
	$(document).on('click', '#go-to-right', function() {
		changRow('#tb', '#checkall_left', '#tb1');
	});

	$(document).on('click', '#go-to-left', function() {
		changRow('#tb1', '#checkall_right', '#tb');
	});
	function changRow(tb, check, tb1){
		tb = $(tb).find('input:checked').parent().parent().parent();
		// $('.check:checked').each(function(index, value) {
			$('.check').prop('checked', false);
			tb.remove();
			$(check).prop('checked', false);
			$(tb1).append(tb);
		// });
	}

	// lưu sinh viên lớp
	
	$(document).on('click','#luumon', function(){
		tb 		= $("#tableright").find('.check');
		lop     = $('select[name="lophoc"]').val();
		if(lop == null){
			toastr.error('Lớp học không được để trống', 'Thông báo');
		}else{
			arr_sv  = [];
			for (var i = 0; i < tb.length; i++) {
				msv   = tb.eq(i).val();
				arr_sv.push({'masv' :msv, 'malop' : lop});
			}
			$.ajax({
				url  : window.location.pathname,
				type : 'post',
				data:{
					'action' : 'xeplop',
					'arr_sv' : arr_sv,
					'lop'    : lop,
				},
				success:function(data){
					if(data == 'thanhcong'){
						toastr.success('Xếp lớp thành công', 'Thông báo');
					}else{
						if(data == "huythanhcong"){
							toastr.success('Hủy lớp của tất cả sinh viên thành công', 'Thông báo');
						}else{
							toastr.error('Xếp lớp thất bại', 'Thông báo');
						}
					}
					
				},
			});
		}
	});

});


$(document).ready(function() {
    $('#myInput').on("keyup",function(){
		var value = $(this).val().toLowerCase();
		$("#tb tr").filter(function(){
			$(this).toggle($(this).text().toLowerCase().indexOf(value)>-1);
			$('#tableleft').find('input[type="checkbox"]').prop('checked',false); 
		});
	});
});



$(document).ready(function() {
    //search
	$("#search-right").on("keyup",function(){
		var value = $(this).val().toLowerCase();
		$("#tb1 tr").filter(function(index) {
			$(this).toggle($(this).text().toLowerCase().indexOf(value)>-1);
			$('#tableright').find('input[type="checkbox"]').prop('checked', false); 
		});
	});
}); 
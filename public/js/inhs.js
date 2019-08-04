jQuery(document).ready(function($) {
	window.onbeforeprint = function() {
		console.log('This will be called before the user prints.');
	};
	window.onafterprint = function() {
		dscheck_hs = $('input[name="dscheck_hs"]').val();
		soBD = $('input[name="soBD"]').val();
		console.log(dscheck_hs);
		console.log(soBD);
		$.ajax({
			url: window.location.pathname,
			type: 'post',
			data: {
				'action': 'save_hs',
				'dscheck_hs': dscheck_hs,
				'soBD': soBD
			},
			success: function(data) {
				console.log('success');
			}
		});
	};

});
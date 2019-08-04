
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hê thống hỗ trợ tuyển sinh Trường Đại Học Mở Hà Nội</title>
    <link rel="icon" href="{base_url()}public/images/DV01.png">
    <link rel="stylesheet" href="{base_url()}public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{base_url()}public/css/style.css">
    <link rel="stylesheet" type="text/css" href="{base_url()}public/css/animate.css">
    <script src="{base_url()}public/jquery/jquery.js"></script>
    <script src="{base_url()}public/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
       <div class="NoPermission">
        <div class="col-md-6 col-lg-offset-3">
        	<p class="title">Hồ sơ không được để trống!</p>
			<button class="btn btn-info" name="quaylai">Quay lại</button>
        </div>
    </div>
</div>
</body>
<style type="text/css">
	.btn-info{
		    background-color: #273d47;
			border:none;
	}
	.btn-info:hover{
		background-color: #3f474a;
	}
	.title{
		margin-top: 50px;
		font-size: 20px;
		font-weight: bold;
		color:red;
	}
</style>
<script type="text/javascript">
	$(document).on('click', 'button[name="quaylai"]', function(){
		window.close();
	});
</script>

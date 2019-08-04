<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Đăng nhập</title>
	<link rel="stylesheet" href="{base_url()}public/css/bootstrap.min.css">
	<link rel="stylesheet" href="{base_url()}public/css/login.css">
	<link rel="stylesheet" href="{base_url()}public/css/all.css">
	<link rel="icon" href="{base_url()}public/images/logovien.png">
	<script src="{base_url()}public/jquery/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="{base_url()}public/Toastr/toastr.css">
    <script type="text/javascript" src="{base_url()}public/Toastr/tienganh.js"></script>
    <script type="text/javascript" src="{base_url()}public/Toastr/toastr.js"></script>
	<script src="{base_url()}public/js/login.js"></script>
</head >
<body  style="background: url('{base_url()}public/images/background.jpg') no-repeat center center fixed; background-size: cover;" >
	<div class="login">
		<div class="col-md-12" style="padding:0;">
			<div class="hethong  text-center" style="padding-top: 0;">
				<h1 style="background: #8a2be27a;padding: 20px;" class="title_h1">HỆ THỐNG TUYỂN SINH TRƯỜNG ĐẠI HỌC MỞ HÀ NỘI</h1>
			</div>
		</div>
		<div class="login-form">
		    <form action="" method="post">
				<div class="avatar">
					<img src="{base_url()}public/images/avatar.png" alt="Avatar">
				</div>
		        <h2 class="text-center">Đăng Nhập</h2>   
		        <div class="form-group">
		        	<input type="text" class="form-control" id = "taikhoan"  name="taikhoan" placeholder="Số báo danh..." required="">
		        </div>
		        {if isset($tb)}<p style="color:red;">{$tb}</p>{/if}
				<div class="form-group">
		            <input type="password" class="form-control" id = "matkhau" name="matkhau" placeholder="CMND/Thẻ căn cước" required="">
		        </div>        
		        <div class="form-group text-center">
		        	<p id="baoloilogin" style="color: red;"></p>
		            <button class="btn btn-success" onclick="validateForm();" name="submit" type="submit" value="submit">Đăng nhập </button>
		        </div>
		    </form>
		</div>
	</div> <!-- End class login -->
	{if !empty($message)}
	<script type="text/javascript">
		  setTimeout(function() {
		    toastr.options = {
		      closeButton: true,
		      progressBar: true,
		      showMethod: 'slideDown',
		      timeOut: 5000
		    };
		    toastr.{$message.type}("{$message.title}","{$message.message}");
		  }, 200);
	</script>
	{/if}   
</body>
</html>
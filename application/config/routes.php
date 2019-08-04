<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['Welcome']                     		= 'Ctrangchu';
$route['Can-bo']                     		= 'canbo/Ccanbo';
$route['Ho-tro-nhap-hoc']             		= 'danhmuc/Chotro_nhaphoc';
$route['Tra-giay-bao-can-bo']             	= 'danhmuc/Ctragiaybao_cb';
$route['Thu-phieu-diem']              		= 'danhmuc/Cthuphieudiem';
$route['Danh-sach-thu-phieu-diem']    		= 'danhmuc/Cthuphieudiem/danhsachthuphieudiem';
// $route['Hien-thi-man-hinh']		     		= 'danhmuc/Chienthimanhinh';
$route['Tra-giay-bao']               	 	= 'danhmuc/Ctragiaybao';
$route['Da-tra-giay-bao']             		= 'danhmuc/Ctragiaybao/datragiaybao';
$route['Thu-tai-chinh']               		= 'danhmuc/Cthutaichinh';
$route['Bao-cao-thong-ke']            		= 'danhmuc/Cbaocaothongke';
$route['Thu-ho-so']                   		= 'danhmuc/Cthuhoso_nhaphoc';
$route['Dang-ky-thong-tin-sinh-vien'] 		= 'danhmuc/Cdkttsv';
$route['Excel']            			  		= 'danhmuc/Cbaocaothongke/excel';
$route['Dang-ky-thanh-cong'] 		  		= 'danhmuc/Cdkttsv/dangkythanhcong';
$route['Danh-muc-dot'] 		          		= 'danhmuc/Cdanhmucdot';
$route['Dang-ky-thong-tin-can-bo-nhap-hoc'] = 'canbo/Cdangkithongtin';
$route['login'] 							= 'Clogin';
$route['xep-lop-sinh-vien'] 				= 'danhmuc/Cxeplop';
$route['tao-lop-sinh-vien'] 				= 'danhmuc/Ctaolopsinhvien';
$route['doimk'] 							= 'canbo/Cdoimk';
$route['tiepdon'] 							= 'danhmuc/Cletan';
$route['Rut-ho-so']= 'danhmuc/Cruthoso';
$route['resetbuoctiep'] 							= 'canbo/Cdoimk/resetbuoctiep';

$route['Hien-thi-man-hinh']		     		= 'danhmuc/Chienthimanhinh';
$route['Hien-thi-man-hinh-thu-ho-so']		= 'danhmuc/Chienthimanhinh/manhinh_thuhoso';
$route['Hien-thi-man-hinh-thu-tai-chinh']	= 'danhmuc/Chienthimanhinh/manhinh_thutaichinh';

// $route['default_controller'] 	= 'welcome';
$route['default_controller'] 	= 'Clogin'; 
$route['403_Forbidden'] 		= 'C403';
$route['404_override'] 			= '';
$route['translate_uri_dashes'] 	= FALSE;

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 public function __construct()
     {
         parent::__construct();
         $this->load->model('Mtest');
     }
	public function index()
	{
		if($this->input->post('in')){
			$ma = $this->input->post('tien');
			if(isset($ma)){
				$matien = implode(",", $this->input->post('tien'));
				$get_hp = $this->Mtest->get_row('tbl_hocphi');
				if(strstr($matien, "hp")){
					$hp     = $get_hp['hp'];
				}else{
					$hp     = 0 ;
				}

				if (strstr($matien, "sk")) {
					$sk = $get_hp['sk'];
				}else{
					$sk = 0;
				}

				if(strstr($matien, "yt")){
					$yt = $get_hp['yt'];
				}else{
					$yt = 0;
				}

				if(strstr($matien, "the")){
					$the     = $get_hp['the'];
				}else{
					$the     = 0 ;
				}

				if (strstr($matien, "tt1")) {
					$tt1 = $get_hp['tt1'];
				}else{
					$tt1 = 0;
				}
				if (strstr($matien, "tt2")) {
					$tt2 = $get_hp['tt2'];
				}else{
					$tt2 = 0;
				}

				echo $hp .' '. $sk .' '. $yt .' '. $the .' '. $tt1 .' '. $tt2;
				$tongtien = $hp + $sk + $yt + $the + $tt1 + $tt2;
				$vnd = $this->VndText($tongtien);
				echo '<br>'. number_format($tongtien,0, '.', '.').' Đồng' .'<br>';
				echo($vnd);
			}
		
			

		}
		$data['message'] = getMessages();
    	$temp['data'] = $data;
    	$temp['template'] = 'Vtest';
    	$this->load->view('layout/content', $temp);
		
	}
	public function VndText($amount){
		if($amount <=0)
		{
			return $textnumber="Tiền phải là số nguyên dương lớn hơn số 0";
		}
		$Text=array("không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín");
		$TextLuythua =array("","nghìn", "triệu", "tỷ", "ngàn tỷ", "triệu tỷ", "tỷ tỷ");
		$textnumber = "";
		$length = strlen($amount);

		for ($i = 0; $i < $length; $i++)
			$unread[$i] = 0;

		for ($i = 0; $i < $length; $i++)
		{               
			$so = substr($amount, $length - $i -1 , 1);                

			if ( ($so == 0) && ($i % 3 == 0) && ($unread[$i] == 0)){
				for ($j = $i+1 ; $j < $length ; $j ++)
				{
					$so1 = substr($amount,$length - $j -1, 1);
					if ($so1 != 0)
						break;
				}                       

				if (intval(($j - $i )/3) > 0){
					for ($k = $i ; $k <intval(($j-$i)/3)*3 + $i; $k++)
						$unread[$k] =1;
				}
			}
		}

		for ($i = 0; $i < $length; $i++)
		{        
			$so = substr($amount,$length - $i -1, 1);       
			if ($unread[$i] ==1)
				continue;

			if ( ($i% 3 == 0) && ($i > 0))
				$textnumber = $TextLuythua[$i/3] ." ". $textnumber;     

			if ($i % 3 == 2 )
				$textnumber = 'trăm ' . $textnumber;

			if ($i % 3 == 1)
				$textnumber = 'mươi ' . $textnumber;
				$textnumber = $Text[$so] ." ". $textnumber;
			}

	        //Phai de cac ham replace theo dung thu tu nhu the nay
		$textnumber = str_replace("không mươi", "lẻ", $textnumber);
		$textnumber = str_replace("lẻ không", "", $textnumber);
		$textnumber = str_replace("mươi không", "mươi", $textnumber);
		$textnumber = str_replace("một mươi", "mười", $textnumber);
		$textnumber = str_replace("mươi năm", "mươi năm", $textnumber);
		$textnumber = str_replace("mươi một", "mươi mốt", $textnumber);
		$textnumber = str_replace("mười năm", "mười năm", $textnumber);
		return ucfirst($textnumber."đồng");
	}
}

<?php


$CI_INSTANCE = [];  # It keeps a ref to global CI instance

function register_ci_instance(\App\Controllers\BaseController &$_ci)
{
    global $CI_INSTANCE;
    $CI_INSTANCE[0] = &$_ci;
}


function &get_instance(): \App\Controllers\BaseController
{
    global $CI_INSTANCE;
    return $CI_INSTANCE[0];
}

if ( ! function_exists('data_encode'))
{
	function data_encode($string)
	{
		$ciphering = "AES-128-CTR"; 
		$iv_length = openssl_cipher_iv_length($ciphering); 
		$options = 0; 
		$encryption_iv = '1234567891011121'; 
		$encryption_key = "GeniusWebSolutionsWorkingWithPCTIL"; 
		$encryption = openssl_encrypt($string, $ciphering, $encryption_key, $options, $encryption_iv); 
		return $encryption;
	}
}

if ( ! function_exists('data_decode'))
{
	function data_decode($string)
	{
		$ciphering = "AES-128-CTR"; 
		$iv_length = openssl_cipher_iv_length($ciphering); 
		$options = 0; 
		$decryption_iv = '1234567891011121'; 
		$decryption_key = "GeniusWebSolutionsWorkingWithPCTIL"; 
		$decryption=openssl_decrypt ($string, $ciphering, $decryption_key, $options, $decryption_iv); 
		return $decryption;
	}
}

if ( ! function_exists('mysql_clean'))
{
	function mysql_clean($data)
	{
		$clean_input = array();
		if(is_array($data))
		{
			foreach($data as $k => $v)
			{
				$clean_input[$k] = mysql_clean($v);
			}
		}
		else
		{
			$data=str_replace('{','',$data);
			$data=str_replace('}','',$data);
			$data=str_replace('(','',$data);
			$data=str_replace(')','',$data);
			$data=str_replace('<','',$data);
			$data=str_replace('>','',$data);
			$data=str_replace('"','',$data);
			$data=str_replace("'",'',$data);
			$data=str_replace(';','',$data);
			$data=str_replace('^','',$data);
			$clean_input = trim(htmlentities(strip_tags($data)));
		}
		//$not_allowd_char = array("'", '"', ";");
		return $clean_input;
	}
}


if(!function_exists('get_menu'))
{
	function get_menu()
	{
		$ci =& get_instance(); 
		$data['session'] = $ci->session->get('adminlogin');
		if(isset($data['session']['user_id']))
		{
			$join = array(
				array(
					'table'=>'lms_tab',
					'condition' => 'lms_user_access.tab_id=lms_tab.id',
					'type' => 'left'
					),
				array(
					'table' => 'lms_tab_group',
					'condition' => 'lms_tab.tab_group=lms_tab_group.id',
					'type' => 'left'
				)
			);
			$whr = array('user_id'=>$data['session']['user_id'],'lms_user_access.status'=>'A');
			$tab = $ci->curd_model->jointable('lms_tab.name,lms_tab.page_url,lms_tab_group.themify,lms_tab_group.name as group_name,lms_user_access.other_action', 'lms_user_access', $join, $whr, 'true', 'lms_tab_group.id', 'desc');
			foreach($tab as $tb)
			{
				
				$data['tab'][$tb->group_name]['icon'] = $tb->themify;
				$data['tab'][$tb->group_name]['menu'][$tb->name] = $tb->page_url;
				$data['url'][] = $tb->page_url;
				$data['action_access'][$tb->page_url] = $tb->other_action;
				
			}
			return $data;
		}
	}
}

if(!function_exists('generate_captcha'))
{
	function generate_captcha()
	{
		$image_width = 280;
		$image_height = 50;
		$characters_on_image = 6;
		// var_dump(realpath('./monofont.ttf'));
		$font = realpath('./assets/fonts/monofont.ttf');

		//The characters that can be used in the CAPTCHA code.
		//avoid confusing characters (l 1 and i for example)
		$possible_letters = '23456789bcdfghjkmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ';
		$random_dots = 30;
		$random_lines = 20;
		$captcha_text_color="0x142864";
		$captcha_noice_color = "0x142864";

		$code = '';


		$i = 0;
		while ($i < $characters_on_image) { 
			$code .= substr($possible_letters, mt_rand(0, strlen($possible_letters)-1), 1);
			$i++;
		}


		$font_size = $image_height * .75;
		$image = @imagecreate($image_width, $image_height);


		/* setting the background, text and noise colours here */
		$background_color = imagecolorallocate($image, 255, 255, 255);

		$arr_text_color = hexrgb($captcha_text_color);
		$text_color = imagecolorallocate($image, $arr_text_color['red'],$arr_text_color['green'], $arr_text_color['blue']);

		$arr_noice_color = hexrgb($captcha_noice_color);
		$image_noise_color = imagecolorallocate($image, $arr_noice_color['red'],$arr_noice_color['green'], $arr_noice_color['blue']);


		/* generating the dots randomly in background */
		for( $i=0; $i<$random_dots; $i++ ) {
			imagefilledellipse($image, mt_rand(0,$image_width),mt_rand(0,$image_height), 2, 3, $image_noise_color);
		}


		/* generating lines randomly in background of image */
		for( $i=0; $i<$random_lines; $i++ ) {
			imageline($image, mt_rand(0,$image_width), mt_rand(0,$image_height),mt_rand(0,$image_width), mt_rand(0,$image_height), $image_noise_color);
		}


		/* create a text box and add 6 letters code in it */
		$textbox = imagettfbbox($font_size, 0, $font, $code); 
		$x = intval(($image_width - $textbox[4])/2);
		$y = intval(($image_height - $textbox[5])/2);
		imagettftext($image, $font_size, 0, $x, $y, $text_color, $font , $code);

		// var_dump($image);exit;
		/* Show captcha image in the page html page */
		header('Content-Type: image/jpeg');// defining the image type to be shown in browser widow
		imagejpeg($image);//showing the image
		imagedestroy($image);//destroying the image instance
		$_SESSION['catcha_code'] = $code;
	}
}

if(! function_exists('hexrgb'))
{
	function hexrgb($hexstr)
	{
		$int = hexdec($hexstr);
		return array("red" => 0xFF & ($int >> 0x10),"green" => 0xFF & ($int >> 0x8),"blue" => 0xFF & $int);
	}
}

if(!function_exists('web_file_location'))
{
    function web_file_location()
    {
		$var = "../";
        return $var;
    }   
}


if(!function_exists('web_url'))
{
    function web_url($url = '')
    {
		$var = "http://localhost:8081/cftedu/".$url;
        return $var;
    }   
}


?>
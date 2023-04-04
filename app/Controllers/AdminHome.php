<?php

namespace App\Controllers;

use CodeIgniter\Controller;


class AdminHome extends BaseController
{

    public function index()
    {
		//echo '('.$_SERVER['REMOTE_ADDR'].')';die();
		$chk = $this->curd_model->get_1('ip_address', 'allowed_ip', array('status'=>'A', 'ip_address'=>$_SERVER['REMOTE_ADDR']));
	
        if(isset($chk->ip_address))
		{
            
			$data['allow'] = true;   
			return view('adminlogin',$data);
		}
		else
		{
            
			$data['allow'] = false;   
			$data['ip'] = $_SERVER['REMOTE_ADDR'];   
			return view('adminlogin',$data);
		}
    }

    public function catch_captcha()
    {
    return (generate_captcha());
    }
}

?>
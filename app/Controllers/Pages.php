<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CurdModel;

    class Pages extends BaseController{
		public function __construct(){
			// if($this->session->get('adminlogin') !== null){
			// 	redirect(site_url('dashboard'));
			// }
			//parent::__construct();
			//$this->curd_model->update_session();
            //var_dump($session->get('adminlogin'));
        }
		/*--------------View Section------------------*/
		public function view($url = "")
		{
			$data = array();
			
			$data['session'] = $this->session->get('adminlogin');
			$data = get_menu();
			
		
			$url = explode('.',$url);
			
			if($url[0] == 'dashboard')
			{
				$stage = $this->curd_model->get_all('*', 'cust_stage', array('status'=>'A'), 'id', 'ASC');					
			}
			if($url[0] == 'visitor')
			{
				$data['cust_stage'] = $this->curd_model->get_all('*', 'cust_stage', array('status'=>'A'), 'id', 'ASC');
				$data['program'] = $this->curd_model->get_all('*', 'program', array('status'=>'A'), 'id', 'ASC');
				
			}
			else if($url[0] == "user" && in_array('user',$data['url']))
			{
				//convert in wcpa
				$data['status'] = isset($_POST['status'])?$_POST['status']:'A';
				$emp = $this->curd_model->get_all('*', 'cons_login', array('status'=>'A'), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$user_type = $this->curd_model->get_all('*', 'cons_user_type', array('status'=>'A'), 'name', 'ASC');
				foreach($user_type as $ut)
				{
					$data['user_type'][$ut->user_key] = $ut;
				}
				$data['emp'] = $this->curd_model->get_all('*', 'cons_login', array('status'=>$data['status']), 'f_name', 'ASC');
			}
			else if($url[0] == "logout")
			{
				//convert in wcpa
				session_destroy();
				redirect(base_url());
			}
			
			if(in_array($url[0],$data['url']) || $url[0] == "dashboard")
			{
				$emp = $this->curd_model->get_all('*', 'cons_login', array('status'=>'A'), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				return view('lms/'.$url[0], $data);
			}
			else
			{
				var_dump($url);
				//show_404();
			}
		}
	}
?>
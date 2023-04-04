<?php
namespace App\Controllers;

use CodeIgniter\Controller;


    class Login extends BaseController{
		
        public function index(){
			
           
			$chk = $this->curd_model->get_1('ip_address', 'allowed_ip', array('status'=>'A', 'ip_address'=>$_SERVER['REMOTE_ADDR']));
			if(1 || $chk)
			{
				$data['allow'] = true;   
				return view('loginpage',$data);
			}
			else
			{
				$data['allow'] = false;   
				$data['ip'] = $_SERVER['REMOTE_ADDR'];   
				return view('loginpage',$data);
			}
		}



        public function signin()
        {
            $error = array('success' => false,'error_token'=>array('cname'=>csrf_token(),'cvalue'=>csrf_hash()), 'message' =>array(),'border'=>true);
            $frmdata = $this->request->getPost();
            $check = $this->validate([
                'user_email' => [
                    'rules' =>  'required|valid_email',
                    'errors' =>  [
                        'required' => 'User Email is required',
                        'valid_email'   =>  'You must provide a valid email address.'
                    ]
                ],
                'user_pass' => [
                    'rules' =>  'required',
                    'errors' =>  [
                        'required' => 'User Password is required'
                    ]
                ],
                'captcha_code' => [
                    'rules' =>  'required',
                    'errors' =>  [
                        'required' => 'Captcha is required'
                    ]
                ]
            ]);
            if($check)
            {
                $captcha_code = $this->session->get('catcha_code');
                if($frmdata['captcha_code'] === $captcha_code)
                {
                    $sql = $this->curd_model->get_1('*', 'login', array('email_id'=>$frmdata['user_email'], 'status'=>'A'));
                    if($sql){
                        if($sql->password === hash('sha256', $frmdata['user_pass'])){
                            $login_data = array('user_id'=>$sql->id,'login_time'=>date('Y-m-d H:i:s'),'ip_address'=>$_SERVER['REMOTE_ADDR'],'last_activity_time'=>date('Y-m-d H:i:s'));
                            $sql1 = $this->curd_model->insert('login_history', $login_data);
                            $data = array(
                                'user_id' => $sql->id,
                                'login_id' => $sql1,
                                'f_name' => $sql->f_name,
                                'l_name' => $sql->l_name,
                                'type' => $sql->type,
                                'email_id' => $sql->email_id
                            );
                            $this->session->set('adminlogin', $data);
                            $this->curd_model->update_table('login',array('session_id'=>$sql1),array('id'=>$sql->id));
                            $error['success'] = true;
                            $error['rlink'] = 'web-admin/dashboard';
                        }else{
                            $error['message']['user_pass'] = '<span class="frm-error login_error">Invalid password, please try again. </span>';
                        }
                    }else{
                        $error['message']['user_email'] = '<span class="frm-error login_error">Invalid email id, Please check and try again. </span>';
                    }
                }
                else
                {
                    $error['message']['refrence'] = 'Captcha is not verified properly please try again.';
                }
            }
            else
            {
                foreach($_POST as $key =>$value)
                {
                    if ($this->validation->hasError($key)) {
                        $error['message'][$key] = $this->validation->getError($key);
                    }
                }
            }
            echo json_encode($error);
        }
        
        
        
        public function forgetpas(){
            $error = array('success' => false, 'message' =>array());
            $frmdata = $this->input->post();
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<span class="frm-error login_error">','</span>');
            $this->form_validation->set_rules('forget_email', 'Login email', 'trim|required|valid_email');
            if($this->form_validation->run()){
                    $sql = $this->curd_model->get_1('email_id,f_name,password', 'login', array('email_id'=>$frmdata['forget_email'], 'status'=>'A'));
                    if($sql){
                        $this->load->helper('mailtemp');
                        $msg = recoverpass($sql->f_name, $sql->email_id, $sql->password);
                        //$msg = "Testing mail ";
                        $email_check = $this->send_email($sql->email_id, 'Password recovery mail', $msg);
                        if($email_check['success'])
						{
							$error['alert1'] = '<div class="text-center alert alert-success"><p class="m-t-30">The login details sent on your official email. please check your inbox.</p><h5 class="m-t-20"><a href="'.site_url().'" class="badge badge-info p-10">Back to login</a></h5><div>';
							$error['success'] = true;
						}
						else
						{
							$error['alert1'] = '<div class="text-center alert alert-success"><p class="m-t-30">'.$email_check['message'].'</p><h5 class="m-t-20"><a href="'.site_url().'" class="badge badge-info p-10">Back to login</a></h5><div>';
							$error['success'] = true;
						}
                    }else{
                        $error['message']['forget_email'] = '<span class="frm-error login_error">Invalid email id, Please check and try again. </span>';
                    }
                
            }else{
                foreach($_POST as $key=>$value){
                    $error['message'][$key] = form_error($key);
                }
            }
            echo json_encode($error);
        }
        

        
    }    
?>
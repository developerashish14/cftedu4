<?php 

 class User extends CI_controller{
		public function __construct(){
            parent:: __construct();
			date_default_timezone_set('Asia/Kolkata');
            if(!$this->session->userdata('adminlogin')){
                redirect(site_url('logout'));
            }
			$this->curd_model->update_session();
        }
		
		public function user_access()
		{
			$data = get_menu();
			if(in_array('user',$data['url']))
			{
				$data['other_action'] = explode(" ",$data['action_access']['user']);
				
				$data['user_id'] = (isset($_GET['user_id'])?$_GET['user_id']:'');
				if($data['user_id'] != "")
				{
					$emp = $this->curd_model->get_all('*','cons_login',array('1'=>'1'),'f_name','ASC');
					foreach($emp as $em)
					{
						$data['user_info'][$em->id] = $em;
					}
					$join = array(
						array(
							'table' => 'cons_tab_group',
							'condition' => 'cons_tab.tab_group=cons_tab_group.id',
							'type' => 'left'
						)
					);
					$whr = array('1'=>'1');
					$menu = $this->curd_model->jointable('cons_tab.other_action,cons_tab.id as tab_id,cons_tab.name,cons_tab.page_url,cons_tab_group.themify,cons_tab_group.name as group_name', 'cons_tab', $join, $whr, 'true', 'cons_tab_group.id', 'desc');
					foreach($menu as $mn)
					{
						$data['menu'][$mn->group_name]['icon'] = $mn->themify;
						$data['menu'][$mn->group_name]['menu'][$mn->name] = array('url'=>$mn->page_url,'id'=>$mn->tab_id,'other_action'=>$mn->other_action);
					}
					$data['emp'] = $this->curd_model->get_all('*', 'cons_login', array('1'=>'1'), 'f_name', 'ASC');
					$data['user_type'] = $this->curd_model->get_all('*', 'cons_user_type', array('1'=>'1'), 'name', 'ASC');
					$data['emp_info'] = $this->curd_model->get_1('*', 'cons_login', array('id'=>$data['user_id']));
					$user_access = $this->curd_model->get_all('*', 'cons_user_access', array('user_id'=>$data['user_id']), 'tab_id', 'ASC');
					foreach($user_access as $ua)
					{
						$data['user_access'][$ua->tab_id] = array('status'=>$ua->status,'other_action'=>$ua->other_action);
					}
					$this->load->view('web-admin/user_access', $data);
				}
				else{
					redirect('course');
				}
			}
			else
			{
				redirect('dashboard');
			}
		}
 
		public function add_user()
		{
			
			$session = $this->session->userdata('adminlogin');
			$error = array('success'=>false, 'message'=>array(), 'border'=>true);
            $frmdata = $this->input->post();
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<span class="frm-error form_err">', '</span>');
            $this->form_validation->set_rules('fname', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Comment', 'required');
            if($this->form_validation->run()){
                $data = array(
                    'status' => 'A',
                    'create_time' => date('Y-m-d H:i:s'),
                    'update_time' => date('Y-m-d H:i:s'),
                    'update_by' => $session['user_id'],
                    'type' => $frmdata['type'],
                    'f_name' => $frmdata['fname'],
                    'l_name' => $frmdata['lname'],
                    'email_id' => $frmdata['email'],
                    'password' => $frmdata['fname'].'@'.rand(111,999)
                );
                $sql = $this->curd_model->insert('cons_login', $data);
                if($sql){
					$this->load->helper('mailtemp');
					$msg = joining_mail($data['f_name'], $data['email_id'], $data['password']);
					$this->send_email($data['email_id'], 'Welcome mail', $msg);
                    $error['success'] = true;
                }else{
                    $error['message']['refrence'] = '<p>Error in Services create please try again.</p>';
                }
            }else{
                foreach($_POST as $key=>$value){
                    $error['message'][$key] = form_error($key);
                }
            }
            
            echo json_encode($error);
			
		}
		
		public function update_access(){
			$session = $this->session->userdata('adminlogin');
			$error = array('success'=>false, 'message'=>array(), 'border'=>true);
            $frmdata = $this->input->post();
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<span class="frm-error form_err">', '</span>');
            $this->form_validation->set_rules('user_id', 'User', 'required');
            if($this->form_validation->run()){
				$this->curd_model->update('lms_user_access',array('status'=>'D','other_action'=>''),array('user_id'=>$frmdata['user_id']));
                foreach($frmdata['tab'] as $tab)
				{
					$action = "";
					if(isset($frmdata['action'][$tab]))
					{
						foreach($frmdata['action'][$tab] as $act)
						{
							$action .= $act.' ';
						}
					}
					$this->curd_model->customquery("
						INSERT INTO lms_user_access (`user_id`,`tab_id`,`status`,`other_action`) VALUES (".$frmdata['user_id'].",".$tab.",'A','".$action."') 
						ON DUPLICATE KEY UPDATE 
						`status` = 'A',
						`other_action` = '".$action."'
					");
				}
				$error['success'] = true;
			}else{
                foreach($_POST as $key=>$value){
                    $error['message'][$key] = form_error($key);
                }
            }
            
            echo json_encode($error);
		}
		
		public function update_user_info()
		{
			$session = $this->session->userdata('adminlogin');
			$error = array('success'=>false, 'message'=>array(), 'border'=>true);
            $frmdata = $this->input->post();
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<span class="frm-error form_err">', '</span>');
            $this->form_validation->set_rules('user_id', 'User', 'required');
            $this->form_validation->set_rules('f_name', 'User', 'required');
            $this->form_validation->set_rules('email', 'User', 'required');
            $this->form_validation->set_rules('password', 'User', 'required');
            if($this->form_validation->run()){
				$data = array(
                    'status' => $frmdata['status'],
                    'update_time' => date('Y-m-d H:i:s'),
                    'update_by' => $session['user_id'],
                    'type' => $frmdata['type'],
                    'f_name' => $frmdata['f_name'],
                    'l_name' => $frmdata['l_name'],
                    'email_id' => $frmdata['email'],
                    'password' => $frmdata['password']
                );
                $sql = $this->curd_model->update('cons_login', $data, array('id'=>$frmdata['user_id']));
                if($sql){
                    $error['success'] = true;
                }else{
                    $error['message']['refrence'] = '<p>Error in services update please try again.</p>';
                }
			}else{
                foreach($_POST as $key=>$value){
                    $error['message'][$key] = form_error($key);
                }
            }
            
            echo json_encode($error);
		}
		
		private function send_email($to, $subject, $message, $bcc = ''){
            $config = array(
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'smtp_crypto' => 'ssl'
            );

            $this->load->library('email', $config);
            $this->email->from('query@cftedu.in', 'CFT');
            $this->email->to($to);
            $this->email->bcc('gaurav.gom@gmail.com,'.$bcc);
            $this->email->subject($subject);
            $this->email->message($message);
            if($this->email->send()){
                return true;
            }else{
                return false;
            }
        }
 
 }
 
 ?>
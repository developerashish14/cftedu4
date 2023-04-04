<?php 
class Payment extends CI_controller{
	public function __construct(){
		parent:: __construct();
		date_default_timezone_set('Asia/Kolkata');
		if(!$this->session->userdata('adminlogin')){
			redirect(site_url('logout'));
		}
		$this->curd_model->update_session();
	}
	
	public function change_status(){
		$session = $this->session->userdata('adminlogin');
		$error = array('success'=>false, 'message'=>array(), 'border'=>true);
		$frmdata = $this->input->post();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="frm-error form_err">', '</span>');
		$this->form_validation->set_rules('chg_transaction_id', 'Transaction', 'required');
		$this->form_validation->set_rules('chg_membership_type', 'Membership', 'required');
		$this->form_validation->set_rules('chg_owner_type', 'OwnerType', 'required');
		$this->form_validation->set_rules('chg_owner_id', 'OwnerID', 'required');
		$this->form_validation->set_rules('chg_paymode', 'PayMode', 'required');
		$this->form_validation->set_rules('chg_txnid', 'Transaction ID', 'required');
		$this->form_validation->set_rules('remark', 'Remarks', 'required');
		$this->form_validation->set_rules('chg_status', 'Status', 'required');
		if($this->form_validation->run()){
			$transaction = $this->curd_model->get_1('*','amount_transaction',array('id'=>$frmdata['chg_transaction_id']));	
			if($transaction->id > 0)
			{
				if($transaction->status == 'C' && $frmdata['chg_status']=="P")
				{
					$at_data = array(
						'status' => 'P',
						'txnid' => $frmdata['chg_txnid'],
						'payment_mode' => $frmdata['chg_paymode']
					);
					$sql = $this->curd_model->update('amount_transaction', $at_data, array('id'=>$frmdata['chg_transaction_id']));
					if($sql)
					{
						$update_status = false;
						if($transaction->product_info == "ManualBill")
						{
							$MBill = $this->curd_model->update("payment_link",array('status'=>'R'),array('id'=>$transaction->owner_id));
							if($MBill)
							{
								$update_status = true;
							}
						}
						else
						{
							//Membership Activation
							$stu_info = $this->curd_model->get_1("*","student_registration",array('id'=>$transaction->owner_id));
							
							$member_type = (($transaction->product_info == 'BEGINNER')?1:(($transaction->product_info == "INTERMEDIATE")?2:(($transaction->product_info == "ADVANCED")?3:(($transaction->product_info == "PROFESSIONAL")?4:(($transaction->product_info == "SPECIAL")?5:1)))));
							$MVdata = array(
								'status' => 'A',
								'create_time' => date('Y-m-d H:i:s'),
								'last_update' => date('Y-m-d H:i:s'),
								'update_by' => $session['user_id'],
								'amount_transaction_id' => $transaction->id,
								'student_id' => $transaction->owner_id,
								'membership_type' => $member_type
							);
							$mv_id=$this->curd_model->insert('membership_validation',$MVdata);
							if($mv_id)
							{
								$this->load->helper('lmsapi');
								$lmsapi = lmsapi();
								$curl_data = array(
									'api_key' => $lmsapi['api_key'],
									'api_password' => $lmsapi['api_pass'],
									'email_id' => $stu_info->email_id,
									'old_user_type' => $stu_info->type,
									'new_user_type' => $member_type
								);
								
								$ch = curl_init();
								curl_setopt($ch, CURLOPT_URL,$lmsapi['update_student_url']);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
								curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($curl_data));
								$curl_response = json_decode(curl_exec($ch));
								curl_close($ch); // Close the connection
								if($curl_response->success && $curl_response->message->response === 'OK')
								{
									$sql3 = $this->curd_model->update('student_registration',array('type'=>$member_type),array('id'=>$stu_info->id));
									$update_status = true;
								}
								else
								{
									$this->curd_model->update('membership_validation',array('status'=>'D'),array('id'=>$mv_id));
									$error['message']['refrence'] = '<p>'.$curl_response->message->response.'</p>';
								}
							}
							else
							{
								$error['message']['refrence'] = '<p>Having issue in create membership.</p>';
							}
						}
						if($update_status)
						{
							$data = array(
								'status' => 'A',
								'insert_time' => date('Y-m-d H:i:s'),
								'insert_by' => $session['user_id'],
								'table_name' => 'amount_transaction',
								'table_id' => $frmdata['chg_transaction_id'],
								'remarks' => 'Status Has change to Payment. '.$frmdata['remark']
							);
							$sql1 = $this->curd_model->insert('action_remarks',$data);
							if($sql1)
							{
								$error['success'] = true;
							}
							else
							{
								$error['message']['refrence'] = '<p>Status update, but remarks not inserted.</p>';
							}
						}
						
					}else{
						$error['message']['refrence'] = '<p>Amount Status has not update.</p>';
					}
				}
				else if($transaction->status != 'C' && ($frmdata['chg_status']=="A" || $frmdata['chg_status']=="R"))
				{
					$at_data = array(
						'status' => $frmdata['chg_status'],
						'txnid' => $frmdata['chg_txnid'],
						'payment_mode' => $frmdata['chg_paymode']
					);
					$sql = $this->curd_model->update('amount_transaction', $at_data, array('id'=>$frmdata['chg_transaction_id']));
					if($sql){
						$data = array(
							'status' => 'A',
							'insert_time' => date('Y-m-d H:i:s'),
							'insert_by' => $session['user_id'],
							'table_name' => 'amount_transaction',
							'table_id' => $frmdata['chg_transaction_id'],
							'remarks' => 'Status Has change to '.(($frmdata['chg_status']=='A')?'Approved':'Rejected').'. '.$frmdata['remark']
						);
						$sql1 = $this->curd_model->insert('action_remarks',$data);
						if($sql1)
						{
							$error['success'] = true;
						}
						else
						{
							$error['message']['refrence'] = '<p>Status update, but remarks not inserted.</p>';
						}
					}else{
						$error['message']['refrence'] = '<p>Amount Status has not update.</p>';
					}
					
				}
				else
				{
					$error['message']['refrence'] = '<p>You can change payment, when you are in checkout, and approve or reject can be update when this is in payment status.</p>';
				}
				
			}
			else
			{
				$error['message']['refrence'] = '<p>Transaction Not Found.</p>';
			}
		}else{
			foreach($_POST as $key=>$value){
				$error['message'][$key] = form_error($key);
			}
		}
		
		echo json_encode($error);
	}
	
	public function add_payment()
	{
		$session = $this->session->userdata('adminlogin');
		$error = array('success'=>false, 'message'=>array(), 'border'=>true);
		$frmdata = $this->input->post();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="frm-error form_err">', '</span>');
		$this->form_validation->set_rules('email_id', 'Email ID', 'required');
		$this->form_validation->set_rules('txnid', 'Transaction ID', 'required');
		$this->form_validation->set_rules('price', 'Amount', 'required');
		$this->form_validation->set_rules('product', 'Product', 'required');
		$this->form_validation->set_rules('transaction_by', 'Transaction By', 'required');
		$this->form_validation->set_rules('payment_mode', 'Payment Type', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		if($this->form_validation->run())
		{
			$student = $this->curd_model->get_1('*','student_registration',array('email_id'=>$frmdata['email_id']));
			if(isset($student) && $student->id > 0)
			{
				$data = array(
					'status' => $frmdata['status'],
					'insert_time' => date('Y-m-d H:i:s'),
					'transaction_by' => $frmdata['transaction_by'],
					'owner_id' => $student->id,
					'txnid' => $frmdata['txnid'],
					'payment_mode' => $frmdata['payment_mode'],
					'price' => $frmdata['price'],
					'product_info' => $frmdata['product'],
					'name' => $student->name,
					'email' => $student->email_id,
					'phone' => $student->contact,
					'hash' => ''
				);
				$sql = $this->curd_model->insert('amount_transaction',$data);
				if($sql)
				{
					$member_type = (($frmdata['product'] == 'BEGINNER')?1:(($frmdata['product'] == "INTERMEDIATE")?2:(($frmdata['product'] == "ADVANCED")?3:(($frmdata['product'] == "PROFESSIONAL")?4:(($frmdata['product'] == "SPECIAL")?5:1)))));
					$data1 = array(
						'status' => 'A',
						'create_time' => date('Y-m-d H:i:s'),
						'last_update' => date('Y-m-d H:i:s'),
						'update_by' => $session['user_id'],
						'amount_transaction_id' => $sql,
						'student_id' => $student->id,
						'membership_type' => $member_type
					);
					$sql2=$this->curd_model->insert('membership_validation',$data1);
					if($sql2)
					{
						$this->load->helper('lmsapi');
						$lmsapi = lmsapi();
						$curl_data = array(
							'api_key' => $lmsapi['api_key'],
							'api_password' => $lmsapi['api_pass'],
							'email_id' => $student->email_id,
							'old_user_type' => $student->type,
							'new_user_type' => $member_type
						);
						
						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL,$lmsapi['update_student_url']);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($curl_data));
						$curl_response = json_decode(curl_exec($ch));
						curl_close($ch); // Close the connection
						if($curl_response->success && $curl_response->message->response === 'OK')
						{
							$sql3 = $this->curd_model->update('student_registration',array('type'=>$member_type),array('id'=>$student->id));
							$error['success'] = true;
						}
						else
						{
							$this->curd_model->update('membership_validation',array('status'=>'D'),array('id'=>$sql2));
							$error['message']['refrence'] = '<p>'.$curl_response->message->response.'</p>';
						}
					}
				}
				else
				{
					$error['message']['refrence'] = 'There is some issue in create offline payment.';
				}
			}
			else
			{
				$error['message']['refrence'] = 'Student not found please check email ID.';
			}
		}
		else
		{
			foreach($_POST as $key=>$value){
				$error['message'][$key] = form_error($key);
			}
		}
		
		echo json_encode($error);
	}
	
	public function add_payment_link()
	{
		$session = $this->session->userdata('adminlogin');
		$error = array('success'=>false, 'message'=>array(), 'border'=>true);
		$frmdata = $this->input->post();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="frm-error form_err">', '</span>');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email_id', 'Email ID', 'required|valid_email');
		$this->form_validation->set_rules('contact', 'Contact Number', 'required|is_natural');
		$this->form_validation->set_rules('product', 'Product', 'required');
		$this->form_validation->set_rules('amount', 'Amount', 'required|is_natural');
		if($this->form_validation->run())
		{
			$data =  array(
				'status' => 'P',
				'last_update' => date('Y-m-d H:i:s'),
				'update_by' => $session['user_id'],
				'name' => $frmdata['name'],
				'email_id' => $frmdata['email_id'],
				'contact' => $frmdata['contact'],
				'product' => $frmdata['product'],
				'detail' => $frmdata['detail'],
				'amount' => $frmdata['amount'],
				'type' => $frmdata['type']
			);
			
			$sql = $this->curd_model->insert('payment_link',$data);
			if($sql)
			{
				if(isset($frmdata['payment_type']) && $frmdata['payment_type'] == "international")
				{
					$int_data = array(
						'status' => 'A',
						'last_update' => date('Y-m-d H:i:s'),
						'update_by' => $session['user_id'],
						'bill_id' => $sql,
						'currency_type' => $frmdata['cur_type'],
						'currency_amt' => $frmdata['cur_amt'],
						'indian_amt' => $frmdata['amount']
					);
					$sql1 = $this->curd_model->insert('international_invoice',$int_data);
					if($sql1)
					{
						$error['success'] = true;
					}
					else
					{
						$error['message']['refrance'] = 'International invoice error.';
					}
				}
				else
				{
					$error['success'] = true;
				}
			}
			else
			{
				$error['message']['refrance'] = 'Error in insert data. Please try again.';
			}
		}
		else
		{
			foreach($_POST as $key=>$value){
				$error['message'][$key] = form_error($key);
			}
		}
		echo json_encode($error);
	}
	
	public function send_link_email()
	{
		$session = $this->session->userdata('adminlogin');
		$error = array('success'=>false, 'message'=>array(), 'border'=>true);
		$frmdata = $this->input->post();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="frm-error form_err">', '</span>');
		$this->form_validation->set_rules('id', 'Payment', 'required');
		if($this->form_validation->run()){
			
			$pay = $this->curd_model->get_1('*','payment_link', array('id'=>$frmdata['id']));
			if(isset($pay->id) && $pay->id >0 )
			{
				$str = $pay->name.'|'.$pay->email_id.'|'.$pay->contact.'|'.$pay->id;
				$url_link = urlencode($str);
				$base_link = web_url().'bill/payment.html?response='.base64_encode($url_link);
				$this->load->helper('mailtemp');
				$msg = payment_link_email($pay->name, $base_link, $pay->product, $pay->detail);
				$email_check = $this->send_email($pay->email_id, 'CFT Bill Payment of '.$pay->detail, $msg);
				if( $email_check )
				{
					$error['alert1'] = "Email Has send successfully.";
					$error['success'] = true; 
				}
				else
				{
					$error['message']['refrence'] = 'Email Not Send.';
				}
			}else{
				$error['message']['refrence'] = 'Student Not Found.';
			}
		}else{
			foreach($_POST as $key=>$value){
				$error['message'][$key] = form_error($key);
			}
		}
		
		echo json_encode($error);
	}
	
	public function detail_email()
	{
		$session = $this->session->userdata('adminlogin');
		$error = array('success'=>false, 'message'=>array(), 'border'=>true);
		$frmdata = $this->input->post();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="frm-error form_err">', '</span>');
		$this->form_validation->set_rules('id', 'Payment', 'required');
		if($this->form_validation->run()){
			
			$amt = $this->curd_model->get_1('*','amount_transaction', array('id'=>$frmdata['id']));
			if(isset($amt->id) && $amt->id >0 )
			{
				$this->load->helper('mailtemp');
				$msg = payment_email($amt->name, $amt->price, $amt->payment_mode, $amt->txnid, $amt->insert_time);
				$email_check = $this->send_email($amt->email, 'CFT Payment Information', $msg);
				if( $email_check )
				{
					$smsmsg = urlencode('Your payment of Rs. '.$amt->price.' has been confirmed by Center For Future Technology, Payment recived on '.$amt->insert_time.' using '.$amt->payment_mode.'. Your Transaction ID/Order ID is '.$amt->txnid);
					/*
					$otp_response = file_get_contents("http://103.245.200.229/api/mt/SendSMS?user=PCTILTD&password=PCTI@2019&senderid=PCTIin&channel=TRANS&DCS=0&flashsms=0&number=".$amt->phone."&text=".$smsmsg."&route=91");
					$otp_json = json_encode($otp_response);
					$otp_arr = json_decode(json_decode($otp_json));
					
					$error['otp_arr'] = $otp_arr; 
					*/
					$error['otp_msg'] = "http://103.245.200.229/api/mt/SendSMS?user=PCTILTD&password=PCTI@2019&senderid=PCTIin&channel=TRANS&DCS=0&flashsms=0&number=".$amt->phone."&text=".$smsmsg."&route=4"; 
					$error['success'] = true; 
				}
				else
				{
					$error['message']['refrence'] = 'Email Not Send.';
				}
			}else{
				$error['message']['refrence'] = 'Student Not Found.';
			}
		}else{
			foreach($_POST as $key=>$value){
				$error['message'][$key] = form_error($key);
			}
		}
		
		echo json_encode($error);
	}
	
	private function send_email($to, $subject, $message)
	{
		$config = array(
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'smtp_crypto' => 'tls',
			'newline' => '\r\n',
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.hostinger.in',
			'smtp_port' => '587',
			'smtp_user' => 'query@cftedu.in',
			'smtp_pass' => 'Passw0rd@q'
		);

		$this->load->library('email', $config);
		$this->email->from('query@cftedu.in', 'CFT');
		$this->email->to($to);
		$this->email->bcc('query@cftedu.in,gaurav@pctiltd.com');
		$this->email->subject($subject);
		$this->email->message($message);
		if($this->email->send())
		{
			return $arr = array('success'=>true);
		}
		else
		{
			return $arr = array('success'=>false,'message'=>$this->email->print_debugger());
		}
	}
}

?>
 
 
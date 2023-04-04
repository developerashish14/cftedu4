<?php
namespace App\Controllers;

use CodeIgniter\Controller;
class Visitor extends BaseController{
	public function __construct(){
		// parent:: __construct();
		// date_default_timezone_set('Asia/Kolkata');
		// if(!$this->session->userdata('adminlogin')){
		// 	redirect(site_url('logout'));
		// }
		// $this->curd_model->update_session();
		// if($this->session->get('adminlogin') !== null){
		// 	redirect(site_url('dashboard'));
		// }
	}
		
	public function catch_visitor_info()
	{
		$data['session'] = $this->session->get('adminlogin');
		$error = array();
		$frmdata = $this->request->getPost();
		//
		//
		$this->form_validation->setRules(['details' => ['label' => 'Details', 'rules' => 'required']]);
		if($this->form_validation->withRequest($this->request)->run())
		{
			//$customer = $this->curd_model->get_all('*','customer',array('contact'=>$frmdata['details']),'id','ASC');
			$customer = $this->curd_model->customquery1("select * from customer_details where `contact` LIKE '%".$frmdata['details']."%' order by id asc");
			
			if(count($customer) > 0)
			{
				foreach($customer as $cus)
				{
					$error[] = array('email'=>$cus->email,'contact'=>$cus->contact,'id'=>$cus->cust_id);
				}
			}
		}
		echo json_encode($error);
	}
	public function catch_visitor_on_select()
	{
		$data['session'] = $this->session->get('adminlogin');
		$error = array();
		$frmdata = $this->request->getPost();
		$this->form_validation->setRules(['visitor' => ['label' => 'Visitor', 'rules' => 'required']]);
		
		if($this->form_validation->withRequest($this->request)->run())
		{
			$error = $this->curd_model->get_1('*','customer',array('id'=>$frmdata['visitor'])); 
		}else{

			$error = 'Error';
		}
		echo json_encode($error);
	}
	
	
	public function qurey_list($customer_id){
		
					$customer = $this->curd_model->get_1('*','customer', array('id' => $customer_id));
					$sql = $this->curd_model->get_all('*','cust_query', array('cust_id' => $customer_id),'id','ASC');
					
					$user_details = $this->curd_model->get_all('*','cons_login', array('status' => 'A'),'id','ASC');
					foreach($user_details as $user){
						$data[$user->id] = $user->f_name; 
					}
					$stage = $this->curd_model->get_all('*','cust_stage', array('status' => 'A'),'id','ASC');
					foreach($stage as $st){
						$cust_stage[$st->id] = $st->name; 
					}
					
					//-----course-------
					$program_type = $this->curd_model->get_all('*','program', array('status' => 'A'),'id','ASC');
					foreach($program_type as $pro){
						$program[$pro->id] = $pro->program; 
					}
					
					
					
					//----remark-----
					
					$output = '
					<div id="accordion">';
					foreach($sql as $sq){
						$remarks_details = $this->curd_model->get_all('*','remarks', array('status' => 'A','query_id'=>$sq->id),'id','ASC');
					$output .= '
						<div class="accordion-head Regular p-10 m-t-10" data-toggle="collapse" data-target="#query-'.$sq->id.'">
							<div class="row">
								<div class="col-md-3">
									<p class="text-white" style="padding-top:6px;">'.$data[$sq->update_by].'</p>
								</div>
								<div class="col-md-3">
									<p class="text-white" style="padding-top:6px;">'.$customer->email.'</p>
								</div>
								<div class="col-md-3">
									<p class="text-white" style="padding-top:6px;">'.$program[$sq->type].'</p>
								</div>
								<div class="col-md-3">
									<p class="text-white" style="padding-top:6px;">'.$cust_stage[$sq->stage].'</p>
								</div>
							</div>
						</div>
						<div class="row collapse border-bottom p-10" id="query-'.$sq->id.'">
							<div class="col-md-12">
							
							</div>
							<div class="row">
								<div class="col-md-6 p-t-5" id="updated_remarks_'.$sq->id.'" style="overflow-y: scroll;height: 240px;">
							';
								if(isset($remarks_details)){
								foreach($remarks_details as $rem){
								   $output .= 
								   '
								   <div class="d-flex flex-row justify-content-start">
									  <p class="p-5" style="margin-bottom: -5px;"><b>'.$data[$rem->update_by].'</b>,
										<span class="align-right">'.$rem->insert_time.'</span>
									  </p>
									  <div>
										<p class="p-5" style="border-radius: 15px;background-color: #f5f6f7;">'.$rem->remark_msg.'</p>
										<hr>
										
									  </div>
									</div>'
									;
								}
								}
										
							$output .='
								</div>
										<div class="col-md-6 p-t-5">
											<div class="row">
												<div class="col-md-6">
													<button class="btn btn-primary form-control action-button" data-toggle="modal" data-target="#upamountModal" data-id="'.$sq->id.'">Offer Amount</button>
												</div>
												 
												<div class="col-md-6">
													<button class="btn btn-primary form-control action-button">Payment Request</button>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<textarea name="remark_'.$sq->id.'" style="height:150px;" placeholder="Type Your Remark" class="form-control"></textarea>
													<button type="button" data-query_id="'.$sq->id.'" data-cust_id="'.$sq->cust_id.'" data-type="'.$sq->type.'"  class="btn btn-success form-control add-remark">+ Add</button>
												</div>
											</div>
										</div>
								</div>
						</div>
					</div>';
					}
					return $output;
		
	}
	
	
	
	public function search_customer()
	{
		$data['session'] = $this->session->get('adminlogin');
		$error = array('success'=>false, 'message'=>array(), 'border'=>true);
		$frmdata = $this->request->getPost();
		
		$this->form_validation->setRules(['contact' => ['label' => 'Contact', 'rules' => 'required']]);
		
		if($this->form_validation->withRequest($this->request)->run())
		{
			$error['success'] = true;
			$value = explode("|",$frmdata['contact']);
			
			if(strlen($value[0]) == 10){
				$error['check'] = true;   //check number length
				
				$customer_details = $this->curd_model->get_1('*','customer_details', array('contact' => $value[0]));
				
				if($customer_details){
					$error['customer'] = true;
					
					/*
					$customer = $this->curd_model->get_1('*','customer', array('id' => $customer_details->cust_id));
				
					$sql = $this->curd_model->get_all('*','cust_query', array('cust_id' => $customer->id),'id','ASC');
					
					$user_details = $this->curd_model->get_all('*','cons_login', array('status' => 'A'),'id','ASC');
					foreach($user_details as $user){
						$data[$user->id] = $user->f_name; 
					}
					$stage = $this->curd_model->get_all('*','cust_stage', array('status' => 'A'),'id','ASC');
					foreach($stage as $st){
						$cust_stage[$st->id] = $st->name; 
					}
					
					//-----course-------
					$course_type = $this->curd_model->get_all('*','course_type', array('status' => 'A'),'id','ASC');
					foreach($course_type as $course){
						$course_ty[$course->id] = $course->name; 
					}
					
					
					
					//----remark-----
					
					$output = '
					<div id="accordion">';
					foreach($sql as $sq){
						$remarks_details = $this->curd_model->get_all('*','remarks', array('status' => 'A','query_id'=>$sq->id),'id','ASC');
					
					$output .= '
						<div class="accordion-head Regular p-10 m-t-10" data-toggle="collapse" data-target="#query-'.$sq->id.'">
							<div class="row">
								<div class="col-md-3">
									<p class="text-white" style="padding-top:6px;">'.$data[$sq->update_by].'</p>
								</div>
								<div class="col-md-3">
									<p class="text-white" style="padding-top:6px;">'.$customer->email.'</p>
								</div>
								<div class="col-md-3">
									<p class="text-white" style="padding-top:6px;">'.$course_ty[$sq->type].'</p>
								</div>
								<div class="col-md-3">
									<p class="text-white" style="padding-top:6px;">'.$cust_stage[$sq->stage].'</p>
								</div>
							</div>
						</div>
						<div class="row collapse border-bottom p-10" id="query-'.$sq->id.'">
							<div class="col-md-12">
							
							</div>
							<div class="row">
								<div class="col-md-6 p-t-5" id="updated_remarks_'.$sq->id.'" style="overflow-y: scroll;height: 240px;">
							';
								if(isset($remarks_details)){
								foreach($remarks_details as $rem){
								   $output .= 
								   '
								   <div class="d-flex flex-row justify-content-start">
									  <p class="p-5" style="margin-bottom: -5px;"><b>'.$data[$rem->update_by].'</b>,
										<span class="align-right">'.$rem->insert_time.'</span>
									  </p>
									  <div>
										<p class="p-5" style="border-radius: 15px;background-color: #f5f6f7;">'.$rem->remark_msg.'</p>
										<hr>
										
									  </div>
									</div>'
									;
								}
								}
										
							$output .='
								</div>
										<div class="col-md-6 p-t-5">
											<div class="row">
												<div class="col-md-6">
													<button class="btn btn-primary form-control action-button" data-toggle="modal" data-target="#upamountModal" data-id="'.$sq->id.'">Offer Amount</button>
												</div>
												 
												<div class="col-md-6">
													<button class="btn btn-primary form-control action-button">Payment Request</button>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<textarea name="remark_'.$sq->id.'" style="height:150px;" placeholder="Type Your Remark" class="form-control"></textarea>
													<button type="button" data-query_id="'.$sq->id.'" data-cust_id="'.$sq->cust_id.'" data-type="'.$sq->type.'"  class="btn btn-success form-control add-remark">+ Add</button>
												</div>
											</div>
										</div>
								</div>
						</div>
					</div>';
					}
					*/
					$output = $this->qurey_list($customer_details->cust_id);
					$error['message'] = $output;
				}else{
					$error['customer'] = false; 
					$error['message'] = "<b>Visitor not found....</b>";	
				}
			}else{
				$error['check'] = false;     //number length check 
				$error['message'] = "<b>Contact Number not valid....</b>";	
				
			}
		}else{
			foreach($_POST as $key=>$value){
				$error['message'][$key] = form_error($key);
			}
		}
		echo json_encode($error);
	}
	
	
	
	public function add_query()
	{
		$session = $this->session->get('adminlogin');
		$error = array();
		$frmdata = $this->request->getPost();
		
		
		$this->form_validation->setRules(['cust_id' => ['label' => 'Id', 'rules' => 'required']]);
		$this->form_validation->setRules(['type' => ['label' => 'type', 'rules' => 'required']]);
		$this->form_validation->setRules(['stage' => ['label' => 'stage', 'rules' => 'required']]);
		$this->form_validation->setRules(['amount' => ['label' => 'Amount', 'rules' => 'required']]);
		$this->form_validation->setRules(['remark' => ['label' => 'remark', 'rules' => 'required']]);					
		if($this->form_validation->withRequest($this->request)->run())
		{
				$error['success'] = true;
				$check_user = $this->curd_model->customquery1("select * from cust_query where `cust_id` = '".$frmdata['cust_id']."' && `type` = '".$frmdata['type']."' && `stage` = '".$frmdata['stage']."'");
				    //check query user details exit or not in  cust_query table
				
				if($check_user){
					$error['customer'] = false;
					$error['message'] = '<b>Customer Query Already exits .....</b>';
					
				}else{
						$data = array(
							'create_time' => date('Y-m-d H:i:s'),
							'last_update' => date('Y-m-d H:i:s'),
							'update_by' => $session['user_id'],
							'status' => 'A',
							'cust_id' => $frmdata['cust_id'],
							'type' => $frmdata['type'],
							'amount' => $frmdata['amount'],
							'stage' => $frmdata['stage'],
							'remark' => $frmdata['remark'],
						);
						$cust_sql = $this->curd_model->insert('cust_query', $data);
						//$this->db->trans_complete();
						$last_query = $cust_sql;
						$remarks_data = array(
							'status' => 'A',
							'insert_time' => date('Y-m-d H:i:s'),
							'update_by' => $session['user_id'],
							'query_id' => $last_query,
							'beneficiary_id' => $frmdata['cust_id'],
							'stage' => $frmdata['stage'],
							'remark_type' => $frmdata['type'],
							'remark_msg' => $frmdata['remark'],
						);
						$remark_sql = $this->curd_model->insert('remarks', $remarks_data);
						if($cust_sql && $remark_sql){
							
							$error['customer'] = true;
							/*
							$customer = $this->curd_model->get_1('*','customer', array('id' => $frmdata['cust_id']));
							$sql = $this->curd_model->get_all('*','cust_query', array('cust_id' => $customer->id),'id','ASC');
							//$sql = $this->curd_model->customquery1("select * from cust_query where `cust_id` = '".$customer->id."' order by type asc");
							$user_details = $this->curd_model->get_all('*','cons_login', array('status' => 'A'),'id','ASC');
							foreach($user_details as $user){
								$data[$user->id] = $user->f_name; 
							}
							$stage = $this->curd_model->get_all('*','cust_stage', array('status' => 'A'),'id','ASC');
							foreach($stage as $st){
								$cust_stage[$st->id] = $st->name; 
							}
							
							$course_type = $this->curd_model->get_all('*','course_type', array('status' => 'A'),'id','ASC');
							foreach($course_type as $course){
								$course_ty[$course->id] = $course->name; 
							}
							
							$output = '
							<div id="accordion">';
							foreach($sql as $sq){
								$remarks_details = $this->curd_model->get_all('*','remarks', array('status' => 'A','query_id'=>$sq->id),'id','ASC');
							$output .= '
								<div class="accordion-head Regular p-10 m-t-10" data-toggle="collapse" data-target="#query-'.$sq->id.'">
									<div class="row">
										<div class="col-md-3">
											<p class="text-white" style="padding-top:6px;">'.$data[$sq->update_by].'</p>
										</div>
										<div class="col-md-3">
											<p class="text-white" style="padding-top:6px;">'.$customer->email.'</p>
										</div>
										<div class="col-md-3">
											<p class="text-white" style="padding-top:6px;">'.$course_ty[$sq->type].'</p>
										</div>
										<div class="col-md-3">
											<p class="text-white" style="padding-top:6px;">'.$cust_stage[$sq->stage].'</p>
										</div>
									</div>
								</div>
								<div class="row collapse border-bottom p-10" id="query-'.$sq->id.'">
									<div class="col-md-12">
									
									</div>
									<div class="row">
										<div class="col-md-6 p-t-5" id="updated_remarks_'.$sq->id.'" style="overflow-y: scroll;height: 240px;">
											';
									if(isset($remarks_details)){
									foreach($remarks_details as $rem){
									   $output .= 
									   '
									   <div class="d-flex flex-row justify-content-start">
										  <p class="p-5" style="margin-bottom: -5px;"><b>'.$data[$rem->update_by].'</b>,
											<span class="align-right">'.$rem->insert_time.'</span>
										  </p>
										  <div>
											<p class="p-5" style="border-radius: 15px;background-color: #f5f6f7;">'.$rem->remark_msg.'</p>
											<hr>
											
										  </div>
										</div>'
										;
									}
									}
										
							$output .='
									</div>
										
										<div class="col-md-6 p-t-5">
											<div class="row">
												<div class="col-md-6">
													<button class="btn btn-primary form-control action-button" data-toggle="modal" data-target="#upamountModal" data-id="'.$sq->id.'">Offer Amount</button>
												</div>
												 
												<div class="col-md-6">
													<button class="btn btn-primary form-control action-button">Payment Request</button>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<textarea name="remark_'.$sq->id.'" style="height:150px;" placeholder="Type Your Remark" class="form-control"></textarea>
													<button type="button" data-query_id="'.$sq->id.'" data-cust_id="'.$sq->cust_id.'" data-type="'.$sq->type.'"  class="btn btn-success form-control add-remark">+ Add</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>';
							}
							
							*/
							$output = $this->qurey_list($frmdata['cust_id']);
							$error['message'] = $output;
							
							
						}else{
							$error['customer'] = false;
							$error['message'] = "<b>Error ....</b>";	
							
						}
				}
		}else{
			foreach($_POST as $key=>$value){
				$error['message'][$key] = form_error($key);
			}
		}
		echo json_encode($error);
	}
	
	
	public function add_remark()
	{
		$session = $this->session->get('adminlogin');
		$error = array();
		$frmdata = $this->request->getPost();
		
		
		$this->form_validation->setRules(['query_id' => ['label' => 'Query ID', 'rules' => 'required']]);
		$this->form_validation->setRules(['remark' => ['label' => 'Remark', 'rules' => 'required']]);
		if($this->form_validation->withRequest($this->request)->run())
		{
			$error['admin'] = $this->curd_model->get_1('*','cons_login',array('id'=>$session['user_id']));
			$query = $this->curd_model->get_1('*','cust_query',array('id'=>$frmdata['query_id']));
			$rmk_data = array(
				'status' => 'A',
				'insert_time' => date('Y-m-d H:i:s'),
				'update_by' => $session['user_id'],
				'query_id' => $query->id,
				'beneficiary_id' => $query->cust_id,
				'stage' => $query->stage,
				'remark_type' => $query->type,
				'remark_msg' => $frmdata['remark']
			);
			$remark_id = $this->curd_model->insert('remarks',$rmk_data);
			if($remark_id)
			{
				$error['remark'] = $rmk_data;
			}
		}else{
			foreach($_POST as $key=>$value){
				$error['message'][$key] = form_error($key);
			}
		}
		echo json_encode($error);
	}
	
	public function get_amount()
	{
		$data['session'] = $this->session->get('adminlogin');
		
		$error = array();
		$frmdata = $this->request->getPost();
		$this->form_validation->setRules(['id' => ['label' => 'ID', 'rules' => 'required']]);
		if($this->form_validation->withRequest($this->request)->run())
		{
			$query = $this->curd_model->get_1('*','program',array('id'=>$frmdata['id']));
			if($query){
				$error["success"] = true;
				$error["amount"]= $query->amount;
			}else{
				$error["success"] = false;
				
			}
		
		}else{
			foreach($_POST as $key=>$value){
				$error['message'][$key] = form_error($key);
			}
		}
		echo json_encode($error);
	}
	
	public function offer_amount()
	{
		$session = $this->session->get('adminlogin');
		$error = array();
		$frmdata = $this->request->getPost();
		$this->form_validation->setRules(['qry_id' => ['label' => 'ID', 'rules' => 'required']]);
		$this->form_validation->setRules(['offer_amount' => ['label' => 'Amount', 'rules' => 'required']]);
		
		//$this->form_validation->setRules(['test' => ['label' => 'Amount', 'rules' => 'required']]);
		if($this->form_validation->withRequest($this->request)->run())
		{
			$data = [
				'last_update' => date('Y-m-d H:i:s'),
				'update_by' => $session['user_id'],
				'offer_amount' => $frmdata['offer_amount']
			];
			$update_amount = $this->curd_model->updatequery('cust_query',$data,array('id'=>$frmdata['qry_id']));
			if($update_amount){
				$error['admin'] = $this->curd_model->get_1('*','cons_login',array('id'=>$session['user_id']));
			
				$get_data = $this->curd_model->get_1('*','cust_query',array('id'=>$frmdata['qry_id']));
					$amount_data = array(
						'status' => 'A',
						'create_time' => date('Y-m-d H:i:s'),
						'update_by' => $session['user_id'],
						'query_id' => $get_data->id,
						'amount' => $frmdata['offer_amount'],
						'type' => 'qry_amt',
					);
					$amount = $this->curd_model->insert('next_amount',$amount_data);

				
				$rmk_data = array(
					'status' => 'A',
					'insert_time' => date('Y-m-d H:i:s'),
					'update_by' => $session['user_id'],
					'query_id' => $get_data->id,
					'beneficiary_id' => $get_data->cust_id,
					'stage' => $get_data->stage,
					'remark_type' => $get_data->type,
					'remark_msg' => $frmdata['offer_amount']
				);
				$remark_id = $this->curd_model->insert('remarks',$rmk_data);
				if($remark_id)
				{
					$error['success'] = true;
					$error['remark'] = $rmk_data;
				}else{
					$error['message']['refrence'] = '<p>Error in update please try again.</p>';
				}
				
			}else{
				$error['message']['refrence'] = '<p>Error in update amount please try again.</p>';
			}
		}else{
			foreach($_POST as $key=>$value){
				$error['message'][$key] = form_error($key);
			}
		}
		echo json_encode($error);
	}
	
	
	public function add_customer(){
		$data['session'] = $this->session->get('adminlogin');
		$error = array('success'=>false, 'message'=>array(), 'border'=>true);
		$frmdata = $this->request->getPost();
		
		
		$this->form_validation->setRules(['prefix' => ['label' => 'Prefix', 'rules' => 'required']]);
		$this->form_validation->setRules(['name' => ['label' => 'Name', 'rules' => 'required']]);
		$this->form_validation->setRules(['contact' => ['label' => 'Contact', 'rules' => 'required']]);
		$this->form_validation->setRules(['gender' => ['label' => 'Gender', 'rules' => 'required']]);
		$this->form_validation->setRules(['email' => ['label' => 'Email', 'rules' => 'required']]);
		$this->form_validation->setRules(['topic' => ['label' => 'Topic', 'rules' => 'required']]);
		$this->form_validation->setRules(['dob' => ['label' => 'dob', 'rules' => 'required']]);
		$this->form_validation->setRules(['address' => ['label' => 'Address', 'rules' => 'required']]);
		if($this->form_validation->withRequest($this->request)->run()){
				$data = array(
					'create_time' => date('Y-m-d H:i:s'),
					'update_time' => date('Y-m-d H:i:s'),
					'update_by' => $session['user_id'],
					'status' => 'A',
					'prefix' => $frmdata['prefix'],
					'name' => $frmdata['name'],
					'contact' => $frmdata['contact'],
					'gender' => $frmdata['gender'],
					'email' => $frmdata['email'],
					'topic' => $frmdata['topic'],
					'dob' => $frmdata['dob'],
					'address' => $frmdata['address'],
				);
				$sql = $this->curd_model->insert('customer', $data);
				$this->db->trans_complete();
				$last_query = $this->db->insert_id();
				
				$data2 = array(
					'create_time' => date('Y-m-d H:i:s'),
					'update_time' => date('Y-m-d H:i:s'),
					'update_by' => $session['user_id'],
					'status' => 'A',
					'cust_id' => $last_query,
					'prefix' => $frmdata['prefix'],
					'name' => $frmdata['name'],
					'contact' => $frmdata['contact'],
					'gender' => $frmdata['gender'],
					'email' => $frmdata['email'],
					'topic' => $frmdata['topic'],
					'dob' => $frmdata['dob'],
					'address' => $frmdata['address'],
				);
				$sqli = $this->curd_model->insert('customer_details', $data2);
				 
				
			
				if($sql && $sqli){
				   $error['success'] = true;
				}else{
					$error['message']['refrence'] = '<span class="frm-error form_err"><b>Error in Visitor Details Add please try again.</b></span>';
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
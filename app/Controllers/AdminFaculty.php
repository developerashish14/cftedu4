<?php

namespace App\Controllers;

use CodeIgniter\Controller;


class AdminFaculty extends BaseController
{
    public function view()
    {
        $data['session'] = $this->session->get('adminlogin');
        $data = get_menu();
       
    }
    public function action_update($action = null)
    {
        $error = array('success' => false,'error_token'=>array('cname'=>csrf_token(),'cvalue'=>csrf_hash()), 'message' =>array(),'border'=>true);
        $frmdata = $this->request->getPost();
        $session = $this->session->get('adminlogin');
		if($action == 'add_faculty'){
			$check = $this->validate([
					'image_id' => ['rules' =>  'required','errors' =>  ['required' => 'Image is required']],
					'name' => ['rules' =>  'required','errors' =>  ['required' => 'Name is required']],
					'contact' => ['rules' =>  'required','errors' =>  ['required' => 'Contct no is required']],
					'cat_id' => ['rules' =>  'required','errors' =>  ['required' => 'Type is required']],
					'specialization' => ['rules' =>  'required','errors' =>  ['required' => 'Specialization is required']],
					'email' => ['rules' =>  'required','errors' =>  ['required' => 'E mail is required']],
					'age' => ['rules' =>  'required','errors' =>  ['required' => 'Age is required']],
					'discription' => ['rules' =>  'required','errors' =>  ['required' => 'Discription is required']],
					'qualification' => ['rules' =>  'required','errors' =>  ['required' => 'Dualification is required']],
			   ]);
				if($check)
				{
					$data = array(
						'status' => 'A',
						'last_update' => date('Y-m-d H:i:s'),
						'update_by' => $session['user_id'],
						'img_id' => $frmdata['image_id'],
						'name' => $frmdata['name'],
						'contact' => $frmdata['contact'],
						'faculty_type' => $frmdata['cat_id'],
						'email' => $frmdata['email'],
						'age' => $frmdata['age'],
						'discription' => $frmdata['discription'],
						'qualification' => $frmdata['qualification'],
						'specialization' => $frmdata['specialization']
					);
					$sql = $this->curd_model->insert('faculty', $data);
					if($sql){
					   $error['success'] = true;
					}else{
						$error['message']['refrence'] = '<p>Error in Core Value update please try again.</p>';
					}
				}else{
					foreach($_POST as $key =>$value)
					{
						if ($this->validation->hasError($key)) {
							$error['message'][$key] = $this->validation->getError($key);
						}
					}
				}
			
		}else if($action == 'update_faculty'){
			$check = $this->validate([
					//'image_id' => ['rules' =>  'required','errors' =>  ['required' => 'Image is required']],
					'edt_name' => ['rules' =>  'required','errors' =>  ['required' => 'Name is required']],
					'edt_contact' => ['rules' =>  'required','errors' =>  ['required' => 'Contct no is required']],
					'edt_cat_id' => ['rules' =>  'required','errors' =>  ['required' => 'Type is required']],
					'edt_specialization' => ['rules' =>  'required','errors' =>  ['required' => 'Specialization is required']],
					'edt_email' => ['rules' =>  'required','errors' =>  ['required' => 'E mail is required']],
					'edt_age' => ['rules' =>  'required','errors' =>  ['required' => 'Age is required']],
					'edt_discription' => ['rules' =>  'required','errors' =>  ['required' => 'Discription is required']],
					'edt_qualification' => ['rules' =>  'required','errors' =>  ['required' => 'Dualification is required']],
			   ]);
				if($check)
				{
					$data = array(
						'last_update' => date('Y-m-d H:i:s'),
						'update_by' => $session['user_id'],
						'img_id' => $frmdata['edt_image_id'],
						'name' => $frmdata['edt_name'],
						'contact' => $frmdata['edt_contact'],
						'faculty_type' => $frmdata['edt_cat_id'],
						'email' => $frmdata['edt_email'],
						'age' => $frmdata['edt_age'],
						'discription' => $frmdata['edt_discription'],
						'qualification' => $frmdata['edt_qualification'],
						'specialization' => $frmdata['edt_specialization']
					);
					$sql = $this->curd_model->update_table('faculty', $data, array('id'=>$frmdata['dignitaryid']));
					if($sql){
					   $error['success'] = true;
					}else{
						$error['message']['refrence'] = '<p>Error in Core Value update please try again.</p>';
					}
				}else{
					foreach($_POST as $key =>$value)
					{
						if ($this->validation->hasError($key)) {
							$error['message'][$key] = $this->validation->getError($key);
						}
					}
				}
		}else if($action == 'upload_faculty_img'){
			$doc1 = $this->request->getFile('slider_images');
			if($doc1->isValid())
			{
				$doc1validationRule = [
				   'slider_images' => [
					'label' => 'Image File',
					'rules' => 'uploaded[slider_images]'
					 . '|mime_in[slider_images,image/png,image/jpg,image/jpeg]'
					 . '|max_size[slider_images,2000]'
					 . '|max_dims[slider_images,700,400]',
				   ],
				];
				if ($this->validate($doc1validationRule)) {
					if (! $doc1->hasMoved()) {
						$file1 = $doc1->getRandomName();
						$doc1->move(ROOTPATH . 'images/faculty_image/', $file1);
						$upload = array(
						 'status' => 'A',
						 'upload_time' => date('Y-m-d H:i:s'),
						 'upload_by' => $session['user_id'],
						 'purpose' => 'faculty_image',
						 'location' => 'faculty_image/' . $file1,
						); 
						$sql = $this->curd_model->insert('images', $upload);
						if ($sql) {
							$error['success'] = true;
						} else {
							$error['message']['refrence'] = '<p >Error in storing Image please try again.</p>';
						}
					}
				}
				else
				{
					$upload_file = false;
					$error['message']['fileerrors'] = $this->validator->getErrors();
				}
			}
		}
		else if($action == 'change_faculty_status'){
			$check = $this->validate([
					'status' => ['rules' =>  'required','errors' =>  ['required' => 'status is required']],
					'id' => ['rules' =>  'required','errors' =>  ['required' => 'Slider is required']],
			   ]);
				if($check)
				{
					$data = array(
						'last_update' => date('Y-m-d H:i:s'),
						'update_by' => $session['user_id'],
						'status' => (($frmdata['status']=='D')?'A':'D')
					);
					$sql = $this->curd_model->update_table('faculty', $data, array('id'=>$frmdata['id']));
					if($sql){
					   $error['success'] = true;
					}else{
						$error['message']['refrence'] = '<span class="frm-error form_err">Error in data storing please try again.</span>';
					}
				}else{
					foreach($_POST as $key =>$value)
					{
						if ($this->validation->hasError($key)) {
							$error['message'][$key] = $this->validation->getError($key);
						}
					}
				}
		}
		else if($action == 'add_faculty_course'){
			$check = $this->validate([
					'details' => ['rules' =>  'required','errors' =>  ['required' => 'Email is required']],
					'course' => ['rules' =>  'required','errors' =>  ['required' => 'course is required']],
			   ]);
			   if($check)
				{
						$checkmail = $this->curd_model->get_1('*','faculty',array('email'=>$frmdata['details']));
						if(isset($checkmail->id))
						{
							$checode = $this->curd_model->get_1('*','lms_course',array('course_code'=>$frmdata['course']));
							if(isset($checode->id))
							{
								$code = $this->curd_model->get_1('*','faculty_course',array('course_id'=>$checode->id));
								if(isset($code->id))
								{
									$error['message']['email'] = 'You are already register for this course  ....';
								}
								else
								{
									$data = array(
										'status' => 'A',
										'last_update' => date('Y-m-d H:i:s'),
										'update_by' => $session['user_id'],
										'faculty_id' => $checkmail->id,
										'course_id' => $checode->id
									);
									$sql = $this->curd_model->insert('faculty_course', $data);
									if($sql){
										$error['success'] = true;
									}else{
										$error['message']['refrence'] = '<p>Error in Faculty  create please try again.</p>';
									}
								}
							}else{
								$error['message']['code'] = 'We dont have this course code';
							}
						 }else{							
							$error['message']['email'] = 'You are not register as teacher pls register yourself first ....';
						 }
				}else{
					foreach($_POST as $key =>$value)
					{
						if ($this->validation->hasError($key)) {
							$error['message'][$key] = $this->validation->getError($key);
						}
					}
				}
			
		}
		else if($action == 'update_faculty_course'){
			   $check = $this->validate([
					'edt_td' => ['rules' =>  'required','errors' =>  ['required' => 'ID is required']],
					'edt_details' => ['rules' =>  'required','errors' =>  ['required' => 'Email is required']],
					'edt_course' => ['rules' =>  'required','errors' =>  ['required' => 'course is required']],
			   ]);
			   if($check)
			   {
					$checkmail = $this->curd_model->get_1('*','faculty',array('email'=>$frmdata['edt_details']));
					if(isset($checkmail->id))
					{
						$checode = $this->curd_model->get_1('*','lms_course',array('course_code'=>$frmdata['edt_course']));
						if(isset($checode->id))
						{
							$code = $this->curd_model->get_1('*','faculty_course',array('course_id'=>$checode->id,'faculty_id'=>$checkmail->id));
							if(isset($code->id))
							{
								$error['message']['email'] = 'You are already register for this course  ....';
							}
							else
							{
								$data = array(
									'last_update' => date('Y-m-d H:i:s'),
									'update_by' => $session['user_id'],
									'faculty_id' => $checkmail->id,
									'course_id' => $checode->id
								);
								$sql = $this->curd_model->update_table('faculty_course', $data, array('id'=>$frmdata['edt_td']));
								if($sql){
									$error['success'] = true;
								}else{
									$error['message']['refrence'] = '<p>Error in Faculty  create please try again.</p>';
								}
							}
						}else{
							$error['message']['code'] = 'We dont have this course code';
						}
					}else{							
						$error['message']['email'] = 'You are not register as teacher pls register yourself first ....';
					}
				}else{
					foreach($_POST as $key =>$value)
					{
						if ($this->validation->hasError($key)) {
							$error['message'][$key] = $this->validation->getError($key);
						}
					}
				}
			
		}
		else if($action == 'change_faculty_course_status'){
			$check = $this->validate([
					'status' => ['rules' =>  'required','errors' =>  ['required' => 'status is required']],
					'id' => ['rules' =>  'required','errors' =>  ['required' => 'Slider is required']],
			   ]);
				if($check)
				{
					$data = array(
						'last_update' => date('Y-m-d H:i:s'),
						'update_by' => $session['user_id'],
						'status' => (($frmdata['status']=='D')?'A':'D')
					);
					$sql = $this->curd_model->update_table('faculty_course', $data, array('id'=>$frmdata['id']));
					if($sql){
					   $error['success'] = true;
					}else{
						$error['message']['refrence'] = '<span class="frm-error form_err">Error in data storing please try again.</span>';
					}
				}else{
					foreach($_POST as $key =>$value)
					{
						if ($this->validation->hasError($key)) {
							$error['message'][$key] = $this->validation->getError($key);
						}
					}
				}
		}
		else if($action == 'approve_faculty'){
			$check = $this->validate([
					'request_id' => ['rules' =>  'required','errors' =>  ['required' => 'Request is required']],
					'faculty_type' => ['rules' =>  'required','errors' =>  ['required' => 'Faculty is required']],
					'age' => ['rules' =>  'required','errors' =>  ['required' => 'Age is required']],
					'remark' => ['rules' =>  'required','errors' =>  ['required' => 'Remark is required']],
			  
			   ]);
				if($check)
				{
					$request = $this->curd_model->get_1('*','faculty_request',array('id'=>$frmdata['request_id']));
					if($request->id)
					{
						$faculty = $this->curd_model->get_1('*','faculty',array('email'=>$request->email));
						if(isset($faculty->id) && $faculty->id > 0)
						{
							$error['message']['refrence'] = '<span class="frm-error form_err">He is already a Faculty in Portal.</span>';
						}
						else
						{
							$data = array(
								'status' => 'A',
								'last_update' => date('Y-m-d H:i:s'),
								'update_by' => '1',
								'name' => $request->name,
								'email' => $request->email,
								'contact' => $request->contact,
								'img_id' => '228',
								'faculty_type' =>$frmdata['faculty_type'],
								'age' =>$frmdata['age'],
								'discription' =>$frmdata['remark'],
								'qualification' =>$request->qualification,
								'specialization' =>$request->specialization
							);
							$this->curd_model->update_table('faculty_request',array('status'=>'A'),array('id'=>$frmdata['request_id']));
							$fac_data = $this->curd_model->insert('faculty',$data);
							$error['success'] = true;
							
							/*
							$this->load->helper('mailtemp');
							$msg = faculty_approve_email('JanMitr',$data);
							$email_check = $this->send_email($request->email, 'Faculty Detail', $msg, 'ashish@cftedu.in');
							if($email_check)
							{
								$error['message']['refrence'] = '<span class="frm-error form_err">Mail sent sussefully .</span>';
							}
							
							*/
						}
					}else{
						$error['message']['refrence'] = '<span class="frm-error form_err">Error in data storing please try again.</span>';
						$error['success'] = true;
					}
				}else{
					foreach($_POST as $key =>$value)
					{
						if ($this->validation->hasError($key)) {
							$error['message'][$key] = $this->validation->getError($key);
						}
					}
				}
		}
        echo json_encode($error);
    }
}

?>
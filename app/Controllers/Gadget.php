<?php
class Gadget extends CI_controller{
	public function __construct(){
		parent:: __construct();
		date_default_timezone_set('Asia/Kolkata');
		if(!$this->session->userdata('adminlogin')){
			redirect(site_url('logout'));
		}
		$this->curd_model->update_session();
	}
		
	public function add_logo()
	{
		$session = $this->session->userdata('adminlogin');
		$error = array('success'=>false, 'message'=>array(), 'border'=>true);
		$frmdata = $this->input->post();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="frm-error form_err">', '</span>');
		$this->form_validation->set_rules('image_id', 'Image', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('url', 'URL', 'required');
		if($this->form_validation->run())
		{
			$data = array(
				'status' => 'A',
				'last_update' => date('Y-m-d H:i:s'),
				'update_by' => $session['user_id'],
				'img_id' => $frmdata['image_id'],
				'name' => $frmdata['name'],
				'url' => $frmdata['url']
			);
			$sql = $this->curd_model->insert('logos', $data);
			if($sql){
				$error['success'] = true;
			}else{
				$error['message']['refrence'] = '<p>Error in Core Value update please try again.</p>';
			}
		}else{
			foreach($_POST as $key=>$value){
				$error['message'][$key] = form_error($key);
			}
		}
		
		echo json_encode($error);
	}
	
	public function update_logo()
	{
		$session = $this->session->userdata('adminlogin');
		$error = array('success'=>false, 'message'=>array(), 'border'=>true);
		$frmdata = $this->input->post();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="frm-error form_err">', '</span>');
		$this->form_validation->set_rules('edt_id', 'Object', 'required');
		$this->form_validation->set_rules('edt_image_id', 'Image', 'required');
		$this->form_validation->set_rules('edt_name', 'Name', 'required');
		$this->form_validation->set_rules('edt_url', 'URL LInk', 'required');
		if($this->form_validation->run()){
			
			$data = array(
				'last_update' => date('Y-m-d H:i:s'),
				'update_by' => $session['user_id'],
				'img_id' => $frmdata['edt_image_id'],
				'name' => $frmdata['edt_name'],
				'url' => $frmdata['edt_url']
			);
			$sql = $this->curd_model->update('logos', $data, array('id'=>$frmdata['edt_id']));
			if($sql){
				$error['success'] = true;
			}else{
				$error['message']['refrence'] = '<p>Error in Core Value update please try again.</p>';
			}
		}else{
			foreach($_POST as $key=>$value){
				$error['message'][$key] = form_error($key);
			}
		}
		
		echo json_encode($error);
	}
	
	public function upload_logo_img()
	{
		$session = $this->session->userdata('adminlogin');
		$error = array('success'=>false, 'message'=>array(), 'border'=>true);

		$this->load->library('upload');
		$uploadData = array();
		if(!empty($_FILES['images']['name'][0]))
		{
			$filesCount = count($_FILES['images']['name']);
			for($i=0;$i<$filesCount;$i++)
			{
				$_FILES['upload_images']['name'] = $_FILES['images']['name'][$i];
				$_FILES['upload_images']['type'] = $_FILES['images']['type'][$i];
				$_FILES['upload_images']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
				$_FILES['upload_images']['error'] = $_FILES['images']['error'][$i];
				$_FILES['upload_images']['size'] = $_FILES['images']['size'][$i];

				//$uploadPath = $web_url.'images/holiday/';
				$uploadPath = web_file_location().'images/logos/';

				//var_dump(is_dir($uploadPath));

				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'gif|jpg|png';
				$config['allowed_types'] = '*';
				$config['max_size']             = 1000;
				$config['file_name'] = date('YmdHis').$i.".".pathinfo($_FILES['images']['name'][$i],PATHINFO_EXTENSION);
				//echo "hello";
				//var_dump(getimagesize($_FILES['upload_images']['tmp_name']));

				$imgsize 	= (getimagesize($_FILES["upload_images"]["tmp_name"])); 		//verified image
				$size 		= (explode(" ",$imgsize[3]));
				$width 		= substr($size[0],7,strlen($size[0])-8);    //width
				$height 	= substr($size[1],8,strlen($size[1])-9);	//height

				if(isset($imgsize))
				{
					$this->upload->initialize($config);
					if(!$this->upload->do_upload('upload_images'))
					{
						$error['message']['refrence'] = $this->upload->display_errors();
					}
					else
					{
						$upload = array(
							'status' => 'A',
							'upload_time' => date('Y-m-d H:i:s'),
							'upload_by' => $session['user_id'],
							'purpose' => 'logos',
							'location' => 'logos/'.$config['file_name'],
						);
						$sql = $this->curd_model->insert('images', $upload);
						if($sql){
							$error['success'] = true;
						}else{
							$error['message']['refrence'] = '<p >Error in storing Image please try again.</p>';
						}
					}
					//var_dump($config);
				}
				else{
					$error['message']['refrence'] = '<p class="frm-error form_err">Error in Image please try another image.</p>';
				}


			}
			if(!empty($uploadData))
			{
				$error['success'] = true;
			}
			else
			{
				$error['message']['refrence'] = '<p >Error in storing Image please try again.</p>';
			}
		
			
		}else{
		   $error['message']['refrence'] = '<p >Please upload the image.</p>';
		}
		echo json_encode($error);
	}
	
	
	public function catch_visitor_info()
	{
		$session = $this->session->userdata('janmitrlogin');
		$error = array();
		$frmdata = $this->input->post();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="frm-error form_err">', '</span>');
		$this->form_validation->set_rules('details', 'Details', 'required');
		
		if($this->form_validation->run())
		{
			//$customer = $this->curd_model->get_all('*','customer',array('contact'=>$frmdata['details']),'id','ASC');
			$customer = $this->curd_model->customquery1("select * from customer where `contact` LIKE '%".$frmdata['details']."%' order by id asc");
			
			if(count($customer) > 0)
			{
				foreach($customer as $cus)
				{
					$error[] = array('email'=>$cus->email,'contact'=>$cus->contact,'id'=>$cus->id);
				}
			}
		}
		echo json_encode($error);
	}
	public function catch_visitor_on_select()
	{
		$session = $this->session->userdata('janmitrlogin');
		$error = array();
		$frmdata = $this->input->post();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="frm-error form_err">', '</span>');
		$this->form_validation->set_rules('visitor', 'visitor', 'required');
		
		if($this->form_validation->run())
		{
			$error = $this->curd_model->get_1('*','customer',array('id'=>$frmdata['visitor']));
		}
		echo json_encode($error);
	}
	
	public function change_logo_status(){
		$session = $this->session->userdata('adminlogin');
		$error = array('success'=>false, 'message'=>array(), 'border'=>true);
		$frmdata = $this->input->post();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="frm-error form_err">', '</span>');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_rules('id', 'Object', 'required');
		if($this->form_validation->run()){
			$data = array(
				'last_update' => date('Y-m-d H:i:s'),
				'update_by' => $session['user_id'],
				'status' => (($frmdata['status']=='D')?'A':'D')
			);
			$sql = $this->curd_model->update('logos', $data, array('id'=>$frmdata['id']));
			if($sql){
			   // $this->visitor_history($frmdata['v_id'], 'Candidate updated', $frmdata['remarks']);
				$error['success'] = true;
			}else{
				$error['message']['refrence'] = '<span class="frm-error form_err">Error in change status please try again.</span>';
			}
		}else{
			foreach($_POST as $key=>$value){
				$error['message'][$key] = form_error($key);
			}
		}
		
		echo json_encode($error);
	}
	
	
	public function search_customer()
	{
		$session = $this->session->userdata('adminlogin');
		$error = array('success'=>false, 'message'=>array(), 'border'=>true);
		$frmdata = $this->input->post();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="frm-error form_err">', '</span>');
		$this->form_validation->set_rules('contact', 'contact', 'required');
		if($this->form_validation->run())
		{
			$error['success'] = true;
			$value = explode("|",$frmdata['contact']);
			$sql = $this->curd_model->get_1('*','customer', array('contact' => $value[0]));
			if($sql){
				$error['customer'] = true;
				$output = '<table class="table">
				  <thead>
					<tr>
					  <th scope="col">#</th>
					  <th scope="col">Name</th>
					  <th scope="col">Email</th>
					  <th scope="col">contact</th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <th scope="row">1</th>
					  <td>'.$sql->name.'</td>
					  <td>'.$sql->email.'</td>
					  <td>'.$sql->contact.'</td>
					</tr>
				   
				  </tbody>
				</table>';
				$error['message'] = $output;
			}else{
				$error['customer'] = false;
				$error['message'] = "<b>Visitor not found....</b>";	
			}
		}else{
			foreach($_POST as $key=>$value){
				$error['message'][$key] = form_error($key);
			}
		}
		echo json_encode($error);
	}
	
	
	public function add_customer(){
		$session = $this->session->userdata('adminlogin');
		$error = array('success'=>false, 'message'=>array(), 'border'=>true);
		$frmdata = $this->input->post();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="frm-error form_err">', '</span>');
		$this->form_validation->set_rules('prefix', 'Prefix', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('contact', 'Contact', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('topic', 'Topic', 'required');
		$this->form_validation->set_rules('age', 'Age', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		if($this->form_validation->run()){
				$data = array(
					'create_time' => date('Y-m-d H:i:s'),
					'update_by' => $session['user_id'],
					'status' => 'A',
					'prefix' => $frmdata['prefix'],
					'name' => $frmdata['name'],
					'contact' => $frmdata['contact'],
					'gender' => $frmdata['gender'],
					'email' => $frmdata['email'],
					'topic' => $frmdata['topic'],
					'age' => $frmdata['age'],
					'address' => $frmdata['address'],
				);
				$sql = $this->curd_model->insert('customer', $data);
				if($sql){
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
	
	
	private function send_email($to, $subject, $message,$bcc = 'query@cftedu.in')
	{
		$this->load->library('phpmailer_lib');
		$mail = $this->phpmailer_lib->load();
		
		// SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'mail5018.site4now.net';
        $mail->SMTPAuth = true;
        //$mail->Username = 'noreply@publicpoliceindia.com';
        $mail->Username = 'help@publicpoliceindia.com';
        $mail->Password = 'Public$321';
        $mail->SMTPSecure = 'tls';
        $mail->Port     = 587;
		
		$mail->setFrom('help@publicpoliceindia.com', 'Public Police');
        $mail->addReplyTo('help@publicpoliceindia.com', 'Public Police');
		
		$mail->addAddress($to);
        
        // Add cc or bcc 
       // $mail->addCC('cc@example.com');
        //$mail->addBCC($bcc);
		$mail->Subject = $subject;
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mailContent =  $message;
        $mail->Body = $mailContent;
		
		if($mail->send())
		{
			return $arr = array('success'=>true);
		}
		else
		{
			return $arr = array('success'=>false,'message'=>$mail->ErrorInfo);
		}
	}
	
}
?>
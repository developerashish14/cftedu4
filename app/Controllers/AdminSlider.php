<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
class AdminSlider extends BaseController
{	
	public function action_update($action = null)
    {
        $error = array('success' => false,'error_token'=>array('cname'=>csrf_token(),'cvalue'=>csrf_hash()), 'message' =>array(),'border'=>true);
        $frmdata = $this->request->getPost();
        $session = $this->session->get('adminlogin');
        if($action == 'add_slider')
        {
			$check = $this->validate([
                'image_id' => ['rules' =>  'required','errors' =>  ['required' => 'Image is required']],
                'top' => ['rules' =>  'required','errors' =>  ['required' => 'Top is required']],
                'bottom' => ['rules' =>  'required','errors' =>  ['required' => 'Middle Line is required']],
                
			   ]);
			if($check)
			{
				$data = array(
					'status' => 'A',
					'last_update' => date('Y-m-d H:i:s'),
					'update_by' => $session['user_id'],
					'img' => $frmdata['image_id'],
					'top_line' => $frmdata['top'],
					'bottom_text' => $frmdata['bottom'],
					'link_button' => isset($frmdata['link_button'])?'Y':'',
					'form_button' => isset($frmdata['form_button'])?'Y':'',
					'form_type' => $frmdata['form_type'],
					'url_ref' => $frmdata['url_ref']
				);
				$sql = $this->curd_model->insert('home_slider', $data);
				if($sql){
					$error['success'] = true;
				}else{
					$error['message']['refrence'] = '<p>Error in slider create please try again.</p>';
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
		else if($action == 'update_slider'){
			$check = $this->validate([
                'edt_image_id' => ['rules' =>  'required','errors' =>  ['required' => 'Image is required']],
                'edt_top' => ['rules' =>  'required','errors' =>  ['required' => 'Top is required']],
                'slider_id' => ['rules' =>  'required','errors' =>  ['required' => 'Slider is required']],
                
			   ]);
			if($check)
			{
				$data = array(
				'last_update' => date('Y-m-d H:i:s'),
				'update_by' => $session['user_id'],
				'img' => $frmdata['edt_image_id'],
				'top_line' => $frmdata['edt_top'],
				'bottom_text' => $frmdata['edt_bottom'],
				'link_button' => isset($frmdata['edt_link_button'])?'Y':'',
				'form_button' => isset($frmdata['edt_form_button'])?'Y':'',
				'form_type' => $frmdata['edt_form_type'],
				'url_ref' => $frmdata['edt_url_ref']
				);
				$sql = $this->curd_model->update_table('home_slider', $data, array('id'=>$frmdata['slider_id']));
				if($sql){
					$error['success'] = true;
				}else{
					$error['message']['refrence'] = '<p>Error in slider update please try again.</p>';
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
		else if($action == 'change_slide_status'){
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
					$sql = $this->curd_model->update_table('home_slider', $data, array('id'=>$frmdata['id']));
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
		else if($action == 'upload_slider_img')
		{
			$doc1 = $this->request->getFile('slider_images');
			if($doc1->isValid())
			{
				$doc1validationRule = [
				   'slider_images' => [
					'label' => 'Image File',
					'rules' => 'uploaded[slider_images]'
					 . '|mime_in[slider_images,image/png,image/jpg,image/jpeg]'
					 . '|max_size[slider_images,2000]'
					 . '|max_dims[slider_images,1920,1080]',
				   ],
				];
				if ($this->validate($doc1validationRule)) {
					if (! $doc1->hasMoved()) {
						$file1 = $doc1->getRandomName();
						$doc1->move(ROOTPATH . 'images/homeslider', $file1);
						$upload = array(
						 'status' => 'A',
						 'upload_time' => date('Y-m-d H:i:s'),
						 'upload_by' => $session['user_id'],
						 'purpose' => 'home_slider',
						 'location' => 'homeslider/' . $file1,
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
		echo json_encode($error);
	}

	public function update_slider(){
		$session = $this->session->userdata('adminlogin');
		$error = array('success'=>false, 'message'=>array(), 'border'=>true);
		$frmdata = $this->input->post();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="frm-error form_err">', '</span>');
		$this->form_validation->set_rules('slider_id', 'Slide', 'required');
		$this->form_validation->set_rules('edt_image_id', 'Image', 'required');
		$this->form_validation->set_rules('edt_top', 'Top Line', 'required');
		if($this->form_validation->run()){
			
			$data = array(
				'last_update' => date('Y-m-d H:i:s'),
				'update_by' => $session['user_id'],
				'img' => $frmdata['edt_image_id'],
				'top_line' => $frmdata['edt_top'],
				'bottom_text' => $frmdata['edt_bottom'],
				'link_button' => isset($frmdata['edt_link_button'])?'Y':'',
				'form_button' => isset($frmdata['edt_form_button'])?'Y':'',
				'form_type' => $frmdata['edt_form_type'],
				'url_ref' => $frmdata['edt_url_ref']
			);
			$sql = $this->curd_model->update('home_slider', $data, array('id'=>$frmdata['slider_id']));
			if($sql){
				$error['success'] = true;
			}else{
				$error['message']['refrence'] = '<p>Error in slider update please try again.</p>';
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
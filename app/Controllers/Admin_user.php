<?php

namespace App\Controllers;

use CodeIgniter\Controller;


class Admin_user extends BaseController
{
    public function view()
    {
        $data['session'] = $this->session->get('adminlogin');
        $data = get_menu();
        if(in_array('user',$data['url']))
        {
            $data['other_action'] = explode(" ",$data['action_access']['user']);
            $data['user_id'] = '';
            if(isset($_GET['user_id']))
            {
                $_GET = mysql_clean($_GET);
				
                $data['user_id'] = (isset($_GET['user_id'])?$_GET['user_id']:'');
				
                // $data['user_id'] = data_decode($data['user_id']);
            }
            else if(isset($_POST['user_id']))
            {
                $_GET = mysql_clean($_POST);
                $data['user_id'] = (isset($_GET['user_id'])?$_GET['user_id']:'');
            }
            if($data['user_id'] != "")
            {
				//echo $data['user_id'];die();
                $data['user_id'] = ($data['user_id']);
                $data['user_id'] = data_decode($data['user_id']);
                //print_r($data['user_id']);
                $emp = $this->curd_model->get_all('*','login',array(),'f_name','ASC');
                foreach($emp as $em)
                {
                    $data['user_info'][$em->id] = $em;
                }
                $join = array(
                    array(
                        'table' => 'lms_tab_group',
                        'condition' => 'lms_tab.tab_group=lms_tab_group.id',
                        'type' => 'left'
                    )
                );
                $whr = array();
                $menu = $this->curd_model->jointable('lms_tab.other_action,lms_tab.id as tab_id,lms_tab.name,lms_tab.page_url,lms_tab_group.themify,lms_tab_group.name as group_name', 'lms_tab', $join, $whr, 'true', 'lms_tab_group.id', 'desc');
				//echo $this->db->getLastQuery();die();
			    foreach($menu as $mn)
                {
                    $data['menu'][$mn->group_name]['icon'] = $mn->themify;
                    $data['menu'][$mn->group_name]['menu'][$mn->name] = array('url'=>$mn->page_url,'id'=>$mn->tab_id,'other_action'=>$mn->other_action);
					
			    }
                $data['emp'] = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
               $data['emp_info'] = $this->curd_model->get_1('*', 'login', array('id'=>$data['user_id']));
                //	print_r($data['user_id']);
                $user_access = $this->curd_model->get_all('*', 'lms_user_access', array('user_id'=>$data['user_id']), 'tab_id', 'ASC');
                foreach($user_access as $ua)
                {
                    $data['user_access'][$ua->tab_id] = array('user_id'=>$ua->user_id,'status'=> $ua->status,'other_action' => $ua->other_action);
                }
                
                return view('admin/user_access',$data);
            }
            else{
                redirect('user');
            }
        }
        else
        {
            redirect("web-admin/dashboard");
        }
    }

    public function action_update($action = null)
    {
        $error = array('success' => false,'error_token'=>array('cname'=>csrf_token(),'cvalue'=>csrf_hash()), 'message' =>array(),'border'=>true);
        $frmdata = $this->request->getPost();
        $session = $this->session->get('adminlogin');
        if($action == 'add_user_info')
        {
           
            $check = $this->validate([
                'f_name' => ['rules' =>  'required','errors' =>  ['required' => 'First Name is required']],
                'l_name' => ['rules' =>  'required','errors' =>  ['required' => 'Last Name is required']],
                'email' => ['rules' =>  'required|valid_email','errors' =>  ['required' => 'User Email is required','valid_email'   =>  'You must provide a valid email address.']],
           ]);
            if($check)
            {
                    //$password = $frmdata['f_name'].'@'.rand(101,999);
                    $update_data = array(
                        'status' => 'A',
                        'create_time' => date('Y-m-d H:i:s'),
                        'update_time' => date('Y-m-d H:i:s'),
                        'update_by' => $session['user_id'],
                        'f_name' => $frmdata['f_name'],
                        'l_name' => $frmdata['l_name'],
                        'email_id' => $frmdata['email'],
                        //'password' => hash('sha256', $password),
                    );
                   
                    $insert = $this->curd_model->insert('login', $update_data);
                 
                    if($insert)
                    {
                       
                        $error['success'] = true;
                    }
                    else
                    {
                        $error['message']['refrence'] = '<p>Error in Insert.</p>';
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
        }
        else if($action == 'update_user_info')
        {
            $check = $this->validate([
                'f_name' => ['rules' =>  'required','errors' =>  ['required' => 'First Name is required']],
                'l_name' => ['rules' =>  'required','errors' =>  ['required' => 'Last Name is required']],
                'email' => ['rules' =>  'required|valid_email','errors' =>  ['required' => 'User Email is required','valid_email'   =>  'You must provide a valid email address.']],
                'user_id' => ['rules' =>  'required','errors' =>  ['required' => 'User is required']],
           ]);
            if($check)
            {
                $frmdata = mysql_clean($frmdata);
                $user = $this->curd_model->get_1('*', 'login', array('id'=>$frmdata['user_id']));
                //print_r($user);
                if(isset($user->id) && $user->password != '')
                {
                    $update_data = array(
                        'status' => $frmdata['status'],
                        'update_time' => date('Y-m-d H:i:s'),
                        'update_by' => $session['user_id'],
                      
                        'f_name' => $frmdata['f_name'],
                        'l_name' => $frmdata['l_name'],
                        'email_id' => $frmdata['email'],
					);
                    $update = $this->curd_model->update_table('login', $update_data, array('id'=>$frmdata['user_id']));
                    if($update)
                    {
                        $error['success'] = true;
                    }
                    else
                    {
                        $error['message']['refrence'] = '<p>Error in Update.</p>';
                    }
                }
                else
                {
                    $error['message']['alert'] = "Please generate user password.";
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
        }
        else if($action == 'update_user_password')
        {
            $session = $this->session->get('adminlogin');
            $check = $this->validate([
                'new_password' => ['rules' =>  'required','errors' =>  ['required' => 'New Password is required']],
                'con_password' => ['rules' =>  'required','errors' =>  ['required' => 'Confirm Password is required']],
            ]);
            if($check)
            {
                //$frmdata = mysql_clean($frmdata);
                if($frmdata['new_password'] == $frmdata['con_password'])
                {
                
                    $update_data = array(
                        'update_time' => date('Y-m-d H:i:s'),
                        'update_by' => $session['user_id'],
                        'password' => hash('sha256', $frmdata['new_password']), 
                    );
                    $update = $this->curd_model->update_table('login', $update_data, array('id'=>$frmdata['user_id']));
                    if($update)
                    {
                        $error['success'] = true;
                    }
                    else
                    {
                        $error['message']['refrence'] = '<p>Error in Update.</p>';
                    }
                }
                else
                {
                    $error['message']['refrence'] = "Password not match.";
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
        }
        else if($action == 'update_access')
        {
            $check = $this->validate([
                'user_id' => ['rules' =>  'required','errors' =>  ['required' => 'User is required']]
            ]);
            if($check)
            {
                $rmv_link = $this->curd_model->update_table('lms_user_access',array('status'=>'D','other_action'=>''),array('user_id'=>$frmdata['user_id']));
               // print_r($rmv_link);
                if($rmv_link)
                {
                    foreach($frmdata['tab'] as $tab)
                    {
                        $action_tab = "";
                        if(isset($frmdata['action'][$tab]))
                        {
                            $action_tab = implode(" ",$frmdata['action'][$tab]);
                        }
                        $this->curd_model->customquery("
                            INSERT INTO lms_user_access (`user_id`,`tab_id`,`status`,`other_action`) VALUES (".$frmdata['user_id'].",".$tab.",'A','".$action_tab."') 
                            ON DUPLICATE KEY UPDATE 
                            `status` = 'A',
                            `other_action` = '".$action_tab."'
                        ");
                    }
                    
                    $error['success'] = true;
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
        }
        else if($action == 'update_type_access')
        {
            $check = $this->validate([
                'type' => ['rules' =>  'required','errors' =>  ['required' => 'type is required']]
            ]);
            if($check)
            {
                $rmv_link = $this->curd_model->update_table('user_type_access',array('status'=>'D','other_action'=>''),array('user_key'=>$frmdata['type']));
                if($rmv_link)
                {
                    
                    foreach($frmdata['tab'] as $tab)
                    {
                        $action_tab = "";
                        if(isset($frmdata['action'][$tab]))
                        {
                            $action_tab = implode(" ",$frmdata['action'][$tab]);
                        }
                        
                        $this->curd_model->customquery("
                            INSERT INTO user_type_access (`user_key`,`tab_id`,`status`,`other_action`) VALUES ('".$frmdata['type']."',".$tab.",'A','".$action_tab."') 
                            ON DUPLICATE KEY UPDATE 
                            `status` = 'A',
                            `other_action` = '".$action_tab."'
                        ");
                       
                    }
                    $error['success'] = true;
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
        }
        else if($action == 'get_office')
        {
            $check = $this->validate([
                'type' => ['rules' =>  'required','errors' =>  ['required' => 'type is required']]
            ]);
            if($check)
            {
                if($frmdata['type'] == 'CO'){
                    $result = $this->curd_model->get_all('*', 'central_organisation', array('status'=>'A'), 'organisation', 'ASC');
                    foreach($result as $re)
                    {
                        $error['office_list'][] = array('id'=>$re->id,'name'=>$re->organisation);
                    }
                }
                else if($frmdata['type'] == 'RC'){
                    $result = $this->curd_model->get_all('*', 'rc_office', array('status'=>'A'), 'name', 'ASC');
                    foreach($result as $re)
                    {
                        $error['office_list'][] = array('id'=>$re->id,'name'=>$re->name);
                    }
                }
                else if($frmdata['type'] == 'HQ'){
                    $result = $this->curd_model->get_all('*', 'stn_hq', array('status'=>'A'), 'name', 'ASC');
                    foreach($result as $re)
                    {
                        $error['office_list'][] = array('id'=>$re->id,'name'=>$re->name);
                    }
                }
                else if($frmdata['type'] == 'PC'){
                    $result = $this->curd_model->get_all('*', 'polyclinics', array('status'=>'A'), 'name', 'ASC');
                    foreach($result as $re)
                    {
                        $error['office_list'][] = array('id'=>$re->id,'name'=>$re->name);
                    }
                }
                else{
                    $error['office_list'][] = array('id'=> 0,'name'=>'ECHS');
                }
                $error['success'] = true;
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
        }
        echo json_encode($error);
    }
}

?>
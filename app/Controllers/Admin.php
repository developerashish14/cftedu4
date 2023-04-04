<?php
namespace App\Controllers;
use CodeIgniter\Controller;
class Admin extends BaseController
{
    public function view($url = "")
    {
        $data['session'] = $this->session->get('adminlogin');
        $data = get_menu();
        $url = explode('.',$url);
        if($url[0] != "dashboard")
        {
            $data['other_action'] = explode(" ",$data['action_access'][$url[0]]);
        }
        if($url[0] == 'dashboard')
        {
            $data['count']['student'] = $this->curd_model->count_where('frm_student_registration',array());
            $data['count']['join_us'] = $this->curd_model->count_where('frm_join_us',array());
            $data['count']['contact'] = $this->curd_model->count_where('frm_contact',array());
           // $data['contact'] = $this->curd_model->select_where_single_like('frm_contact',array('insert_time'=>date('Y-m-d')),'id','DESC',0,20);
            //$data['registration'] = $this->curd_model->select_where_single_like('frm_student_registration',array('insert_time'=>date('Y-m-d')),'id','DESC',0,20);
        }
        else if($url[0] == "user" && in_array('user',$data['url']))
        {
           // $data['emp_info'] = $this->curd_model->get_1('*', 'login', array('id'=>$data['user_id']));
            $data['status'] = isset($_POST['status'])?$_POST['status']:'A';
            $data['user_ty'] = $this->curd_model->get_all('*', 'user_type', array(), 'name', 'ASC');
            foreach($data['user_ty'] as $ut)
            {
                $data['user_type'][$ut->user_key] = $ut;
            }
           
            $data['emp'] = $this->curd_model->get_all('*', 'login', array('status'=>$data['status']), 'f_name', 'ASC');
        }
        else if($url[0] == "user_type")
        {   
            $data['type'] = isset($_POST['type'])?$_POST['type']:'';
             
            $user_access = $this->curd_model->get_all('*', 'user_type_access', array('user_key'=>$data['type']), 'tab_id', 'ASC');
            foreach($user_access as $ua)
            {
                $data['user_access'][$ua->tab_id] = array('user_key'=>$ua->user_key,'status'=> $ua->status,'other_action' => $ua->other_action);
            }
           
            $join = array(
                array(
                    'table' => 'tab_group',
                    'condition' => 'tab.tab_group=tab_group.id',
                    'type' => 'left'
                )
            );
            $whr = array();
            $menu = $this->curd_model->jointable('tab.other_action,tab.id as tab_id,tab.name,tab.page_url,tab_group.themify,tab_group.name as group_name', 'tab', $join, $whr, 'true', 'tab_group.id', 'desc');
            foreach($menu as $mn)
            {
                $data['menu'][$mn->group_name]['icon'] = $mn->themify;
                $data['menu'][$mn->group_name]['menu'][$mn->name] = array('url'=>$mn->page_url,'id'=>$mn->tab_id,'other_action'=>$mn->other_action);
            }
            
            $user_type = $this->curd_model->get_all('*', 'user_type', array('status'=>'A'), 'name', 'ASC');
            foreach($user_type as $ua)
            {
                $data['user_type'][$ua->user_key] = $ua;
            }
        }
		else if($url[0] == "programs")
		{
			
			$data['status'] = isset($_POST['status'])?$_POST['status']:'A';
			$data['programs'] = $this->curd_model->get_all('*', 'programs', array('status'=>$data['status']), 'id', 'DESC');
		
		}
		
		else if($url[0] == "faculty"  && in_array('faculty',$data['url'])) //Certificate
		{
			$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
			$data['images'] = array();
			foreach($emp as $em)
			{
				$data['user_info'][$em->id] = $em;
			}
			$images = $this->curd_model->get_all('*', 'images', array('purpose'=>'faculty_image','status'=>'A'), 'id', 'DESC');
			foreach($images as $img)
			{
				$data['images'][$img->id] = $img;
			}
			$data['faculty_data'] = $this->curd_model->get_all('*', 'faculty', array(), 'id', 'DESC');
		}
		else if($url[0] == "faculty_request"  && in_array('faculty_request',$data['url'])) //Certificate
		{
			$data['from_date'] = isset($_POST['from_date'])?$_POST['from_date']:date('Y-m-d');
			$data['to_date'] = isset($_POST['to_date'])?$_POST['to_date']:date('Y-m-d');
			$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
			foreach($emp as $em)
			{
				$data['user_info'][$em->id] = $em;
			}
			$data['load_data'] = $this->curd_model->get_all('*', 'faculty_request', array('status'=>'P'), 'id', 'DESC');
		}
		else if($url[0] == "faculty_course"  && in_array('faculty_course',$data['url'])) //Certificate
		{
			$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
			foreach($emp as $em)
			{
				$data['user_info'][$em->id] = $em;
			}
			$course = $this->curd_model->get_all('*', 'lms_course', array(), 'id', 'ASC');
			foreach($course as $ci)
			{
				$data['course_info'][$ci->id] = $ci;
			}
			$faculty = $this->curd_model->get_all('*', 'faculty', array(), 'id', 'ASC');
			foreach($faculty as $fi)
			{
				$data['faculty_info'][$fi->id] = $fi;
			}
			$data['faculty_detals'] = $this->curd_model->get_all('*', 'faculty_course', array(), 'id', 'DESC');
		}
		else if($url[0] == "complaint"  && in_array('complaint',$data['url'])) //Certificate
		{
				$data['process_filter'] = isset($_POST['process_filter'])?$_POST['process_filter']:'1';
				$data['from_date'] = isset($_POST['from_date'])?$_POST['from_date']:date('Y-m-d');
				$data['to_date'] = isset($_POST['to_date'])?$_POST['to_date']:date('Y-m-d');
				
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				
				$data['process'] = $this->curd_model->get_all('*','complaint_status',array(),'id','ASC');
			    $data['query'] = $this->curd_model->customquery1('select * from `complaint` where `insert_time` between "? 00:00:00" AND "? 23:59:59" AND  stage_id = ? order by `last_update` DESC',array($data['from_date'],$data['to_date'],$data['process_filter']));
				
				
				//echo $this->db->getLastQuery();die();
				
				//$rmk = $this->curd_model->get_all('*','complaint_remark',array('1'=>'1'),'id','ASC');
				
				
				$name = $this->curd_model->get_all('*', 'student_registration', array(), 'id', 'ASC');
				foreach($name as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$stage = $this->curd_model->get_all('*', 'complaint_status', array(), 'id', 'ASC');
				foreach($stage as $sj)
				{
					$data['stage_details'][$sj->id] = $sj;
				}
				$com_remarks = $this->curd_model->get_all('*', 'complaint_remark', array(), 'id', 'ASC');
				foreach($com_remarks as $com_remark)
				{
					$data['com_remarks'][$com_remark->id] = $com_remark;   //not working
				}
				$admin = $this->curd_model->get_all('*','login',array(),'id','ASC');
				foreach($admin as $adm)
				{
					$data['admin'][$adm->id] = $adm->f_name.' '.$adm->l_name;
				}
		}
		else if($url[0] == "services"  && in_array('services',$data['url'])) //Certificate
		{
			$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
			$data['images'] = array();
			foreach($emp as $em)
			{
				$data['user_info'][$em->id] = $em;
			}
			$data['services'] = $this->curd_model->get_all('*', 'services', array(), 'id', 'DESC');
		}
		else if($url[0] == "contact"  && in_array('contact',$data['url']))
			{
				$data['from_date'] = isset($_POST['from_date'])?$_POST['from_date']:date('Y-m-d');
				$data['to_date'] = isset($_POST['to_date'])?$_POST['to_date']:date('Y-m-d');
				
				$data['session'] = $this->session->userdata('login');
				$data['contact'] = $this->curd_model->customquery1("select * from `frm_contact` where `insert_time` between '".$data['from_date']." 00:00:00' and '".$data['to_date']." 23:59:59' ");
				$user = $this->curd_model->get_all('*', 'login', array(), 'id', 'asc');
				foreach($user as $us)
				{
					$data['user'][$us->id] = array('name'=>$us->f_name); 
				}
			}
			else if($url[0] == "fun_fact"  && in_array('fun_fact',$data['url'])) //Certificate
			{
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				$data['images'] = array();
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				
				$data['awesome_fact'] = $this->curd_model->get_all('*', 'awesome_number', array(), 'id', 'DESC');
			}
			else if($url[0] == "board"  && in_array('board',$data['url']))
			{
				$data['images'] = $this->curd_model->get_all('*', 'images', array('status'=>'A','purpose'=>'board'), 'id', 'DESC');
				foreach($data['images'] as $img)
				{
				$data['img_detail'][$img->id] = $img->location;
				}
				$emp = $this->curd_model->get_all('*','login',array(),'f_name','ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$data['board'] = $this->curd_model->get_all('*', 'board', array(), 'id', 'DESC');
				
			}
			else if($url[0] == "team"  && in_array('team',$data['url'])) //Certificate
			{
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				$data['images'] = array();
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$images = $this->curd_model->get_all('*', 'images', array('purpose'=>'team','status'=>'A'), 'id', 'DESC');
				foreach($images as $img)
				{
					$data['images'][$img->id] = $img;
				}
				$data['team'] = $this->curd_model->get_all('*', 'team', array(), 'id', 'DESC');
			}
			else if($url[0] == "testimonial"  && in_array('testimonial',$data['url'])) //Certificate
			{
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				$data['images'] = array();
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$images = $this->curd_model->get_all('*', 'images', array('purpose'=>'testimonials','status'=>'A'), 'id', 'DESC');
				foreach($images as $img)
				{
					$data['images'][$img->id] = $img;
				}
				$data['testimonial'] = $this->curd_model->get_all('*', 'testimonial', array(), 'id', 'DESC');
			}
			else if($url[0] == "logos"  && in_array('logos',$data['url']))
			{
				//convert in wcpa
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$images = $this->curd_model->get_all('*', 'images', array('purpose'=>'logos','status'=>'A'), 'id', 'DESC');
				foreach($images as $img)
				{
					$data['images'][$img->id] = $img;
				}
				$data['logos'] = $this->curd_model->get_all('*', 'logos', array(), 'id', 'ASC');
			}
			else if($url[0] == "online_classroom"  && in_array('online_classroom',$data['url']))
			{
				//echo'amans';
				$data['class_date'] = isset($_POST['class_date'])?$_POST['class_date']:date('Y-m-d');
				//print_r($data['class_date']);die();
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$data['classroom'] = $this->curd_model->get_all('*','online_classroom',array('class_date'=>$data['class_date']),'start_time','ASC');
			}
			else if($url[0] == "promo_code"  && in_array('promo_code',$data['url']))
			{
				
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$data['promo_code'] = $this->curd_model->get_all('*','promo_code',array(),'id','DESC');
			}
			else if($url[0] == "join_us"  && in_array('join_us',$data['url'])) // Virtual Classroom
			{
				$data['from_date'] = isset($_POST['from_date'])?$_POST['from_date']:date('Y-m-d');
				$data['to_date'] = isset($_POST['to_date'])?$_POST['to_date']:date('Y-m-d');
				
				$data['session'] = $this->session->userdata('login');
				$data['joinus'] = $this->curd_model->customquery1("select * from `frm_join_us` where `insert_time` between '".$data['from_date']." 00:00:00' and '".$data['to_date']." 23:59:59' ");
				$user = $this->curd_model->get_all('*', 'login', array(), 'id', 'asc');
				foreach($user as $us)
				{
					$data['user'][$us->id] = array('name'=>$us->f_name); 
				}
			}
			else if($url[0] == "event"  && in_array('event',$data['url'])) // Virtual Classroom
			{
				$data['from_date'] = isset($_POST['from_date'])?$_POST['from_date']:date('Y-m-d');
				$data['to_date'] = isset($_POST['to_date'])?$_POST['to_date']:date('Y-m-d');
				
				$data['event'] = $this->curd_model->customquery1("select * from `frm_event_registration` where `insert_time` between '".$data['from_date']." 00:00:00' and '".$data['to_date']." 23:59:59' ");
				$user = $this->curd_model->get_all('*', 'login', array(), 'id', 'asc');
				foreach($user as $us)
				{
					$data['user'][$us->id] = array('name'=>$us->f_name); 
				}
			}
			else if($url[0] == "subscribe"  && in_array('subscribe',$data['url']))
			{
				$data['from_date'] = isset($_POST['from_date'])?$_POST['from_date']:date('Y-m-d');
				$data['to_date'] = isset($_POST['to_date'])?$_POST['to_date']:date('Y-m-d');
			
				$data['session'] = $this->session->userdata('login');
				$data['subscribe'] = $this->curd_model->customquery1("select * from `frm_subscribe` where `insert_time` between '".$data['from_date']." 00:00:00' and '".$data['to_date']." 23:59:59' ");
				$user = $this->curd_model->get_all('*', 'login', array(), 'id', 'asc');
				foreach($user as $us)
				{
					$data['user'][$us->id] = array('name'=>$us->f_name); 
				}
			}
			else if($url[0] == "program"  && in_array('program',$data['url']))
			{
				$data['user_id'] = isset($_GET['user_id'])?$_GET['user_id']:$data['session']['user_id'];
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$data['program'] = $this->curd_model->get_all('*', 'lms_program', array(), 'id', 'DESC');
				
			}
			else if($url[0] == "offline_program"  && in_array('offline_program',$data['url']))
			{
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$data['program'] = $this->curd_model->get_all('*', 'offline_course_category', array(), 'id', 'DESC');
			}
			else if($url[0] == "course"  && in_array('course',$data['url']))
			{
				$data['status'] = isset($_GET['status'])?$_GET['status']:"0";
				$data['program_id'] = isset($_GET['program_id'])?$_GET['program_id']:"0";
				$data['images'] = array();
				$filter = array();
				$membership = $this->curd_model->get_all('*', 'membership_type', array('status'=>'A'), 'id', 'DESC');
				foreach($membership as $mem)
				{
					$data['membership'][$mem->id] = $mem;
				}
				$images = $this->curd_model->get_all('*', 'images', array('purpose'=>'course','status'=>'A'), 'id', 'DESC');
				foreach($images as $img)
				{
					$data['images'][$img->id] = $img;
				}
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$program = $this->curd_model->get_all('*', 'lms_program', array('status'=>'A'), 'id', 'DESC');
				foreach($program as $pg)
				{
					$data['program'][$pg->id] = $pg;
				}
				if($data['program_id'] != "0" && $data['status'] != "0")
				{
					$filter = array('program_id'=>$data['program_id'],'status'=>$data['status']);
				}
				else if($data['program_id'] != "0" && $data['status'] == "0")
				{
					$filter = array('program_id'=>$data['program_id']);
				}
				else if($data['program_id'] == "0" && $data['status'] != "0")
				{
					$filter = array('status'=>$data['status']);
				}
				$data['course'] = $this->curd_model->get_all('*', 'lms_course', $filter, 'id', 'ASC');
				$course_detail = $this->curd_model->get_all('*', 'course_detail_pages', array(), 'id', 'ASC');
				foreach($course_detail as $crs_dt)
				{
					$data['course_url'][$crs_dt->course_id] = $crs_dt->page_url;
				}
				$data['faculty'] = $this->curd_model->get_all('*', 'faculty', array('status'=>'A'), 'id', 'ASC');
				$course_data = $this->curd_model->get_all('*', 'faculty_course', array('status'=>'A'), 'id', 'ASC');
				foreach($course_data as $crs)
				{
					$data['faculty_course'][$crs->course_id] = $crs->faculty_id;
				}
			}
			else if($url[0] == "offline_course"  && in_array('offline_course',$data['url']))
			{
				$data['status'] = isset($_POST['status'])?$_POST['status']:"0";
				$data['program_id'] = isset($_POST['program_id'])?$_POST['program_id']:"0";
				$data['images'] = array();
				$filter = array();
				
				$images = $this->curd_model->get_all('*', 'images', array('purpose'=>'certificate_course','status'=>'A'), 'id', 'DESC');
				foreach($images as $img)
				{
					$data['images'][$img->id] = $img;
				}
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$program = $this->curd_model->get_all('*', 'offline_course_category', array('status'=>'A'), 'id', 'DESC');
				foreach($program as $pg)
				{
					$data['program'][$pg->id] = $pg;
				}
				if($data['program_id'] != "0" && $data['status'] != "0")
				{
					$filter = array('category_id'=>$data['program_id'],'status'=>$data['status']);
				}
				else if($data['program_id'] != "0" && $data['status'] == "0")
				{
					$filter = array('category_id'=>$data['program_id']);
				}
				else if($data['program_id'] == "0" && $data['status'] != "0")
				{
					$filter = array('status'=>$data['status']);
				}
				$data['course'] = $this->curd_model->get_all('*', 'offline_course', $filter, 'id', 'ASC');
				$course_detail = $this->curd_model->get_all('*', 'offline_course_detail_pages', array('category'=>'certificate_course'), 'id', 'ASC');
				foreach($course_detail as $crs_dt)
				{
					$data['course_url'][$crs_dt->page_id] = $crs_dt->page_url;
				}
			}
			else if($url[0] == "certificate_signature"  && in_array('certificate_signature',$data['url'])) //Certificate
			{
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				$data['images'] = array();
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$images = $this->curd_model->get_all('*', 'images', array('purpose'=>'signature','status'=>'A'), 'id', 'DESC');
				foreach($images as $img)
				{
					$data['images'][$img->id] = $img;
				}
				$data['singature'] = $this->curd_model->get_all('*', 'certificate_signature', array(), 'id', 'DESC');
			}
			else if($url[0] == "cft_certificate"  && in_array('cft_certificate',$data['url'])) //Certificate
			{
				$data['from_date'] = isset($_POST['from_date'])?$_POST['from_date']:date('Y-m-d');
				$data['to_date'] = isset($_POST['to_date'])?$_POST['to_date']:date('Y-m-d');
				$data['status'] = isset($_POST['status'])?$_POST['status']:'A';
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$data['signature'] = $this->curd_model->get_all('*', 'certificate_signature', array('status'=>'A'), 'id', 'DESC');
				$data['certificate'] = $this->curd_model->customquery1("select * from `cft_certificate` where `status` = '".$data['status']."' and `insert_at` between '".$data['from_date']." 00:00:00' and '".$data['to_date']." 23:59:59' order by `id` DESC ");
			}
			else if($url[0] == "certificate_list"  && in_array('certificate_list',$data['url'])) //Certificate
			{
				$data['from_date'] = isset($_POST['from_date'])?$_POST['from_date']:date('Y-m-d');
				$data['to_date'] = isset($_POST['to_date'])?$_POST['to_date']:date('Y-m-d');
				$data['status'] = isset($_POST['status'])?$_POST['status']:'A';
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$data['signature'] = $this->curd_model->get_all('*', 'certificate_signature', array('status'=>'A'), 'id', 'DESC');
				$data['certificate'] = $this->curd_model->customquery1("select * from `certificate` where `status` = '".$data['status']."' and `insert_at` between '".$data['from_date']." 00:00:00' and '".$data['to_date']." 23:59:59' order by `id` DESC ");
			}
			else if($url[0] == "manual_payment"  && in_array('manual_payment',$data['url']))
			{
				$data['from_date'] = isset($_POST['from_date'])?$_POST['from_date']:date('Y-m-d');
				$data['to_date'] = isset($_POST['to_date'])?$_POST['to_date']:date('Y-m-d');
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$data['paylink'] = $this->curd_model->customquery1('select * from `payment_link` where `last_update` BETWEEN "'.$data['from_date'].' 00:00:00" AND "'.$data['to_date'].' 23:59:59" ');
			}
			else if($url[0] == "international_payment"  && in_array('international_payment',$data['url']))
			{
				$data['paylink'] = array();
				$data['from_date'] = isset($_POST['from_date'])?$_POST['from_date']:date('Y-m-d');
				$data['to_date'] = isset($_POST['to_date'])?$_POST['to_date']:date('Y-m-d');
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$int_id = $this->curd_model->customquery1('select `bill_id` from `international_invoice` where `last_update` BETWEEN "'.$data['from_date'].' 00:00:00" AND "'.$data['to_date'].' 23:59:59" ');
				foreach($int_id as $ii)
				{
					$data['int_id'][] = $ii->bill_id;
				}
				if(count($int_id) > 0)
				{
					$data['paylink'] = $this->curd_model->customquery1('select * from `payment_link` where `id` IN ('.implode(',',$data['int_id']).') ');
				}
			}
			else if($url[0] == "payment"  && in_array('payment',$data['url']))
			{
				$data['payment_type'] = isset($_GET['payment_type'])?$_GET['payment_type']:'';
				$data['product'] = isset($_GET['product'])?$_GET['product']:'';
				$data['from_date'] = isset($_GET['from_date'])?$_GET['from_date']:date('Y-m-d');
				$data['to_date'] = isset($_GET['to_date'])?$_GET['to_date']:date('Y-m-d');
				$data['status'] = isset($_GET['status'])?$_GET['status']:'P';
				$data['user_id'] = isset($_GET['user_id'])?$_GET['user_id']:$data['session']['user_id'];
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				
				$f_pay_type = (($data['payment_type']!="")?" and `payment_mode` = '".$data['payment_type']."' ":"");
				$f_product = (($data['product']!="")?" and `product_info` = '".$data['product']."' ":" and `product_info` <> 'School' ");
				$data['payment'] = $this->curd_model->customquery1('select * from `amount_transaction` where `insert_time` between "'.$data['from_date'].' 00:00:00" and "'.$data['to_date'].' 23:59:59" AND `status` = "'.$data['status'].'" '.$f_pay_type.$f_product.'  order BY `id` DESC ');
				$data['mode'] = $this->curd_model->customquery1("select DISTINCT(`payment_mode`) from `amount_transaction` order by `payment_mode` ASC");
				$data['product_type'] = $this->curd_model->get_all('*','membership_type',array('status'=>'A'),'id','DESC');
			}
			else if($url[0] == "virtual_batch"  && in_array('virtual_batch',$data['url'])) // Virtual Classroom
			{
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$data['virtual_class_batch'] = $this->curd_model->get_all('*', 'virtual_class_batch', array(), 'id', 'DESC');
			}
			else if($url[0] == "20_20_class"  && in_array('20_20_class',$data['url']))
			{
				$data['date'] = (isset($_POST['date'])?$_POST['date']:date('Y-m-d'));
				//$data['user_id'] = isset($_GET['user_id'])?$_GET['user_id']:$data['session']['user_id'];
				$emp = $this->curd_model->get_all('*','login',array(),'f_name','ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$data['class'] = $this->curd_model->customquery1('select * from `20_20_class` where `class_time` LIKE "'.$data['date'].'%" order by `id` DESC');
				$batch = $this->curd_model->customquery1('select * from `virtual_class_batch` order by `id` DESC');
				foreach($batch as $bt){
					$data['batch'][$bt->batch_code] = $bt;
				}
			}
			else if($url[0] == "report_vc2020_video" && in_array('report_vc2020_video',$data['url']))
			{
				$data['from_date'] = isset($_POST['from_date'])?$_POST['from_date']:date('Y-m-d');
				$data['to_date'] = isset($_POST['to_date'])?$_POST['to_date']:date('Y-m-d');
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$data['video_history'] = $this->curd_model->customquery1('select *, SEC_TO_TIME(SUM(time_to_sec(TIMEDIFF(`end_time`,`start_time`)))) as "watch_duration" from `2020_class_watching` where `insert_time` BETWEEN "'.$data['from_date'].' 00:00:00" AND "'.$data['to_date'].' 23:59:59" group by `phone` ');
			}
			else if($url[0] == "20_20_class_video"  && in_array('20_20_class_video',$data['url']))
			{
				$data['day'] = (isset($_POST['day'])?$_POST['day']:'0');
				//$data['user_id'] = isset($_GET['user_id'])?$_GET['user_id']:$data['session']['user_id'];
				$emp = $this->curd_model->get_all('*','login',array(),'f_name','ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$f_day = (($data['day'] != '0')?' AND `day` = "'.$data['day'].'" ':'');
				$data['class'] = $this->curd_model->customquery1('select * from `20_20_class_video` where `status` = "A" '.$f_day.' order by `id` DESC');
				
			}
			else if($url[0] == "student_registration"  && in_array('student_registration',$data['url']))
			{
				$stu_id = array();
				$data['student'] = array();
				$data['email_id'] = (isset($_POST['email_id'])?$_POST['email_id']:'');
				$data['from_date'] = (isset($_POST['from_date'])?$_POST['from_date']:date('Y-m-d'));
				$data['to_date'] = (isset($_POST['to_date'])?$_POST['to_date']:date('Y-m-d'));
				$data['consultant'] = $this->curd_model->get_all('*','frm_consultant',array(),'name','ASC');
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				if(isset($_POST['email_id']))
				{
					$data['student'] = $this->curd_model->get_all('*','student_registration',array('email_id'=>$data['email_id']),'id','ASC');
				}
				else
				{
					$data['student'] = $this->curd_model->customquery1('select * from `student_registration` where `insert_time` between "'.$data['from_date'].' 00:00:00" AND "'.$data['to_date'].' 23:59:59"');
				}
				$member = $this->curd_model->get_all('*', 'membership_type', array(), 'id', 'ASC');
				foreach($member as $mam)
				{
					$data['member'][$mam->id] = $mam->name;
				}
			}
			else if($url[0] == "vlrn-signup"  && in_array('vlrn-signup',$data['url']))
			{
				$stu_id = array();
				$data['request'] = array();
				$data['from_date'] = (isset($_POST['from_date'])?$_POST['from_date']:date('Y-m-d'));
				$data['to_date'] = (isset($_POST['to_date'])?$_POST['to_date']:date('Y-m-d'));
				$data['process_filter'] = (isset($_POST['process_filter'])?$_POST['process_filter']:'P');
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$client = $this->curd_model->get_all('*', 'vlrn_client_type', array(), 'id', 'ASC');
				foreach($client as $clt)
				{
					$data['client'][$clt->id] = $clt;
				}
				
				$data['request'] = $this->curd_model->customquery1("select * from `vlrn_student_signup` where `last_update` between '".$data['from_date']." 00:00:00' AND '".$data['to_date']." 23:59:59' AND status = '".$data['process_filter']."'  order by `id` DESC");
				
			}
			else if($url[0] == "vlrn-student-registration"  && in_array('vlrn-student-registration',$data['url']))
			{
				$stu_id = array();
				$data['student'] = array();
				$data['email_id'] = (isset($_POST['email_id'])?$_POST['email_id']:'');
				$data['from_date'] = (isset($_POST['from_date'])?$_POST['from_date']:date('Y-m-d'));
				$data['to_date'] = (isset($_POST['to_date'])?$_POST['to_date']:date('Y-m-d'));
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$client = $this->curd_model->get_all('*', 'vlrn_client_type', array(), 'id', 'ASC');
				foreach($client as $clnt)
				{
					$data['client'][$clnt->id] = $clnt;
				}
				if(isset($_POST['email_id']))
				{
					$data['student'] = $this->curd_model->get_all('*','vrl_student_registration',array('email_id'=>$data['email_id']),'id','ASC');
				}
				else
				{
					$data['student'] = $this->curd_model->customquery1('select * from `vrl_student_registration` where `insert_time` between "'.$data['from_date'].' 00:00:00" AND "'.$data['to_date'].' 23:59:59"');
				}
			}
			else if($url[0] == "vlrn-student-course"  && in_array('vlrn-student-course',$data['url']))
			{
				$courses = array();
				$data['course'] = array();
				$data['email_id'] = (isset($_POST['email_id'])?$_POST['email_id']:'');
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				if($data['email_id'] != '')
				{
					$join = array(
						array('table'=>'vlrn_active_course', 'condition'=>'vrl_student_registration.id=vlrn_active_course.stu_id', 'type'=>'left')
					);
					$data['course'] = $this->curd_model->jointable('vlrn_active_course.*','vrl_student_registration', $join, array('vrl_student_registration.email_id'=>$data['email_id'],'vlrn_active_course.status'=>'A'),true);
					foreach($data['course'] as $crs){
						$courses[] = $crs->course_code;
					}
					
					$course_details = $this->curd_model->customquery1('select * from `vlrn_course` where `course_code` IN ("'.implode('","',$courses).'") order by `course_code` ASC');
					foreach($course_details as $crs){
						$data['course_details'][$crs->course_code] = $crs;
					}
				}
			}
			else if($url[0] == "vlrn-course"  && in_array('vlrn-course',$data['url']))
			{
				$stu_id = array();
				$data['course'] = array();
				$data['course_code'] = (isset($_POST['course_code'])?$_POST['course_code']:'');
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				if(isset($_POST['course_code']))
				{
					$data['course'] = $this->curd_model->customquery1('select * from `vlrn_course` where `course_code` LIKE "'.$data['course_code'].'%" order by `course_code` ASC');
				}
				else
				{
					$data['course'] = $this->curd_model->get_all('*','vlrn_course',array(),'course_code','ASC');
				}
			}
			else if($url[0] == "demo_course"  && in_array('demo_course',$data['url'])) //Certificate
			{
				$emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
				$data['images'] = array();
				foreach($emp as $em)
				{
					$data['user_info'][$em->id] = $em;
				}
				$images = $this->curd_model->get_all('*', 'images', array('purpose'=>'demo_course','status'=>'A'), 'id', 'DESC');
				foreach($images as $img)
				{
					$data['images'][$img->id] = $img;
				}
				$data['course'] = $this->curd_model->get_all('*', 'demo_course', array(), 'id', 'DESC');
			}
		else if($url[0] == "web_pages"  && in_array('web_pages',$data['url']))
			{
				//convert in wcpa
				$data['pages'] = $this->curd_model->get_all('*','web_pages',array(),'id','DESC');
			}
		else if($url[0] == "slider"  && in_array('slider',$data['url']))
			{
				//convert in wcpa
				$images = $this->curd_model->get_all('*', 'images', array('purpose'=>'home_slider','status'=>'A'), 'id', 'DESC');
				foreach($images as $img)
				{
					$data['images'][$img->id] = $img;
				}
				$data['slider'] = $this->curd_model->get_all('*', 'home_slider', array(), 'id', 'DESC');
			}
		else if($url[0] == "logout")
        {
            $this->session->remove('adminlogin');
            return redirect()->to('/lms');
        }
        if(in_array($url[0],$data['url']) || $url[0] == "dashboard")
        {
            if($url[0] != "dashboard")
            {
                $data['other_action'] = explode(" ",$data['action_access'][$url[0]]);
            }
            $emp = $this->curd_model->get_all('*', 'login', array(), 'f_name', 'ASC');
            foreach($emp as $em)
            {
                $data['user_info'][$em->id] = $em;
            }
            return view('admin/'.$url[0],$data);
        }
    }
}
?>
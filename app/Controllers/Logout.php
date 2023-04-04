<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout1 extends CI_Controller {
    public function index(){
        redirect(base_url());
    }
    
    public function __construct(){
        parent:: __construct();
		$this->curd_model->update_session();
        session_destroy();
    }
}
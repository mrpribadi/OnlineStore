<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->library('session');
		$s_userid   = $this->session->userdata('id');
        if(empty($s_userid)){
			echo '<script>
					alert("You dont have Login Session, please login first.");
					window.location.href="'.base_url().'auth";
				 </script>';        
		}
    }

    function index() {
        $data = array('content' => 'backend/home');
        $this->load->view('backend/layout/app', $data);
    }
    
}
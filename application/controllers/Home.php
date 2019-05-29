<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct() {
        parent::__construct();
        // $this->load->library('session');
		// $s_userid   = $this->session->userdata('id');
        // if(empty($s_userid)){
		// 	echo '<script>
		// 			alert("You dont have Login Session, please login first.");
		// 			window.location.href="'.base_url().'auth";
		// 		 </script>';        
		// }
    }

    function index() {
        $treatment_popular = $this->app_model->get_data_query("SELECT * FROM product WHERE product_most_popular = 1 LIMIT 4 ")->result();
        $menu = $this->app_model->get_data_query("SELECT * FROM product_category WHERE product_category_parent = 0 AND product_category_status = 'active'")->result();
        $submenu = $this->app_model->get_data_query("SELECT product_id, product_category_id, product_name, product_url FROM product WHERE product_status = 'active'")->result();
        $data = array(
            'content' => 'frontend/home',
            'popular' => $treatment_popular,
            'menu'    => $menu,
            'submenu' => $submenu
        );
        $this->load->view('frontend/layout/app', $data);
    }
    
}
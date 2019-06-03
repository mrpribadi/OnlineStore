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
        $treatment_popular = $this->app_model->get_data_query("SELECT * FROM product WHERE product_most_popular = 1 ORDER BY  product_most_popular_date DESC LIMIT 4")->result();
        $treatment_promo = $this->app_model->get_data_query("SELECT * FROM product WHERE product_promo_list = 1 ORDER BY product_promo_list_date DESC LIMIT 2")->result();
        $treatment_new = $this->app_model->get_data_query("SELECT * FROM product WHERE product_new_in = 1 ORDER BY product_new_in_date DESC LIMIT 2")->result();
        $menu = $this->app_model->get_data_query("SELECT * FROM product_category WHERE product_category_parent = 0 AND product_category_status = 'active'")->result();
        $submenu = $this->app_model->get_data_query("SELECT product_id, product_category_id, product_name, product_url FROM product WHERE product_status = 'active'")->result();
        $data = array(
            'content' => 'frontend/home',
            'popular' => $treatment_popular,
            'promo'   => $treatment_promo,
            'newin'   => $treatment_new,
            'menu'    => $menu,
            'submenu' => $submenu
        );
        $this->load->view('frontend/layout/app', $data);
    }

    function detail() {
        $url = $this->uri->segment(2);
        $detail_product = $this->app_model->get_data_query("SELECT a.*, b.product_category_name, b.product_category_url  FROM product a LEFT JOIN product_category b ON b.product_category_id = a.product_category_id WHERE a.product_url = '".$url."' ")->row();
        $menu = $this->app_model->get_data_query("SELECT * FROM product_category WHERE product_category_parent = 0 AND product_category_status = 'active'")->result();
        $submenu = $this->app_model->get_data_query("SELECT product_id, product_category_id, product_name, product_url FROM product WHERE product_status = 'active'")->result();
        $data = array(
            'content' => 'frontend/detail',
            'menu'    => $menu,
            'submenu' => $submenu,
            'product' => $detail_product
        );
        $this->load->view('frontend/layout/app', $data);
    }

    function pages() {
        $url = $this->uri->segment(2);
        $row_id = $this->app_model->get_data_query("SELECT * FROM product_category WHERE product_category_url = '".$url."' ")->row();
        $list_product = $this->app_model->get_data_query("SELECT * FROM product WHERE product_category_id = '".$row_id->product_category_id."' ")->result();
        $menu = $this->app_model->get_data_query("SELECT * FROM product_category WHERE product_category_parent = 0 AND product_category_status = 'active'")->result();
        $submenu = $this->app_model->get_data_query("SELECT product_id, product_category_id, product_name, product_url FROM product WHERE product_status = 'active'")->result();
        $data = array(
            'content' => 'frontend/pages',
            'menu'    => $menu,
            'submenu' => $submenu,
            'product' => $list_product
        );
        $this->load->view('frontend/layout/app', $data);
    }
    
}
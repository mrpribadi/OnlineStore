<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
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

    function detail()
    {
        $url = $this->uri->segment(2);
        $detail_product = $this->app_model->get_data_query("SELECT a.*, b.product_category_name, b.product_category_url  FROM product a LEFT JOIN product_category b ON b.product_category_id = a.product_category_id WHERE a.product_url = '" . $url . "' ")->row();
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

    function pages()
    {
        $url = $this->uri->segment(2);
        $row_id = $this->app_model->get_data_query("SELECT * FROM product_category WHERE product_category_url = '" . $url . "' ")->row();
        $list_product = $this->app_model->get_data_query("SELECT * FROM product WHERE product_category_id = '" . $row_id->product_category_id . "' ")->result();
        $menu = $this->app_model->get_data_query("SELECT * FROM product_category WHERE product_category_parent = 0 AND product_category_status = 'active'")->result();
        $submenu = $this->app_model->get_data_query("SELECT product_id, product_category_id, product_name, product_url FROM product WHERE product_status = 'active'")->result();

        if ($url == 'about') {
            $data = array(
                'content' => 'frontend/about',
                'menu'    => $menu,
                'submenu' => $submenu
            );
        } else if ($url == 'outlet') {
            $this->load->library('googlemaps');
            $config = array();
            $config['center'] = "-6.2449033, 106.9658942";
            $config['zoom'] = 16;
            $config['map_height'] = "400px";
            $this->googlemaps->initialize($config);

            $marker = array();
            $marker['position'] = "-6.242900, 106.965417";
            $marker['infowindow_content'] = "xxxdahdasdhska";
            $this->googlemaps->add_marker($marker);
            $data = array(
                'content' => 'frontend/outlet',
                'menu'    => $menu,
                'submenu' => $submenu,
                'map'     => $this->googlemaps->create_map()
            );
        } else if ($url == 'payment') {
            $payment = $this->app_model->get_data_all('payment', 'payment_bank_name', 'ASC')->result();
            $data = array(
                'content' => 'frontend/payment',
                'menu'    => $menu,
                'submenu' => $submenu,
                'payment' => $payment
            );
        } else if ($url == 'confirm') {
            $data = array(
                'content' => 'frontend/confirm',
                'menu'    => $menu,
                'submenu' => $submenu
            );
        } else {
            $data = array(
                'content' => 'frontend/pages',
                'menu'    => $menu,
                'submenu' => $submenu,
                'product' => $list_product
            );
        }

        $this->load->view('frontend/layout/app', $data);
    }

    function order()
    {
        $url = $this->uri->segment(2);
        $menu = $this->app_model->get_data_query("SELECT * FROM product_category WHERE product_category_parent = 0 AND product_category_status = 'active'")->result();
        $submenu = $this->app_model->get_data_query("SELECT product_id, product_category_id, product_name, product_url FROM product WHERE product_status = 'active'")->result();
        $detail_product = $this->app_model->get_data_query("SELECT a.*, b.product_category_name, b.product_category_url  FROM product a LEFT JOIN product_category b ON b.product_category_id = a.product_category_id WHERE a.product_url = '" . $url . "' ")->row();
        $payment = $this->app_model->get_data_query("SELECT * FROM payment_type WHERE payment_type_status = 'active' ")->result();
        $data = array(
            'content' => 'frontend/order',
            'menu'    => $menu,
            'submenu' => $submenu,
            'produk'  => $detail_product,
            'payment' => $payment
        );

        $this->load->view('frontend/layout/app', $data);
    }
}

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
        $menu = $this->app_model->get_data_query("SELECT * FROM product_category WHERE product_category_parent = 0 AND product_category_status = 'active'")->result();
        $submenu = $this->app_model->get_data_query("SELECT product_id, product_category_id, product_name, product_url FROM product WHERE product_status = 'active'")->result();

        switch ($url) {
            case 'treatment':
                $row_id = $this->app_model->get_data_query("SELECT * FROM product_category WHERE product_category_url = '" . $url . "' ")->row();
                $list_product = $this->app_model->get_data_query("SELECT * FROM product WHERE product_category_id = '" . $row_id->product_category_id . "' ")->result();
                $data = array(
                    'content' => 'frontend/pages',
                    'menu'    => $menu,
                    'submenu' => $submenu,
                    'product' => $list_product
                );
                break;
            case 'produk':
                $row_id = $this->app_model->get_data_query("SELECT * FROM product_category WHERE product_category_url = '" . $url . "' ")->row();
                $list_product = $this->app_model->get_data_query("SELECT * FROM product WHERE product_category_id = '" . $row_id->product_category_id . "' ")->result();
                $data = array(
                    'content' => 'frontend/pages_produk',
                    'menu'    => $menu,
                    'submenu' => $submenu,
                    'product' => $list_product
                );
                break;
            case 'promo':
                $row_id = $this->app_model->get_data_query("SELECT * FROM product_category WHERE product_category_url = '" . $url . "' ")->row();
                $list_product = $this->app_model->get_data_query("SELECT * FROM product WHERE product_promo_list = 1 ORDER BY product_promo_list_date DESC")->result();
                $data = array(
                    'content' => 'frontend/pages',
                    'menu'    => $menu,
                    'submenu' => $submenu,
                    'product' => $list_product
                );
                break;
            case 'about':
                $dokter = $this->app_model->get_data_query("SELECT * FROM user_admin WHERE admin_level = 'dokter' AND admin_status = 'active' ")->result();
                $beauty = $this->app_model->get_data_query("SELECT * FROM user_admin WHERE admin_level = 'beautician' AND admin_status = 'active' ")->result();
                $kasir = $this->app_model->get_data_query("SELECT * FROM user_admin WHERE admin_level = 'kasir' AND admin_status = 'active' ")->result();
                $data = array(
                    'content' => 'frontend/about',
                    'menu'    => $menu,
                    'submenu' => $submenu,
                    'dokter'  => $dokter,
                    'beauty'  => $beauty,
                    'kasir'   => $kasir
                );
                break;
            case 'outlet':
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
                break;
            case 'payment':
                $payment = $this->app_model->get_data_all('payment', 'payment_bank_name', 'ASC')->result();
                $data = array(
                    'content' => 'frontend/payment',
                    'menu'    => $menu,
                    'submenu' => $submenu,
                    'payment' => $payment
                );
                break;
            case 'confirm':
                $data = array(
                    'content' => 'frontend/confirm',
                    'menu'    => $menu,
                    'submenu' => $submenu
                );
                break;

            default:
                $data = array(
                    'content' => 'frontend/home',
                    'menu'    => $menu,
                    'submenu' => $submenu,
                    'product' => $list_product
                );
                break;
        }
        // if ($url == 'about') {
        //     $data = array(
        //         'content' => 'frontend/about',
        //         'menu'    => $menu,
        //         'submenu' => $submenu
        //     );
        // } else if ($url == 'outlet') {
        //     $this->load->library('googlemaps');
        //     $config = array();
        //     $config['center'] = "-6.2449033, 106.9658942";
        //     $config['zoom'] = 16;
        //     $config['map_height'] = "400px";
        //     $this->googlemaps->initialize($config);

        //     $marker = array();
        //     $marker['position'] = "-6.242900, 106.965417";
        //     $marker['infowindow_content'] = "xxxdahdasdhska";
        //     $this->googlemaps->add_marker($marker);
        //     $data = array(
        //         'content' => 'frontend/outlet',
        //         'menu'    => $menu,
        //         'submenu' => $submenu,
        //         'map'     => $this->googlemaps->create_map()
        //     );
        // } else if ($url == 'payment') {
        //     $payment = $this->app_model->get_data_all('payment', 'payment_bank_name', 'ASC')->result();
        //     $data = array(
        //         'content' => 'frontend/payment',
        //         'menu'    => $menu,
        //         'submenu' => $submenu,
        //         'payment' => $payment
        //     );
        // } else if ($url == 'confirm') {
        //     $data = array(
        //         'content' => 'frontend/confirm',
        //         'menu'    => $menu,
        //         'submenu' => $submenu
        //     );
        // } else {
        //     $row_id = $this->app_model->get_data_query("SELECT * FROM product_category WHERE product_category_url = '" . $url . "' ")->row();
        //     $list_product = $this->app_model->get_data_query("SELECT * FROM product WHERE product_category_id = '" . $row_id->product_category_id . "' ")->result();
        //     $data = array(
        //         'content' => 'frontend/pages',
        //         'menu'    => $menu,
        //         'submenu' => $submenu,
        //         'product' => $list_product
        //     );
        // }

        $this->load->view('frontend/layout/app', $data);
    }

    function order()
    {
        if ($this->session->userdata('id') == '') {
            redirect('home/login');
        }
        $url = $this->uri->segment(3);
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

    function member()
    {
        if ($this->session->userdata('id') == '') {
            redirect('home');
        }
        $id = $this->session->userdata('id');
        $menu = $this->app_model->get_data_query("SELECT * FROM product_category WHERE product_category_parent = 0 AND product_category_status = 'active'")->result();
        $submenu = $this->app_model->get_data_query("SELECT product_id, product_category_id, product_name, product_url FROM product WHERE product_status = 'active'")->result();
        $data_history = $this->app_model->get_data_query("SELECT a.*, c.product_name FROM order_header AS a
                                                            INNER JOIN customer AS b ON b.customer_id = a.customer_id
                                                            INNER JOIN product AS c ON c.product_id = a.product_id
                                                            WHERE a.customer_id = '" . $id . "'")->result();
        $data = array(
            'content' => 'frontend/history',
            'menu'    => $menu,
            'submenu' => $submenu,
            'history' => $data_history
        );
        $this->load->view('frontend/layout/app', $data);
    }

    function confirm()
    {
        if ($this->session->userdata('id') == '') {
            redirect('home');
        }
        $id = $this->uri->segment(3);
        $menu = $this->app_model->get_data_query("SELECT * FROM product_category WHERE product_category_parent = 0 AND product_category_status = 'active'")->result();
        $submenu = $this->app_model->get_data_query("SELECT product_id, product_category_id, product_name, product_url FROM product WHERE product_status = 'active'")->result();
        $where = array('order_id' => $id);
        $order = $this->app_model->get_data('order_header', $where, 'order_id', 'ASC')->row();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('bank_name', 'Bank name', 'trim|required');
        $this->form_validation->set_rules('bank_account_no', 'Bank account', 'trim|required');
        $this->form_validation->set_rules('bank_account_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'content' => 'frontend/confirm',
                'menu'    => $menu,
                'submenu' => $submenu,
                'order'   => $order
            );
        } else {
            $bank_name = $this->input->post('bank_name');
            $bank_account_no = $this->input->post('bank_account_no');
            $bank_account_name = $this->input->post('bank_account_name');
            $amount = $this->input->post('amount');
            $notes = $this->input->post('notes');
            $order_id = $this->input->post('idorder');
            $files = $_FILES;
            if ($files['foto']['error'] == '0') {
                $img_name = $order_id . "_" . $files['foto']['name'];
                move_uploaded_file($files['foto']['tmp_name'], realpath('assets/images') . '/' . $img_name);
                $where = array('order_id' => $order_id);
                $data_update = array(
                    'confirmation_status' => '1',
                    'confirmation_date' => date("Y-m-d H:i:s"),
                    'confirmation_notes' => $notes,
                    'confirmation_bank_from' => $bank_name,
                    'confirmation_bank_from_account_no' => $bank_account_no,
                    'confirmation_bank_from_account_name' => $bank_account_name,
                    'confirmation_bank_from_amount' => $amount,
                    'confirmation_bank_from_image' => $img_name

                );
                $do_confirm = $this->app_model->update_data('order_header', $data_update, $where);
                if ($do_confirm) {
                    redirect('home/member');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Konfirmasi gagal</div>');
                }
            }
        }
        $this->load->view('frontend/layout/app', $data);
    }

    function login()
    {
        if ($this->session->userdata('id') != '') {
            redirect('home');
        }
        $menu = $this->app_model->get_data_query("SELECT * FROM product_category WHERE product_category_parent = 0 AND product_category_status = 'active'")->result();
        $submenu = $this->app_model->get_data_query("SELECT product_id, product_category_id, product_name, product_url FROM product WHERE product_status = 'active'")->result();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'content' => 'frontend/login',
                'menu'    => $menu,
                'submenu' => $submenu
            );
        } else {
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));
            $key = array('customer_email' => $email, 'customer_status' => 'active');

            $customer = $this->app_model->get_data('customer', $key, 'customer_email', 'ASC');
            if ($customer->num_rows() != '') {
                $cust = $customer->row();
                if ($password == $cust->customer_password) {
                    $data_session = array(
                        'id' => $cust->customer_id,
                        'code' => $cust->customer_code,
                        'email' => $cust->customer_email,
                        'nama' => $cust->customer_nama,
                        'telp' => $cust->customer_phone,
                    );
                    $this->session->set_userdata($data_session);
                    redirect('home');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Password salah</div>');
                    redirect('home/login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Email belum terdaftar</div>');
                redirect('home/login');
            }
        }


        $this->load->view('frontend/layout/app', $data);
    }

    function register()
    {
        if ($this->session->userdata('id') != '') {
            redirect('home');
        }
        $menu = $this->app_model->get_data_query("SELECT * FROM product_category WHERE product_category_parent = 0 AND product_category_status = 'active'")->result();
        $submenu = $this->app_model->get_data_query("SELECT product_id, product_category_id, product_name, product_url FROM product WHERE product_status = 'active'")->result();
        $data = array(
            'content' => 'frontend/register',
            'menu'    => $menu,
            'submenu' => $submenu
        );

        $this->load->view('frontend/layout/app', $data);
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('home'));
    }
}

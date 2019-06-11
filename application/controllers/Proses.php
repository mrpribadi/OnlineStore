<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proses extends CI_Controller
{
    function __construct() {
        parent::__construct();
    }

    function index(){

    }

    function post() {
        $fullname = $this->input->post('fullname');
        $gender = $this->input->post('gender');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $date = $this->input->post('date');
        $time = $this->input->post('time');
        $notes = $this->session->userdata('notes');
        $payment = $this->input->post('payment');
        $product_id = $this->input->post('product_id');


        $get_email_exist = $this->app_model->get_data_query("SELECT customer_email FROM customer WHERE customer_email = '".$email."'");
        if ($get_email_exist->num_rows() < 1) {
            // NEW CODE
            $get_last_id = "SELECT MAX(customer_code) AS last_code FROM customer";
            $query_last = $this->app_model->get_data_query($get_last_id)->row();
            if ($query_last->last_code == "") {
                $new_code = "CUST00001";
            } else {
                $nourut   = substr($query_last->last_code, 4, 9);
                $inc      = (int) $nourut;
                $inc      = $inc + 1;
                $new_code = "CUST".sprintf("%05s", $inc); 
            }

            // GET IP ADDRESS
            if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
            {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
            {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            else
            {
                $ip = $_SERVER['REMOTE_ADDR'];
            }

            $data_insert = array(
                'customer_nama'             => $fullname,
                'customer_email'            => $email,
                'customer_phone'            => $phone,
                'customer_gender'           => $gender,
                'customer_status'           => 'active',
                'customer_password'         => md5("abc123"),
                'customer_code'             => $new_code,
                'customer_ip_address'       => $ip,
                'customer_registration_date'=> date('Y-m-d H:i:s')
            );
            $save = $this->app_model->insert_data('customer', $data_insert);

            if ($save) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo json_encode(array('status' => 'failed', 'message' => 'Gagal simpan data..!'));
            }
        }
        else {
            echo "EMAIL SUDAH TERDAFTAR";
        }
        
    }
    
}

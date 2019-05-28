<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller
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
        $query = "SELECT *
                  FROM customer  
                  ORDER BY customer_id";
        $data_customer = $this->app_model->get_data_query($query)->result();
        $data = array(
            'content'   => 'backend/customer/index',
            'customer'  => $data_customer
        );
        $this->load->view('backend/layout/app', $data);
    }

    function detail() {
        $data = array(
            'content'   => 'backend/customer/detail'
        );
        $this->load->view('backend/layout/app', $data);
    }

    function create() {
        $data = array(
            'content'       => 'backend/customer/create'
        );
        $this->load->view('backend/layout/app', $data);
    }

    function edit() {
        $id = $this->uri->segment(3);
        $key = array('customer_id' => $id);
        $data_row    = $this->app_model->get_data("customer", $key, "customer_id", "ASC")->row();
        $data = array(
            'content'       => 'backend/customer/edit',
            'row'           => $data_row
        );
        $this->load->view('backend/layout/app', $data);
    }

    function delete($id) {
        // $id = $this->uri->segment(3);
        $key = array('customer_id' => $id);

        $delete = $this->app_model->delete_data("customer", $key);
        if ($delete) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'failed'));
        }
        
    }

    function post() {
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $gender = $this->input->post('gender');
        $password = md5($this->input->post('password'));
        $id = $this->input->post('id');
        //$user = $this->session->userdata('id');
        $status = $this->input->post('status');

        if ($id == "") {
            $get_email_exist = $this->app_model->get_data_query("SELECT customer_email FROM customer WHERE customer_email = '".$email."'");
            if ($get_email_exist->num_rows() > 0) {
                echo json_encode(array('status' => 'failed', 'message' => 'Email sudah terdaftar..!'));
            }
            else 
            {
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
                    'customer_nama'             => $nama,
                    'customer_email'            => $email,
                    'customer_phone'            => $phone,
                    'customer_gender'           => $gender,
                    'customer_status'           => $status,
                    'customer_password'         => $password,
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
        
        } else {
            $key = array('customer_id' => $id);
            if ($password == '') {
                $data_update = array(
                    'customer_nama'             => $nama,
                    'customer_phone'            => $phone,
                    'customer_gender'           => $gender,
                    'customer_status'           => $status,
                );
            } else {
                $data_update = array(
                    'customer_nama'             => $nama,
                    'customer_phone'            => $phone,
                    'customer_gender'           => $gender,
                    'customer_status'           => $status,
                    'customer_password'         => $password,
                );
            }
            
            
            $update = $this->app_model->update_data('customer', $data_update, $key);

            if ($update) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo json_encode(array('status' => 'failed', 'message' => 'Gagal edit data..!'));
            }
        }
    }
    
}
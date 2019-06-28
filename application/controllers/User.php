<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $s_userid   = $this->session->userdata('id');
        if (empty($s_userid)) {
            echo '<script>
					alert("You dont have Login Session, please login first.");
					window.location.href="' . base_url() . 'auth";
				 </script>';
        }
    }

    function index()
    {
        $query = "SELECT * 
                  FROM user_admin  
                  ORDER BY admin_email";
        $data_user = $this->app_model->get_data_query($query)->result();
        $data = array(
            'content'   => 'backend/user/index',
            'user'      => $data_user
        );
        $this->load->view('backend/layout/app', $data);
    }

    function detail()
    {
        $data = array(
            'content'   => 'backend/user/detail'
        );
        $this->load->view('backend/layout/app', $data);
    }

    function create()
    {
        $data = array(
            'content'   => 'backend/user/create',
        );
        $this->load->view('backend/layout/app', $data);
    }

    function edit()
    {
        $id = $this->uri->segment(3);
        $key = array('admin_id' => $id);
        $data_row    = $this->app_model->get_data("user_admin", $key, "admin_id", "ASC")->row();
        $data = array(
            'content'       => 'backend/user/edit',
            'row'           => $data_row
        );
        $this->load->view('backend/layout/app', $data);
    }

    function delete()
    {
        $id = $this->input->post('id');
        $key = array('admin_id' => $id);

        $delete = $this->app_model->delete_data("user_admin", $key);
        if ($delete) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'failed'));
        }
    }

    function post()
    {
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $level = $this->input->post('level');
        $password = md5($this->input->post('password'));
        $id = $this->input->post('id');
        $user = $this->session->userdata('id');
        $status = $this->input->post('status');

        if ($id == "") {
            $get_email_exist = $this->app_model->get_data_query("SELECT admin_email FROM user_admin WHERE admin_email = '" . $email . "'");
            if ($get_email_exist->num_rows() > 0) {
                echo json_encode(array('status' => 'failed', 'message' => 'Email sudah terdaftar..!'));
            } else {
                $data_insert = array(
                    'admin_full_name'   => $nama,
                    'admin_email'       => $email,
                    'admin_level'       => $level,
                    'create_by'         => $user,
                    'create_date'       => date('Y-m-d H:i:s'),
                    'admin_status'      => $status,
                    'admin_password'    => $password
                );
                $save = $this->app_model->insert_data('user_admin', $data_insert);

                if ($save) {
                    echo json_encode(array('status' => 'success'));
                } else {
                    echo json_encode(array('status' => 'failed', 'message' => 'Gagal simpan data..!'));
                }
            }
        } else {
            $key = array('admin_id' => $id);
            if ($password == '') {
                $data_update = array(
                    'admin_full_name'   => $nama,
                    'admin_email'       => $email,
                    'admin_level'       => $level,
                    'update_by'         => $user,
                    'update_date'       => date('Y-m-d H:i:s'),
                    'admin_status'      => $status
                );
            } else {
                $data_update = array(
                    'admin_full_name'   => $nama,
                    'admin_email'       => $email,
                    'admin_level'       => $level,
                    'update_by'         => $user,
                    'update_date'       => date('Y-m-d H:i:s'),
                    'admin_status'      => $status,
                    'admin_password'    => $password
                );
            }

            $update = $this->app_model->update_data('user_admin', $data_update, $key);

            if ($update) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo json_encode(array('status' => 'failed', 'message' => 'Gagal edit data..!'));
            }
        }
    }
}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_COntroller
{

    function __construct(){
        parent::__construct();
    }

    function index(){
        $this->load->view('backend/login');
    }

    function login(){
        $uname = trim($this->input->post('uid'));
        $passw = md5(trim($this->input->post('passw')));

        $query = "SELECT * FROM user_admin WHERE admin_email = '".$uname."' AND admin_status = 'active' ";

        $login = $this->app_model->get_data_query($query);
        if ($login->num_rows() > 0) {
            $user = $this->app_model->get_data_query($query)->row();

            if ($passw == $user->admin_password){
                
                $data_session = array(
                    'id'        => $user->admin_id,
                    'email'     => $user->admin_email,
                    'fullname'  => $user->admin_full_name,
                    'level'     => $user->admin_level,
                    'status'    => 'success'
                );
    
                // $data_session = array(
                //     'id' => $customer->id,
                //     'nama_customer' => $customer->nama_customer,
                //     'alamat' => $customer->alamat,
                //     'telp' => $customer->telp,
                //     'email' => $customer->email,
                //     'initial' => $customer->initial,
                //     'status' => 'success'
                // );
    
                $this->session->set_userdata($data_session);
                echo json_encode($data_session);
                //redirect(base_url('home'));
            }
            else {
                $data_session = array(
                    'status' => 'failed',
                    'msg' => 'Password Salah'
                );

                echo json_encode($data_session);
            }
        }
        else {
            $data_session = array(
                'status' => 'failed',
                'msg' => 'Username Salah'
            );

            echo json_encode($data_session);
        }
    }

    function logout(){
        $this->session->sess_destroy();
        redirect(base_url('auth'));
    }
    
}

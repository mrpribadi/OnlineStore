<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends CI_Controller
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
        $query = "SELECT a.*, b.payment_type_nama 
                  FROM payment_method a 
                  LEFT JOIN payment_type b ON b.payment_type_id = a.payment_type_id 
                  WHERE a.payment_type_id = '1' 
                  ORDER BY a.payment_bank_name";
        $data_bank = $this->app_model->get_data_query($query)->result();
        $data = array(
            'content'   => 'backend/bank/index',
            'bank'      => $data_bank
        );
        $this->load->view('backend/layout/app', $data);
    }

    function detail() {
        $data = array(
            'content'   => 'backend/bank/detail'
        );
        $this->load->view('backend/layout/app', $data);
    }

    function create() {
        $query = "SELECT payment_type_id, payment_type_nama FROM payment_type
                  WHERE payment_type_status ='active'";
        $data_type = $this->app_model->get_data_query($query)->result();
        $data = array(
            'content'       => 'backend/bank/create',
            'payment_type'  => $data_type
        );
        $this->load->view('backend/layout/app', $data);
    }

    function edit() {
        $id = $this->uri->segment(3);
        $key = array('payment_method_id' => $id);
        $query = "SELECT payment_type_id, payment_type_nama FROM payment_type
                  WHERE payment_type_status ='active'";
        $data_type = $this->app_model->get_data_query($query)->result();
        $data_row    = $this->app_model->get_data("payment_method", $key, "payment_method_id", "ASC")->row();
        $data = array(
            'content'       => 'backend/bank/edit',
            'payment_type'  => $data_type,
            'row'           => $data_row
        );
        $this->load->view('backend/layout/app', $data);
    }

    function delete($id) {
        // $id = $this->uri->segment(3);
        $key = array('payment_method_id' => $id);

        $delete = $this->app_model->delete_data("payment_method", $key);
        if ($delete) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'failed'));
        }
        
    }

    function post() {
        $nama_bank = $this->input->post('nama_bank');
        $norek = $this->input->post('rek');
        $pemilik = $this->input->post('pemilik');
        $tipe = $this->input->post('tipe');
        $id = $this->input->post('id');
        $user = $this->session->userdata('id');
        $status = $this->input->post('status');

        if ($id == "") {
            $get_rek_exist = $this->app_model->get_data_query("SELECT payment_bank_account_no FROM payment_method WHERE payment_bank_account_no = '".$norek."'");
            if ($get_rek_exist->num_rows() > 0) {
                echo json_encode(array('status' => 'failed', 'message' => 'Nomor rekening sudah terdaftar..!'));
            }
            else 
            {
                $data_insert = array(
                    'payment_bank_name'         => $nama_bank,
                    'payment_bank_account_no'   => $norek,
                    'payment_bank_account_name' => $pemilik,
                    'create_by'                 => $user,
                    'create_date'               => date('Y-m-d H:i:s'),
                    'payment_method_status'     => $status,
                    'payment_type_id'           => $tipe
                );
                $save = $this->app_model->insert_data('payment_method', $data_insert);
    
                if ($save) {
                    echo json_encode(array('status' => 'success'));
                } else {
                    echo json_encode(array('status' => 'failed', 'message' => 'Gagal simpan data..!'));
                }
            }
        
        } else {
            $key = array('payment_method_id' => $id);
            $data_update = array(
                'payment_bank_name'         => $nama_bank,
                'payment_bank_account_no'   => $norek,
                'payment_bank_account_name' => $pemilik,
                'update_by'                 => $user,
                'update_date'               => date('Y-m-d H:i:s'),
                'payment_method_status'     => $status,
                'payment_type_id'           => $tipe
            );
            $update = $this->app_model->update_data('payment_method', $data_update, $key);

            if ($update) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo json_encode(array('status' => 'failed', 'message' => 'Gagal edit data..!'));
            }
        }
    }
    
}
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bank extends CI_Controller
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
        $query = "SELECT * FROM bank ";
        $data_bank = $this->app_model->get_data_query($query)->result();
        $data = array(
            'content'   => 'backend/bank/index',
            'bank'      => $data_bank
        );
        $this->load->view('backend/layout/app', $data);
    }

    function detail()
    {
        $data = array(
            'content'   => 'backend/bank/detail'
        );
        $this->load->view('backend/layout/app', $data);
    }

    function create()
    {
        $data = array(
            'content'       => 'backend/bank/create'
        );
        $this->load->view('backend/layout/app', $data);
    }

    function edit()
    {
        $id = $this->uri->segment(3);
        $key = array('bank_id' => $id);
        $data_row    = $this->app_model->get_data("bank", $key, "bank_id", "ASC")->row();
        $data = array(
            'content'       => 'backend/bank/edit',
            'row'           => $data_row
        );
        $this->load->view('backend/layout/app', $data);
    }

    function delete()
    {
        $id = $this->input->post('id');
        $key = array('bank_id' => $id);

        $delete = $this->app_model->delete_data("bank", $key);
        if ($delete) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'failed'));
        }
    }

    function post()
    {
        $nama_bank = $this->input->post('nama_bank');
        $norek = $this->input->post('rek');
        $pemilik = $this->input->post('pemilik');
        $id = $this->input->post('id');

        if ($id == "") {
            $get_rek_exist = $this->app_model->get_data_query("SELECT bank_nomor_rekening FROM bank WHERE bank_nomor_rekening = '" . $norek . "'");
            if ($get_rek_exist->num_rows() > 0) {
                echo json_encode(array('status' => 'failed', 'message' => 'Nomor rekening sudah terdaftar..!'));
            } else {
                $data_insert = array(
                    'bank_nama'         => $nama_bank,
                    'bank_nomor_rekening'   => $norek,
                    'bank_nama_rekening' => $pemilik
                );
                $save = $this->app_model->insert_data('bank', $data_insert);

                if ($save) {
                    echo json_encode(array('status' => 'success'));
                } else {
                    echo json_encode(array('status' => 'failed', 'message' => 'Gagal simpan data..!'));
                }
            }
        } else {
            $key = array('bank_id' => $id);
            $data_update = array(
                'bank_nama'         => $nama_bank,
                'bank_nomor_rekening'   => $norek,
                'bank_nama_rekening' => $pemilik
            );
            $update = $this->app_model->update_data('bank', $data_update, $key);

            if ($update) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo json_encode(array('status' => 'failed', 'message' => 'Gagal edit data..!'));
            }
        }
    }
}

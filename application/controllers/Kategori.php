<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
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
        $query = "SELECT * FROM kategori ";
        $data_kategory = $this->app_model->get_data_query($query)->result();
        $data = array(
            'content'   => 'backend/kategori/index',
            'kategori'  => $data_kategory
        );
        $this->load->view('backend/layout/app', $data);
    }

    function detail()
    {
        $data = array(
            'content'   => 'backend/kategori/detail'
        );
        $this->load->view('backend/layout/app', $data);
    }

    function create()
    {
        $data = array(
            'content'   => 'backend/kategori/create'
        );
        $this->load->view('backend/layout/app', $data);
    }

    function edit()
    {
        $id = $this->uri->segment(3);
        $key = array('kategori_id' => $id);
        $data_row    = $this->app_model->get_data("kategori", $key, "kategori_id", "ASC")->row();
        $data = array(
            'content'   => 'backend/kategori/edit',
            'row'       => $data_row
        );
        $this->load->view('backend/layout/app', $data);
    }

    function delete()
    {
        $id = $this->input->post('id');
        $key = array('kategori_id' => $id);

        $delete = $this->app_model->delete_data("kategori", $key);
        if ($delete) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'failed'));
        }
    }

    function post()
    {
        $nama = $this->input->post('nama');
        $id = $this->input->post('id');

        if ($id == "") {
            $get_url_exist = $this->app_model->get_data_query("SELECT kategori_nama FROM kategori WHERE kategori_nama = '" . $nama . "'");
            if ($get_url_exist->num_rows() > 0) {
                echo json_encode(array('status' => 'failed', 'message' => 'Nama kategori sudah ada..!'));
            } else {
                $data_insert = array(
                    'kategori_nama'     => $nama
                );
                $save = $this->app_model->insert_data('kategori', $data_insert);

                if ($save) {
                    echo json_encode(array('status' => 'success'));
                } else {
                    echo json_encode(array('status' => 'failed', 'message' => 'Gagal simpan data..!'));
                }
            }
        } else {
            $key = array('kategori_id' => $id);
            $data_update = array(
                'kategori_nama'     => $nama
            );
            $update = $this->app_model->update_data('kategori', $data_update, $key);

            if ($update) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo json_encode(array('status' => 'failed', 'message' => 'Gagal edit data..!'));
            }
        }
    }
}

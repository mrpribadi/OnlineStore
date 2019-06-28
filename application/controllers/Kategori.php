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
        $query = "SELECT a.*, b.product_category_name AS parent_name FROM product_category AS a 
                  LEFT JOIN product_category AS b ON b.product_category_id = a.product_category_parent ";
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
        $query = "SELECT product_category_id, product_category_name FROM product_category
                  WHERE product_category_status ='active'";
        $data_parent = $this->app_model->get_data_query($query)->result();
        $data = array(
            'content'   => 'backend/kategori/create',
            'parent'    => $data_parent
        );
        $this->load->view('backend/layout/app', $data);
    }

    function edit()
    {
        $id = $this->uri->segment(3);
        $key = array('product_category_id' => $id);
        $query = "SELECT product_category_id, product_category_name FROM product_category
                  WHERE product_category_status ='active'";
        $data_parent = $this->app_model->get_data_query($query)->result();
        $data_row    = $this->app_model->get_data("product_category", $key, "product_category_id", "ASC")->row();
        $data = array(
            'content'   => 'backend/kategori/edit',
            'parent'    => $data_parent,
            'row'       => $data_row
        );
        $this->load->view('backend/layout/app', $data);
    }

    function delete()
    {
        $id = $this->input->post('id');
        $key = array('product_category_id' => $id);

        $delete = $this->app_model->delete_data("product_category", $key);
        if ($delete) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'failed'));
        }
    }

    function post()
    {
        $nama = $this->input->post('nama');
        $parent = $this->input->post('parent');
        $url = $this->input->post('url');
        $id = $this->input->post('id');
        $user = $this->session->userdata('id');
        $status = $this->input->post('status');

        if ($id == "") {
            $get_url_exist = $this->app_model->get_data_query("SELECT product_category_url FROM product_category WHERE product_category_url = '" . $url . "'");
            if ($get_url_exist->num_rows() > 0) {
                echo json_encode(array('status' => 'failed', 'message' => 'Nama kategori sudah ada..!'));
            } else {
                $data_insert = array(
                    'product_category_name'     => $nama,
                    'product_category_url'      => $url,
                    'product_category_parent'   => $parent,
                    'create_by'                 => $user,
                    'create_date'               => date('Y-m-d H:i:s'),
                    'product_category_status'   => $status
                );
                $save = $this->app_model->insert_data('product_category', $data_insert);

                if ($save) {
                    echo json_encode(array('status' => 'success'));
                } else {
                    echo json_encode(array('status' => 'failed', 'message' => 'Gagal simpan data..!'));
                }
            }
        } else {
            $key = array('product_category_id' => $id);
            $data_update = array(
                'product_category_name'     => $nama,
                'product_category_url'      => $url,
                'product_category_parent'   => $parent,
                'update_by'                 => $user,
                'update_date'               => date('Y-m-d H:i:s'),
                'product_category_status'   => $status
            );
            $update = $this->app_model->update_data('product_category', $data_update, $key);

            if ($update) {
                echo json_encode(array('status' => 'success'));
            } else {
                echo json_encode(array('status' => 'failed', 'message' => 'Gagal edit data..!'));
            }
        }
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    function __construct() {
        parent::__construct();
    }

    function index() {
        $query = "SELECT a.*, b.product_category_nama AS parent_name FROM product_category AS a 
                  LEFT JOIN product_category AS b ON b.product_category_id = a.product_category_parent 
                  WHERE a.product_category_status ='active'";
        $data_kategory = $this->app_model->get_data_query($query)->result();
        $data = array(
            'content'   => 'backend/kategori/index',
            'kategori'  => $data_kategory
        );
        $this->load->view('backend/layout/app', $data);
    }

    function detail() {
        $data = array(
            'content'   => 'backend/kategori/detail'
        );
        $this->load->view('backend/layout/app', $data);
    }

    function create() {
        $query = "SELECT product_category_id, product_category_nama FROM product_category
                  WHERE product_category_status ='active'";
        $data_parent = $this->app_model->get_data_query($query)->result();
        $data = array(
            'content'   => 'backend/kategori/create',
            'parent'    => $data_parent
        );
        $this->load->view('backend/layout/app', $data);
    }

    function edit() {
        $data = array(
            'content'   => 'backend/kategori/edit'
        );
        $this->load->view('backend/layout/app', $data);
    }

    function delete() {

    }

    function post() {
        $nama = $this->input->post('nama');
        $parent = $this->input->post('parent');
        $url = $this->input->post('url');
        $id = $this->input->post('id');
        $user = $this->session->userdata('id');
        $status = 'active';

        // $data_insert = array(
        //     'product_category_nama'     => $nama,
        //     'product_category_url'      => $url,
        //     'product_category_parent'   => $parent,
        //     'create_by'                 => $user,
        //     'create_date'               => date('Y-m-d H:i:s'),
        //     'product_category_status'   => $status
        // );
        
        // echo json_encode(array('status' => 'failed', 'message' => $nama));

        if ($id == "") {
            $data_insert = array(
                'product_category_nama'     => $nama,
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
            
        } else {
            $key = array('product_category_id' => $id);
            $data_update = array(
                'product_category_nama'     => $nama,
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
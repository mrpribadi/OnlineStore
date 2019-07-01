<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item extends CI_Controller
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
        $query = "SELECT a.*, b.product_category_name FROM product AS a
                  LEFT JOIN product_category AS b ON b.product_category_id = a.product_category_id ";
        $data_item = $this->app_model->get_data_query($query)->result();
        $data = array(
            'content'   => 'backend/item/index',
            'item'      => $data_item
        );
        $this->load->view('backend/layout/app', $data);
    }

    function detail()
    {
        $id = $this->uri->segment(3);
        $key = array('product_id' => $id);
        $data_row    = $this->app_model->get_data("product", $key, "product_id", "ASC")->row();
        $data = array(
            'content'   => 'backend/item/detail',
            'row'       => $data_row
        );
        $this->load->view('backend/layout/app', $data);
    }

    function create()
    {
        $query = "SELECT product_category_id, product_category_name FROM product_category
                  WHERE product_category_status ='active'";
        $data_parent = $this->app_model->get_data_query($query)->result();
        $data = array(
            'content'   => 'backend/item/create',
            'parent'    => $data_parent
        );
        $this->load->view('backend/layout/app', $data);
    }

    function edit()
    {
        $id = $this->uri->segment(3);
        $key = array('product_id' => $id);
        $query = "SELECT product_category_id, product_category_name FROM product_category
                  WHERE product_category_status ='active'";
        $data_parent = $this->app_model->get_data_query($query)->result();
        $data_row    = $this->app_model->get_data("product", $key, "product_id", "ASC")->row();
        $data = array(
            'content'   => 'backend/item/edit',
            'parent'    => $data_parent,
            'row'       => $data_row
        );
        $this->load->view('backend/layout/app', $data);
    }

    function delete()
    {
        $id = $this->input->post('id');
        $key = array('product_id' => $id);

        $delete = $this->app_model->delete_data("product", $key);
        if ($delete) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'failed'));
        }
    }

    function post()
    {
        $nama = $this->input->post('nama');
        $kategori = $this->input->post('parent');
        $deskripsi = $this->input->post('deskripsi');
        $url = $this->input->post('url');
        $id = $this->input->post('id');
        $harga = $this->input->post('harga');
        $harga_promo = '0';
        $user = $this->session->userdata('id');
        $status = $this->input->post('status');
        $promo = $this->input->post('promo');
        $new = $this->input->post('new');
        $popular = $this->input->post('popular');
        $files = $_FILES;

        if ($promo == '1') {
            $value_promo = '1';
            $date_promo = date("Y-m-d H:i:s");
            $harga_promo = $this->input->post('harga_promo');
        } else {
            $value_promo = '0';
            $date_promo = '';
        }

        if ($popular == '1') {
            $value_popular = '1';
            $date_popular = date("Y-m-d H:i:s");
        } else {
            $value_popular = '0';
            $date_popular = '';
        }

        if ($new == '1') {
            $value_new = '1';
            $date_new = date("Y-m-d H:i:s");
        } else {
            $value_new = '0';
            $date_new = '';
        }

        //print_r($files);
        //print_r($_POST);
        //die();

        if ($id == "") {
            $get_url_exist = $this->app_model->get_data_query("SELECT product_url FROM product WHERE product_url = '" . $url . "'");
            if ($get_url_exist->num_rows() > 0) {
                echo json_encode(array('status' => 'failed', 'message' => 'Nama produk sudah ada..!'));
            } else {
                if ($files['foto']['error'] == '0') {
                    $get_last_id = "SELECT MAX(product_reff_code) AS last_code FROM product";
                    $query_last = $this->app_model->get_data_query($get_last_id)->row();
                    if ($query_last->last_code == "") {
                        $new_code = "PROD0001";
                    } else {
                        $nourut   = substr($query_last->last_code, 4, 8);
                        $inc      = (int) $nourut;
                        $inc      = $inc + 1;
                        $new_code = "PROD" . sprintf("%04s", $inc);
                    }

                    $img_name = $new_code . "_" . $files['foto']['name'];
                    move_uploaded_file($files['foto']['tmp_name'], realpath('assets/images') . '/' . $img_name);
                    $data_insert = array(
                        'product_name'          => $nama,
                        'product_url'           => $url,
                        'product_category_id'   => $kategori,
                        'product_harga'         => $harga,
                        'product_harga_promo'   => $harga_promo,
                        'product_deskripsi'     => $deskripsi,
                        'create_by'             => $user,
                        'create_date'           => date('Y-m-d H:i:s'),
                        'product_status'        => $status,
                        'product_image'         => $img_name,
                        'product_reff_code'     => $new_code,
                        'product_promo_list'    => $value_promo,
                        'product_promo_list_date' => $date_promo,
                        'product_new_in'        => $value_new,
                        'product_new_in_date'   => $date_new,
                        'product_most_popular'  => $value_popular,
                        'product_most_popular_date' => $date_popular

                    );

                    $save = $this->app_model->insert_data('product', $data_insert);
                    redirect('item');
                }
            }
        } else {
            $key = array('product_id' => $id);
            if ($files['foto']['error'] == '0') {

                $img_name = $this->input->post('reff_code') . "_" . $files['foto']['name'];
                move_uploaded_file($files['foto']['tmp_name'], realpath('assets/images') . '/' . $img_name);
                $data_update = array(
                    'product_name'          => $nama,
                    'product_url'           => $url,
                    'product_category_id'   => $kategori,
                    'product_harga'         => $harga,
                    'product_harga_promo'   => $harga_promo,
                    'product_deskripsi'     => $deskripsi,
                    'create_by'             => $user,
                    'create_date'           => date('Y-m-d H:i:s'),
                    'product_status'        => $status,
                    'product_image'         => $img_name,
                    'product_promo_list'    => $value_promo,
                    'product_promo_list_date' => $date_promo,
                    'product_new_in'        => $value_new,
                    'product_new_in_date'   => $date_new,
                    'product_most_popular'  => $value_popular,
                    'product_most_popular_date' => $date_popular
                );

                $update = $this->app_model->update_data('product', $data_update, $key);
                redirect('item');
            } else {
                $data_update = array(
                    'product_name'          => $nama,
                    'product_url'           => $url,
                    'product_category_id'   => $kategori,
                    'product_harga'         => $harga,
                    'product_harga_promo'   => $harga_promo,
                    'product_deskripsi'     => $deskripsi,
                    'update_by'             => $user,
                    'update_date'           => date('Y-m-d H:i:s'),
                    'product_status'        => $status,
                    'product_promo_list'    => $value_promo,
                    'product_promo_list_date' => $date_promo,
                    'product_new_in'        => $value_new,
                    'product_new_in_date'   => $date_new,
                    'product_most_popular'  => $value_popular,
                    'product_most_popular_date' => $date_popular
                );

                $update = $this->app_model->update_data('product', $data_update, $key);
                redirect('item');
            }
        }


        // if ($id == "") {
        //     $get_url_exist = $this->app_model->get_data_query("SELECT product_url FROM product WHERE product_url = '".$url."'");
        //     if ($get_url_exist->num_rows() > 0) {
        //         echo json_encode(array('status' => 'failed', 'message' => 'Nama produk sudah ada..!'));
        //     }
        //     else 
        //     {
        //         $data_insert = array(
        //             'product_name'          => $nama,
        //             'product_url'           => $url,
        //             'product_category_id'   => $kategori,
        //             'product_harga'         => $harga,
        //             'product_deskripsi'     => $deskripsi,
        //             'create_by'             => $user,
        //             'create_date'           => date('Y-m-d H:i:s'),
        //             'product_status'        => $status
        //         );
        //         $save = $this->app_model->insert_data('product', $data_insert);

        //         if ($save) {
        //             echo json_encode(array('status' => 'success'));
        //         } else {
        //             echo json_encode(array('status' => 'failed', 'message' => 'Gagal simpan data..!'));
        //         }
        //     }

        // } else {
        //     $key = array('product_id' => $id);
        //     $data_update = array(
        //         'product_name'          => $nama,
        //         'product_url'           => $url,
        //         'product_category_id'   => $kategori,
        //         'product_harga'         => $harga,
        //         'product_deskripsi'     => $deskripsi,
        //         'update_by'             => $user,
        //         'update_date'           => date('Y-m-d H:i:s'),
        //         'product_status'        => $status
        //     );
        //     $update = $this->app_model->update_data('product', $data_update, $key);

        //     if ($update) {
        //         echo json_encode(array('status' => 'success'));
        //     } else {
        //         echo json_encode(array('status' => 'failed', 'message' => 'Gagal edit data..!'));
        //     }
        // }
    }
}

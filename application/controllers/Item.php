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
        $query = "SELECT a.*, b.kategori_nama FROM pelayanan AS a
                  LEFT JOIN kategori AS b ON b.kategori_id = a.kategori_id ";
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
        $key = array('pelayanan_id' => $id);
        $data_row    = $this->app_model->get_data("product", $key, "pelayanan_id", "ASC")->row();
        $data = array(
            'content'   => 'backend/item/detail',
            'row'       => $data_row
        );
        $this->load->view('backend/layout/app', $data);
    }

    function create()
    {
        $query = "SELECT kategori_id, kategori_nama FROM kategori";
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
        $key = array('pelayanan_id' => $id);
        $query = "SELECT kategori_id, kategori_nama FROM kategori";
        $data_parent = $this->app_model->get_data_query($query)->result();
        $data_row    = $this->app_model->get_data("pelayanan", $key, "pelayanan_id", "ASC")->row();
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
        $key = array('pelayanan_id' => $id);

        $delete = $this->app_model->delete_data("pelayanan", $key);
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
            $get_url_exist = $this->app_model->get_data_query("SELECT pelayanan_url FROM pelayanan WHERE pelayanan_url = '" . $url . "'");
            if ($get_url_exist->num_rows() > 0) {
                echo json_encode(array('status' => 'failed', 'message' => 'Nama produk sudah ada..!'));
            } else {
                if ($files['foto']['error'] == '0') {
                    $get_last_id = "SELECT MAX(pelayanan_kode) AS last_code FROM pelayanan";
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
                        'kategori_id'   => $kategori,
                        'pelayanan_kode'     => $new_code,
                        'pelayanan_nama'          => $nama,
                        'pelayanan_url'           => $url,
                        'pelayanan_harga'         => $harga,
                        'pelayanan_harga_promo'   => $harga_promo,
                        'pelayanan_deskripsi'     => $deskripsi,
                        'pelayanan_gambar'         => $img_name,
                        'pelayanan_promo'    => $value_promo,
                        'pelayanan_promo_tanggal' => $date_promo,
                        'pelayanan_baru'        => $value_new,
                        'pelayanan_baru_tanggal'   => $date_new,
                        'pelayanan_populer'  => $value_popular,
                        'pelayanan_populer_tanggal' => $date_popular
                    );

                    $save = $this->app_model->insert_data('pelayanan', $data_insert);
                    redirect('item');
                }
            }
        } else {
            $key = array('pelayanan_id' => $id);
            if ($files['foto']['error'] == '0') {

                $img_name = $this->input->post('pelayanan_kode') . "_" . $files['foto']['name'];
                move_uploaded_file($files['foto']['tmp_name'], realpath('assets/images') . '/' . $img_name);
                $data_update = array(
                    'kategori_id'   => $kategori,
                    'pelayanan_nama'          => $nama,
                    'pelayanan_url'           => $url,
                    'pelayanan_harga'         => $harga,
                    'pelayanan_harga_promo'   => $harga_promo,
                    'pelayanan_deskripsi'     => $deskripsi,
                    'pelayanan_gambar'         => $img_name,
                    'pelayanan_promo'    => $value_promo,
                    'pelayanan_promo_tanggal' => $date_promo,
                    'pelayanan_baru'        => $value_new,
                    'pelayanan_baru_tanggal'   => $date_new,
                    'pelayanan_populer'  => $value_popular,
                    'pelayanan_populer_tanggal' => $date_popular
                );

                $update = $this->app_model->update_data('pelayanan', $data_update, $key);
                redirect('item');
            } else {
                $data_update = array(
                    'kategori_id'   => $kategori,
                    'pelayanan_nama'          => $nama,
                    'pelayanan_url'           => $url,
                    'pelayanan_harga'         => $harga,
                    'pelayanan_harga_promo'   => $harga_promo,
                    'pelayanan_deskripsi'     => $deskripsi,
                    'pelayanan_promo'    => $value_promo,
                    'pelayanan_promo_tanggal' => $date_promo,
                    'pelayanan_baru'        => $value_new,
                    'pelayanan_baru_tanggal'   => $date_new,
                    'pelayanan_populer'  => $value_popular,
                    'pelayanan_populer_tanggal' => $date_popular
                );

                $update = $this->app_model->update_data('pelayanan', $data_update, $key);
                redirect('item');
            }
        }


        // if ($id == "") {
        //     $get_url_exist = $this->app_model->get_data_query("SELECT pelayanan_url FROM pelayanan WHERE pelayanan_url = '".$url."'");
        //     if ($get_url_exist->num_rows() > 0) {
        //         echo json_encode(array('status' => 'failed', 'message' => 'Nama produk sudah ada..!'));
        //     }
        //     else 
        //     {
        //         $data_insert = array(
        //             'pelayanan_name'          => $nama,
        //             'pelayanan_url'           => $url,
        //             'kategori_id'   => $kategori,
        //             'pelayanan_harga'         => $harga,
        //             'pelayanan_deskripsi'     => $deskripsi,
        //             'create_by'             => $user,
        //             'create_tanggal'           => date('Y-m-d H:i:s'),
        //             'pelayanan_status'        => $status
        //         );
        //         $save = $this->app_model->insert_data('product', $data_insert);

        //         if ($save) {
        //             echo json_encode(array('status' => 'success'));
        //         } else {
        //             echo json_encode(array('status' => 'failed', 'message' => 'Gagal simpan data..!'));
        //         }
        //     }

        // } else {
        //     $key = array('pelayanan_id' => $id);
        //     $data_update = array(
        //         'pelayanan_name'          => $nama,
        //         'pelayanan_url'           => $url,
        //         'kategori_id'   => $kategori,
        //         'pelayanan_harga'         => $harga,
        //         'pelayanan_deskripsi'     => $deskripsi,
        //         'update_by'             => $user,
        //         'update_tanggal'           => date('Y-m-d H:i:s'),
        //         'pelayanan_status'        => $status
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

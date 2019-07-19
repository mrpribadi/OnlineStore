<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
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
        $query = "SELECT a.*, c.pelanggan_nama, c.pelanggan_telepon, d.pelayanan_nama, e.konfirmasi_status,
                        b.pemesanan_detail_tanggal, b.pemesanan_detail_jam 
                  FROM pemesanan AS a 
                  INNER JOIN pemesanan_detail AS b ON b.pemesanan_id = a.pemesanan_id
                  LEFT JOIN pelanggan AS c ON c.pelanggan_id = a.pelanggan_id 
                  LEFT JOIN pelayanan AS d ON d.pelayanan_id = b.pelayanan_id 
                  LEFT JOIN pembayaran AS e ON e.pemesanan_id = a.pemesanan_id 
                  ORDER BY a.pemesanan_nomer DESC";
        $data_order = $this->app_model->get_data_query($query)->result();
        $data = array(
            'content'   => 'backend/order/index',
            'order'     => $data_order
        );
        $this->load->view('backend/layout/app', $data);
    }

    function detail()
    {
        $id = $this->uri->segment(3);
        $query = "SELECT a.*, c.pelanggan_nama, c.pelanggan_telepon, d.pelayanan_nama, e.konfirmasi_status,
                        b.pemesanan_detail_tanggal, b.pemesanan_detail_jam,  c.pelanggan_kode_member, c.pelanggan_email,
                        e.konfirmasi_nama_rekening, e.konfirmasi_gambar,e.konfirmasi_catatan,e.konfirmasi_nomor_rekening,e.konfirmasi_nama_bank,
                        d.pelayanan_kode, d.pelayanan_deskripsi 
                  FROM pemesanan AS a 
                  INNER JOIN pemesanan_detail AS b ON b.pemesanan_id = a.pemesanan_id
                  LEFT JOIN pelanggan AS c ON c.pelanggan_id = a.pelanggan_id 
                  LEFT JOIN pelayanan AS d ON d.pelayanan_id = b.pelayanan_id 
                  LEFT JOIN pembayaran AS e ON e.pemesanan_id = a.pemesanan_id 
                  WHERE a.pemesanan_id = '" . $id . "'  
                  ORDER BY a.pemesanan_nomer DESC";
        $data_order = $this->app_model->get_data_query($query)->row();
        $data = array(
            'content'   => 'backend/order/detail',
            'order'     => $data_order
        );
        $this->load->view('backend/layout/app', $data);
    }

    function approve()
    {
        $id = $this->input->post('id');
        $key = array('pemesanan_id' => $id);

        $data = array('pemesanan_status' => '1');

        $action = $this->app_model->update_data("pemesanan", $data, $key);
        if ($action) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'failed'));
        }
    }

    function reject()
    {
        $id = $this->input->post('id');
        $key = array('pemesanan_id' => $id);

        $data = array('pemesanan_status' => '2');

        $action = $this->app_model->update_data("pemesanan", $data, $key);
        if ($action) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'failed'));
        }
    }
}

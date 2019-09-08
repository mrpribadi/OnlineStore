<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proses extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    { }

    function post()
    {
        $cust_id = $this->session->userdata('id');
        $fullname = $this->input->post('fullname');
        $gender = $this->input->post('gender');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $date = date("Y-m-d", strtotime($this->input->post('date')));
        $time = $this->input->post('time');
        $notes = $this->input->post('notes');
        $payment = $this->input->post('payment');
        $product_id = $this->input->post('product_id');
        $harga = $this->input->post('product_harga');
        $product_name = $this->input->post('product_name');
        $product_image = $this->input->post('product_image');


        $get_line_exist = $this->app_model->get_data_query("SELECT MAX(pemesanan_detail_nomor_ruangan) AS last_line FROM pemesanan_detail WHERE pemesanan_detail_tanggal = '" . $date . "' AND pemesanan_detail_jam = '" . $time . "'")->row();
        if ($get_line_exist->last_line == '8') {
            echo json_encode(array('status' => 'failed', 'message' => 'Booking full, silahkan cari waktu lain'));
        } else {
            $get_last_order_id = "SELECT MAX(pemesanan_nomer) AS last_code FROM pemesanan";
            $query_last = $this->app_model->get_data_query($get_last_order_id)->row();
            if ($query_last->last_code == "") {
                $new_code = "CUST00001";
            } else {
                $nourut   = substr($query_last->last_code, 4, 9);
                $inc      = (int) $nourut;
                $inc      = $inc + 1;
                $new_code = "CUST" . sprintf("%05s", $inc);
            }

            $get_last_line = "SELECT MAX(pemesanan_detail_nomor_ruangan) AS last_line FROM pemesanan_detail WHERE pemesanan_detail_tanggal = '" . $date . "' AND pemesanan_detail_jam = '" . $time . "'";
            $query_last_line = $this->app_model->get_data_query($get_last_line)->row();
            if ($query_last_line->last_line == "") {
                $new_line = "1";
            } else {
                $new_line = $query_last_line->last_line + 1;
            }

            $data_book_insert = array(
                'pemesanan_nomer'           => $new_code,
                'pemesanan_total'           => $harga,
                'pemesanan_status'          => 'Open',
                'pelanggan_id'              => $cust_id
            );
            $save_order = $this->app_model->insert_data('pemesanan', $data_book_insert);
            if ($save_order) {

                $get_header_id = "SELECT pemesanan_id FROM pemesanan WHERE pemesanan_nomer = '" . $new_code . "' ";
                $query_header_id = $this->app_model->get_data_query($get_header_id)->row();
                $data_detail = array(
                    'pemesanan_id' => $query_header_id->pemesanan_id,
                    'pelayanan_id' => $product_id,
                    'pemesanan_detail_tanggal' => $date,
                    'pemesanan_detail_jam' => $time,
                    'pemesanan_detail_nomor_ruangan' => $new_line,
                    'pemesanan_detail_subtotal' => $harga
                );

                $save_order_detail = $this->app_model->insert_data('pemesanan_detail', $data_detail);

                if ($save_order_detail) {
                    $data_session = array(
                        'product_id' => $product_id,
                        'product_name' => $product_name,
                        'harga' => $harga,
                        'tanggal' => $date,
                        'waktu' => $time,
                        'order_no' => $new_code,
                        'image' => $product_image
                    );
                    $this->session->set_userdata($data_session);
                    echo json_encode(array('status' => 'success', 'order_no' => $new_code));
                } else {
                    echo json_encode(array('status' => 'failed', 'message' => 'Gagal simpan detail pemesanan..!'));
                }
            } else {
                echo json_encode(array('status' => 'failed', 'message' => 'Gagal simpan pemesanan..!'));
            }
        }
    }

    function post_account()
    {
        $fullname = $this->input->post('fullname');
        $gender = $this->input->post('gender');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $get_email_exist = $this->app_model->get_data_query("SELECT pelanggan_email FROM pelanggan WHERE pelanggan_email = '" . $email . "'");
        if ($get_email_exist->num_rows() < 1) {
            $get_last_id = "SELECT MAX(pelanggan_kode_member) AS last_code FROM pelanggan";
            $query_last = $this->app_model->get_data_query($get_last_id)->row();
            if ($query_last->last_code == "") {
                $new_code = "USER00001";
            } else {
                $nourut   = substr($query_last->last_code, 4, 9);
                $inc      = (int) $nourut;
                $inc      = $inc + 1;
                $new_code = "USER" . sprintf("%05s", $inc);
            }

            $data_insert = array(
                'pelanggan_kode_member'      => $new_code,
                'pelanggan_email'            => $email,
                'pelanggan_password'         => md5($password),
                'pelanggan_nama'             => $fullname,
                'pelanggan_jenis_kelamin'    => $gender,
                'pelanggan_telepon'          => $phone
            );
            $save = $this->app_model->insert_data('pelanggan', $data_insert);

            if ($save) {
                $key = array('pelanggan_email' => $email);
                $cust = $this->app_model->get_data('Pelanggan', $key, 'pelanggan_email', 'ASC')->row();
                $data_session = array(
                    'id' => $cust->pelanggan_id,
                    'code' => $cust->pelanggan_kode_member,
                    'email' => $cust->pelanggan_email,
                    'nama' => $cust->pelanggan_nama,
                    'telp' => $cust->pelanggan_telepon
                );
                $this->session->set_userdata($data_session);
                echo json_encode(array('status' => 'success'));
            } else {
                echo json_encode(array('status' => 'failed', 'message' => 'Gagal simpan data'));
            }
        } else {
            echo json_encode(array('status' => 'failed', 'message' => 'Email sudah terdaftar'));
        }
    }

    function postXXX()
    {
        $fullname = $this->input->post('fullname');
        $gender = $this->input->post('gender');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $date = date("Y-m-d", strtotime($this->input->post('date')));
        $time = $this->input->post('time');
        $notes = $this->input->post('notes');
        $payment = $this->input->post('payment');
        $product_id = $this->input->post('product_id');
        $harga = $this->input->post('product_harga');
        $product_name = $this->input->post('product_name');
        $product_image = $this->input->post('product_image');


        $get_email_exist = $this->app_model->get_data_query("SELECT pelanggan_email FROM pelanggan WHERE pelanggan_email = '" . $email . "'");
        if ($get_email_exist->num_rows() < 1) {
            $get_line_exist = $this->app_model->get_data_query("SELECT MAX(order_working_time_line) AS last_line FROM order_header WHERE order_working_date = '" . $date . "' AND order_working_time = '" . $time . "'")->row();
            if ($get_line_exist->last_line == '8') {
                echo json_encode(array('status' => 'failed', 'message' => 'Booking full, silahkan cari waktu lain'));
            } else {
                # code...
                // NEW CODE
                $get_last_id = "SELECT MAX(pelanggan_code) AS last_code FROM pelanggan";
                $query_last = $this->app_model->get_data_query($get_last_id)->row();
                if ($query_last->last_code == "") {
                    $new_code = "CUST00001";
                } else {
                    $nourut   = substr($query_last->last_code, 4, 9);
                    $inc      = (int) $nourut;
                    $inc      = $inc + 1;
                    $new_code = "CUST" . sprintf("%05s", $inc);
                }

                // GET IP ADDRESS
                if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
                {
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
                {
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } else {
                    $ip = $_SERVER['REMOTE_ADDR'];
                }

                $data_insert = array(
                    'pelanggan_nama'             => $fullname,
                    'pelanggan_email'            => $email,
                    'pelanggan_phone'            => $phone,
                    'pelanggan_gender'           => $gender,
                    'pelanggan_status'           => 'active',
                    'pelanggan_password'         => md5("abc123"),
                    'pelanggan_code'             => $new_code,
                    'pelanggan_ip_address'       => $ip,
                    'pelanggan_registration_date' => date('Y-m-d H:i:s')
                );
                $save = $this->app_model->insert_data('pelanggan', $data_insert);

                if ($save) {
                    $get_user_saved = $this->app_model->get_data_query("SELECT * FROM pelanggan WHERE pelanggan_email = '" . $email . "'")->row();
                    $get_last_order_id = "SELECT MAX(order_no) AS last_code FROM order_header";
                    $query_last = $this->app_model->get_data_query($get_last_order_id)->row();
                    if ($query_last->last_code == "") {
                        $new_code = "BOOK00001";
                    } else {
                        $nourut   = substr($query_last->last_code, 4, 9);
                        $inc      = (int) $nourut;
                        $inc      = $inc + 1;
                        $new_code = "BOOK" . sprintf("%05s", $inc);
                    }

                    $get_last_line = "SELECT MAX(order_working_time_line) AS last_line FROM order_header WHERE order_working_date = '" . $date . "' AND order_working_time = '" . $time . "'";
                    $query_last_line = $this->app_model->get_data_query($get_last_line)->row();
                    if ($query_last_line->last_line == "") {
                        $new_line = "1";
                    } else {
                        $new_line = $query_last_line->last_line + 1;
                    }

                    $data_book_insert = array(
                        'order_no'                  => $new_code,
                        'order_date'                => date("Y-m-d H:i:s"),
                        'order_status'              => 'Open',
                        'order_total'               => $harga,
                        'pelanggan_id'               => $get_user_saved->pelanggan_id,
                        'payment_type_id'           => $payment,
                        'product_id'                => $product_id,
                        'order_working_date'        => $date,
                        'order_working_time'        => $time,
                        'order_working_time_line'   => $new_line
                    );

                    $save_order = $this->app_model->insert_data('order_header', $data_book_insert);
                    if ($save_order) {
                        $data_session = array(
                            'product_id' => $product_id,
                            'product_name' => $product_name,
                            'harga' => $harga,
                            'tanggal' => $date,
                            'waktu' => $time,
                            'order_no' => $new_code,
                            'image' => $product_image
                        );
                        $this->session->set_userdata($data_session);
                        echo json_encode(array('status' => 'success', 'order_no' => $new_code));
                    } else {
                        echo json_encode(array('status' => 'failed', 'message' => 'Gagal simpan order..!'));
                    }
                } else {
                    echo json_encode(array('status' => 'failed', 'message' => 'Gagal simpan data..!'));
                }
            }
        } else {
            echo json_encode(array('status' => 'failed', 'message' => 'Email sudah terdaftar'));
        }
    }
}

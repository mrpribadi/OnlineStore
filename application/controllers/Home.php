<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $treatment_popular = $this->app_model->get_data_query("SELECT * FROM Pelayanan WHERE pelayanan_populer = 1 ORDER BY  pelayanan_populer_tanggal DESC LIMIT 4")->result();
        $treatment_promo = $this->app_model->get_data_query("SELECT * FROM Pelayanan WHERE pelayanan_promo = 1 ORDER BY pelayanan_promo_tanggal DESC LIMIT 2")->result();
        $treatment_new = $this->app_model->get_data_query("SELECT * FROM Pelayanan WHERE pelayanan_baru = 1 ORDER BY pelayanan_baru_tanggal DESC LIMIT 2")->result();
        $pelayanan = $this->app_model->get_data_query("SELECT pelayanan_id, kategori_id, pelayanan_nama, pelayanan_url FROM Pelayanan WHERE kategori_id=1")->result();
        $produk = $this->app_model->get_data_query("SELECT pelayanan_id, kategori_id, pelayanan_nama, pelayanan_url FROM Pelayanan WHERE kategori_id=2")->result();
        $data = array(
            'content' => 'frontend/home',
            'popular' => $treatment_popular,
            'promo'   => $treatment_promo,
            'newin'   => $treatment_new,
            'pelayanan' => $pelayanan,
            'produk' => $produk
        );
        $this->load->view('frontend/layout/app', $data);
    }

    function detail()
    {
        $url = $this->uri->segment(2);
        $detail_product = $this->app_model->get_data_query("SELECT a.*, b.kategori_nama  FROM Pelayanan a LEFT JOIN Kategori b ON b.kategori_id = a.kategori_id WHERE a.pelayanan_url = '" . $url . "' ")->row();
        $pelayanan = $this->app_model->get_data_query("SELECT pelayanan_id, kategori_id, pelayanan_nama, pelayanan_url FROM Pelayanan WHERE kategori_id=1")->result();
        $produk = $this->app_model->get_data_query("SELECT pelayanan_id, kategori_id, pelayanan_nama, pelayanan_url FROM Pelayanan WHERE kategori_id=2")->result();
        $data = array(
            'content' => 'frontend/detail',
            'pelayanan' => $pelayanan,
            'produk' => $produk,
            'product' => $detail_product
        );
        $this->load->view('frontend/layout/app', $data);
    }

    function pages()
    {
        $url = $this->uri->segment(2);
        $pelayanan = $this->app_model->get_data_query("SELECT pelayanan_id, kategori_id, pelayanan_nama, pelayanan_url FROM Pelayanan WHERE kategori_id=1")->result();
        $produk = $this->app_model->get_data_query("SELECT pelayanan_id, kategori_id, pelayanan_nama, pelayanan_url FROM Pelayanan WHERE kategori_id=2")->result();

        switch ($url) {
            case 'pelayanan':
                $list_product = $this->app_model->get_data_query("SELECT * FROM Pelayanan WHERE kategori_id = '1' ")->result();
                $data = array(
                    'content' => 'frontend/pages',
                    'pelayanan' => $pelayanan,
                    'produk' => $produk,
                    'product' => $list_product
                );
                break;
            case 'produk':
                $list_product = $this->app_model->get_data_query("SELECT * FROM Pelayanan WHERE kategori_id = '2' ")->result();
                $data = array(
                    'content' => 'frontend/pages_produk',
                    'pelayanan' => $pelayanan,
                    'produk' => $produk,
                    'product' => $list_product
                );
                break;
            case 'promo':
                $list_product = $this->app_model->get_data_query("SELECT * FROM Pelayanan WHERE pelayanan_promo = 1 ORDER BY pelayanan_promo_tanggal DESC")->result();
                $data = array(
                    'content' => 'frontend/pages',
                    'pelayanan' => $pelayanan,
                    'produk' => $produk,
                    'product' => $list_product
                );
                break;
            case 'about':
                $dokter = $this->app_model->get_data_query("SELECT * FROM user_admin WHERE admin_level = 'dokter' AND admin_status = 'active' ")->result();
                $beauty = $this->app_model->get_data_query("SELECT * FROM user_admin WHERE admin_level = 'beautician' AND admin_status = 'active' ")->result();
                $kasir = $this->app_model->get_data_query("SELECT * FROM user_admin WHERE admin_level = 'kasir' AND admin_status = 'active' ")->result();
                $data = array(
                    'content' => 'frontend/about',
                    'pelayanan' => $pelayanan,
                    'produk' => $produk,
                    'dokter'  => $dokter,
                    'beauty'  => $beauty,
                    'kasir'   => $kasir
                );
                break;
            case 'outlet':
                $this->load->library('googlemaps');
                $where = array('status' => 'active');
                $outlet = $this->app_model->get_data('outlet', $where, 'outlet_id', 'ASC')->result();

                $config['zoom']     = 'auto';
                $this->googlemaps->initialize($config);

                foreach ($outlet as $row_marker) :
                    $marker = array();
                    $marker['position']  = '' . $row_marker->latitude . ',' . $row_marker->longitude . '';
                    $marker['draggable'] = false;
                    // $marker['infowindow_content'] = '<table><tr><td colspan="3" nowrap style="padding-bottom:10px;padding-top:10px"><strong>' . $row_marker->outlet_name . '</strong></td></tr><tr><td colspan="3">' . $row_marker->outlet_address . '</td></tr></table>';
                    $marker['infowindow_content'] = "fsdfs";
                    $this->googlemaps->add_marker($marker);
                endforeach;

                $map = $this->googlemaps->create_map();
                $data = array(
                    'content' => 'frontend/outlet',
                    'pelayanan' => $pelayanan,
                    'produk' => $produk,
                    'map'     => $map
                );
                break;
            case 'payment':
                $payment = $this->app_model->get_data_all('bank', 'bank_nama', 'ASC')->result();
                $data = array(
                    'content' => 'frontend/payment',
                    'pelayanan' => $pelayanan,
                    'produk' => $produk,
                    'payment' => $payment
                );
                break;
            case 'confirm':
                $data = array(
                    'content' => 'frontend/confirm',
                    'pelayanan' => $pelayanan,
                    'produk' => $produk,
                );
                break;
            default:
                $data = array(
                    'content' => 'frontend/home',
                    'pelayanan' => $pelayanan,
                    'produk' => $produk,
                    'product' => $list_product
                );
                break;
        }
        $this->load->view('frontend/layout/app', $data);
    }

    function order()
    {
        if ($this->session->userdata('id') == '') {
            redirect('home/login');
        }
        $url = $this->uri->segment(3);
        $pelayanan = $this->app_model->get_data_query("SELECT pelayanan_id, kategori_id, pelayanan_nama, pelayanan_url FROM Pelayanan WHERE kategori_id=1")->result();
        $produk = $this->app_model->get_data_query("SELECT pelayanan_id, kategori_id, pelayanan_nama, pelayanan_url FROM Pelayanan WHERE kategori_id=2")->result();
        $detail_product = $this->app_model->get_data_query("SELECT a.*, b.kategori_nama  FROM Pelayanan a LEFT JOIN Kategori b ON b.kategori_id = a.kategori_id WHERE a.pelayanan_url = '" . $url . "' ")->row();
        //$payment = $this->app_model->get_data_query("SELECT * FROM payment_type WHERE payment_type_status = 'active' ")->result();
        $data = array(
            'content' => 'frontend/order',
            'pelayanan' => $pelayanan,
            'produk' => $produk,
            'produk_detail'  => $detail_product
            //'payment' => $payment
        );

        $this->load->view('frontend/layout/app', $data);
    }

    function member()
    {
        if ($this->session->userdata('id') == '') {
            redirect('home');
        }
        $id = $this->session->userdata('id');
        $pelayanan = $this->app_model->get_data_query("SELECT pelayanan_id, kategori_id, pelayanan_nama, pelayanan_url FROM Pelayanan WHERE kategori_id=1")->result();
        $produk = $this->app_model->get_data_query("SELECT pelayanan_id, kategori_id, pelayanan_nama, pelayanan_url FROM Pelayanan WHERE kategori_id=2")->result();
        $data_history = $this->app_model->get_data_query("  SELECT
                                                                a.*, b.pelayanan_id,
                                                                b.pemesanan_detail_tanggal,
                                                                b.pemesanan_detail_jam,
                                                                b.pemesanan_detail_nomor_ruangan,
                                                                c.pelayanan_nama,
                                                                d.konfirmasi_status
                                                            FROM
                                                                Pemesanan AS a
                                                            INNER JOIN pemesanan_detail AS b ON b.pemesanan_id = a.pemesanan_id
                                                            INNER JOIN pelayanan AS c ON c.pelayanan_id = b.pelayanan_id
                                                            LEFT JOIN pembayaran AS d ON d.pemesanan_id = a.pemesanan_id
                                                            WHERE a.pelanggan_id = '" . $id . "'")->result();
        $data = array(
            'content' => 'frontend/history',
            'pelayanan' => $pelayanan,
            'produk' => $produk,
            'history' => $data_history
        );
        $this->load->view('frontend/layout/app', $data);
    }

    function profile()
    {
        $pelayanan = $this->app_model->get_data_query("SELECT pelayanan_id, kategori_id, pelayanan_nama, pelayanan_url FROM Pelayanan WHERE kategori_id=1")->result();
        $produk = $this->app_model->get_data_query("SELECT pelayanan_id, kategori_id, pelayanan_nama, pelayanan_url FROM Pelayanan WHERE kategori_id=2")->result();

        $data = array(
            'content' => 'frontend/profile',
            'pelayanan' => $pelayanan,
            'produk' => $produk,
        );
        $this->load->view('frontend/layout/app', $data);
    }

    function confirm()
    {
        if ($this->session->userdata('id') == '') {
            redirect('home');
        }
        $id = $this->uri->segment(3);
        $pelayanan = $this->app_model->get_data_query("SELECT pelayanan_id, kategori_id, pelayanan_nama, pelayanan_url FROM Pelayanan WHERE kategori_id=1")->result();
        $produk = $this->app_model->get_data_query("SELECT pelayanan_id, kategori_id, pelayanan_nama, pelayanan_url FROM Pelayanan WHERE kategori_id=2")->result();
        $where = array('pemesanan_id' => $id);
        $order = $this->app_model->get_data('pemesanan', $where, 'pemesanan_id', 'ASC')->row();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('bank_name', 'Bank name', 'trim|required');
        $this->form_validation->set_rules('bank_account_no', 'Bank account', 'trim|required');
        $this->form_validation->set_rules('bank_account_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'content' => 'frontend/confirm',
                'pelayanan' => $pelayanan,
                'produk' => $produk,
                'order'   => $order
            );
        } else {
            $bank_name = $this->input->post('bank_name');
            $bank_account_no = $this->input->post('bank_account_no');
            $bank_account_name = $this->input->post('bank_account_name');
            $amount = $this->input->post('amount');
            $notes = $this->input->post('notes');
            $order_id = $this->input->post('idorder');
            $files = $_FILES;
            if ($files['foto']['error'] == '0') {
                $img_name = $order_id . "_" . $files['foto']['name'];
                move_uploaded_file($files['foto']['tmp_name'], realpath('assets/confirm') . '/' . $img_name);
                $data_konfirmasi = array(
                    'pemesanan_id' => $order_id,
                    'konfirmasi_tanggal' => date("Y-m-d H:i:s"),
                    'konfirmasi_nama_bank' => $bank_name,
                    'konfirmasi_nomor_rekening' => $bank_account_no,
                    'konfirmasi_nama_rekening' => $bank_account_name,
                    'konfirmasi_jumlah_transfer' => $amount,
                    'konfirmasi_catatan' => $notes,
                    'konfirmasi_gambar' => $img_name,
                    'konfirmasi_status' => '1'

                );
                $do_confirm = $this->app_model->insert_data('pembayaran', $data_konfirmasi);
                if ($do_confirm) {
                    redirect('home/member');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Konfirmasi gagal</div>');
                }
            }
        }
        $this->load->view('frontend/layout/app', $data);
    }

    function login()
    {
        if ($this->session->userdata('id') != '') {
            redirect('home');
        }
        $pelayanan = $this->app_model->get_data_query("SELECT pelayanan_id, kategori_id, pelayanan_nama, pelayanan_url FROM Pelayanan WHERE kategori_id=1")->result();
        $produk = $this->app_model->get_data_query("SELECT pelayanan_id, kategori_id, pelayanan_nama, pelayanan_url FROM Pelayanan WHERE kategori_id=2")->result();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'content' => 'frontend/login',
                'pelayanan' => $pelayanan,
                'produk' => $produk
            );
        } else {
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));
            $key = array('pelanggan_email' => $email);

            $customer = $this->app_model->get_data('Pelanggan', $key, 'pelanggan_email', 'ASC');
            if ($customer->num_rows() != '') {
                $cust = $customer->row();
                if ($password == $cust->pelanggan_password) {
                    $data_session = array(
                        'id' => $cust->pelanggan_id,
                        'code' => $cust->pelanggan_kode_member,
                        'email' => $cust->pelanggan_email,
                        'nama' => $cust->pelanggan_nama,
                        'telp' => $cust->pelanggan_telepon,
                    );
                    $this->session->set_userdata($data_session);
                    redirect('home');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Password salah</div>');
                    redirect('home/login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Email belum terdaftar</div>');
                redirect('home/login');
            }
        }


        $this->load->view('frontend/layout/app', $data);
    }

    function register()
    {
        if ($this->session->userdata('id') != '') {
            redirect('home');
        }
        $pelayanan = $this->app_model->get_data_query("SELECT pelayanan_id, kategori_id, pelayanan_nama, pelayanan_url FROM Pelayanan WHERE kategori_id=1")->result();
        $produk = $this->app_model->get_data_query("SELECT pelayanan_id, kategori_id, pelayanan_nama, pelayanan_url FROM Pelayanan WHERE kategori_id=2")->result();
        $data = array(
            'content' => 'frontend/register',
            'pelayanan' => $pelayanan,
            'produk' => $produk
        );

        $this->load->view('frontend/layout/app', $data);
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('home'));
    }
}

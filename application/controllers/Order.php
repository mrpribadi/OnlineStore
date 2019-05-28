<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller
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
        $query = "SELECT a.*, b.customer_nama, b.customer_phone, c.payment_type_nama, d.product_name 
                  FROM order_header AS a 
                  LEFT JOIN customer AS b ON b.customer_id = a.customer_id 
                  LEFT JOIN payment_type AS c ON c.payment_type_id = a.payment_type_id
                  LEFT JOIN product AS d ON d.product_id = a.product_id  
                  ORDER BY a.order_no DESC";
        $data_order = $this->app_model->get_data_query($query)->result();
        $data = array(
            'content'   => 'backend/order/index',
            'order'     => $data_order
        );
        $this->load->view('backend/layout/app', $data);
    }

    function approve($id) {
        $key = array('order_id' => $id);

        $data = array('order_status' => '1');

        $action = $this->app_model->update_data("order_header", $data, $key);
        if ($action) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'failed'));
        }
    }

    function reject($id) {
        $key = array('order_id' => $id);

        $data = array('order_status' => '2');

        $action = $this->app_model->update_data("order_header", $data, $key);
        if ($action) {
            echo json_encode(array('status' => 'success'));
        } else {
            echo json_encode(array('status' => 'failed'));
        }
    }
    
}
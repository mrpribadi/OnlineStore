<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller
{
    function __construct() {
        parent::__construct();
    }

    function index() {
        $data = array('content' => 'backend/home');
        $this->load->view('backend/layout/app', $data);
    }
    
}
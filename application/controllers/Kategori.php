<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    function __construct() {
        parent::__construct();
    }

    function index() {
        
        $data = array('content' => 'backend/kategori/index');
        $this->load->view('backend/layout/app', $data);
    }
    
}
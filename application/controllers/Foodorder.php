<?php

class Foodorder extends Admin_Controller
{
    public function __construct()
    {
        parent ::__construct();
        $this->load->model('Model_common');
        $this->load->model('Model_getrows');
        $this->load->library('Cart');
        $this->load->library('session');
      // error_reporting(0);
    }
    function index()
    {
    	$this->template->load();
    }

 ?>
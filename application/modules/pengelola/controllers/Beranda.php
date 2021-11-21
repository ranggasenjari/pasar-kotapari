<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
		$d['sub_judul'] = 'Pengelola |';
        
        $this->load->view('header',$d);
        $this->load->view('left',$d);
        $this->load->view('boxed',$d);
        $this->load->view('footer',$d);

    }
}

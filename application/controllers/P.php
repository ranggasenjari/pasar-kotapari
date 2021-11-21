<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P extends MY_Controller {


	public function index()
	{
		$d['sub_judul'] = '';
		
		$this->load->view('meta', $d);
		$this->load->view('header', $d);
		$this->load->view('web/index', $d);
		$this->load->view('footer', $d);
	}

	public function info()
	{
		$this->is_logged_in();
		
		$d['sub_judul'] = 'Informasi | ';
		
		$d['meta'] = $this->meta_model->info();
		$d['berita'] = $this->web_model->get_berita(10);
		$d['komoditas'] = $this->web_model->komoditas(10);
		$d['popularsearch'] = $this->web_model->get_popularsearch(8);
		// $d['auth_data'] = $this->auth_data;
		
		$this->load->view('meta', $d);
		$this->load->view('header', $d);
		$this->load->view('web/info', $d);
		$this->load->view('footer', $d);
	}

	public function json()
	{
		echo '<pre>';
		echo json_encode($this->db->get('dt_usaha')->result_array());
	}
}

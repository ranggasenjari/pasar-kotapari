<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detil extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
		$this->load->model('usaha_model');
    }

	public function index()
	{

	}

	public function detil()
	{
		$this->is_logged_in();
		
		$d['id_usaha'] = $this->uri->segment(2);
		
		$filter = array (
				'id_kat_produk' => $this->input->get('k', TRUE),
				'kondisi' => $this->input->get('s', TRUE)
				);

		$offset = $this->input->get('p', TRUE);
		$sort = $this->input->get('sort', TRUE);
		
		$prd = $this->usaha_model->produk($d['id_usaha'],$filter,$offset,$sort);
		
		if ($this->input->is_ajax_request()) {
			
			echo $prd;
			
		} else {
			$d['cabang'] = $this->usaha_model->cabang($d['id_usaha']);
			$d['dt'] = $this->usaha_model->udata($d['id_usaha']);
			$d['sub_judul'] = $d['dt']->nama_usaha.' |';
			$d['meta'] = $this->meta_model->detilusaha($d['dt']);
			$d['produk'] = $prd;
			
			$d['katfilter'] = $this->usaha_model->get_kat_filter($d['id_usaha']);
			$d['kondfilter'] = $this->usaha_model->get_kond_filter($d['id_usaha']);
			
			$this->load->view('meta', $d);
			$this->load->view('header', $d);
			$this->load->view('detil', $d);
			$this->load->view('footer', $d);
		}
	}
	
}
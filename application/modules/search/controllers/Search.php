<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends MY_Controller {

	public function index()
	{
		$this->is_logged_in();
		
		$this->load->model('cari_model');
		
		$q = $this->input->get('q', TRUE);
		
		$this->add_count(urldecode($q));
		
		$filter = array (
				'id_kecamatan' => $this->input->get('d', TRUE),
				'id_kat_produk' => $this->input->get('k', TRUE),
				'kondisi' => $this->input->get('s', TRUE),
				'verifikasi' => $this->input->get('v', TRUE)
				);

		$offset = $this->input->get('p', TRUE);
		$sort = $this->input->get('sort', TRUE);
		$d['apacari'] = urldecode($q);
		
		$hasilcari = $this->cari_model->cari_produk($d['apacari'],$filter,$offset,$sort);
		
		if ($this->input->is_ajax_request()) {
			
			echo $hasilcari;
			
		} else {
			
			$d['sub_judul'] = 'Jual '.urldecode($q).' |';
			$d['kecfilter'] = $this->cari_model->get_kec_filter(urldecode($q));
			$d['katfilter'] = $this->cari_model->get_kat_filter(urldecode($q));
			$d['kondfilter'] = $this->cari_model->get_kond_filter(urldecode($q));
			$d['meta'] = $this->meta_model->cari($q);
			$d['hasilcari'] = $hasilcari;
			
			$this->load->view('meta', $d);
			$this->load->view('header', $d);
			$this->load->view('search-item', $d);
			$this->load->view('footer', $d);
		}
		
	}

	public function toko()
	{
		$this->is_logged_in();
		
		$this->load->model('cari_model');
		
		$q = $this->input->get('q', TRUE);
		
		//$this->add_count(urldecode($q));
		
		$filter = array (
				'dt_usaha.id_kecamatan' => $this->input->get('d', TRUE),
				'id_kat_usaha' => $this->input->get('k', TRUE),
				'verifikasi' => $this->input->get('v', TRUE)
				);

		// $offset = $this->input->get('p', TRUE);
		$sort = $this->input->get('sort', TRUE);
		$d['apacari'] = urldecode($q);
		
		$hasilcari = $this->cari_model->cari_toko($d['apacari'],$filter,$sort);
		
		if ($this->input->is_ajax_request()) {
			
			echo $hasilcari;
			
		} else {
			
			$d['sub_judul'] = 'Cari toko '.urldecode($q).' |';
			$d['kecfilter'] = $this->cari_model->get_kec_tokofilter(urldecode($q));
			$d['katfilter'] = $this->cari_model->get_kat_tokofilter(urldecode($q));
			
			$d['hasilcari'] = $hasilcari;
			
			$this->load->view('meta', $d);
			$this->load->view('header', $d);
			$this->load->view('search-toko', $d);
			$this->load->view('footer', $d);
		}
		
	}

	public function ajaxcari()
	{
		$this->load->model('cari_model');
		
		parse_str(parse_url($this->input->post('url', TRUE), PHP_URL_QUERY), $o);
		
		$filter = array (
				'id_kecamatan' => @$o['d'],
				'id_kat_produk' => @$o['k'],
				'kondisi' => @$o['s'],
				'verifikasi' => @$o['v']
				);
		
		echo $this->cari_model->cari_produk(@$o['q'],$filter,@$o['v']);
		
	}

	public function get_desa()
	{
		$this->db->where('district_id', $this->uri->segment(3));
		$s = $this->db->get('villages');
		foreach ($s->result() as $sub){
			echo '<option value="'.$sub->id.'">'.$sub->name.'</option>';
		}
	}

	public function add_count($slug)
	{
		$this->load->helper('cookie');
		$check_visitor = $this->input->cookie('cari-'.slugifyonly($slug), FALSE);
		$ip = $this->input->ip_address();
		if ($check_visitor == false) {
			$cookie = array(
				"name"   => 'cari-'.slugifyonly($slug),
				"value"  => "$ip",
				"expire" =>  time() + 7200,
				"secure" => false
			);
			$this->input->set_cookie($cookie);
			$this->cari_model->update_counter($slug);
		}
	}
	
	
}

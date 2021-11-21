<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends MY_Controller {


	public function index()
	{
		$this->is_logged_in();
		$this->load->model('item_model');
		$this->load->model('usaha/usaha_model');
		$id_produk = $this->uri->segment(2);
		$this->add_count($this->uri->segment(4));
		$d['dt'] = $this->item_model->get_all_productdata($id_produk);
		$d['meta'] = $this->meta_model->item($d['dt']);
		//$this->add_count($this->item_model->get_all_productdata($id_produk)->slug_produk);
		
		if ($d['dt']->id_pemilik != null){
			$d['udata'] = $this->web_model->udata($d['dt']->id_pemilik);
			$d['info'] = $this->usaha_model->get_info($d['udata'],'umum');
		}
		
		$d['img'] = $this->item_model->get_productimg($id_produk);
		$d['hits'] = $d['dt']->hits_pc+$d['dt']->hits_mobile+$d['dt']->hits_others;
		//var_dump($d['img']->row());
		if ($d['dt']==null){
			show_404();
		}
		$d['sub_judul'] = 'Jual '.$d['dt']->nama_produk.' |';
		
		$this->load->view('meta', $d);
		$this->load->view('header', $d);
		$this->load->view('item', $d);
		$this->load->view('footer', $d);
	}
	
	// This is the counter function.. 
	public function add_count($slug)
	{
		// load cookie helper
		$this->load->helper('cookie');
		// this line will return the cookie which has slug name
		$check_visitor = $this->input->cookie(urlencode($slug), FALSE);
		// this line will return the visitor ip address
		$ip = $this->input->ip_address();
		// if the visitor visit this product for first time then
		//set new cookie and update hits column  ..
		//you might be notice we used slug for cookie name and ip 
		//address for value to distinguish between product views
		if ($check_visitor == false) {
			$cookie = array(
				"name"   => urlencode($slug),
				"value"  => "$ip",
				"expire" =>  time() + 7200,
				"secure" => false
			);
			$this->input->set_cookie($cookie);
			$this->item_model->update_counter(urlencode($slug));
		}
	}

}


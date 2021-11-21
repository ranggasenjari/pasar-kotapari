<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_model extends CI_Model {

    public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();
    }
	
	function get_all_productdata($id_produk)
	{
		$this->db->select("dt_produk.*, dt_kat_produk.uraian, dt_usaha.*, districts.name as kec, villages.name as des");
		$this->db->from('dt_produk');
		$this->db->join('dt_kat_produk', 'dt_produk.id_kat_produk = dt_kat_produk.id_kat_produk', 'left');
		$this->db->join('dt_usaha', 'dt_produk.id_usaha = dt_usaha.id_usaha', 'left');
		$this->db->join('districts', 'dt_usaha.id_kecamatan = districts.id', 'left');
		$this->db->join('villages', 'dt_usaha.id_desa = villages.id', 'left');
		$this->db->where('id_produk', $id_produk);
		$q = $this->db->get()->row();
		
		return $q;
		
	}
	
	function get_productimg($id_produk)
	{
		$this->db->from('dt_foto_produk');
		$this->db->where('id_produk', $id_produk);
		$q = $this->db->get();
		
		return $q;
		
	}
	
	function update_counter($slug) {
	// return current article views 
		$this->db->where('slug_produk', urldecode($slug));
		if ($this->agent->is_mobile()){
			$this->db->select('hits_mobile');
		} else if ($this->agent->is_browser()){
			$this->db->select('hits_pc');
		} else {
			$this->db->select('hits_others');
		}		
		$count = $this->db->get('dt_produk')->row();
	// then increase by one 
		$this->db->where('slug_produk', urldecode($slug));
		if ($this->agent->is_mobile()){
			$this->db->set('hits_mobile', ($count->hits_mobile + 1));
		} else if ($this->agent->is_browser()){
			$this->db->set('hits_pc', ($count->hits_pc + 1));
		} else {
			$this->db->set('hits_others', ($count->hits_others + 1));
		}
		$this->db->update('dt_produk');
	}
}


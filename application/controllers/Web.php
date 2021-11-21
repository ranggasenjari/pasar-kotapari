<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends MY_Controller {


	public function index()
	{
		$this->is_logged_in();
		// echo 'id'.$this->auth_user_id;
		// die();
		
		$d['sub_judul'] = '';
		
		$d['meta'] = $this->meta_model->utama();
		// $d['berita'] = $this->web_model->get_berita(10);
		$d['komoditas'] = $this->web_model->komoditas(10);
		$d['popularsearch'] = $this->web_model->get_popularsearch(8);
		// $d['auth_data'] = $this->auth_data;
		
		$this->load->view('meta', $d);
		$this->load->view('header', $d);
		$this->load->view('web/index', $d);
		$this->load->view('footer', $d);
	}

	public function get_desa()
	{
		echo $this->web_model->get_desa($this->uri->segment(3));
	}

	public function usahaid()
	{
		$this->load->model('user/user_model');
		
		echo $this->user_model->get_unused_usaha_id();
	}
	
	public function kec()
	{		
		$hasil ="";
		
		$q = $this->db->get('districts');
		
		echo '<pre>';
		$i=1;
		foreach ($q->result_array() as $kec){
			$u = $this->db->where('id_kecamatan', $kec['id'])->get('dt_usaha')->num_rows();
			$kec['jumlah'] = $u;
			$i++;
			$new_arr[] = $kec;
		}
		
		usort($new_arr, function($b, $a) {
			return $a['jumlah'] <=> $b['jumlah'];
		});
		
		print_r($new_arr);
		//echo $hasil;
	}

	public function tes()
	{
		$this->db->limit(8,0);
		$q = $this->db->get('dt_cari');
		
		foreach ($q->result() as $c){
			$arr[] = array(
			  'id_cari' => $c->id_cari,
			  'keywords' => $c->keywords,
			  'rand_img' => $c->rand_img,
			  'hits' =>  $c->hits_pc+$c->hits_mobile+$c->hits_others
			);
		}
		
		$this->array_sort_by_column($arr, 'hits');
		
		var_dump($arr);
	}

	public function array_sort_by_column(&$arr, $col, $dir = SORT_DESC) {
		$sort_col = array();
		foreach ($arr as $key=> $row) {
			$sort_col[$key] = $row[$col];
		}
		array_multisort($sort_col, $dir, $arr);
	}
	
	public function import()
	{
		$this->load->model('user/user_model');
		$i = 1;
		foreach(file('import.txt') as $line) {
			$rowData[$i] = explode(';', $line);

			$idusaha[$i] = $this->user_model->get_unused_usaha_id();
			$tanggal[$i] = date('Y-m-d H:i:s');

			 $usaha[$i] = array(
				"id_usaha"=> $idusaha[$i],
				"id_kat_usaha"=> 1,
				"nama_usaha"=> $rowData[$i][0],
				"slug_usaha"=> slugify('usaha',$rowData[$i][0]),
				"id_pemilik"=> null,
				"tgl_publish"=> $tanggal[$i],
				"alamat"=> $rowData[$i][2],
				"id_kecamatan"=> $rowData[$i][4],
				"id_desa"=> $rowData[$i][3],
				"status_terbit"=> 1,
				"verifikasi"=> 1
			);
			$this->db->insert("dt_usaha",$usaha[$i]);

			 $verif[$i] = array(
				"id_usaha"=> $idusaha[$i],
				"id_operator"=> 9,
				"berkas"=> '',
				"keterangan"=> 'Import Data Excel',
				"tgl_verifikasi"=> $tanggal[$i],
				"hash"=> md5($idusaha[$i].'|9||Import Data Excel|'.$tanggal[$i]),
				"status"=> 1
			);
			$this->db->insert("dt_verifikasi",$verif[$i]);

			 $produk[$i] = array(
				"id_usaha"=> $idusaha[$i],
				"id_kat_produk"=> null,
				"nama_produk"=> $rowData[$i][1],
				"slug_produk"=> slugify('produk',$rowData[$i][1]),
				"detil"=> '',
				"kondisi"=> 'baru',
				// "hits"=> 0,
				"created_at"=> $tanggal[$i]
			);
			$this->db->insert("dt_produk",$produk[$i]);
			 
			echo $idusaha[$i].'<br>';
			echo $i.'<br>';
			$i++;
		}
	}
	

	public function updateslug()
	{
		$q = $this->db->get('dt_produk');
		
		foreach ($q->result() as $d){
			$s = slugify('produk',$d->nama_produk);
			
			$in = array (
				'slug' => $s
			);
			$this->db->set('slug', $s);
			$this->db->where('id_produk', $d->id_produk);
			$this->db->update('dt_produk');
			echo $s.'<br>';
		}
	}

	public function tescari()
	{
		$this->load->helper('gisearch');
		$i = new gisearch("bata");
		//var_dump($i);
		echo '<a href="'. $i->get_source() .'"><img src="'. $i->get_link() .'" /> '. $i->get_title() .'</a>';
	}
	
    public function viewpetautama($id=0)
    {
		
		$this->load->library('googlemaps');
		$this->db->where('id_usaha', $id);
		$u = $this->db->get('dt_usaha')->row();
		
		$config['center'] = $u->la.','.$u->lo;
		$config['zoom'] = '16';
		$this->googlemaps->initialize($config);

		$marker = array();
		$marker['position'] = $u->la.','.$u->lo;
		$marker['icon'] = config_item('aset').'img/marker.png';
		$marker['animation'] = 'DROP';
		$marker['draggable'] = false;
		$marker['title'] = 'Lokasi usaha';
		$marker['ondragend'] = 'validepopupform(event.latLng.lat() + \',\' + event.latLng.lng());';
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();
		
		$this->load->view('usaha/viewpeta', $data);
		
    }
	
    public function viewpeta($id=0)
    {
		
		$this->load->library('googlemaps');
		$this->db->where('id_lokasi', $id);
		$u = $this->db->get('dt_lokasi_usaha')->row();
		
		$config['center'] = $u->la.','.$u->lo;
		$config['zoom'] = '16';
		$this->googlemaps->initialize($config);

		$marker = array();
		$marker['position'] = $u->la.','.$u->lo;
		$marker['icon'] = config_item('aset').'img/marker.png';
		$marker['animation'] = 'DROP';
		$marker['draggable'] = false;
		$marker['title'] = 'Lokasi usaha';
		$marker['ondragend'] = 'validepopupform(event.latLng.lat() + \',\' + event.latLng.lng());';
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();
		
		$this->load->view('usaha/viewpeta', $data);
		
    }
	
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usaha extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
		if( !$this->require_role('seller') )
		{
			redirect(LOGIN_PAGE);
		}
		$this->load->model('usaha_model');
    }

	public function index()
	{
		$this->is_logged_in();
		$d['udata'] = $this->web_model->udata($this->auth_user_id);
		$d['cabang'] = $this->usaha_model->cabang($d['udata']->id_usaha);
		
		$id_produk = $this->uri->segment(2);
		$d['jlh_produk'] = $this->usaha_model->jlh_produk($d['udata']->id_usaha);
		$d['info'] = $this->usaha_model->get_info($d['udata'],'seller');

		$d['sub_judul'] = 'Kelola '.$d['udata']->nama_usaha.' |';
		$d['css'] = array(
			config_item('aset').'custom/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'
		);
		$d['js'] = array(
			config_item('aset').'custom/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'
		);
		$coords = ($d['udata']->la=='')?'':$d['udata']->la.','.$d['udata']->lo;
		$d['viewpeta'] = $this->containerpeta($coords);
		$this->load->view('meta', $d);
		$this->load->view('header', $d);
		$this->load->view('usaha', $d);
		$this->load->view('footer', $d);
	}

	public function delcabang($id=0)
	{
		$this->db->where('id_lokasi', $id);
		$this->db->delete('dt_lokasi_usaha');
		redirect('usaha/cabang');
	}

	public function cabang()
	{
		$this->is_logged_in();
		$d['udata'] = $this->web_model->udata($this->auth_user_id);
		$d['cabang'] = $this->usaha_model->cabang($d['udata']->id_usaha);
		
		$id_produk = $this->uri->segment(2);
		$d['jlh_produk'] = $this->usaha_model->jlh_produk($d['udata']->id_usaha);
		$d['sub_judul'] = 'Kelola Cabang '.$d['udata']->nama_usaha.' |';
		$d['info'] = $this->usaha_model->get_info($d['udata'],'seller');
		
		$d['css'] = array(
			config_item('aset').'custom/jquery-confirm.min.css'
		);
		$d['js'] = array(
			config_item('aset').'custom/jquery-confirm.min.js'
		);
		
		$this->load->view('meta', $d);
		$this->load->view('header', $d);
		$this->load->view('cabang-usaha', $d);
		$this->load->view('footer', $d);
	}

	public function tambahcabang()
	{
		$data = $this->input->post(NULL, TRUE);
		$lokasi = explode(',',$data['lokasi']);
		$data['la'] = $lokasi[0];
		$data['lo'] = $lokasi[1];
		$data['created_at'] = gmdate("Y-m-d H:i:s", time() +60 * 60 * 7);
		unset($data['lokasi']);
		$this->db->insert('dt_lokasi_usaha', $data);
		redirect('usaha/cabang');
		//var_dump($data);
	}

	public function simpandata()
	{
		$this->is_logged_in();
		$data = $this->input->post(NULL, TRUE);
		$lokasi = explode(',',$data['lokasi']);
		$data['la'] = $lokasi[0];
		$data['lo'] = $lokasi[1];
		unset($data['lokasi']);
		if(empty($_FILES['cover']['name']))
		{
			//$data['cover'] = NULL;
		} else {
			$old_img = $this->db->where('id_usaha', $data['id_usaha'])->get('dt_usaha')->row()->cover;
			$config['upload_path'] = config_item('asetdir').'img/cover/';
			$config['allowed_types']= 'gif|jpg|png|jpeg';
			$parts     = explode('.', $_FILES['cover']['name']);
			$ext       = array_pop($parts);
			$find = array('_',' ','.');
			$new_name = gmdate("d-m-Y", time () +60 * 60 * 7).'_'.time().'_'.str_replace($find, '-',implode('-',$parts)).'.'.$ext;
			$config['file_name'] = $new_name;
			$config['overwrite']	= TRUE;
			$config['remove_spaces']	= TRUE;	
			$config['max_size']     = '3000';
			$config['max_width']  	= '3000';
			$config['max_height']  	= '3000';
			$field_name = "cover";
			$this->load->library('upload', $config);

			if ($this->upload->do_upload($field_name)) {
				$cvr = $this->upload->data();
				$this->load->library('thumb');
				$this->thumb->buat_kecil($cvr, config_item('asetdir')."img/cover/thumb/", config_item('asetdir')."img/cover/", 400);	
				$cover = $cvr['file_name'];
				$data['cover'] = $cover;
				unlink(config_item('asetdir').'img/cover/'.$old_img);
				unlink(config_item('asetdir').'img/cover/thumb/'.$old_img);
			} else {
				echo $this->upload->display_errors('<p>','</p>');
			}
		}
		
		$this->db->where('id_usaha', $data['id_usaha']);
		$this->db->set($data);
		$this->db->update('dt_usaha');
		
		redirect('usaha');
		
		// var_dump($data);
		// var_dump($_FILES['cover']);
		// echo '<pre>';
		// print_r($_POST);
		// print_r($_FILES);
	}
	
    public function setpetautama()
    {
		
		$this->load->library('googlemaps');

		$config = array();
		$config['center'] = $this->uri->segment(3) ?? '3.744014,98.446841';
		// $config['center'] = 'auto';
		$config['onboundschanged'] = '
		if (!centreGot) {
			var mapCentre = map.getCenter();
			marker_0.setOptions({
				position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
			});
		}
		centreGot = true;
		';
		// $config['zoom'] = '14';
		$this->googlemaps->initialize($config);

		$marker = array();
		// $marker['position'] = '3.744014,98.446841';
		$marker['icon'] = config_item('aset').'img/marker.png';
		$marker['animation'] = 'DROP';
		$marker['draggable'] = true;
		$marker['title'] = 'Geser penanda ini untuk menentukan lokasi usaha';
		$marker['ondragend'] = 'validepopupform(event.latLng.lat() + \',\' + event.latLng.lng());';
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();
		
		$this->load->view('usaha/setpeta', $data);
		
    }
	
    function containerpeta($coords)
    {
		
		$this->load->library('googlemaps');

		$config = array();
		$config['center'] = $coords;
		$config['onboundschanged'] = '
			if (!centreGot) {
				var mapCentre = map.getCenter();
				marker_0.setOptions({
					position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
				});
			}
			centreGot = true;
		';
		// $config['zoom'] = '14';
		$this->googlemaps->initialize($config);

		$marker = array();
		// $marker['position'] = '3.744014,98.446841';
		$marker['icon'] = config_item('aset').'img/marker.png';
		$marker['animation'] = 'DROP';
		$marker['draggable'] = true;
		$marker['title'] = 'Geser penanda ini untuk menentukan lokasi usaha';
		$marker['ondragend'] = 'validepopupform(event.latLng.lat() + \',\' + event.latLng.lng());';
		$this->googlemaps->add_marker($marker);
		return $this->googlemaps->create_map();
		
		// return $this->load->view('usaha/setpeta', $data, true);
		
    }
	
	
	
}
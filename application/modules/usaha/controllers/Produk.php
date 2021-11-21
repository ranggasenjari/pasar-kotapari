<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends MY_Controller {
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
		$d['sukses'] = $this->session->flashdata('sukses');
		$d['udata'] = $this->web_model->udata($this->auth_user_id);
		$d['cabang'] = $this->usaha_model->cabang($d['udata']->id_usaha);
		
		$d['info'] = $this->usaha_model->get_info($d['udata'],'seller');
		
		$id_produk = $this->uri->segment(2);
		$d['jlh_produk'] = $this->usaha_model->jlh_produk($d['udata']->id_usaha);
		if (!$this->agent->is_mobile()){
			$d['produk'] = $this->usaha_model->list_produk($d['udata']->id_usaha);
		} else {
			$d['produk'] = $this->usaha_model->list_produk_mobile($d['udata']->id_usaha);
		}

		$d['sub_judul'] = 'Kelola Produk '.$d['udata']->nama_usaha.' |';

		$this->load->view('meta', $d);
		$this->load->view('header', $d);
		$this->load->view('produk', $d);
		$this->load->view('footer', $d);
	}

	public function add()
	{
		$this->is_logged_in();
		$d['udata'] = $this->web_model->udata($this->auth_user_id);
		
		$id_produk = $this->uri->segment(2);
		$d['jlh_produk'] = $this->usaha_model->jlh_produk($d['udata']->id_usaha);

		$d['sub_judul'] = 'Kelola Produk '.$d['udata']->nama_usaha.' |';
		$d['css'] = array(
			config_item('aset').'custom/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'
		);
		$d['js'] = array(
			config_item('aset').'custom/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'
		);
		$this->load->view('meta', $d);
		$this->load->view('header', $d);
		$this->load->view('produk-tambah', $d);
		$this->load->view('footer', $d);
	}

	public function save_new()
	{
		$this->load->library('upload');
		$this->is_logged_in();
		$d['udata'] = $this->web_model->udata($this->auth_user_id);
		
		$in_data['id_usaha'] = $d['udata']->id_usaha;
		$in_data['slug_produk'] = slugify('produk',$this->input->post('nama'));
		$in_data['id_kat_produk'] = $this->input->post('kat');
		$in_data['nama_produk'] = $this->input->post('nama');
		$in_data['detil_produk'] = $this->input->post('detil');
		$in_data['kondisi'] = $this->input->post('kondisi');
		$in_data['created_at'] = date('Y-m-d H:i:s');
		$in_data['aktif'] = $this->input->post('status');
		$this->db->insert('dt_produk', $in_data);
		$id_produk = $this->db->insert_id();
		
		//Upload Foto(Multiupload)
        foreach($_FILES['foto_produk'] as $key=>$val)
        {
            $i = 1;
            foreach($val as $v)
            {
                $field_name = "foto_".$i;
                $_FILES[$field_name][$key] = $v;
                $i++;   
            }
        }
		unset($_FILES['foto_produk']);
		
		if (!is_dir(config_item('asetdir').'img/produk/'.$d['udata']->id_usaha)) {
			mkdir(config_item('asetdir').'img/produk/'.$d['udata']->id_usaha, 0777, TRUE);
		}
		
		if (!is_dir(config_item('asetdir').'img/produk/thumb/'.$d['udata']->id_usaha)) {
			mkdir(config_item('asetdir').'img/produk/thumb/'.$d['udata']->id_usaha, 0777, TRUE);
		}
		
		$filename_total = array();
		$i = 1;
        foreach($_FILES as $field_name => $file)
        {
			$this->load->library('thumb');
			$parts     = explode('.', $_FILES["foto_".$i]['name']);
			$ext       = array_pop($parts);
			$find = array('_',' ','.',',');
			$new_name = gmdate("d-m-Y", time () +60 * 60 * 7).'_'.time().'_'.$id_produk.'_'.str_replace($find, '-',implode('-',$parts)).'.'.$ext;
			$upload_lampiran = array(
				'upload_path'   => config_item('asetdir').'img/produk/'.$d['udata']->id_usaha,
				'allowed_types' => 'jpg|png|jpeg',
				'max_size'      => '51200',
				'overwrite'     => TRUE,
				'file_name'     => $new_name
            );
			$this->upload->initialize($upload_lampiran);
			if ($this->upload->do_upload("foto_".$i)) {
				$data	 	= $this->upload->data();
				$this->thumb->buat_kecil($data, config_item('asetdir').'img/produk/thumb/'.$d['udata']->id_usaha, config_item('asetdir').'img/produk/'.$d['udata']->id_usaha.'/', 240);
				$filename = $data['file_name'];
			}
			$i++;
			
			$ft_data['id_produk'] = $id_produk;
			$ft_data['foto'] = $data['file_name'];
			$ft_data['created_at'] = $in_data['created_at'];
			$this->db->insert('dt_foto_produk', $ft_data);
        }
		
		$this->session->set_flashdata('sukses', true);
		redirect('usaha/produk');
	}

	public function del()
	{
		$id = $this->uri->segment(4);
		$this->db->where('id_produk', $id)->delete('dt_produk');
		redirect('usaha/produk');
	}

}
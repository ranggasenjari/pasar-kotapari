<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

    public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();
    }

    function num_select($id_kat,$key,$val)
	{
		// $keyword = mysqli_real_escape_string(get_instance()->db->conn_id,$q);
		$this->db->select("dt_produk.*, dt_usaha.*, districts.name as kec, villages.name as des");
		$this->db->from('dt_produk');
		$this->db->join('dt_usaha', 'dt_produk.id_usaha = dt_usaha.id_usaha', 'left');
		$this->db->join('districts', 'dt_usaha.id_kecamatan = districts.id', 'left');
		$this->db->join('villages', 'dt_usaha.id_desa = villages.id', 'left');
		// $this->db->where("MATCH(nama_produk) AGAINST('".$keyword."')");
		$this->db->where('id_kat_produk',$id_kat);
		$this->db->where($key,$val);
		return $this->db->get()->num_rows();
	}
	
    function kategori_produk($kat_name,$filter,$offset,$sort)
	{
		$hasil ="";
		$auto =0;
		$limit =30;
		
		//autograb google image
		if ($auto==1){
			$this->load->helper('gisearch');
		}
		$this->load->model('usaha/usaha_model');
		
		//pengaturan kolom untuk browser PC & mobile
		if ($this->agent->is_mobile()){$col=6;}else{$col=2;};
		
		//kueri pencarian produk
		// $keyword = mysqli_real_escape_string(get_instance()->db->conn_id,$key);
		$this->db->select("dt_produk.*, dt_usaha.*, districts.name as kec, villages.name as des");
		$this->db->from('dt_produk');
		$this->db->join('dt_usaha', 'dt_produk.id_usaha = dt_usaha.id_usaha', 'left');
		$this->db->join('districts', 'dt_usaha.id_kecamatan = districts.id', 'left');
		$this->db->join('villages', 'dt_usaha.id_desa = villages.id', 'left');
		// $this->db->where("MATCH(nama_produk) AGAINST('".$keyword."')");
		
		$this->db->where(array_filter($filter));
		
		$this->db->limit($limit,$offset);
		if ($sort == 2){
			$this->db->order_by('created_at','desc');
		} else if ($sort == 3){
			$this->db->order_by('created_at','asc');
		} else if ($sort == 4){
			$this->db->order_by('(hits_pc+hits_mobile+hits_others) desc');
		} else {
			$this->db->order_by('created_at','desc');
		}
		$q = $this->db->get();
		
		$this->db->select("dt_produk.*, dt_usaha.*, districts.name as kec, villages.name as des");
		$this->db->from('dt_produk');
		$this->db->join('dt_usaha', 'dt_produk.id_usaha = dt_usaha.id_usaha', 'left');
		$this->db->join('districts', 'dt_usaha.id_kecamatan = districts.id', 'left');
		$this->db->join('villages', 'dt_usaha.id_desa = villages.id', 'left');
		// $this->db->where("MATCH(nama_produk) AGAINST('".$keyword."')");
		$this->db->where(array_filter($filter));
		$t = $this->db->get()->num_rows();

       $hasil .='<div class="box-header ">
          <h3 class="box-title">Hasil pencarian untuk kategori "'.urldecode($kat_name).'" ('.$t.' hasil)</h3>
        </div>
		<div class="box-body">
			<div class="row">';
		
		//Kalau ada hasil, cetak produk. Kalau tidak ada hasil, cetak pesan kosong
	if ($q->num_rows() > 0){
		
		foreach ($q->result() as $d){
			
		// $u = $this->db->query('
		// select a.*, b.name as kec, c.name as des
		// from dt_usaha a
		// left join districts b on a.id_kecamatan = b.id
		// left join villages c on a.id_desa = c.id
		// where a.id_usaha = '.$d->id_usaha
		// )->row();
		
		//pengaturan panjang nama produk
		$panjang = strlen(utf8_decode($d->nama_produk));
		if ($panjang <= 38){
			$titiknama = '';
		} else {
			$titiknama = '...';
		}
		//pengaturan panjang nama desa/kelurahan
		$panjangdes = strlen(utf8_decode($d->des));
		if ($panjangdes <= 28){
			$titikdes = '';
		} else {
			$titikdes = '...';
		}
		//status verifikasi usaha
		if ($d->verifikasi == 1){
			$v = '<span class="label pull-right" style="background-color: #7bdbf3 !important;"><i class="fa fa-check" aria-hidden="true"></i></span>';
		} else {
			$v = '';
		}
		//autograb google image
		if ($auto==1){
			$i = new gisearch($d->nama_produk);
		}
		
		@$foto = $this->db->where('id_produk', $d->id_produk)->get('dt_foto_produk')->row()->foto;
		
        $hasil .='<div class="col-xs-'.$col.'">
				<div class="box box-solid box-default produk-box">
				<a href="'.base_url('item/'.$d->id_produk.'/'.$d->slug_usaha.'/'.$d->slug_produk).'" style="color: #717171;">';
				
				//autograb google image
				if ($auto==1){
					$hasil .='<div class="search-result" style="background-image: url(\''. $i->get_link() .'\');">';
				} else if ($foto && ($foto != '' || $foto != null) ){
					$hasil .='<div class="search-result" style="background-image: url(\''.config_item('aset').'img/produk/thumb/'.$d->id_usaha.'/'.$foto.'\');">';
				} else {
					$hasil .='<div class="search-result" style="background-image: url(\''.config_item('aset').'img/noimg.png\');">';
				}
		
		$hasil .= $v.'</div>
                    <div class="box-body with-border" style="height:56px;">
					'.substr(strip_tags($d->nama_produk),0,38).$titiknama.'
					</div></a>
					<div class="box-footer text-muted">
					 <span class="direct-chat-timestamp pull-left">
					 <a href="'.base_url('usaha/'.$d->id_usaha.'/'.$d->slug_usaha).'"><small><i class="fa fa-home" aria-hidden="true"></i> '.$d->nama_usaha.' </small></a><br/>
					 <small style="font-size: 70%;"> '.ucwords(strtolower(substr(strip_tags($d->des),0,28))).$titikdes.' <br/> Kec. '.ucwords(strtolower($d->kec)).'</small>
					 </span>
					 <span class="direct-chat-timestamp pull-right">
					 <br/>
					 <br/>
					 <small style="font-size: 70%;"><i class="fa fa-eye" aria-hidden="true"></i> '.$this->usaha_model->total_hits('all',$d->id_usaha).'</small>
					 </span>
					</div>
                </div>
            </div>';
		}
		
		$hasil .= '	</div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center">';

		//Paging
		$this->load->library('pagination');
		$config['base_url'] = urltrim(currenturl(), 'p');
		$config['full_tag_open'] = '<ul class="pagination pagination-sm inline">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['total_rows'] = $t;
		$config['per_page'] = $limit;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'p';
		$this->pagination->initialize($config);
		
		$hasil .= $this->pagination->create_links();
        $hasil .= '	</div>';

		
	} else {
		$hasil .='<div class="col-xs-12"><h4>Tidak ada hasil untuk kategori "'.urldecode($kat_name).'"</h4></div>';
	}
		$hasil .= '	</div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center">';
        $hasil .= '	</div>';
		return $hasil;
	}
	
    function cari_toko($key,$filter,$sort)
	{
		$hasil ="";
		
		if ($this->agent->is_mobile()){$col=12;}else{$col=3;};
		
		$keyword = mysqli_real_escape_string(get_instance()->db->conn_id,$key);
		$this->db->select("dt_usaha.*, dt_produk.hits_pc, dt_produk.hits_mobile, dt_produk.hits_others, districts.name as kec, villages.name as des, usr_users.id_kecamatan as idkec_user, usr_users.id_desa as iddesa_user, usr_users.*");
		$this->db->from('dt_usaha');
		$this->db->join('dt_produk', 'dt_produk.id_usaha = dt_usaha.id_usaha', 'left');
		$this->db->join('districts', 'dt_usaha.id_kecamatan = districts.id', 'left');
		$this->db->join('villages', 'dt_usaha.id_desa = villages.id', 'left');
		$this->db->join('usr_users', 'dt_usaha.id_pemilik = usr_users.user_id', 'left');
		$this->db->group_by('dt_usaha.id_usaha');
		$this->db->where("MATCH(dt_usaha.nama_usaha,dt_usaha.detil) AGAINST('".$keyword."')");
		
		$this->db->where(array_filter($filter));
		
		if ($sort == 2){
			$this->db->order_by('tgl_publish','desc');
		} else if ($sort == 3){
			$this->db->order_by('tgl_publish','asc');
		} else if ($sort == 4){
			$this->db->order_by('(hits_pc+hits_mobile+hits_others) desc');
		}
		$q = $this->db->get();

       $hasil .='<div class="box-header ">
          <h3 class="box-title">Hasil pencarian untuk "'.$key.'" ('.$q->num_rows().' hasil)</h3>
        </div>
		<div class="box-body">
			<div class="row">';
		
		//Kalau ada hasil, cetak produk. Kalau tidak ada hasil, cetak pesan kosong
	if ($q->num_rows() > 0){
		
		foreach ($q->result() as $d){
			
		// $u = $this->db->query('
		// select a.*, b.name as kec, c.name as des
		// from dt_usaha a
		// left join districts b on a.id_kecamatan = b.id
		// left join villages c on a.id_desa = c.id
		// where a.id_usaha = '.$d->id_usaha
		// )->row();
		
		//pengaturan panjang nama produk
		$panjang = strlen(utf8_decode($d->nama_usaha));
		if ($panjang <= 38){
			$titiknama = '';
		} else {
			$titiknama = '...';
		}
		//pengaturan panjang nama desa/kelurahan
		$panjangdes = strlen(utf8_decode($d->des));
		if ($panjangdes <= 28){
			$titikdes = '';
		} else {
			$titikdes = '...';
		}
		//status verifikasi usaha
		if ($d->verifikasi == 1){
			$v = '<span class="label pull-right" style="background-color: #7bdbf3 !important;"><i class="fa fa-check" aria-hidden="true"></i></span>';
		} else {
			$v = '';
		}
		
        $hasil .='<div class="col-xs-'.$col.'">
				<div class="box box-solid box-default produk-box">
				<a href="'.base_url('usaha/'.$d->id_usaha.'/'.$d->slug_usaha).'" style="color: #717171;">';
		if ($d->cover != NULL){
			$hasil .='<div class="toko-result" style="background-image: url(\''.$this->config->item('aset').'img/cover/'.$d->cover.'\');">';
		} else {
			$hasil .='<div class="toko-result" style="background-image: url(\'https://placehold.it/400x150/'.random_color().'/ffffff&amp;text='.urlencode($d->nama_usaha).'\');">';
		}
				
		$hasil .= $v.'</div></a>
					<div class="box-footer text-muted">
					 <span class="direct-chat-timestamp pull-left">
					 <a href="'.base_url('usaha/'.$d->id_usaha.'/'.$d->slug_usaha).'"><small><i class="fa fa-home" aria-hidden="true"></i> '.substr(strip_tags($d->nama_usaha),0,38).$titiknama.' </small></a><br/>
					 <small style="font-size: 70%;"> '.ucwords(strtolower(substr(strip_tags($d->des),0,28))).$titikdes.' <br/> Kec. '.ucwords(strtolower($d->kec)).'</small>
					 </span>
					 <span class="direct-chat-timestamp pull-right">
					 <br/><small style="font-size: 70%;" class="pull-right"><i class="fa fa-eye" aria-hidden="true"></i> '.($d->hits_pc+$d->hits_mobile+$d->hits_others).'</small>
					 <br/><a href="#" style="color: #717171;">
					 <small style="font-size: 70%;">Lihat peta  <i class="fa fa-map-o" aria-hidden="true"></i></small>
					 </a>
					 </span>
					</div>
                </div>
            </div>';
		}
		
		$hasil .= '	</div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center">';
        $hasil .= '	</div>';

		
	} else {
		$hasil .='<div class="col-xs-12"><h4>Tidak ada hasil untuk '.$keyword.'</h4></div>';
	}
		$hasil .= '	</div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center">';
        $hasil .= '	</div>';
		return $hasil;
	}

    function get_kec_filter($key)
	{
		$hasil ="";
		$hasil .='<div class="form-group">
                <label>Kecamatan</label>
                <select id="kec" name="kec" class="form-control input-sm" data-placeholder="Semua Kecamatan" style="width: 100%;">';
		$hasil .='<option value="">- Semua Kecamatan -</option>';
		$q = $this->db->get('districts');
		$i=1;
		foreach ($q->result() as $d){
			$num[$i] = $this->num_select($key,'id_kecamatan',$d->id);
			$hasil .='<option value="'.$d->id.'">'.$d->name.' ('.$num[$i].')</option>';
			$i++;
		}
		$hasil .='</select>
				</div>';
		
		return $hasil;
	}

    function get_kond_filter($key)
	{
		$hasil ="";
		$hasil .='<div class="form-group">
                <label>Kondisi</label>
                <select id="kondisi" class="form-control input-sm" placeholder="Semua status" style="width: 100%;">
                  <option value="">- Semua kondisi -</option>';

		$baru = $this->num_select($key,'kondisi','baru');
		$bekas = $this->num_select($key,'kondisi','bekas');
		$hasil .='<option value="baru">Baru ('.$baru.')</option>';
		$hasil .='<option value="bekas">Bekas ('.$bekas.')</option>';

		$hasil .='</select>
				</div>';
		
		return $hasil;
	}

    function get_kat_filter($key)
	{
		$hasil ="";
		$hasil .='<div class="form-group">
				<label>Kategori Produk</label>
				<select id="katproduk" name="katproduk" class="form-control input-sm" data-placeholder="Semua Kategori" style="width: 100%;">
				<option value="">-- Semua Kategori --</option>';
		$q = $this->db->get('dt_kat_produk');
		$i=1;
		foreach ($q->result() as $d){
			$num[$i] = $this->num_select($key,'id_kat_produk',$d->id_kat_produk);
			$hasil .='<option value="'.$d->id_kat_produk.'">'.$d->uraian.' ('.$num[$i].')</option>';
			$i++;
		}
		$hasil .='</select>
				</div>';
		
		return $hasil;
	}

	function update_counter($slug) {
		
		if ($this->agent->is_mobile()){
			$this->db->select('hits_mobile');
		} else if ($this->agent->is_browser()){
			$this->db->select('hits_pc');
		} else {
			$this->db->select('hits_others');
		}
		$this->db->where('keywords', urldecode($slug));
		$count = $this->db->get('dt_cari');
		
		if ($count->num_rows()==0){
			$this->load->helper('gisearch');
			$i = new gisearch($slug.' jpg');
			$img = config_item('asetdir').'img/gisearch/'.slugifyonly($slug).'.jpg';
			file_put_contents($img, getimg($i->get_link()));
			$this->load->library('thumb');
			$this->thumb->resize(config_item('asetdir').'img/gisearch/'.slugifyonly($slug).'.jpg', 200, 200);
			
			$in['keywords'] = urldecode($slug);
			$in['rand_img'] = slugifyonly($slug).'.jpg';
			if ($this->agent->is_mobile()){
				$in['hits_mobile'] = 1;
			} else if ($this->agent->is_browser()){
				$in['hits_pc'] = 1;
			} else {
				$in['hits_others'] = 1;
			}
			$this->db->insert('dt_cari', $in);
		} else {
			$this->db->where('keywords', urldecode($slug));
			if ($this->agent->is_mobile()){
				$this->db->set('hits_mobile', ($count->row()->hits_mobile + 1));
			} else if ($this->agent->is_browser()){
				$this->db->set('hits_pc', ($count->row()->hits_pc + 1));
			} else {
				$this->db->set('hits_others', ($count->row()->hits_others + 1));
			}
			$this->db->update('dt_cari');
		}
	}
	
	function get_hits($jenis,$id) {
		
		$this->db->where('keywords', urldecode($slug));
		$this->db->select('hits');
		$count = $this->db->get('dt_cari');
		if ($count->num_rows()==0){
			$this->load->helper('gisearch');
			$i = new gisearch($slug.' jpg');
			$img = config_item('asetdir').'img/gisearch/'.slugifyonly($slug).'.jpg';
			file_put_contents($img, getimg($i->get_link()));
			$this->load->library('thumb');
			$this->thumb->resize(config_item('asetdir').'img/gisearch/'.slugifyonly($slug).'.jpg', 80, 80);
			
			$in['keywords'] = urldecode($slug);
			$in['rand_img'] = slugifyonly($slug).'.jpg';
			$in['hits'] = 1;
			$this->db->insert('dt_cari', $in);
		} else {
			$this->db->where('keywords', urldecode($slug));
			$this->db->set('hits', ($count->row()->hits + 1));
			$this->db->update('dt_cari');
		}
	}
}
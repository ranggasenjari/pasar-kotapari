<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usaha_model extends CI_Model {

    public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();
    }

    function kat_usaha($sel)
	{
		$hasil ='';
		$q = $this->db->get('dt_kat_usaha');
		foreach ($q->result() as $kat ){
			$hasil .= '<option value="'.$kat->id_kat_usaha.'" ';
			if ($kat->id_kat_usaha == $sel) {
				$hasil .= 'selected';
			}
			$hasil .='>'.$kat->uraian.'</option>';
		}
		return $hasil;
	}

    function jlh_produk($id_usaha)
	{
		$hasil ='';
		$this->db->where('id_usaha', $id_usaha);
		$hasil = $this->db->get('dt_produk')->num_rows();
		return $hasil;
	}

    function cabang($id_usaha)
	{
		$hasil ='';
		$this->db->select('dt_lokasi_usaha.*, districts.name as kec, villages.name as des');
		$this->db->from('dt_lokasi_usaha');
		$this->db->join('districts', 'dt_lokasi_usaha.id_kec = districts.id', 'left');
		$this->db->join('villages', 'dt_lokasi_usaha.id_des = villages.id', 'left');
		$this->db->where('id_usaha', $id_usaha);
		$this->db->order_by('created_at', 'asc');
		$hasil = $this->db->get();
		return $hasil;
	}
	
	function total_hits($jenis,$id_usaha)
	{
		$m=0;$p=0;$o=0;$t=0;
		$this->db->where('id_usaha', $id_usaha);
		$q = $this->db->get('dt_produk');
			
		foreach ($q->result() as $s){
			$m += $s->hits_mobile;
			$p += $s->hits_pc;
			$o += $s->hits_others;
			$t += $s->hits_pc+$s->hits_mobile+$s->hits_others;
		}
		if ($jenis=='mobile'){
			return $m;
		} else if ($jenis=='pc'){
			return $p;
		} else if ($jenis=='others'){
			return $o;
		} else if ($jenis=='all'){
			return $t;
		}
	}
	
	function udata($id)
	{
		$hasil="";
		
		$q = $this->db->query("
			SELECT 	a.*, 
					b.id_kecamatan as usr_kec, 
					b.id_desa as usr_desa,
					b.*,
					c.name as kecuser,
					d.name as desauser
			FROM 
			(
				SELECT 	a.*, 
						b.id_kat_usaha as id_kat, 
						b.uraian 
				FROM 
				(
					SELECT 	a.id_kecamatan as usaha_kec,
							a.id_desa as usaha_desa,
							a.*,
							b.name AS kecusaha, 
							c.name AS desusaha 
					FROM dt_usaha a 
					INNER JOIN districts b on a.id_kecamatan = b.id 
					INNER JOIN villages c on a.id_desa = c.id
				) a 
				LEFT JOIN dt_kat_usaha b on a.id_kat_usaha = b.id_kat_usaha
			) a 
			LEFT JOIN usr_users b on a.id_pemilik = b.user_id
			INNER JOIN districts c on a.id_kecamatan = c.id 
			INNER JOIN villages d on a.id_desa = d.id
			WHERE a.id_usaha = $id
		");
		
		return $q->row();
	}
	

    function get_kond_filter($id)
	{
		$hasil ="";
		$hasil .='<div class="form-group">
                <label>Kondisi</label>
                <select id="kondisi" class="form-control input-sm" placeholder="Semua status" style="width: 100%;">
                  <option value="">- Semua kondisi -</option>';

		$baru = $this->num_select($id,'kondisi','baru');
		$bekas = $this->num_select($id,'kondisi','bekas');
		$hasil .='<option value="baru">Baru ('.$baru.')</option>';
		$hasil .='<option value="bekas">Bekas ('.$bekas.')</option>';

		$hasil .='</select>
				</div>';
		
		return $hasil;
	}

    function get_info($udata,$type)
	{
		$hasil ="";
		
		$hasil .='<div class="col-sm-12 invoice-col no-padding">
			<div class="box box-info">
				<div class="box-header ui-sortable-handle">
				  <h3 class="box-title">Informasi Umum</h3>
				</div>
				<div class="box-body no-padding">
					<div class="col-sm-9 table-responsive no-padding">
					  <table class="table table-striped table-bordered">
						<tbody>
						<tr>
						  <td ><i class="fa fa-info-circle"></i> Status Usaha</td>
						  <td >';
						  if ($udata->status_terbit==1){
							  $hasil .='<span class="label label-success">Aktif</span>';
						  } else {
							  $hasil .='<span class="label label-warning">Nonaktif</span>';
						  }
						$hasil .='</td>
						  <td ><i class="far fa-calendar"></i> Bergabung</td>
						  <td >'.date('d-m-Y',strtotime($udata->tgl_publish)).'</td>
						</tr>
						<tr>
						  <td ><i class="far fa-check-square"></i> Status Verifikasi</td>
						  <td >';
						  if ($udata->verifikasi==1){
							  $hasil.='<span class="label label-success">Terverifikasi</span>';
						  } else {
							  $hasil.='<span class="label label-default">Belum terverifikasi</span>';
						  }
						$hasil .='</td>
						  <td ><i class="far fa-user"></i> Nama Usaha / Toko</td>
						  <td ><a href="'.base_url('usaha/'.$udata->id_usaha.'/'.$udata->slug_usaha).'">'.$udata->nama_usaha.'</a></td>
						</tr>
						<tr>
						  <td ><i class="fa fa-shopping-cart"></i> Jumlah Produk</td>
						  
						  <td >'.$this->usaha_model->jlh_produk($udata->id_usaha).' item ';
						  if ($type == 'seller'){
						  $hasil .='<a href="'.base_url('usaha/produk').'"> <span class="small label label-info"><i class="fa fa-arrow-right"></i></span></a>';
						  }
						 $hasil .= '</td><td ><i class="far fa-building"></i> Cabang Usaha </td>
						  <td > <p class="text-muted">'.$this->usaha_model->cabang($udata->id_usaha)->num_rows().' cabang &nbsp;';
						  if ($type == 'seller'){
						  $hasil .='<a href="'.base_url('usaha/cabang').'"><button type="button" class="btn btn-default btn-xs"><i class="fa fa-plus"></i> Kelola cabang</button></a>';
						  }
						 $hasil .= '</p></td></tr>
						
						</tbody>
					  </table>
					  
					</div>
					<div class="col-sm-3 table-responsive">
						<div class="row">
							<div class="col-md-8 no-padding">
							  <div class="chart-responsive">
								<canvas id="pieChart" height="87" width="146" style="width: 146px; height: 87px;"></canvas>
							  </div>
								<p class="text-muted text-center"><small>Total: '.$this->usaha_model->total_hits('all',$udata->id_usaha).' kali produk dilihat</small></p>
							</div>
							<!-- /.col -->
							<div class="col-md-4 no-padding">
							  <ul class="chart-legend clearfix">
								<li><i class="fa fa-circle text-green"></i> Mobile</li>
								<li><i class="fa fa-circle text-aqua"></i> PC</li>
								<li><i class="fa fa-circle text-gray"></i> Lainnya</li>
							  </ul>
							</div>
							<!-- /.col -->
						</div>					  
					</div>
			
			
				</div>
				<div class="box-footer clearfix">
				
				</div>
			</div>
		  
        </div>
        <!-- /.col -->
		';
		
		return $hasil;
	}

    function get_kat_filter($id)
	{
		$hasil ="";
		$hasil .='<div class="form-group">
				<label>Kategori Usaha</label>
				<select id="katproduk" name="katproduk" class="form-control input-sm" data-placeholder="Semua Kategori" style="width: 100%;">
				<option value="">-- Semua Kategori --</option>';
		$q = $this->db->get('dt_kat_produk');
		$i=1;
		foreach ($q->result() as $d){
			$num[$i] = $this->num_select($id,'id_kat_produk',$d->id_kat_produk);
			$hasil .='<option value="'.$d->id_kat_produk.'">'.$d->uraian.' ('.$num[$i].')</option>';
			$i++;
		}
		$hasil .='</select>
				</div>';
		
		return $hasil;
	}
	
    function num_select($id,$key,$val)
	{
		$this->db->select("*");
		$this->db->from('dt_produk');
		$this->db->where('aktif',1);
		$this->db->where('id_usaha',$id);
		$this->db->where($key,$val);
		return $this->db->get()->num_rows();
	}
	
    function list_produk($id_usaha)
	{
		$hasil = "";
		
		$this->db->where('id_usaha', $id_usaha);
		$q = $this->db->get('dt_produk');
		$i = 1;
		foreach ($q->result() as $d){
		
			$hasil .= '<tr>
					  <td>'.$i.'</td>
					  <td width="15%">';
		
					$this->db->where('id_produk', $d->id_produk);
					$this->db->order_by('created_at', 'desc');
					$ft = $this->db->get('dt_foto_produk');
					
					foreach ($ft->result() as $f){
		
						$hasil .= '<div style="width: 33.33%;float: left;padding: 3px;">
						<div class="populer-search" style=\'background-image: url("'.config_item('aset').'img/produk/thumb/'.$id_usaha.'/'.$f->foto.'");\'></div>
						</div>';
					}
					
			 $hasil .= '</td>
					  <td width="30%">'.$d->nama_produk.'<br>
						<span style="color: #999;">
                        '.$this->db->where('id_kat_produk', $d->id_kat_produk)->get('dt_kat_produk')->row()->uraian.'<br>
						'.($d->hits_mobile+$d->hits_pc+$d->hits_others).' kali dilihat
						</span>
						
					  </td>
					  <td><span class="text-'.( ($d->kondisi=='baru') ? 'default' : 'gray' ).'">'.$d->kondisi.'</span></td>
					  <td>'.generate_tanggal($d->created_at).'</td>
					  
					  <td>'.( ($d->aktif==1) ? '<button type="button" class="btn btn-success btn-xs"> Aktif </button>' : '<button type="button" class="btn btn-default btn-xs"><i class="fa fa-ban"></i> </button>' ).'</td>
					  <td>
					  
					  <span class="btn btn-default btn-xs">
					  <i class="fa fa-edit"></i>
					  Ubah
					  </span>
					  
					  <a class="delProduk" href="'.base_url('usaha/produk/del/'.$d->id_produk).'">
					  <span class="btn btn-warning btn-xs">
					  <i class="fa fa-trash"></i>
					  Hapus
					  </span>
					  </a>
					  
					  </td>
					</tr>';	
			$i++;
		}
				
		return $hasil;
	}
	
    function list_produk_mobile($id_usaha)
	{
		$hasil = "";
		
		$this->db->where('id_usaha', $id_usaha);
		$q = $this->db->get('dt_produk');
		$i = 1;
		foreach ($q->result() as $d){
		
			$hasil .= '<tr>
					  <td>'.$i.'</td>
					  <td width="40%">';
		
					$this->db->where('id_produk', $d->id_produk);
					$this->db->order_by('created_at', 'desc');
					$ft = $this->db->get('dt_foto_produk');
					
					foreach ($ft->result() as $f){
		
						$hasil .= '<div style="width: 33.33%;float: left;padding: 3px;">
						<div class="populer-search" style=\'background-image: url("'.config_item('aset').'img/produk/thumb/'.$id_usaha.'/'.$f->foto.'");\'></div>
						</div>';
					}
					
			 $hasil .= '</td>
					  <td width="50%"><strong>'.$d->nama_produk.'</strong> <br/>
					  <small>
					  Kategori: '.$this->db->where('id_kat_produk', $d->id_kat_produk)->get('dt_kat_produk')->row()->uraian.'<br/>
					  Kondisi: <span class="text-'.( ($d->kondisi=='baru') ? 'default' : 'gray' ).'">'.$d->kondisi.'</span><br/>
					  '.($d->hits_mobile+$d->hits_pc+$d->hits_others).' <i class="fa fa-eye" aria-hidden="true"></i>
					  
					  <br/>
					  '.generate_tanggal($d->created_at).'<br/>
					  <span class="btn btn-default btn-xs">
					  <i class="fa fa-edit"></i>
					  Ubah
					  </span>
					  
					  <a class="delProduk" href="'.base_url('usaha/produk/del/'.$d->id_produk).'">
					  <span class="btn btn-warning btn-xs">
					  <i class="fa fa-trash"></i>
					  Hapus
					  </span>
					  </a>
					  
					  </small>
					  </td>
					</tr>';	
			$i++;
		}
				
		return $hasil;
	}
	
    function produk($id,$filter,$offset,$sort)
	{
		$hasil ="";
		$limit =30;
		
		
		//pengaturan kolom untuk browser PC & mobile
		if ($this->agent->is_mobile()){$col=6;}else{$col=3;};
		
		//kueri pencarian produk
		$this->db->select("dt_produk.id_usaha as idusaha, dt_produk.*, dt_usaha.*, districts.name as kec, villages.name as des");
		$this->db->from('dt_produk');
		$this->db->join('dt_usaha', 'dt_produk.id_usaha = dt_usaha.id_usaha', 'left');
		$this->db->join('districts', 'dt_usaha.id_kecamatan = districts.id', 'left');
		$this->db->join('villages', 'dt_usaha.id_desa = villages.id', 'left');
		$this->db->where("`dt_produk`.`id_usaha` = $id");
		
		$this->db->where(array_filter($filter));
		
		$this->db->limit($limit,$offset);
		if ($sort == 2){
			$this->db->order_by('created_at','desc');
		} else if ($sort == 3){
			$this->db->order_by('created_at','asc');
		} else if ($sort == 4){
			$this->db->order_by('(hits_pc+hits_mobile+hits_others) desc');
		}
		$q = $this->db->get();
		
		$this->db->select("dt_produk.*, dt_usaha.*, districts.name as kec, villages.name as des");
		$this->db->from('dt_produk');
		$this->db->join('dt_usaha', 'dt_produk.id_usaha = dt_usaha.id_usaha', 'left');
		$this->db->join('districts', 'dt_usaha.id_kecamatan = districts.id', 'left');
		$this->db->join('villages', 'dt_usaha.id_desa = villages.id', 'left');
		$this->db->where("`dt_produk`.`id_usaha` = $id");
		$this->db->where(array_filter($filter));
		$t = $this->db->get()->num_rows();

       $hasil .='<div class="row">';
		
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

		
        $hasil .='<div class="col-xs-'.$col.'">
				<div class="box box-solid box-default produk-box">
				<a href="'.base_url('item/'.$d->id_produk.'/'.$d->slug_usaha.'/'.$d->slug_produk).'" style="color: #717171;">';
				
		$ft = $this->db->where('id_produk', $d->id_produk)->get('dt_foto_produk');
		if ($ft->num_rows() == 0){
			$img = config_item('aset').'/img/noimg.png';
		} else {
			$img = config_item('aset').'/img/produk/'.$d->id_usaha.'/'.$ft->row()->foto;
		}
			
		$hasil .='<div class="search-result" style="background-image: url(\''.$img.'\');"></div>
                    <div class="box-body with-border" style="height:56px;">
					'.substr(strip_tags($d->nama_produk),0,38).$titiknama.'
					</div></a>
					<div class="box-footer text-muted">
					 <span class="direct-chat-timestamp pull-right">
					 <small style="font-size: 70%;"><i class="fa fa-eye" aria-hidden="true"></i> '.($d->hits_pc+$d->hits_mobile+$d->hits_others).'</small>
					 </span>
					</div>
                </div>
            </div>';
		}
		
		$hasil .= '	</div>
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

		
	} else {
		$hasil .='<div class="col-xs-12"><h4>Tidak ada produk</h4></div>';
	}
        $hasil .= '	</div>';
		return $hasil;
	}
	
}
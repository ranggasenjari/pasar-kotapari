<?php

class Web_model extends CI_Model {


	function get_berita($jumlah)
	{
		$hasil ="";
		
		$url = 'https://api-berita-indonesia.vercel.app/merdeka/terbaru';
		$contents = file_get_contents($url);
		$contents = utf8_encode($contents);
		$results = json_decode($contents, true); 
		if ($results['success']==true) {
			foreach ($results['data']['posts'] as $d) {
				$dt = new DateTime($d['pubDate']);
			$hasil .='<li class="li-kat" style="max-width: 80px;">
			<a target="_blank" href="'.$d['link'].'">
				<div class="img-news" style=\'background-image: url("'.$d['thumbnail'].'");margin-right: 5px;background-size: cover;\'>
				</div>
			</a>
			</li>
			<li class="li-news" style="max-width: 190px;">
				<div class="img-kat2">
				<a target="_blank" href="'.$d['link'].'">
				<h6 style="margin-right: 15px;"> <strong>'.strip_tags(substr($d['title'],0,58)).'</strong></h6></a>
				<small class="text-muted">'.$dt->format('d-m-Y').'</small>
				</div>
			</li>';
			}
		}

		return $hasil;
		
	}

	// function get_berita($jumlah)
	// {
	// 	$hasil ="";
		
	// 	$url = 'https://api.langkatkab.go.id/index.php/web_main/berita?n=10';
	// 	$contents = file_get_contents($url);
	// 	$contents = utf8_encode($contents);
	// 	$results = json_decode($contents); 
		
	// 	foreach ($results as $d) {
	// 	$hasil .='<li class="li-kat" style="max-width: 80px;">
	// 	<a target="_blank" href="https://www.langkatkab.go.id/berita/'.$d->id.'/'.url_title(strtolower($d->judul)).'">
	// 		<div class="img-news" style=\'background-image: url("https://www.langkatkab.go.id/aset/img_berita/thumb/'.$d->img.'");margin-right: 5px;background-size: cover;\'>
	// 		</div>
	// 	</a>
	// 	</li>
	// 	<li class="li-news" style="max-width: 190px;">
	// 		<div class="img-kat2">
	// 		<a target="_blank" href="https://www.langkatkab.go.id/berita/'.$d->id.'/'.url_title(strtolower($d->judul)).'">
	// 		<h6 style="margin-right: 15px;"> <strong>'.strip_tags(substr($d->judul,0,58)).'</strong></h6></a>
	// 		<small class="text-muted">'.generate_tanggal($d->terbit,'tgl').'<br/>
	// 		Dibaca: '.$d->hits.' kali</small>
	// 		</div>
	// 	</li>';
	// 	}

	// 	return $hasil;
		
	// }
	
	function komoditas()
	{
		$hasil="";
		$hasil .='<h4>KOMODITAS POKOK  <a target="_blank" href="http://www.hargasumut.org/tabel-harga-komoditi/10"><small class="text-primary">Lihat semua > </small></a></h4>';

		$hasil .='<div class="table-responsive">
		<table class="table">
		  <tbody>';
		$q = $this->db->select( "MAX('tanggal'), id_komoditi, harga" )
				->group_by("id_harga")
				->limit(6,0)
				->get('dt_harga_komoditi');
				
		foreach ($q->result() as $k){
			$komoditi = $this->db->where('id_komoditi', $k->id_komoditi)->get('dt_komoditi')->row()->uraian;
			$hasil .='  <tr>
                <td>'.substr(strip_tags($komoditi),0,35).'</td>
                <td style="text-align:right;">Rp '.duit($k->harga).'</td>
                <!--<td><span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 5%</span></td>-->
              </tr>';
 
		}
		
		$hasil .='</tbody></table>
          </div>';
		
		return $hasil;
	}
	
	function get_kat_utama()
	{
		$hasil="";
		
		$q = $this->db->where('id_parent', 0)
				->get('dt_kat_usaha');
		foreach ($q->result() as $kat){
			$hasil .='<li><a href="'.base_url('kategori/'.$kat->id_kat_usaha.'/'.$kat->uraian).'">'.$kat->uraian.'</a></li>';
		}
		
		return $hasil;
	}
	
	function get_kat_utama_produk()
	{
		$hasil="";
		
		$q = $this->db
				->where('parent', 0)
				->where('utama', 1)
				->get('dt_kat_produk');
		foreach ($q->result() as $kat){
			$hasil .='<li><a href="'.base_url('kategori/'.$kat->id_kat_produk.'/'.urlencode($kat->uraian)).'">'.$kat->uraian.'</a></li>';
		}
		
		return $hasil;
	}
	
	function get_popularsearch()
	{
		$hasil="";
		
		$q = $this->db->get('dt_cari');
		
		//jumlahkan semua total hit
		foreach ($q->result() as $s){
			$arr[] = array(
			  'id_cari' => $s->id_cari,
			  'keywords' => $s->keywords,
			  'rand_img' => $s->rand_img,
			  'hits' =>  $s->hits_pc+$s->hits_mobile+$s->hits_others
			);
		}
		
		//urutkan hit
		$this->array_sort_by_column($arr, 'hits');
		$i = 0;
		foreach ($arr as $c){
			$i++;
			$hasil .='<li>
				<a href="'.base_url().'search?q='.urlencode($c['keywords']).'">
				<div class="populer-search" style=\'background-image: url("'.config_item('asetdir').'img/gisearch/'.$c['rand_img'].'");\'>
				</div>
				<span class="users-list-date">'.$c['keywords'].'</span>
				</a>
			</li>';
			if($i==8) break;
		}
		
		return $hasil;
	}
	
	function array_sort_by_column(&$arr, $col, $dir = SORT_DESC) {
		$sort_col = array();
		foreach ($arr as $key=> $row) {
			$sort_col[$key] = $row[$col];
		}
		array_multisort($sort_col, $dir, $arr);
	}
	
	function get_kecamatan($sel='')
	{
		$hasil="";
		
		$q = $this->db->get('districts');
		foreach ($q->result() as $kec){
			$hasil .= '<option value="'.$kec->id.'" ';
			if ($kec->id == $sel) {
				$hasil .= 'selected';
			}
			$hasil .='>'.$kec->name.'</option>';
		}
		
		return $hasil;
	}
	
	function get_desa($kec='',$sel='')
	{
		$hasil="";
		
		$this->db->where('district_id', $kec);
		$q = $this->db->get('villages');
		foreach ($q->result() as $des){
			$hasil .= '<option value="'.$des->id.'" ';
			if ($des->id == $sel) {
				$hasil .= 'selected';
			}
			$hasil .='>'.$des->name.'</option>';
		}
		
		return $hasil;
	}

    function kat_usaha_select($sel)
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

    function kat_produk_select($sel)
	{
		$hasil ='';
		$q = $this->db->get('dt_kat_produk');
		foreach ($q->result() as $kat ){
			$hasil .= '<option value="'.$kat->id_kat_produk.'" ';
			if ($kat->id_kat_produk == $sel) {
				$hasil .= 'selected';
			}
			$hasil .='>'.$kat->uraian.'</option>';
		}
		return $hasil;
	}
	
	// function get_kategori($id)
	// {
		// $hasil="";
		
		// $this->db->where('id_parent', $id);
		// $q = $this->db->get('dt_kat_usaha');
		// foreach ($q->result() as $kat){
			// $hasil .='<option value="'.$kat->id_kat_usaha.'">'.$kat->uraian.'</option>';
		// }
		
		// return $hasil;
	// }
	
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
			WHERE b.user_id = $id
		");
		
		return $q->row();
	}
	
	function udata_usronly($id)
	{		
		$q = $this->db->query("
			SELECT 	a.*,
					b.name AS namekec, 
					c.name AS namedes 
			FROM usr_users a 
			INNER JOIN districts b on a.id_kecamatan = b.id 
			INNER JOIN villages c on a.id_desa = c.id
			WHERE a.user_id = $id
		");
		
		return $q->row();
	}
	
	function cek_usaha($id)
	{		
		$q = $this->db->where('id_pemilik', $id)
				->get('dt_usaha')->num_rows();
		
		return $q;
	}
	
	function get_front_most_usaha()
	{		
		$hasil ="";
		
		$q = $this->db->get('districts');
		$t = $this->db->where('status_terbit', 1)->get('dt_usaha')->num_rows();
		foreach ($q->result_array() as $k){
			$u = $this->db->where(array('id_kecamatan'=>$k['id'],'status_terbit'=>1))->get('dt_usaha')->num_rows();
			$k['jumlah'] = $u;
			$new_arr[] = $k;
		}
		
		usort($new_arr, function($b, $a) {
			return $a['jumlah'] <=> $b['jumlah'];
		});
		
		$i=1;
		foreach ($new_arr as $kec){
			if ($i <= 5){
				$p = ($kec['jumlah'] !== 0 ? ($kec['jumlah']/ $t) : 0) * 100;
				$hasil .='<div class="progress-group">
						<span class="progress-text">Kecamatan '.ucwords(strtolower($kec['name'])).'</span>
						<span class="progress-number"><b>'.$kec['jumlah'].'</b> <small>dari '.$t.'</small></span>

						<div class="progress xs">
						  <div class="progress-bar progress-bar-aqua" style="width: '.$p.'%"></div>
						</div>
					  </div>';
			}
			$i++;
			
		}
		
		return $hasil;
	}
}


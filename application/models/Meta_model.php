<?php

class Meta_model extends CI_Model {



	function utama()
	{
		$hasil ="";
		
		$deskripsi = 'Portal Pasar Desa Kota Pari adalah layanan pemasaran produk-produk usaha asli Desa Kota Pari. Layanan ini bersifat GRATIS bagi setiap pelaku usaha di wilayah Desa Kota Pari yang ingin memasarkan produk-produk usahanya.';
		$sub_judul = '';
		$og_image = config_item('aset').'img/epasar-utama.jpg';
		
		if (isset($og_image)){
			$hasil .='<meta property="og:image" content="'.$og_image.'"/>';
		} else {
			$hasil .='<meta property="og:image" content="'.config_item('aset').'img/epasar-utama.jpg"/>';
		}

		
		if (isset($og_url)){
			$hasil .='<meta property="og:url" content="'.$og_url.'"/>';
		} else {
			$hasil .='<meta property="og:url" content="'.base_url().'"/>';
		}

		$hasil .='
		<meta property="og:title" content="'.(isset($sub_judul))?$sub_judul:''.' '.config_item('judul').'"/>
		<meta property="og:description" content="'.$deskripsi.'"/>

		<meta name="keywords" content="e-pasar, e-commerce, pasar langkat, jual beli langkat, ukm langkat, industri langkat, perdagangan langkat, usaha langkat, barang seken, online langkat">
		<meta name="description" content="'.$deskripsi.'">
		';

		return $hasil;
		
	}

	function info()
	{
		$hasil ="";
		
		$deskripsi = 'Informasi ePasar Kabupaten Langkat';
		$sub_judul = '';
		$og_image = config_item('aset').'img/epasar-utama.jpg';
		
		if (isset($og_image)){
			$hasil .='<meta property="og:image" content="'.$og_image.'"/>';
		} else {
			$hasil .='<meta property="og:image" content="'.config_item('aset').'img/epasar-utama.jpg"/>';
		}

		
		if (isset($og_url)){
			$hasil .='<meta property="og:url" content="'.$og_url.'"/>';
		} else {
			$hasil .='<meta property="og:url" content="'.base_url().'"/>';
		}

		$hasil .='
		<meta property="og:title" content="'.(isset($sub_judul))?$sub_judul:''.' '.config_item('judul').'"/>
		<meta property="og:description" content="'.$deskripsi.'"/>

		<meta name="keywords" content="e-pasar, e-commerce, pasar langkat, jual beli langkat, ukm langkat, industri langkat, perdagangan langkat, usaha langkat, barang seken, online langkat">
		<meta name="description" content="'.$deskripsi.'">
		';

		return $hasil;
		
	}
	
	function detilusaha($dt)
	{
		$hasil ="";
		
		if ($dt->detil != null){
			$deskripsi = substr(strip_tags($dt->detil),0,300);
		} else {
			$deskripsi = 'Kunjungi toko '.$dt->nama_usaha.' di e-Pasar Kabupaten Langkat dan lihat produk-produk menarik di dalamnya.';
		}
		
		
		$sub_judul = $dt->nama_usaha;
		if ($dt->cover != null){
			$og_image = config_item('aset').'img/cover/'.$dt->cover;
		} else {
			$og_image = 'https://placehold.it/700x270/ab3cbc/ffffff&amp;text='.urlencode($dt->nama_usaha);
		}
		$og_url = currenturl();
		
		if (isset($og_image)){
			$hasil .='<meta property="og:image" content="'.$og_image.'"/>';
		} else {
			$hasil .='<meta property="og:image" content="'.config_item('aset').'img/epasar-utama.jpg"/>';
		}

		
		if (isset($og_url)){
			$hasil .='<meta property="og:url" content="'.$og_url.'"/>';
		} else {
			$hasil .='<meta property="og:url" content="'.base_url().'"/>';
		}

		$hasil .='
		<meta property="og:title" content="'.$sub_judul.' | '.config_item('judul').'"/>
		<meta property="og:image:alt" content="'.$dt->nama_usaha.'"/>
		<meta property="og:description" content="'.$deskripsi.'"/>

		<meta name="keywords" content="e-pasar, e-commerce, pasar langkat, jual beli langkat, ukm langkat, industri langkat, perdagangan langkat, usaha langkat, barang seken, online langkat, '.$dt->nama_usaha.'">
		<meta name="description" content="'.$deskripsi.'">
		';

		return $hasil;
		
	}
	
	function item($dt)
	{
		$hasil ="";
		
		$deskripsi = substr(strip_tags($dt->detil),0,300);
		$sub_judul = $dt->nama_produk.' - '.$dt->nama_usaha;
		$foto = $this->item_model->get_productimg($dt->id_produk)->row();
		if ($foto != null){
			$og_image = config_item('aset').'img/produk/'.$dt->id_usaha.'/'.$foto->foto;
		} else {
			$og_image = 'https://placehold.it/200x200/39CCCC/ffffff&amp;text='.urlencode($dt->nama_produk);
		}
		$og_url = currenturl();
		
		if (isset($og_image)){
			$hasil .='<meta property="og:image" content="'.$og_image.'"/>';
		} else {
			$hasil .='<meta property="og:image" content="'.config_item('aset').'img/epasar-utama.jpg"/>';
		}

		
		if (isset($og_url)){
			$hasil .='<meta property="og:url" content="'.$og_url.'"/>';
		} else {
			$hasil .='<meta property="og:url" content="'.base_url().'"/>';
		}

		$hasil .='
		<meta property="og:title" content="'.$sub_judul.' | '.config_item('judul').'"/>
		<meta property="og:image:alt" content="'.$dt->nama_produk.'"/>
		<meta property="og:image:width" content="200"/>
		<meta property="og:image:height" content="200"/>
		<meta property="og:description" content="'.$deskripsi.'"/>
		
		<meta name="keywords" content="e-pasar, e-commerce, pasar langkat, jual beli langkat, ukm langkat, industri langkat, perdagangan langkat, usaha langkat, barang seken, online langkat, '.$dt->nama_produk.'">
		<meta name="description" content="'.$deskripsi.'">
		';

		return $hasil;
		
	}
	
	function cari($q)
	{
		$hasil ="";
		
		$deskripsi = 'Hasil pencarian untuk produk / toko dengan kata kunci : '.urldecode($q);
		$sub_judul = 'Jual '.urldecode($q);
		
		$this->db->where('keywords', urldecode($q));
		$img = $this->db->get('dt_cari')->row()->rand_img;
		
		if ($img != null){
			$og_image = config_item('aset').'img/gisearch/'.$img;
		} else {
			$og_image = 'https://placehold.it/200x200/39CCCC/ffffff&amp;text='.urlencode($q);
		}
		$og_url = currenturl();
		
		if (isset($og_image)){
			$hasil .='<meta property="og:image" content="'.$og_image.'"/>';
		} else {
			$hasil .='<meta property="og:image" content="'.config_item('aset').'img/epasar-utama.jpg"/>';
		}

		
		if (isset($og_url)){
			$hasil .='<meta property="og:url" content="'.$og_url.'"/>';
		} else {
			$hasil .='<meta property="og:url" content="'.base_url().'"/>';
		}

		$hasil .='
		<meta property="og:title" content="'.$sub_judul.' di '.config_item('judul').'"/>
		<meta property="og:image:alt" content="'.urldecode($q).'"/>
		<meta name="robots" content="noindex" />
		<meta property="og:image:width" content="200"/>
		<meta property="og:image:height" content="200"/>
		<meta property="og:description" content="'.$deskripsi.'"/>
		
		<meta name="keywords" content="'.urldecode($q).'">
		<meta name="description" content="'.$deskripsi.'">
		';

		return $hasil;
		
	}
	
	function kategori($q)
	{
		$hasil ="";
		
		$deskripsi = 'Kategori '.urldecode($q).' | e-Pasar Kabupaten Langkat';
		$sub_judul = 'Jual '.urldecode($q);
		
		// $this->db->where('keywords', urldecode($q));
		// $img = $this->db->get('dt_cari')->row()->rand_img;
		
		// if ($img != null){
			// $og_image = config_item('aset').'img/gisearch/'.$img;
		// } else {
			$og_image = 'https://placehold.it/200x200/39CCCC/ffffff&amp;text='.urlencode($q);
		// }
		$og_url = currenturl();
		
		if (isset($og_image)){
			$hasil .='<meta property="og:image" content="'.$og_image.'"/>';
		} else {
			$hasil .='<meta property="og:image" content="'.config_item('aset').'img/epasar-utama.jpg"/>';
		}

		
		if (isset($og_url)){
			$hasil .='<meta property="og:url" content="'.$og_url.'"/>';
		} else {
			$hasil .='<meta property="og:url" content="'.base_url().'"/>';
		}

		$hasil .='
		<meta property="og:title" content="'.$sub_judul.' di '.config_item('judul').'"/>
		<meta property="og:image:alt" content="'.urldecode($q).'"/>
		<meta name="robots" content="noindex" />
		<meta property="og:image:width" content="200"/>
		<meta property="og:image:height" content="200"/>
		<meta property="og:description" content="'.$deskripsi.'"/>
		
		<meta name="keywords" content="'.urldecode($q).'">
		<meta name="description" content="'.$deskripsi.'">
		';

		return $hasil;
		
	}
	
}


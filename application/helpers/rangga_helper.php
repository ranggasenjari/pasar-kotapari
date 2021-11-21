<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('getConfig'))
{
 	function getConfig($param)
	{
		$CI =& get_instance();
		$hasil = $CI->db->get_where('ref_settings', array('name'=>$param))->row()->val;

		return $hasil;
	}
	
	function slugify($jenis,$string) {
		$str='n-a';
		$string = utf8_encode($string);
		$string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);   
		$string = preg_replace('/[^a-z0-9- ]/i', '', $string);
		$string = str_replace(' ', '-', $string);
		$string = trim($string, '-');
		$string = strtolower($string);

		if (empty($string)) {
			return 'n-a';
		}
		
		$i = 1; 
		$slug = $string;
		while(slug_usaha_exist($jenis,$string)){
			$string = $slug . "-" . $i++;        
		}
		
		return $string;
	}
	
	function slugifyonly($string) {
		$string = utf8_encode($string);
		$string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);   
		$string = preg_replace('/[^a-z0-9- ]/i', '', $string);
		$string = str_replace(' ', '-', $string);
		$string = trim($string, '-');
		$string = strtolower($string);

		if (empty($string)) {
			return 'n-a';
		}
		
		return $string;
	}
	
	function slug_usaha_exist($jenis,$x){
		$CI =& get_instance();
		
		if ($jenis=='usaha'){
			$CI->db->where('slug_usaha', $x);
			$q = $CI->db->get('dt_usaha');
		} else if ($jenis=='produk'){
			$CI->db->where('slug_produk', $x);
			$q = $CI->db->get('dt_produk');
		}
		
		if($q->num_rows() > 0){
			return true;
		}
	}
	
	function currenturl()
	{
		$CI =& get_instance();

		$url = $CI->config->site_url($CI->uri->uri_string());
		return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
	}
	
	function urltrim($url,$key)
	{
		$CI =& get_instance();
		parse_str(parse_url($url, PHP_URL_QUERY), $out);
		if (array_key_exists($key, $out)) {
			unset($out[$key]);
		}
		if (!empty($out)){
			$a = '?';
		} else {
			$a = '';
		}
		$r = parse_url($url, PHP_URL_SCHEME).'://'.parse_url($url, PHP_URL_HOST).parse_url($url, PHP_URL_PATH).$a.http_build_query($out);
		return $r;
	}
	
	function getimg($url) {         
		$headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg';              
		$headers[] = 'Connection: Keep-Alive';         
		$headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';         
		$user_agent = 'php';         
		$process = curl_init($url);         
		curl_setopt($process, CURLOPT_HTTPHEADER, $headers);         
		curl_setopt($process, CURLOPT_HEADER, 0);         
		curl_setopt($process, CURLOPT_USERAGENT, $user_agent); //check here         
		curl_setopt($process, CURLOPT_TIMEOUT, 30);         
		curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);         
		curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);         
		$return = curl_exec($process);         
		curl_close($process);         
		return $return;     
	} 
	
	function random_color_part() {
		return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
	}

	function random_color() {
		return random_color_part() . random_color_part() . random_color_part();
	}

	function duit($number, $fractional=false) {
		if ($fractional) {
			$number = sprintf('%.2f', $number);
		}
		while (true) {
			$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1.$2', $number);
			if ($replaced != $number) {
				$number = $replaced;
			} else {
				break;
			}
		}
		if ($number == null){$number = '0';} else if($number == 0){$number = 0;}
		return $number;
	} 
}
/* End of file rangga_helper.php */
/* Location: ./application/helpers/rangga_helper.php */
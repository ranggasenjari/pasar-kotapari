<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('generate_tanggal'))
{
	function generate_tanggal($tgl,$only='')
	{
		if ($only == 'tgl'){
		$get = explode(" ",$tgl);
		$get_tanggal = explode("-",$get[0]);
		$get_waktu = $get[1];

		$tanggal = $get_tanggal[2];
		$bulan = getBulan($get_tanggal[1]);
		$tahun = $get_tanggal[0];
		return $tanggal.' '.$bulan.' '.$tahun;	
		} else {
		$get = explode(" ",$tgl);
		$get_tanggal = explode("-",$get[0]);
		$get_waktu = $get[1];

		$tanggal = $get_tanggal[2];
		$bulan = getBulan($get_tanggal[1]);
		$tahun = $get_tanggal[0];
		return $tanggal.' '.$bulan.' '.$tahun.' - '.$get_waktu;
		}
	}

	function ubah($x)
	{
		$jml = strlen($x);
		if($jml==11):
			echo substr_replace($x, 'xxx', 8, 3);
		elseif($jml==12):
			echo substr_replace($x, 'xxx', 9, 3);
		endif;
	}
	
	function getBulan($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
			} 
}

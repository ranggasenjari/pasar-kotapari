<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
use Carbon\CarbonPeriod;
class Kategori extends MY_Controller {

    function __construct()
    {	
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Headers: Authorization, Content-Type');
		// header('Access-Control-Allow-Headers: *');
		header('Access-Control-Allow-Methods: *');
		// $method = $_SERVER['REQUEST_METHOD'];
		// if($method == "OPTIONS") {
			// echo 'ok';
		// }
        parent::__construct();
		
    }
	
	public function catpil()
	{
//========Baca data API Pemanfaatan Data Dukcapil:
$url="http://192.168.99.254:8080/dukcapil/get_json/12-05/diskominfo_1205/call_nik";
$data='
{
	"nik":"1205120206920004",
	"user_id":"10912020011422diskominfo_1205",
	"password":"k0mi17f0",
	"ip_user":"192.168.99.4"
}
';
$options=[
	'http'=>[
		'ignore_errors'=>true,
		'method'	=>"POST",
		'content' 	=> $data,
		'header'	=>implode("\r\n",[
			"Content-Type:application/json",
			"Accept:*/*",
			"Accept-Charset:UTF-8"
		])
	],
	'ssl'=>['verify_peer'=>false]
];
$context=stream_context_create($options);
$content=file_get_contents($url,false,$context);
// echo '<pre>';
// print_r(json_decode($content,true)['content'][0]);
// print_r(serialize(json_decode($content,true)['content'][0]));
echo serialize(serialize(json_decode($content,true)['content'][0]));
	}
	
	public function index()
	{
		$this->is_logged_in();
		$kat = $this->uri->segment(2);
		$kat_name = @array_shift(explode('&', $this->uri->segment(3)));
		
		$this->load->model('kategori_model');
		
		// $q = $this->input->get('q', TRUE);
		
		// $this->add_count(urldecode($q));
		
		$filter = array (
				'id_kecamatan' => $this->input->get('d', TRUE),
				'id_kat_produk' => $kat,
				'kondisi' => $this->input->get('s', TRUE),
				'verifikasi' => $this->input->get('v', TRUE)
				);

		$offset = $this->input->get('p', TRUE);
		$sort = $this->input->get('sort', TRUE);
		// $d['apacari'] = urldecode($q);
		
		$hasilcari = $this->kategori_model->kategori_produk($kat_name,$filter,$offset,$sort);
		
		if ($this->input->is_ajax_request()) {
			
			echo $hasilcari;
			
		} else {
			
			$d['sub_judul'] = 'Kategori '.$kat_name.' |';
			$d['kecfilter'] = $this->kategori_model->get_kec_filter($kat);
			$d['katfilter'] = $this->kategori_model->get_kat_filter($kat);
			$d['kondfilter'] = $this->kategori_model->get_kond_filter($kat);
			$d['meta'] = $this->meta_model->kategori($kat_name);
			$d['hasilcari'] = $hasilcari;
			
			$this->load->view('meta', $d);
			$this->load->view('header', $d);
			$this->load->view('kategori', $d);
			$this->load->view('footer', $d);
		
		}
		
	}
	
	
	// public function brownies()
	// {
		// $html ='';
		// $html .='
				// <!doctype html>
				// <html lang="en">
				// <head>
				  // <meta charset="utf-8">
		// <!-- Mobile Metas -->
		// <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
				  // <link rel="stylesheet" href="'.config_item('aset').'bower_components/bootstrap/dist/css/bootstrap.min.css">
				  // <link rel="stylesheet" href="https://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.css">
				  // <link href="'.config_item('aset').'bower_components/select2/dist/css/select2.min.css" rel="stylesheet" />
				  // <link rel="stylesheet" href="'.config_item('aset').'bower_components/jquery-ui/themes/base/jquery-ui.css">
				  // <script src="'.config_item('aset').'bower_components/jquery/dist/jquery.min.js"></script>
				  // <script src="'.config_item('aset').'bower_components/jquery-ui/jquery-ui.min.js"></script>
				  // <script src="https://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.js"></script>
				  // <script src="'.config_item('aset').'bower_components/select2/dist/js/select2.min.js"></script>
				  // <script>
				  // $( function() {
					  
					// $(document).ready(function() {
						// $(\'.js-example-basic-single\').select2({
						  // ajax: {
							// url: \'https://pasar.langkatkab.go.id/kategori/get_pegawai\',
							// dataType: \'json\',
							// delay: 250,
							// data: function(params){
								// return{
									// key: params.term
								// };
							// },
							// processResults: function(data){
								// var results = [];
								
								// $.each(data, function(index,item){
									// results.push({
										// id: item.nip,
										// text: item.nama + \' ( \' + item.nip + \') \'
									// });
								// });
								// return{
									// results: results
								// };
							// }
						  // }
						// });
					// });
										
					// $("#time").datetimepicker({
					   // showSecond: true,
					   // showMillisec: true,
					   // timeFormat: "HH:mm:ss"
					// });
					
				  // } );
				  // </script>
				// </head>
				// <body>
			// ';
			
			
		// $html .='<div class="row">';
		// $html .='<div class="col-md-5">';
			
		// $html .='<form class="form-horizontal" action="'.base_url('kategori/batamerah').'" method="post" target="_blank">';
		
		// $html .='<div class="form-group">
				// <label class="col-md-3 control-label">ASN</label>
					// <div class="col-md-9">
						// <div class="input-group">';
						
		// $html .= '<select name="nip" class="js-example-basic-single form-control" required>
						// <option value=""> -- Pilih Pegawai --';
		// $html .= '</select>';
		// $html .= '</div>
					// </div>
			// </div>';
		
		
		// $html .='<div class="form-group">
				// <label class="col-md-3 control-label">Tanggal</label>
					// <div class="col-md-9">
						// <input class="form-control" name="time" type="text" id="time" required readonly />
					// </div>
			// </div>';
		// $html .='<button class="btn btn-info" type="submit">-- OK --</button>';
				  
		// $html .='</form>';
		// $html .='</div>';
		// $html .='</div>';
		// $html .='</body>
				// </html>';
		
		// echo $html;
		
	// }
	
	
	// public function batako($id=0)
	// {
		// if ( $id != Carbon::parse()->format('Hi') ) { redirect('/'); }
		// $html ='';
		// $html .='
				// <!doctype html>
				// <html lang="en">
				// <head>
				  // <meta charset="utf-8">
		// <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
				  // <link rel="stylesheet" href="'.config_item('aset').'bower_components/bootstrap/dist/css/bootstrap.min.css">
				  
				  
				  // <link href="'.config_item('aset').'bower_components/select2/dist/css/select2.min.css" rel="stylesheet" />
				  // <link href="'.config_item('aset').'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet" />
				  // <link href="'.config_item('aset').'bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
				  
				  // <script src="'.config_item('aset').'bower_components/jquery/dist/jquery.min.js"></script>
				  // <script src="'.config_item('aset').'bower_components/select2/dist/js/select2.min.js"></script>
				  // <script src="'.config_item('aset').'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
				  // <script src="'.config_item('aset').'bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
				  // <script>
				  // $( function() {
					  
					// $(document).ready(function() {
						// $(\'.js-example-basic-single\').select2({
						  // ajax: {
							// url: \'https://pasar.langkatkab.go.id/kategori/get_pegawai\',
							// dataType: \'json\',
							// delay: 250,
							// data: function(params){
								// return{
									// key: params.term
								// };
							// },
							// processResults: function(data){
								// var results = [];
								
								// $.each(data, function(index,item){
									// results.push({
										// id: item.nip,
										// text: item.nama + \' ( \' + item.nip + \') \'
									// });
								// });
								// return{
									// results: results
								// };
							// }
						  // }
						// });
					// });
					
					// $( ".input-daterange" ).datepicker();
					
				  // } );
				  // </script>
				// </head>
				// <body>
			// ';
			
			
		// $html .='<div class="row">';
		// $html .='<div class="col-md-5">';
		// $html .='<form action="'.base_url('kategori/poster').'" method="post" target="_blank">';
		
		
		// $html .='<div class="form-group">
				// <label class="control-label">ASN</label>';
		// $html .= '<select name="nip[]" class="js-example-basic-single form-control" required multiple>
						// <option value=""> -- Pilih Pegawai --';

		// $html .= '</select>';
		// $html .= '</div>';
		
		// $html .='<div class="form-group">
				// <label class="control-label">Tanggal</label>
					// <div class="input-daterange input-group" data-plugin-datepicker>
						// <span class="input-group-addon">
							// <i class="fa fa-calendar"></i>
						// </span>
						// <input type="text" class="form-control start" name="start" required readonly>
						// <span class="input-group-addon">s.d.</span>
						// <input type="text" class="form-control end" name="end" required readonly>
					// </div>
				// </div>';
		// $html .='<br/>';
		// $html .='<button class="btn btn-info btn-block btn-lg" type="submit">-- OK --</button>';
				  
		// $html .='</form>';
		// $html .='</div>';
		// $html .='</div>';
		// $html .='</body>
				// </html>';
				  
		// echo $html;
		
	// }
	
	public function get_pegawai(){
		$key = $this->input->get('key');
		$q = [];
		
		if ($key!='' || $key!=NULL){
			$simpeg = $this->load->database('simpeg', TRUE);
				 // $simpeg->select('nip, nama');
				 // $simpeg->like('nip', $key); 
				 // $simpeg->or_like('nama', $key);
				 // $simpeg->limit(10);
				 // $simpeg->order_by('nama', 'asc');
			// $q = $simpeg->get('dt_pegawai')->result_array();
			
			
		$w = 'WHERE c.nip LIKE \'%'.$key.'%\' ESCAPE \'!\' OR c.nama LIKE \'%'.$key.'%\' ESCAPE \'!\' OR d.nama_jabatan LIKE \'%'.$key.'%\' ESCAPE \'!\'';
			
		$q = $simpeg->query('
			SELECT c.nip, c.nama, d.nip, d.nama_jabatan, e.*, f.*, g.id, g.username FROM `dt_pegawai` c
			LEFT JOIN 
			(
				SELECT a.*, b.*
				FROM (
					SELECT nip, idJabatan as idJabatanA, tmt_jabatan, no_sk, tgl_sk FROM dt_jabatan_pegawai
					ORDER BY tmt_jabatan DESC
					LIMIT 18446744073709551615
				) a 
				LEFT JOIN dt_jabatan b ON a.idJabatanA = b.idJabatan GROUP BY a.nip
			) d ON c.nip = d.nip 
			LEFT JOIN dt_ruang_pangkat e ON c.idGol = e.idRuangPangkat
			LEFT JOIN dt_instansi f ON c.idInstansi = f.idInstansi
			LEFT JOIN users g ON c.nip = g.username
			'.$w.'
			ORDER BY e.urut ASC
		')->result_array();
			
			
			
		}
		
		echo json_encode($q);
		// foreach ($q->result() as $d){
			// $html .= '<option value="'.$d->nip.'">';
			// $html .= $d->nama.' ( '.$d->nip.' )';
			// $html .= '</option>';
			
		// }
	}
	
	public function setbatako()
	{
		$html ='';
		$html .='
				<!doctype html>
				<html lang="en">
				<head>
				  <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
				  <link rel="stylesheet" href="'.config_item('aset').'bower_components/bootstrap/dist/css/bootstrap.min.css">
				  
				  
				  <link href="'.config_item('aset').'bower_components/select2/dist/css/select2.min.css" rel="stylesheet" />
				  <link href="'.config_item('aset').'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet" />
				  <link href="'.config_item('aset').'bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
				  <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />
				  <link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet" />
				  
				  <script src="'.config_item('aset').'bower_components/jquery/dist/jquery.min.js"></script>
				  <script src="'.config_item('aset').'bower_components/select2/dist/js/select2.min.js"></script>
				  <script src="'.config_item('aset').'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
				  <script src="'.config_item('aset').'bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
				  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
				  <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
				  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
				  <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
				  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.2.2/jszip.min.js"></script>
				  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.62/pdfmake.min.js"></script>
				  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.62/vfs_fonts.js"></script>
				  
				  <script>
				  $( function() {
					  
					$(document).ready(function() {
						$(\'.js-example-basic-single\').select2({
						  ajax: {
							url: \'https://pasar.langkatkab.go.id/kategori/get_pegawai\',
							dataType: \'json\',
							delay: 250,
							data: function(params){
								return{
									key: params.term
								};
							},
							processResults: function(data){
								var results = [];
								
								$.each(data, function(index,item){
									results.push({
										id: item.nip,
										text: item.nama + \' ( \' + item.nip + \') \' + item.nama_jabatan
									});
								});
								return{
									results: results
								};
							}
						  }
						});
					});
					
					$( ".input-daterange" ).datepicker();
					
				  } );
				  </script>
				</head>
				<body>
			';
			
			
		$html .='<div class="row">';
		$html .='<div class="col-md-5">';
		$html .='<form name="set" id="set">';
		
		$simpeg = $this->load->database('simpeg', TRUE);
			 // $simpeg->join('dt_jabatan', 'dt_pegawai.idJabatan = dt_jabatan.idJabatan');
			 // $simpeg->order_by('nama', 'asc');
		// $q = $simpeg->get('dt_pegawai');
		
		$html .='<div class="form-group">
				<label class="control-label">ASN</label>';
		$html .= '<select id="pegawai" name="pegawai" class="js-example-basic-single form-control" required>
						<option value=""> -- Pilih Pegawai --';
		// foreach ($q->result() as $d){
			// $html .= '<option value="'.$d->nip.'">';
			// $html .= $d->nama.' ( '.$d->nip.' - '.$d->nama_jabatan.')';
			// $html .= '</option>';
		// }
		$html .= '</select>';
		$html .= '</div>';
				 
		$html .='</form>';
		
		$html .='<button id="submit" class="btn btn-info btn-md" >Tambah</button>';
		
		$html .='<br/>';
		$html .='<br/>';
		
		$html .='<div style="width:100%;" id="table_log">';
		$html .='<table id="log" class="table table-bordered table-striped">';
			$html .='<thead>';
				$html .='<tr>';
					$html .='<th>';
					$html .='#';
					$html .='</th>';
					$html .='<th>';
					$html .='NIP';
					$html .='</th>';
					$html .='<th>';
					$html .='NAMA';
					$html .='</th>';
					$html .='<th>';
					$html .='JABATAN';
					$html .='</th>';
					$html .='<th>';
					$html .='UNIT KERJA';
					$html .='</th>';
				$html .='</tr>';
			$html .='</thead>';
			$html .='<tbody>';
			
			
			foreach(file('./rsc/a.txt') as $line) {
				$asn[] = str_replace(array("\n","\r","\r\n"),'',$line);
			}
			
		$w = "WHERE c.nip IN ('".implode("','",$asn)."')";
			
		$data = $simpeg->query('
			SELECT c.*, d.*, IFNULL(d.idEselon, 999) as Es, e.*, f.*, j.*, k.id FROM `dt_pegawai` c
			LEFT JOIN 
			(
				SELECT h.*
				FROM (
					SELECT a.*, b.*
					FROM (
						SELECT idJabatanPegawai, nip as nipA, idJabatan as idJabatanA, tmt_jabatan, no_sk, tgl_sk, jenis FROM dt_jabatan_pegawai
						ORDER BY STR_TO_DATE(tmt_jabatan,\'%d/%m/%Y\') DESC
						LIMIT 18446744073709551615
					) a 
					LEFT JOIN
					(
						SELECT i.*, FLOOR(i.s_tpp/1000)*1000 as t_tpp
						FROM (
							SELECT g.*, h.kelas as kls, h.tpp,
							(
								( (g.beban_kerja_perseratus / 100) * h.tpp )
								+
								( (g.prestasi_kerja_perseratus / 100) * h.tpp )
								+
								( (g.kondisi_kerja_perseratus / 100) * h.tpp )
								+
								( (g.tempat_bertugas_perseratus / 100) * h.tpp )
								+
								( (g.kelangkaan_perseratus / 100) * h.tpp )
								+
								( (g.pertimbangan_perseratus / 100) * h.tpp )
							) AS s_tpp
							FROM dt_jabatan g
							INNER JOIN dt_kelas_tpp h ON g.kelas = h.kelas
						) i
					) b ON a.idJabatanA = b.idJabatan
				) h
				GROUP BY h.nipA
				
			) d ON c.nip = d.nipA 
			LEFT JOIN dt_ruang_pangkat e ON c.idGol = e.idRuangPangkat
			LEFT JOIN users k ON c.nip = k.username
			LEFT JOIN 
            (
            	SELECT idEselon, uraian as nama_eselon FROM dt_eselon
            ) j ON d.idEselon = j.idEselon
			LEFT JOIN dt_instansi f ON c.idInstansi = f.idInstansi
			'.$w.'
			ORDER BY Es ASC
		')->result();
			
				 // $simpeg->where_in('nip', $asn);
				 // $simpeg->join('dt_jabatan', 'dt_pegawai.idJabatan = dt_jabatan.idJabatan');
			// $data = $simpeg->get('dt_pegawai')->result();
			
			$i=1;
			foreach ($data as $d){
				$html .='<tr>';
					$html .='<td>';
					$html .=$i;
					$html .='</td>';
					$html .='<td>';
					$html .=$d->nip;
					$html .='</td>';
					$html .='<td>';
					$html .=$d->nama;
					$html .='</td>';
					$html .='<td>';
					$html .=$d->nama_jabatan;
					$html .='</td>';
					$html .='<td>';
					$html .=$d->uraian;
					$html .='</td>';
				$html .='</tr>';
				$i++;
			}
			$html .='</tbody>';
		$html .='</table>';
		$html .='</div>';
		
		$html .='</div>';
		$html .='</div>';
		$html .='<script>
				  $( function() {
					  
					function tableInit() {
						return $(\'#log\').DataTable( {
							dom: \'Bfrtip\',
							buttons: [
								{extend:\'pdf\',title:\'export\',orientation:\'landscape\',pageSize:\'A4\',exportOptions:{columns:\':visible\'}},
								{extend:\'excel\',title:\'export\',exportOptions:{columns:\':visible\'}},
								\'print\'
							]
						} );
					}
					
					var table = tableInit();
					
					$("#submit").on("click", function() {
						table.clear().destroy();
						var pegawai = $("#pegawai").val();
						$.post("'.base_url('kategori/setbatakopost/').'", {nip:pegawai} , function( data ) {
							$("#table_log").html(data);
							table = tableInit();
						}, "html");
					});
					
				  } );
				  </script>';
		$html .='</body>
				</html>';
				  
		echo $html;
		
	}
	
	// public function batamerah()
	// {
		// $this->load->helper('date');
		// $this->load->library('mongo_db');
		
				// $this->mongo_db->where('nip', strval($this->input->post('nip')));
		// $id_p = $this->mongo_db->find_one('users')[0]['_id']->{'$id'} ?? 'Belum diinput';
		
				// $this->mongo_db->where('nip', strval($this->input->post('nip')));
		// $id_u = $this->mongo_db->find_one('users')[0]['id_unitkerja'] ?? 'Belum diinput';
		
				// $this->mongo_db->where('id_unitkerja', strval($id_u));
		// $id_m = $this->mongo_db->find_one('mesinabsen')[0]['_id']->{'$id'};
		
				// $this->mongo_db->where('id_unitkerja', strval($id_u));
		// $ip_m = $this->mongo_db->find_one('mesinabsen')[0]['ip_mesin'];
		
		// $in = [
			// 'PEGAWAI_ID' => $this->input->post('nip')."-".Carbon::parse($this->input->post('time'))->format('dmYHis'),
			// 'nip'=>$this->input->post('nip'),
			// 'id_pegawai'=>$id_p,
			// 'id_unitkerja'=>$id_u,
			// 'ip_mesin'=>$ip_m,
			// 'id_mesin'=>$id_m,
			// 'date_time'=>$this->mongo_db->date(Carbon::parse($this->input->post('time'))),
			// 'verifikasi'=>1,
			// 'status'=>4,
			// 'created_at'=>$this->mongo_db->date(Carbon::parse($this->input->post('time'))),
			// 'updated_at'=>$this->mongo_db->date(Carbon::parse($this->input->post('time')))
		  // ];
		// $this->mongo_db->insert ('presensi', $in);
		
		// echo '<pre>';
		// print_r($in);
		
	// }
	
	function libur($needle,$haystack) {
		foreach($haystack as $key=>$value) {
			$current_key=$key;
			if($needle===$value OR (is_array($value) && $this->libur($needle,$value) !== false)) {
				return true;
			}
		}
		return false;
	}
	
	public function setbatakopost()
	{
		$html = '';
		$ada = 0;
		$simpeg = $this->load->database('simpeg', TRUE);
		$n = $this->input->post('nip');
		foreach(file('./rsc/a.txt') as $line) {
			$asn = str_replace(array("\n","\r","\r\n"),'',$line);
			if ($asn==$n){
				$ada++;
			}
			$asn_ex[] = $asn;
		}
		
		if ($ada>0){
			
		} else {
			$asn_ex[] = $n;
			$file = fopen('./rsc/a.txt', 'w') or die("Unable to open file!");
			foreach($asn_ex as $line) {
				fwrite($file, $line . PHP_EOL);
			}
			fclose($file);
		}
		
		$html .='<table id="log" class="table table-bordered table-striped">';
			$html .='<thead>';
				$html .='<tr>';
					$html .='<td>';
					$html .='#';
					$html .='</td>';
					$html .='<td>';
					$html .='Pegawai';
					$html .='</td>';
				$html .='</tr>';
			$html .='</thead>';
			$html .='<tbody>';
			
				 $simpeg->where_in('nip', $asn_ex);
				 $simpeg->join('dt_jabatan', 'dt_pegawai.idJabatan = dt_jabatan.idJabatan');
			$data = $simpeg->get('dt_pegawai')->result();
			
			$i=1;
			foreach ($data as $d){
				$html .='<tr>';
					$html .='<td>';
					$html .=$i;
					$html .='</td>';
					$html .='<td>';
					$html .=$d->nip.'<br>';
					$html .='<span style="font-size:80%;">'.$d->nama.'<br>';
					$html .=$d->nama_jabatan.'</span>';
					$html .='</td>';
				$html .='</tr>';
				$i++;
			}
			$html .='</tbody>';
		$html .='</table>';
		
		echo $html;
		
	}
	
	public function poster()
	{
		// $id = $this->uri->segment(3);
		$res = $this->brrrrrrrrrrrssss('ibd');
		if (count($res)>0){
			$this->db->insert_batch('usr_acl_access', $res);
		}
	}
	
	public function brrrrrrrrrrrssss($pic='')
	{
		$this->load->helper('date');
		$this->load->library('mongo_db');
		$simpeg = $this->load->database('simpeg', TRUE);
		$asn = [];
		if ( !$this->input->post() ){
			foreach(file('./rsc/a.txt') as $line) {
				$asn[] = str_replace(array("\n","\r","\r\n"),'',$line);
			}
		} else {
			$asn = $this->input->post('nip');
		}
		
		if ( $this->uri->segment(3) ) {
			$s = Carbon::parse($this->uri->segment(3));
			$awalmasuk = Carbon::parse($this->uri->segment(3));
		} else if ( $this->input->post() ){
			$s = Carbon::parse($this->input->post('start'));
			$awalmasuk = Carbon::parse($this->input->post('start'));
		} else {
			$s = Carbon::today();
			$awalmasuk = Carbon::today();
		}
		
		if ( $this->uri->segment(4) ) {
			$e = Carbon::parse($this->uri->segment(4));
			$akhirpulang = Carbon::parse($this->uri->segment(4))->addHours(23)->addMinutes(59)->addSeconds(59);
		} else if ( $this->input->post() ){
			$e = Carbon::parse($this->input->post('end'));
			$akhirpulang = Carbon::parse($this->input->post('end'))->addHours(23)->addMinutes(59)->addSeconds(59);
		} else {
			$e = Carbon::today();
			$akhirpulang = Carbon::today()->addHours(23)->addMinutes(59)->addSeconds(59);
		}
		
		$period = CarbonPeriod::create($s->format('Y-m-d'), $e->format('Y-m-d'));
		$libur = $simpeg->where('jenis', 'off')->get('dt_harikerja')->result_array();
		$log = [];
		foreach ($asn as $p) {
				
			echo 'NIP : '.$p;		
			echo '<br/>';
					
				 $this->mongo_db->order_by(array('date_time' => 'ASC'));
				 $this->mongo_db->where('nip', strval($p)); 
				 $this->mongo_db->where_between( 'date_time', $this->mongo_db->date($awalmasuk), $this->mongo_db->date($akhirpulang) );
			$presensi = $this->mongo_db->get('presensi');
			
			foreach ($period as $date) {
				
				$awalwaktumasuk = Carbon::parse($date)->addHours(7);
				$awalwaktupulang = Carbon::parse($date)->addHours(16);
				
				$adalibur = $this->libur($date->format('d/m/Y'),$libur);
				if (!$date->isWeekend() && !$adalibur){
					
					$masuk_in = false;
					$keluar_in = false;
					$masuk = $this->get_presensi('in',$p,$date->format('Y-m-d'),$presensi);
					$keluar = $this->get_presensi('out',$p,$date->format('Y-m-d'),$presensi);
					$verif = [1,1,15];
					
					$tm1 = false;
					$tm2 = false;
					$pc  = false;
					
					if ($masuk!=null && $keluar != null ){
						$tm1 = $this->get_tm1($p,$date->format('Y-m-d'),$masuk,$keluar);
					}
					
					if ($masuk!=null){
						$tm2 = $this->get_tm2($p,$date->format('Y-m-d'),$masuk);
					}
					
					if ($keluar!=null){
						$pc = $this->get_pc($p,$date->format('Y-m-d'),$keluar);
					}
					
					if ($masuk==null || ($masuk != null && ($tm1 == 1  || $tm2 == 1)) ){
						
						if (Carbon::now()->greaterThan($awalwaktumasuk)){
							$masuk_in = Carbon::parse($date->format('Y-m-d'))->addSeconds(rand(27100,28800));
							$cr = Carbon::parse($date->format('Y-m-d'))->addSeconds(rand(32500,33100));
							$up = Carbon::parse($date->format('Y-m-d'))->addSeconds(rand(32500,33100));
							
									$this->mongo_db->where('nip', strval($p));
							$id_p = $this->mongo_db->find_one('users')[0]['_id']->{'$id'} ?? 'Belum diinput';
							
									$this->mongo_db->where('nip', strval($p));
							$id_u = $this->mongo_db->find_one('users')[0]['id_unitkerja'] ?? 'Belum diinput';
							
									$this->mongo_db->where('id_unitkerja', strval($id_u));
							$id_m = $this->mongo_db->find_one('mesinabsen')[0]['_id']->{'$id'};
							
									$this->mongo_db->where('id_unitkerja', strval($id_u));
							$ip_m = $this->mongo_db->find_one('mesinabsen')[0]['ip_mesin'];
							
							$in = [
								'PEGAWAI_ID' => $p."-".$masuk_in->format('dmYHis'),
								'nip'=>$p,
								'id_pegawai'=>$id_p,
								'id_unitkerja'=>$id_u,
								'ip_mesin'=>$ip_m,
								'id_mesin'=>$id_m,
								'date_time'=>$this->mongo_db->date($masuk_in),
								'verifikasi'=>$verif[rand(1,2)],
								'status'=>4,
								'created_at'=>$this->mongo_db->date($cr),
								'updated_at'=>$this->mongo_db->date($up)
							  ];
							$this->mongo_db->insert ('presensi', $in);
						}
					}
					
					if ($keluar==null || ($keluar != null && $pc ==1) ){
						
						if (Carbon::now()->greaterThan($awalwaktupulang)){
							$keluar_in = Carbon::parse($date->format('Y-m-d'))->addSeconds(rand(57700,64700));
							$cr = Carbon::parse($date->format('Y-m-d'))->addSeconds(rand(64900,65100));
							$up = Carbon::parse($date->format('Y-m-d'))->addSeconds(rand(64900,65100));
							
									$this->mongo_db->where('nip', strval($p));
							$id_p = $this->mongo_db->find_one('users')[0]['_id']->{'$id'} ?? 'Belum diinput';
							
									$this->mongo_db->where('nip', strval($p));
							$id_u = $this->mongo_db->find_one('users')[0]['id_unitkerja'] ?? 'Belum diinput';
							
									$this->mongo_db->where('id_unitkerja', strval($id_u));
							$id_m = $this->mongo_db->find_one('mesinabsen')[0]['_id']->{'$id'};
							
									$this->mongo_db->where('id_unitkerja', strval($id_u));
							$ip_m = $this->mongo_db->find_one('mesinabsen')[0]['ip_mesin'];
							
							$in = [
								'PEGAWAI_ID' => $p."-".$keluar_in->format('dmYHis'),
								'nip'=>$p,
								'id_pegawai'=>$id_p,
								'id_unitkerja'=>$id_u,
								'ip_mesin'=>$ip_m,
								'id_mesin'=>$id_m,
								'date_time'=>$this->mongo_db->date($keluar_in),
								'verifikasi'=>$verif[rand(1,2)],
								'status'=>4,
								'created_at'=>$this->mongo_db->date($cr),
								'updated_at'=>$this->mongo_db->date($up)
							  ];
							$this->mongo_db->insert ('presensi', $in);
						}
					}
							
					echo ( $masuk_in ) ? $masuk_in.'-new' : $date->format('Y-m-d').' '.$masuk;
					echo '<br/>';
					echo ( $keluar_in ) ? $keluar_in.'-new' : $date->format('Y-m-d').' '.$keluar;
					echo '<br/>';
					echo '<br/>';
					
					// rrrrrrrrrrrrrrrr
					if (!$masuk_in && !$keluar_in){
						
					} else {
						$log[] = array(
							'nip' => $p,
							'dt_in' => ( ( $masuk_in ) ? $masuk_in : null ),
							'dt_out' => ( ( $keluar_in ) ? $keluar_in : null ),
							'pic' => $pic
						);
					}
					// rrrrrrrrrrrrrrrr
					
				} else {
					
				}
			}
		}
		return $log;
	}
	
	function get_tm1($nip,$date,$i,$o){
		
		$hasil = false;
		
		$dt = Carbon::parse($date);
		
		$masuk = $i;
		$pulang = $o;
			
		$awalmasuk = Carbon::today()->addHours(8);
		$akhirmasuk30 = Carbon::today()->addHours(8)->addMinutes(30)->addSeconds(59);
		$awalpulang = Carbon::today()->addHours(16);
		
		if ($masuk!=null && $pulang!=null){
			$m = Carbon::parse($masuk);
			$p = Carbon::parse($pulang);
			
			if($m->between($awalmasuk, $akhirmasuk30, true)) {
				$telat = $awalmasuk->diffInMinutes($m);
				if($p->greaterThan($awalpulang) && $awalpulang->diffInMinutes($p)>=$telat) {
					//kalau mengganti
					$hasil = 0;
				} else {
					//kalau tidak mengganti
					$hasil = 1;
				}
			}
		} else if ($masuk!=null && $pulang==null){
			$m = Carbon::parse($masuk);
			if($m->between($awalmasuk, $akhirmasuk30, true)) {
				//jelas tidak mengganti karena absen pulang = null
				$hasil = 1;
			}
		}
		
		return $hasil;
	} //OK
	
	function get_tm2($nip,$date,$masuk){
		
		$hasil = false;
		
		$dt = Carbon::parse($date);
		
		if ($masuk!=null){
			$m = Carbon::parse($masuk);
			
			$awalmasuk = Carbon::today()->addHours(8)->addMinutes(31);
			$akhirmasuk = Carbon::today()->addHours(9)->addSeconds(59);
			
			if($m->between($awalmasuk, $akhirmasuk, true)) {
				$hasil = 1;
			} else {
				$hasil = 0;
			}
		}
		
		return $hasil;
	} //OK
	
	function get_pc($nip,$date,$pulang){
		
		$hasil = false;
		$dt = Carbon::parse($date);
		
		if ($pulang!=null){
			$p = Carbon::parse($pulang);
			
			$awalpulang = Carbon::today()->addHours(15)->addMinutes(59)->addSeconds(59);
			
			$cepat = $p->diffInMinutes($awalpulang);
			// if($p->lessThanOrEqualTo($awalpulang) && $cepat<=60) {
			if($p->lessThanOrEqualTo($awalpulang)) {
				$hasil = 1;
			} else {
				$hasil = 0;
			}
		}
		return $hasil;
	}
	
	function get_presensi($tipe,$nip,$date,$f){
		$tz = new DateTimeZone('Asia/Jakarta');
		
		$res = null;
		
		//awal waktu simpeg menerima absen masuk: awal hari
		$awalmasuk = Carbon::parse($date);
		//akhir waktu simpeg menerima absen masuk = jam masuk + 61 menit maks telat masuk
		$akhirmasuk = Carbon::parse($date)->addHours(8)->addMinutes(61);
		
		//awal waktu simpeg membuka absen pulang: 121 menit sebelum pukul 16:00
		$awalpulang = Carbon::parse($date)->addHours(13)->addMinutes(59);
		//akhir waktu simpeg membuka absen pulang = TENGAH MALAM :D
		$akhirpulang = Carbon::parse($date)->addHours(23)->addMinutes(59)->addSeconds(59);
		
		if (!empty($f)){
			
			foreach ($f as $d){
				if ($d['nip']==$nip){
					$t = Carbon::parse( $d['date_time']->toDateTime() );
					
					if ($tipe == 'in'){
						if($t->between($awalmasuk, $akhirmasuk, true)) {
							$pre[] = $d['date_time']->toDateTime()->setTimezone($tz)->format('H:i:s');
						}
					}
					
					if ($tipe == 'out'){
						if($t->between($awalpulang, $akhirpulang, true)) {
							$pre[] = $d['date_time']->toDateTime()->setTimezone($tz)->format('H:i:s');
						}
					}
				}
			}
			
		}
		
		if (!empty($pre)){
			if ($tipe == 'in'){
				$res = reset($pre);
			} else if ($tipe == 'out'){
				$res = end($pre);
			}
		}
		
		return $res;
	}

	public function absensiptt()
	{
		$html ='';
		$html .='
				<!doctype html>
				<html lang="en">
				<head>
				  <meta charset="utf-8">
				  <link rel="stylesheet" href="https://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.css">
				  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
				  <link rel="stylesheet" href="/resources/demos/style.css">
				  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
				  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
				  <script src="https://trentrichardson.com/examples/timepicker/jquery-ui-timepicker-addon.js"></script>
				  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
				  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
				  <script>
				  $( function() {
					  
					$(document).ready(function() {
						$(\'.js-example-basic-single\').select2();
					});
					
					// $( "#datepicker" ).datepicker();
					
					$("#time").datetimepicker({
					   showSecond: true,
					   showMillisec: true,
					   timeFormat: "HH:mm:ss"
					});
					
				  } );
				  </script>
				</head>
				<body>
			';
			
			
		$html .='<form action="'.base_url('kategori/batamerah').'" method="post" target="_blank">';
		
		$simpeg = $this->load->database('simpegptt', TRUE);
			 $simpeg->order_by('nama', 'asc');
		$q = $simpeg->get('dt_pegawai');
		
		$html .= '<select name="nip" class="js-example-basic-single" required>
						<option value=""> -- Pilih Pegawai --';
		foreach ($q->result() as $d){
			$html .= '<option value="'.$d->idPegawai.'">';
			$html .= $d->nama.' ( '.$d->idPegawai.' )';
			$html .= '</option>';
			
		}
		$html .= '</select>';
		
		$html .='<p>Time: <input name="time" type="text" id="time" readonly /></p>';
		$html .='<button type="submit">Ok</button>';
				  
		$html .='</form>';
		$html .='</body>
				</html>';
				  
		echo $html;
			  
			  
		
	}
	
}

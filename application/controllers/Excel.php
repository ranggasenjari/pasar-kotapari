<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Excel extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    }
    public function index()
    {
        $this->load->view('excel');
    }
    public function semuadesa()
    {
        $q = $this->db->get('villages');
		foreach ($q->result() as $des){
			echo $des->id.'-'.$des->district_id.'-'.$des->name.'<br/>';
		}
    }
	
	
    public function upload(){
        $fileName = time().$_FILES['file']['name'];
         
        $config['upload_path'] = './rsc/'; //buat folder dengan nama assets di root folder
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;
         
        $this->load->library('upload');
        $this->upload->initialize($config);
         
        if(! $this->upload->do_upload('file') )
        $this->upload->display_errors();
		
             
        $media = $this->upload->data('file');
        //$inputFileName = './rsc/'.$media['file_name'];
		print_r($media);
       // PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
		
        // try {
                // $inputFileType = IOFactory::identify($inputFileName);
                // $objReader = IOFactory::createReader($inputFileType);
                // $objPHPExcel = $objReader->load($inputFileName);
            // } catch(Exception $e) {
                // die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            // }
 
            // $sheet = $objPHPExcel->getSheet(0);
            // $highestRow = $sheet->getHighestRow();
            // $highestColumn = $sheet->getHighestColumn();
             
            // for ($row = 2; $row <= $highestRow; $row++){                 
                // $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                                // NULL,
                                                // TRUE,
                                                // FALSE);
                                                    
				// $idusaha = $this->user_model->get_unused_usaha_id();
				// $tanggal = date('Y-m-d H:i:s');
				
                 // $usaha = array(
                    // "id_usaha"=> $idusaha,
                    // "id_kat_usaha"=> 1,
                    // "nama_usaha"=> $rowData[0][1],
                    // "id_pemilik"=> '',
                    // "tgl_publish"=> $tanggal,
                    // "alamat"=> $rowData[0][3],
                    // "id_kecamatan"=> $rowData[0][5],
                    // "id_desa"=> $rowData[0][4],
                    // "verifikasi"=> 1
                // );
				
                 // $verif = array(
                    // "id_usaha"=> $idusaha,
                    // "id_operator"=> 9,
                    // "berkas"=> '',
                    // "keterangan"=> 'Import Data Excel',
                    // "tgl_verifikasi"=> $tanggal,
                    // "hash"=> md5($idusaha.'|9||Import Data Excel|'.$tanggal),
                    // "status"=> 1
                // );
				
                 // $produk = array(
                    // "id_usaha"=> $idusaha,
                    // "id_kat_produk"=> null,
                    // "nama_produk"=> $rowData[0][2],
                    // "detil"=> '',
                    // "kondisi"=> 'baru',
                    // "hits"=> 0,
                    // "created_at"=> $tanggal
                // );
                 
                // $this->db->insert("dt_usaha",$usaha);
                // $this->db->insert("dt_verifikasi",$verif);
                // $this->db->insert("dt_produk",$produk);
				
				// echo $rowData[0][2];
                // delete_files($media['file_path']);
                     
            // }
        
    }
}
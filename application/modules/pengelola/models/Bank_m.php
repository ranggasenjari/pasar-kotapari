<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_m extends CI_Model {

    var $spinsert 		= 	'[dbo].[psr_insert_bank] ?, ?, ?, ?, ?, ?, ?, ? ';
    var $spupdate		=	'[dbo].[psr_update_bank] ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ';
    var $spgetdatabyid 	=	'[dbo].[psr_getdata_bank_byid] ?, ?, ?, ?, ?, ? ';
    var $spdelete 		=	'[dbo].[psr_delete_bank] ?, ?, ?, ?, ?, ? ';
    var $spsetkode 		=	'[dbo].[psr_setnokdbank] ';
    var $spgetdata 		=	'[dbo].[psr_getdata_bank] ?, ?, ?, ?, ?, ?';
    var $spcountall 	=	'[dbo].[psr_count_tbl] ?';
    var $spcountfilter 	=	'[dbo].[psr_count_filter_bank] ?';
    var $namatable 		= 	'Ref_Bank';
    //var $tablejoin 		= 'Ref_peraturan';
	var $column_order 	= 	array('Kd_Akrual_1', 'Kd_Akrual_2', 'Kd_Akrual_3', 'Kd_Akrual_4', 'Kd_Akrual_5', 'Nm_Akrual_5', null); //set column field database for datatable orderable
	var $column_search 	= 	array('Kd_Akrual_1', 'Kd_Akrual_2', 'Kd_Akrual_3', 'Kd_Akrual_4', 'Kd_Akrual_5', 'Nm_Akrual_5'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('Nm_Akrual_5' => 'A'); // default order 

    public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();
    }

    function get_datatables()
	{
		$list = $this->_get_datatables_query();
		return $list;
		
	}


	function count_filtered()
	{
		$filter='';
		$start = 1; 
		$length = 10;
		$orderby = '';
		$sortdirection = '';
		$proses = 'count';

		if($_POST['search']['value']){
			$filter = $_POST['search']['value'];
			$data = array(
						'filter' 		=> 	$filter
					);
		}
		else{
			$filter = '';
			$data = array(
						'filter' 		=> 	''
					);
		}

		return $this->db->query($this->spcountfilter, $data)->row_array()['JUMLAHSEMUA'];

	}

	public function count_all()
	{
		$filter='';
		$start = 1; 
		$length = 10;
		$orderby = '';
		$sortdirection = '';
		$proses = 'count';

		$data = array(
						'nama_tbl' 		=> 	$this->namatable
					);
		
		return $this->db->query($this->spcountall, $data)->row_array()['JUMLAHSEMUA'];
		
	}

	private function _get_datatables_query()
	{
		$filter='';
		$start = 1; 
		$length = 10;
		$orderby = '';
		$sortdirection = '';
		$proses = '';
		if(!empty($_POST)){
		if($_POST['search']['value']){
			$filter = $_POST['search']['value'];
		}
		else{
			$filter = '';
		}
		if($_POST['length'] != -1){
			$length = $_POST['length'];
			$start = $_POST['start'];
		}
		if(isset($_POST['order'])) // here order processing
		{
			$orderby = $_POST['order']['0']['column'];
			$sortdirection = $_POST['order']['0']['dir'];
		} 
	}
		else if(isset($this->order))
		{
			$order = $this->order;
			$orderby = key($order);
			$sortdirection = $order[key($order)];
			
		}

		$data = array(
						'filter' 		=> 	$filter,
						'start'			=>	$start,
						'length'		=>	$length,
						'orderby'		=>	$orderby,
						'sortdirection'	=>	$sortdirection,
						'proses'		=>	$proses
					);

		return $this->db->query($this->spgetdata, $data)->result_array();
		
	}

	public function savedata($data)
	{
		//$this->db->insert($this->tableutama, $data);
		//return $this->db->insert_id();
		$this->db->query($this->spinsert, $data);
	}

	public function updatedata($data)
	{
		$this->db->query($this->spupdate, $data);
	}

	public function deletedatabyid($data)
	{
		$this->db->query($this->spdelete, $data);
		return $this->db->affected_rows();
	}

	public function getall(){
		
		$filter='';
		$start = 1; 
		$length = 10;
		$orderby = '';
		$sortdirection = '';
		$proses = 'count';

		$data = array(
						'filter' 		=> 	$filter,
						'start'			=>	$start,
						'length'		=>	$length,
						'orderby'		=>	$orderby,
						'sortdirection'	=>	$sortdirection,
						'proses'		=>	$proses
					);
		
		$data = $this->db->query($this->spgetdata, $data);
		if($data->num_rows() > 0){
			return $data->result_array();
		}
		else{
			return null;
		}
	}

	public function setkode(){
			
		$data = $this->db->query($this->spsetkode)->row_array();
		return $data;
	}

	public function getdatabyid($data){
		
		$data = $this->db->query($this->spgetdatabyid, $data);
		if($data->num_rows() > 0){
			return $data->row_array();
		}
		else{
			return null;
		}
	}

	
}
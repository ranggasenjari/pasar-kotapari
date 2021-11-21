<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('gmail'))
{
	function kirim2($data)
	{
		$CI =& get_instance();

		// $config = Array(
			// 'protocol'  => 'smtp',
			// 'smtp_host' => 'ssl://smtp.googlemail.com',
			// 'smtp_port' => 465,
			// 'smtp_user' => 'esuratlangkat@gmail.com',
			// 'smtp_pass' => 'pdelkt14',
			// 'mailtype'  => 'html', 
			// 'charset'   => 'iso-8859-1'
		// );
		// $CI->load->library('email', $config);
		// $CI->email->set_newline("\r\n");

		// $CI->email->from('esuratlangkat@gmail', 'Surat Elektronik Kab. Langkat');
		
		// $CI->email->to($data['to']);
		// $CI->email->subject($data['subjek']);
		// $CI->email->message($data['pesan']);

		// $CI->email->send();
		
		$in_data['tujuan'] = $data['to'];
		$in_data['subjek'] = $data['subjek'];
		$in_data['pesan'] = $data['pesan'];
		$in_data['status'] = 0;
		$CI->db->insert('rg_mail_notif', $in_data);
	}
	
	function save_token($data)
	{
		$CI =& get_instance();

		$config = Array(
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'esuratlangkat@gmail.com',
			'smtp_pass' => 'pdelkt14',
			'mailtype'  => 'html', 
			'charset'   => 'iso-8859-1'
		);
		$CI->load->library('email', $config);
		$CI->email->set_newline("\r\n");

		$CI->email->from('esuratlangkat@gmail', 'Surat Elektronik Kab. Langkat');
		
		$CI->email->to($data['to']);
		$CI->email->subject($data['subjek']);
		$CI->email->message($data['pesan']);

		$CI->email->send();
	}
	
	function kirim($data)
	{
		$CI =& get_instance();

		$config = Array(
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'esuratlangkat@gmail.com',
			'smtp_pass' => 'pdelkt14',
			'mailtype'  => 'html', 
			'charset'   => 'iso-8859-1'
		);
		$CI->load->library('email', $config);
		$CI->email->set_newline("\r\n");

		$CI->email->from('esuratlangkat@gmail', 'Surat Elektronik Kab. Langkat');
		
		$CI->email->to($data['to']);
		$CI->email->subject($data['subjek']);
		$CI->email->message($data['pesan']);

		$CI->email->send();
	}
}

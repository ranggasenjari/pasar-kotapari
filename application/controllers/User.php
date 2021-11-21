<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
		$this->load->helper('auth_helper');
    }

    public function index()
    {
		$this->is_logged_in();
		$d['sub_judul'] = 'Halaman Pengguna |';
        
		$this->load->view('meta', $d);
		$this->load->view('header', $d);
		$this->load->view('user/index', $d);
		$this->load->view('footer', $d);

    }
	
	public function login()
	{
		if ($this->is_logged_in()){
			redirect('/');
		}
		
		// Method should not be directly accessible
		if( $this->uri->uri_string() == 'user/login')
			show_404();

		if( strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post' )
			$this->require_min_level(1);

		$this->setup_login_form();

		$html = $this->load->view('user/login', '', TRUE);

		echo $html;
	}

    public function daftar()
    {
		if (!$this->is_logged_in()){
		$d['sub_judul'] = 'Pendaftaran |';
		$d['kec'] = $this->web_model->get_kecamatan('');
        
		$this->load->view('meta', $d);
		$this->load->view('user/daftar', $d);
		$this->load->view('footer', $d);
		} else {
			redirect(base_url());
		}

    }

    public function cek_uname()
    {
		$cek_uname = $this->db->where('username', $this->input->post('username'))->get(db_table('user_table'));
		if ($cek_uname->num_rows() > 0){
			echo(json_encode(false));
		} else {
			echo(json_encode(true));
		}
    }

    public function cek_email()
    {
		$cek_uname = $this->db->where('email', $this->input->post('mail'))->get(db_table('user_table'));
		if ($cek_uname->num_rows() > 0){
			echo(json_encode(false));
		} else {
			echo(json_encode(true));
		}
    }

    public function cek_nik()
    {
		$adanik = $this->db->where('nik', $this->input->post('nik'))->get(db_table('user_table'));
		$oknik = $this->fungsi->cekNIK($this->input->post('nik'));
		if ($oknik == true){ $nikok = 0; } else { $nikok = 1; }
		$total_error = $adanik->num_rows() + $nikok;
		if ($total_error > 0){
			echo(json_encode(false));
		} else {
			echo(json_encode(true));
		}
    }

    public function tes()
    {
		$this->load->model('web_model');
		echo $this->web_model->cek_usaha(2716630186);
    }
	
	
	public function submit_new()
	{
		
		$this->load->helper('auth');
		$this->load->model('user/user_model');
		$this->load->model('user/validation_callables');
		$this->load->library('form_validation');
		
		// Customize this array for your user
		$user_data = [
			'nik'   => $this->input->post('nik'),
			'alamat'   => $this->input->post('alamat'),
			'id_kecamatan'   => $this->input->post('kec'),
			'id_desa'   => $this->input->post('des'),
			'nama'   => $this->input->post('nama'),
			'email'      => $this->input->post('mail'),
			'hp'      => $this->input->post('hp'),
			'img'      => $this->input->post('foto'),
			'username'   => $this->input->post('username'),
			'passwd'     => $this->input->post('sandi'),
			'auth_level' => '3'
		];
		$u_id    = $this->user_model->get_unused_id();
		
		$usaha_data = [
			'id_kat_usaha'   => $this->input->post('kat'),
			'slug_usaha'   => slugify('usaha',$this->input->post('nama_usaha')),
			'nama_usaha'   => $this->input->post('nama_usaha'),
			'id_kecamatan'   => $this->input->post('kecusaha'),
			'id_desa'   => $this->input->post('desusaha'),
			'id_pemilik'   => $u_id,
			'tgl_publish'      => date('Y-m-d H:i:s'),
			'alamat_usaha'      => $this->input->post('alamat_usaha'),
			'detil'      => $this->input->post('uraian'),
			'status_terbit'   => 1
		];

		$this->is_logged_in();

		// Load resources

		$this->form_validation->set_data( $user_data );
		
		echo $this->load->view('meta', '', TRUE);
		
		$validation_rules = [
			[
				'field' => 'username',
				'label' => 'username',
				'rules' => 'max_length[12]|is_unique[' . db_table('user_table') . '.username]',
				'errors' => [
					'is_unique' => 'Username sudah ada, pilih yang lain.'
				]
			],
			[
				'field' => 'nik',
				'label' => 'nik',
				'rules' => 'is_unique[' . db_table('user_table') . '.nik]',
				'errors' => [
					'is_unique' => 'NIK sudah pernah terdaftar.'
				]
			],
			[
				'field' => 'nama',
				'label' => 'nama',
				'rules' => 'required',
				'errors' => [
					'required' => 'Nama harus diisi.'
				]
			],
			[
				'field' => 'hp',
				'label' => 'hp',
				'rules' => 'required',
				'errors' => [
					'required' => 'Nomor HP harus diisi.'
				]
			],
			[
				'field' => 'passwd',
				'label' => 'passwd',
				'rules' => [
					'trim',
					'required',
					[ 
						'_check_password_strength', 
						[ $this->validation_callables, '_check_password_strength' ] 
					]
				],
				'errors' => [
					'required' => 'Kata sandi harus diisi.'
				]
			],
			[
				'field'  => 'email',
				'label'  => 'email',
				'rules'  => 'required|valid_email|is_unique[' . db_table('user_table') . '.email]',
				'errors' => [
					'is_unique' => 'Alamat email sudah digunakan.'
				]
			],
			[
				'field' => 'auth_level',
				'label' => 'auth_level',
				'rules' => 'required|integer|in_list[1,3]'
			]
		];

		$this->form_validation->set_rules( $validation_rules );

		if( $this->input->post('setuju') == 1){
			if( $this->form_validation->run() )
			{
				$user_data['passwd']     = $this->authentication->hash_passwd($user_data['passwd']);
				$user_data['user_id']    = $u_id;
				$usaha_data['id_usaha']    = $this->user_model->get_unused_usaha_id();
				$user_data['created_at'] = date('Y-m-d H:i:s');

				// If username is not used, it must be entered into the record as NULL
				if( empty( $user_data['username'] ) )
				{
					$user_data['username'] = NULL;
				}
				
				if(empty($_FILES['foto']['name']))
				{
					$user_data['img'] = 'no_image.png';
				} else {
					$config['upload_path'] = config_item('asetdir').'img/profil/';
					$config['allowed_types']= 'gif|jpg|png|jpeg';
					$parts     = explode('.', $_FILES['foto']['name']);
					$ext       = array_pop($parts);
					$find = array('_',' ','.');
					$new_name = gmdate("d-m-Y", time () +60 * 60 * 7).'_'.time().'_'.str_replace($find, '-',implode('-',$parts)).'.'.$ext;
					$config['file_name'] = $new_name;
					$config['overwrite']	= TRUE;
					$config['remove_spaces']	= TRUE;	
					$config['max_size']     = '3000';
					$config['max_width']  	= '3000';
					$config['max_height']  	= '3000';
					$field_name = "foto";
					$this->load->library('upload', $config);

					if ($this->upload->do_upload($field_name)) {
						$data = $this->upload->data();
						$this->load->library('thumb');
						$this->thumb->buat_kecil($data, config_item('asetdir')."img/profil/thumb/", config_item('asetdir')."img/profil/", 200);	
						$user_data['img'] = $data['file_name'];
					} else {
						echo $this->upload->display_errors('<p>','</p>');
					}
				}

				$this->db->set($user_data)
					->insert(db_table('user_table'));

				if( $this->db->affected_rows() == 1 ){
					$this->db->set($usaha_data)
						->insert(db_table('dt_usaha'));
					//echo '<h1>Congratulations</h1>' . '<p>User ' . $user_data['username'] . ' was created.</p>';
					echo $this->load->view('user/suksesdaftar', '', TRUE);
				}
			}
			else
			{
				echo '<h1>User Creation Error(s)</h1>' . validation_errors();
			}
		} else {
			echo '<h1>User Creation Error(s)</h1>';
			echo 'Anda harus menyetujui pernyataan';
		}

		echo $this->load->view('footer', '', TRUE);
	}
	
	public function recover()
	{
		// Load resources
		$this->load->model('user/user_model');

		/// If IP or posted email is on hold, display message
		if( $on_hold = $this->authentication->current_hold_status( TRUE ) )
		{
			$view_data['disabled'] = 1;
		}
		else
		{
			// If the form post looks good
			if( $this->tokens->match && $this->input->post('email') )
			{
				if( $user_data = $this->user_model->get_recovery_data( $this->input->post('email') ) )
				{
					// Check if user is banned
					if( $user_data->banned == '1' )
					{
						// Log an error if banned
						$this->authentication->log_error( $this->input->post('email', TRUE ) );

						// Show special message for banned user
						$view_data['banned'] = 1;
					}
					else
					{
						/**
						 * Use the authentication libraries salt generator for a random string
						 * that will be hashed and stored as the password recovery key.
						 * Method is called 4 times for a 88 character string, and then
						 * trimmed to 72 characters
						 */
						$recovery_code = substr( $this->authentication->random_salt() 
							. $this->authentication->random_salt() 
							. $this->authentication->random_salt() 
							. $this->authentication->random_salt(), 0, 72 );

						// Update user record with recovery code and time
						$this->user_model->update_user_raw_data(
							$user_data->user_id,
							[
								'passwd_recovery_code' => $this->authentication->hash_passwd($recovery_code),
								'passwd_recovery_date' => date('Y-m-d H:i:s')
							]
						);

						// Set the link protocol
						$link_protocol = USE_SSL ? 'https' : NULL;

						// Set URI of link
						$link_uri = 'user/recovery_verification/' . $user_data->user_id . '/' . $recovery_code;

						$view_data['special_link'] = anchor( 
							site_url( $link_uri, $link_protocol ), 
							site_url( $link_uri, $link_protocol ), 
							'target ="_blank"' 
						);

						$view_data['confirmation'] = 1;
						
						$maildata['to'] = $this->input->post('email', TRUE );
						$maildata['subjek'] = '[ePasar Kab. Langkat] Reset Akun';
						$maildata['pesan']='Klik alamat link dibawah ini untuk merubah kata sandi anda. <br><b>'.$view_data['special_link'].'</b>';
						kirim($maildata);
					}
				}

				// There was no match, log an error, and display a message
				else
				{
					// Log the error
					$this->authentication->log_error( $this->input->post('email', TRUE ) );

					$view_data['no_match'] = 1;
				}
			}
		}


		echo $this->load->view('user/recover', ( isset( $view_data ) ) ? $view_data : '', TRUE );
	}
	
	public function recovery_verification( $user_id = '', $recovery_code = '' )
	{
		/// If IP is on hold, display message
		if( $on_hold = $this->authentication->current_hold_status( TRUE ) )
		{
			$view_data['disabled'] = 1;
		}
		else
		{
			// Load resources
			$this->load->model('user/user_model');

			if( 
				/**
				 * Make sure that $user_id is a number and less 
				 * than or equal to 10 characters long
				 */
				is_numeric( $user_id ) && strlen( $user_id ) <= 10 &&

				/**
				 * Make sure that $recovery code is exactly 72 characters long
				 */
				strlen( $recovery_code ) == 72 &&

				/**
				 * Try to get a hashed password recovery 
				 * code and user salt for the user.
				 */
				$recovery_data = $this->user_model->get_recovery_verification_data( $user_id ) )
			{
				/**
				 * Check that the recovery code from the 
				 * email matches the hashed recovery code.
				 */
				if( $recovery_data->passwd_recovery_code == $this->authentication->check_passwd( $recovery_data->passwd_recovery_code, $recovery_code ) )
				{
					$view_data['user_id']       = $user_id;
					$view_data['username']     = $recovery_data->username;
					$view_data['recovery_code'] = $recovery_data->passwd_recovery_code;
				}

				// Link is bad so show message
				else
				{
					$view_data['recovery_error'] = 1;

					// Log an error
					$this->authentication->log_error('');
				}
			}

			// Link is bad so show message
			else
			{
				$view_data['recovery_error'] = 1;

				// Log an error
				$this->authentication->log_error('');
			}

			/**
			 * If form submission is attempting to change password 
			 */
			if( $this->tokens->match )
			{
				$this->user_model->recovery_password_change();
			}
		}


		echo $this->load->view( 'user/recover_passwd', $view_data, TRUE );
	}
	
}

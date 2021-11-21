<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Community Auth - Examples Controller
 *
 * Community Auth is an open source authentication application for CodeIgniter 3
 *
 * @package     Community Auth
 * @author      Robert B Gottier
 * @copyright   Copyright (c) 2011 - 2017, Robert B Gottier. (http://brianswebdesign.com/)
 * @license     BSD - http://www.opensource.org/licenses/BSD-3-Clause
 * @link        http://community-auth.com
 */

class Usrmgr extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
	}

	public function index()
	{
		if ($this->require_role('user')){
			redirect('user/beranda');
		} else if ($this->require_role('seller')){
			redirect('/');
		} else if ($this->require_role('verifikator')){
			redirect('/');
		} else if ($this->require_role('diskominfo')){
			redirect('/');
		} else if ($this->require_role('admin')){
			redirect('/');
		}
	}
	
	public function get_login_form()
	{
		if ($this->input->is_ajax_request()) {
		$modal ="";
		$onhold=0;
		
		if( $this->authentication->on_hold === TRUE )
		{
			$onhold = 1;
		}

		// This check for on hold is for normal login attempts
		else if( $on_hold = $this->authentication->current_hold_status() )
		{
			$onhold = 1;
		}
		
		
		
		$this->tokens->name = 'login_token';
		$link_protocol = USE_SSL ? 'https' : NULL;
		
		
		if ($onhold != 1){
		$modal = '
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header box-success">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-sign-in-alt margin-r5"></i>&nbsp;&nbsp;Masuk ke ePasar Langkat</h4>
              </div>
              <div class="modal-body">';

		$modal .= form_open( 'usrmgr/ajax_login', ['class' => 'std-form'] );

        $modal .= '<div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nama Pengguna / Email</label>
                  <input autocomplete="off" class="form-control input-lg" id="InputEmail" placeholder="Nama Pengguna / Email" type="text" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Sandi masuk</label>
                  <input class="form-control input-lg" id="InputPassword" placeholder="Sandi masuk" type="password" required'; 
				  
				if( config_item('max_chars_for_password') > 0 ){
				$modal .='maxlength="' . config_item('max_chars_for_password') . '"'; 	
				}
		$modal .= '	autocomplete="off"/>
                </div>';
				
				if( config_item('allow_remember_me') )
				{
					
        $modal .= '<div class="checkbox">
                  <label>
                    <input type="checkbox"> Ingat saya?
                  </label>
                </div>';
				}

        $modal .= '</div>
              <!-- /.box-body -->
			<input type="hidden" id="max_allowed_attempts" value="'.config_item('max_allowed_attempts').'" />
			<input type="hidden" id="mins_on_hold" value="'.( config_item('seconds_on_hold') / 60 ).'" />
              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Masuk</button>
				<br/>
                <a href="'.base_url().'user/recover"><span class="">Lupa sandi?</span></a>
              </div>
		</form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->';
		
		$modal .="<script>
			$(document).ready(function(){
				$(document).on( 'submit', 'form', function(e){
					$.ajax({
						type: 'post',
						cache: false,
						url: '" . base_url('usrmgr/ajax_login', $link_protocol ) . "',
						data: {
							'login_string': $('#InputEmail').val(),
							'login_pass': $('#InputPassword').val(),
							'login_token': $('[name=\"login_token\"]').val()
						},
						dataType: 'json',
						success: function(response){
							$('[name=\"login_token\"]').val( response.token );
							console.log(response);
							if(response.status == 1){
								// alert('OK.');
								// e.preventDefault();
								window.location = '".base_url()."';
							}else if(response.status == 0 && response.on_hold){
								alert('Terlalu banyak memasukkan login yang salah, anda di blokir selama 10 menit.');
								e.preventDefault();
							}else if(response.status == 0 && response.count){
								alert('Login gagal ' + response.count + ' kali, setelah ' + $('#max_allowed_attempts').val() + ' kali salah, login akan di blokir.');
								e.preventDefault();
							}
						}
					});
					return false;
				});
			});
		</script>";
		
		} else {
			
			$modal .="Hahahahahaha";
		}
		
		echo $modal;
		
		} else {
			show_404();
		}
		  
		
	}

	public function ajax_login()
	{
		if( $this->input->is_ajax_request() )
		{
			// Allow this page to be an accepted login page
			$this->config->set_item('allowed_pages_for_login', ['usrmgr/ajax_login'] );

			// Make sure we aren't redirecting after a successful login
			$this->authentication->redirect_after_login = FALSE;

			// Do the login attempt
			$this->auth_data = $this->authentication->user_status( 0 );

			// Set user variables if successful login
			if( $this->auth_data )
				$this->_set_user_variables();

			// Call the post auth hook
			$this->post_auth_hook();

			// Login attempt was successful
			if( $this->auth_data )
			{
				echo json_encode([
					'status'   => 1,
					'user_id'  => $this->auth_user_id,
					'username' => $this->auth_username,
					'level'    => $this->auth_level,
					'role'     => $this->auth_role,
					'email'    => $this->auth_email
				]);
			}

			// Login attempt not successful
			else
			{
				$this->tokens->name = 'login_token';

				$on_hold = ( 
					$this->authentication->on_hold === TRUE OR 
					$this->authentication->current_hold_status()
				)
				? 1 : 0;

				echo json_encode([
					'status'  => 0,
					'count'   => $this->authentication->login_errors_count,
					'on_hold' => $on_hold, 
					'token'   => $this->tokens->token()
				]);
			}
		}

		// Show 404 if not AJAX
		else
		{
			show_404();
		}
	}
	

	/**
	 * Log out
	 */
	public function logout()
	{
		$this->authentication->logout();

		// Set redirect protocol
		$redirect_protocol = USE_SSL ? 'https' : NULL;

		//redirect( site_url( LOGIN_PAGE . '?' . AUTH_LOGOUT_PARAM . '=1', $redirect_protocol ) );
		redirect( site_url() );
	}
	
	// -----------------------------------------------------------------------
}

/* End of file Examples.php */
/* Location: /community_auth/controllers/Examples.php */

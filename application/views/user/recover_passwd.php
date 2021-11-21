<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ePasar Kabupaten Langkat | Lupa akun</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= config_item('aset') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= config_item('aset') ?>dist/css/AdminLTE.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= config_item('aset') ?>plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?=base_url()?>"><b>ePasar Kab. Langkat</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
  
<?php

$showform = 1;

if( isset( $validation_errors ) )
{
	echo '
		<div class="callout callout-warning">
			<p>
			Telah terjadi kesalahan Kata sandi GAGAL di ubah, lihat pesan eror berikut.
			</p>
			<ul>
				' . $validation_errors . '
			</ul>
		  </div>
	';
}
else
{
	$display_instructions = 1;
}

if( isset( $validation_passed ) )
{
	echo '
		<div class="callout callout-success">
			<p>
			Kata sandi berhasil diganti! anda sekarang dapat <a href="/' . LOGIN_PAGE . '">login</a>.
			</p>
		  </div>
	';

	$showform = 0;
}
if( isset( $recovery_error ) )
{
	echo '
		<div class="callout callout-warning">
			<p>
			Recovery sudah tidak dapat digunakan karena akan kadaluarsa dalam waktu ' . ( (int) config_item('recovery_code_expiration') / ( 60 * 60 ) ) . ' jam. silahkan kembali ke halaman <a href="/user/recover">Reset sandi</a> untuk mengulangi langkah recovery kembali.
			</p>
		  </div>
	';

	$showform = 0;
}
if( isset( $disabled ) )
{
	echo '
		<div class="callout callout-warning">
			<p>Recovery di matikan sementara untuk akun anda karena anda telah melampaui batas percobaan recovery akun, Mohon menunggu ' . ( (int) config_item('seconds_on_hold') / 60 ) . ' menit, lalu coba lagi.</p>
		  </div>
	';

	$showform = 0;
}
if( $showform == 1 )
{
	if( isset( $recovery_code, $user_id ) )
	{
		if( isset( $display_instructions ) )
		{
			if( isset( $username ) )
			{
				echo '<p class="text-center">Username untuk akun anda adalah </p>
					<p class="text-center"><strong> <i>' . $username . '</i></strong></p>
					<p class="text-center">Mohon dicatat dan ganti kata sandi anda di bawah:</p>';
			}
			else
			{
				echo '<p class="login-box-msg">Masukkan kata sandi baru Anda.</p>';
			}
		}

		?>
  
<?php
		echo form_open(); 
?>


      <div class="form-group has-feedback">
							<?php
								// PASSWORD LABEL AND INPUT ********************************
								echo form_label('Kata sandi baru','passwd', ['class'=>'form_label']);

								$input_data = [
									'name'       => 'passwd',
									'id'         => 'passwd',
									'class'      => 'form-control password',
									'max_length' => config_item('max_chars_for_password')
								];
								echo form_password($input_data);
							?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
	  
							<?php
								// CONFIRM PASSWORD LABEL AND INPUT ******************************
								echo form_label('Ulangi sandi baru','passwd_confirm', ['class'=>'form_label']);

								$input_data = [
									'name'       => 'passwd_confirm',
									'id'         => 'passwd_confirm',
									'class'      => 'form-control password',
									'max_length' => config_item('max_chars_for_password')
								];
								echo form_password($input_data);
							?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

							<?php
								// RECOVERY CODE *****************************************************************
								echo form_hidden('recovery_code',$recovery_code);

								// USER ID *****************************************************************
								echo form_hidden('user_identification',$user_id);

								// SUBMIT BUTTON **************************************************************
								$input_data = [
									'name'  => 'form_submit',
									'id'    => 'submit_button',
									'class'    => 'btn btn-primary btn-block btn-flat',
									'value' => 'Ubah kata sandi'
								];
								echo form_submit($input_data);
							?>
	 

    </form>
<?php
		}
	}
?>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?= config_item('aset') ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= config_item('aset') ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?= config_item('aset') ?>plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>

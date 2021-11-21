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
if( isset( $disabled ) )
{
	echo '
		<div class="callout callout-warning">
			<p>Recovery di matikan sementara untuk akun anda karena anda telah melampaui batas percobaan recovery akun, Mohon menunggu ' . ( (int) config_item('seconds_on_hold') / 60 ) . ' menit, lalu coba lagi.</p>
		  </div>
	';
}
else if( isset( $banned ) )
{
	echo '
		<div class="callout callout-warning">
			<p>AKUN DIKUNCI, akun yang terkait dengan email ini saat ini sedang dikunci oleh sistem. Hubungi pengelola untuk info lebih lanjut</p>
		  </div>
	';
}
else if( isset( $confirmation ) )
{
	echo '
		<div class="callout callout-warning">
			<p>TERKIRIM! link untuk mereset kata sandi anda telah dikirimkan ke email terkait, silahkan buka email anda dan klik link yang diberikan</p>
		  </div>
	';
}
else if( isset( $no_match ) )
{
	echo '
		<div class="callout callout-warning">
			<p>Email yang anda masukkan tidak terdaftar.</p>
		  </div>
	';

	$show_form = 1;
}
else
{
	$show_form = 1;
}
if( isset( $show_form ) )
{
	?>
  
    <p class="login-box-msg">Masukkan alamat email anda saat mendaftar.</p>
<?php
		echo form_open(); 
?>


      <div class="form-group has-feedback">
						<?php
							// EMAIL ADDRESS *************************************************
							echo form_label('Alamat email','email', ['class'=>'form_label'] );

							$input_data = [
								'name'		=> 'email',
								'id'		=> 'email',
								'class'		=> 'form-control',
								'placeholder'	=> 'Masukkan email',
								'maxlength' => 255
							];
							echo form_input($input_data);
						?>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
	  
						<?php
							// SUBMIT BUTTON **************************************************************
							$input_data = [
								'name'  => 'submit',
								'id'    => 'submit_button',
								'class'    => 'btn btn-primary btn-block btn-flat',
								'value' => 'Kirim ke email'
							];
							echo form_submit($input_data);
						?>
     
	 

    </form>
<?php
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

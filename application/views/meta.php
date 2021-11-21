<?php echo doctype(); ?>
<html>
<head>
	<link rel="manifest" href="manifest.json">

<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="msapplication-starturl" content="/">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<meta charset="utf-8">
	<!--<meta name="theme-color" content="#3c8dbc" /> BIRU -->
	<!--<meta name="theme-color" content="#100a4e" /> TUA -->
	<meta name="theme-color" content="#3c8dbc" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= (isset($sub_judul))?$sub_judul:''; ?> <?= config_item('judul') ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<!--<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">-->
	<meta property="og:locale" content="id_ID" />
	<meta property="og:type" content="website" />
	<meta charset="utf-8">
	<meta name="author" content="abduranggasenjari@gmail.com">
		<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-160169832-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-160169832-1');
	</script>

	<?= (isset($meta))?$meta:''; ?>
	
<style>
/* http://meyerweb.com/eric/tools/css/reset/ 
   v2.0 | 20110126
   License: none (public domain)
*/

html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure, 
footer, header, hgroup, menu, nav, section {
	display: block;
}
body {
	line-height: 1;
}
ol, ul {
	list-style: none;
}
blockquote, q {
	quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: '';
	content: none;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
}

</style>
  
  
  
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= config_item('aset') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= config_item('aset') ?>dist/css/AdminLTE.css">
  
   <!-- Custom style -->
  <link rel="stylesheet" href="<?= config_item('aset') ?>custom/scroll.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= config_item('aset') ?>dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?= config_item('aset') ?>bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?= config_item('aset') ?>bower_components/jquery-confirm2/dist/jquery-confirm.min.css">
  <?php 
  if (isset($css)){
	  foreach ($css as $cs) {
		  echo '<link rel="stylesheet" href="'.$cs.'">';
	  }
  }
  ?>
  
  <link rel="stylesheet" href="<?= config_item('aset') ?>custom/custom.css">

<!-- jQuery 3 -->
<script src="<?= config_item('aset') ?>bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url() ?>pwabuilder-sw-register.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<?php if ($this->agent->is_mobile()){$fixed='fixed';}else{$fixed='';}; ?>
<body class="hold-transition skin-blue layout-top-nav <?=$fixed?>">
<div class="wrapper">



	

	
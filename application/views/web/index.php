  
  <!-- Full Width Column -->
  <div class="content-wrapper" style="background-color: #ffffff;">

	<div style="background: url(<?= $this->config->item('aset') ?>img/epasar-bg_2.png) bottom no-repeat;background-size:cover;background-color: #133c87;background-size:cover;background-blend-mode: hard-light;"> 
	<!--<div style="background: url(https://jdih.langkatkab.go.id/aset/img/epasar-bg.png) bottom no-repeat;background-size:cover;"> -->    

	<div class="container">

	  <!-- Main content -->
      <section class="content">
<div class="row no-padding">
		
	<div class="col-md-8 spacer" <?php if (!$this->agent->is_mobile()){echo 'style="padding-right: 19px;padding-left: 0px;"'; } else {echo 'style="padding-right: 0px;padding-left: 0px;"'; }?>>
		  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

			<div class="carousel-inner">
			  <div class="item active">
				<a href="">
				<img src="<?= $this->config->item('aset') ?>img/epasar-utama.jpg" alt="e-Pasar Utama" style="width: 100%;">
				</a>
			  </div>
			  <div class="item">
				<a href="<?=base_url()?>user/daftar">
				<img src="<?= $this->config->item('aset') ?>img/epasar-daftar.jpg" alt="e-Pasar Daftar" style="width: 100%;">
				</a>
			  </div>
			  <!--<div class="item">
				<a href="">
				<img src="<?= $this->config->item('aset') ?>img/epasar-ikm.jpg" alt="e-Pasar IKM" style="width: 100%;">
				</a>
			  </div>-->
			</div>
			<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
			  <span class="fa fa-angle-left"></span>
			</a>
			<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
			  <span class="fa fa-angle-right"></span>
			</a>
		<!-- /.box-body -->
		</div>
	  <!-- /.box -->
	</div>
	
	<!--<div class="col-md-4 no-padding">-->
	
	
	<div class="col-sm-4 no-padding">
		<a href="<?=base_url()?>search?q=dodol">
		<img src="<?= $this->config->item('aset') ?>img/dodol.jpg" alt="..." class="img img-responsive" style="width: 100%;">
		</a>
		<br/>
	</div>
	
	<div class="col-sm-4 no-padding">
		<a href="<?=base_url()?>search?q=batik">
		<img src="<?= $this->config->item('aset') ?>img/batik.jpg" alt="..." class="img img-responsive" style="width: 100%;">
		</a>

	</div>
		
		
	<!--</div>-->

</div>


<div class="row spacer text-center">

<h4> UNGGULAN  <a href=""><small class="text-primary">Lihat semua > </small></a></h4>
<div id="kat-div" class="kat-div">

    <ul class="ul-kat" style="width: 100%; transform: translate(0px, 0px);">
    <li class="li-kat" style="padding: 0px 5px; width: 10%;">
	<a href="<?=base_url()?>search?q=halua+manisan">
		<div class="img-kat" style='background-image: url("https://4.bp.blogspot.com/-IhVDUE81V94/V3GrS-6uOfI/AAAAAAAAB9g/L8183PbOe5Y959NwHpbO1yHK43Pdg-_lgCKgB/s1600/Screenshot_2016-06-28-05-28-32-1.png");'>
		<div class="sp-kat">Halua</div>
		</div>
	</a></li>
    <li class="li-kat" style="padding: 0px 5px; width: 10%;">
	<a href="<?=base_url()?>search?q=rotan">
		<div class="img-kat" style='background-image: url("https://2.bp.blogspot.com/-sefECkA1GgE/VDebuHTFZOI/AAAAAAAACVI/_8BFO2sjyvI/s1600/karejinan-rotan-peluang-bisnis.jpg");'>
		<div class="sp-kat">Rotan</div>
		</div>
	</a></li>
    <li class="li-kat" style="padding: 0px 5px; width: 10%;">
	<a href="<?=base_url()?>search?q=dodol">
		<div class="img-kat" style='background-image: url("https://usahakeneketo.files.wordpress.com/2015/03/dodol2.jpg");'>
		<div class="sp-kat">Dodol</div>
		</div>
	</a></li>
    <li class="li-kat" style="padding: 0px 5px; width: 10%;">
	<a href="<?=base_url()?>search?q=keramik">
		<div class="img-kat" style='background-image: url("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSgX8qYkMidaDj0s9m9o6DQWSB1jbzHUnIFJQ&usqp=CAU");'>
		<div class="sp-kat">Keramik</div>
		</div>
	</a></li>
    <li class="li-kat" style="padding: 0px 5px; width: 10%;">
	<a href="<?=base_url()?>search?q=bata">
		<div class="img-kat" style='background-image: url("https://sc01.alicdn.com/kf/UT80yeMXExXXXagOFbXw/Traditionally-Handmade-Brick.jpg");'>
		<div class="sp-kat">Bata</div>
		</div>
	</a></li>
    <li class="li-kat" style="padding: 0px 5px; width: 10%;">
	<a href="<?=base_url()?>search?q=kuliner">
		<div class="img-kat" style='background-image: url("https://www.ayonews.com/wp-content/uploads/2016/05/kuliner.jpg");'>
		<div class="sp-kat">Kuliner</div>
		</div>
	</a></li>
    <li class="li-kat" style="padding: 0px 5px; width: 10%;">
	<a href="<?=base_url()?>search?q=wisata">
		<div class="img-kat" style='background-image: url("https://i1.wp.com/discoveryourindonesia.com/wp-content/uploads/2017/04/Tangkahan-Travel-Guide.jpg?resize=200%2C130");'>
		<div class="sp-kat">Wisata</div>
		</div>
	</a></li>
    <li class="li-kat" style="padding: 0px 5px; width: 10%;">
	<a href="<?=base_url()?>search?q=lowongan">
		<div class="img-kat" style='background-image: url("<?= config_item('aset') ?>img/lowongan.jpg");'>
		<div class="sp-kat">Jasa & Lowongan</div>
		</div>
	</a></li>
    <li class="li-kat" style="padding: 0px 5px; width: 10%;">
	<a href="<?=base_url()?>search?q=fashion">
		<div class="img-kat" style='background-image: url("https://www.fashionmuseum.co.uk/sites/fashion_museum/files/hof-100-med.jpg");'>
		<div class="sp-kat">Fashion</div>
		</div>
	</a></li>
    <li class="li-kat" style="padding: 0px 5px; width: 10%;">
	<a href="<?=base_url()?>search?q=gula+merah">
		<div class="img-kat" style='background-image: url("https://storage.googleapis.com/stateless-dietsehat-co-id/2017/11/c03c783d-gula-merah.jpg");'>
		<div class="sp-kat">Gula Merah</div>
		</div>
	</a></li>
    </ul>
	
</div>

</div>

	</section>
</div>
</div>

<div class="container">
<section class="content">

<div class="row">
		
<div class="col-md-4">
<h4> USAHA TERDAFTAR  <a href=""><small class="text-primary">Lihat semua > </small></a></h4>
<?=$this->web_model->get_front_most_usaha(); ?>
 </div>

        <!-- accepted payments column -->
        <div class="col-md-4">
<h4>PENCARIAN POPULER  <a href=""><small class="text-primary">Lihat semua > </small></a></h4>

<div class="box-body no-padding">
                  <ul class="users-list clearfix">
				  
<?=$popularsearch?>
					
					</ul>
                  <!-- /.users-list -->
                </div>
        </div>
				
        <!-- /.col -->
        <div class="col-md-4">
		<?= $komoditas ?>
        </div>
        <!-- /.col -->
</div>
	
  
<!-- <div class="row spacer">
<div class="col-md-12 no-padding text-center">  
<div style="background: url(<?= $this->config->item('aset') ?>img/epasar-bg-news_2.png) bottom no-repeat;background-size:cover;height:24px">
<h4><strong>- SENARAI BERITA -</strong></h4>
</div>

<div class="news-parent" style="background-color: ghostwhite;margin-bottom: 5px;">
<div id="news" class="news-div" style="line-height: 1;">

    <ul class="ul-kat" style="width: 100%; transform: translate(0px, 0px);padding-bottom: 6px;">
	<?= $berita ?>
    </ul>
	
</div>
</div>
</div>
</div> -->



      <!-- title row 
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-home"></i> e-Pasar Langkat
            <small class="pull-right">Dinas Komunikasi dan Informatika Kab. Langkat</small>
          </h2>
        </div>
      </div>-->
      <!-- info row -->
	  
      <div class="row invoice-info">
        <!-- /.col -->
        <div class="col-sm-12 invoice-col no-padding">
			<div class="box box-info">
				<div class="box-header ui-sortable-handle">
				  <i class="fa fa-home"></i>
				  <h3 class="box-title">Portal Pasar Desa Kota Pari</h3>
				</div>
				<div class="box-body">
				

<div class="footer-wrapper-parent">
<div class="footer-wrapper-div">

    <ul class="ul-foot" style="width: 1120px; transform: translate(0px, 0px);padding-bottom: 6px;">
	
		<li class="li-foot" style="width: 250px;">
			<div class="footer-wrapper-content">
			
			<span class="text-muted">
			<p><small><strong>Portal Pasar Desa Kota Pari</strong> adalah layanan pemasaran produk-produk usaha asli Desa Kota Pari Kecamatan Pantai Cermin, Kab. Serdang Bedagai. Layanan ini bersifat GRATIS bagi setiap pelaku usaha di wilayah Desa Kota Pari yang ingin memasarkan produk-produk usahanya.</small></p>
			</span>
			
                      <a href="<?=base_url('user/daftar')?>" class="btn btn-info btn-xs">Daftarkan produk</a>&nbsp;
					  
                      <a href="<?=base_url('usrmgr/get_login_form')?>" class="lg-modal btn btn-success btn-xs">Masuk</a>
					   
			</div>
		</li>
	
		<li class="li-foot" style="width: 250px;">
			<div class="footer-wrapper-content">
				<ul class="list-group list-group-unbordered">
					<li class="list-group-item" style="padding: 5px 5px">
					  <b>Pertanyaan Umum</b>
					</li>
					<li class="list-group-item" style="padding: 5px 5px">
					  <b>Panduan Keamanan</b>
					</li>
					<li class="list-group-item" style="padding: 5px 5px">
					  <b>Kebijakan Privasi</b>
					</li>
					<li class="list-group-item" style="padding: 5px 5px">
					  <b>Lupa kata sandi</b> 
					</li>
					<li class="list-group-item" style="padding: 5px 5px">
					  <b>Pusat Bantuan</b> 
					</li>
				</ul>
			</div>
		</li>
	
		<li class="li-foot" style="width: 250px;">
			<div class="footer-wrapper-content">
			<a href="#">
			
			<img src="<?= $this->config->item('aset') ?>img/wisata.jpg" style="width:200px;vertical-align: top;"/>
			</a>
			</div> 
		</li>
	
		<li class="li-foot" style="width: 250px;">
			<div class="footer-wrapper-content">
			<a href="#"><h6> <strong>Masalah penggunaan web ini?</strong></h6></a>
			<span class="text-muted"><small>Hubungi:</small> <br/><br/>
			<small><strong>Kantor Desa Kota Pari</strong></small> <br/>
			<small><i class="fa fa-home"></i> Jl. Dusun II Desa Kota Pari - 20987</small> <br/>
			<small><i class="fa fa-envelope"></i> kotapari@serdangbedagaikab.go.id</small> <br/>
			<!-- <small><i class="fa fa-phone"></i> (061)8910202</small> <br/> -->
			<small><i class="fab fa-facebook"></i> <a target="_blank" href="https://fb.com/desa.kotapari" style="color: #717171;">Desa Kota Pari</a></small> 
			</span>
			</div>
		</li>
		
    </ul>
	
</div>
</div>
				
				</div>
				<div class="box-footer clearfix">
				
				</div>
			</div>
		  
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

	<!-- /.box -->
      </section>
      <!-- /.content -->
	  
    <!-- /.container -->
</div>
  
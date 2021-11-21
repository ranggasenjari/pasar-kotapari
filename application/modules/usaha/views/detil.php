 <!-- Full Width Column -->
  <div class="content-wrapper">
	<div class="container">

	  <!-- Main content -->
<section class="invoice" style="margin: 0px;">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12 no-padding">
          <h2 class="page-header" style="margin: 10px 0 9px 0;" >
            <strong><?= $dt->nama_usaha ?></strong>
            <small style="font-size: 60% !important;" class="pull-right"> </small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
	  
      <!-- info row -->
      <div class="row invoice-info spacer">
	  
	  <?php if ($this->agent->is_mobile()){ ?>
	  		 
        <div class="col-sm-8 invoice-col no-padding">
		<?php if ($dt->cover != null){ ?>
		<img class="img-responsive pull-right spacer" src="<?= $this->config->item('aset').'img/cover/'.$dt->cover ?>" alt="<?= $dt->nama_usaha ?>" style="max-height:300px !important;">
		<?php } else { ?>
		<img class="img-responsive spacer pull-right" src="https://placehold.it/800x270/<?= random_color() ?>/ffffff&amp;text=<?= urlencode($dt->nama_usaha) ?>" alt="<?= $dt->nama_usaha ?>">
		<?php } ?>
		</div>
		
        <div class="col-sm-4 spacer">
		 <?= ($dt->detil==null)?'tidak ada rincian':$dt->detil; ?>
		 <p></p>
		 </div>
		 
	  <?php } else { ?>
	  
        <div class="col-sm-4 spacer">
		<?= ($dt->detil==null)?'tidak ada rincian':$dt->detil; ?>
		 <p></p>
		 </div>
		
       
        <div class="col-sm-8 invoice-col">
		<?php if ($dt->cover != null){ ?>
		<img class="img-responsive pull-right" src="<?= $this->config->item('aset').'img/cover/'.$dt->cover ?>" alt="<?= $dt->nama_usaha ?>" style="max-height:300px !important;">
		<?php } else { ?>
		<img class="img-responsive pull-right" src="https://placehold.it/800x270/<?= random_color() ?>/ffffff&amp;text=<?= urlencode($dt->nama_usaha) ?>" alt="<?= $dt->nama_usaha ?>">
		<?php } ?>
		</div>
		
	  <?php } ?>
		
		
        <!-- /.col -->
      </div>
      <!-- /.row -->
	  
	<div class="row">
	<div class="col-sm-12 no-padding">
		<img class="img-responsive" src="<?= config_item('aset') ?>img/epasar-bg-news.png">
	</div>
	</div>
	  
	<div class="row">
	<div class="col-sm-12 no-padding">
		<div class="box">
			<div class="box-body ">
			
				<div class="filter-wrapper-parent">
				<div class="filter-wrapper-div">

					<ul class="ul-filter" style="width: 1128px; transform: translate(0px, 0px);">
					
						<li class="li-filter" style="min-width: 100px !important;">
							<div class="filter-wrapper-content">			
								<p class="small text-muted pull-left"><strong><i class="fa fa-map-marker" aria-hidden="true"></i> Desa/Kel <?=ucwords(strtolower($dt->desusaha))?>, Kecamatan <?=ucwords(strtolower($dt->kecusaha))?> </strong></p>
							</div>
						</li>
						<li class="li-filter" style="min-width: 100px !important;">
							<div class="filter-wrapper-content">			
								<p class="small text-muted pull-left"><strong><i class="fa fa-phone-square" aria-hidden="true"></i> <?= ($dt->kontak==null)?'tidak ada kontak':$dt->kontak; ?></strong></p>
							</div>
						</li>
						<li class="li-filter" style="min-width: 100px !important;">
							<div class="filter-wrapper-content">			
								<p class="small text-muted pull-left"><strong><i class="fa fa-tags" aria-hidden="true"></i> Kategori: <?= $dt->uraian ?></strong></p>
							</div>
						</li>
						<li class="li-filter" style="min-width: 100px !important;">
							<div class="filter-wrapper-content">			
								<p class="small text-muted pull-left"><strong><i class="fa fa-calendar" aria-hidden="true"></i> Tgl terbit: <?= date('d/m/Y', strtotime($dt->tgl_publish)) ?></strong></p>
							</div>
						</li>
						<li class="li-filter" style="min-width: 100px !important;">
							<div class="filter-wrapper-content">			
								<p class="small text-muted pull-left"><strong><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?= $this->usaha_model->jlh_produk($dt->id_usaha) ?> produk</strong></p>
							</div>
						</li>
						<li class="li-filter" style="min-width: 100px !important;">
							<div class="filter-wrapper-content">			
								<p class="small text-muted pull-left"><strong><i class="fa fa-user" aria-hidden="true"></i> <?= $this->usaha_model->total_hits('all',$dt->id_usaha) ?> kali produk dilihat</strong></p>
							</div>
						</li>
						<li class="li-filter" style="min-width: 100px !important;">
							<div class="filter-wrapper-content">			
								<p class="small text-muted pull-left <?= ($dt->verifikasi==0)?'':'text-success'; ?>"><strong><i class="fa fa-check" aria-hidden="true"></i> <?= ($dt->verifikasi==0)?'Belum terverifikasi':'Terverifikasi'; ?></strong></p>
							</div>
						</li>
					</ul>
				
				</div>
				</div>
				
			</div>


        <!-- /.box-footer-->
		</div>		
	</div>
	</div>
	  
	<div class="row">
	<div class="col-sm-8 no-padding">
		<div class="box">
			<div class="box-header ui-sortable-handle">
			  <i class="fa fa-industry" aria-hidden="true"></i>
			  <h3 class="box-title">Semua Produk</h3>
			</div>
			<div class="box-body">
	
			<div class="filter-wrapper-parent spacer">
			<div class="filter-wrapper-div">

				<ul class="ul-filter" style="width: 720px; transform: translate(0px, 0px);">
				
					<li class="li-filter" style="width: 170px;">
						<div class="filter-wrapper-content">
							<?= $katfilter ?>
						</div>
					</li>
				
					<li class="li-filter" style="width: 170px;">
						<div class="filter-wrapper-content">
							<?= $kondfilter ?>
						</div>
					</li>
					
					<li class="li-filter" style="width: 170px;">
						<div class="filter-wrapper-content">
					<div class="form-group">
					<label>Urut berdasarkan</label>
					<select id="sort" class="form-control input-sm" placeholder="Semua status" style="width: 100%;">
					  <option value="1">Paling Sesuai</option>
					  <option value="2">Terbaru</option>
					  <option value="3">Terlama</option>
					  <option value="4">Terbanyak di lihat</option>
					</select>
					</div>
						
						</div>
					</li>
				
				</ul>
					
			</div>
			</div>
			
			<div id="produk">
			<?= $produk ?>
			</div>

			</div>
        <!-- /.box-footer-->
		</div>		
	</div>
	
	<div class="col-sm-4 <?=($this->agent->is_mobile())?'no-padding':'';?>">
	<div class="row">
		<div class="col-sm-12 <?=($this->agent->is_mobile())?'no-padding':'';?>">
		<div class="box box-solid box-default">
			<div class="box-header ui-sortable-handle">
			  <i class="fa fa-map-marker" aria-hidden="true"></i>
			  <h5 class="box-title">Lokasi dan Cabang</h5>
			</div>
			<div class="box-body">
			
			<table class="table table-bordered">
				<tr>
				  <td colspan='2'><strong>Alamat Utama</strong></td>
				</tr>
				<tr>
				  <td><?=$dt->alamat_usaha?></td>
				  <td><p class="text-muted"><small>Desa/Kel <?=ucwords(strtolower($dt->desauser))?></small>
				  <br/><small>Kec. <?=ucwords(strtolower($dt->kecuser))?></small></p>
				 
				  <?php
					if ($dt->la!=null){
				  ?>
				  
				  <button onClick="PopupCenter('<?php echo base_url(); ?>web/viewpetautama/<?=$dt->id_usaha?>', 'Lokasi', 650, 450)" type="button" class="btn btn-block btn-info btn-xs"><i class="fa fa-map" aria-hidden="true"></i> Lihat peta</button>
				  
				  <?php
					}
				  ?>
				  </td>
				</tr>
			</table>
			
			<?php
				if ($cabang->num_rows()!=0){
			?>
			<br/>
			<table class="table table-bordered table-striped">
				<tr>
				  <td>#</td>
				  <td colspan='2'><strong>Alamat Cabang</strong></td>
				</tr>
				<?php
					
						$i=1;
						foreach ($cabang->result() as $c){
				?>
				<tr>
				  <td><?=$i?></td>
				  <td><?=$c->alamat_usaha?></td>
				  <td><p class="text-muted"><small>Desa/Kel <?=ucwords(strtolower($c->des))?></small>
				  <br/><small>Kec. <?=ucwords(strtolower($c->kec))?></small></p>
				  
				  <?php
					if ($c->la!=null){
				  ?>
				  <button onClick="PopupCenter('<?php echo base_url(); ?>web/viewpeta/<?=$c->id_lokasi?>', 'Lokasi', 650, 450)" type="button" class="btn btn-block btn-info btn-xs"><i class="fa fa-map" aria-hidden="true"></i> Lihat peta</button>
				  <?php
					}
				  ?>
				  
				  </td>
				</tr>
				
				<?php
						$i++;
						}
				?>
			</table>
			
			<?php
				}
			?>
			
			</div>
		</div>
		</div>
	
	<div class="col-sm-12 <?=($this->agent->is_mobile())?'no-padding':'';?>">
		<div class="box box-solid box-info">
			<div class="box-header ui-sortable-handle">
			  <i class="fa fa-user" aria-hidden="true"></i>
			  <h5 class="box-title">Informasi Pemilik</h5>
			</div>
			<div class="box-body">
			
			<?php
			if ($dt->id_pemilik==null){ ?>
				
			<ul class="text-center" style="border-color: #eee;">
			<li class="user-header" style="padding: 10px;">
			  <img style="width: 100px;" src="<?php echo config_item('aset').'img/profil/thumb/no_image.png'; ?>" class="img-circle" alt="No User">
			</li>
			</ul>
				
			<ul class="text-center" style="border-color: #eee;">
			<li class="user-header" >
				<div class="alert alert-warning no-padding">
					<h4><i class="icon fa fa-warning"></i> Perhatian!</h4>
					Belum ada pengguna atau user yang terdaftar atas nama usaha / toko ini. Jika usaha / toko ini milik anda, silahkan ajukan klaim untuk mengelola usaha ini. Panduan lengkapnya silahkan klik pada <strong><a href="<?=base_url('p/klaim')?>">HALAMAN INI</a></strong>
				</div>
			</li>
			</ul>
			
			<?php } else { ?>
			<ul class="text-center" style="border-color: #eee;">
			<li class="user-header" style="background-color: #3b4c95 !important; padding: 10px;">
			  <img style="width: 100px;" src="<?php echo config_item('aset').'img/profil/thumb/'.$dt->img; ?>" class="img-circle" alt="<?php echo $dt->nama; ?>">

			  <p style="color: rgba(255, 255, 255, 0.8); font-size: 17px; margin-top: 10px; ">
				<?php echo $dt->nama; ?> <?=br()?> <strong><?php echo (($dt->nama_usaha==null))?'':$dt->nama_usaha; ?></strong><br/>
				<small>Desa/Kel <?=ucwords(strtolower($dt->desauser))?>, Kec. <?=ucwords(strtolower($dt->kecuser))?></small>
			  </p>
			</li>
			</ul>
						
			
			<?php } ?>
			

			
			</div>
		</div>
	</div>
	
	</div>
	</div>
	

	
	
	</div>
	
    </section>
</div>
<script>
// function PopupCenter(pageURL, title,w,h) {
	// var left = 0;
	// var top = 0;
	// var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
// }
  function PopupCenter(pageURL, title, w, h) {
	
	  
    $.confirm({
        title: title,
        content: '<iframe id="loc" style="width:100%;height:100vh;" src="'+pageURL+'"></iframe>',
		columnClass: 'medium',
		onContentReady: function () {
			var mheight = $('.jconfirm-content-pane').height();
			$('#loc').css('height', mheight+'px');
			
		}
		// theme: 'supervan'
		// content: function () {
			// var self = this;
			// return $.ajax({
				// url: pageURL,
				// dataType: 'html',
				// method: 'get'
			// }).done(function (response) {
				// self.setContent(response);
			// }).fail(function(){
				// self.setContent('Something went wrong.');
			// });
		// }
    });
  }
function getParam(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    // return decodeURIComponent(results[2].replace(/\+/g, " "));
    return results[2];
}

$(function () {
	var u = $(location).attr('href');
	$("#katproduk, #kondisi, #sort").on("change", function() {
		if ($("#katproduk").val()){var k = '&k='+$("#katproduk").val();} else {var k = '';}
		if ($("#kondisi").val()){var s = '&s='+$("#kondisi").val();} else {var s = '';}
		if ($("#sort").val()){var sort = '&sort='+$("#sort").val();} else {var sort = '';}
		window.history.pushState("string", "Title", "?a=filter"+k+s+sort);
		
		$.get(u+"?a=filter"+k+s+sort, function( data ) {
			$("#produk").html(data);
			return false;
		}, 'html');	
		
	});

});
</script>
  
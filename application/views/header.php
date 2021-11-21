<?php
		
if (isset($auth_user_id)){
	if ($this->web_model->cek_usaha($auth_user_id)==0){
		$udata = $this->web_model->udata_usronly($auth_user_id);
	} else {
		$udata = $this->web_model->udata($auth_user_id);
	}
}
?>
  <header class="main-header">
    <!--<nav class="navbar navbar-static-top" style="background-color: #3c8dbc;">-->
    <nav class="navbar navbar-static-top" style="background-color: #004df5 !important;">
      <div class="container">
        <div class="navbar-header" <?php if ($this->agent->is_mobile()){echo 'style="margin-right:0px;margin-left:0px;"';} ?>>
          <a href="<?=base_url()?>" class="navbar-brand" style="padding: 5px 15px;"><img src="<?php echo config_item('aset').'img/langkat.gif'; ?>" alt="" height="41"></a>
		  <a href="<?=base_url()?>" class="navbar-brand" <?php if ($this->agent->is_mobile()){echo 'style="padding: 15px 0px;"';} ?>><b>Portal Pasar Kota Pari</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- /.navbar-collapse -->
		<div class="collapse navbar-collapse pull-left" id="navbar-collapse" <?php if ($this->agent->is_mobile()){echo 'style="margin-right:0px;margin-left:0px;"';} ?>>
		  <ul class="nav navbar-nav">

			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Kategori Utama <span class="caret"></span></a>
			  <ul class="dropdown-menu" role="menu">
				<?php echo $this->web_model->get_kat_utama_produk(); ?>
				<li class="divider"></li>
				<li><a href="#">Semua Kategori</a></li>
			  </ul>
			</li>
			<li><a href="<?= base_url('p/info') ?>">Bantuan </a></li>
			<!--<li><a href="<?= base_url('p/kontak') ?>">Kontak</a></li>-->
				<?php
				echo isset($auth_user_id)
				? ''	
				: '<li><a href="'.base_url('user/daftar').'"><i class="fa fa-user-plus margin-r5"></i> Daftar</a></li>';
			?>
		  </ul>
		</div>
		

		
        <div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<?php
				echo isset($auth_user_id)
				? ''	
				: '<li><a class="lg-modal" href="'.base_url('usrmgr/get_login_form').'"><i class="fa fa-sign-in-alt margin-r5"></i>&nbsp; LOGIN</a></li>';
			?>
				
				<?php
				if (isset($auth_user_id)) { ?>
<!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="<?php echo config_item('aset').'img/profil/thumb/'.$udata->img; ?>" class="user-image" alt="<?php echo $udata->nama; ?>">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?php echo $udata->nama; ?></span>
              </a>
              <ul class="dropdown-menu" style="width: 300px !important;">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="<?php echo config_item('aset').'img/profil/thumb/'.$udata->img; ?>" class="img-circle" alt="<?php echo $udata->nama; ?>">

                  <p>
                    <?php echo $udata->nama; ?> <?=br()?> <strong><?php echo (!isset($udata->nama_usaha))?'':$udata->nama_usaha; ?></strong>
                    <!--<small><?=ucwords(strtolower($udata->desusaha))?>, Kec. <?=ucwords(strtolower($udata->kecusaha))?></small>-->
                  </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
				<?php if (isset($udata->nama_usaha)){?>
                  <div class="row">
                    <div class="col-xs-4 text-center" style="padding-right: 5px !important; padding-left: 5px !important;">
                       <a href="<?=base_url('usaha/'.$udata->id_usaha.'/'.$udata->slug_usaha)?>" class="btn btn-default btn-xs">Lihat toko</a>
                    </div>
                    <div class="col-xs-4 text-center" style="padding-right: 5px !important; padding-left: 5px !important;">
                      <a href="<?=base_url('usaha')?>" class="btn btn-default btn-xs">Kelola toko</a>
                    </div>
                    <div class="col-xs-4 text-center" style="padding-right: 5px !important; padding-left: 5px !important;">
                       <a href="<?=base_url('usaha/produk')?>" class="btn btn-default btn-xs">Kelola Produk</a>
                    </div>
                  </div>
                  <!-- /.row -->
				<?php } else { ?>
                  <div class="row">
                    <div class="col-xs-12 text-center">
                      <a href="#" class="btn btn-default btn-xs">Tambah / Klaim usaha</a>
                    </div>
                  </div>
				<?php } ?>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <!-- <a href="#" class="btn btn-default btn-flat">Profil</a> -->
                  </div>
                  <div class="pull-right">
                    <a href="<?=base_url('usrmgr/logout')?>" class="btn btn-default btn-flat">Keluar</a>
                  </div>
                </li>
              </ul>
            </li>
			<?php } ?>
				
			</ul>
        </div>
        <!-- Navbar Right Menu -->
        <!-- /.navbar-custom-menu -->
      </div>
	  
		<div class="container">
		
		<div class="row" style="margin-right: 0px;margin-left: 0px;">
		<div class="col-md-12 no-padding">
		
		<form action="<?=base_url("search")?>" method="get">
			<div class="form-group">
			<div class="input-group">
				<input class="form-control input-lg" id="navbar-search-input" name="q" placeholder="Cari Produk / Toko" type="text" autocomplete="off" style="background: rgb(255, 255, 255);border-color: #fe9d00;font-style: italic;" required />
				<span class="input-group-btn">
					  <button type="submit" class="btn btn-info btn-flat btn-lg" style="background-color: #fe9d00;border-color: #fff;" >Cari</button>
				</span>
			</div>
			</div>
		</form>
		
		</div>
		</div>
		
		</div>
	  <!-- /.container-fluid -->
    </nav>
 

 </header>
  

        <div class="modal modal-default fade" id="modal-login">
		
        </div>
        <!-- /.modal -->
  


	

	
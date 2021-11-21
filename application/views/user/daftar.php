  <!-- Full Width Column -->
  <div class="content-wrapper">
	<div class="container">

	  <!-- Main content -->
    <section class="content">

	
	<form role="form" method="post" enctype="multipart/form-data" id="register_form" action="<?php echo base_url('user/submit_new'); ?>">
      <div class="row invoice-info text-center no-padding">
	  <div class="col-sm-12 invoice-col">
	  <div class="box box-solid">
	  <div class="box-body">
		<h2>FORMULIR PENDAFTARAN</h2>
		<h5>Portal Pasar Desa Kota Pari</h5>
      </div>
      </div>
      </div>
      </div>
	  
      <div class="row invoice-info">
        <!-- /.col -->
        <div class="col-sm-4">
			  <div class="box box-solid">
				<div class="box-header with-border">
				  <h3 class="box-title">Data Pemilik Usaha</h3>
				</div>
				  <div class="box-body">
				  
				  
				  
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-id-card"></i></span>
							<input name="nik" id="nik" type="text" class="form-control input-sm"  placeholder="Nomor KTP">
						</div>
					</div>
					<div class="form-group">
					  <input name="nama" type="text" class="form-control input-sm" id="exampleInputEmail1" placeholder="Nama Lengkap" >
					</div>
				  
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-mobile"></i></span>
							<input name="hp" type="text" class="form-control input-sm pakeicon" id="exampleInputpHp" placeholder="Nomor HP" >
						</div>
					</div>
				
					<div class="form-group">
					  <input name="alamat" type="text" class="form-control input-sm" id="exampleInputEmail1" placeholder="Alamat Lengkap" >
					</div>

					<?=br()?>
					<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
						  <select name="kec" id="kec" class="select form-control input-sm" >
							<option value="">-- Pilih Kecamatan --</option>
							<?=$kec?>
						  </select>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
						  <select name="des" id="des" class="select form-control input-sm" >
							<option value="">-- Pilih Desa/Kelurahan --</option>
						  </select>
						</div>
					</div>
					</div>
					


					<div class="form-group">
					  <label for="id-input-file-3">Pilih Foto Profil <i class="fa fa-fw fa-arrow-down"></i></label>
					  <input name="foto" class="filestyle input-sm" name="foto" id="id-input-file-3" type="file" >
					</div>
					
				  </div>
				  <!-- /.box-body -->
			</div>
		  
        </div>
        <!-- /.col -->
        <div class="col-sm-4">
			  <div class="box box-solid">
				<div class="box-header with-border">
				  <h3 class="box-title">Data Usaha / Dagangan / Jasa</h3>
				</div>
				  <div class="box-body">
				  
				  
				
					<div class="form-group">
					  <input name="nama_usaha" type="text" class="form-control input-lg" id="exampleInputEmail1" placeholder="Nama Usaha" >
					</div>
					
					<div class="form-group">
						<textarea class="form-control has-control uraian" name="uraian" placeholder="Tuliskan deskripsi ringkas mengenai usahamu disini" rows="3"></textarea>
					</div>
					
						<div class="form-group">
						  <select name="kat" id="kat" class="select form-control input-sm" >
							<option value="">-- Kategori --</option>
							<?=$this->web_model->kat_usaha_select('')?>
						  </select>
						</div>
				
					<div class="form-group">
					  <input name="alamat_usaha" type="text" class="form-control input-sm" id="exampleInputEmail1" placeholder="Alamat Usaha" >
					</div>

					<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
						  <select name="kecusaha" id="kecusaha" class="select form-control input-sm" >
							<option value="">-- Pilih Kecamatan --</option>
							<?=$kec?>
						  </select>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group select-container">
						  <select name="desusaha" id="desusaha" class="select form-control input-sm" >
							<option value="">-- Pilih Desa/Kelurahan --</option>
						  </select>
						</div>
					</div>
					</div>
				<?=br()?>
				  
					
					
				 
				  </div>
				  <!-- /.box-body -->
			</div>
		  
        </div>
        <!-- /.col -->
		
        <!-- /.col -->
        <div class="col-sm-4">
			  <div class="box box-solid">
				<div class="box-header with-border">
				  <h3 class="box-title">Informasi Login Akun</h3>
				</div>
				  <div class="box-body">
				  				  
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input name="username" type="text" class="form-control input-sm" id="username" placeholder="Nama Pengguna" >
						</div>
					</div>
				  
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
							<input name="mail" type="email" class="form-control input-sm" id="mail" placeholder="Email" >
						</div>
					</div>
					<?=br()?>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-key"></i></span>
							<input name="sandi" type="password" class="form-control input-sm" id="sandi" placeholder="Kata Sandi">
						</div>
					</div>
					<div class="form-group">
					  <!-- <label for="exampleInputPassword1">Ulangi Kata Sandi</label> -->
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-key"></i></span>
							<input name="ulangsandi" type="password" class="form-control input-sm" id="exampleInputPassword1" placeholder="Ulangi Kata Sandi">
						</div>
					</div>
			<div class="form-group">
				<p class="text-orange">Perhatian.</p>
			</div>
				<div class="callout callout-warning">
                <p>Jangan sampai kehilangan Username dan Kata Sandi Anda!</p>
              </div>
					
				 
				  </div>
			</div>
		  
        </div>
        <!-- /.col -->
		
		
      </div>
      <!-- /.row -->
	
	

<div class="row">
	<div class="col-sm-12">
        <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Perhatian!</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			<div class="form-group">
				<p class="text-light-blue">Setujui pernyataan dan klik tombol "DAFTAR".</p>
			</div>
				<div class="callout callout-info">
                <p>Saya mengerti bahwa segala aktifitas saya di website ini telah terekam dan tercatat. dan Saya menyatakan bahwa data yang saya kirimkan adalah data yang benar dan dapat di pertanggungjawabkan. Saya bersedia menerima sanksi hukum terhadap berbagai pelanggaran yang saya lakukan melalui website ini.</p>
              </div>
			<div class="form-group">
			<div class="checkbox">
                    <label>
                      <input name="setuju" value="1" type="checkbox">
                      Saya mengerti dan setuju!
                    </label>
             </div>
             </div>
			  
			</div>
            <!-- /.box-body -->
			<div class="box-footer">
                <button type="submit" class="btn btn-primary">DAFTAR</button>
                <a href="<?=base_url()?>"><span class="btn btn-default pull-right"><i class="fa fa-arrow-left"></i> Batal dan kembali</span></a>
            </div>
		</div>
	</div>
</div>
	
	</form>
	</section>
</div>
  
  
  
<script src="<?= config_item('aset') ?>custom/ace-elements.min.js"></script>
<script src="<?= config_item('aset') ?>custom/ace.min.js"></script>

<script>
$(function(){
	
	$("#kec").on("change", function() {
		$.get("<?php echo base_url('web/get_desa/'); ?>"+$("#kec").val(), function( data ) {
			$("#des").html(data);
		return false;
		}, 'html');		
	});
	$("#kecusaha").on("change", function() {
		$.get("<?php echo base_url('web/get_desa/'); ?>"+$("#kecusaha").val(), function( data ) {
			$("#desusaha").html(data);
		return false;
		}, 'html');		
	});
	
	$('#id-input-file-3').ace_file_input({
		style:'well',
		btn_choose:'Klik disini untuk memilih foto',
		btn_change:null,
		no_icon:'icon-file',
		droppable:true,
		thumbnail:'fit',
		preview_error : function(filename, error_code) {
		}

	}).on('change', function(){
	});
	

	$('#register_form').validate({
		errorElement: 'span',
		errorClass: 'help-block',
		focusInvalid: true,
		rules: {
			nik: {
				minlength: 16,
				required: true,
				remote: {
					url: "<?= base_url('user/cek_nik')?>",
					type: "post",
					data: {
						nik: function(){
							return $("#nik").val();
						}
					}
				}
			},
			alamat: {
				required: true
			},
			kec: {
				required: true
			},
			des: {
				required: true
			},
			nama: {
				required: true
			},
			mail: {
				required: true,
				email: true,
				remote: {
					url: "<?= base_url('user/cek_email')?>",
					type: "post",
					data: {
						mail: function(){
							return $("#mail").val();
						}
					}
				}
			},
			hp: {
				required: true
			},
			nama_usaha: {
				required: true
			},
			kat: {
				required: true
			},
			alamat_usaha: {
				required: true
			},
			kecusaha: {
				required: true
			},
			desusaha: {
				required: true
			},
			username: {
				required: true,
				remote: {
					url: "<?= base_url('user/cek_uname')?>",
					type: "post",
					data: {
						username: function(){
							return $("#username").val();
						}
					}
				}
			},
			setuju: {
				required: true
			},
			sandi: {
				required: true,
				minlength: 6
			},
			ulangsandi: {
				required: true,
				minlength: 6,
				equalTo: "#sandi"
			}
		},

		messages: {
			nik: {
				minlength: "Minimal 16 digit",
				required: "Nomor KTP harus diisi",
				remote: "NIK tidak valid atau sudah terdaftar"
			},
			alamat: {
				required: "Alamat harus diisi"
			},
			kec: {
				required: "Pilih kecamatan"
			},
			des: {
				required: "Pilih desa"
			},
			nama: {
				required: "Nama harus diisi"
			},
			mail: {
				required: "Email harus diisi",
				email: 'Masukkan format email yang benar',
				remote: "Email sudah terdaftar di sistem"
			},
			hp: {
				required: "Nomor HP harus diisi"
			},
			nama_usaha: {
				required: "Nama Usaha harus diisi"
			},
			kat: {
				required: "Pilih kategori usaha"
			},
			alamat_usaha: {
				required: "Isikan alamat lokasi usaha"
			},
			kecusaha: {
				required: "Pilih kecamatan"
			},
			desusaha: {
				required: "Pilih Desa"
			},
			username: {
				required: "Nama Pengguna harus diisi",
				remote: "Username sudah ada, pilih yang lain"
			},
			setuju: {
				required: "Baca dan setujui pernyataan"
			},
			sandi: {
				required: "Sandi harus diisi",
				minlength: "Minimal 6 karakter"
			},
			ulangsandi: {
				required: "Sandi harus diisi",
				minlength: "Minimal 6 karakter",
				equalTo: "Harus sama dengan sandi diatas"
			}
		},

		highlight: function (e) {
			$(e).closest('.form-group').addClass('has-error');
		},

		success: function (e) {
			$(e).closest('.form-group').removeClass('has-error').addClass('has-success');
			$(e).remove();
		},

		errorPlacement: function (error, element) {
			if(element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			} else {
				error.insertAfter(element);
			}
		},

		submitHandler: function (form) {
			form.submit();
			//$('#register_form').get(0).submit();
		}
	});
	
});
</script>
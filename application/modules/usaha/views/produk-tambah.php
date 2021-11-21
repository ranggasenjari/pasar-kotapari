  <!-- Full Width Column -->
  <div class="content-wrapper">
	<div class="container">

	  <!-- Main content -->
    <section class="content">
        <!-- /.col -->
        <div class="row">
        <div class="col-sm-6">
		<h3 class="pull-left">
		- <?= $udata->nama_usaha ?> -
		</h3>
		</div>
        <!--<div class="col-sm-6">
		
			<button type="button" class="btn bg-purple btn-sm pull-right"><i class="fa fa-shopping-cart"></i> Kelola Produk</button>
        </div>-->
        </div>

      <div class="row invoice-info">
	
	<div class="row">
	<form action="<?=base_url('usaha/produk/save_new')?>" method="post" name="tambah_produk" enctype="multipart/form-data">

	<div class="col-sm-3">
		<div class="box box-success hasilcari">
			<div class="box-header with-border">
			
				<h3 class="box-title">Foto Produk</h3>
				
            </div>
			
              <div class="box-body">
			  
					<div class="control-group">

						<div class="controls">
							<div class="span10">
							<input name="foto_produk[]" type="file" id="id-input-file-3" multiple=""/>
							</div>
						</div>
					</div>
								
				
              </div>
              <!-- /.box-body -->
			
		</div>		
	</div>

	<div class="col-sm-9">
		<div class="box box-success hasilcari">
			<div class="box-header with-border">
				<i class="fa fa-plus" aria-hidden="true"></i>
				<h3 class="box-title">Tambah Produk</h3>
				<div class="box-tools pull-right">
					<div class="checkbox">
                      <label>
                        <input name="status" type="checkbox" value="1" checked=""> Aktif?
                      </label>
                    </div>
				</div>
				
            </div>
			
              <div class="box-body">
              <div class="row">
              <div class="col-sm-5">
								
				<!-- text input -->
				<div class="form-group">
				 <strong> <input name="nama" class="form-control input" placeholder="Nama Produk" type="text"></strong>
				</div>
				<div class="form-group">
				  <select name="kat" id="kat" class="select form-control input-sm" >
					<option value="">-- Kategori --</option>
					<?=$this->web_model->kat_produk_select('')?>
				  </select>
				</div>
				<div class="form-group">
				  <select name="kondisi" id="kondisi" class="select form-control input-sm" >
					<option value="">-- Kondisi Produk --</option>
					<option value="baru">BARU</option>
					<option value="bekas">BEKAS</option>
				  </select>
				</div>
				
              </div>
              <div class="col-sm-7">

                <div class="form-group">
				

					<textarea name="detil" class="form-control detil-produk" rows="9" placeholder="Detil produk anda..."></textarea>
  
  
                </div>
				
				
              </div>
              </div>
              </div>
              <!-- /.box-body -->
			<div class="box-footer">
               <a href="<?=base_url('usaha/produk')?>"> <span class="btn btn-default">Batal</span></a>
                <button type="submit" class="btn btn-info pull-right">Simpan</button>
            </div>
		</div>		
	</div>
	
	</form>
	</div>
	
	</section>
</div>

<script src="<?= config_item('aset') ?>custom/ace-elements.min.js"></script>
<script src="<?= config_item('aset') ?>custom/ace.min.js"></script>
<script>
function PopupCenter(pageURL, title,w,h) {
// var left = (screen.width/2)-(w/2);
// var top = (screen.height/2)-(h/2);
var left = 0;
var top = 0;
var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
<script>

$(function () {
	// if ($("#lokasi").val()!==''){
		// alert('asdasd');
	// }
	$('.detil-produk').wysihtml5({ 
		toolbar: {
			"image":false,
			"color": false,
			"font": false,
			"indent":false
		}
	});
	$('#id-input-file-3').ace_file_input({
		style:'well',
		btn_choose:'Klik disini untuk memilih foto produk',
		btn_change:null,
		no_icon:'icon-file',
		droppable:true,
		thumbnail:'small',
		preview_error : function(filename, error_code) {
		}

	}).on('change', function(){
	});
	$("#kec").on("change", function() {
		$.get("<?php echo base_url('web/get_desa/'); ?>"+$("#kec").val(), function( data ) {
			$("#des").html(data);
		return false;
		}, 'html');		
	});
});
</script>
  
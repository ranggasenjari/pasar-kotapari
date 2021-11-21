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

      <!-- /.row -->
	
	<div class="row">
	<form class="form-horizontal" name="usahaedit" id="usahaedit" enctype="multipart/form-data" method="post" action="<?=base_url('usaha/simpandata')?>">
	<input type="hidden" name="id_usaha" value="<?= $udata->id_usaha ?>"/>
	<div class="col-sm-7 <?=( ($this->agent->is_mobile())?'no-padding':'' )?>">
		<div class="box box-success hasilcari">
			<div class="box-header with-border">
				<i class="fa fa-tasks" aria-hidden="true"></i>
				<h3 class="box-title">Kelola Usaha / Toko</h3>
            </div>
			
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Nama Usaha</label>

                  <div class="col-sm-9">
                    <input class="form-control input-lg" id="nama_usaha" name="nama_usaha" placeholder="Nama Usaha" type="text" value="<?= $udata->nama_usaha ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Rincian / Detil Usaha</label>

                  <div class="col-sm-9">
					<textarea name="detil" class="form-control detil-usaha" rows="9" placeholder="Detil usaha anda..."><?= $udata->detil ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Kategori Usaha</label>

                  <div class="col-sm-9">
					<select name="id_kat_usaha" id="id_kat_usaha" class="form-control" placeholder="Semua status" style="width: 100%;">
					  <option value="0">- Tak berkategori -</option>
					  <?php
							echo $this->web_model->kat_usaha_select($udata->id_kat_usaha);
					  ?>
					</select>
                  </div>
                </div>
				
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Ganti Cover / Sampul</label>

					<div class="col-sm-9">
					
						<img src="<?= ($udata->cover == null)?'https://placehold.it/800x270/ab3cbc/ffffff&amp;text='.urlencode($udata->nama_usaha):$this->config->item('aset').'img/cover/'.$udata->cover;?>" alt="..." class="img img-responsive spacer">
					  <input name="cover" class="filestyle input-sm" id="id-input-file-3" type="file" >
					</div>
                </div>
							


							
              </div>
              <!-- /.box-body -->
			
		</div>		
	</div>
	<div class="col-sm-5 <?=( ($this->agent->is_mobile())?'no-padding':'' )?>">
		<div class="box box-success ">
			<div class="box-header with-border">
              <h3 class="box-title">Informasi Lokasi Usaha</h3>
            </div>
			
              <div class="box-body">

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Alamat Utama</label>

					<div class="col-sm-9">
					  <input name="alamat_usaha" type="text" class="form-control" id="exampleInputEmail1" placeholder="Alamat Lengkap" value='<?=$udata->alamat_usaha?>' required>
					</div>
                </div>
				
                <div class="form-group">

                  <div class="col-sm-offset-3 col-sm-9">

						<div class="row">
							<div class="col-sm-6">
								  <select name="id_kecamatan" id="kec" class="select form-control" required>
									<option value="">-- Pilih Kecamatan --</option>
									<?=$this->web_model->get_kecamatan($udata->usaha_kec)?>
								  </select>
							</div>
							<div class="col-sm-6">
								  <select name="id_desa" id="des" class="select form-control" required>
									<option value="">-- Pilih Desa/Kelurahan --</option>
									<?=$this->web_model->get_desa($udata->usaha_kec,$udata->usaha_desa)?>
								  </select>
							</div>
						</div>
				  
					
                  </div>
                </div>
				
                <div class="form-group">
                  <label for="kontak" class="col-sm-3 control-label">Kontak</label>

					<div class="col-sm-9 spacer">
					  <input name="kontak" type="text" class="form-control" id="kontak" placeholder="Kontak Telp / HP"  value="<?=$udata->kontak?>">
					</div>
                </div>
				
                <div class="form-group">
                  <label for="kontak" class="col-sm-3 control-label">Peta Lokasi</label>

					<div class="col-sm-9 spacer">
						<!--<div style="max-height:200px;">
						
						</div>-->
						
					  <input onClick="PopupCenter('<?php echo base_url(); ?>usaha/setpetautama', 'Cari Lokasi', 650, 450)" id="lokasi" type="text" class="form-control" id="lokasiv" placeholder="Klik untuk menambahkan peta" value="<?=($udata->la=='')?'':$udata->la.','.$udata->lo;?>">
					  <input name="lokasi" type="hidden" id="lokasi" value="<?=($udata->la=='')?'':$udata->la.','.$udata->lo;?>">
					  
					  
					</div>
					  
                </div>
				
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Simpan</button>
              </div>
              <!-- /.box-footer -->
			
		</div>		
	</div>
	
	
            </form>
	
	</div>
	

      <div class="row invoice-info">
		
		<?=$info?>
      </div>
	
	</section>
</div>

<script src="<?= config_item('aset') ?>custom/ace-elements.min.js"></script>
<script src="<?= config_item('aset') ?>bower_components/chart.js/Chart.js"></script>
<script>
function PopupCenter(pageURL, title,w,h) {
	var coords = $('#lokasi').val();
	// if (coords!=''){
		
	// }
	var left = 0;
	var top = 0;
	var targetWin = window.open(pageURL+'/'+coords, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}

  // function PopupCenter(pageURL, title, w, h) {
	
	  
    // $.confirm({
        // title: title,
        // content: '<iframe id="loc" style="width:100%;height:100vh;" src="'+pageURL+'"></iframe>',
		// columnClass: 'medium',
		// onContentReady: function () {
			// var mheight = $('.jconfirm-content-pane').height();
			// $('#loc').css('height', mheight+'px');
			
		// }
    // });
  // }
</script>
<script>

  // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
  var pieChart       = new Chart(pieChartCanvas);
  var PieData        = [
    {
      value    : <?=$this->usaha_model->total_hits('mobile',$udata->id_usaha)?>,
      color    : '#00a65a',
      highlight: '#00a65a',
      label    : 'Mobile'
    },
    {
      value    : <?=$this->usaha_model->total_hits('pc',$udata->id_usaha)?>,
      color    : '#00c0ef',
      highlight: '#00c0ef',
      label    : 'PC'
    },
    {
      value    : <?=$this->usaha_model->total_hits('others',$udata->id_usaha)?>,
      color    : '#d2d6de',
      highlight: '#d2d6de',
      label    : 'Other'
    }
  ];
  var pieOptions     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=value %> Pengguna <%=label%>'
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  pieChart.Doughnut(PieData, pieOptions);
  // -----------------
  // - END PIE CHART -
  // -----------------

function setCoords(coords){
	// alert(lat);
	$('#lokasi').val(coords);
	$('#lokasiv').val(coords);
}



$(function () {
	// if ($("#lokasi").val()!==''){
		// alert('asdasd');
	// }
	$('.detil-usaha').wysihtml5({ 
		toolbar: {
			"image":false,
			"color": false,
			"indent":false
		}
	});
	$('#id-input-file-3').ace_file_input({
		style:'well',
		btn_choose:'Klik disini untuk mengganti foto sampul',
		btn_change:null,
		no_icon:'icon-file',
		droppable:true,
		thumbnail:'fit',
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
  
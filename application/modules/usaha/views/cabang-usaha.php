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

	
	<div class="row">
		<div class="col-sm-12">
		<div class="box box-success hasilcari">
			<div class="box-header with-border">
              <h3 class="box-title">Punya cabang?</h3>
				<!--<div class="pull-right box-tools">
                 <button type="button" class="btn btn-default btn-sm">
                  <i class="fa fa-plus"></i> Tambahkan Cabang
				  </button>
				</div>-->
            </div>
			
              <div class="box-body">
			  
				<table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 10px">#</th>
                  <th><strong>Alamat Cabang</strong>
				  <button type="button" class="btn btn-default btn-xs pull-right" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus"></i> Tambah</button>
				  </th>
                </tr>
				<?php
					if ($cabang->num_rows()==0){
				?>
                <tr>
                  <td>#</td>
                  <td><p>Tidak ada cabang...</p></td>
                </tr>
				<?php
					} else {
						$i=1;
						foreach ($cabang->result() as $c){
				?>
				
                <tr>
                  <td><?=$i?></td>
                  <td>
				  <?=$c->alamat_usaha?><br/>
				  <small class="text-muted"><?=$c->des?>, Kec. <?=$c->kec?></small><br/>
				  <small class="text-muted">Kontak: <?=$c->kontak?></small><br/>
				  
				  	<span onClick="PopupCenter('<?php echo base_url(); ?>web/viewpeta/<?=$c->id_lokasi?>', 'Lokasi', 650, 450)" class="btn btn-xs bg-yellow map"><i class="fa fa-map-o"></i> Peta Lokasi</span>
					
					<span class="btn btn-xs bg-gray edit"><i class="fa fa-pencil"></i> Ubah</span>
					
					<a href="<?=base_url('usaha/delcabang/'.$c->id_lokasi)?>" class="del">
					<span class="btn btn-xs bg-red"><i class="fa fa-trash"></i> Hapus</span>
					</a>
					
				  </td>
                </tr>
				<?php
				$i++;
						}
					}
				?>
				
              </tbody></table>
			  
		<div class="modal fade" id="modal-tambah" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
			<form role="form" class="form-horizontal" name="usahaedit" id="usahaedit" enctype="multipart/form-data" method="post" action="<?=base_url('usaha/tambahcabang')?>">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Tambah cabang usaha</h4>
              </div>
              <div class="modal-body">

              <div class="box-body">

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Alamat Cabang</label>

					<div class="col-sm-9">
					  <input name="id_usaha" type="hidden" value="<?= $udata->id_usaha ?>">
					  <input name="alamat_usaha" type="text" class="form-control" id="exampleInputEmail1" placeholder="Alamat Lengkap" required>
					</div>
                </div>
				
                <div class="form-group">

                  <div class="col-sm-offset-3 col-sm-9">

						<div class="row">
							<div class="col-sm-6">
								  <select name="id_kec" id="kec" class="select form-control" required>
									<option value="">-- Pilih Kecamatan --</option>
									<?=$this->web_model->get_kecamatan()?>
								  </select>
							</div>
							<div class="col-sm-6">
								  <select name="id_des" id="des" class="select form-control" required>
									<option value="">-- Pilih Desa/Kelurahan --</option>
									<?=$this->web_model->get_desa()?>
								  </select>
							</div>
						</div>
				  
					
                  </div>
                </div>
				
                <div class="form-group">
                  <label for="kontak" class="col-sm-3 control-label">Kontak</label>

					<div class="col-sm-9 spacer">
					  <input name="kontak" type="text" class="form-control" id="kontak" placeholder="Kontak Telp / HP">
					</div>
                </div>
				
                <div class="form-group">
                  <label for="kontak" class="col-sm-3 control-label">Peta Lokasi</label>

					<div class="input-group col-sm-8 spacer">
					  <input onClick="PopupCenter('<?php echo base_url(); ?>usaha/setpetautama', 'Cari Lokasi', 650, 450)" id="lokasi" name="lokasi" type="text" class="form-control" id="lokasi" placeholder="Klik untuk menambahkan peta" >
					  <span class="input-group-btn">
                      <button onClick="PopupCenter('<?php echo base_url(); ?>usaha/setpetautama', 'Cari Lokasi', 650, 450)" type="button" class="btn btn-info btn-flat"><i class="fa fa-map-o"></i></button>
                      </span>
					</div>
					  
                </div>
				
              </div>
              <!-- /.box-body -->
			  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan cabang</button>
              </div>

            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
			  
			  </div>
		</div>
		</div>
	</div>
	
      <div class="row invoice-info">
		
		<?=$info?>
      </div>
      <!-- /.row -->
	  
	</section>
</div>

<script src="<?= config_item('aset') ?>custom/ace-elements.min.js"></script>
<script src="<?= config_item('aset') ?>bower_components/chart.js/Chart.js"></script>
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

		$(".del").confirm({
			title: 'Hapus?',
			content: 'Hapus alamat ini?',
			buttons: {
				confirm: function () {
					location.href = this.$target.attr('href');
				},
				cancel: function () {
				}
			}
		});


	
	$("#kec").on("change", function() {
		$.get("<?php echo base_url('web/get_desa/'); ?>"+$("#kec").val(), function( data ) {
			$("#des").html(data);
		return false;
		}, 'html');		
	});
});
</script>
  
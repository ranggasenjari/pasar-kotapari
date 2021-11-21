<?php
	$panjang = strlen(utf8_decode($dt->nama_produk));
	if ($panjang <= 38){
		$titik = '';
	} else {
		$titik = '...';
	}
?>

 <!-- Full Width Column -->
  <div class="content-wrapper">
	<div class="container">

	  <!-- Main content -->
<section class="invoice" style="margin: 0px;">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12 no-padding">
          <h2 class="page-header">
            <strong style="color: dodgerblue;"><?= substr(strip_tags($dt->nama_produk),0,38).$titik ?></strong>
            <small style="font-size: 60% !important;" class="pull-right"> </small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
	  
      <!-- info row -->
      <div class="row invoice-info spacer">
	  
        <div class="col-sm-7 invoice-col no-padding">

        <div class="col-sm-12 table-responsive no-padding">
          <table class="table table-striped table-bordered" style="color: slategrey;font-size: 86%;">
            <tbody>
            <tr>
              <td style="padding: 2px;" width="20%"><i class="fa fa-eye"></i> Dilihat</td>
              <td style="padding: 2px;" width="30%"><?= $hits ?> kali</td>
			  
              <td style="padding: 2px;" width="20%"><i class="fa fa-tags"></i> Kategori</td>
              <td style="padding: 2px;" width="30%"><?= $dt->uraian ?></td>
            </tr>
            <tr>
              <td style="padding: 2px;" width="20%"><i class="fa fa-adjust"></i> Kondisi</td>
              <td style="padding: 2px;" width="30%"><?= $dt->kondisi ?></td>
			  
              <td style="padding: 2px;" width="20%"><i class="fa fa-calendar"></i> Dibuat</td>
              <td style="padding: 2px;" width="30%"><?= date('d/m/Y', strtotime($dt->created_at)) ?></td>
            </tr>
            <tr>
              <td style="padding: 2px;" width="20%"><i class="fa fa-map-marker"></i> Lokasi</td>
              <td style="padding: 2px;" width="30%"><?= ucwords(strtolower($dt->des)).', <br/>Kec. '.ucwords(strtolower($dt->kec)) ?></td>
			  
              <td style="padding: 2px;" width="20%"></td>
              <td style="padding: 2px;" width="30%"></td>
            </tr>
			
            </tbody>
          </table>
        </div>
		<div class="spacer"></div>
		
        <div class="col-sm-12 invoice-col spacer">
          
		 <h5><strong> Rincian Produk: </strong></h5>
		 
		 <?= ($dt->detil=='')?'<p><i>Penjual belum memberikan rincian.</i></p>':$dt->detil_produk; ?>
        </div>
        </div>
		
        <!-- /.col -->
        <div class="col-sm-5 invoice-col no-padding">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			
			<?php
			if ($img->num_rows()==0){
			?>
                <ol class="carousel-indicators">
				
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				  
                </ol>
                <div class="carousel-inner">
				
                  <div class="item active">
                    <img src="<?=config_item('aset')?>img/noimg.png" alt="First slide">
                  </div>
				  
                </div>
			<?php
			} else {
				
				echo '<ol class="carousel-indicators">';
				$i=0;
				foreach ($img->result() as $im){
					if ($i == 0){
						$cls = 'active';
					} else {
						$cls = '';
					}
					echo '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'" class="'.$cls.'"></li>';
					
					$i++;
				}
				echo '</ol>';
				
				echo ' <div class="carousel-inner">';
				$f=0;
				foreach ($img->result() as $im){

					if ($f == 0){
						$cls = 'active';
					} else {
						$cls = '';
					}
					
					echo '<div class="item '.$cls.'" style="background-image: url(\''.config_item('aset').'img/produk/'.$dt->id_usaha.'/'.$im->foto.'\');background-size: cover;background-position: center center;">
						<img style="height:350px;transform: translateX(70%);"  src="">
					  </div>';
					
					$f++;
				}
				echo '</div>';
				
			}
			?>
			

                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
				
              </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
	  
	<div class="row">
	<?php
	if ($dt->id_pemilik == null){
	?>
	<div class="col-sm-12 no-padding">
		<div class="box box-warning hasilcari">
			<div class="box-header ui-sortable-handle">
			  <i class="fa fa-quote-left" aria-hidden="true"></i>
			  <h3 class="box-title">Informasi Pemilik / Tempat Usaha</h3>
			</div>
			<div class="box-body">
				<div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Perhatian!</h4>
                Usaha ini di entri berdasarkan data usaha perdagangan dan industri yang ada di <strong>Dinas Perdagangan dan Perindustrian Kabupaten Langkat</strong>. Jika anda adalah pemilik usaha ini, maka harap datang ke <strong>Dinas Perindustrian dan Perdagangan Kabupaten Langkat</strong> untuk melakukan "klaim" atas usaha dan produk ini dengan membawa data diri dan dokumen izin usaha. <br/><br/><strong>Semua proses ini tidak dikenakan biaya</strong>.
              </div>
			</div>


        <!-- /.box-footer-->
		</div>		
	</div>
	<?php
	} else {
		echo $info;
	}
	?>
	</div>
	
    </section>
</div>

<script src="<?= config_item('aset') ?>custom/ace-elements.min.js"></script>
<script src="<?= config_item('aset') ?>bower_components/chart.js/Chart.js"></script>
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


$(function () {
	

});
</script>
  
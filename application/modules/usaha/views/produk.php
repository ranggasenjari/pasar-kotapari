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
	<?php
	if (isset($sukses) && $sukses){
	?>
	<div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Tindakan berhasil!</h4>
    </div>
	<?php
	}
	?>
        <?=$info?>
        <!-- /.col -->
		
      </div>
      <!-- /.row -->
	
	<div class="row">

	<div class="col-sm-12">
		<div class="box box-success hasilcari">
			<div class="box-header with-border">
				<i class="fa fa-tasks" aria-hidden="true"></i>
				<h3 class="box-title">Kelola Produk</h3>
				<div class="box-tools pull-right">
				<a href="<?=base_url('usaha/produk/add')?>">
					<button type="button" class="btn btn-primary pull-right" ><i class="fa fa-plus"></i> Tambah Produk </button>
				</a>
				</div>
            </div>
			
              <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				<?php if (!$this->agent->is_mobile()){ ?>
                  <th>#</th>
                  <th>Foto Prouk</th>
                  <th>Nama Produk</th>
                  <th>Kondisi</th>
                  <th>Dibuat</th>
                  <th>Status</th>
                  <th>Aksi</th>
				<?php } else { ?>
                  <th>#</th>
                  <th>Foto</th>
                  <th>Nama Produk</th>
				<?php }?>
                </tr>
                </thead>
                <tbody>
				
				<?= $produk ?>
				
                </tbody>
              </table>	
              </div>
              <!-- /.box-body -->
			
		</div>		
	</div>
	
	</div>
	
	</section>
</div>

<script src="<?= config_item('aset') ?>custom/ace-elements.min.js"></script>
<script src="<?= config_item('aset') ?>bower_components/chart.js/Chart.js"></script>

<script src="<?= config_item('aset') ?>bower_components/jquery-confirm2/dist/jquery-confirm.min.js"></script>
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



$('a.delProduk').confirm({
	title: 'Hapus produk',
	content: 'Yakin ingin menghapus item ini?',
    buttons: {
        Hapus: function(){
            location.href = this.$target.attr('href');
        },
		Batal: function () {
        }
    }
});


$(function () {
	// if ($("#lokasi").val()!==''){
		// alert('asdasd');
	// }

});
</script>
  
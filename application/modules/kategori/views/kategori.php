  <!-- Full Width Column -->
  <div class="content-wrapper">
	<div class="container">

	  <!-- Main content -->
    <section class="content">

      <div class="row invoice-info spacer">
	  <div class="btn-group">
	  <button type="button" class="btn btn-default cariproduk">CARI PRODUK</button>
	  <button type="button" class="btn btn-default caritoko">CARI TOKO</button>
	  </div>
      </div>
	  
      <div class="row invoice-info">
        <!-- /.col -->
        <div class="col-sm-8 invoice-col no-padding">
			<div class="box box-default">
				<div class="box-header ui-sortable-handle">
				  <i class="fa fa-filter" aria-hidden="true"></i>
				  <h3 class="box-title">Filter Produk</h3>
				</div>
				<div class="box-body">
				

		<div class="filter-wrapper-parent">
		<div class="filter-wrapper-div">

			<ul class="ul-filter" style="width: 720px; transform: translate(0px, 0px);">
			
				<li class="li-filter" style="width: 170px;">
					<div class="filter-wrapper-content">
					
					<?= $kecfilter ?>
					
					</div>
				</li>
			
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
			
				<!--<li class="li-filter" style="width: 170px;">
					<div class="filter-wrapper-content">
				<div class="form-group">
                <label>Verifikasi Usaha</label>
                <select id="verif" class="form-control input-sm" placeholder="Semua status" style="width: 100%;">
                  <option value="">- Semua status -</option>
                  <option value="1">Terverifikasi</option>
                  <option value="o">Belum Terverifikasi</option>
                </select>
				</div>
					
					</div>
				</li>-->
				
			</ul>
			
		</div>
		</div>
				
				</div>
			</div>
		  
        </div>
        <!-- /.col -->
        <!-- /.col -->
        <div class="col-sm-4 invoice-col no-padding">
			<div class="box box-default">
				<div class="box-header ui-sortable-handle">
				  <i class="fa fa-sort" aria-hidden="true"></i>
				  <h3 class="box-title">Urut Pencarian</h3>
				</div>
				<div class="box-body">
				

		<div class="filter-wrapper-parent">
		<div class="filter-wrapper-div">

			<ul class="ul-filter" style="width: 350px; transform: translate(0px, 0px);">
			
				<li class="li-filter" style="width: 160px;">
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
				
				</div>
			</div>
		  
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
	
	<div class="row">
	<div class="col-sm-12 no-padding">
		<div class="box box-success hasilcari">

				<?= $hasilcari ?>

        <!-- /.box-footer-->
		</div>		
	</div>
	</div>
	
	</section>
</div>

<script src="<?= config_item('aset') ?>bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
function removeParam(key, sourceURL) {
    var rtn = sourceURL.split("?")[0],
        param,
        params_arr = [],
        queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
    if (queryString !== "") {
        params_arr = queryString.split("&");
        for (var i = params_arr.length - 1; i >= 0; i -= 1) {
            param = params_arr[i].split("=")[0];
            if (param === key) {
                params_arr.splice(i, 1);
            }
        }
        rtn = rtn + "?" + params_arr.join("&");
    }
    return rtn;
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
	$('.select2').select2();
	var u = $(location).attr('href')+"?";
	$("#kec, #katproduk, #kondisi, #verif, #sort").on("change", function() {
		if ($("#kec").val()){var d = '&d='+$("#kec").val();} else {var d = '';}
		if ($("#katproduk").val()){var k = '&k='+$("#katproduk").val();} else {var k = '';}
		if ($("#kondisi").val()){var s = '&s='+$("#kondisi").val();} else {var s = '';}
		if ($("#verif").val()){var v = '&v='+$("#verif").val();} else {var v = '';}
		if ($("#sort").val()){var sort = '&sort='+$("#sort").val();} else {var sort = '';}
		// window.history.pushState("string", "Title", "/search?q="+getParam('q', u)+d+k+s+v+sort);
		window.history.pushState("string", "Title", "<?= @array_shift(explode('&', $this->uri->segment(3))) ?>?"+d+k+s+v+sort);
		
		$.get(u+d+k+s+v+sort, function( data ) {
			$(".hasilcari").html(data);
			return false;
		}, 'html');	
		
	});
		
	$(".caritoko").click(function(){
		window.location.replace('<?=base_url()?>search/toko/?q='+getParam('q', u));	
	});
		
	$(".cariproduk").click(function(){
		window.location.replace('<?=base_url()?>search/?q='+getParam('q', u));	
	});
	
	// $("#kec").on("change", function() {
		// $.get("<?php echo base_url('search/get_desa/'); ?>"+$("#kec").val(), function( data ) {
			// $("#desa").html(data);
		// return false;
		// }, 'html');		
	// });
	// console.log(removeParam('p', u));

});
</script>
  
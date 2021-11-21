<html>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<head>
    <script type='text/javascript'>  
        function validepopupform(coordinat){ 
			console.log(coordinat);
            // window.opener.document.usahaedit.lokasiv.value = coordinat;
            // window.opener.document.usahaedit.lokasi.value = coordinat;
            window.opener.setCoords(coordinat);
        }
    </script>
	<script type="text/javascript">
		var centreGot = false;
	</script>  
	<?php echo $map['js']; ?>
</head>
<body><?php echo $map['html']; ?></body>
</html>
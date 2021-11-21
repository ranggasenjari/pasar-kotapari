<html>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<head>
    <script type='text/javascript'>  
        function validepopupform(coordinat){  
            window.opener.document.usahaedit.lokasi.value = coordinat;
        }  
    </script>  
	<?php echo $map['js']; ?>
</head>
<body style="padding:0px;margin:0px;"><?php echo $map['html']; ?></body>
</html>
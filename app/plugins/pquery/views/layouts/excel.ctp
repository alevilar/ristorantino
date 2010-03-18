<?php

(empty($nombre)) ? $nombre = 'regetp' : $nombre = $nombre;
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=".date("d-M-Y")."-".$nombre.".xls");
header("Pragma: no-cache");
header("Expires: 0");


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">

<HTML>
<HEAD>
	
	<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=iso-8859-1">
	<TITLE><?php echo $nombre?></TITLE>
	<META NAME="GENERATOR" CONTENT="Regetp web rfietp.inet.edu.ar">
	<META NAME="CHANGED" CONTENT="0;0">
	
	<STYLE>
		<!-- 
		BODY,DIV,TABLE,THEAD,TBODY,TFOOT,TR,TH,TD,P { font-family:"Nimbus Sans L"; font-size:x-small }
		 -->
	</STYLE>
	
</HEAD>

<BODY TEXT="#000000">
<?php echo $content_for_layout ?> 
<!-- ************************************************************************** -->
</BODY>

</HTML>

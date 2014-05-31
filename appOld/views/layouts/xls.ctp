<?php

$filename = date("d-M-Y")."-".Inflector::slug( (empty($name)) ? 'coqus_'.$this->name : $name ).".xls";
header ("Pragma: no-cache");
header ("Expires: 0");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=$filename");
header ("Content-Description: Risto-Generated Report" );
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<html lang="en">
    <head>
        <?php
        echo $html->charset();
        echo $html->meta('icon');
        ?>
        <title><?php echo $filename?></title>
        <META NAME="GENERATOR" CONTENT="PQuery Report">
        <META NAME="CHANGED" CONTENT="0;0">

        <STYLE type="text/css">
            <!--
            BODY,DIV,TABLE,THEAD,TBODY,TFOOT,TR,TH,TD,P { font-family:"Nimbus Sans L"; font-size:x-small; }
            -->
        </STYLE>

    </head>

    <BODY TEXT="#000000">
        <?php echo $content_for_layout ?>
        <!-- ************************************************************************** -->
    </BODY>

</HTML>

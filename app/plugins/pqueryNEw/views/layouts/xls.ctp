<?php

$name = (empty($name)) ? 'regetp' : $name;
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=".date("d-M-Y")."-".Inflector::slug($name).".xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<html>
    <head>
        <?php
        echo $html->charset();
        echo $html->meta('icon');
        ?>
        <title><?php echo $name?></title>
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

<?php
//debug($mesas);
                echo $html->css('/pquery/css/examples.css');
                echo $this->Html->script('/pquery/js/jquery.min.js'); 
		echo $this->Html->script('/pquery/js/jquery.jqplot.js');
foreach ($mesas as $i=>$mozo){
    
    echo $mozo[0]['total'];
        echo '<br>';
    echo $mozo[0]['mes'];
        echo '<br>';
    echo $mozo[0]['year'];
        echo '<br>';
        echo '<br>';
}
echo ++$i; // cantidad de elementos!

		echo $this->Html->script('/pquery/js/plugins/jqplot.dateAxisRenderer.js');
		echo $this->Html->script('/pquery/js/plugins/jqplot.highlighter.js');

//var cosaLocaEnJs = echo json_decode( $cosaLocaEnPHP )
//json_decode y json_encode convierten los datos
              
?>


<script language="javascript" type="text/javascript">
jQuery.noConflict();

function editit(str, si, pi, plot) {
    return "<b><i>Mesa: "+plot.targetId+', Series: '+si+', Point: '+pi+', '+str+"</b></i>";
}

jQuery(document).ready(function(){
    jQuery.jqplot.config.enablePlugins = true;
    s1 = [<?php foreach ($mesas as $i=>$mozo){
        echo '[';
        echo '\'';
        echo $mozo[0]['year'];
        echo '-';
        if ($mozo[0]['mes']<10) {
            echo'0';
        }
        echo $mozo[0]['mes'];
        echo '\'';
        echo ',';
        echo $mozo[0]['total'];
        echo ']';
            if ($i!=2){
                echo ',';
            }
    }
    ?>];
                
    //s1 = [['2011-03',300],['2011-04',290],['2011-05',150]];
    //foreach con datos
		
   plot1 = jQuery.jqplot('chart1',[s1],{
       title: 'Mesas por mes',
       axes: {
           xaxis: {
               renderer: jQuery.jqplot.DateAxisRenderer,
               tickOptions: {
                   formatString: '%b %Y'
				   //formato de la fecha
               },
               numberTicks: 4
			   //cantidad de elementos
           },
           yaxis: {
               tickOptions: {
                   formatString: '$%.2f'
               }
           }
       },
       highlighter: {
           fadeTooltip: false,
           sizeAdjust: 10,
           tooltipLocation: 'n',
           useAxesFormatters: false,
           formatString: 'Mes %s dayglow %d',
           useAxesFormatters: true
       },
       cursor: {
           show: false,
           zoom: false
       }
   });
   
});

</script>

  </head>
  <body>
    <div id="chart1" style="margin-top:20px; margin-left:20px; width:300px; height:300px;"></div>
    
    <pre id="code_1"></pre>

<?php exit;
?>
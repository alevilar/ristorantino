<?php
//debug($mesas);
                echo $html->css('/pquery/css/examples.css');
                echo $javascript->link('/pquery/js/jquery.min.js'); 
		echo $javascript->link('/pquery/js/jquery.jqplot.js');
		echo $javascript->link('/pquery/js/plugins/jqplot.dateAxisRenderer.js');
		echo $javascript->link('/pquery/js/plugins/jqplot.highlighter.js');

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
                    
    s1 = [['2011-03',220],['2011-04',290],['2011-05',330],['2011-06',330]];
    //foreach con datos
		
   plot1 = jQuery.jqplot('chart1',[s1],{
       title: 'Ganancia de mesas',
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
           tooltipFormatString: '<b>Total:<span style="color:red;"> %.2f</span></b>',
           useAxesFormatters: false,
           tooltipAxes: 'y'
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
    <div id="chart1" style="margin-top:20px; margin-left:300px; width:500px; height:300px;"></div>

    
    
    
<div class="grid_2 push_5">
<p>Ganancias de mesas por dias, meses o años</p>


<label>Elija el rango de fechas</label>
<input type="text" maxlength="11" ></input>
<input type="text" maxlength="11" ></input>
</br></br></br>
</br></br></br>
</div>

<?php
//debug($mesas);
                echo $html->css('/pquery/css/examples.css');
                echo $html->css('cake.css');
                echo $javascript->link('/pquery/js/jquery.min.js'); 
                echo $javascript->link('jquery/jquery-ui-1.8.12.custom.min'); //datapicker
		echo $javascript->link('/pquery/js/jquery.jqplot.js'); //plugin estadisticas
		echo $javascript->link('/pquery/js/plugins/jqplot.dateAxisRenderer.js');
		echo $javascript->link('/pquery/js/plugins/jqplot.highlighter.js');

//var cosaLocaEnJs = echo json_decode( $cosaLocaEnPHP )
//json_decode y json_encode convierten los datos            
                
                
             /* $mesas = array ( 
                               array('Mesa'=> array('fecha'=> '2011-06','total'=>'330')),
                               array('Mesa'=> array('fecha'=> '2011-05','total'=>'330')),
                               array('Mesa'=> array('fecha'=> '2011-04','total'=>'290')),
                               array('Mesa'=> array('fecha'=> '2011-03','total'=>'900'))
                             );
                
                */
                debug($mesas);
?>



<script language="javascript" type="text/javascript">
    jQuery.noConflict();    
    


    var mesas= <?php echo json_encode($mesas); ?>;
    mesas.getCoordenadas = function(){
           
           var coord = [];

           jQuery.each(mesas,function(i){
                var coordMesa = [mesas[i].Mesa.fecha, parseFloat(mesas[i].Mesa.total)];
                coord.push(coordMesa);  
           })
           return coord; 
          
    }    
    
</script>

    
<script language="javascript" type="text/javascript">

function editit(str, si, pi, plot) {
    return "<b><i>Mesa: "+plot.targetId+', Series: '+si+', Point: '+pi+', '+str+"</b></i>";
}

jQuery(document).ready(function(){
      
    jQuery("#datepicker").datepicker();

 
    jQuery.jqplot.config.enablePlugins = true;    
            
     s1 = mesas.getCoordenadas();
     
    //s1 = [['2011-03',220],['2011-04',290],['2011-05',330],['2011-06',330]];
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

<div class="grid_8 push_3">
<p>Ganancias de mesas por dias, meses o años</p>
<label>Elija el rango de fechas</label>
<input type="text" id="datepicker" class="hasDatepicker">
</br>
</div>
    

<div class="clear"></div>

<div class="grid_8">
    <div id="chart1" style="margin-top:20px; margin-left:0; width:800px; height:500px;"></div>
</div>


<div class="grid_3">
<table cellspacing="0" cellpadding="0" style="text-align: center">
    <thead>
                    <tr>
                        <th class="editable">Fecha</th>
                        <th class="editable">Total</th>
                    </tr>
    </thead>
    <tbody>
<?php


        
    if(!empty($mesas)){

            foreach($mesas as $mesa){
                echo('<tr>');
                echo('<td>');
                echo($mesa['Mesa']['fecha']);
                echo('</td>');
                echo('<td>');
                echo($mesa['Mesa']['total']);
                echo('</td>');
                echo('</tr>');
        }        
    }else{
            echo('<td>');
                echo('No se encontraron mesas');   
            echo('</td>');
        
    }    
        echo('</tr>');
?>  
 </tbody>              
</table>
</div>    
    
<div class="grid_3">
    <table cellspacing="0" cellpadding="0">
        <caption class="editable">--</caption>
        <thead>
                    <tr>
                        <th class="editable">Fecha</th>
                        <th class="editable">Total</th>
                    </tr>
        </thead>
        <tbody>
                <tr class="altrow">
                            <td>
                        20            </td>
                            <td>
                        $6000            </td>
           
                <tr>
                            <td>
                        60            </td>
                            <td>
                        $3950            </td>
                            
                        </tr>
                <tr class="altrow">
                            <td>
                        7            </td>
                            <td>
                        $6200            </td>
                            
                        </tr>
                <tr>
                </tr><tr class="altrow">
                            <td>
                        25            </td>
                            <td>
                        $5500            </td>
                            
                        </tr>
                <tr>    
                            <td>
                        12            </td>
                            <td>
                        $2000            </td>
                            
                        </tr>
                <tr class="altrow">
                            <td>
                        32            </td>
                            <td>
                        $4200            </td>
                            
                        </tr>
                </tbody>
    </table>
</div>

    
    
    

    


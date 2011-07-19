<?php
                echo $html->css('/pquery/css/examples');
                echo $html->css('cake.css');
                echo $html->css('jquery-ui/jquery-ui-1.8.14.custom');
                echo $html->css('ristorantino.generic');
                echo $html->css('estadisticas');
                
                echo $javascript->link('/pquery/js/jquery.min.js'); 
                echo $javascript->link('jquery/jquery-ui-1.8.14.custom.min'); //datapicker
		echo $javascript->link('/pquery/js/jquery.jqplot.js'); //plugin estadisticas
		echo $javascript->link('/pquery/js/plugins/jqplot.dateAxisRenderer.js');
		echo $javascript->link('/pquery/js/plugins/jqplot.highlighter.js');
		echo $javascript->link('/pquery/js/plugins/jqplot.trendline.js');


                
             /* 
                            $mesas = array ( 
                               array('Mesa'=> array('fecha'=> '2011-06','total'=>'330')),
                               array('Mesa'=> array('fecha'=> '2011-05','total'=>'330')),
                               array('Mesa'=> array('fecha'=> '2011-04','total'=>'290')),
                               array('Mesa'=> array('fecha'=> '2011-03','total'=>'900'))
                             );     
             */
        
?>


<script language="javascript" type="text/javascript">
    jQuery.noConflict();    
    
    var mesas= <?php echo json_encode($mesas); ?>;
    mesas.getCoordenadas = function(){
           
        var lineas = [];
        jQuery.each(mesas,function(l){  
           var coordxLinea = [];
            jQuery.each(mesas[l],function(i){
                
                var coordMesa = [mesas[l][i].Mesa.fecha, parseFloat(mesas[l][i].Mesa.total)];
                coordxLinea.push(coordMesa);  
            })
            lineas.push(coordxLinea);
        });

        return lineas; 
          
    }    
    

        jQuery(document).ready(function(){
      
    	dates = jQuery( ".datepicker" ).datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,              
                dateFormat: 'dd/mm/yy',
                onSelect: function( selectedDate ) {
//                    var option = this.id == "from" ? "minDate" : "maxDate",
//                    instance = jQuery( this ).data( "datepicker" ),
//                    date = jQuery.datepicker.parseDate(
//                    instance.settings.dateFormat ||
//                    jQuery.datepicker._defaults.dateFormat,
//                    selectedDate, instance.settings );
//                    dates.not( this ).datepicker( "option", option, date );
                }
                
        }); 

 
    jQuery.jqplot.config.enablePlugins = true;    
            
   
     
    //s1 = [['2011-03',220],['2011-04',290],['2011-05',330],['2011-06',330]];
   
   plot1 = jQuery.jqplot('chart1', mesas.getCoordenadas() ,{
       title: 'Ganancia de mesas',
       axes: {
           xaxis: {
               renderer: jQuery.jqplot.DateAxisRenderer,
               tickOptions: {
                   formatString: '%b %Y'
				   //formato de la fecha
               },
               numberTicks: 7
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


<?php echo $this->element('menustats'); ?>

<div class="grid_10 omega content_stats">

    <div class="grid_11 push_1">
            <h4 class="grid_6">Elija el rango de fechas para visualizar</h4>
            <div class="grid_6" style="margin-top: 10px;"><input type="checkbox" style="vertical-align: middle;position: relative;"><span>Añadir otras fechas para comparar</span></div>

            <div class="clear"></div>

                <?php echo $form->create('Mesa',array('url'=>'/pquery/stats/mesas_total')); ?>

            <div id="prim_fecha" class="grid_4">

                      <?php   
                      echo $form->input('Linea.0.desde', array('label'=>'Desde','id'=>'from', 'class' =>'datepicker'));
                      echo $form->input('Linea.0.hasta', array('label'=>'Hasta','id'=>'to', 'class' =>'datepicker'));  
                      ?>

            </div>    

            <div id="seg_fecha" class="grid_4 push_1">
            <?php
                     echo $form->input('Linea.1.desde', array('label'=>'Desde','id'=>'from2', 'class' =>'datepicker'));
                     echo $form->input('Linea.1.hasta', array('label'=>'Hasta','id'=>'to2', 'class' =>'datepicker'));
                     ?>
            </div>
            <div class="clear"></div>
                    <div class="grid_2">
            <?php
                      echo $form->end('Submit');
            ?>
                     </div>
     </div>


    <div class="clear"></div>

    <div id="chart1" class="grid_9 alpha omega" style="margin-top:20px; height:350px;"></div>


    <?php
        foreach($mesas as $mesa){
            if(!empty ($mesa['desde']))
    ?>
    <div class="grid_3" style="margin-top:35px;">
    <table cellspacing="0" cellpadding="0" style="text-align: center">
        <thead>
                        <tr>
                            <th class="editable">Fecha</th>
                            <th class="editable">Total</th>
                        </tr>
        </thead>
        <tbody>

    <?php     
        if(!empty($mesa)){

                foreach($mesa as $m){
                    echo('<tr>');
                    echo('<td>');
                    echo($m['Mesa']['fecha']);
                    echo('</td>');
                    echo('<td>');
                    echo('$');
                    echo($m['Mesa']['total']);
                    echo('</td>');
                    echo('</tr>');
            }        
        }else{
                echo('<td>');
                    echo('No se encontraron mesas');   
                echo('</td>');
                echo('<td>');
                    echo('-');  
                echo('</td>');

        }    
            echo('</tr>');
    ?>  
    </tbody>              
    </table>


    </div>  
    <?php
            }
    ?>

</div> <!-- cierra div content_stats -->
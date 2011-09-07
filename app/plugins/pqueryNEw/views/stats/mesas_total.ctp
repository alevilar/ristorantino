<?php
                echo $html->css('/pquery/css/examples');
                echo $html->css('jquery-ui/jquery-ui-1.8.14.custom');
                echo $html->css('estadisticas');
                
		echo $javascript->link('/pquery/js/jquery.jqplot.js'); //plugin estadisticas
		echo $javascript->link('/pquery/js/plugins/jqplot.dateAxisRenderer.js');
		echo $javascript->link('/pquery/js/plugins/jqplot.highlighter.js');


                
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
        
(function ($){

    var mesas= <?php echo json_encode($mesas); ?>;
    mesas.getCoordenadas = function(){
           
        var lineas = [];
        $.each(mesas,function(l){  
           var coordxLinea = [];
            $.each(mesas[l],function(i){
                
                var coordMesa = [mesas[l][i].Mesa.fecha, parseFloat(mesas[l][i].Mesa.total)];
                coordxLinea.push(coordMesa);  
            })
            lineas.push(coordxLinea);
        });

        return lineas; 
          
    }    
    

        $(document).ready(function(){
      
            dates = $( ".datepicker" ).datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 1,              
                    dateFormat: 'dd/mm/yy',
                    onSelect: function( selectedDate ) {
    //                    var option = this.id == "from" ? "minDate" : "maxDate",
    //                    instance = $( this ).data( "datepicker" ),
    //                    date = $.datepicker.parseDate(
    //                    instance.settings.dateFormat ||
    //                    $.datepicker._defaults.dateFormat,
    //                    selectedDate, instance.settings );
    //                    dates.not( this ).datepicker( "option", option, date );
                    }
                
            }); 

 
            $.jqplot.config.enablePlugins = true;    
            
   
     
    //s1 = [['2011-03',220],['2011-04',290],['2011-05',330],['2011-06',330]];
   
               plot1 = $.jqplot('chart1', mesas.getCoordenadas() ,{
                   title: 'Ganancia de mesas',
                   axes: {
                       xaxis: {
                           renderer: $.jqplot.DateAxisRenderer,
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

    $(document).ready(
          function() {
       
        $("#otrafecha").click(function () {
            $("#seg_fecha").toggle("fast");
        });
    }
    );
    
    
    
    
    
    
    
})(jQuery); 
    


    

</script>


<?php echo $this->element('menustats'); ?>

<div class="grid_10 omega content_stats">

    <div class="grid_11 push_1">
            <h4 class="grid_6">Elija el rango de fechas para visualizar</h4>
            <div class="grid_6" style="margin-top: 10px;">
                <!--<input id="otrafecha" type="checkbox" style="vertical-align: middle;position: relative;"><span>Añadir otras fechas para comparar</span>-->
                <?php echo $html->link('Añadir otra fecha para comparar','#',array('id'=>'otrafecha'));?>
            </div>
            <div class="clear"></div>

                <?php echo $form->create('Mesa',array('url'=>'/pquery/stats/mesas_total')); ?>

            <div id="prim_fecha" class="grid_4">

                      <?php   
                      echo $form->input('Linea.0.desde', array('label'=>'Desde','id'=>'from', 'class' =>'datepicker'));
                      echo $form->input('Linea.0.hasta', array('label'=>'Hasta','id'=>'to', 'class' =>'datepicker'));  
                      ?>

            </div>    

            <div id="seg_fecha" class="grid_4 push_1" style="display: none;">
            <?php
                     echo $form->input('Linea.1.desde', array('label'=>'Desde','id'=>'from2', 'class' =>'datepicker'));
                     echo $form->input('Linea.1.hasta', array('label'=>'Hasta','id'=>'to2', 'class' =>'datepicker'));
                     ?>
            </div>
            <div class="clear"></div>
                    <div class="grid_2">
            <?php
              echo $form->end('Enviar');
            ?>
                     </div>
     </div>


    <div class="clear"></div>

    <div id="chart1" class="grid_9 alpha omega" style="margin-top:20px; height:350px;"></div>


    <?php
        foreach($mesas as $i=>$mesa){
            if(!empty ($mesa['desde']))
    ?>
    <div class="grid_3 tabla-info" style="margin-top:35px;">
    <table cellspacing="0" cellpadding="0" style="text-align: center">
        <thead>
                        <tr>
                            <th <?php if($i==0){echo('class="coloruno"'); }else{echo('class="colordos"');}?>>Fecha</th>
                            <th <?php if($i==0){echo('class="coloruno"'); }else{echo('class="colordos"');}?>>Total</th>
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
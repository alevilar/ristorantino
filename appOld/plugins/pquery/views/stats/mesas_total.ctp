<?php
    echo $html->css('/pquery/css/examples', false);
    echo $html->css('jquery-ui/jquery-ui-1.8.14.custom', false);
    echo $html->css('estadisticas', false);

    echo $javascript->link('/pquery/js/jquery.jqplot.js', false); //plugin estadisticas
    echo $javascript->link('/pquery/js/plugins/jqplot.dateAxisRenderer.js', false);
    echo $javascript->link('/pquery/js/plugins/jqplot.highlighter.js', false);
    
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
                   title: 'Ventas',
                   axes: {
                       xaxis: {
                           renderer: $.jqplot.DateAxisRenderer,
                           tickOptions: {
                               formatString: '%#d&nbsp;%b'
                                               //formato de la fecha
                           }
                       },
                       yaxis: {
                           tickOptions: {
                               formatString: '$%.2f'
                           }
                       }
                   },
                   highlighter: {
                       tooltipAxes: 'both'
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

<div class="clear" style="height: 20px;"></div>
<div class="grid_7 alpha">
    <div id="chart1" class="col-md-12 alpha omega" style="height:350px;"></div>
    
    <div class="col-md-12 alpha omega">
        <?php 
        echo $form->create('Mesa',array('url'=>'/pquery/stats/mesas_total', 'class' => 'formufecha')); 
        ?>

        <h2>Modificar rango de fechas</h2>
            <?php
            echo "Desde: ".$form->text('Linea.0.desde', array('placeholder'=>'Ej: 22/09/2011','id'=>'from', 'class' =>'datepicker'));
            echo "Hasta: ".$form->text('Linea.0.hasta', array('placeholder'=>'Ej: 30/09/2011','id'=>'to', 'class' =>'datepicker'));  
            echo $form->submit('Aceptar', array('class' => '', 'div' => false));
            ?>

        <?php
        echo $form->end();
        ?>

    </div>
</div>
    

<?php
        foreach($mesas as $i=>$mozo){
            if(!empty ($mozo['desde']))
    ?>
    <div class="grid_5 omega tabla-info">
    <table cellspacing="0" cellpadding="0" style="text-align: center">
        <thead>
                        <tr>
                            <th <?php if($i==0){echo('class="coloruno"'); }else{echo('class="colordos"');}?>>Fecha</th>
                            <th <?php if($i==0){echo('class="coloruno"'); }else{echo('class="colordos"');}?>>Total</th>
                            <th <?php if($i==0){echo('class="coloruno"'); }else{echo('class="colordos"');}?>>Mesas</th>
                            <th <?php if($i==0){echo('class="coloruno"'); }else{echo('class="colortres"');}?>>Cubiertos</th>
                            <th <?php if($i==0){echo('class="coloruno"'); }else{echo('class="colortres"');}?>>Promedio<br />x Cubierto</th>
                        </tr>
        </thead>
        <tbody>

    <?php     
        if(!empty($mozo)){

                foreach($mozo as $m){
                    echo('<tr>');
                    echo('<td>');
                    echo(date('d-m', strtotime($m['Mesa']['fecha'])));
                    echo('</td>');
                    echo('<td>');
                    
                    echo('$');
                    echo($m['Mesa']['total']);
                    
                    echo('</td>');
                    echo('<td>');
                    echo($m['Mesa']['cant_mesas']);
                    echo('</td>');
                    echo('<td>');
                    echo($m['Mesa']['cant_cubiertos']);
                    echo('</td>');
                    echo('<td>');
                    echo('$'.number_format( $m['Mesa']['total']/$m['Mesa']['cant_cubiertos'], 2));
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




    
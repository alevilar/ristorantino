<?php
                echo $javascript->link('/pquery/js/jquery.min.js'); 
		echo $javascript->link('/pquery/js/jquery.jqplot.js');
		echo $javascript->link('/pquery/js/plugins/jqplot.pieRenderer.js');
                
                echo $html->css('/pquery/css/examples.css');
                echo $html->css('/pquery/css/examples.css');
                echo $html->css('cake.css');         
                echo $html->css('/pquery/css/jquery.jqplot.css');
                echo $html->css('estadisticas');
                
                $mesas = array ( 
                               array('Mesa'=> array('tipo'=> 'Efectivo','total'=>'600','cant'=>'6300')),
                               array('Mesa'=> array('tipo'=> 'Cheque','total'=>'330','cant'=>'3700')),
                               array('Mesa'=> array('tipo'=> 'Debito','total'=>'290','cant'=>'2200')),
                               array('Mesa'=> array('tipo'=> 'Credito','total'=>'50','cant'=>'100'))
                             );    
                
?>



<script language="javascript" type="text/javascript">   
    jQuery.noConflict(); 
    
    var mesas= <?php echo json_encode($mesas); ?>;
    
    mesas.getCoordenadas = function(){
           
        var linea = [];
            jQuery.each(mesas,function(i){
                var coordMesa = [mesas[i].Mesa.tipo, parseFloat(mesas[i].Mesa.total)];
                linea.push(coordMesa);  
            })
            return linea; 
        }

    jQuery(document).ready(function(){
        s1 = mesas.getCoordenadas();

        plot1 = jQuery.jqplot('chart1', [s1], {
            grid: {
                drawBorder: false, 
                drawGridlines: false,
                background: '#ffffff',
                shadow:false
            },
            axesDefaults: {

            },
            seriesDefaults:{
                renderer:jQuery.jqplot.PieRenderer,
                rendererOptions: {
                    showDataLabels: true
                }
            },
            legend: {
                show: true,
                rendererOptions: {
                    numberRows: 1
                },
                location: 's'
            }
        }); 
    });
</script>

<?php echo $this->element('menustats'); ?>

<div class="grid_6 push_1">
<div id="chart1" style="width: 80%; height: 450px; margin-left: 10%;"></div>
</div>

<div class="grid_2 push_1 select_periodo">
    <?php echo $html->link("Dia", 'mesas_pago/dia', array('class' => 'menu_periodo')) ?>
    <?php echo $html->link("Semana", 'mesas_pago/semana', array('class' => 'menu_periodo')) ?>
    <?php echo $html->link("Mes", 'mesas_pago/mes', array('class' => 'menu_periodo')) ?>
    <?php echo $html->link("Año", 'mesas_pago/anio', array('class' => 'menu_periodo')) ?>
</div>


<div class="grid_10 push_2 omega">
    
    <table cellspacing="0" cellpadding="0" style="text-align: left; font-size: 17px;">
        <thead>
                        <tr>
                            <th class="editable">Tipo de pago</th>
                            <th class="editable">Cantidad de mesas</th>
                            <th class="editable">Total</th>
                        </tr>
        </thead>
        <tbody>

    <?php     
        if(!empty($mesas)){

                foreach($mesas as $m){
                    echo('<tr>');
                    echo('<td>');
                    ?><strong><?php
                    echo($m['Mesa']['tipo']);
                    ?></strong><?php
                    echo('</td>');
                    echo('<td>');
                    echo($m['Mesa']['cant']);
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

</div>




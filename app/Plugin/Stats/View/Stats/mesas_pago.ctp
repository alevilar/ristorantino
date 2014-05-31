<?php
                echo $this->Html->script('/pquery/js/jquery.min.js'); 
		echo $this->Html->script('/pquery/js/jquery.jqplot.js');
		echo $this->Html->script('/pquery/js/plugins/jqplot.pieRenderer.js');
                
                echo $html->css('/pquery/css/examples.css');
                echo $html->css('/pquery/css/examples.css');
                echo $html->css('cake.css');         
                echo $html->css('/pquery/css/jquery.jqplot.css');
                echo $html->css('estadisticas');
        
                
?>



<script language="javascript" type="text/javascript">   
    jQuery.noConflict(); 
    
    var mesas= <?php echo json_encode($mesa); ?>;
    
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


<div class="clear" style="height: 20px;"></div>

<div class="grid_9 alpha">
    <div id="chart1" class="grid_12 alpha omega" style="height:350px;"></div>

</div>

<div class="grid_3 omega">
    <table cellspacing="0" cellpadding="0">
        <thead>
                        <tr>
                            <th class="editable">Tipo de pago</th>
                            <th class="editable">Cantidad de mesas</th>
                            <th class="editable">Total</th>
                        </tr>
        </thead>
        <tbody>

    <?php
        if ( !empty($mesa) ){

                foreach ( $mesa as $m ){
                    ?>
                    <tr>
                        <td>
                            <strong><?php echo($m['Mesa']['tipo']); ?></strong>
                        </td>
                        
                        <td> <?php echo($m['Mesa']['cant']); ?></td>
                        
                        <td> $<?php echo($m['Mesa']['total']); ?></td>
                    </tr>
                    <?php
            }        
        }else{
            ?>
                    <tr><td>No se encontraron mesas</td></tr>        
            <?php
        }    
    ?>
        </tbody>
    </table>

</div>
    <div class="grid_2 push_1 select_periodo">
        <?php echo $html->link("Dia", 'mesas_pago/dia', array('class' => 'menu_periodo')) ?>
        <?php echo $html->link("Semana", 'mesas_pago/semana', array('class' => 'menu_periodo')) ?>
        <?php echo $html->link("Mes", 'mesas_pago/mes', array('class' => 'menu_periodo')) ?>
        <?php echo $html->link("Año", 'mesas_pago/anio', array('class' => 'menu_periodo')) ?>
    </div>





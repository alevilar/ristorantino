<?php
                echo $html->css('cake.css');   
                echo $this->Html->script('/pquery/js/jquery.min.js'); 
		echo $this->Html->script('/pquery/js/jquery.jqplot.js');
		echo $this->Html->script('/pquery/js/plugins/jqplot.pieRenderer.js');
                
                echo $html->css('/pquery/css/examples.css');   
                echo $html->css('/pquery/css/jquery.jqplot.css');
                echo $html->css('estadisticas');
                
                $mesastest = array ( 
                               array('Mesa'=> array('tipo'=> 'A','total'=>'300','cant'=>'1500')),
                               array('Mesa'=> array('tipo'=> 'B','total'=>'250','cant'=>'1200')),
                               array('Mesa'=> array('tipo'=> 'C','total'=>'150','cant'=>'600')),
                               array('Mesa'=> array('tipo'=> 'Otros','total'=>'50','cant'=>'150'))
                             ); 
                debug($mesastest);
?>

<script id="example_1" type="text/javascript">
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
    <?php echo $html->link("Dia", 'mesas_factura/dia', array('class' => 'menu_periodo')) ?>
    <?php echo $html->link("Semana", 'mesas_factura/semana', array('class' => 'menu_periodo')) ?>
    <?php echo $html->link("Mes", 'mesas_factura/mes', array('class' => 'menu_periodo')) ?>
    <?php echo $html->link("Año", 'mesas_factura/anio', array('class' => 'menu_periodo')) ?>
</div>


<div class="grid_10 push_2 omega">
    
    <table cellspacing="0" cellpadding="0" style="text-align: left; font-size: 17px;">
        <thead>
                        <tr>
                            <th class="editable">Tipo de factura</th>
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
                    echo($m['mesas']['tipo']);
                    ?></strong><?php
                    echo('</td>');
                    echo('<td>');
                    echo($m['mesas']['cant']);
                    echo('</td>');
                    echo('<td>');
                    echo('$');
                    echo($m['mesas']['total']);
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





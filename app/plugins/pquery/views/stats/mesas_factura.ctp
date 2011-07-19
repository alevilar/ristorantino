<?php
                echo $html->css('cake.css');   
                echo $javascript->link('/pquery/js/jquery.min.js'); 
		echo $javascript->link('/pquery/js/jquery.jqplot.js');
		echo $javascript->link('/pquery/js/plugins/jqplot.pieRenderer.js');
                
                echo $html->css('/pquery/css/examples.css');   
                echo $html->css('/pquery/css/jquery.jqplot.css');
                echo $html->css('estadisticas');
                
                $mesas = array ( 
                               array('Mesa'=> array('tipo'=> 'A','total'=>'300')),
                               array('Mesa'=> array('tipo'=> 'B','total'=>'250')),
                               array('Mesa'=> array('tipo'=> 'C','total'=>'150')),
                               array('Mesa'=> array('tipo'=> 'Otros','total'=>'50'))
                             ); 
?>

<style type="text/css">
    #code {
        font: 10pt "Andale Mono", Monaco, "Courier New", sans-serif ;
        white-space: pre;
    }
    
    pre {
        background: #D8F4DC;
        border: 1px solid rgb(200, 200, 200);
        padding-top: 1em;
        padding-left: 3em;
        padding-bottom: 1em;
        margin-top: 1em;
        margin-bottom: 3em;
        
    }
    
    p {
        margin: 2em 0;
    }
    
</style>

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
    <div id="chart1" style="margin-top:20px; margin-left:20px; width:400px; height:400px;"></div>
</div>
<div class="grid_2 push_1 select_periodo">

    <a class="menu_periodo">Dia</a>
    <a class="menu_periodo">Semana</a>
    <a class="menu_periodo">Mes</a>
    <a class="menu_periodo">Año</a>

</div>


<div class="grid_12">
<table cellspacing="0" cellpadding="0">
        <caption class="editable">Ventas Por Tipo de Factura</caption>
        <thead>
        <tr>
                        <th class="editable">cant. mesas</th>
                        <th class="editable">cubiertos</th>
                        <th class="editable">total</th>
                        <th class="editable">promedio x cubierto</th>
                        <th class="editable">fecha</th>
                        <th class="editable">tipofactura</th>
                    </tr>
        </thead>
        <tbody>
                <tr class="altrow">
                            <td>
                        3            </td>
                            <td>
                        8            </td>
                            <td>
                        2160.00            </td>
                            <td>
                        270.000000            </td>
                            <td>
                        08/07/2011 - Fri July            </td>
                            <td>
                        B            </td>
                        </tr>
                <tr>
                            <td>
                        1            </td>
                            <td>
                        5            </td>
                            <td>
                        147.00            </td>
                            <td>
                        29.400000            </td>
                            <td>
                        20/04/2011 - Wed April            </td>
                            <td>
                        B            </td>
                        </tr>
                <tr class="altrow">
                            <td>
                        1            </td>
                            <td>
                        3            </td>
                            <td>
                        122.00            </td>
                            <td>
                        40.666667            </td>
                            <td>
                        19/04/2011 - Tue April            </td>
                            <td>
                        R            </td>
                        </tr>
                <tr>
                            <td>
                        1            </td>
                            <td>
                        23            </td>
                            <td>
                        110.00            </td>
                            <td>
                        4.782609            </td>
                            <td>
                        23/03/2011 - Wed March            </td>
                            <td>
                        B            </td>
                        </tr>
                </tbody>
    </table>

</div>





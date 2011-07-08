<?php
                echo $javascript->link('/pquery/js/jquery.min.js'); 
		echo $javascript->link('/pquery/js/jquery.jqplot.js');
		echo $javascript->link('/pquery/js/plugins/jqplot.pieRenderer.js');
                echo $html->css('/pquery/css/examples.css');
                echo $html->css('/pquery/css/examples.css');
                echo $html->css('cake.css');         
                echo $html->css('/pquery/css/jquery.jqplot.css');

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
    $(document).ready(function(){
    s1 = [['B',22], ['R',15.3], ['A',10.7], ['Otros',5]];
        
    plot1 = $.jqplot('chart1', [s1], {
        grid: {
            drawBorder: false, 
            drawGridlines: false,
            background: '#ffffff',
            shadow:false
        },
        axesDefaults: {
            
        },
        seriesDefaults:{
            renderer:$.jqplot.PieRenderer,
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

<div class="grid_3 push_3">
<div id="chart1" style="margin-top:20px; margin-left:20px; width:300px; height:300px;"></div>
</div>
<div class="grid_2 push_5">
<p>Total ventas por factura</p>
<select>
<option value="">Dia</option>
<option value="Contabilidad">Semana</option>
<option value="mesas">Mes</option>
<option value="mozos">Ultimos 3 meses</option>
<option value="ranking">Ultimos 6 meses</option>
<option value="ventas totales">Ultimo año</option>
</select>



</div>


<div class="grid_12">
<table cellspacing="0" cellpadding="0">
        <caption class="editable">VentasPorTipoFactura</caption>
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





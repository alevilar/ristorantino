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
    s1 = [['Efectivo',22], ['Debito',15.3], ['Visa',10.7], ['Mastercard',5.2], ['Otros', 5.2]];
        
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
<div id="chart1" style="margin-top:20px; margin-left:20px; width:400px; height:400px;"></div>
</div>
<div class="grid_2 push_5">
<p>Total ventas por tipo de pago</p>
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
        <caption class="editable">Total de ventas por Tipo de pago</caption>
        <thead>
        <tr>
                        <th class="editable">fecha</th>
                        <th class="editable">cant. mesas</th>
                        <th class="editable">total</th>
                        <th class="editable">name</th>
                    </tr>
        </thead>
        <tbody>
                <tr class="altrow">
                            <td>
                        08/07/2011             </td>
                            <td>
                        1            </td>
                            <td>
                        110.00            </td>
                            <td>
                        Tarjeta Visa Debito            </td>
                        </tr>
                <tr>
                            <td>
                        08/07/2011             </td>
                            <td>
                        2            </td>
                            <td>
                        2050.00            </td>
                            <td>
                                    </td>
                        </tr>
                <tr class="altrow">
                            <td>
                        20/04/2011             </td>
                            <td>
                        1            </td>
                            <td>
                        147.00            </td>
                            <td>
                        Dudoso            </td>
                        </tr>
                <tr>
                            <td>
                        19/04/2011             </td>
                            <td>
                        3            </td>
                            <td>
                        366.00            </td>
                            <td>
                        Efectivo            </td>
                        </tr>
                <tr class="altrow">
                            <td>
                        19/04/2011             </td>
                            <td>
                        1            </td>
                            <td>
                        122.00            </td>
                            <td>
                        No Paga            </td>
                        </tr>
                <tr>
                            <td>
                        19/04/2011             </td>
                            <td>
                        1            </td>
                            <td>
                        122.00            </td>
                            <td>
                        Tarjeta Amex            </td>
                        </tr>
                <tr class="altrow">
                            <td>
                        19/04/2011             </td>
                            <td>
                        1            </td>
                            <td>
                        122.00            </td>
                            <td>
                        Tarjeta Master Card            </td>
                        </tr>
                <tr>
                            <td>
                        23/03/2011             </td>
                            <td>
                        2            </td>
                            <td>
                        220.00            </td>
                            <td>
                        Efectivo            </td>
                        </tr>
                <tr class="altrow">
                            <td>
                        23/03/2011             </td>
                            <td>
                        2            </td>
                            <td>
                        220.00            </td>
                            <td>
                        Tarjeta            </td>
                        </tr>
                <tr>
                            <td>
                        23/03/2011             </td>
                            <td>
                        1            </td>
                            <td>
                        110.00            </td>
                            <td>
                        Tarjeta Maestro            </td>
                        </tr>
                <tr class="altrow">
                            <td>
                        23/03/2011             </td>
                            <td>
                        2            </td>
                            <td>
                        220.00            </td>
                            <td>
                        Tarjeta Master Card            </td>
                        </tr>
                </tbody>
    </table>


</div>





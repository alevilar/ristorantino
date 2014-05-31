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
    s1 = [['Proveedores',30], ['Empleados',23], ['Impuestos',5.7], ['Gastos generales',4], ['Extras',1.5]];
        
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
<p>Total ingresos</p>
<select>
<option value="">Mes</option>
<option value="Contabilidad">Año</option>
</select>



</div>


<div class="col-md-12">
<table cellspacing="0" cellpadding="0">
        <caption class="editable">Total de ingresos</caption>
        <thead>
        <tr>
                        <th class="editable">Concepto</th>
                        <th class="editable">Total</th>
                        <th class="editable">Porcentaje</th>
                    </tr>
        </thead>
        <tbody>
                <tr class="altrow">
                            <td>
                        Mesas             </td>
                            <td>
                        $80000            </td>
                            <td>
                        43%               </td>
                        </tr>
                <tr>
                            <td>
                        Delivery             </td>
                            <td>
                        $28000            </td>
                            <td>
                        30%            </td>
                        </tr>
                <tr class="altrow">
                            <td>
                        Publicidad            </td>
                            <td>
                        $10000            </td>
                            <td>
                        21%            </td>
                        </tr>
                <tr>
                            <td>
                        Extras            </td>
                            <td>
                        $6000            </td>
                            <td>
                        6%            </td>
                        </tr>
                
                </tbody>
    </table>


</div>





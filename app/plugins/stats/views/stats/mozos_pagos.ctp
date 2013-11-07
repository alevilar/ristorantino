<?php
                echo $javascript->link('/pquery/js/jquery.min.js', false); 
		echo $javascript->link('/pquery/js/jquery.jqplot.js', false);
		echo $javascript->link('/pquery/js/plugins/jqplot.barRenderer.js', false);
                
                
                echo $javascript->link('/pquery/js/plugins/jqplot.categoryAxisRenderer.js', false);
                echo $javascript->link('/pquery/js/plugins/jqplot.highlighter.js', false);
                echo $javascript->link('/pquery/js/plugins/jqplot.pointLabels.js', false);
                
                echo $html->css('/pquery/css/examples.css', false);
                echo $html->css('cake.css', false);         
                echo $html->css('/pquery/css/jquery.jqplot.css', false);

?>

  <script class="code" type="text/javascript">$(document).ready(function(){
        var s1 = [6000, 3950, 6200, 5500];
        var ticks = ['Pablo', 'Marcelo', 'Juan Martin', 'Pepe'];
        
        plot1 = $.jqplot('chart1', [s1], {
            seriesDefaults:{
                renderer:$.jqplot.BarRenderer,
                pointLabels: { show: true }
            },
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    ticks: ticks
                }
            },
            highlighter: { show: false }
        });
    
        $('#chart1').bind('jqplotDataClick', 
            function (ev, seriesIndex, pointIndex, data) {
                $('#info1').html('Mozo '+ticks[pointIndex]+' $'+s1[pointIndex]);
            }
        );
    });</script>

  
<!-- TABLA DE MOZOS -->
<div class="col-md-12">  
    </br></br>
  <table cellspacing="0" cellpadding="0">
        <caption class="editable">Mensual por mozo</caption>
        <thead>
        <tr>
                        <th class="editable">anio</th>
                        <th class="editable">mes</th>
                        <th class="editable">total</th>
                        <th class="editable">cant_mesas</th>
                        <th class="editable">promedio_consumo_por_mesa</th>
                        <th class="editable">cubiertos</th>
                        <th class="editable">promedio_por_cubierto</th>
                        <th class="editable">nombre</th>
                        <th class="editable">apellido</th>
                        <th class="editable">numero</th>
                    </tr>
        </thead>
        <tbody>
                <tr class="altrow">
                            <td>
                        2011            </td>
                            <td>
                        7            </td>
                            <td>
                        750.00            </td>
                            <td>
                        1            </td>
                            <td>
                        200.00            </td>
                            <td>
                        60            </td>
                            <td>
                        93.00            </td>
                            <td>
                        Javier            </td>
                            <td>
                        Masa            </td>
                            <td>
                        32            </td>
                        </tr>
                <tr>
                            <td>
                        2011            </td>
                            <td>
                        7            </td>
                            <td>
                        147.00            </td>
                            <td>
                        1            </td>
                            <td>
                        147.00            </td>
                            <td>
                        90            </td>
                            <td>
                        80.00            </td>
                            <td>
                        Jose Luis            </td>
                            <td>
                        Chilavert            </td>
                            <td>
                        1            </td>
                        </tr>
                <tr class="altrow">
                            <td>
                        2011            </td>
                            <td>
                        7            </td>
                            <td>
                        122.00            </td>
                            <td>
                        1            </td>
                            <td>
                        122.00           </td>
                            <td>
                        135            </td>
                            <td>
                        115.00            </td>
                            <td>
                        Juan            </td>
                            <td>
                        Perez            </td>
                            <td>
                        22            </td>
                        </tr>
                <tr>
                            <td>
                        2011            </td>
                            <td>
                        7            </td>
                            <td>
                        110.00            </td>
                            <td>
                        1            </td>
                            <td>
                        50.00            </td>
                            <td>
                        23            </td>
                            <td>
                        23.00            </td>
                            <td>
                        Pepe            </td>
                            <td>
                        Marchese            </td>
                            <td>
                        1            </td>
                        </tr>
                </tbody>
    </table>
</div>
<!-- TABLA DE MOZOS -->

<div class="grid_3 push_3">
<div id="chart1" style="margin-top:20px; margin-left:20px; width:300px; height:300px;"></div>
</div>
<div class="grid_2 push_5">
<p>Ganancias de los mozos</p>
<select>
<option value="mozos">Por mes</option>
<option value="ranking">Por año</option>
</select>
</br></br></br>
<label>Elija el mes/año</label>
<input type="text" maxlength="11" ></input>
</div>


</div>
  <div class="grid_4 push_3"> 
  
<div><span>You Clicked: </span><span id="info1">Nothing yet</span></div>
        
<div id="chart1" style="margin-top:20px; margin-left:20px; width:300px; height:300px;"></div>

</br>
</br>
  </div>
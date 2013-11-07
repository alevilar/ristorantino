<?php
                echo $javascript->link('/pquery/js/jquery.min.js'); 
		echo $javascript->link('/pquery/js/jquery.jqplot.js');
		echo $javascript->link('/pquery/js/plugins/jqplot.barRenderer.js');
                
                
                echo $javascript->link('/pquery/js/plugins/jqplot.categoryAxisRenderer.js');
                echo $javascript->link('/pquery/js/plugins/jqplot.highlighter.js');
                echo $javascript->link('/pquery/js/plugins/jqplot.pointLabels.js');
                
                echo $html->css('/pquery/css/examples.css');
                echo $html->css('cake.css');         
                echo $html->css('/pquery/css/jquery.jqplot.css');

?>

  <script class="code" type="text/javascript">$(document).ready(function(){
        var s1 = [6000, 3950, 6200, 5500, 2000, 4200, 5210];
        var ticks = ['20', '60', '7', '25', '12', '32', '15'];
        
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
        <caption class="editable">Total mesas</caption>
        <thead>
        <tr>
                        <th class="editable">mesa</th>
                        <th class="editable">total</th>
                        <th class="editable">cantidad</th>
                        <th class="editable">promedio</th>
                    </tr>
        </thead>
        <tbody>
                <tr class="altrow">
                            <td>
                        20            </td>
                            <td>
                        $6000            </td>
                            <td>
                        20            </td>
                            <td>
                        $200            </td>
                        </tr>
                <tr>
                            <td>
                        60            </td>
                            <td>
                        $3950            </td>
                            <td>
                        21            </td>
                            <td>
                        $60            </td>
                        </tr>
                <tr class="altrow">
                            <td>
                        7            </td>
                            <td>
                        $6200            </td>
                            <td>
                        11            </td>
                            <td>
                        $147            </td>
                        </tr>
                <tr>
                <tr class="altrow">
                            <td>
                        25            </td>
                            <td>
                        $5500            </td>
                            <td>
                        9            </td>
                            <td>
                        $97           </td>
                        </tr>
                <tr>    
                            <td>
                        12            </td>
                            <td>
                        $2000            </td>
                            <td>
                        10            </td>
                            <td>
                        $80            </td>
                        </tr>
                <tr class="altrow">
                            <td>
                        32            </td>
                            <td>
                        $4200            </td>
                            <td>
                        13            </td>
                            <td>
                        $190            </td>
                        </tr>
                <tr>
                            <td>
                        15            </td>
                            <td>
                        $5210            </td>
                            <td>
                        22           </td>
                            <td>
                        $110           </td>
                        </tr>
                </tbody>
    </table>
</div>
<!-- TABLA DE MOZOS -->

<div class="grid_5 push_2">
<div id="chart1" style="margin-top:20px; margin-left:0px; width:600px; height:300px;"></div>
</div>
<div class="grid_2 push_5">
<p>Fecha</p>
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
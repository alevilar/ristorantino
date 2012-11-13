<?php
                echo $this->Html->script('/pquery/js/jquery.min.js'); 
		echo $this->Html->script('/pquery/js/jquery.jqplot.js');
		echo $this->Html->script('/pquery/js/plugins/jqplot.pieRenderer.js');
                echo $html->css('/pquery/css/examples.css');
               
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
    s1 = [['Marcelo',7], ['Pablo',13.3], ['Walter',10.7], ['Victor',5.2], ['Ramiro', 5.2]];
        
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
<p>Suma del total de las mesas correspondientes a cada mozo</p>
<select>
<option value="">Dia</option>
<option value="Contabilidad">Semana</option>
<option value="mesas">Mes</option>
<option value="mozos">Ultimos 3 meses</option>
<option value="ranking">Ultimos 6 meses</option>
<option value="ventas totales">Ultimo año</option>
</select>
<strong><p>Total: $33.000</p></strong>
<p>Marcelo $5.000</p> 
<p>Pablo $12.000</p> 
<p>Walter $8.000</p> 
<p>Victor $4.500</p> 
<p>Ramiro $4.500</p>
</div>

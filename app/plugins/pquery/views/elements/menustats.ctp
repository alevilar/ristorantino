<div class="grid_2 alpha menu_stats">
    <ul>
        <li style="text-transform: uppercase;">- Ventas -</li>
        <li><?php echo $html->link('Ventas totales','/pquery/stats/mesas_total',array('class'=>'ventas'));?></li>
        <li><?php echo $html->link('Por tipo de pago','/pquery/stats/mesas_pago',array('class'=>'ventas'));?></li>
        <li><?php echo $html->link('Por factura','/pquery/stats/mesas_factura',array('class'=>'ventas'));?></li>
        <!-- <li class="sep"></li> -->
    </ul>
</div>

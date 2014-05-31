<div class="administracion_menu">
    <h2>Estadísticas</h2>
    <ul>
        <li><?php echo $html->link('Ventas totales','/stats/mesas_total',array('class'=>'ventas'));?></li>
        
        <li><?php echo $html->link('Ventas Mozo','/stats/mozos_total',array('class'=>'ventas'));?></li>
        
        <li><?php echo $html->link('Descargas','/pquery/queries/descargar_queries',array('class'=>'ventas'));?></li>        
    </ul>
</div>

<?php
$c1 = $c2 = $c3 = '';

if( $this->name == 'Stats' && $this->action == 'mesas_total') {
    $c1 = 'active';
}
if( $this->name == 'Stats' && $this->action == 'mozos_total') {
    $c2 = 'active';
}
if( $this->name == 'Pquery' && $this->action == 'descargar_queries') {
    $c3 = 'active';
}

?>
<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
     <ul class="nav navbar-nav">
        <li class="<?php echo $c1?>"><?php echo $html->link('Ventas totales','/stats/mesas_total',array('class'=>'ventas'));?></li>
        
        <li class="<?php echo $c2?>"><?php echo $html->link('Ventas Mozo','/stats/mozos_total',array('class'=>'ventas'));?></li>
        
    </ul>
    
</nav>

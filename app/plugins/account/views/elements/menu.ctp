<?php
$c1 = $c2 = $c3 = $c4 = $c5 = '';

if( $this->name == 'Gastos' && $this->action == 'index') {
    $c1 = 'active';
}
if( $this->name == 'Gastos' && $this->action == 'history') {
    $c2 = 'active';
}
if( $this->name == 'Clasificaciones' && $this->action == 'gastos') {
    $c3 = 'active';
}
if( $this->name == 'Egresos' && $this->action == 'history') {
    $c4 = 'active';
}
if( $this->name == 'Cierres' && $this->action == 'index') {
    $c5 = 'active';
}

?>
<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <li class="<?php echo $c1?>">
            <?php echo $html->link('Pendientes de Pago', '/account/gastos')?>
        </li>
        <li class="<?php echo $c2?>">
          <?php echo $html->link('Listado de Gastos', '/account/gastos/history')?>
        </li>
        <li class="<?php echo $c3?>">
            <?php echo $html->link('Gastos x Clasificación', '/account/clasificaciones/gastos')?>
        </li>
        <li class="<?php echo $c4?>">
            <?php echo $html->link('Pagos', '/account/egresos/history')?>
        </li>
        <li class="<?php echo $c5?>">
            <?php echo $html->link('Cierres', '/account/cierres')?>
        </li>
      </ul>      
        
          <?php echo $html->link('Nuevo Gasto', '/account/gastos/add', array('class'=>'btn btn-success pull-right'))?>
</nav>

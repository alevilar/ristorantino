<?php
$c1 = $c2 = $c3 = $c4 = $c5 = $c6 = $c7 = $c8 = '';

if ($this->name == 'Gastos' && $this->action == 'index') {
    $c1 = 'active';
}
if ($this->name == 'Gastos' && $this->action == 'history') {
    $c2 = 'active';
}
if ($this->name == 'Clasificaciones' && $this->action == 'gastos') {
    $c3 = 'active';
}
if ($this->name == 'Egresos' && $this->action == 'history') {
    $c4 = 'active';
}
if ($this->name == 'Cierres' && $this->action == 'index') {
    $c5 = 'active';
}
if ($this->name == 'Proveedores' && $this->action == 'index') {
    $c6 = 'active';
}
if ($this->name == 'TipoImpuestos' && $this->action == 'index') {
    $c7 = 'active';
}
if ($this->name == 'Clasificaciones' && $this->action == 'index') {
    $c8 = 'active';
}
?>
<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
    <ul class="nav navbar-nav">
        

        <li class="dropdown">
            <?php echo $html->link('Gastos<b class="caret"></b>', '#', array(
                 "class"=>"dropdown-toggle" ,
                 "data-toggle"=> "dropdown",
                 "escape" => false
            )) ?>
            <ul class="dropdown-menu">
                <li class="<?php echo $c1 ?>">
                    <?php echo $html->link('Pendientes de Pago', '/account/gastos') ?>
                </li>
                <li class="<?php echo $c2 ?>">
                    <?php echo $html->link('Listado de Gastos', '/account/gastos/history') ?>
                </li>
                <li class="<?php echo $c3 ?>">
                    <?php echo $html->link('Gastos x Clasificación', '/account/clasificaciones/gastos') ?>
                </li>
            </ul>
        </li>



        <li class="<?php echo $c4 ?>">
            <?php echo $html->link('Pagos', '/account/egresos/history') ?>
        </li>
        <li class="<?php echo $c5 ?>">
            <?php echo $html->link('Cierres', '/account/cierres') ?>
        </li>

        <li class="<?php echo $c6 ?>">
            <?php echo $html->link('Proveedores', '/account/proveedores') ?>
        </li>

        <li class="<?php echo $c7 ?>">
            <?php echo $html->link('Impuestos', '/account/tipo_impuestos') ?>
        </li>
        
         <li class="<?php echo $c8 ?>">
            <?php echo $html->link('Clasificaciones', '/account/clasificaciones') ?>
        </li>
    </ul>      

    <?php echo $html->link('Nuevo Gasto', '/account/gastos/add', array('class' => 'btn btn-success pull-right')) ?>
</nav>

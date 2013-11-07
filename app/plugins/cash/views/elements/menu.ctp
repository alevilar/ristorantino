<?php
$cajas = ClassRegistry::init('Cash.Caja')->find('list');
?>
<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
    <ul class="nav navbar-nav">
        <li><?php echo $html->link('Ayuda Arqueos', array('controller'=>'arqueos','action'=>'help')); ?></li>
        
        
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Nuevo Arqueo <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <?php foreach ($cajas as $cId=>$cName) { ?>
                    <li><?php echo $html->link('Crear Nuevo Arqueo de '.$cName, array('controller'=>'arqueos', 'action'=>'add', $cId));?></li>
                <?php } ?>
            </ul>
        </li>

        <li><?php echo $html->link('Listar Arqueos', array('action'=>'index')); ?></li>
        <li><?php echo $html->link('Listar informes Z', array('controller'=>'zetas','action'=>'index'));?></li>
        <li><?php echo $html->link('Ver, Crear y Modificar Cajas', array('controller'=>'cajas','action'=>'index'));?></li>

        
    </ul>      
</nav>

<div class="grid_6 alpha">
    <H2>Cajas</H2>
    
    <ul class="menu-vertical">
    <?php foreach ($cajas as $c) { ?>
        <li><?php echo $html->link('Crear Nuevo Arqueo de '.$c['Caja']['name'], array('action'=>'add', $c['Caja']['id']));?></li>
    <?php } ?>
    </ul>
</div>

<div class="grid_6 omega">
    <h2>Administración</h2>
    <ul>
        <li><?php echo $html->link('Listar Arqueos', array('action'=>'index')); ?></li>
        <li><?php echo $html->link('Listar informes Z', array('controller'=>'zetas','action'=>'index'));?></li>
    </ul>
    <h2>Configuración</h2>
    <ul>
        <li><?php echo $html->link('Ver, Crear y Modificar Cajas', array('controller'=>'cajas','action'=>'index'));?></li>
    </ul>
</div>

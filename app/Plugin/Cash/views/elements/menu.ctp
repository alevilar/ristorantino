<?php
$c1 = $c2 = $c3 = '';

if( $this->name == 'Arqueos' && $this->action == 'index') {
    $c1 = 'active';
}
if( $this->name == 'Zetas' && $this->action == 'index') {
    $c2 = 'active';
}
if( $this->name == 'Cajas' && $this->action == 'index') {
    $c3 = 'active';
}

?>
<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
    <ul class="nav navbar-nav">
        <li class="<?php echo $c1?>"><?php echo $this->Html->link('Arqueos', array('controller'=>'arqueos','action'=>'index')); ?></li>
        <li class="divider"></li>
        <li class="<?php echo $c2?>"><?php echo $this->Html->link('Zetas', array('controller'=>'zetas','action'=>'index'));?></li>
        <li class="divider"></li>
        <li class="<?php echo $c3?>"><?php echo $this->Html->link('Cajas', array('controller'=>'cajas','action'=>'index'));?></li>
        
    </ul>      
</nav>

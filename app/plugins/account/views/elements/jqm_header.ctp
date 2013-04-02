<div data-role="header">		
    <h1><?php echo $titulo;?></h1>
	<div data-role="navbar">
		<ul>        
                    <li><?php echo $html->link(__('Gastos Pendientes de Pago', true), array('controller'=>'gastos', 'action' => 'index')); ?></li>
                    <li><?php echo $html->link(__('Listado de Gastos', true), array('controller'=>'gastos', 'action' => 'history')); ?></li>
                    <li><?php echo $html->link(__('Clasificación de Gastos', true), array('controller'=>'clasificaciones', 'action' => 'gastos')); ?></li>
                    <li><?php echo $html->link(__('Historico de Pagos', true), array('controller'=>'egresos','action' => 'history')); ?></li>
                </ul>
	</div><!-- /navbar -->
        <?php echo $html->link('Opciones', '#option-list', array('data-rel'=>'dialog', 'data-theme'=>'b'));?>
</div><!-- /footer -->
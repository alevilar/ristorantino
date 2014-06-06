<div data-role="header">		
    <?php echo $this->Html->link('Opciones', '#option-list', array('data-rel'=>'dialog'));?>
    <h1><?php echo $titulo;?></h1>
    <?php echo $this->Html->link(__('Crear Nuevo gasto / factura', true), array('controller' => 'gastos', 'action' => 'add'), array('data-role' => 'button', 'data-icon' => 'plus', 'data-inline' => 'true', 'data-theme' => 'e')); ?>
	<div data-role="navbar">
		<ul>        
                    <li><?php echo $this->Html->link(__('Gastos Pendientes de Pago', true), array('controller'=>'gastos', 'action' => 'index')); ?></li>
                    <li><?php echo $this->Html->link(__('Listado de Gastos', true), array('controller'=>'gastos', 'action' => 'history')); ?></li>
                    <li><?php echo $this->Html->link(__('Clasificación de Gastos', true), array('controller'=>'clasificaciones', 'action' => 'gastos')); ?></li>
                    <li><?php echo $this->Html->link(__('Historico de Pagos', true), array('controller'=>'egresos','action' => 'history')); ?></li>
                    <li><?php echo $this->Html->link(__('Cierres', true), array('controller'=>'cierres', 'action' => 'index')); ?></li>
                </ul>
	</div><!-- /navbar -->
</div><!-- /footer -->
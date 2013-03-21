<div data-role="header">		
    <h1><?php echo $titulo;?></h1>
	<div data-role="navbar">
		<ul>        
                    <li><?php echo $html->link(__('Gastos Pendientes de Egreso', true), array('controller'=>'gastos', 'action' => 'index')); ?></li>
                    <li><?php echo $html->link(__('Historico de Gastos', true), array('controller'=>'gastos', 'action' => 'history')); ?></li>
                    <li><?php echo $html->link(__('Historico de Pagos (Salidas)', true), array('controller'=>'egresos','action' => 'history')); ?></li>
                </ul>
	</div><!-- /navbar -->
</div><!-- /footer -->
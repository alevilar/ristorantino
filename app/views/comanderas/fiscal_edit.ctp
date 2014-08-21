
<div class="comanderas form">
<?php echo $form->create('Config', array(
					'url'=>array( 
						'controller'=>'comanderas',
						'action'=>'fiscal_edit'
						)
						));?>
	<fieldset>
 		<legend><?php __('Fiscal Printer');?></legend>
	<?php
		echo $form->input('nombre', array(
			'after' => '<p class="text-info">En caso de tener la impresora conecta a una PC con windows, aca se debe colocar el numero del puerto COM, o sea: 1,2,3 o 4. Sólo el número. En caso de usar Linux, se debe escribir el nombre de la terminal ttyUSB0, ttyUSB1 o lo que corresponda segun sus dispositivos /dev/tty</p>'
			));
		echo $form->input('modelo', array(
			'options' => array(
					'hasar_441' => 'Hasar Tickets (441, 715)',
					'hasar_1120f' => 'Hasar Factura Continuo (impresora matriz de punto)',
				)
			) );

	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>

<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listar Comanderas', true), array('action'=>'index')); ?></li>
		<li><?php echo $html->link(__('Nueva Comandera', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('Configurar Impresora Fiscal', true), array('action'=>'fiscal_edit')); ?></li>
	</ul>
</div>
<div class="clientes form">
<?php echo $form->create('Cliente');?>
	<fieldset>
 		<legend><?php __('Add Cliente');?></legend>
	<?php
		
		echo $form->input('User.username');
		echo $form->input('User.password');
		echo $form->input('User.nombre');
		echo $form->input('User.apellido');
		echo $form->input('User.telefono');
		echo $form->hidden('User.role',array('value'=>'cliente'));
	
		echo $form->input('descuento_id',array('empty'=>'Sin Descuento'));
		
		$tipos = array('0'=>'(ninguna)','A'=>'"A"','B'=>'"B"');
		echo $form->input('tipofactura',array('type'=>'radio','options'=>$tipos));
		
		echo $form->input('denominacion',array('label'=>'Denominación, Nombre fantasía'));
		echo $form->input('cuit',array('empty'=>'CUIT o CUIL'));
		echo $form->input('domicilio_fiscal',array('label'=>'Domicilio Fiscal'));
			
		echo $form->input('imprime_ticket',array('checked'=>true));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Clientes', true), array('action'=>'index'));?></li>
	</ul>
</div>

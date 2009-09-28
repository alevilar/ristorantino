<div class="clientes form">
<?php echo $form->create('Cliente');?>
	<fieldset>
 		<legend><?php __('Add Cliente');?></legend>
	<?php
		
		echo $form->input('denominacion/nombre',array('label'=>'Denominación, Nombre fantasía'));
		echo $form->input('cuit',array('empty'=>'CUIT o CUIL'));
		echo $form->input('domicilio_fiscal',array('label'=>'Domicilio Fiscal'));
		
		echo $form->input('user_id');
	
		echo $form->input('descuento_id',array('empty'=>'Sin Descuento'));
		
		$tipos = array('0'=>'(ninguna)','A'=>'"A"','B'=>'"B"');
		echo $form->input('tipofactura',array('type'=>'radio','options'=>$tipos));
		
		
			
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

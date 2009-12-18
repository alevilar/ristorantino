<div class="comensales form">
<?php echo $form->create('Comensal');?>
	<fieldset>
 		<legend>Editar Comensales de la mesa <?php echo $mesa['Mesa']['numero']?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('cant_mayores',array('default'=>0));
		echo $form->input('cant_menores',array('default'=>0));
		echo $form->input('cant_bebes',array('default'=>0));
		echo $form->hidden('mesa_id');
				
		
	?>
	</fieldset>
<?php 
	echo $ajax->submit('Submit',array('url'=>'/comensales/edit/'.$this->data['Comensal']['id'],'onclick'=>'setComensalesWindow.hide();',array('update'=>'div-comensales')));
	echo $form->end();?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Comensal.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Comensal.id'))); ?></li>
	</ul>
</div>

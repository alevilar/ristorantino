        <?php    
        echo $this->element('menuadmin');
        ?>


<div class="sabores form">
<?php echo $form->create('Sabor');?>
<fieldset>
 		<legend><?php __('Editar Sabor');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('categoria_id');
		echo $form->input('precio');
	?>
<?php echo $form->end('Submit');?>
</fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Borrar', true), array('action'=>'delete', $form->value('Sabor.id')), null, sprintf(__('¿Esta seguro que desea borrar el sabor: %s?', true), $form->value('Sabor.name'))); ?></li>
		<li><?php echo $html->link(__('Listar Sabores', true), array('action'=>'index'));?></li>
	</ul>
</div>

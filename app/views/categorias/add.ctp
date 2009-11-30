<div class="categorias form">
<?php echo $form->create('Categoria');?>
	<fieldset>
 		<legend><?php __('Add Categoria');?></legend>
	<?php
		echo $form->input('parent_id',array('type'=>'select', 'options'=> $categorias, 'default'=>1,'label'=>'Categoria Padre'));
		//echo $form->input('parent_id',array('empty'=>'raiz'));
		echo $form->input('name');
		echo $form->input('description');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Categorias', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Items', true), array('controller'=> 'items', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Item', true), array('controller'=> 'items', 'action'=>'add')); ?> </li>
	</ul>
</div>

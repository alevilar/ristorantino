<div class="tags form">
<?php echo $form->create('Tag');?>
	<fieldset>
		<legend><?php 
                if ( empty($this->data['Tag']['id'])) {
                    echo __('Add Tag'); 
                } else {
                    echo __('Edit Tag'); 
                }
                    ?>
                
                </legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('Producto');
	?>
	</fieldset>
<?php echo $form->end(__('Submit', 1));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Tag.id')), null, __('Are you sure you want to delete # %s?', $form->value('Tag.id'))); ?></li>
		<li><?php echo $html->link(__('List Tags', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Productos', true), array('controller' => 'productos', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Producto', true), array('controller' => 'productos', 'action' => 'add')); ?> </li>
	</ul>
</div>


        <?php    
        echo $this->element('menuadmin');
        ?>

<div class="categorias form">
<?php echo $form->create('Categoria', array('type' => 'file'));?>
	<fieldset>
 		<legend><?php __('Crear Categoria');?></legend>
	<?php
		echo $form->input('parent_id',array('type'=>'select', 'options'=> $categorias, 'default'=>1,'label'=>'Categoria Padre'));
		//echo $form->input('parent_id',array('empty'=>'raiz'));
		echo $form->input('name');
                echo $form->input('image_url',array('label'=>'Foto/Imagen', 'type'=>'file'));
		echo $form->input('description');
	?>
<?php echo $form->end('Submit');?>
</fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listar Categorias', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('Listar Items', true), array('controller'=> 'items', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('Crear Item', true), array('controller'=> 'items', 'action'=>'add')); ?> </li>
	</ul>
</div>

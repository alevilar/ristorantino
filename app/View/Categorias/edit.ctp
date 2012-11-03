        <?php    
        
        debug($this->data['Categoria']['image_url']);
        
        echo $html->image(MENU_FOLDER.'/'.$this->data['Categoria']['image_url'], array('width'=>100));
        ?>

<div class="categorias form">
<?php echo $form->create('Categoria', array('type' => 'file', 'url'=>'/categorias/edit'));?>
	<fieldset>
 		<legend><?php __('Editar Categoria');?></legend>
                
                
	<?php
            if (!empty($this->data['Categoria']['id'])){
		echo $form->input('id');
            }
		echo $form->input('parent_id',array('type'=>'select', 'options'=> $categorias, 'default'=>1,'label'=>'Categoria Padre'));
		echo $form->input('name',array('label'=>'Nombre'));
                echo $form->input('image_url',array('type'=>'hidden'));
                
                $catim = empty($this->data['Categoria']['image_url'])? '' : '('.$this->data['Categoria']['image_url'].')';
                echo $form->input('newfile',array('label'=>'Foto/Imagen '.$catim, 'type'=>'file'));
		echo $form->input('description',array('label'=>'Descripción'));
	?>
<?php echo $form->end('Submit');?>
</fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Borrar', true), array('action'=>'delete', $form->value('Categoria.id')), null, sprintf(__('¿Esta seguro que desea borrar la categoria: %s?', true), $form->value('Categoria.name'))); ?></li>
		<li><?php echo $html->link(__('Listar Categorias', true), array('action'=>'index'));?></li>
		<li><?php // echo $html->link(__('Listar Items', true), array('controller'=> 'items', 'action'=>'index')); ?> </li>
		<li><?php // echo $html->link(__('Crear Item', true), array('controller'=> 'items', 'action'=>'add')); ?> </li>
	</ul>
</div>

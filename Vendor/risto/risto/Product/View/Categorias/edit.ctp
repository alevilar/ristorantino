        <?php    
        
        if ( !empty($this->request->data['Categoria']['image_url'])) {
        	echo $this->Html->image(MENU_FOLDER.'/'.$this->request->data['Categoria']['image_url'], array('width'=>100));	
        }
        ?>

<div class="categorias form">
<?php echo $this->Form->create('Categoria', array('type' => 'file'));?>
	<fieldset>
 		<legend><?php __('Editar Categoria');?></legend>
                
                
	<?php
            if (!empty($this->request->data['Categoria']['id'])){
		echo $this->Form->input('id');
            }
		echo $this->Form->input('parent_id',array('type'=>'select', 'options'=> $categorias, 'default'=>1,'label'=>'Categoria Padre'));
		echo $this->Form->input('name',array('label'=>'Nombre'));
                echo $this->Form->input('image_url',array('type'=>'hidden'));
                
                $catim = empty($this->request->data['Categoria']['image_url'])? '' : '('.$this->request->data['Categoria']['image_url'].')';
                echo $this->Form->input('newfile',array('label'=>'Foto/Imagen '.$catim, 'type'=>'file'));
		echo $this->Form->input('description',array('label'=>'Descripción'));
	?>
<?php echo $this->Form->end('Submit');?>
</fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Borrar', true), array('action'=>'delete', $this->Form->value('Categoria.id')), null, sprintf(__('¿Esta seguro que desea borrar la categoria: %s?', true), $this->Form->value('Categoria.name'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Categorias', true), array('action'=>'index'));?></li>
		<li><?php // echo $this->Html->link(__('Listar Items', true), array('controller'=> 'items', 'action'=>'index')); ?> </li>
		<li><?php // echo $this->Html->link(__('Crear Item', true), array('controller'=> 'items', 'action'=>'add')); ?> </li>
	</ul>
</div>

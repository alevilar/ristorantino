<?php    


if ( !empty($this->request->data['TipoDePago']['image_url']) ) {
	echo $this->Html->image($this->request->data['TipoDePago']['image_url'], array('width'=>100));
}

    
?>


<div class="tipoDePagos form">
    
<?php echo $this->Form->create('TipoDePago', array('type' => 'file', 'action'=>'edit'));?>
	<fieldset>
 		<legend><?php __('Edit TipoDePago');?></legend>
	<?php
                if (!empty($this->request->data['TipoDePago']['id'])){
                    echo $this->Form->input('id');
                }
                
                $catim = empty($this->request->data['TipoDePago']['image_url'])? '' : '('.$this->request->data['TipoDePago']['image_url'].')';
                
		echo $this->Form->input('name');
                echo $this->Form->input('image_url',array('type'=>'hidden'));
                echo $this->Form->input('newfile',array('label'=>'Foto/Imagen '.$catim, 'type'=>'file'));
		echo $this->Form->input('description');
	?>
<?php echo $this->Form->end('Submit');?>
        </fieldset>

</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Borrar', true), array('action'=>'delete', $this->Form->value('TipoDePago.id')), null, sprintf(__('¿Está seguro que desea borrar el tipo de pago: %s?', true), $this->Form->value('TipoDePago.name'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Tipo de Pagos', true), array('action'=>'index'));?></li>
		<li><?php echo $this->Html->link(__('Listar Pagos', true), array('controller'=> 'pagos', 'action'=>'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Crear Pago', true), array('controller'=> 'pagos', 'action'=>'add')); ?> </li>
	</ul>
</div>

    <?php    
    echo $this->element('menuadmin');
    
     echo $html->image($this->data['TipoDePago']['image_url'], array('width'=>100));
    ?>


<div class="tipoDePagos form">
    
<?php echo $form->create('TipoDePago', array('type' => 'file', 'action'=>'edit'));?>
	<fieldset>
 		<legend><?php __('Edit TipoDePago');?></legend>
	<?php
                if (!empty($this->data['TipoDePago']['id'])){
                    echo $form->input('id');
                }
                
                $catim = empty($this->data['TipoDePago']['image_url'])? '' : '('.$this->data['TipoDePago']['image_url'].')';
                
		echo $form->input('name');
                echo $form->input('image_url',array('type'=>'hidden'));
                echo $form->input('newfile',array('label'=>'Foto/Imagen '.$catim, 'type'=>'file'));
		echo $form->input('description');
	?>
<?php echo $form->end('Submit');?>
        </fieldset>

</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Borrar', true), array('action'=>'delete', $form->value('TipoDePago.id')), null, sprintf(__('¿Está seguro que desea borrar el tipo de pago: %s?', true), $form->value('TipoDePago.name'))); ?></li>
		<li><?php echo $html->link(__('Listar Tipo de Pagos', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('Listar Pagos', true), array('controller'=> 'pagos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('Crear Pago', true), array('controller'=> 'pagos', 'action'=>'add')); ?> </li>
	</ul>
</div>

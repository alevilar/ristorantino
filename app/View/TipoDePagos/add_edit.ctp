
<div class="tipoDePagos form">
<?php echo $this->Form->create('TipoDePago', array('type' => 'file'));?>
	<fieldset>
		<legend><?php echo __('Tipo De Pago'); ?></legend>
	<?php
                echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
                echo $this->Form->hidden('image_url');                
                if (!empty($this->request->data['TipoDePago']['image_url'])) {
                    echo "Imagen actual: ".$this->FileUpload->image($this->request->data['TipoDePago']['image_url']);
                }
                echo $this->Form->input('file', array('type' => 'file'));     
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Tipo De Pagos'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Pagos'), array('controller' => 'pagos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pago'), array('controller' => 'pagos', 'action' => 'add')); ?> </li>
	</ul>
</div>

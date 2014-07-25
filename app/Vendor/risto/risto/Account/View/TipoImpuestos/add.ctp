<div class="tipoImpuestos form">
<?php echo $this->Form->create('TipoImpuesto');?>
	<fieldset>
 		<legend><?php __('Nuevo Tipo de Impuesto');?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('porcentaje');
                echo $this->Form->input('tiene_neto', array('options' => array('No', 'Si'))); 
                echo $this->Form->input('tiene_impuesto', array('options' => array('No', 'Si'))); 
	?>
<?php echo $this->Form->end('Submit');?>
    </fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Listar TipoImpuestos', true), array('action' => 'index'));?></li>
	</ul>
</div>

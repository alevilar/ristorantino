<?php  
echo $this->element('menuadmin');
?>
<?php 
    echo $this->Html->script('jquery/jquery-ui-1.8.14.custom.min');
    echo $this->Html->css('jquery-ui/jquery-ui-1.8.14.custom');
?>
<div class="vales form">
<?php echo $this->Form->create('Vale');?>
	<fieldset>
	<?php
                echo $this->Form->input('user_id', array('empty'=>'- Seleccione -', 'label'=>'Usuario al cual se le adjudica el vale'));
                echo $this->Form->input('persona', array('label'=>'Persona al cual se le adjudica el vale', 'after'=>'en caso de no ser usuario'));
                echo $this->Form->input('fecha', array('id' => 'fecha', 'type'=>'text'));
                echo $this->Form->input('monto');
	?>
<?php echo $this->Form->end('Guardar');?>
        </fieldset>

</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Volver al listado', true), array('action'=>'index'));?></li>
	</ul>
</div>

<?php  
echo $this->element('menuadmin');
?>
<?php 
    echo $javascript->link('jquery/jquery-ui-1.8.14.custom.min');
    echo $html->css('jquery-ui/jquery-ui-1.8.14.custom');
?>
<script type="text/javascript">
    jQuery(function() {
        jQuery( "#fecha" ).datepicker({ dateFormat: 'dd/mm/yy' });
    });
</script>
<div class="vales form">
<?php echo $form->create('Vale');?>
	<fieldset>
	<?php
		echo $form->input('id');
                echo $form->input('user_id', array('empty'=>'- Seleccione -', 'label'=>'Usuario al cual se le adjudica el vale'));
                echo $form->input('persona', array('label'=>'Persona al cual se le adjudica el vale', 'after'=>'en caso de no ser usuario'));
                echo $form->input('fecha', array('id' => 'fecha', 'type'=>'text'));
                echo $form->input('monto');
	?>
<?php echo $form->end('Guardar');?>
        </fieldset>

</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Volver al listado', true), array('action'=>'index'));?></li>
	</ul>
</div>

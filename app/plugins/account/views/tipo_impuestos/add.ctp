     <?php  
        echo $this->element('menuadmin');
     ?>
<div class="tipoImpuestos form">
<?php echo $form->create('TipoImpuesto');?>
	<fieldset>
 		<legend><?php __('Nuevo Tipo de Impuesto');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('porcentaje');
                echo $form->input('tiene_neto', array('options' => array('No', 'Si'))); 
                echo $form->input('tiene_impuesto', array('options' => array('No', 'Si'))); 
	?>
<?php echo $form->end('Submit');?>
    </fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listar TipoImpuestos', true), array('action' => 'index'));?></li>
	</ul>
</div>

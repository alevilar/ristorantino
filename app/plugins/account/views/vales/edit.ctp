<div class="vales form">
<?php echo $form->create('Vale');?>
	<fieldset>
	<?php
		echo $form->input('id');
                echo $form->input('persona');
                echo $form->input('monto');
	?>
	</fieldset>
<?php echo $form->end('Guardar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Volver al listado', true), array('action'=>'index'));?></li>
	</ul>
</div>

     <?php  
        echo $this->element('menuadmin');
     ?>

<div class="vales form">
<?php echo $form->create('Vale');?>
	<fieldset>
	<?php
		echo $form->input('persona');
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

<div class="pagos form">
<?php echo $form->create('Pago');?>
	<fieldset>
 		<legend>Editando Pago</legend>
                
                <p>
                <h4>Mesa N° <?php echo $mesa['Mesa']['numero']?>, Mozo <?php echo $mesa['Mozo']['numero']?></h4>
                    Hora de apertura: <?php echo strftime('%a %e de %B %H:%M', strtotime($mesa['Mesa']['created']))?><br>
                    Hora de cierre: <?php echo strftime('%a %e de %B %H:%M', strtotime($mesa['Mesa']['time_cerro']))?><br>
                    Hora de cobro: <?php echo strftime('%a %e de %B %H:%M', strtotime($mesa['Mesa']['time_cobro']))?>
                </p>
	<?php
		echo $form->input('id');
		echo $form->hidden('mesa_id');
		echo $form->input('tipo_de_pago_id');
		echo $form->input('valor', array('disabled'=>true));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Pago.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Pago.id'))); ?></li>
		<li><?php echo $html->link(__('List Pagos', true), array('action'=>'index'));?></li>
	</ul>
</div>

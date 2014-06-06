<div class="pagos form">
<?php echo $this->Form->create('Pago');?>
	<fieldset>
 		<legend>Editando Pago</legend>
                
                <p>
                <h4>Mesa N° <?php echo $mesa['Mesa']['numero']?>, Mozo <?php echo $mesa['Mozo']['numero']?></h4>
                    Hora de apertura: <?php echo strftime('%a %e de %B %H:%M', strtotime($mesa['Mesa']['created']))?><br>
                    Hora de cierre: <?php echo strftime('%a %e de %B %H:%M', strtotime($mesa['Mesa']['time_cerro']))?><br>
                    Hora de cobro: <?php echo strftime('%a %e de %B %H:%M', strtotime($mesa['Mesa']['time_cobro']))?>
                </p>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->hidden('mesa_id');
		echo $this->Form->input('tipo_de_pago_id');
		echo $this->Form->input('valor', array('disabled'=>true));
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action'=>'delete', $this->Form->value('Pago.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Pago.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Pagos', true), array('action'=>'index'));?></li>
	</ul>
</div>

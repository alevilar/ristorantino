
<h1>Crear nuevo Pago para la mesa id #<?php echo $mesaId ?></h1>
<?php echo $this->Form->create('Pago'); ?>

<?php echo $this->Form->input('tipo_de_pago_id', array('options' => $tipo_de_pagos)); ?>
<?php echo $this->Form->input('valor'); ?>


<?php echo $this->Form->hidden('mesa_id'); ?>
<?php echo $this->Form->hidden('redirect'); ?>

<?php echo $this->Form->end('Guardar'); ?>
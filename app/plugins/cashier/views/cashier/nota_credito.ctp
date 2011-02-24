<br><br><br><br>

	<div class="listado-mesas">

<?php

echo $form->create('Cajero', array('url'=>'nota_credito'));

echo $form->input('tipo', array('options'=> array('B'=>'"B"', 'A' => '"A"')));

echo $form->input('numero_ticket');

echo $form->input('importe');

echo $form->end('Enviar');

?>


	</div>


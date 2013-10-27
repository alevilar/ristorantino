<?php
echo $html->link('Listar Arqueos', array('action'=>'index'));
?>
<br><br>
<?php
echo $html->link('Crear Nuevo Arqueo de Caja VENTAS', array('action'=>'add', 1));
?>
<br><br>
<?php

echo $html->link('Crear Nuevo Arqueo de otras cajas', array('action'=>'add'));

?>
<br><br>

<?php

echo $html->link('Listar, Crear, Modificar Cajas', array('controller'=>'cajas','action'=>'index'));
?>

<br><br>

<?php

echo $html->link('Listar informes Z', array('controller'=>'zetas','action'=>'index'));

<h3>Total adeudado que suman los gastos seleccionados: $<?php echo $suma_gastos?></h3>
    <?php    
echo $form->create('Egreso', array('action'=>'save'));

echo $jqm->input('tipo_de_pago_id', array('options'=>$tipo_de_pagos));
echo $jqm->input('observacion');
echo $jqm->date('fecha', array('default'=>date('Y-m-d', strtotime('now'))));
echo $jqm->input('total', array('default'=>$suma_gastos));



// listado de gastos seleccionados ocultos

echo "<div style='display:none'>";
foreach ($gastos as $gId => $g){
    echo $form->checkbox('Gasto.Gasto.'.$gId, array('checked'=>true,'value'=>$gId));
}
echo "</div>";


echo $form->end('guardar');

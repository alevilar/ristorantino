<h3>Total adeudado que suman los gastos seleccionados: $<?php echo $suma_gastos?></h3>
    <?php    
echo $form->create('Egreso', array('action'=>'save',  'data-ajax' => "false"));

echo $form->input('tipo_de_pago_id', array('options'=>$tipo_de_pagos));
echo $form->input('observacion');
$date = date('Y-m-d', strtotime('now'));
echo $form->input('fecha', array('default' => $date, 'type'=>'date' ));
echo $form->input('total', array('default'=>$suma_gastos));
echo $form->input('file', array('type'=>'file', 'accept'=> "image/*"));



// listado de gastos seleccionados ocultos

echo "<div style='display:none'>";
foreach ($gastos as $gId => $g){
    echo $form->checkbox('Gasto.Gasto.'.$gId, array('checked'=>true,'value'=>$gId));
}
echo "</div>";


echo $form->end('guardar');

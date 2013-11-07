<?php
if ( !empty($this->data['Egreso']['id'])) {
    $txt = 'Editar';
} else {
    $txt = 'Crear Nuevo';
}
?>
<h1><?php echo $txt; ?> Pago
    <?php if (!empty($cant_gastos)) {
        if ( $cant_gastos > 1) { 
    ?>
        <small>Total adeudado que suman los <?php echo $cant_gastos ?> gastos seleccionados: <?php echo $number->currency($this->data['Egreso']['total']) ?></small>
    <?php } else { ?>
        <small>Total adeudado que suma el gasto seleccionado: <?php echo $number->currency($this->data['Egreso']['total']) ?></small>
        <?php }  
    }
    ?>
</h1>

<div class="row">
    <div class="col-md-6">
<?php
echo $form->create('Egreso', array('action' => 'save', 'data-ajax' => "false", 'type' => 'file'));

echo $form->input('id');


echo $form->input('fecha', array('type' => 'datetime'));


echo $form->input('tipo_de_pago_id');
echo $form->input('total', array('type' => 'number'));

?>
</div>

<div class="col-md-6">
    
    <?php

if (!empty($this->data['Egreso']['file'])) {
    $ext = substr(strrchr($this->data['Egreso']['file'], '.'), 1);
    if (in_array(low($ext), array('jpg', 'png', 'gif', 'jpeg'))) {
        $iii = $html->image($this->data['Egreso']['file'], array('width' => 150, 'alt' => 'Bajar', 'escape' => false));
    } else {
        $iii = "Descargar $ext";
    }
    if (!empty($this->data['Egreso']['file'])) {
        echo $html->link($iii, "/" . IMAGES_URL . $this->data['Egreso']['file'], array('target' => '_blank', 'escape' => false));
    }
}
echo $form->input('_file', array('type' => 'file', 'accept' => "image/*", 'label' => 'PDF, Imagen, Archivo'));


echo $form->input('observacion');
?>
</div>
    
    <?php
// listado de gastos seleccionados ocultos

echo "<div style='display:none'>";
foreach ($gastos as $gId => $g) {
    echo $form->checkbox('Gasto.Gasto.' . $gId, array('checked' => true, 'value' => $gId));
}
echo "</div>";

echo $form->button('guardar', array('type'=>'submit', 'class'=>'btn btn-lg btn-success'));
echo $form->end(null);

<?php
if ( !empty($this->request->data['Egreso']['id'])) {
    $txt = 'Editar';
} else {
    $txt = 'Crear Nuevo';
}
?>
<h1><?php echo $txt; ?> Pago
    <?php if (!empty($cant_gastos)) {
        if ( $cant_gastos > 1) { 
    ?>
        <small>Total adeudado que suman los <?php echo $cant_gastos ?> gastos seleccionados: <?php echo $this->Number->currency($this->request->data['Egreso']['total']) ?></small>
    <?php } else { ?>
        <small>Total adeudado que suma el gasto seleccionado: <?php echo $this->Number->currency($this->request->data['Egreso']['total']) ?></small>
        <?php }  
    }
    ?>
</h1>

<div class="row">
    <div class="col-md-6">
<?php
echo $this->Form->create('Egreso', array('action' => 'save', 'data-ajax' => "false", 'type' => 'file'));

echo $this->Form->input('id');


echo $this->Form->input('fecha', array('type' => 'datetime'));


echo $this->Form->input('tipo_de_pago_id');
echo $this->Form->input('total', array('type' => 'number'));

?>
</div>

<div class="col-md-6">
    
    <?php

if (!empty($this->request->data['Egreso']['file'])) {
    $ext = substr(strrchr($this->request->data['Egreso']['file'], '.'), 1);
    if (in_array(strtolower($ext), array('jpg', 'png', 'gif', 'jpeg'))) {
        $iii = $this->Html->image($this->request->data['Egreso']['file'], array('width' => 150, 'alt' => 'Bajar', 'escape' => false));
    } else {
        $iii = "Descargar $ext";
    }
    if (!empty($this->request->data['Egreso']['file'])) {
        echo $this->Html->link($iii, "/" . IMAGES_URL . $this->request->data['Egreso']['file'], array('target' => '_blank', 'escape' => false));
    }
}
echo $this->Form->input('_file', array('type' => 'file', 'accept' => "image/*", 'label' => 'PDF, Imagen, Archivo'));


echo $this->Form->input('observacion');
?>
</div>
    
    <?php
// listado de gastos seleccionados ocultos

echo "<div style='display:none'>";
foreach ($gastos as $gId => $g) {
    echo $this->Form->checkbox('Gasto.Gasto.' . $gId, array('checked' => true, 'value' => $gId));
}
echo "</div>";

echo $this->Form->button('guardar', array('type'=>'submit', 'class'=>'btn btn-lg btn-success'));
echo $this->Form->end(null);

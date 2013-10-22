<?php 
$class = (abs($gasto['Gasto']['importe_pagado']) < abs($gasto['Gasto']['importe_total']))?'deuda':'pagado';
?>
<div class="imagen-pagado <?php echo $class ?>">
<?php echo ($class=='pagado')?$html->image('pagado.png'):"" ?>
</div>

<h1>Gasto #<?php echo $gasto['Gasto']['id']?></h1>

<h3><?php echo $gasto['TipoFactura']['name']; ?></h3>

<p>Importe Neto: <?php echo $number->currency($gasto['Gasto']['importe_neto']) ?><br>
<?php foreach ($gasto['Impuesto'] as $imp) { ?>
    <?php echo $imp['TipoImpuesto']['name'] ?>: 
    <?php echo $number->currency($imp['importe']) ?><br>
    
<?php } ?>
</p>

<p>Importe Total: <?php echo $number->currency($gasto['Gasto']['importe_total']) ?></p>
<p>Importe Pagado: <?php echo $number->currency($gasto['Gasto']['importe_pagado']) ?></p>

<?php
if (!empty($gasto['Gasto']['file'])) {
    $ext = substr(strrchr($gasto['Gasto']['file'],'.'),1);
    if ( in_array(low($ext), array('jpg', 'png', 'gif', 'jpeg')) ) {
        $iii = $html->image($gasto['Gasto']['file'], array('width'=>348, 'alt' => 'Bajar', 'escape' => false));
    } else {
        $iii = "ARCHIVO: ".$gasto['Gasto']['file'];
    }
    echo $html->link($iii, "/" .IMAGES_URL .$gasto['Gasto']['file'], array('target'=>'_blank', 'escape' => false));
}
?>

<p>
    <?php if (!empty($gasto['Proveedor']['name'])){ ?>
    Proveedor: <?php echo $gasto['Proveedor']['name']; ?><br>
    <?php } ?>
    Clasificación: <?php echo $gasto['Clasificacion']['name']; ?><br>
</p>

<?php
if ( $gasto['Gasto']['importe_total'] - $gasto['Gasto']['importe_pagado'] ) {
    echo $html->link(__('Pagar', true), array(
        'controller' => 'egresos',
        'action' => 'add', $gasto['Gasto']['id']), array(
        'data-ajax' => 'false',
    ));

    echo " | ";
}
?>
<?php echo $html->link('Editar', array('action'=>'edit', $gasto['Gasto']['id']))?>
 | 
<?php echo $html->link('Borrar', array('action' => 'delete', $gasto['Gasto']['id']), array('class' => 'ajaxlink'), sprintf(__('Seguro queres borrar el # %s?', true), $gasto['Gasto']['id'])); ?>

<?php if (!empty($gasto['Egreso'])) { ?>
<h3>Pagos realizados sobre este Gasto</h3>
<ul>
<?php foreach ($gasto['Egreso'] as $pags){ ?>    
    <li>
        <span class="tipo_de_pago"><?php echo $html->image($pags['TipoDePago']['image_url'], array('alt'=>$pags['TipoDePago']['name'], 'title'=>$pags['TipoDePago']['name'])); ?></span>
        Fecha: <?php echo date('d-m-y', strtotime($pags['fecha']))?>
        Importe: <?php echo $number->currency($pags['AccountEgresosGasto']['importe'])?>
        <?php echo $html->link('ir al pago', array('controller'=>'egresos', 'action'=>'view', $pags['id'])) ?>
    </li>
<?php } ?>
</ul>
<?php } else {?>
    <p class="alert">No hay ningún Pago realizado para este gasto</p>
<?php } ?>
    
    
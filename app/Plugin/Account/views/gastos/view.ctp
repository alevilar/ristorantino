<?php if ( !empty($gasto['Gasto']['cierre_id']) ) { ?>
    <p class="alert alert-warning">Este Gasto se encuentra cerrado.  
        <?php echo $this->Html->link($gasto['Cierre']['name'], array(
    'controller' => 'cierres',
    'action' => 'view',
    $gasto['Gasto']['cierre_id']
    ))?></p>
<?php } ?>



<?php 
echo $this->Html->css('/account/css/style');
$class = (abs($gasto['Gasto']['importe_pagado']) < abs($gasto['Gasto']['importe_total']))?'deuda':'pagado';
?>




<div class="imagen-pagado <?php echo $class ?>">
<?php echo ($class=='pagado')?$this->Html->image('pagado.png'):"" ?>
</div>

<h1>Gasto #<?php echo $gasto['Gasto']['id']?></h1>

<h3><?php echo $gasto['TipoFactura']['name']; ?></h3>


<p></p>

<p>Importe Neto: <?php echo $this->Number-> currency($gasto['Gasto']['importe_neto']) ?><br>
<?php foreach ($gasto['Impuesto'] as $imp) { ?>
    <?php echo $imp['TipoImpuesto']['name'] ?>: 
    <?php echo $this->Number-> currency($imp['importe']) ?><br>
    
<?php } ?>
</p>

<p>Importe Total: <?php echo $this->Number-> currency($gasto['Gasto']['importe_total']) ?></p>
<p>Importe Pagado: <?php echo $this->Number-> currency($gasto['Gasto']['importe_pagado']) ?></p>

<?php
if (!empty($gasto['Gasto']['file'])) {
    $ext = substr(strrchr($gasto['Gasto']['file'],'.'),1);
    if ( in_array(low($ext), array('jpg', 'png', 'gif', 'jpeg')) ) {
        $iii = $this->Html->image($gasto['Gasto']['file'], array('width'=>348, 'alt' => 'Bajar', 'escape' => false));
    } else {
        $iii = "ARCHIVO: ".$gasto['Gasto']['file'];
    }
    echo $this->Html->link($iii, "/" .IMAGES_URL .$gasto['Gasto']['file'], array('target'=>'_blank', 'escape' => false));
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
    echo $this->Html->link(__('Pagar', true), array(
        'controller' => 'egresos',
        'action' => 'add', $gasto['Gasto']['id']), array(
        'data-ajax' => 'false',
    ));

    echo " | ";
}
?>
<?php echo $this->Html->link('Editar', array('action'=>'edit', $gasto['Gasto']['id']))?>
 | 
<?php echo $this->Html->link('Borrar', array('action' => 'delete', $gasto['Gasto']['id']), array('class' => 'ajaxlink'), sprintf(__('Seguro queres borrar el # %s?', true), $gasto['Gasto']['id'])); ?>

<?php if (!empty($gasto['Egreso'])) { ?>
<h3>Listado de Pagos</h3>
<ul>
<?php foreach ($gasto['Egreso'] as $pags){ ?>    
    <li>
        <span class="tipo_de_pago"><?php echo $this->Html->image($pags['TipoDePago']['image_url'], array('alt'=>$pags['TipoDePago']['name'], 'title'=>$pags['TipoDePago']['name'])); ?></span>
        Fecha: <?php echo date('d-m-y', strtotime($pags['fecha']))?>
        Importe: <?php echo $this->Number-> currency($pags['AccountEgresosGasto']['importe'])?>
        <?php echo $this->Html->link('ir al pago', array('controller'=>'egresos', 'action'=>'view', $pags['id'])) ?>
        <?php echo $this->Html->link('eliminar pago', array('controller'=>'egresos', 'action'=>'delete', $pags['AccountEgresosGasto']['egreso_id']), null, sprintf(__('¿Está seguro que desea borrar el pago %s', true), $pags['TipoDePago']['name'])) ?>
        
    </li>
<?php } ?>
</ul>
<?php } else {?>
    <p class="alert">No hay ningún Pago realizado para este gasto</p>
<?php } ?>
    
    
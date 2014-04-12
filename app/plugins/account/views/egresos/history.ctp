<h1>Listado de Pagos</h1>

<?php
echo $html->css('/account/css/style');
echo $this->element('form_mini_year_month_search');

$urlTex = '';
foreach ($this->params['url'] as $u => $v) {
    if ($u != 'ext' && $u != 'url' && $u != 'page') {
        if (!empty($v)) {
            $urlTex .= "$u=$v&";
        }
    }
}
$urlTex = trim($urlTex, '&');
$paginator->options(array('url' => array('?' => $urlTex)));

?>


<table class="table table-hover">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th>Importe</th>
            <th>Fecha</th>
            <th>Listado de Gastos Pagados</th>
            <th>Observacion</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
    </thead>


    <tbody>
        <?php
        
        foreach ($egresos as $g) {
            ?>

            <tr>
                <td>
                    <?php echo $html->image($g['TipoDePago']['image_url'], array('class' => 'thumb')); ?>
                </td>
                
                <td><?php echo $number->currency($g['Egreso']['total']); ?></td>

                <td><?php echo strftime('%d %b', strtotime($g['Egreso']['fecha'])); ?></td>

                
                
                <td>
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Proveedor</th>
                                <th>Factura</th>
                                <th>Fecha</th>
                                <th>Neto</th>
                                <th>Total</th>
                                <th>Pago</th>
                                <th>Obs.</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php
                            $proveedor = '';
                            $tipoFactura = '';
                            foreach ($g['Gasto'] as $gasto) {
                                if (!empty($gasto['Proveedor'])) {
                                    $proveedor = $gasto['Proveedor']['name'] . ', ';
                                }
                                if (!empty($gasto['TipoFactura'])) {
                                    $tipoFactura = $gasto['TipoFactura']['name'];
                                }
                                
                                ?>
                                <tr>
                                    <td><?php echo $proveedor ?></td>
                                    <td><?php echo $tipoFactura ?> <?php echo $gasto['factura_nro'] ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($gasto['fecha'])) ?></td>
                                    <td><?php echo $gasto['importe_neto'] ?></td>
                                    <td><?php echo $gasto['importe_total'] ?></td>
                                    <td class="text text-warning"><?php echo $number->currency($gasto['AccountEgresosGasto']['importe']) ?></td>
                                    <td><?php echo $gasto['observacion'] ?></td>
                                </tr>
                                <?
                            }
                            $proveedor = trim($proveedor, ', ');
                            $tipoFactura = trim($tipoFactura, ', ');
                            ?>
                        </tbody>
                    </table>

                <td><?php echo $g['Egreso']['observacion']; ?></td>

                <td>
                    <?php
                    $ext = substr(strrchr($g['Egreso']['file'], '.'), 1);
                    if (in_array(low($ext), array('jpg', 'png', 'gif', 'jpeg'))) {
                        $iii = $html->image(THUMB_FOLDER . $g['Egreso']['file'], array('width' => 48, 'alt' => 'Bajar', 'escape' => false));
                    } else {
                        $iii = "Descargar $ext";
                    }
                    if (!empty($g['Egreso']['file'])) {
                        echo $html->link($iii, "/" . IMAGES_URL . $g['Egreso']['file'], array('target' => '_blank', 'escape' => false));
                    }
                    ?>
                </td>

                <td>
                    <?php
                    echo $html->link('Ver', array('action' => 'view', $g['Egreso']['id']));
                    echo "<br>";
                    echo $html->link('Editar', array('action' => 'edit', $g['Egreso']['id']));
                    echo "<br>";
                    echo $html->link('Eliminar', array('action'=>'delete', $g['Egreso']['id']), null, sprintf(__('¿Está seguro que desea borrar el pago de %s', true), $number->currency($g['Egreso']['total'])));
                    ?>
                </td>

            </tr>
            <?php
        }
        ?>
    </tbody>
</table>

<?php
echo $paginator->counter(array(
    'format' => __('Página %page% de %pages%, mostrando %current% elementos de %count%', true)
));
?>

<div class="paging">
    <?php echo $paginator->prev('<< ' . __('anterior', true), array(), null, array('class' => 'disabled')); ?>
    | 	<?php echo $paginator->numbers(); ?>
    <?php echo $paginator->next(__('próximo', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
</div>

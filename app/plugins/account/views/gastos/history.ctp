<?php

function mostrarNetoDe($tipoImpuestoId, $vec)
{
    foreach ($vec as $v) {
        if ($v['tipo_impuesto_id'] == $tipoImpuestoId) {
            return $v['neto'];
        }
    }
    return 0;
}

function mostrarImpuestoDe($tipoImpuestoId, $vec)
{
    foreach ($vec as $v) {
        if ($v['tipo_impuesto_id'] == $tipoImpuestoId) {
            return $v['importe'];
        }
    }
    return 0;
}

echo $this->element('form_mini_year_month_search');

//debug($gastos);
?>

<h3>Detalle de Gastos</h3>

<div id="tabla-de-gastos">
    <table class="main">
        <thead>
            <tr>
                <th colspan="2">Clasificación</th>
                <th>Fecha Alta</th>
                <th>Fecha Factura</th>
                <th>Proveedor</th>
                <th>CUIT</th>
                <th>Tipo Factura</th>
                <th>N° Factura</th>
                <th>Importe Neto</th>
                <?php
                foreach ($tipo_impuestos as $ti) {
                    echo "<th>
                                    <table style='width: 100%;'>
                                        <tr>$ti</tr>
                                        <tr>
                                            <td>Neto</td>
                                            <td>Imp.</td>
                                        </tr>
                                    </table>
                                  </th>";
                }
                ?>
                <th>Total</th>
                <th>Falta pagar</th>
                <th>Observación</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($gastos as $g) {
                $classpagado = 'pagado';
                if ($g['Gasto']['importe_pagado'] < $g['Gasto']['importe_total']) {
                    $classpagado = 'no-pagado';
                }

                $class = $g['Gasto']['closed'] ? 'closed' : 'open';
                ?>
                <tr class="<?php echo $classpagado . " " . $class; ?>">
                    <?php
                    echo "<td class='$class'></td>";

                    if (!empty($g['Clasificacion'])) {
                        echo "<td>" . $g['Clasificacion']['name'] . "</td>";
                    } else {
                        echo "<td>Sin Clasificar</td>";
                    }
                    echo "<td class='fecha'>" . date('d-m-y', strtotime($g['Gasto']['created'])) . "</td>";
                    echo "<td class='fecha'>" . date('d-m-y', strtotime($g['Gasto']['fecha'])) . "</td>";
                    if (!empty($g['Clasificacion'])) {
                        echo "<td>" . $g['Proveedor']['name'] . "</td>";
                    }
                    if (!empty($g['Proveedor'])) {
                        echo "<td>" . $g['Proveedor']['cuit'] . "</td>";
                    }
                    if (!empty($g['TipoFactura'])) {
                        echo "<td>" . $g['TipoFactura']['name'] . "</td>";
                    }
                    echo "<td>" . $g['Gasto']['factura_nro'] . "</td>";
                    echo "<td>" . $number->currency($g['Gasto']['importe_neto']) . "</td>";
                    ?>

                    <?php
                    foreach ($tipo_impuestos as $tid => $ti) {
                        ?>
                        <td>
                            <table style="width: 100%;">
                                <tr>
                                    <?php
                                    if (!empty($g['Impuesto'])) {
                                        echo "<td>" . $number->currency(mostrarNetoDe($tid, $g['Impuesto'])) . "</td>";
                                    }
                                    ?>

                                    <?php
                                    if (!empty($g['Impuesto'])) {
                                        echo "<td>" . $number->currency(mostrarImpuestoDe($tid, $g['Impuesto'])) . "</td>";
                                    }
                                    ?>
                                </tr>    
                            </table>
                        </td>
                        <?php
                    }
                    echo "<td>" . $number->currency($g['Gasto']['importe_total']) . "</td>";
                    echo "<td>" . $number->currency($g['Gasto']['importe_total'] - $g['Gasto']['importe_pagado']) . "</td>";
                    echo "<td>" . $g['Gasto']['observacion'] . "</td>";
                    echo "<td>" . $html->link('Ver', array('action'=>'view',$g['Gasto']['id'])) . "<br>" .$html->link('Editar', array('action'=>'edit',$g['Gasto']['id']), array('data-ajax'=>'false')). "</td>";
                }
                ?>

            </tr>

        </tbody>
    </table>

</div>
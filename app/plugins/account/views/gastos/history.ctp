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

?>

<h3>Detalle de Gastos</h3>


<div id="tabla-de-gastos">   
    <table data-role="table" data-mode="columntoggle">
        <thead>
            <tr>
                <th colspan="2" rowspan="2">Clasificación</th>
                <th rowspan="2" data-priority="4">Fecha Alta</th>
                <th rowspan="2">Fecha Factura</th>
                <th colspan="2" data-priority="3">Proveedor</th>
                
                <th rowspan="2">Tipo Factura</th>
                <th rowspan="2" data-priority="2">N° Factura</th>
                <th rowspan="2" data-priority="1">Importe Neto</th>
                <?php
                foreach ($tipo_impuestos as $ti) {
                    echo "<th colspan='2'  data-priority='5'>$ti</th>";
                }
                ?>
                <th class="total" rowspan="2">Total</th>
                <th class="faltapagar" rowspan="2" data-priority="2">Falta pagar</th>
                <th class="obs" rowspan="2" data-priority="3">Observación</th>
                <th class="acciones" rowspan="2">Acciones</th>
            </tr>
            <tr>
                <td>Nombre</td>
                <td>CUIT</td>
                <?php
                foreach ($tipo_impuestos as $ti) {
                    echo "<td>Neto</td><td>Imp.</td>";
                }
                ?>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($gastos as $g) {
                $classpagado = 'pagado';
                $faltaPagar = $g['Gasto']['importe_total'] - $g['Gasto']['importe_pagado'];
                if ( $g['Gasto']['importe_pagado'] < $g['Gasto']['importe_total']) {
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
                    
                    echo "<td class='fecha'>" . date('j M', strtotime($g['Gasto']['created'])) . "</td>";
                    echo "<td class='fecha'>" . date('j M', strtotime($g['Gasto']['fecha'])) . "</td>";
                    
                    
                    if (!empty($g['Proveedor'])) {
                        echo "<td>". $g['Proveedor']['name'] ."</td>";
                        echo "<td>". $g['Proveedor']['cuit'] ."</td>";
                    } else {
                        echo "<td>&nbsp;</td>";
                        echo "<td>&nbsp;</td>";
                    }
                    
                    if (!empty($g['TipoFactura'])) {
                        echo "<td>" . $g['TipoFactura']['name'] . "</td>";
                    } else {
                        echo "<td>&nbsp;</td>";
                    }
                    
                    echo "<td>" . $g['Gasto']['factura_nro'] . "</td>";
                    echo "<td>" . $g['Gasto']['importe_neto'] . "</td>";
                    ?>

                    <?php
                    foreach ($tipo_impuestos as $tid => $ti) {
                        if (!empty($g['Impuesto'])) {
                            echo "<td>" . mostrarNetoDe($tid, $g['Impuesto']) . "</td>";
                        } else {
                            echo "<td>&nbsp;</td>";
                        }
                        if (!empty($g['Impuesto'])) {
                            echo "<td>" . mostrarImpuestoDe($tid, $g['Impuesto']) . "</td>";
                        } else {
                            echo "<td>&nbsp;</td>";
                        }
                    }
                    
                    echo "<td class='total'>" . $g['Gasto']['importe_total'] . "</td>";
                    
                    echo "<td class='faltapagar'>$faltaPagar" .  "&nbsp;</td>";
                    echo "<td class='obs'>" . $g['Gasto']['observacion'] . "&nbsp;</td>";
                    echo "<td class='acciones'>" . $html->link('Ver', array('action'=>'view',$g['Gasto']['id'])) . "<br>" .$html->link('Editar', array('action'=>'edit',$g['Gasto']['id']), array('data-ajax'=>'false')). "</td>";
                }
                ?>
            </tr>

        </tbody>
    </table>

</div>
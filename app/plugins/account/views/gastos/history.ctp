<?php

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
<div data-role="collapsible-set">


     <?php
    echo $form->end();
    ?>

    <div data-role="collapsible" data-collapsed="false" data-theme="e" id="listado-gastos-clasif" data-content-theme="e"  >
        <h3>Resumen por Clasificación del Gasto</h3>
            <?php            
            
            function mostralo($vec){
                echo '<div>';
                echo '<ul style="display: none">';
	
                foreach ($vec as $rr){
//                    debug($rr);
                    if ($rr['Gasto']['total']) {
                        echo '<li>';
                        if (!empty($rr['Children'])){
                            echo '<a href="#" onclick="jQuery(this).parent().find(\'ul:first\').toggle(); return false;">+</a>';
                        }
                        echo " [".$rr['Gasto']['cantidad']." gastos] ";
                        echo $rr['Clasificacion']['name'];
                        echo " ::> Total: $".$rr['Gasto']['total'];
                        echo " ::> Pagado: $".$rr['Gasto']['importe_pagado'];
                        if (!empty($rr['Children'])) {
                            mostralo($rr['Children']);
                        }
                        echo "</li>";
                    }
                }
                echo "</ul>";
                echo "</div>";
            }            
            mostralo($resumen_x_clasificacion['Children']);
            ?>
        
        
    </div>
    
    <script type="text/javascript">
            jQuery('#listado-gastos-clasif').find('ul:first').show()
    </script>

    <div data-role="collapsible" data-theme="e">
        <h3>Detalle de facturas</h3>

        <div>
            <table>
                <thead>
                    <tr>
                        <th>Clasificación</th>
                        <th>Fecha</th>
                        <th>Proveedor</th>
                        <th>CUIT</th>
                        <th>Tipo Factura</th>
                        <th>N° Factura</th>
                        <th>Importe Neto</th>
                        <?php
                        foreach ($tipo_impuestos as $ti) {
                            echo "<th>$ti</th>";
                        }
                        ?>
                        <th>Total</th>
                        <th>Falta pagar</th>
                        <th>Observación</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($gastos as $g) {                        
                        $classpagado = 'pagado';
                        if ($g['Gasto']['importe_pagado'] < $g['Gasto']['importe_total']) {
                            $classpagado = 'no-pagado';
                        }
                        ?>
                        <tr class="<?php echo $classpagado; ?>">
                            <?php
                            if (!empty($g['Clasificacion'])) {
                                echo "<td>" . $g['Clasificacion']['name'] . "</td>";
                            }
                            echo "<td>" . date('d-m-y', strtotime($g['Gasto']['fecha'])) . "</td>";
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
                                    <?php
                                    if (!empty($g['Impuesto'])) {
                                        echo $number->currency(mostrarImpuestoDe($tid, $g['Impuesto']));
                                    }
                                    ?>
                                </td>
                                <?php
                            }
                            echo "<td>" . $number->currency($g['Gasto']['importe_total']) . "</td>";
                            echo "<td>" . $number->currency($g['Gasto']['importe_total'] - $g['Gasto']['importe_pagado']) . "</td>";
                            echo "<td>" . $g['Gasto']['observacion'] . "</td>";
                        }
                        ?>

                    </tr>

                </tbody>
            </table>

        </div>
    </div>
</div>
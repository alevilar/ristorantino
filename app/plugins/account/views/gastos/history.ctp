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

//debug($gastos);
?>


 <?php
    echo $form->create('Gasto', array('action' => 'history', 'type' => 'get', 'name' => 'gasto_x_mes'));
    ?>

<div>
   <?php
    echo $jqm->month('mes', array('onchange' => 'this.form.submit()'));
    echo $form->input('anio', array(
        'label' => 'Año',
        'onchange' => 'this.form.submit()', 'default'=> date('Y', strtotime('now'))));
    ?>
</div>

<div data-role="collapsible-set">



    <div data-role="collapsible" data-theme="c" data-content-theme="c">
        <h3>Búsqueda Avanzada</h3>
        <div  data-theme="a"  class="ui-grid-b">
            
            <div class="ui-block-a">
                <?php
                echo $form->input('clasificacion_id', array('empty' => 'Seleccionar', 'onchange' => 'this.form.submit()'));
                ?>
            </div>
            <div class="ui-block-b">
                <?php
                echo $form->input('proveedor_id', array('empty' => 'Seleccionar', 'onchange' => 'this.form.submit()'));
                ?>
            </div>
            <div class="ui-block-c">
                <?php
                echo $html->link('Resetear formulario', array('action'=>'history'), array('data-role' => 'button', 'data-theme' => 'e'));
                ?>
            </div>
        </div>
    </div>
    
     <?php
    echo $form->end();
    ?>

    <div data-role="collapsible" data-theme="e" id="listado-gastos-clasif" data-content-theme="e"  >
        <h3>Resumen por Clasificación del Gasto</h3>
        
            <?php
            function mostralo($vec){
                echo '<div>';
                echo '<ul style="display: none">';
	
                foreach ($vec as $rr){
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
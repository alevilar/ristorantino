<?php
echo $this->element('form_mini_year_month_search', array('modelName' => 'Gasto'));

?>
<div id="listado-gastos-clasif"
     >
    <h3>Listado de Gastos por Clasificación</h3>
    <?php
    function mostralo($vec)
    {
        echo '<div>';
        echo '<ul style="display: none">';

        foreach ($vec as $rr) {
//                    debug($rr);
            if ($rr['Gasto']['total']) {
                echo '<li>';
                if (!empty($rr['Children'])) {
                    echo '<a href="#" onclick="jQuery(this).parent().find(\'ul:first\').toggle(); return false;">+</a>';
                }
                echo " [" . $rr['Gasto']['cantidad'] . " gastos] ";
                echo $rr['Clasificacion']['name'];
                echo " ::> Total: $" . $rr['Gasto']['total'];
                echo " ::> Pagado: $" . $rr['Gasto']['importe_pagado'];
                if (!empty($rr['Children'])) {
                    mostralo($rr['Children']);
                }
                echo "</li>";
            }
        }
        echo "</ul>";
        echo "</div>";
    }

    mostralo($resumen_x_clasificacion);
    ?>



<script type="text/javascript">
    jQuery('#listado-gastos-clasif').find('ul:first').show()
</script>
<?php
echo $this->element('form_mini_year_month_search', array('modelName' => 'Gasto'));
?>
<div id="listado-gastos-clasif">
    <h3>Listado de Gastos por Clasificación</h3>


        <div class="center-block col-md-6">
            <?php

            function mostralo($vec)
            {
                echo '<ul  class="list-group" style="display: none">';

                foreach ($vec as $rr) {
//                    debug($rr);
                    if ($rr['Gasto']['total']) {
                        echo '<li class="list-group-item">';
                        if (!empty($rr['Children'])) {
                            echo '<a href="#" onclick="jQuery(this).parent().find(\'ul:first\').toggle(); return false;"><span class="glyphicon glyphicon-eye-open"></span></a>  ';
                        }
                        echo '<span class="badge">' . $rr['Gasto']['cantidad'] . '</span>';
                        echo '<strong>' . $rr['Clasificacion']['name'] . '</strong>';
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total: $" . $rr['Gasto']['total'];
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pagado: $" . $rr['Gasto']['importe_pagado'];
                        if (!empty($rr['Children'])) {
                            mostralo($rr['Children']);
                        }
                        echo "</li>";
                    }
                }
                echo "</ul>";
            }

            mostralo($resumen_x_clasificacion);
            ?>

        </div>


    <script type="text/javascript">
        jQuery('#listado-gastos-clasif').find('ul:first').show()
    </script>
    
</div>
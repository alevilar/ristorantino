
<h1>Pago #<?php echo $egreso['Egreso']['id']?></h1>

<div class="pagos-list">
    <p><?php
echo "<span class='fecha'>(" . date('d-m-y', strtotime($egreso['Egreso']['fecha'])) . ")</span>";
echo "<span class='total'> " . $number->currency($egreso['Egreso']['total']) . "</span>";

echo "<span class='tipo_de_pago'> " . $html->image($egreso['TipoDePago']['image_url']) . "</span>";


if (!empty($egreso['Egreso']['observacion'])) {
    echo "<span class='observacion'> " . $egreso['Egreso']['observacion'] . "</span>";
}
?></p>

    <div>
        <ul data-role="listview">
            <li data-role="list-divider">Listado de Gastos involucrados en este egreso</li>
            <?php
            foreach ($egreso['Gasto'] as $ga){ ?>
                    <li>
                        
                        <?php 
                        echo $html->link(                                
                                "Pagado: ".$number->currency($ga['AccountEgresosGasto']['importe'])." Total: ".
                                $number->currency($ga['importe_total'])." (".date('d-m-Y',strtotime($ga['fecha'])).")"
                                , 
                                array(
                                    'controller'=>'gastos', 
                                    'action'=>'view', 
                                    $ga['id']
                                )
                                );
                        
                        if (!empty($ga['observacion'])) {
                        ?>
                        <p>
                            <?php 
                            echo $ga['observacion'];
                            ?>
                        </p>
                        <?php } ?>
                    </li>
                    <?php } ?>
        </ul>
    </div>

</div>
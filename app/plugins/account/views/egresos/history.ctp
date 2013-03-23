<div>
    <?php
    echo $form->create('Egreso', array('action' => 'history', 'type' => 'get', 'name' => 'gasto_x_mes'));
    echo $jqm->month('mes', array('onchange' => 'this.form.submit()'));
    echo $form->input('anio', array(
        'label' => 'Año',
        'onchange' => 'this.form.submit()', 'default'=> date('Y', strtotime('now'))));
    ?>
</div>


<ul class="pagos-list">
<?php
$sumatoria = 0;
foreach ($egresos as $g){
        $sumatoria += $g['Egreso']['total'];
}

?>
    
    
    <h3>Total de Pagos en el intervalo seleccionado: <?php echo $number->currency($sumatoria); ?></h3>
    
    <h4>Detalle de Pagos realizados</h4>
    <?
foreach ($egresos as $g){
    ?>
    <li>
        <div data-role="collapsible" data-theme="c" data-content-theme="c">
        <h3><?php
        echo "<span class='fecha'>(".date('d-m-y', strtotime($g['Egreso']['fecha'])).")</span>";
        echo "<span class='total'> ".$number->currency($g['Egreso']['total'])."</span>";
        
        echo "<span class='tipo_de_pago'> " . $html->image($g['TipoDePago']['image_url']) . "</span>";


        if (!empty($g['Egreso']['observacion'])) {
            echo "<span class='observacion'> ".$g['Egreso']['observacion']."</span>";
        }
    ?></h3>
            <p>
                <?php echo $html->link('ir a este egreso',array('action' => 'view', $g['Egreso']['id']))?>
            </p>
            <div>
                <ul data-role="listview">
                    <li data-role="list-divider">Listado de Gastos involucrados en este egreso</li>
                    <?php 
                    foreach ($g['Gasto'] as $ga){ ?>
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
                            ?>
                        </p>
                        <?php } ?>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            
        </div>
    </li>
            <?php
}

?>
</ul>

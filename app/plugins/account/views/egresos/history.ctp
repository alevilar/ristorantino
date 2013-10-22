<?php
echo $this->element('form_mini_year_month_search');
?>


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
        
        <h3>
            <?php echo $html->image($g['TipoDePago']['image_url'], array('class' => 'tipo_de_pago')); ?>
            <?php
        
        echo "<span class='fecha'>(".date('d-m-y', strtotime($g['Egreso']['fecha'])).")</span>";
        echo "<span class='total'> ".$number->currency($g['Egreso']['total'])."</span>";
        
        


        if (!empty($g['Egreso']['observacion'])) {
            echo "<span class='observacion'> ".$g['Egreso']['observacion']."</span>";
        }
    ?></h3>
            <p>
                <?php
                $ext = substr(strrchr($g['Egreso']['file'],'.'),1);
                if ( in_array(low($ext), array('jpg', 'png', 'gif', 'jpeg')) ) {
                    $iii = $html->image(THUMB_FOLDER.$g['Egreso']['file'], array('width' => 48, 'alt' => 'Bajar', 'escape' => false));
                } else {
                    $iii = "Descargar $ext";
                }
                if (!empty($g['Egreso']['file'])) {
                    echo $html->link($iii, "/" . IMAGES_URL . $g['Egreso']['file'], array('target' => '_blank', 'escape' => false));
                }

                echo " - ";
                echo $html->link('  Ver en detalle este pago',array('action' => 'view', $g['Egreso']['id']));
                echo " - ";
                echo $html->link('  Editar pago',array('action' => 'edit', $g['Egreso']['id']))?>
            </p>
            <div>
                <ul data-role="listview">
                    <li data-role="list-divider">Listado de Gastos involucrados en este Pago</li>
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
                            echo $ga['observacion'];
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

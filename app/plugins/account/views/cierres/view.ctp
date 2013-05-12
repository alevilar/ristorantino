
<h1><?php echo $cierre['Cierre']['name'] ?></h1>

<p>
    creado: <?php echo date('d-m-Y H:i', strtotime($cierre['Cierre']['created'])); ?>
</p>

<h3>Listado de Gastos</h3>
<ul>
    <?php
    foreach ($cierre['Gasto'] as $g) {
        echo '<li>';
        echo $html->link(
                $number->currency($g['importe_total']), 
                array(
                    'controller' => 'gastos',
                    'action' => 'view',
                    $g['id']), 
                array(
                    'target' => '_blank'
                    )
                );
        echo '</li>';
    }
    ?>
</ul>
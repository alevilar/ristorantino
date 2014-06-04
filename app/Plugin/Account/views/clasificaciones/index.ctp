<h1>Gastos por Clasificación</h1>

<?php
echo $html->link('Nueva Clasificación', array('action' => 'add_edit'), array(
    'data-role'=>'button',
    'data-theme' => 'b',
    
    )
        );
?>
<h2>Listado de Clasificaciones</h2>
<ul class="list-group">
<?php


foreach ($clasificaciones as $id=>$c) {
    echo "<li>";
    echo $html->link($c, array('action'=>'add_edit', $id));    
    echo "</li>";
}

?>
</ul>

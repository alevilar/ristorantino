<STYLE type="text/css">
@media print {
    .no-print{
        display: none;
    }
    
    #header{
        display: none;  
    }
    
   BODY {font-size: 14pt; background: white;}
   
}
</STYLE>

<? echo $this->element('menu')?>

<h1>Listado de productos que faltan contabilizar: Encontrados: <?php echo count($prodsQueFaltan);?></h1>

<a href="#" onclick="window.print();" class="no-print">Imprimir esta página</a>

<div class="no-print">
    
<h4>Ver solo productos de ésta categoria:</h4>

<?php
echo $html->link('Todos', $this->action).' - ';
foreach ( $categorias as $cid => $cts ){
    echo $html->link($cts, $this->action.'/'.$cid);
    echo " - ";
}
?>
<hr>
</div>


<table>
    <thead class="no-print">
        <tr>
            <th>Cantidad</th><th>Producto</th><th>Categoria</th>
        </tr>
    </thead>
    <tbody>
<?php

foreach ( $prodsQueFaltan as $p){
    $pname = $p['Product']['name'];
    $cname = $p['Category']['name'];
    echo "<tr>";
    echo "<td>&nbsp;</td><td>$pname</td> <td>$cname</td>";
    echo "</tr>";
}

?>
        </tbody>
</table>

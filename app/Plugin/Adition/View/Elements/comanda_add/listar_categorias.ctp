<?php
/*
$parentCat = 0;
$superParentId = 0;
$catName = 'Inicio';
if (!empty($categorias['Categoria'])) {
    $parentCat = $categorias['Categoria']['id'];
    $superParentId = (int) $categorias['Categoria']['parent_id'];
    $catName = $categorias['Categoria']['name'];
}

$hide = '';
if ($parentCat) {
    $hide = 'style="display:none"';
}
echo "<div id='categoria-id-$parentCat' $hide>";

echo "<h3>$catName</h3>";

if (!empty($categorias['Categoria']['image_url'])) {
    echo "<p>" . $this->Html->image($categorias['Categoria']['image_url']) . "</p>";
}


echo "<ul>";
if ($parentCat) {
    echo "<li class='bck-button'><button data-categoria-id='$superParentId'>... Volver</button></li>";
}
if (!empty($categorias['Hijos'])) {
    foreach ($categorias['Hijos'] as $c) {
        $cName = $c['Categoria']['name'];
        $cId = $c['Categoria']['id'];
        echo "<li><button data-categoria-id='$cId'>$cName</button></li>";
    }
}
echo "</ul>";

echo "</div>";

if (!empty($categorias['Hijos'])) {
    foreach ($categorias['Hijos'] as $c) {
        echo $this->element('comanda_add/listar_categorias', array('categorias' => $c));
    }
}


*/
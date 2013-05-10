<?php

function mostrarCategorias( $cats ){
    
    $parentCat = 0;
    $superParentId = 0;
    if ( !empty($cats['Categoria']) ) {
        $parentCat = $cats['Categoria']['id'];
        $superParentId = (int) $cats['Categoria']['parent_id'];
    }
    
    $hide = '';
    if ( $parentCat ) {
        $hide = 'style="display:none"';
    }
    echo "<ul id='categoria-id-$parentCat' class='listado-categorias' $hide>";
    
    if ( $parentCat ) {
        echo "<li class='bck-button'><a href='#listado_productos_categoria_$superParentId' data-categoria-id='$superParentId'>... Volver</a></li>";
    } else {
        echo "<li class='bck-button'><a href='#listado_productos_categoria_$superParentId' data-categoria-id='$superParentId'>INICIO</a></li>";
    }
    
    foreach ( $cats['Hijos'] as $c ) {
        $cName = $c['Categoria']['name'];
        $cId = $c['Categoria']['id'];
        echo "<li><a href='#listado_productos_categoria_$cId' data-categoria-id='$cId'>$cName</a></li>";
    }
    echo "</ul>";
    
    foreach ( $cats['Hijos'] as $c ) {
        if (!empty($c['Hijos'])) {
            mostrarCategorias($c);
        }
    }
}



mostrarCategorias( array('Hijos'=>$categorias) );


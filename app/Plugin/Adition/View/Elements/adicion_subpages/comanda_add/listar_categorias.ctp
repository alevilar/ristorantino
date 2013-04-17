<?php

function mostrarCategorias($cats)
{
    ?>  
    <ul>
        <?php foreach ($cats as $c) { ?>
            <li>
                <a href="#listado_productos_categoria_<?php echo $c['id'] ?>" data-categoria-id="<?php echo $c['id'] ?>"><?php echo empty($c['name']) ? 'VACIO' : $c['name']; ?></a>
                <?php if (!empty($c['Hijos']))
                    mostrarCategorias($c['Hijos']) ?>
            </li>
        <?php } ?>
    </ul>
    <?php
}

mostrarCategorias($categorias['Hijos']);
?>
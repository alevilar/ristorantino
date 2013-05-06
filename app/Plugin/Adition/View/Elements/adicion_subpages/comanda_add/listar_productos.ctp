<?php

function mostrarProductos($cats, $productosRoot = array())
{
    // Coloca el listado completo de todos los productos
    //  solo cuando es recorrido por primera vez
    if (count($productosRoot)) {
        ?>
        <ul id="listado_productos_categoria_0">
            <?php
            foreach ($productosRoot as $p) {
                ?>
            <li><a href="#detalle_producto_<?php echo $p['Producto']['id'] ?>"><?php echo $p['Producto']['name']; ?></a></li>
                <?php
            }
            ?>
        </ul>
        <?php
    }

    foreach ($cats as $c) {
        ?>
        <ul id="listado_productos_categoria_<?php echo $c['id'] ?>" style="display: none;">
            <?php
            foreach ($c['Producto'] as $p) {
                ?>

                <li class="ui-btn ui-btn-icon-right ui-li-has-arrow ui-li ui-btn-up-e">
                    <a href="#detalle_producto_<?php echo $p['id'] ?>"><?php echo $p['name']; ?></a>
                </li>

            <?php } ?>
        </ul>
        <?php if (!empty($c['Hijos']))
            mostrarProductos($c['Hijos']) ?>
    <?php } ?>
    <?php
}

mostrarProductos($categorias['Hijos'], $productos);
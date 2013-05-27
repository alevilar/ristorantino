<?php
if ( 1 == 0 && count($productos) ) {
    ?>
    <ul id="listado_productos_categoria_0">
        <?php foreach ( $productos as $p ) { ?>
            <li><button data-producto-id="<?php echo $p['Producto']['id'] ?>"><?php echo $p['Producto']['name']; ?></button></li>
        <?php } ?>
    </ul>
    <?php
}


// Coloca el listado completo de todos los productos
//  solo cuando es recorrido por primera vez


foreach ( $categorias as $c ) {
    ?>
    <ul id="listado_productos_categoria_<?php echo $c['Categoria']['id'] ?>" style="display: none;">
        <?php
        foreach ($c['Producto'] as $p) {
            ?>

            <li>
                <button data-producto-id="<?php echo $p['id'] ?>"><?php echo $p['name']; ?></a>
            </li>

        <?php } ?>
    </ul>

    <?php
    if (!empty($c['Hijos'])) {
        echo $this->element('comanda_add/listar_productos', array('categorias' => $c['Hijos']));
    }
}

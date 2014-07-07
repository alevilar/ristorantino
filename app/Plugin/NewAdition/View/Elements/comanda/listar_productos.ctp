<?php
if ( count($productos) ) {
    ?>
    <div id="listado_productos_categoria_0">
        <?php 
        $i = 0;
        foreach ( $productos as $p ) {?>
        <button class="btn btn-success" data-producto-id="<?php echo $p['Producto']['id'] ?>">
                <?php echo $p['Producto']['name']; ?>
                </button>
        <?php 
        $i++;
        if ($i == 10) break;
        } ?>
    </div>
    <?php
}


// Coloca el listado completo de todos los productos
//  solo cuando es recorrido por primera vez


foreach ( $categorias as $c ) {
    ?>
    <div id="listado_productos_categoria_<?php echo $c['Categoria']['id'] ?>" style="display: none;">
        <?php
        foreach ($c['Producto'] as $p) {
            ?>
            <button class="btn btn-success" data-producto-id="<?php echo $p['id'] ?>"><?php echo $p['name']; ?></a>

        <?php } ?>
    </div>

    <?php
    if (!empty($c['Hijos'])) {
        echo $this->element('comanda/listar_productos', array('categorias' => $c['Hijos'], 'productos' => array()));
    }
}

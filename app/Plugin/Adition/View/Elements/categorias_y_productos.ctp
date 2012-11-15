<?php


$cat_id = "comanda-categoria-id-" . $categorias_sub['id'];
$displayNone = (empty($path))?'':' display: none';
$container_class = (empty($path))?'active':'';
$isRoot = (empty($path))?'root':'';
?>
<div id="<?php echo $cat_id; ?>" class="menu-categorias <?php echo $container_class.' '.$isRoot ?>" style="clear: both;<?php echo $displayNone?>">

    <!--        Path        -->
    <?php 
    if (empty($path)) {
        $path = array();        
    }
    $path[] = array(
        'id'   => $categorias_sub['id'],
        'name' => $categorias_sub['name']
        );
?>
    
    <?php foreach ($path as $p): ?>
    <?php $path_class = (end($path) == $p) ? 'ui-btn-active' : ''; ?>
    <a  href="#comanda-categoria-id-<?php echo $p['id'];?>"
        class="categoria <?php echo $path_class;?> ui-btn ui-btn-inline ui-btn-icon-left ui-btn-corner-all ui-shadow ui-btn-up-c">
             <span class="ui-btn-inner ui-btn-corner-all">
                 <span class="ui-btn-text"><?php echo $p['name'] ?></span>
                 <span class="ui-icon ui-icon-right ui-icon-shadow"></span>
             </span>
    </a>
    <?php endforeach; ?>
    
    <?php array_pop(&$path); ?>
    
    <!--        Categorias        -->
    <?php if (!empty($categorias_sub['Hijos'])): ?>
    <div class="ul-categorias">
    <?php foreach ($categorias_sub['Hijos'] as $cat): ?>
        <?php if (!empty($cat['Hijos']) || !empty($cat['Producto']) ): ?>
        
            <?php $cat_class = empty($cat['id']) ? 'sin-imagen' : 'con-imagen'; ?>
            <a  href="#comanda-categoria-id-<?php echo $cat['id'];?>" data-theme="b" data-inline="true" class="categoria <?php echo $cat_class; ?>">
                <?php
                if (!empty($cat['image_url'])) {
                    echo $this->Html->image($cat['image_url']);
                }
                ?>
                <span><?php echo $cat['name']; ?></span>
            </a>
        <?php endif; ?>
    <?php endforeach; ?>
    </div>
    <?php endif; ?>

    
    <?php $saborDivId = "categoria-{$categorias_sub['id']}-sabores"; ?>
    
    
    <!--        Producto        -->
    <?php if (!empty($categorias_sub['Producto'])): ?>
    <div class="ul-productos" style="clear: both">
    <?php foreach ($categorias_sub['Producto'] as $prod): ?>
            
            <?php $prod_href = empty($categorias_sub['Sabor']) ? '#' : "#$saborDivId"; ?>
            <?php $prod_class = empty($categorias_sub['Sabor']) ? '' : 'producto-con-sabor'; ?>
            <a id="producto-id-<?php echo $prod['id'];?>" 
               href="<?php echo $prod_href; ?>" 
               <?php echo empty($categorias_sub['Sabor'])?'':'data-rel="popup"'; ?>
               data-producto-name="<?php echo $prod['name'];?>"
               data-producto-id="<?php echo $prod['id'];?>"
               class="producto <?php echo $prod_class; ?> ui-btn-inner ui-btn-corner-all">
                <span class="cantidad ui-li-count ui-btn-up-c ui-btn-corner-all"></span>
                <span class="ui-btn-text"><?php echo $prod['name']; ?></span>
            </a>
    <?php endforeach; ?>
    </div>
    <?php endif; ?>
    
    
    <!--        Sabores        -->
    <?php if (!empty($categorias_sub['Sabor'])): ?>
    <div data-role="popup" data-position-to="window"  data-theme="e" data-overlay-theme="a" id="<?php echo $saborDivId?>" 
         class="ui-content ul-sabores" style="clear: both">
    <?php foreach ($categorias_sub['Sabor'] as $sabor): ?>
        
            <a data-role="button" id="sabor-id-<?php echo $sabor['id'];?>" 
               href="#" 
               data-inline="true" 
               data-producto-name="<?php echo $sabor['name'];?>"
               data-producto-id="<?php echo $sabor['id'];?>"
               class="sabor">
                <span class="cantidad ui-li-count ui-btn-up-c ui-btn-corner-all"></span>
                <span class="ui-btn-text"><?php echo $sabor['name']; ?></span>
            </a>
    <?php endforeach; ?>
    </div>
    <?php endif; ?>


</div>


<?php
if (!empty($categorias_sub['Hijos'])) {
    if (empty($path)) {
        $path = array();
    }
    $path[] = array(
        'id' => $categorias_sub['id'],
        'name' => $categorias_sub['name'],
        );
    foreach ($categorias_sub['Hijos'] as $cat_hijo) {
        if ( !empty($cat_hijo['Hijos']) || !empty($cat_hijo['Producto'])) {
            echo $this->element('categorias_y_productos', array(
                'categorias_sub' => $cat_hijo,
                'path' => $path,
                )
                    );
        }
    }
}

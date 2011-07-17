<script type="text/javascript">
    
    <?php if ( !empty($mesa_id) ) { ?>
    adicion.setCurrentMesa( <? echo $mesa_id?> );
    <?php }?>

    var comanda = {
        test: 'Ale probando',
        categorias: <?php echo $javascript->object($categorias_tree)?>,
        menu: <?php echo $javascript->object($categorias)?>,
        
        seleccionarProducto: function(prod){
            console.info("adentroooo");
            console.debug(prod);
        }
    }
    
//    $(function(){
//        $( "#listaProductos" ).tmpl( comanda , {agregarleElObjeto: function(){
//                var prod = this;
//                return comanda.seleccionarProducto;
//            }})
//            .appendTo( "#ul-productos" );
//    });
</script>

    
    <div  data-role="page"  data-add-back-btn="true" id="comanda-add-menu">
        <div  data-role="header"  data-position="inline">

            <h1>Menu</h1>
            <a rel="external" href="#listado-mesas" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right">Home</a>
        </div>

        <div data-role="content">
            <script>
                $(function(){
                    $('#link-cat').menu({
			content: $('#cat-tree').html(),
			crumbDefaultText: ' '
                    });
                
                })
            </script>
            <a id="link-cat"  href="#cat-tree">Categorias Tree</a>
            <div id="cat-tree" style="display: none">
            <ul>
                <li><a href="#">Coso N|122</a>
                    <ul>
                        <li><a  data-panel="menu" href="<?= $html->url('/mesas/view/2')?>">Mesa Id 2</a></li>
                        <li><a href="#">Segundo</a></li>
                    </ul>
                </li>
            <?php
            foreach ($categorias_tree as $k=>$c) {
                echo "<li><a href='#categoria-$k' class='catlink'>". $c ."</a></li>";
            }
            ?>
            </ul>
            </div>
        </div>
        
        <div data-role="footer"><h2>Menu footer</h2></div>
    </div>
</div>  

    

    <div  data-role="page"  data-add-back-btn="true" id="comanda-data">
        <div  data-role="header"  data-position="inline">

            <h1>Nueva Comanda</h1>
            <a rel="external" href="#listado-mesas" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right">Home</a>
        </div>

        <div  data-role="content" class="">

            

            <div class="categorias-productos-listado">
                <ul id="ul-productos" class="listado-productos" data-role="listview">
                    <?php foreach ($categorias as $c) { ?>
                        <li class="">                
                            <h2><?= $c['Categoria']['name'] ?></h2>
                            <?php if ( count($c['Sabor']) > 0 ) {?>                
                            <h3>Sabores</h3>
                            <ul>
                                <?php foreach ( $c['Sabor'] as $s ) { ?>
                                <li><?= $s['name'] ?></li>
                                <?php } ?>
                            </ul>
                            <?php } ?>

                            <h3>Productos</h3>
                            <ul>
                                <?php foreach ($c['Producto'] as $p) { ?>
                                <li data-producto-id="${id}" onclick=""><?= $p['name']?></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <?php }?>
                </ul>
            </div>


        </div>
        <div  data-role="footer">Ristorantino Mágico</div>
    </div>


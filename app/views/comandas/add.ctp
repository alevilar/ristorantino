<?php echo $this->pageTitle= 'Nueva comanda' ?>

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
    
    $(function(){
        $( "#listaProductos" ).tmpl( comanda , {agregarleElObjeto: function(){
                var prod = this;
                return comanda.seleccionarProducto;
            }})
            .appendTo( "#ul-productos" );
    });
</script>


<script id="listaProductos" type="text/x-jquery-tmpl">
    
    <div><h1 data-bind="text: currentMesa().numero">numero de mesa</h1></div>
        {{each menu}}
        <div>
            <li class="">
                <h2>${Categoria.name}</h2>
                {{if Sabor.length > 0}}
                <h3>Sabores</h3>
                <ul>
                    {{each Sabor}}
                    <li>${name}</li>
                    {{/each}}
                </ul>
                {{/if}}
                
                <h3>Productos</h3>
                <ul>
                    {{each Producto}}
                    
                    <li data-producto-id="${id}" onclick="${$item.agregarleElObjeto()}">${name}</li>
                    {{/each}}
                </ul>
            </li>
        </div>
        {{/each}}
</script>


<div id="categorias-container" class="categorias-listado">
    <ul>
    <?php
//    debug($categorias_tree);
//    foreach ($categorias_tree as $k=>$c) {
//        echo "<li><a href='#categoria-$k' class='catlink' onclick='console.debug(this.href);$(this.href).show();'>". $c ."</a></li>";
//    }

    ?>
    </ul>
</div>

<div class="categorias-productos-listado">
    <ul id="ul-productos" class="listado-productos"
        >
    </ul>
</div>

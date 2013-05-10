R$.View.ComandaAddView = Backbone.View.extend({
   
    el: $("#comanda-add"),
    
    events: {
        "click #listado_categorias a"    :  "seleccionarCategoria",
        "tap #listado_productos a"       :  "seleccionarProducto"
    },
    
    
    productosIdTagName: 'listado_productos_categoria_',
    
    categoriasIdTagName: 'categoria-id-',
    
    $productoActual: $('#'+this.productosIdTagName+'0'), //contenedor de productos actualmente visibles
    $categoriaActual: $('#'+this.categoriasIdTagName+'0'), // contenedor de categoria visible
    
    
    enProductoDetalle: null,
//    ULproductos: document.getElementById('listado_productos_categoria_0'),
//    DIV_categoriasContainer: document.getElementById('listado_categorias'),
//    AcategoriaActual: null,
    
    initialize: function() {
        if (!this.model){
            throw new Error("no hay una mesa seteada como model");
        }
           
        this.render();
    },
    
    
    setModel: function( model ) {
        this.model = model;
        this.render();
    },
    
    seleccionarProducto: function( e ){
        e.preventDefault();
        if ( this.enProductoDetalle ) {
            this.enProductoDetalle.style.display = 'none';
        }
        var href = e.currentTarget.getAttribute('href');
        this.enProductoDetalle = document.getElementById(href.substring(1));
        var $cantInput = $(href).find('input[name="cantidad"]').first();
        $cantInput.val( Number($cantInput.val()) +1 );
        this.enProductoDetalle.style.display = '';
    },
    
    seleccionarCategoria: function(e) {        
        e.preventDefault();
        
        var catIdStr = this.categoriasIdTagName + e.currentTarget.getAttribute('data-categoria-id');
        var prodIdStr = this.productosIdTagName + e.currentTarget.getAttribute('data-categoria-id');
        
        if ( $( "#"+catIdStr ).length ) {
            this.$categoriaActual.hide();
            this.$categoriaActual = $( "#"+catIdStr ).show();
        }
        
        
        if ( $( "#"+prodIdStr ).length ) {
            this.$productoActual.hide();
            this.$productoActual = $( "#"+prodIdStr ).show();
        }
        
        return false;
        
    },
    
    
    render: function(){
        this.$categoriaActual.hide();
        this.$categoriaActual = $('#'+this.categoriasIdTagName+'0');
        this.$categoriaActual.show();
        
        this.$productoActual.hide();
        this.$productoActual = $('#'+this.productosIdTagName+'0');
        this.$productoActual.show();
        
        this.$('.mesa-numero').text( this.model.get('numero'));
        this.$('.mozo-numero').text( this.model.get('Mozo').numero);
        this.$('.mesa-estado').text( this.model.get('estado_name'));
        return this;
    }
});
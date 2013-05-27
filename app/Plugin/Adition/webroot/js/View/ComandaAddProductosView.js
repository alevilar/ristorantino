R$.View.ComandaAddProductos = Backbone.View.extend({
   
    el: document.getElementById("listado_productos"),
    
    events: {
        "tap button"   :  "seleccionarProducto"
    },
    
    productosIdTagName: '#listado_productos_categoria_',
    
    initialize: function() {
        R$.app.on('change:categoria', this.render, this);
    },
    
    seleccionarProducto: function( e ){
        e.preventDefault();
        var newId = e.currentTarget.getAttribute('data-producto-id');
        R$.app.set( 'producto', newId );
        
    },
 
    
    render: function(){
        var prodIdPrv = R$.app.previous('categoria');
        var prodIdNew = R$.app.get('categoria');
           
        if ( prodIdNew == prodIdPrv ) return;
        
        $( this.productosIdTagName + prodIdPrv ).hide();
        $( this.productosIdTagName + prodIdNew ).show();
        return this;
    }
});

 R$.comandaAddView.productosView = new R$.View.ComandaAddProductos;
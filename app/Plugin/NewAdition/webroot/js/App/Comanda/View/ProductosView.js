App.View.ComandaAddProductos = Backbone.View.extend({
   
    el: document.getElementById("listado_productos"),
    
    events: {
        "tap button"   :  "seleccionarProducto"
    },
    
    productosIdTagName: '#listado_productos_categoria_',
    
    initialize: function() {
        App.on('change:categoria', this.render, this);
    },
    
    seleccionarProducto: function( e ){
        e.preventDefault();
        var newId = e.currentTarget.getAttribute('data-producto-id');
        App.set( 'producto', newId );
        
    },
 
    
    render: function(){
        var prodIdPrv = App.previous('categoria');
        var prodIdNew = App.get('categoria');
           
        if ( prodIdNew == prodIdPrv ) return;
        
        $( this.productosIdTagName + prodIdPrv ).hide();
        $( this.productosIdTagName + prodIdNew ).show();
        return this;
    }
});

 App.comandaAddView.productosView = new App.View.ComandaAddProductos;
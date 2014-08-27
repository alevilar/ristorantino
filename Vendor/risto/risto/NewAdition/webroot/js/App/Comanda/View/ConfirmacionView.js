App.View.ComandaAddConfirmacion = Backbone.View.extend({
   
    el: document.getElementById("comanda-add-confirmacion"),
    
    $contenedorProductos: $('#comanda-add-detalle-comanda-list'),
    
    events: {
        
    },
    
    render: function(data) {
        this.$contenedorProductos.html("EPPES");
        if ( data.hasOwnProperty( 'productos' ) ) {
            papa = data.productos;
//            $(data.productos).appendTo( this.$contenedorProductos );
        }
        
    }
});


R$.View.ComandaAdd = Backbone.View.extend({
   
    el: document.getElementById("comanda-add"),
    
    // Las vistas del detalle de producto se van creando "on the fly"
    comandaAddFabricaView: {},
    
    initialize: function () {
        // mostrar detalles del producto y crearlo como un nuevo DetalleComanda de la comanda
        this.listenTo(this.model, 'change:producto', function (evt, prdId) {
            
            var dc = {
                Producto: {
                    id: prdId
                }
            };
            this.showProductoView( dc );
        }, this);
        
        this.render();
    },
    
    
    showProductoView: function ( producto ) {
        if ( !this.comandaAddFabricaView.hasOwnProperty(producto.id) ) {
                // crear una nueva vista
                this.comandaAddFabricaView[producto.id] = new R$.View.ComandaAddFabrica({
                    model: producto
                });
            } else {
                // mostrar la vista
                this.comandaAddFabricaView[producto.id].show();
            }
    
            var prodAnt = this.model.previous('producto');
            if (prodAnt) {
                this.comandaAddFabricaView[prodAnt].hide();
            }
    },
    
    render: function () {
        
        this.categoriasView = new R$.View.ComandaAddCategorias;
        this.categoriasView.render();
    }
    
});

R$.comandaAddView = new R$.View.ComandaAdd( {model: R$.app} );
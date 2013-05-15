R$.View.ComandaAddDetalleProducto = Backbone.View.extend({
    
    events: {
        "tap .cancelar-pedido"       :  "cancelarPedidoProducto",
        "tap .duplicar-pedido"       :  "duplicarPedidoProducto"
    },    
    
    show: function(){
        this.el.show();
    },
    
    
    hide: function(){
        this.el.hide();
    },
    
    add: function(){
        // incrementar el contador de cantidad de este producto
        var $cantInput = this.$('input[name="cantidad"]').first();
        $cantInput.val( Number($cantInput.val()) +1 );
    }
    
});


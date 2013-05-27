R$.View.ComandaAddFabrica = Backbone.View.extend({
    
    events: {
        "tap .duplicar-pedido"       :  "addDetalleComanda"
    },
    
    detalleComandaView: [],
    currentDCView: null,
    
    hasTagProducto: 'detalle_producto_',
    
    
    initialize: function (ops) {
        
        this.setElement( document.getElementById( this.hasTagProducto + ops.model.id ) );
       
        this.currentDCView = new R$.View.ComandaAddDetalleComanda({
            model: {Producto: this.model},
            el: this.$('form:first')[0]
        });
        
        this.render();
    },
   
    
    addDetalleComanda: function () {
        this.detalleComandaView.push(this.$('form:first').clone());
        var dcView = new R$.View.ComandaAddDetalleComanda({
            model: {Producto: this.model},
            el: this.currentDCView.cloneNode(true)
        });
        this.el.appendChild( dcView.el );
        return this;
    },
    
    render: function () {
        this.show();
        return this;
    }, 
    
    
    hide: function () {
        this.$el.hide();
        return this;
    },
    
    show: function () {
        this.$el.show();
        return this;
    },
    
    
    add: function () {
        // incrementar el contador de cantidad de este producto
        var $cantInput = this.$('input[name="cantidad"]').first();
        $cantInput.val( Number($cantInput.val()) +1 );
    }
    
});


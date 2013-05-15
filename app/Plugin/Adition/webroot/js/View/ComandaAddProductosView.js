R$.View.ComandaAddProductos = Backbone.View.extend({
   
    el: document.getElementById("listado_productos"),
    
    events: {
        "tap #listado_productos a"   :  "seleccionarProducto"
    },
    
    
    productosIdTagName: 'listado_productos_categoria_',
    
    $productoActual: $('#'+this.productosIdTagName+'0'), //contenedor de productos actualmente visibles
    $enProductoDetalle: null, // contenedor de detalle del producto activo
    
    productosSeleccionados: [],
    
    initialize: function() {
        R$.app.on('change:categoria', this.seleccionarCategoria, this);
        this.render();
    },
    
    seleccionarProducto: function( e ){
        e.preventDefault();
        
        var href = e.currentTarget.getAttribute('href'),
            prodSel = _.find( this.productosSeleccionados, function( p ) {
                return p.id == href;
            });
            
        if ( !prodSel ) {
            this.productosSeleccionados.push( new R$.View.DetalleComandaView({id: href}) );
        }
        
       
        
        if ( this.$enProductoDetalle && this.$enProductoDetalle != $nuevoproductoDetalle ) {
            this.$enProductoDetalle.hide();
        }
        
        // set current producto
        this.$enProductoDetalle = $nuevoproductoDetalle;
        
        // agregar al listado de productos seleccionados
        this.productosSeleccionados.push( this.$enProductoDetalle.clone() );
        
        // incrementar el contador de cantidad de este producto
        var $cantInput = this.$enProductoDetalle.find('input[name="cantidad"]').first();
        $cantInput.val( Number($cantInput.val()) +1 );
        
        this.$enProductoDetalle.show();
    },
  
      seleccionarCategoria: function( e, cat ) {
          console.debug(cat);
  //         var prodIdStr = this.productosIdTagName + e.currentTarget.getAttribute('data-categoria-id');
//            if ( $( "#"+prodIdStr ).length ) {
//                this.$productoActual.hide();
//                this.$productoActual = $( "#"+prodIdStr ).show();
//            }
      },
    
    
    render: function(){
        this.$productoActual.hide();
        this.$productoActual = $('#'+this.productosIdTagName+'0');
        this.$productoActual.show();
        return this;
    }
});
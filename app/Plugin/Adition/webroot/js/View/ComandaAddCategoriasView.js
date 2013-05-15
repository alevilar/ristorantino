R$.View.ComandaAddCategorias = Backbone.View.extend({
   
    el: document.getElementById("listado_categorias"),
    
    events: {
        "tap a"  :  "seleccionarCategoria"
    },
    
    categoriasIdTagName: 'categoria-id-',
    
    
    initialize: function() {
        R$.app.on('change:categoria', this.intercambiarActiva, this);
        this.render();
    },
    
    intercambiarActiva: function(){
        
        var prev = R$.app.previous('categoria');
        if (prev) {
            prev.hide();
        }
        R$.app.get('categoria').show();
    },
    
    seleccionarCategoria: function(e) {        
        e.preventDefault();
        
        var catIdStr = this.categoriasIdTagName + e.currentTarget.getAttribute('data-categoria-id');
        
        if ( $( "#"+catIdStr ).length ) {
            R$.app.set('categoria', $( "#"+catIdStr ));
        }
        
        return false;
    },
    
    
    render: function(){
        R$.app.set('categoria', $('#'+this.categoriasIdTagName+'0') );
        
        return this;
    }
});
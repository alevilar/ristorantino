R$.View.ComandaAddCategorias = Backbone.View.extend({
   
    el: document.getElementById("listado_categorias"),
    
    render: function () {
    	_.each( R$.categorias, function ( cat ) {
    		this.el.appendChild(cat.render().el);
    	}, this);
    }
});

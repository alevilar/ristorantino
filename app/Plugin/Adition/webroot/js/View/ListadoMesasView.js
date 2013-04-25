R$.ListadoMesasView = Backbone.View.extend({

    el: $("#listado-mesas"),
    //    className: "mesa",
    
    events: {
        "click .mesa": "select",
        "click .mozo": "mostrarMesasDeMozo"
    },

    initialize: function() {
        this.listenTo(R$.mesasCollection, 'remove', this.doRemove);
        this.listenTo(R$.mesasCollection, 'destroy', this.doRemove);
        this.listenTo(R$.mesasCollection, 'add', this.add);
    },

    doRemove: function(){
        this.remove();
        this.render();
        return this;
    },
    
    
    add: function( mesa ) {
        var view = new R$.ItemListadoMesasView( {model: mesa} );
        $("#mesas_container").append( view.render().el );
        this.render();
        return this;
    },
    
    
    render: function(e) {
        $('.cant_mesas', '#listado-mesas').text( R$.mesasCollection.length );
        return this;
    },
    
    mostrarMesasDeMozo: function(){
        
    }

});


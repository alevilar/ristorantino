R$.ListadoMesasView = Backbone.View.extend({

    el: $("#listado-mesas"),
    //    className: "mesa",
    
    events: {
        "click .mesa": "select",
        "click .mozo": "mostrarMesasDeMozo"
    },

    initialize: function() {
        this.listenTo(R$.mesasCollection, 'remove', this.render);
        this.listenTo(R$.mesasCollection, 'destroy', this.render);
        this.listenTo(R$.mesasCollection, 'add', this.add);
    },
    
    
    add: function( mesa ) {
        new R$.ItemListadoMesasView( {model: mesa} );
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


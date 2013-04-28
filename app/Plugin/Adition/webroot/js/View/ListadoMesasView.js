    
R$.View.ListadoMesas = Backbone.View.extend({

    el: $("#listado-mesas"),
    
    events: {
        "click .btn-mozo": "abrirMesaDeMozo"
    },
    
    initialize: function() {
        this.listenTo(R$.mesasCollection, 'remove', this.render);
        this.listenTo(R$.mesasCollection, 'destroy', this.render);
        this.listenTo(R$.mesasCollection, 'add', this.add);
        return this;
    },
       
    
    add: function( mesa ) {
        new R$.View.ItemListadoMesas( {
            model: mesa
        } );
        this.render();
        return this;
    },
    
    
    render: function() {
        this.$('.cant_mesas').text( R$.mesasCollection.length );
        return this;
    },
    
    abrirMesaDeMozo: function(e){
        e.preventDefault();
        var hash = e.currentTarget.hash,
        hsi = hash.indexOf('='),
        mozoId = hash.substr(hsi+1),
        mozo = _.find(R$.mozos, function(m){
            return m.id == mozoId
            });
                
        $.mobile.changePage( "#mesa-add"); 
        $('form input[name="mozo_id"]', "#mesa-add").val(mozoId);
        $('.ui-title','#mesa-add').text("Abrir Mesa de Mozo "+mozo.numero);
    }

});

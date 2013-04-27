(function(window){
    
    window.R$.ListadoMesasView = Backbone.View.extend({

        el: $("#listado-mesas"),
    
        events: {
            "click .btn-mozo": "mostrarMesasDeMozo"
        },
    

        initialize: function() {
            this.listenTo(R$.mesasCollection, 'remove', this.render);
            this.listenTo(R$.mesasCollection, 'destroy', this.render);
            this.listenTo(R$.mesasCollection, 'add', this.add);
            return this;
        },
    
    
        add: function( mesa ) {
            new R$.ItemListadoMesasView( {
                model: mesa
            } );
            this.render();
            return this;
        },
    
    
        render: function() {
            this.$('.cant_mesas').text( R$.mesasCollection.length );
            return this;
        },
    
        mostrarMesasDeMozo: function(e){
            e.preventDefault();
            var hash = e.currentTarget.hash,
                hsi = hash.indexOf('='),
                mozo = hash.substr(hsi+1);
            if ( mozo > 0 ) {
                // filtrar por mozo seleccionado
                this.$('.mesa').hide();
                this.$(".mozo_"+mozo).show();     
                R$.router.navigate(hash, {trigger: true, replace: true});
            } else {
                // mostrar todos
                R$.router.navigate('');
                this.$('.mesa').show();
            }
            
        }

    });

})(window);
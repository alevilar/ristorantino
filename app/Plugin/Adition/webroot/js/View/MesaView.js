(function(window){
    
    window.R$.MesaView = Backbone.View.extend({

        el: $("#mesa-view"),
    
        events: {
            "click #btn-mesa-cerrar"    :   "mandarAjaxYVolverAListadoDeMesas",
            "click #btn-mesa-reabrir"   :   "mandarAjaxYVolverAListadoDeMesas",
            "click #btn-mesa-ticket":   "mandarAjaxYVolverAListadoDeMesas",
            "click #btn-mesa-borrar"    :   "eliminarMesa",
            "click #btn-mesa-numero": "cambiarNumero"
        
        },
    
    
        tmp_header: Handlebars.compile( $('#tmp-mesa-header').html() ),

        initialize: function(args) {
            if (!args.model){
                throw new Error("se debe pasar una mesa para inicializar la vista");
            }
            this.render();
        },

        eliminarMesa: function(){
            this.model.destroy();
        },
        
        cambiarNumero: function(){
            var oldNum = this.model.get('numero');
            var num = window.prompt("Numero de mesa", oldNum);
            if ( num && oldNum != num) {
                this.model.save({'numero': num});
            }
        },
    
        mandarAjaxYVolverAListadoDeMesas: function(e){
            var href = e.currentTarget.getAttribute('href');
            href += "/"+this.model.id;
        
            if (href) {
                $.getJSON( href );
            }
            $.mobile.changePage("#listado-mesas");
            return false;
        },
    
        render: function(){
            //        $("#mesa-view").find("[data-role='header']")
            this.$("header .header").html( this.tmp_header( this.model.toJSON()) );
            this.$el.addClass('estado_'+this.model.get('estado_id'), this.model.get('estado_id'));
            return this;
        }

   
    });

    var currentMesaView = null;
    R$.mesasCollection.on('select', function(mesa){
        if ( !currentMesaView ) {
            // si no existe creo una nueva vista de la mesa-view
            currentMesaView = new R$.MesaView({
                    model: mesa
            });
            
        } else {
            // si existe, y la mesa seleccionada es otra, entonces refrescar la vista-view
            if ( currentMesaView.model != mesa ) {
                currentMesaView.model = mesa;
                currentMesaView.render();
            }
        }
    });

})(window);
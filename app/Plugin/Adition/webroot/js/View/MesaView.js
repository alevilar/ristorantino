(function(window){
    
//alert("ortodonca4");
    window.R$.MesaView = Backbone.View.extend({

        //    tagName:  "li",
        //    el: ,
        //    className: "mesa",
    
        events: {
            "click #mesa-cerrar"    :   "mandarAjaxYVolverAListadoDeMesas",
            "click #mesa-reabrir"   :   "mandarAjaxYVolverAListadoDeMesas",
            "click #mesa-reimprimir":   "mandarAjaxYVolverAListadoDeMesas",
            "click #mesa-reabrir"   :   "mandarAjaxYVolverAListadoDeMesas",
            "click #mesa-borrar"    :   "eliminarMesa"
        
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
    
        mandarAjaxYVolverAListadoDeMesas: function(e){
            var href = e.currentTarget.getAttribute('href');
            href += "/"+this.model.id;
        
            if (href) {
                $.post( href );
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
                    model: mesa,
                    el: $("#mesa-view")
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
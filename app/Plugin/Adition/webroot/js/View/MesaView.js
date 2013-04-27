(function(window){
    R$.MesaView = Backbone.View.extend({

        el: $("#mesa-view"),
    
        events: {
            "click #btn-mesa-cerrar"    :   "mandarAjaxYVolverAListadoDeMesas",
            "click #btn-mesa-reabrir"   :   "mandarAjaxYVolverAListadoDeMesas",
            "click #btn-mesa-ticket"    :   "mandarAjaxYVolverAListadoDeMesas",
            "click #btn-mesa-borrar"    :   "eliminarMesa",
            "click #btn-mesa-numero"    :   "cambiarNumero"
        
        },
    
        eventModel: {
            'change:numero'             :   'renderHeader',
            'change:mozo_id'            :   'renderHeader',
            'change:id'                 :   'render'
        },
    
        tmp_header: Handlebars.compile( $('#tmp-mesa-header').html() ),
        tmp_loader: Handlebars.compile( $('#mesaLoader').html() ),

        setModel: function( newModel ){
            if (this.model) {
                for ( var i in this.eventModel ) {
                    this.stopListening(this.model, i, this[this.eventModel[i]]);  
                }
            }
            this.model = newModel;   
            for ( var i in this.eventModel ) {
                this.listenTo(this.model, i, this[this.eventModel[i]]); 
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
                this.model.save({
                    'numero': num
                });
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
        
        renderHeader: function(e){
            this.$("header .header").html( this.tmp_header( this.model.toJSON()) );
            return this;
        },
    
        renderId: function(){
            if (this.model.isNew()){
                this.$('footer .mesa_id').html( this.tmp_loader() );
            } else {
                this.$('footer .mesa_id').text(this.model.get('id'));
            }
        },
        
        render: function(){
            if (!this.model){
                throw new Error("no hay una mesa seteada como model");
            }
            this.renderHeader();
            this.renderId();
            this.$el.addClass('estado_'+this.model.get('estado_id'), this.model.get('estado_id'));
            return this;
        }
   
    });


})(window);
R$.ItemListadoMesasView = Backbone.View.extend({

    tagName:  "li",
    
    id: function(){
        return "listado-mesa-id-"+this.model.id;  
    },
    //    el: ,
    className:  function(){
        var estado = this.model.get('estado_id'),
        mozo   = this.model.get('mozo_id')
        
        return "mesa estado_"+estado+" mozo_"+mozo;
    },
    
    template: Handlebars.compile( $('#listaMesas').html() ),
    
    events: {
        "click a": "select"
    },
    
    eventsMesa:{
        'change:estado_id'  :   'cambiarEstado',
        'change:mozo_id'    :   'cambiarMozo',
        'change:numero'     :   'cambiarNumero',
        'change:time_cerro' :   'cambiarTimeCerro',
        'change:Cliente'    :   'render',
        'remove destroy'    :   'remove',
        'add'               :   'sort'
    },

    initialize: function() {
        $("#mesas_container_mozo_"+this.model.get('mozo_id')).append( this.render().el );
        for (var i in this.eventsMesa) {
            this.listenTo(this.model, i, this[this.eventsMesa[i]]);              
        }
    },
    
    select: function(e){
        this.model.trigger('select', this.model);
        return this;
    },
    
    cambiarTimeCerro: function(){
        var time = this.model.get('time_cerro_abr');
        this.$('.mesa-time-cerro').text(time);
    },
    
    cambiarMozo: function(){
        this.render();
    },
    
    cambiarNumero: function(){
        this.$('.mesa-numero').text( this.model.get('numero') );
    },
    
    cambiarEstado: function(){
        var estado = this.model.get('estado_id');
        this.el.className = 'mesa estado_'+estado;
    },
    
    render: function(e) {
        this.$el.html( this.template(this.model.toJSON()) );
        return this;
    }

});


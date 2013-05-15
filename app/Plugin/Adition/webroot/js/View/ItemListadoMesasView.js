R$.View.ItemListadoMesas = Backbone.View.extend({

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
       
    $mozoContainer: null, // init on new mesa item view create
    
    jqmThemeByEstado: function(estadoId){
        if (!estadoId) {
            estadoId = this.model.get('estado_id')
        }
            
        return 'ui-btn-up-'+R$._jqmThemeMap[estadoId];
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
    
    changeContainer: function() {
        this.$mozoContainer = $("#mesas_container_mozo_"+this.model.get('mozo_id'));
        this.$mozoContainer.append( this.render().el );
    },

    initialize: function() {
        this.changeContainer();
        for (var i in this.eventsMesa) {
            this.listenTo(this.model, i, this[this.eventsMesa[i]]);              
        }
                        
    },
    
    select: function(e){
        R$.app.set('mesa', this.model );
        return this;
    },
    
    cambiarTimeCerro: function(){
        var time = this.model.get('time_cerro_abr');
        this.$('.mesa-time-cerro').text(time);
    },
    
    cambiarMozo: function(){
        this.changeContainer();
    },
    
    cambiarNumero: function(){
        this.$('.mesa-numero').text( this.model.get('numero') );
    },
    
    cambiarEstado: function(){
        var $a = this.$('a');
        var pEid = this.model.previous('estado_id');
        if (pEid) {
            $a.removeClass(this.jqmThemeByEstado(  ));
        }
        
        $a.attr('data-theme', R$._jqmThemeMap[this.model.get('estado_id')]);
        
        $a.addClass(this.jqmThemeByEstado());
    },
    
    render: function(e) {                
        this.$el.html( this.template(this.model.toJSON()) );
        this.cambiarEstado();
        return this;
    }

});


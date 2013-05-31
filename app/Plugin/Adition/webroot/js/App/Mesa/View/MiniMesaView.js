(function(mesaApp){
	mesaApp.View.MiniMesaView = Backbone.Marionette.ItemView.extend({

    tagName:  "li",
    
    template: '#mini-mesa-view',
    
    initialize: function (a){
    	console.info("Estoy en el Item MINIMESA");
    },
    
    id: function(){
        return "listado-mesa-id-"+this.model.id;  
    },
    //    el: ,
    className:  function(){
        var estado = this.model.get('estado_id'),
        mozo   = this.model.get('mozo_id')
        
        return "mesa estado_"+estado+" mozo_"+mozo;
    },
    
    jqmThemeByEstado: function(estadoId){
        if (!estadoId) {
            estadoId = this.model.get('estado_id')
        }
            
        return 'ui-btn-up-'+App._jqmThemeMap[estadoId];
    },
    
    
    events: {
        "click a": "select"
    },
    
    ModelEvents:{
        'change:estado_id'  :   'cambiarEstado',
        'change:mozo_id'    :   'cambiarMozo',
        'change:numero'     :   'cambiarNumero',
        'change:time_cerro' :   'cambiarTimeCerro',
        'change:Cliente'    :   'render',
        'remove destroy'    :   'remove',
        'add'               :   'sort'
    },
    
    
    select: function(e){
        App.set('mesa', this.model );
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
        
        $a.attr('data-theme', App._jqmThemeMap[this.model.get('estado_id')]);
        
        $a.addClass(this.jqmThemeByEstado());
    } 
 

});

})(App.mesaApp);

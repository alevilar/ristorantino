(function(mesaApp){
	mesaApp.View.MesaView = Backbone.Marionette.ItemView.extend({

    tagName:  "article",
    
    template: '#mesa-view',
    
    events: {
        "click": "select"
    },
    
    modelEvents:{
        'change:estado_id'  :   'cambiarEstado',
        'change:mozo_id'    :   'cambiarMozo',
        'change:numero'     :   'cambiarNumero',
        'change:time_cerro' :   'cambiarTimeCerro',
        'change:Cliente'    :   'render',
        'remove destroy'    :   'remove',
        'add'               :   'sort'
    },
    
    
    expanded: false,
    
    extraView: null,
    
    contentRegion: null,
 
    id: function(){
        return "listado-mesa-id-"+this.model.id;  
    },
    
    onRender: function ()
    {
    	this.contentRegion = new Marionette.Region({
    		el: this.$('.content')
    		});    	   
    },
    
    showMore: function () 
    {    	
    	if ( !this.extraView ) {
    		this.extraView = new mesaApp.View.MesaExtraView({model: this.model});	
    	}
    	if ( !this.expanded ) {
    		this.className = 'expanded';
    		this.contentRegion.show( this.extraView );
    		this.expanded = true;	
    	}
    	return this;
    },
    
    hideMore: function ()
    {
    	if ( this.expanded ) {
    		this.className = 'mini';
    		this.contentRegion.close( this.extraView );
    		this.expanded = false;	
    	}
    	return this;
    },
    
    //    el: ,
    className:  function ()
    {
        var estado = this.model.get('estado_id'),
        mozo   = this.model.get('mozo_id')
        
        return "mesa estado_"+estado+" mozo_"+mozo;
    },
    
    sort: function(){
    	
    },
    
    select: function ( e )
    {    	
    	this.trigger('mesa:select', this);
    	this.showMore();
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

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
    

    initialize: function() {
        $("#mesas_container").append( this.render().el );
        this.listenTo(this.model, 'change:estado_id', this.cambiarEstado);
        this.listenTo(this.model, 'change:mozo_id', this.cambiarMozo);
        this.listenTo(this.model, 'change:numero', this.cambiarNumero);
        this.listenTo(this.model, 'change:time_cerro', this.cambiarTimeCerro);
        this.listenTo(this.model, 'change:Cliente', this.render);
        this.listenTo(this.model, 'remove destroy', this.remove); 
        this.listenTo(this.model, 'add', this.sort);  
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
        var mozo = this.model.get('Mozo.numero').numero;
        this.$('.mesa-mozo').text(mozo);
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


R$.ItemListadoMesasView = Backbone.View.extend({

    tagName:  "li",
    //    el: ,
    className: "mesa",
    
    template: Handlebars.compile( $('#listaMesas').html() ),
    
    events: {
        "click a": "select"
    },

    initialize: function() {
        this.listenTo(this.model, 'change', this.render);
        this.listenTo(this.model, 'remove', this.remove);  
        this.listenTo(this.model, 'destroy', this.remove);        
    },
    
    select: function(e){
      this.model.trigger('select', this.model);
    },

    
    render: function(e) {
        this.$el.html( this.template(this.model.toJSON()) );
        
        var estado = this.model.get('estado_id');
        this.$el.addClass('estado_'+estado, estado);
        
        return this;
    }

});


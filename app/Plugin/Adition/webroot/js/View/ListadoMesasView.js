R$.ListadoMesasView = Backbone.View.extend({

    tagName:  "li",
    //    el: ,
    //    className: "mesa",
    
    events: {
        "click a": "select"
    },

    initialize: function() {
        this.listenTo(this.model, 'change', this.render);
        this.listenTo(this.model, 'add', this.add);
//        this.listenTo(this.model, 'destroy', this.remove);        
    },
    
    select: function(e){
        e.preventDefault();
      $.mobile.changePage(e.currentTarget.getAttribute('href'));
      
    },

    template:Handlebars.compile( $('#listaMesas').html() ),
    
    //urlRoot: 'mesas',
    add: function(e) {
        this.render(e);
        $('#mesas_container').append(this.$el);
        return this;
    },
    
    render: function(e) {
        console.info("estoy renderizando la vista listadoDe Mesas");
        //        this.$el.html(this.template(this.model.attributes));
        this.$el.html( this.template(this.model.toJSON()) );
        this.$el.addClass('estado_'+this.model.get('estado_id'), this.model.get('done'));
        return this;
      
        //        
        
        return this;
    }

});


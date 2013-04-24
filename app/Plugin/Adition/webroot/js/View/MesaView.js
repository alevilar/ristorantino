R$.MesaView = Backbone.View.extend({

    //    tagName:  "li",
    //    el: ,
    //    className: "mesa",
    id : '#mesa-view',
    
    events: {
        "click": "boton"
    },
    
    
    tmp_header: Handlebars.compile( $('#tmp-mesa-header').html() ),

    initialize: function() {
        this.render();
    },

    boton: function(){
        alert("botonealo");
    },
    
    render: function(){
        console.info("renderizo la vista");
        console.debug( this.tmp_header( this.model.toJSON()));
        console.debug(this.$el);
//        $("#mesa-view").find("[data-role='header']")
        $("#mesa-view").find("header .header").html( this.tmp_header( this.model.toJSON()) );
        this.$el.addClass('estado_'+this.model.get('estado_id'), this.model.get('estado_id'));
        return this;
    }

   
});



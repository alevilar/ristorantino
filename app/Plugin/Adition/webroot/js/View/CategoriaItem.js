R$.View.ItemListadoMesas = Backbone.View.extend({

    tagName:  "button",
    
    events: {
        "click": "select"
    },
    
    initialize: function () {
        var self = this;
        this.listenTo(R$.app, 'categoria:select', function() {self.$el.hide()});
        this.listenTo(R$.app, 'categoria:select.id'+this.model.get('id'), function() {self.$el.show()});
    },
 
    select: function () {
        R$.app.set('categoria', this.model)
    },
    
    
    render: function () {
        
    }

});
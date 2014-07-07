App.View.ItemListadoMesas = Backbone.View.extend({

    tagName:  "button",
    
    events: {
        "click": "select"
    },
    
    initialize: function () {
        var self = this;
        this.listenTo(App.app, 'categoria:select', function() {self.$el.hide()});
        this.listenTo(App.app, 'categoria:select.id'+this.model.get('id'), function() {self.$el.show()});
    },
 
    select: function () {
        App.set('categoria', this.model)
    },
    
    
    render: function () {
        
    }

});
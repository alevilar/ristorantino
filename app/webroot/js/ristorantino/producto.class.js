
var Producto = function(){
    return this.initialize(arguments);
};

Producto.prototype ={
	  
	id : 0,
	name : "",
        
        initialize: function(idOrData, name){
            if ( typeof id == 'object') {
                return ko.mapping.fromJS(idOrData, {}, this);
            } else {
                this.id = id || 0;
                this.name = name || '';
            }
        }
}


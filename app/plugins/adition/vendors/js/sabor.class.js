Risto.Adition.sabor = function(jsonData){
    return this.initialize(jsonData);
}

Risto.Adition.sabor.prototype = {
     name: '',
     Categoria: [],

     initialize: function(jsonData){
        for (var i in jsonData){
                this[i] = jsonData[i];
        }
        return this;
    },
    
    
    seleccionar: function() {
        Risto.Adition.adicionar.currentMesa().currentComanda().agregarSabor( this );
        return true;
    },
    
    hrefSegunSabor: function(){
        if ( this.Categoria.Sabor.length > 0 ) {
            console.info("quiero este");
            return 'page-sabores';
        }
        return '#';
    }
 }
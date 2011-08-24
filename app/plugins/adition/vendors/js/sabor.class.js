Risto.Adition.sabor = function(jsonData){
    
    this.initialize(jsonData);
    
    return this;
}

Risto.Adition.sabor.prototype = {
     name: '',
     Categoria: [],
     precio: 0,
     model: 'DetalleSabor',

     initialize: function(jsonData){
        for (var i in jsonData){
                this[i] = jsonData[i];
        }
        this.sabor_id = this.id;
        return ko.mapping.fromJS({}, {} , this);
    },
    
    
    seleccionar: function(e) {
        $(e.currentTarget).addClass('ui-btn-active');
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
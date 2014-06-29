/*--------------------------------------------------------------------------------------------------- Risto.Adicion.sabor
 *
 *
 * Clase Sabor, depende de Productos
 */
Risto.Adition.sabor = function(jsonData){
    
    this.initialize(jsonData);
   
    
    return this;
}

Risto.Adition.sabor.prototype = {
     name: '',
     Categoria: [],
     precio: 0,
     model: 'DetalleSabor',
     cant: 0,
     
     cantSeleccionada: function(val){
        if (val) {
            switch (val) {
                case 'sum':
                    this.cant++;
                    break;
                case 'init':
                    this.cant = 0;
                    break;
            }

        }
        return this.cant;
     },
    

     initialize: function(jsonData){
        this.cantSeleccionada('init');
        for (var i in jsonData){
                this[i] = jsonData[i];
        }
        this.sabor_id = this.id;
        return ko.mapping.fromJS({}, {} , this);
    },
    
    
    seleccionar: function(e) {
        e.preventDefault();
//        $(e.currentTarget).addClass('ui-btn-active');
        if ( this.cantSeleccionada() > 0 ){
            Risto.Adition.adicionar.currentMesa().currentComanda().sacarSabor( this ); 
            this.cantSeleccionada('init');
             $(e.currentTarget).removeClass('ui-btn-active');
            return false;
        } else {
             $(e.currentTarget).addClass('ui-btn-active');
            Risto.Adition.adicionar.currentMesa().currentComanda().agregarSabor( this ); 
            this.cantSeleccionada('sum');
            return true;
        }
        
    },
    
    hrefSegunSabor: function(){
        if ( this.Categoria.Sabor.length > 0 ) {
            return 'page-sabores';
        }
        return '#';
    }
 }
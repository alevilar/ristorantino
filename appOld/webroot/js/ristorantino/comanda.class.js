/***
 * 
 * 
 * 
 * CLASE ABSTRACTA
 * 
 * 
 * 
 * 
 */
(function($){
    
    
var Sabor = function(id, name) {
    id: 0,
    name: '',
    cant: 0
}    
    
var Producto = {
    id      : 0, // id del producto
    name    : '', // nombre del producto
    cant    : 0, // cantidad de este producto seleccionado
    sabores : [], // listado de ID's de sabores
    
    agregarSabor: function() {
        
    }
}
    
    
var Comanda = function(){
    this.initialize();
};
	
		
/**
 *  En esta clase que arma la comanda con cada producto sque se le va haciendo click
 */
Comanda.prototype = {
	  
    productos : [], // list de Producto
    mesa: {},
    mozo: {},
    prioridad: false, // indica la prioridad de la comanda, en caso de "true" la comanda saldra impresa con el mensaje "PRIORIDAD"
    imprimir: true, // indica si ademas de guardarla hay que imprimirla. Si se coloca false solo guarda en BBDD
    observacion: "", // un texto escrito por el mozo para ser impreso junto a la comanda
    
    initialize: function() {
        this.productos = new Array();
        this.mesa = adicion.currentMesa();
        this.mozo = adicion.currentMozo();        
    },
	
    /**
     *  Envia la comanda para guardar
     *    
     */    
    save: function(){
        
    },
	  
	  
	  	  
    /**
    * Agrega un producto a la comanda
    * @param producto_agregar es el JSON del producto
    * @return integer la cantidad de productos (distintos) que hay en la comanda
    */
    add: function(producto) {
        
        prod_busq = this.buscar(producto);
		  
        if (prod_busq == null)
        {   // si no estaba en la coleccion lo meto
			  
            //si esta seleccionada la opcion producto como "entrada" entonces el producto es una entrada
            producto.entrada = this.entrada;
            this.__agregarProducto(producto);
        }
        else{ // ya estaba en la coleccion , asqiue solo le incremento el valor cantidad
            prod_busq.sumar();
            prod_busq.entrada = this.entrada;
        }

        this.actualizarComanda();
        return this.productos.length;
        
    },
    
    /**
    * 
    * me agrega un producto a la  comanda
    * 
    * @param Producto producto es el objeto producto qe quiero agregar
    */
    addProduct: function(producto){
        var prod_busq = new ProductoComanda();
		  
        prod_busq = this.buscar(producto);
		  
        if (prod_busq == null)
        {   // si no estaba en la coleccion lo meto
			  
            //si esta seleccionada la opcion producto como "entrada" entonces el producto es una entrada
            producto.entrada = this.entrada;
            this.__agregarProducto(producto);
        }
        else{ // ya estaba en la coleccion , asqiue solo le incremento el valor cantidad
            prod_busq.sumar();
            prod_busq.entrada = this.entrada;
        }

        this.actualizarComanda();
        return this.productos.length;
    },
    

      /**
       * agrega un producto en la cola deproductos y le incrementa en 1 la cantidad
       * @param producto
       * @return
       */
      __agregarProducto: function(producto)
      {		  
              this.productos.push(producto);
              producto.sumar();
      },


      __restarProducto: function(producto){
              producto.restar();
      },

      restar: function(prod) {
              // @var prod_busq ProductoComanda
              prod_busq = this.buscar(prod);

              if (prod_busq != null){ // si estaba lo resto
                      this.__restarProducto(prod_busq);
              }

              this.actualizarComanda();
              return this;
      },

            /**
             * 
             *  busca el producto por su id, si lo encuenta devuelve el producto
             *  si no encuentra nada devuelve null
             *  @params producto es el objeto producto
             */
            buscar: function(producto)
            {			 
              //todo esto hay que hacerlo por culpa de los sabores	
              prod = this.productos.find(function(p)
              {	  
                      //primero evaluo en baso a si son productos con sabor o sin sabor
                      if (p.esProductoConSabor() != producto.esProductoConSabor()){	
                              return false;
                       }

                      // si tienen distinto ID ya fue.... son distintos.
                      if (p.id != producto.id) return false; 


                      // si es producto SIN sabor, y el ID es igual.. etonces es el mismo producto
                      if (!p.esProductoConSabor()){
                              if (p.id == producto.id) return true;				  
                      }	

                      // caso contrario, si son productos con sabor, el id tiene que ser igual, pero tambien
                      // tienen que conincidir los sabores para que sean el mismo producto
                      else{				 
                             //si son 
                                    if (p.saboresSeleccionados.length != producto.saboresSeleccionados.length ) return false;

                                    var valor = true;
                                    p.saboresSeleccionados.each(function(s){
                                            if(!producto.saboresSeleccionados.find(function(s2){return (s == s2)})){
                                                    valor = false;
                                                    return valor;
                                            }
                                    });
                      }

                      return valor;

              }.bind(this));

              if(prod){
                     return prod; 
              }else{ 
                      return null;
              }
            },


            contarProductoEnComanda: function(producto){
                    var contador = 0;
                    this.productos.each(function(p){
                            //console.info("estoy adentro del each e contarProducto: el id de p es: "+p.getId()+" el Id de producto es: "+producto.getId()+" el contador interno va por: "+contador);
                            if(p.getId() == producto.getId()) contador++;
                    });
                    //console.info("hay "+contador+" productos con el nombre: "+producto.getName());
                    return contador;
            }
    };

})(jQuery);
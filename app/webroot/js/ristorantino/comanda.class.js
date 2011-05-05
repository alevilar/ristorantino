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
var Comanda = function(varMozo){
    this.mozo = varMozo;
};

	
		
/**
 *  En esta clase que arma la comanda con cada producto sque se le va haciendo click
 */
Comanda.prototype = {
	
	  
    productos : [],

    // esla ventana que contiene a la vista correspondiente a la comanda
    window : null, 

	  
	  
	  
	  setWindow: function(contenedorWindow){
		  this.window = contenedorWindow;
	  },
	  
	  /**
	   * pr lo general este metodo modifica la vista, ionsertando LI x cada producto y con la cantidad actualizada
	   */
	  actualizarComanda: function(){},
	  
	 
	  resetearComanda: function(varMozo, varMesa){
		  this.productos = new Array();
		  this.mesa = varMesa;
		  this.mozo = varMozo;        
	  },
	  	  
	  
	  /**
	   * envia la comanda usando ajax para que PHp la procese, guarde todo en BD y mande a imprimir la comanda
	   * 
	   * devuelve true o false si el usuario hizo OK al confirm dialog
	   */
	  guardarComanda: function(){
	  },
	  
	  /**
	   * envia la comanda usando ajax para que PHp la procese, guarde todo en BD y mande a imprimir la comanda
	   * @param boolean imprimir, me dice si es paraimprimir o no
	   */
	  enviarComanda: function(imprimir){
	  },
	  	  
	  
	  
	  	  
	  /**
	   * Agrega un producto a la comanda
	   * @param producto_agregar es el JSON del producto
	   * @return integer la cantidad de productos (distintos) que hay en la comanda
	   */
	  	add: function(producto_agregar) {
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
		  /*
		  var producto = new ProductoComanda();
		  //covierto el JSON en productoComanda
		  producto.copiar(prod);
		*/
		  var prod_busq = new ProductoComanda();
	  
		  prod_busq = this.buscar(prod);
		  
		  if (prod_busq != null){ // si estaba lo resto
			  this.__restarProducto(prod_busq);
		  }

		  this.actualizarComanda();
		  return this.productos.length;
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


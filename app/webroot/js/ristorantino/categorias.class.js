
var Categorias = Class.create();
	

Categorias.prototype = {	
		
		/**
		 * recibe
		 * @var JSon varArbolCategorias recibe un listado de productos y categorias
		 */
	  initialize: function(varArbolCategorias) {
	    this.arbolCategorias = varArbolCategorias;
	    this.categoriaRoot = Object.clone(this.arbolCategorias.Categoria);
	    this.categoriaRoot.name = "INICIO";

	    this.currentCategoria = Object.clone(this.arbolCategorias.Categoria);

	    this.categoriaAnterior =  Object.clone(this.arbolCategorias.Categoria);
	    this.categoriaAnterior.name = "Anterior";
            
	    this.currentArbol = Object.clone(this.arbolCategorias);
	    this.actualizarCategorias(this.currentCategoria.id);

	  //var productosElegidos = new ListadoProductos();ç
	     
	    // /productos/buscar_por_nombre
	    this.urlBuscarPorNombre = null;
	},
	
/**
 * 
 * Con esta funcion arranca todo. Es la que tiene que llamar el evento ue quiero que me dispare algo cuando se hace click en el menù
 * 
 */
	  actualizarCategorias: function (categoria_id){
		//console.info("actualizarCategorias iniciando...");
		this.actualizarSubCategoriasDe(categoria_id);
		
		this.actualizarProductos();
	},


	actualizarProductos:function (){	
		$('productos-listado').update("");
		//console.info("actualizarProductos..::"+this.currentArbol.Categoria.name);
		
	 	if (this.currentArbol.Producto.length > 0)
	 	{
	 		this.currentArbol.Producto.each(function(e){ 
	 			e.sabores = new Array();
	 			if (this.currentArbol.Sabor.length > 0){
	 				e.sabores = this.currentArbol.Sabor;
		 		}

	 			this.construirLinkProducto(e,'productos-listado');
	 	 	}.bind(this));
	 	}
	},


	/**
	 * 
	 * Me busca un producto por su nombre sieimre y cuando el nombre sea mayor a 3 letras
	 * @param String productoNombre del producto
	 */
	buscarProductoNombre: function(productoNombre){
		if(productoNombre.length > 2){
			$('buscar-productos-listado').update("");
			//console.info("actualizarProductos..::"+this.currentArbol.Categoria.name);
			new Ajax.Request(this.urlBuscarPorNombre+"/"+$F('buscador-producto-nombre')+".json", {
				  method: 'get',
                                  onFailure: function(){
                                      mensajero.error("Error al buscar por nombre");
                                  },
				  onSuccess: function(transport) {
					   //var productosJSON = transport.headerJSON;
					   var productosJSON = eval(transport.responseText);
					  
					    productosJSON.each(function(p){
					    	this.construirLinkProducto(p.Producto,'buscar-productos-listado');
					    }.bind(this));
				  }.bind(this)
				});
		}
	},

/**
 * 
 *  me construye los links que se van a meter en algun lado maneja obtejos que tengan atributos llamados 'id' y 'name'
 *
 * categoria es el Objeto categoria que devuelve el phop con json
 * divContenefdor, es el lugar donde se van a meter los links
 * prefijo  es el nombre que se le va a poner a cada link como id, es el prefijo, por ejemplo "categoria_"
 */
	construirLinkCategoria: function (categoria, divContenedor){
		var li = new Element('li');
		var a = new Element('a', { 
			  'class': 'leta-chica boton categorias', 
			  'href': '#categoria-'+categoria.id, 
			  'id': "categoria-"+categoria.id,
			  'onclick': 'manejadorCategorias.actualizarCategorias('+categoria.id+');return false'
		}).update(categoria.name);
		$(divContenedor).appendChild(li).appendChild(a);
	},



	/**
	 * 
	 *  me construye los links que se van a meter en algun lado maneja obtejos que tengan atributos llamados 'id' y 'name'
	 *
	 * producto es el Objeto producto  que devuelve el phop con json
	 * divContenefdor, es el lugar donde se van a meter los links
	 * prefijo  es el nombre que se le va a poner a cada link como id, es el prefijo, por ejemplo "categoria_"
	 */
	construirLinkProducto: function (producto, divContenedor)
	{
		var li = new Element('li');
	
		//si el producto no tiene sabores
		var pasoAca = false;
		if(producto.sabores){
			if(producto.sabores.length > 0)
			{
				//producto.id = Math.random()*50000;
				var a = new Element('a', { 
					  'class': 'boton letra-chica productos-con-sabores', 
					  'href': '#producto-'+producto.id, 
					  'id': "producto-"+producto.id,
					  'onclick': "return false;"
				}).update(producto.name);
				a.observe('click',adicion.comanda.seleccionarSabores.bind(adicion.comanda,producto));
				pasoAca = true;
			}
		}
		
		if(!pasoAca){
			var a = new Element('a', { 
				  'class': 'boton letra-chica productos', 
				  'href': '#producto-'+producto.id, 
				  'id': "producto-"+producto.id,
				  'onclick': "adicion.comanda.add('"+Object.toJSON(producto)+"');return false;"
			}).update(producto.name);
		}	

		$(divContenedor).appendChild(li).appendChild(a);
	},

	

	/**
	 * bàsicamente lo que hace esto es amar el menu de navegacion de categorias
	 * y mostrar nevamente el nuevo menu eliminando el anterior
	 */
	actualizarSubCategoriasDe: function (categoria_id){
	
		var arbolito = new Array();
		//console.info("------------------------------------------------");
		arbolito = this.buscaCategoria(this.arbolCategorias,categoria_id);
		//console.info("------------------------------------------------");
		
		this.categoriaAnterior = Object.clone(this.currentCategoria);
		this.categoriaAnterior.name = "Anterior";
		this.currentCategoria = arbolito.Categoria;
		this.currentArbol = arbolito;
	
		//console.info("Mirando arbol de la categoria: "+this.currentArbol.Categoria.name);
		//console.debug(this.currentArbol);
	
		// si no hay subcategorias terminar ahi y no actualizar porque se borran todos los links del menu
		if (arbolito.length < 1) return 0;
	
		
		$('categorias-listado').update("");
                
		//contruyo ellink de la categoria ROOT, este va siempre
		this.construirLinkCategoria(this.categoriaRoot,'categorias-listado' );
	
		//contruyo ellink de la categoria anterior, este va siempre y cuando no sea igual al root
		if (this.categoriaAnterior.id != this.categoriaRoot.id){
			this.construirLinkCategoria(this.categoriaAnterior,'categorias-listado' );
		}
		// creo los links para cada Sub categoria
		if(typeof arbolito.Hijos != "undefined" ){		
			arbolito.Hijos.each(function(h){
                            if (h != false){
				this.construirLinkCategoria(h.Categoria, 'categorias-listado');
                            }
			}.bind(this));
		}
		return 1;
	
	},
	

	/**
	 * 
	 * Este mètodo es pesadito. busca las categorias recursivamente y me devuelve el subarbol que contiene a la categoria buscada
	 * si no encuentra nada retorna 0
	 * si encuentra devuelve el subarbol 
	 * 
	 */
	buscaCategoria: function (arbol, categoria_id){
			
		if (arbol.Categoria.id == categoria_id){	
			//console.info("enconytro al id "+categoria_id+" esta devolviendo el arbol");
			return arbol;
		}
	
		if (typeof arbol.Hijos == "undefined"){
			//console.info("no tiene hijos");
			 return 0; //no tiene hijos asique no puedo buscar nada mas
		}
	
		var arbolaux = 0;
		
		for(var i=0;i<arbol.Hijos.length;i++){
			//console.info("Leyendo Hijo "+i+" de categoria : "+arbol.Categoria.id);
			arbolaux = this.buscaCategoria(arbol.Hijos[i],categoria_id);
			if (arbolaux == 0){
				//console.info("aca no estaba la categoria "+categoria_id+" actualmente estoy en la categoria: "+arbol.Categoria.id+" y el indice del FOR es "+i);
				continue;
			}
			else{
				//console.info("aca encontre algo");
				return arbolaux;
			}
			//console.info("finalizò la vuelta de este for, numero "+i);
		}
		//console.info("termino la funcion sin que pase nada, llego hasta el final, no se si es bueno esto");
		return 0;
	}



}



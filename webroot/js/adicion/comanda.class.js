
/**
 *  En esta clase que arma la comanda con cada producto sque se le va haciendo click
 */
var Comanda = Class.create({
	
	  initialize: function(varMozo, varMesa) {
	    this.productos  = new Array(); 
	    this.mesa = varMesa;
	    this.mozo = varMozo;
	    
	    
	    $('content').appendChild(new Element('div',{'id': 'comanda', 'class': 'menu-vertical'})).appendChild(new Element('H1').update("Comanda"));
	    $('comanda').appendChild(new Element('ul',{'id':'comanda-ul'}));
	    $('comanda').hide();
	    
	    
	  },
	  
	  resetearComanda: function(varMozo, varMesa){
		  this.productos = new Array();
		  this.mesa = varMesa;
		  this.mozo = varMozo;
		  $('comanda-ul').update(""); // le vacio el contenido
		  $('comanda').hide();
          
	  },
	  
	  
	  /**
	   * 
	   * Este inserta los productos en la comanda y los muestra por pantalla
	   * 
	   */
	  actualizarComanda: function(){
		  $('comanda-ul').update('');
		  
		  $('comanda-ul').appendChild(new Element('a', {'class':'boton','href': '#EnviarComanda','onClick': 'comanda.enviarComanda(); return false;'})).update("Mandar Comanda");
		  
		  this.productos.each(function(p){
			  var li = new Element('li');
			  var a = new Element('a',{'id':'comanda-producto-'+p.getId()}).update(p.getCantidad()+" --| "+p.getName());
			  li.appendChild(a);
			  $('comanda-ul').appendChild(li);
		  });
		 
	  },

	  
	  /**
	   * envia la comanda usando ajax para que PHp la procese, guarde todo en BD y mande a imprimir la comanda
	   */
	  enviarComanda: function(){
		  console.info("Se enviò una comanda paraimprimir, la del mozo "+this.mozo.id+" mesa "+this.mesa.id);
		  //armo el formulario que voy  a enviar
		  var formulario = new Element('form', {'name':'Comanda', 'action':'http://localhost/ristorantino/Comandas/add/mesa_id:'+this.mesa.id+'/mozo_id:'+this.mozo.id});
		 		  
		  var count = 0; 
		  this.productos.each(function(p){
			  formulario.appendChild(new Element('input', {'name': 'data[Comanda]['+count+'][producto_id]'}).setValue(p.getId()));
			  formulario.appendChild(new Element('input', {'name': 'data[Comanda]['+count+'][cant]'}).setValue(p.getCantidad()));
			  formulario.appendChild(new Element('input', {'name': 'data[Comanda]['+count+'][mesa_id]'}).setValue(this.mesa.id));
			  count++;
		  }.bind(this));
		  
		  
		  console.info("form serializado:::"+formulario.serialize());
		  
		  formulario.request({
			  	parameters: formulario.serialize(),
		        onFailure: function() {
			  		alert("Fallò, no se ha impreso la comanda. Por favor ingrese los datos nuevamente") ;
			  		console.info("Fallo el ajax para enviar la comanda");			  	
		  		},
		        onSuccess: function(t) {
		            this.resetearComanda(this.mozo, this.mesa); //esto ademas de resetar los datos de la comanda, oculta el DIV "comanda"
		            $('productos-contenedor').hide();
		            console.info("se mandò a imprimir y se resetearon los datos de la comanda");	
		            alert('Se mandò a imprimir la comanda');
		        }.bind(this)
		    });
	  },
	  
	  

	  	add: function(prod) {
		  var producto = new ProductoComanda(eval('(' + prod + ')'));
		  var prod_busq = new ProductoComanda();
	  
		  prod_busq = this.buscar(producto);
		  if (prod_busq == null){ // si no estaba en la coleccion lo meto
			  this.productos.push(producto);
			  console.info("se agregò un producto a la comanda. El producto: "+producto.getName()+" ..... y actualmente hay "+this.productos.length+" productos en la coleccion");
			  producto.sumar();
		  }
		  else{ // ya estaba en la coleccion , asqiue solo le incremento el valor cantidad
			  prod_busq.sumar();
			  console.info("ya estaba, solo le incremente el valor");
		  }
		  this.actualizarComanda();
		  return this.productos.length;
	  },

	  	/**
	  	 * 
	  	 *  busca el producto por su id, si lo encuenta devuelve el producto
	  	 *  si no encuentra nada devuelve null
	  	 *  @params producto es el ID del producto
	  	 */
		buscar: function(producto){
		  console.info("hay esta cantidad de productos en la coleccion "+this.productos.length);
			for(var i = 0; i<this.productos.length;i++){
				console.info("yo estoy buscando "+this.productos[i].getId()+" y me vino "+producto.getId());
				if(this.productos[i].getId() == producto.getId()) return this.productos[i];
			}
			return null;
	  	},
	  
	  
	  	contarProductoEnComanda: function(producto){
	  		var contador = 0;
	  		this.productos.each(function(p){
	  			console.info("estoy adentro del each e contarProducto: el id de p es: "+p.getId()+" el Id de producto es: "+producto.getId()+" el contador interno va por: "+contador);
	  			if(p.getId() == producto.getId()) contador++;
	  		});
	  		console.info("hay "+contador+" productos con el nombre: "+producto.getName());
	  		return contador;
	  	}
	});


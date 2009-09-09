	
		
/**
 *  En esta clase que arma la comanda con cada producto sque se le va haciendo click
 */
var ComandaSacar = Class.create(Comanda ,{
	
	  /**
	   * envia la comanda usando ajax para que PHp la procese, guarde todo en BD y mande a imprimir la comanda
	   */
	  enviarComanda: function(){
		  //armo el formulario que voy  a enviar
		  var formulario = new Element('form', {'name':'ComandaSacar', 'action':'http://localhost/ristorantino/DetalleComandas/sacarProductos/mesa_id:'+this.mesa.id+'/mozo_id:'+this.mozo.id});
		 	
		  //voy armando el formulario y generando el $this->data[]
		  
		  // le agrego los productos con su rspectiva catidad
		  var count = 0; 
		  this.productos.each(function(p){
			  formulario.appendChild(new Element('input', {'name': 'data[DetalleComanda]['+count+'][producto_id]'}).setValue(p.id));
			  formulario.appendChild(new Element('input', {'name': 'data[DetalleComanda]['+count+'][cant]'}).setValue(p.getCantidad()));
			  formulario.appendChild(new Element('input', {'name': 'data[DetalleComanda]['+count+'][mesa_id]'}).setValue(this.mesa.id));
			  formulario.appendChild(new Element('input', {'name': 'data[DetalleComanda]['+count+'][comanda_id]'}).setValue(0));
			  count++;
		  }.bind(this));
		  
		  
		  console.info("form serializado:::"+formulario.serialize());
		  
		  formulario.request({
			  	parameters: formulario.serialize(),
		        onFailure: function() {
			  		alert("Falló, no se ha impreso la comanda. Por favor ingrese los datos nuevamente") ;
			  		console.info("Fallo el ajax para enviar la comanda");			  	
		  		},
		        onSuccess: function(t) {
		            sacarItemWindow.hide();
		            
		            mensajero.show("se quitaron los productos correctamente,actualice la mesa para visualizar los cambios");
		            
		        }.bind(this)
		    });
	  },
	  
	  
	  /**
	   * Agrega un producto a la comanda
	   * @param producto_agregar es el JSON del producto
	   * @return integer la cantidad de productos (distintos) que hay en la comanda
	   */
	  	add: function(producto_agregar) {
		  var producto = new ProductoComanda();
		  //covierto el JSON en productoComanda
		  producto.copiar(producto_agregar);
				  
		  var prod_busq = new ProductoComanda();
	  
		  prod_busq = this.buscar(producto);
		  
		  console.info("esto es lo que encontró");
		  console.debug(prod_busq);
		  if (prod_busq == null){ // si no estaba en la coleccion lo meto	
			  this.__agregarProducto(producto);
			  console.info("se agregò un producto a la comanda. El producto:"+producto.getName()+"..... y actualmente hay "+this.productos.length+" productos en la coleccion");
		  }
		  else{ // ya estaba en la coleccion , asqiue solo le incremento el valor cantidad
			  prod_busq.restar();
			  console.info("ya estaba, solo le incremente el valor");
		  }

		  adicion; //global
		  this.actualizarComanda(adicion.currentMesa.productos);
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
		  producto.restar();
	  },
	  
	 
	  
	  
	  /**
	   * currentMesa
	   * Este inserta los productos en la comanda y los muestra por pantalla
	   * 
	   */
	  actualizarComanda: function(productos){	 
		  	$("sacar-item-ul").update();
		  	
			if(typeof productos == 'object')
			{			
				console.info("++++++++++++++++++++++++++>>>>>>>>>>>>>>>>>>>>");
				console.debug(productos);
				productos.each(function(p){		
						var li = new Element('li',{'id':'sacar-item-'+p.id});
						
						var prod_aux = new Producto();
						prod_aux = p;
						var a = new Element('a',{
							'href':'#Sacar',
							'onclick':"adicion.comandaSacar.add('"+Object.toJSON(prod_aux)+"')",
							'class':'boton'});
						a.wrap(li);
						
						var prod_buscado = this.buscar(p);
						
						var cantidad = parseInt(p.cantidad);
						
						if (prod_buscado != null){
							cantidad += prod_buscado.cantidad;
							if(cantidad<0){
								cantidad = 0;
							}
						}
						
						a.update(cantidad+"-| "+p.name);
						$("sacar-item-ul").appendChild(li);
				}.bind(this));	
			}
			return false;
			
	  }	  

	});


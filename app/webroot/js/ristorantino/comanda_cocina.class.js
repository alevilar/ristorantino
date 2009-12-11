var ComandaCocina = Class.create(Comanda);

	
		
/**
 *  En esta clase que arma la comanda con cada producto sque se le va haciendo click
 */
ComandaCocina = Class.create(Comanda, {
	
		
	  initialize: function($super,varMozo) {
	
		$super(varMozo);	
		
		this.urlEnviarComanda = null;

	    //@ GLOBAL comandaCocinaWindow: es la ventana que cree en el  elemento comanda_cocina
	    this.setWindow(comandaCocinaWindow);
	    
	    
	    // este atributpo s el producto mientras se le van agregando los distintos sabores
	    // es una variable de estado intermedio
	    this.productoCreandoSabores = new ProductoComanda();
	    // es la ventana de seleccion de sabores
	    this.winSeleccion = null;
	    
		/**
	     * este atributo sirve para identificar si la comanda va con prioridad o no
	     * @var prioridad default false = 0
	     */
	    this.prioridad = 0;
	    
	    
	    
	    
	    /**
	     * es un boolean que nos dice si los productos seleccionados son entradas o no 
	     */
	    this.entrada = false;
	    
	  },
	  
	  
	  
	  /**
	   * Pone la prioridad en 0 cer nuevamente 
	   */
	  resetPrioridad: function(){
			  this.prioridad = 0;
			  $("comanda-prioridad-titulo").update('Comanda');
	  },

	  
	  
	  /**
	   * Cambia la prioridad de la comanda
	   */
	  tooglePrioridad: function(){
		  if(this.prioridad == false){
			  this.prioridad = 1;
			  $("comanda-prioridad-titulo").update('Comanda Prioridad');
		  }
		  else{
			  this.prioridad = 0;
			  $("comanda-prioridad-titulo").update('Comanda');
		  }
	  },
	  
	  
	  
	  
	  resetearComanda: function($super, varMozo, varMesa){
		  $super(varMozo, varMesa);
			  this.resetPrioridad();
			  this.resetObservacion();
			  this.resetEntradas();
			  $('comanda-ul').update(""); // le vacio el contenido
			 
		 
		            
	  },
	  
	  
	  
	  
	  /**
	   * 
	   * muestra el textarea para escribir una observacion.
	   * este se ejecutra al hacer clic ek en boton de observaciones de la comanda
	   */
	  agregarObservacion: function(){
		  if($('productos-contenedor').visible()){
			  $('comanda-observacion-div').show();
			  $('productos-contenedor').hide();
		  }
		  else{
			  $('comanda-observacion-div').hide();
			  $('productos-contenedor').show();
		  }
	 },
	 
	 resetObservacion: function(){
		 $('comanda-observacion').setValue("");
		 $('comanda-observacion-div').hide();
		 $('productos-contenedor').show();
	 },
	  
	  
	  /**
	   * es la funcion que llama el boton qu activa las entradas
	   * 
	   */
	  seleccionarEntradas: function(){
		  if(this.entrada){
			  this.entrada = false;
			  $('btn-seleccionar-entradas').removeClassName('boton-apretado');
		  }
		  else{			  
			  this.entrada = true;
			  $('btn-seleccionar-entradas').addClassName('boton-apretado');
		  }
	  },
	  
	  resetEntradas: function(){
		  this.entrada = false;
		  $('btn-seleccionar-entradas').removeClassName('boton-apretado');
	  },
	  
	  
	  
	  /**
	   * currentMesa
	   * Este inserta los productos en la comanda y los muestra por pantalla
	   * 
	   */
	  actualizarComanda: function(){
		  $('comanda-ul').update('');
		 
		  this.productos.each(function(p){
			  if(p.cantidad > 0){
				  var li = new Element('li');
				  
				  
				  // si el producto esta marcado como entrada, entonces le pongo la clase para marcarlo
				  var claseEntrada = ''; 
				  if(p.entrada){
					  claseEntrada = " producto-es-entrada ";
				  }
				  if(p.saboresSeleccionados.legth == 0){ // si no es del tipo de productos que tiene sabores hacer esto
					  var a = new Element('a',{
						  			'id':'comanda-sacar-producto-'+p.getId(),
						  			'class': "boton-ancho-fijo "+claseEntrada,
						  			//'onClick': "adicion.comanda.restar('"+Object.toJSON(p)+"')"
						  			'onClick': "return false;"
						  			}
					  ).update(p.getCantidad()+" --| "+p.getName());
				  }
				  else{ // si tiene distintos sabores hacer esto
					  var a = new Element('a',{
				  			'id':'comanda-sacar-producto-'+p.getId(),
				  			'class': 'producto-con-sabores boton-ancho-fijo '+claseEntrada,
				  			//'onClick': "adicion.comanda.restar('"+Object.toJSON(p)+"')"
				  			'onClick': "return false;"
				  			}
					  );
					 
					  var nombre = p.getName()+" :";
					  p.saboresSeleccionados.each(function(s){
						  nombre += " "+s.name;
					  });
					  
					  a.update(p.getCantidad()+" --| "+nombre);
				  }
				  a.observe('click',adicion.comanda.restar.bind(adicion.comanda,p));
				  li.appendChild(a);
				  $('comanda-ul').insertBefore(li, $('comanda-ul').firstChild);

				  //$('comanda-ul').insertBefore(li);
			  }
		  });
		 
	  },

	  
	 
	  imprimirComanda: function(){
		  var imprimir = 1;
		  this.enviarComanda(imprimir);
	  },
	  
	  
	  /**
	   * envia la comanda usando ajax para que PHp la procese, guarde todo en BD y mande a imprimir la comanda
	   * 
	   * devuelve 1 o 0 si el usuario hizo OK al confirm dialog
	   */
	  guardarComanda: function(){
		  if(window.confirm("¿realmente desea guardar la comanda SIN enviarla a imprimir?")){
			var imprimir = 0; // no imprimir solo guardar
		  	this.enviarComanda(imprimir);
		  	return 1;
		  }
		  return 0;
	  },
	  
	  /**
	   * envia la comanda usando ajax para que PHp la procese, guarde todo en BD y mande a imprimir la comanda
	   */
	  enviarComanda: function(imprimir){
		  //armo el formulario que voy  a enviar
		  																	//URL = DetalleComandas/add
		  var formulario = new Element('form', {'name':'Comanda', 'action':this.urlEnviarComanda+'/mesa_id:'+this.mesa.id+'/mozo_id:'+this.mozo.id});
		 	
		  //voy armando el formulario y generando el $this->data[]
		  formulario.appendChild(new Element('input', {'name': 'data[imprimir]'}).setValue(imprimir)); //dice si hay que mandar a imprimr o solo guardar los datos
		  
		  
		  formulario.appendChild(new Element('input', {'name': 'data[Comanda][prioridad]'}).setValue(this.prioridad)); //avisa si la comanda va con prioridad o no
		  formulario.appendChild(new Element('input', {'name': 'data[Comanda][mesa_id]'}).setValue(this.mesa.id));
		  formulario.appendChild(new Element('input', {'name': 'data[Comanda][observacion]'}).setValue($F('comanda-observacion')));
		  // le agrego los productos con su rspectiva catidad
		  var count = 0; 
		  this.productos.each(function(p){
			  if(p.cantidad > 0){
				  formulario.appendChild(new Element('input', {'name': 'data['+count+'][DetalleComanda][producto_id]'}).setValue(p.getId()));
				  formulario.appendChild(new Element('input', {'name': 'data['+count+'][DetalleComanda][cant]'}).setValue(p.getCantidad()));
				  
				  var prod_entrada = 0;
				  if(p.entrada){
					  prod_entrada = 1;
				  }
				  formulario.appendChild(new Element('input', {'name': 'data['+count+'][DetalleComanda][es_entrada]'}).setValue(prod_entrada));
				  formulario.appendChild(new Element('input', {'name': 'data['+count+'][DetalleComanda][comandera_id]'}).setValue(p.getComanderaId()));
				  	  
				  var cont2 = 0;
				  p.saboresSeleccionados.each(function(sabor){
	//				  formulario.appendChild(new Element('input', {'name': 'data[Datos]['+count+'][DetalleSabor][detalle_comanda_id]'}).setValue(this.mesa.id));
					  formulario.appendChild(new Element('input', {'name': 'data['+count+'][DetalleSabor]['+cont2+'][sabor_id]'}).setValue(sabor.id));
					  cont2++;
				  });
				  
				  count++;
			  }
		  }.bind(this));
		  		  
		  formulario.request({
			  	parameters: formulario.serialize(),
		        onFailure: function() {
			  		alert("Falló, no se ha impreso la comanda. Por favor ingrese los datos nuevamente") ;
			  		//console.info("Fallo el ajax para enviar la comanda");			  	
		  		},
		        onSuccess: function(t) {
		            this.resetearComanda(this.mozo, this.mesa); //esto ademas de resetar los datos de la comanda, oculta el DIV "comanda"
		            
		            this.window.hide();
		            
		            //resetear la adicion
		            adicion.resetear();
		           
		            if(imprimir){
		            	mensajero.show("se mandó a imprimir una comanda");	
		            }else{
		            	mensajero.show("se guardó la comanda correctamnte");
		            }
		        }.bind(this)
		    });
	  },
	  

	  /**
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
	   * Agrega un producto a la comanda
	   * @param producto_agregar es el JSON del producto
	   * @return 
	   */
	  	add: function(producto_agregar) {
		  var producto = new ProductoComanda();
		  //covierto el JSON en productoComanda
		  producto.copiar(producto_agregar);
		  
		  return this.addProduct(producto);
		  
	  },
	  
	  
	  
	  guardarCambiosSeleccionSabores:function(){
		  var producto = this.productoCreandoSabores;		  
		 // producto.id = Math.random()*10000000000;
		  
		  //var prod_busq = new ProductoComanda();		  
		  /*
		  prod_busq = this.buscar(producto);
		  
		  if (prod_busq == null)
		  {   // si no estaba en la coleccion lo meto	
			  this.__agregarProducto(producto);
		  }
		  else{ // ya estaba en la coleccion , asqiue solo le incremento el valor cantidad
			  prod_busq.sumar();
		  }
		  

		  this.actualizarComanda();
		  */
		  this.addProduct(producto);
		  
		  this.winSeleccion.hide();
		  return this.productos.length;
	  },
	  
	  
	  /**
	   * Me abre la ventana que me muestra los distintos sabors para ser seleccionados
	   * 
	   * cuando hago click en un saor, éste pasa a formar parte de la comanda
	   */
	  seleccionarSabores:function(producto)
	  {
		  var temp = new ProductoComanda();
		//le hago un new para asegurarme que estoy creando un bojecto nuevo
		  // de esta manera el buscador me va a tirar siempre uno distinto para, por ejemplo cada ensalada
		  this.productoCreandoSabores = new ProductoComanda(); 
		  
		  this.productoCreandoSabores.convertirEnProductoComanda(producto);
		  var html = '';
		  this.winSeleccion = new Window({	className: "dialog", 
			  								width:700, 
			  								height:500, 
			  								resizable: true, 
			  								title: "Sabores", 
			  								//showEffect: Effect.show, 
			  								//hideEffect: Effect.hide, 
			  								draggable:true
		  });
		  
		  
		  var ul = new Element('ul',{'class':'menu-horizontal'});
		  // para cada sabor le construyo el link asi lo puedo seleccionar
		  this.productoCreandoSabores.sabores.each(function(sabor){
			  var li = new Element('li');
			  var a = new Element('a',{'href':'#seleccionarSabor','class':'boton-ancho-largo'});
			  a.update(sabor.name);
			  a.observe('click',adicion.comanda.productoCreandoSabores.agregarSabor.bind(adicion.comanda.productoCreandoSabores,sabor));
			  //a.observe('click',a.hide);
			  li.appendChild(a);
			  ul.appendChild(li);
		  });
		  
		  var li = new Element('li');
		  var a = new Element('a',{'href':'#seleccionarSabor','class':'btn-comando'});
		  a.update("- Guardar -");
		  a.observe('click',adicion.comanda.guardarCambiosSeleccionSabores.bind(this));
		  li.appendChild(a);
		  ul.appendChild(li);
		  
		  this.winSeleccion.content.appendChild(ul);
		  
		  this.winSeleccion.showCenter();
	  }
	  
	});


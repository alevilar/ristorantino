
var Mensaje = Class.create();


Mensaje.prototype ={
	
	/**
	 * 
	 * Le paso como parametro el contenedor donde se van a ir listando los mensajes.
	 * el contenedor geeralmente es algo del tipo 'div', o 'p'
	 */
	  initialize: function(nombre_contenedor_a_actualizar) {	
		  /****************************************************************************************
		   * 
		   * 			Atributos
		   * 
		   */		
			this.mensaje = ''; //texto del mensaje
			this.mensajeId = 0; // contenedor del mensaje generado dinamicamente con un random
			this.contenedor = null; // es el elemento contenedor, por ahora es un UL
	
			//es el id del contenedor donde se actualizaran y mostraran los mensajes
			this.contenedor_name = nombre_contenedor_a_actualizar;
			
			
			// 	---- Atributos correspondientes al mensaje de locading (cargando)		
			this.imageLoading = null; //url hacia la ubicacion de la imagen
			this.loadingID = null; // es el Id del contenedor generado dinamicamente con un random
				
			//este indica si fue inicializado y creado correctamente los elementos
			this.OK = false;
			
			
			/**************************************************************************************/
			
			
			Event.observe(window, 'load', function() {
				//genero el UOL
				var ul = new Element('ul', {'id': 'mensaje_superale'});
				$(nombre_contenedor_a_actualizar).appendChild(ul);
				
				
				var loadingLi = new Element('div',{'id': 'mensajes-loading'});
				$(nombre_contenedor_a_actualizar).appendChild(loadingLi);
				loadingLi.hide();
				
				this.contenedor = ul;
				this.OK = true;
			}.bind(this));
			
		
	  },
	  
	  setMensaje: function(mensaje){
		  this.mensaje = mensaje;
	  },
	  
	  setImageLoading: function(imageURL){
		  this.imageLoading = imageURL;
	  },
	  
	  isSetImageLoading: function(){
		  if(this.imageLoading){
			  return true;
		  }else{
			  return false;
		  }
	  },
	  
	  show: function(mensaje){
		  this.mensaje = mensaje;
		  if(this.OK) {
			  this.mensajeId = "msg-"+Math.random()*500;
			  console.info("mensaje generado con id= "+this.mensajeId);
			  var li = new Element('li', {'id':this.mensajeId});
			  li.update(this.mensaje);
			  this.contenedor.appendChild(li);
		  };
	  },
	  
	  
	  playLoading: function(mensaje)
	  {
		  if (this.loadingID == null) //si aun no se creó el elemento que contiene al loading, lo tengo que crear
		  {
			  if(this.OK) {
				  this.loadingID = "msg-"+Math.random()*500;
				  console.info("mensaje generado con id= "+ this.loadingID);
				  var li = new Element('li', {'id': this.loadingID});
				  
				  li.update('....cargando....');
				  if(this.isSetImageLoading()){
					  var img = new Element('img',{'src':this.imageLoading});
					  
					  li.appendChild(img);
				  }
				//  li.update('...cargando');
				  console.info("mostrando garabato");
				  console.debug(li);
				  this.contenedor.appendChild(li);
			  }
		  }else{ // si ya estaba creado el loadingID simplemente lo muestro
			  $(this.loadingID).show();
		  }
	  },
	  
	  stopLoading: function(mensaje){
		  if(this.loadingID != null){
			  $(this.loadingID).hide();
		  }
	  }
};
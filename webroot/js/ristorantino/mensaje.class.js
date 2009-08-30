
var Mensaje = Class.create();


Mensaje.prototype ={
	
	/**
	 * 
	 * Le paso como parametro el contenedor donde se van a ir listando los mensajes.
	 * el contenedor geeralmente es algo del tipo 'div', o 'p'
	 */
	  initialize: function(nombre_contenedor_a_actualizar) {	
			//es el id del contenedor donde se actualizaran y mostraran los mensajes
			this.contenedor_name = nombre_contenedor_a_actualizar;
			
			Event.observe(window, 'load', function() {
				//genero el UOL
				var ul = new Element('ul', {'id': 'mensaje_superale'});
				$(nombre_contenedor_a_actualizar).appendChild(ul);
				
				
				var loadingLi = new Element('div',{'id': 'mensajes-loading'});
				$(nombre_contenedor_a_actualizar).appendChild(loadingLi);
				loadingLi.hide();
				
				this.contenedor = ul;
			}.bind(this));
			
			this.mensaje = '';
			this.mensajeId = 0;
		
	  },
	  
	  setMensaje: function(mensaje){
		  this.mensaje = mensaje;
	  },
	  
	  show: function(mensaje){
		  this.mensaje = mensaje;
		  Event.observe(window, 'load', function() {
			  this.mensajeId = "msg-"+Math.random()*500;
			  console.info("mensaje generado con id= "+this.mensajeId);
			  var li = new Element('li', {'id':this.mensajeId});
			  li.update(this.mensaje);
			  this.contenedor.appendChild(li);
		  }.bind(this));
	  },
	  
	  showLoading: function(mensaje){
		  this.mensaje = mensaje;
		  Event.observe(window, 'load', function() {
			  var li = new Element('li');
			  li.update(this.mensaje);
			  this.contenedor.appendChild(li);
		  }.bind(this));
	  },
	  
	  hideLoading: function(mensaje){
		  this.mensaje = mensaje;
		  Event.observe(window, 'load', function() {
			  var li = new Element('li');
			  li.update(this.mensaje);
			  this.contenedor.appendChild(li);
		  }.bind(this));
	  }

};
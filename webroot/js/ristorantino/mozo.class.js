


var Mozo = Class.create({
	
	  initialize: function() {
		this.id;
		this.numero;
		this.nombre;	   	
	   	this.apellido;
	   	this.username;   
	   	this.mesas = new Array();
	    
	  },
	  
	  
	  getId: function() {
		   	return this.id;
	  },
	  setId: function(id) {
		   	this.id = id;		    
	  },
	  
	  getNombre: function() {
		   	return this.nombre;		    
	  },
	  setNombre: function(nombre) {
		   	this.nombre = nombre;
	  },
	  
	  getNumero: function() {
		   	return this.numero;		    
	  },
	  setNumero: function(numero) {
		   	this.numero = numero;		    
	  },
	  
	  getApellido: function() {
		   	return this.apellido;		    
	  },
	  setApellido: function(apellido) {
		   	this.apellido = apellido;		    
	  },
	  
	  getUsername: function() {
		   	return this.username;		    
	  },
	  setUsername: function(username) {
		   	this.username = username;		    
	  },
	  
	  setMesas: function(mesas) {
		   	this.mesas = mesas;		    
	  }



});
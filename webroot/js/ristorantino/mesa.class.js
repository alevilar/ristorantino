



var Mesa = Class.create({
	
		initialize: function() {		
			this.id;		   
		    this.numero;	    
			this.menu = 0;
			this.modified = 0;
			this.time_cerro_mesa = 0;
			this.time_cobro = 0;
			this.total;
			this.created;
				
			
			this.cliente = null;
			this.comensal = null;
			this.productos;
		    
		    
		},

		setId: function(id){
			this.id = id;
		},
		getId: function(){
			return this.id;
		},
		
		setComensal: function(comensal){
			this.comenzal = comensal;
		},
		getComensal: function(){
			return this.comensal;
		},
		
		setNumero: function(numero){
			this.numero = numero;
		},
		getNumero: function(){
			return this.numero;
		},
		
		setProductos: function(productos){
			this.productos = productos;
		},
		
		/**
		 * Me dice si esta mesa tiene setteado un cliente o no
		 * @return boolean
		 */
		tieneCliente: function(){
			var devolver = false;
			if(this.cliente){
				if(this.cliente.id){
					devolver = true;
				}
			}
			return devolver;
		},
		
		/**
		 * Me dice si esta mesa tiene setteado un menu
		 * @return boolean
		 */
		tieneMenu: function (){
			$('boton-menu').update('Menú');
			var devolver = false;			
			if(this.menu != 0 && this.menu){
					devolver = true;
					$('boton-menu').update('Menú x '+this.menu);
			}
			return devolver;
		}
		

});
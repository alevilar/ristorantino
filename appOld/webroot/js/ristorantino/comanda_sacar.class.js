
function ComandaSacar(varMozo){
    this.mozo = varMozo;
}

		
/**
 *  En esta clase que arma la comanda con cada producto sque se le va haciendo click
 */
var ComandaSacar = {
	
	   initialize: function($super,varMozo) 
	   {		
			$super(varMozo);	    

			// /DetalleComandas/sacarProductos
			this.urlEnviarComanda = null;
			
			
		    //@ GLOBAL sacarItemWindow: es la ventana que cree en el  elemento comanda_sacar
		    this.setWindow(sacarItemWindow);
		    
	  },
	  
	  /**
	   * Me resetea la comanda me pone el mozo y la mesa actual 
	   * para que yo pueda comenzar atrabar. En realidad es una especia de inicializacion
	   * @param Mozo objeto Mozo generalmente es un JSON que viene del controlador PHP
	   * @param Mesa objeto Mesa generalmente es un JSON ´ ´ ´ ´ ´ ´ ´ ´ ´ ´ ´ ´ ´  ´
	   */	  
	  resetearComanda: function(varMozo, varMesa){
		  this.mesa = varMesa;
		  this.mozo = varMozo;        
	  },
	
	  /**
	   * envia la comanda usando ajax para que PHp la procese, guarde todo en BD y mande a imprimir la comanda
	   */
	  enviarComanda: function(){
		  //armo el formulario que voy  a enviar
		  var formulario = new Element('form', {'name':'ComandaSacar', 'action':this.urlEnviarComanda+'/mesa_id:'+this.mesa.id+'/mozo_id:'+this.mozo.id});
		 	
		  //voy armando el formulario y generando el $this->data[]
		  var count = 0;
		  this.productos.each(function(p){
			  formulario.appendChild(new Element('input', {'name': 'data['+count+'][DetalleComanda][id]'}).setValue(p.id));
			  formulario.appendChild(new Element('input', {'name': 'data['+count+'][DetalleComanda][cant_eliminada]'}).setValue(p.getCantidadEliminada()));
			  count++;
		  });
		  
		  formulario.request({
			  	parameters: formulario.serialize(),
		        onFailure: function() {
			  		alert("Falló, no se ha impreso la comanda. Por favor ingrese los datos nuevamente") ;
		  		},
		        onSuccess: function(t) 
		        {
                            adicion.refrescarMesaView();
                            
		            this.window.hide();
		            
		            //resetear la adicion
		            //adicion.resetear();
		            
		            mensajero.show("se quitaron los productos correctamente,actualice la mesa para visualizar los cambios");    
		        }.bind(this)
		    });
	  },
	  
	   
	  
	  /**
	   * currentMesa
	   * Este inserta los productos en la comanda y los muestra por pantalla
	   * 
	   */
	  inicializarComanda: function(productos){	 
		  	$("sacar-item-ul").update();
		  	
		  	if(typeof productos == 'object')
			{
			  	// agrego todos los producto de la mesa a la comaandaSacar
			  	productos.each(function(p){		
					var psacar = new ProductoComanda();
					psacar.copiar(p);
			  		this.productos.push(psacar); 
			  	}.bind(this));	
		  	
			  	//ahora genero el link para cada producto
			  	this.productos.each(function(p){
			  		if(p.cantidadEnComanda()>0){
						var li = new Element('li',{'id':'sacar-item-'+p.id});
						var link = p.dameLink();
						link.wrap(li);
												
						$("sacar-item-ul").appendChild(li);
			  		}
				}.bind(this));	
			}
			return false;
			
	  }	  

	};


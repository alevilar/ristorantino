var Adicion = Class.create();

Adicion.prototype = {
	
		initialize: function(mozo, mesa) {
			
	
			this.currentMesa = mesa;
			this.currentMozo = mozo;
				
			this.cantidad_de_mesas = 0;

			
			/**
			 *  
			 *  Crear la comandera y el menu 
			 *  para el mozo actual y la mesa actual
			 *  
			 * @TODO hay que hacer que cuando el mozo no tiene mesa, que no me tirre error esto 
			 */
			this.comanda = null;  //este objeto se crea con el evento window onload
			Event.observe(window, 'load', function() {
				// creo la comanda y su vista
				this.comanda = new Comanda(this.currentMozo, this.currentMesa);		
				
				var menuDiv = new Element('div',{'id':'productos-contenedor'});
				$('contenedor-comandas').hide();
				$('contenedor-comandas').appendChild(menuDiv);
				
				// esto hace que se cargen las categorias y productos de productos-contenedor
				new Ajax.Updater(menuDiv, 'http://localhost/ristorantino/categorias/listar', { method: 'get', 'evalScripts' :true });
				
				//actualizo el numero de mesa en el DIV de arriba de todo
				this.actualizar_numero_mesa_div();
				
				
				// esto hace que que oculte de la vista cuando se hace click en la cabecera de la pagina, es para cerrar la ventana
				Event.observe('adicion-cabecera', 'click', function() {
					if ($('contenedor-comandas').visible()){
						$('contenedor-comandas').hide();
					}
				});

			}.bind(this));

			
		},
		
		setCurrentMozo: function(mozo){
			this.currentMozo = mozo;
			var cantidad_de_mesas = this.currentMozo.mesas.length;
		},
		
		setCurrentMesa: function(mesa){
			this.currentMesa = mesa;
		},

		//cambia de mesa
		cambiarMesa: function (mesaCambiar){			
			this.setCurrentMesa(mesaCambiar);
			this.comanda.resetearComanda(this.currentMozo, this.currentMesa);
			this.actualizar_numero_mesa_div();
			
		},	
		

	    
		/**
		* Esta funcion es para cuando yo abro una nueva mesa, me muestra el form input con un PAD numerico
		*/
		abrirMesa: function(){ 
			var ops = {
					howEffect: Element.show, 
					hideEffect: Element.hide, 
					//className: 'alphacube', 
					zIndex: 2000, 
					width:400, 
					height:400, 
					showProgress: false, 
					destroyOnClose: true
			};
			$('mesa-abrir').show();
			Dialog.info("<h1>Abrir Mesa</h1>"+$('mesa-abrir').innerHTML, ops);
			
			
			
			//NUMPAD ------------------------------------------------------		
			
			numPad = new NumpadControl();   
			    
			$('MesaAbrirMesaForm').appendChild($('numPad'));
			    	
			numPad.Show($('MesaNumero'));		        
			

			//---------------------------------------  -------------------------
			//Form.Element.focus('MesaNumero');
			$('MesaAbrirMesaForm').focusFirstElement();
			//$('MesaNumero').focus();
		},		    
		
		

		// envia la mesa para ser cerrada
		cerrarCurrentMesa: function (){
			window.location.href = "/ristorantino/mesas/cerrarMesa/"+this.currentMesa.id+"/mozo_id:"+this.currentMozo.id;
		},		
		
		
	    /**
	     * cuando hago click en una mesa, esta llama via ajax a la informacion
	     * para que se actualicen algunas variables globales, es necesario que se ejectute esta funcion
	     */
		actualizar_numero_mesa_div: function (){
			if (this.currentMesa){
				$("numero-mesa").update("Mesa: "+this.currentMesa.numero)
			}	
		},
		

	    
		hacerComanda: function(){
			if(this.currentMesa){
				$("contenedor-comandas").show();
			}
		}
		
};
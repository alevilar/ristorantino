var Adicion = Class.create();

Adicion.prototype = {
	
		initialize: function(mozo) {
	
			this.currentMozo = new Mozo();
			
			this.currentMozo = mozo;
				
			this.currentMesa = null;
			

			// esta es la comanda que se genera al sacar un Item de un DetalleMesa
			this.comandaSacar = null;
			
			/**
			 *  Crear la comandera y el menu 
			 *  para el mozo actual y la mesa actual
			 */
			this.comanda = null;  //este objeto se crea con el evento window onload
						
		},
		
		
		/**
		 * Me dice si tiene una mesa setteada
		 * @return boolean
		 */
		tieneMesaSeleccionada: function(){
			if(adicion.currentMesa) return true;
			else 					return false;
		},
		
		
		/**
		 * Inicializa la adicion volviendo a resetear los aspectos visuales
		 * @return
		 */
		resetear: function(){
			// saca la pestaña de la mesa activada y la pone como las demas
			$('mesa-ver-'+this.currentMesa.getId()).removeClassName('mesa-seleccionada');
			
			// el contenedor de items actuales de una mesa
			$('mesa-scroll').update("Seleccione una mesa");
			
			$('boton-cliente').removeClassName('boton-apretado');
			$('boton-menu').removeClassName('boton-apretado');
			$('boton-menu').update('Menú');
			
			this.borrarCurrentMesa();
		},
		
		
		borrarCurrentMesa: function(){
			this.currentMesa = null
		},
		
		setCurrentMozo: function(mozo){
			this.currentMozo = mozo;
			var cantidad_de_mesas = this.currentMozo.mesas.length;
		},
		
		setCurrentMesa: function(mesa){
			this.currentMesa = mesa;
		},

		//cambia de mesa
		cambiarMesa: function (mesaCambiar)
		{						
			this.setCurrentMesa(mesaCambiar);
				
			this.comanda.resetearComanda(this.currentMozo, this.currentMesa);	
					
			if(this.currentMesa)
			{
				// del element listar_clientes.ctp
				$('boton-cliente').removeClassName('boton-apretado')
				if (this.currentMesa.tieneCliente()){
					$('boton-cliente').addClassName('boton-apretado');
				}	
				
					// del element imprimir_como_menu.ctp
				$('boton-menu').removeClassName('boton-apretado')
				if (this.currentMesa.tieneMenu()){
					$('boton-menu').addClassName('boton-apretado');
				}
			}
			

			// si la mesa esta cerrada, el mozo ya nop deberia poder hacer nada hasta que el cajero no confirme el pago, por lo tanto
			// no le permito al usuario que pueda modificarle valores
			if(mesaCambiar.time_cerro != "0000-00-00 00:00:00")
			{
				mensajero.error("La mesa "+mesaCambiar.numero+" ya está cerrada. No se pude modificar");
				this.resetear();
				this.currentMesa = null;
				return -1;
			}
		},	
		

	    
		/**
		* Esta funcion es para cuando yo abro una nueva mesa, me muestra el form input con un PAD numerico
		*/
		abrirMesa: function(){ 
			var ops = {
					hideEffect:Element.hide, 
					showEffect:Element.show,
					//className: 'alert_simple', 
					zIndex: 2000, 
					width:400, 
					height:400, 
					showProgress: false, 
					destroyOnClose: true
			};
			$('mesa-abrir').show();
			Dialog.info("<h1>Abrir Mesa</h1>"+$('mesa-abrir').innerHTML, ops);

			
			//NUMPAD ------------------------------------------------------		
			//numPad es una variable global
			numPad = new NumpadControl('MesaAbrirMesaForm');   
			    
			//$('MesaAbrirMesaForm').appendChild($('numPad'));
			    	
			numPad.show($('MesaNumero'));		        
			

			//---------------------------------------  -------------------------
			//Form.Element.focus('MesaNumero');
			$('MesaAbrirMesaForm').focusFirstElement();
			//$('MesaNumero').focus();
		},		    
		
		
		
		

		// envia la mesa para ser cerrada
		cerrarCurrentMesa: function (){
			if(this.tieneMesaSeleccionada()){
				var confirma  = Dialog.confirm(
								"Se va a cerrar la mesa Nº "+this.currentMesa.numero, 
								{
									width:300, 
									okLabel: "Aceptar", 
								/*	buttonClass: "myButtonClass",*/ 
									id: "mesa-confirma-cierre", 
									cancel: function(win) {
										return false
										}, 
									ok:function(win) {
											window.location.href = "/ristorantino/mesas/cerrarMesa/"+this.currentMesa.id+"/mozo_id:"+this.currentMozo.id;
											return true;
											}.bind(this) 
								});
								
				return confirma;
			}
			
		}		
		
};
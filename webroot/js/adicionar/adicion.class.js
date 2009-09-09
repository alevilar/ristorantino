var Adicion = Class.create();

Adicion.prototype = {
	
		initialize: function(mozo) {
	
			this.currentMozo = new Mozo();
			
			this.currentMozo = mozo;
				
			this.currentMesa = null;
			
			//this.cantidad_de_mesas = 0;
			// esta es la comanda que se genera al sacar un Item de un DetalleMesa
			this.comandaSacar = new ComandaSacar(this.currentMozo);
			
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
				this.comanda = new ComandaCocina(this.currentMozo);	
				
				var menuDiv = new Element('div',{'id':'productos-contenedor'});
				$('contenedor-comandas').hide();
				$('contenedor-comandas').appendChild(menuDiv);
				
				// esto hace que se cargen las categorias y productos de productos-contenedor
				new Ajax.Updater(menuDiv, 'http://localhost/ristorantino/categorias/listar', { method: 'get', 'evalScripts' :true });	
				
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
				
		},	
		

	    
		/**
		* Esta funcion es para cuando yo abro una nueva mesa, me muestra el form input con un PAD numerico
		*/
		abrirMesa: function(){ 
			var ops = {
					howEffect: Element.show, 
					hideEffect: Element.hide, 
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
			
		},		
			

	    
		hacerComanda: function(){
			if(this.currentMesa){
				$("contenedor-comandas").show();
			}
		},
		
		hacerComandaSacar: function(){
			if (this.currentMesa){
				this.comandaSacar.actualizarComanda(this.currentMesa.productos);
	
				this.comandaSacar.resetearComanda(this.currentMozo, this.currentMesa);
				// @global
				sacarItemWindow.showCenter();
			}
		}
		
		
};
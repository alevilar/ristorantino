var Cajero = Class.create();

Cajero.prototype = {
	
	initialize: function() {
		this.mesa_id = null;
		this.total = null;
		
		this.urlGuardar = null;
		
		// son los tipos de pago disponibles 
		this.tiposDePagos = [];
		
		// son los distintos tipos de pago seleccionados para cobrar
		this.pagos = []; // por ahora solo voy a poner 1
		
		
		this.mesasCerradas = new Array();
	},
	
	
	cobrarMesa: function(mesa_id, total){
		this.mesa_id = mesa_id;	
		if(!total){
			this.total = 0;
		} else{
			this.total = total;
		}
		var mesaEncontrada = this.mesasCerradas.find(function(m){
			return (m.id == mesa_id);
		});
		
		if(mesaEncontrada){
			$('cierre-title').update("Mesa: "+mesaEncontrada.numero);
		}
		ventanaSeleccionPago.showCenter();
	},
	
	
	reimprimir: function(url){
		var urlcompleta = url+"/"+this.mesa_id;

		new Ajax.Request(urlcompleta, {
			  method: 'post',
			});
		
		ventanaSeleccionPago.hide();
		
	},	
	
	
	addPago: function(pago_id){
			var pago_aux = this.buscarPago(pago_id);
			pago_aux.total
			this.pagos.push({'pago_id':pago_id, 'total':'valor'});
			
	},
	
	
	
	guardarCobro: function()
	{		
		new Ajax.Request(this.urlGuardar, {
		  method: 'post',
		  params: {'data[Pago][mesa_id]': this.mesa_id, 'data[Pago][tipo_de_pago_id]': this.pagos[0], 'data[Pago][valor]': this.total  },
		  onSuccess: function(transport) {
			  alert("Se ralizó el pago correctamente");
			  ventanaSeleccionPago.hide();
			  $("mesa-id-"+this.mesa_id).hide();
		  }.bind(this)
		});
	},
	
	
	
	guardarCobroDeUna: function(pago_id)
	{		
		var form = new Element('form',{'action':this.urlGuardar, 'method':'post','name':'formCobrarMesa', 'id':'formCobrarMesa'});
		
		var form_mesa_id = new Element('input',{
			'type':'hidden',
			'name':'data[Pago][mesa_id]', 
			'id': 'form_mesa_id', 
			'value':this.mesa_id});
		//form_mesa_id.setValue(this.mesa_id);
		
		var form_valor = new Element('input',{
			'type':'hidden',
			'name':'data[Pago][valor]', 
			'id': 'form_valor_id',
			'value':this.total});
		//form_valor.setValue(this.total);
		
		var form_pago = new Element('input',{
			'type':'hidden',
			'name':'data[Pago][tipo_de_pago_id]', 
			'id': 'form_pago_id',
			'value': pago_id 	});
		//form_pago.setValue(pago_id);
		
		form.appendChild(form_mesa_id);
		form.appendChild(form_valor);
		form.appendChild(form_pago);
		
		$('cierre-efectivo-tarjeta').appendChild(form);
		//form.submit();

		$("mesa-id-"+this.mesa_id).hide();
		ventanaSeleccionPago.hide();
		
		
		new Ajax.Request(this.urlGuardar, {
		  method: 'post',
		  parameters: {'data[Pago][mesa_id]': this.mesa_id, 'data[Pago][tipo_de_pago_id]': pago_id, 'data[Pago][valor]': this.total  },
		  onSuccess: function() {
			  //$$("#mesa-id-"+this.mesa_id).hide();
			  ventanaSeleccionPago.hide();   
		  },
		  onFailure: function(){alert("No se pudo guardar el cambio")}
		});
		
	},
	
	
	/**
	 * mergea el vector pasado como parametro con las mesasCerradas actuales.
	 * o sea, agrega nuevas mesas cerradas (y sin repetirlas o duplicarlas)
	 *  al array de mesasCerradas
	 */
	mergearMesasCerradas: function(vmesas){
		vmesas.each(function(m){
			var encontro = false;
			encontro = this.mesasCerradas.find(function(mc){
				return (m.Mesa.numero == mc.numero);
			})

			if(!encontro){
				this.agregarMesasCerradas(m);
			}
		}.bind(this));
	},
	
	
	agregarMesasCerradas: function(m)
	{		
		this.mesasCerradas.push(m.Mesa);
		
		var elemento = new Element('li',{	'id':'mesa-id-'+m.Mesa.id, 
											'onclick': 'cajero.cobrarMesa('+m.Mesa.id+','+m.Mesa.total+'); return false;'});
		
		elemento.innerHTML = '<span class="mesa-numero">'+m.Mesa.numero+'</span><span class="mozo-numero">'+m.Mozo.numero+'</span><div class="mozo-total">'+m.Mesa.total+'</div><div class="mesa-time-created">Abrió: '+date('H:i',strtotime(m.Mesa.created))+'</div><div class="mesa-time-cerro">Cerró: '+date('H:i',strtotime(m.Mesa.time_cerro))+'</div>';
		
		if($('listado-mesas').childElements()){
			$('listado-mesas').insert(elemento,{'position':'botton'});
		}
		else{
			$('listado-mesas').appendChild(elemento);
		}
	},
	
	
	
	eliminarMesasNoCerradas: function(vmesas){		
		for (var i = 0; i < this.mesasCerradas.length; i++ ){
		//this.mesasCerradas.each(function(m){
			var m = this.mesasCerradas[i];
			var encontro = false;
			encontro = vmesas.find(function(mc){
				return (m.numero == mc.Mesa.numero);
			});

			if(!encontro){
				//delete(this.mesasCerradas[i]);
				this.mesasCerradas.splice(i,1); 
			}
		}	
	},
	
	
	
	/**
	 * Cancela el cierre de una mesa que previamente fue cerrada por el mozo
	 * 
	 * el ticket ya fue impreso, pero en tal caso se puede modificar el total a mano
	 * o cancelar el tiquet a mano y volver  aimprimirlo
	 */
	cancelarCierreDeMesa: function(url){
		// "0000-00-00 00:00:00"
		new Ajax.Request(url, {
			  method: 'post',
			  parameters: {'data[Mesa][time_cerro]': "0000-00-00 00:00:00", 'data[Mesa][id]': this.mesa_id },
			  onSuccess: function() {
				  ventanaSeleccionPago.hide();
				  $("mesa-id-"+this.mesa_id).hide();
				
			  }.bind(this),
			  onFailure: function(){alert("No se pudo abrir la mesa nuevamente")}
			});
		
	}
	
	
	
	
		
}
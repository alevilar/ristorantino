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
	},
	
	
	cobrarMesa: function(mesa_id, total){
		this.mesa_id = mesa_id;	
		if(!total){
			this.total = 0;
		} else{
			this.total = total;
		}
		ventanaSeleccionPago.showCenter();
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
		  }
		});
	},
	
	
	
	guardarCobroDeUna: function(pago_id)
	{		
		var form = new Element('form',{'action':this.urlGuardar, 'method':'post','name':'formCobrarMesa', 'id':'formCobrarMesa'});
		
		var form_mesa_id = new Element('input',{
			'name':'data[Pago][mesa_id]', 
			'id': 'form_mesa_id', 
			'value':this.mesa_id});
		//form_mesa_id.setValue(this.mesa_id);
		
		var form_valor = new Element('input',{
			'name':'data[Pago][valor]', 
			'id': 'form_valor_id',
			'value':this.total});
		//form_valor.setValue(this.total);
		
		var form_pago = new Element('input',{
			'name':'data[Pago][tipo_de_pago_id]', 
			'id': 'form_pago_id',
			'value': pago_id 	});
		//form_pago.setValue(pago_id);
		
		form.appendChild(form_mesa_id);
		form.appendChild(form_valor);
		form.appendChild(form_pago);
		
		$('cierre-efectivo-tarjeta').appendChild(form);
		form.submit();

		$("mesa-id-"+this.mesa_id).hide();
		
		/*
		new Ajax.Request(this.urlGuardar, {
		  method: 'post',
		  parameters: {'data[Pago][mesa_id]': this.mesa_id, 'data[Pago][tipo_de_pago_id]': pago_id, 'data[Pago][valor]': this.total  },
		  onSuccess: function() {
			  //$$("#mesa-id-"+this.mesa_id).hide();
			  ventanaSeleccionPago.hide();   
		  },
		  onFailure: function(){alert("No se pudo guardar el cambio")}
		});
		*/
	}
	
	
	
		
}
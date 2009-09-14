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
		this.total = total;
		
		ventanaSeleccionPago.showCenter();
	},
	
	
	addPago: function(pago_id){
			var pago_aux = this.buscarPago(pago_id);
			pago_aux.total
			this.pagos.push({'pago_id':pago_id, 'total':'valor'});
			
	},
	
	
	
	guardarCobro: function(){
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
	
	
	guardarCobroDeUna: function(pago_id){
		new Ajax.Request(this.urlGuardar, {
		  method: 'post',
		  parameters: {'data[Pago][mesa_id]': this.mesa_id, 'data[Pago][tipo_de_pago_id]': pago_id, 'data[Pago][valor]': this.total  },
		  onSuccess: function(transport) {
			  ventanaSeleccionPago.hide();

			  $("mesa-id-"+this.mesa_id).hide();
			  
			  
		  }
		});
	}
	
	
	

	
		
}
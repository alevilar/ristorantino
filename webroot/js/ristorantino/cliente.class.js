var Cliente = Class.create();


Cliente.prototype = {
	
	  initialize: function() {
		this.id = null;
		this.descuento = new Object;
	    this.tipofactura = 'N'; //ninguna por default
	    this.denominacion = '';
	    this.cuit = 0;
	    this.domicilioFiscal = '';
	    this.imprimeTicket = null;
	  }	 ,

	  /**
	   * me dce si el cliente es para quele hagan factura A
	   * @return boolean true si es fpara hacer factura A
	   */
		esFacturaA: function(){
		  if (this.tipofactura == 'A'){ 	return 	true;
		  } else{ 					   		return 	false; }
	  }
	  

};
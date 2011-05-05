var Cliente = {};


Cliente.prototype = {
    id: null,
    descuento: new Object,
    tipofactura: 'N', //ninguna por default
    denominacion: '',
    cuit: 0,
    domicilioFiscal: '',
    imprimeTicket: null,
	  	 

    /**
    * me dce si el cliente es para quele hagan factura A
    * @return boolean true si es fpara hacer factura A
    */
    esFacturaA: function(){
          if (this.tipofactura == 'A'){ 	return 	true;
          } else{ 					   		return 	false; }
    }
	  

};
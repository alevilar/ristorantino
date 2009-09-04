
Ajax.Responders.register({
	  
	  onCreate : function(a_request)
	  {
		  if (Ajax.activeRequestCount >= 1)
		  {
			 //mostrar_onloading();
			 mensajero.playLoading();
		  }
	  },
	  onComplete : function(a_request)
	  {
		  if (Ajax.activeRequestCount == 0)
		  {
			// ocultar_onloading();
			  mensajero.stopLoading();
		  }
	  }
	  
	});


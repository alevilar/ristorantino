
Ajax.Responders.register({
	  onLoading: function() {
		Ajax.activeRequestCount++;
	   	mostrar_onloading();
	  },
	  onLoaded: function() {
		  Ajax.activeRequestCount--;
	      ocultar_onloading();
	      
	  }
	});


App.Router = Backbone.Router.extend({
    routes: {
        "": "root",
        "comanda-add/:mesaId": "comandaAdd"
    },
    
    comandaAdd: function( mesaCid ) { 
       	var mesa = App.module('mesaApp').getMesaByCid( mesaCid );
       	var comandaView = App.module('comandaApp').hacerComandaParaMesa( mesa );
       	
		 
		//console.info("===============================  = =");
		
    },
    
    
        
    root: function(){
                App.module('mesaApp').mesaController.viewMesaList();
                //console.debug(mm);
                
    }
});

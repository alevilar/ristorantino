
(function(){
    var mesasFetch;
            
            R$.listadoMesasView = new R$.ListadoMesasView;
            $(document).on('pageshow', '#listado-mesas',function(event, ui){    
                clearInterval(mesasFetch);
        
                R$.mesasCollection.fetch();
        
                mesasFetch = setInterval(function(){
                    R$.mesasCollection.fetch();
                }, Risto.MESAS_RELOAD_INTERVAL);
            });


            $(document).on('pagebeforehide','#listado-mesas',function(event, ui){
                clearInterval(mesasFetch);
        
                mesasFetch = setInterval(function(){
                    R$.mesasCollection.fetch();
                }, Risto.MESAS_RELOAD_INTERVAL*4); // in other pages run slowler
            });
    
    
})();
    
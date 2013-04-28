(function(){
     
    $(document).on('pageshow','#mesa-view',function(event, ui) {
        $('#comanda-detalle-collapsible').trigger('create');

    });

    $(document).on('pagebeforehide', '#mesa-view',function(event, ui){  
      
        });


})();
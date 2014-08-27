 $(document).on('pageshow', '#adicion-opciones',function(event, ui){    
     $('#modo-cajero-adicionista').on('change', function(){
        App.modo = this.value;
     });
     
     
     $('#modo-k').bind('change',function(){
            App.IMPRIME_REMITO_PRIMERO = !App.IMPRIME_REMITO_PRIMERO;
            $.get(urlDomain+'/configs/toggle_remito');

    });
        
 });
 
  $(document).on('pagebeforehide', '#adicion-opciones',function(event, ui){    
      $('#modo-cajero-adicionista').off('change');
 });
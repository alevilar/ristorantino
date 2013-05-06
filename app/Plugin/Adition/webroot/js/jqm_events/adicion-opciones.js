 $(document).on('pageshow', '#adicion-opciones',function(event, ui){    
     $('#modo-cajero-adicionista').on('change', function(){
        R$.modo = this.value;
     });
     
     
     $('#modo-k').bind('change',function(){
            R$.IMPRIME_REMITO_PRIMERO = !R$.IMPRIME_REMITO_PRIMERO;
            $.get(urlDomain+'/configs/toggle_remito');

    });
        
 });
 
  $(document).on('pagebeforehide', '#adicion-opciones',function(event, ui){    
      $('#modo-cajero-adicionista').off('change');
 });
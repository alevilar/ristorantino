 $(document).on('pageshow', '#adicion-opciones',function(event, ui){    
     $('#modo-cajero-adicionista').on('change', function(){
        R$.modo = this.value;
     });
 });
 
  $(document).on('pagebeforehide', '#adicion-opciones',function(event, ui){    
      $('#modo-cajero-adicionista').off('change');
 });
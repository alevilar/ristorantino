/**
     *
     *
     *    Agregar Clientes ADD
     */
    $('#clientes-addfacturaa').live('pageshow', function() {
        var $fform = $('#form-cliente-add', '#clientes-addfacturaa');
        $fform.bind('submit', function(e){
          var contenedorForm = $fform.parent();
           e.preventDefault();
           $.post(
               $fform.attr('action'), 
               $fform.serialize(),
               function(data){
                   contenedorForm.html(data);
                   contenedorForm.trigger('create');
                   contenedorForm.trigger('refresh');
               }
           );
           return false; 
        });
    });
    
    $('#clientes-addfacturaa').live('pagehide', function() {
        $('#form-cliente-add', '#clientes-addfacturaa').unbind('submit');
    });

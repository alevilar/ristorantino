
(function(){

    var divContenedor = $('#clientes-listar-container');
    var menu =  $('#clientes-menu');
    var boton = $(document.createElement('button')).html('Cliente');
    

    $(window).load(function () {
        $('#mesa-acciones-1').append(boton);

        var esto = this;
        boton.click(function(){
            esto.callListarClientes();
            return false;
        });

        menu.click(function(e){
            alert("asas");
            if (e.target.href) {
                divContenedor.load(e.target.href);
            }
            return false;
        });
    });

    




    this.callListarClientes = function(){
        var dialogBox = $(document.createElement('div'));
        var esteObjeto = this;

        if(adicion.tieneMesaSeleccionada()){
            if(adicion.currentMesa.cliente.id == null || adicion.currentMesa.cliente.id == 0){
                divContenedor.show();
            }
            else {
                if(adicion.currentMesa.cliente.tipofactura == "A"){
                    dialogBox.html("<h1>Factura 'A' a nombre de: </h1><br>"+adicion.currentMesa.cliente.nombre);                    
                }
                else{
                    dialogBox.html("<h1>Cliente: </h1>"+adicion.currentMesa.cliente.nombre);
                }
            }
            dialogBox.dialog({
			resizable: false,
			modal: true,
			buttons: {
				"Borrar": function() {
					$( this ).dialog( "close" );
                                        esteObjeto.borrarCliente();
				},
				"Cancelar": function() {
					$( this ).dialog( "close" );
				}
			}
            });
            
        }
    }


    this.borrarCliente = function(){
        adicion.currentMesa.cliente.id = null;

        // lo mando via ajax para que se guarde
        borrarClienteACurrentMesa();

    }



    // esta es la funcion AJAX que hace que se envien los datos al modelo
    this.borrarClienteACurrentMesa = function(){
        //uso lavariable global
        //@Global adicion
        new Ajax.Request("<?php echo $html->url('/mesas/ajax_edit')?>", {
            parameters: {'data[Mesa][id]': adicion.currentMesa.id, 'data[Mesa][cliente_id]': 0},
            method: 'post',
            onSuccess: function(){
                listadoClientesWindow.hide();
                $('boton-cliente').removeClassName('boton-apretado');
                //adicion.resetear();
                Dialog.closeInfo();
            }
        });
    }



    // esta es la funcion AJAX que hace que se envien los datos al modelo
    this.agregarClienteACurrentMesa = function(cliente_id){
        $.get(document.domain + "/mesas/ajax_edit", {
          data: {'data[Mesa][id]': adicion.currentMesa.id, 'data[Mesa][cliente_id]': cliente_id},
          success: function(){
                adicion.refrescarMesaView();
                this.listadoClientesWindow.hide();
          }
        });
    }

    return this;
})();
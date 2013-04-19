/*-----------------------------------------   Adition EVENTS
 *
 *
 * Adition Events
 * el el script que capura los eventos de la pagina adition.php[ctp]
 */

// mensaje de confirmacion cuando se esta por salir de la pagina (evitar perdidas de datos no actualizados)



/**
 *JQM 
 * renderizado de cosas que se cargan dinamicamente en javascript
 * en cada cambio de pagina, hacemos que se  vuelva a refrescar JQM 
 * para enriquecer los elementos nuevos
 *
 */

$(document).bind("mobileinit", function(){

    /**
     *
     *                  Eventos ONLOAD
     *
     *
     */     
  
//    hacerQueNoFuncioneElClickEnPagina();
    
    
    
    // Los botones que tengan el atributo data-href sirven para los dialogs
    // la idea es que al ser apretados el dialog se cierre, pero que se envie 
    // el href via ajax, Es util para las ocasiones en las que quiero mandar
    // una accion al servidor del cual no espero respuesta. Por ejemplo en una 
    // edicion rapida  
    $('[data-href]').bind('click',function(e){
        var att = $(this).attr('data-href');
        if (att) {
            $.get( att );
        }
        $('.ui-dialog').dialog('close');
    });   
    

})
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
    
    $(document).keydown(onKeyDown);
    $(document).keypress(onKeyPress);
    
    
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



    




    function confirmacionDeSalida(e) {
	if(!e) e = window.event;
	//e.cancelBubble is supported by IE - this will kill the bubbling process.
	e.cancelBubble = true;
	e.returnValue = 'Seguro que deseas salir de la aplicación?\n si no hay datos guardados, los mismos se perderán'; //This is displayed on the dialog

	//e.stopPropagation works in Firefox.
	if (e.stopPropagation) {
            e.stopPropagation();
            e.preventDefault();
	}
    }
    


    /**
     *
     *@param String to. es una funcion de jQuery que hace ir para adelante o para atras en la dom 
     *se puede poner: 
     *                  'next' (por default) busca el siguiente elemento
     *                  'prev' busca el anterior
     */
    function __irMesaTo(to) {
        var toWhat = to || 'next';
    
        var mesaContainer = $('.listado-adicion', $.mobile.activePage );
    
        if ( !mesaContainer ) {
            return;
        }

        if ( Risto.Adition.mesaCurrentContainer && Risto.Adition.mesaCurrentContainer.attr('id') != mesaContainer.attr('id') ){
            Risto.Adition.mesaCurrentIndex = null;
        }
    
        Risto.Adition.mesaCurrentContainer = mesaContainer;
        
        if ( Risto.Adition.mesaCurrentIndex !== null) {
            var aaa = Risto.Adition.mesaCurrentIndex.parent()[toWhat]().find('a');
            if ( aaa.length ) {
                Risto.Adition.mesaCurrentIndex = aaa;
            } else {
                return;
            }
        } else {
            Risto.Adition.mesaCurrentIndex = Risto.Adition.mesaCurrentContainer.find('a').first();
        }
        Risto.Adition.mesaCurrentIndex.focus();
    }
  

    function irMesaPrev() {
        __irMesaTo('prev');
    
    }

    function irMesaNext() {
        __irMesaTo('next');
    }


    function onKeyDown(e) {
        var code = e.which;
    
        // al apretar la tecla back, volver atras, menos cuando estoy en un INPUT o TEXTAREA
        if (code == 8 ) { // tecla backspace
            if (document.activeElement.tagName.toLowerCase() != 'input' && document.activeElement.tagName.toLowerCase() != 'textarea') {
                history.back();
            }
        }
    
    
        // Ctrol DERECHO + M ir a modo Cajero
        if( (code == 'l'.charCodeAt() || code == 'L'.charCodeAt()) && e.ctrlKey) {
            var pageId = $.mobile.activePage.attr('id');
        
            if ( pageId == 'listado-mesas-cerradas' ) {
                $.mobile.changePage('#listado-mesas');
            }
        
            if ( pageId == 'listado-mesas' ) {
                $.mobile.changePage('#listado-mesas-cerradas');
            }
            return false;
        }        
    
    
        if(code == 23 && e.ctrlKey) {
            $.mobile.changePage('#mesa-view')
        }
        
    
        // mesa siguiente a la seleccionada (focus) del listado de mesas
        if (code == 39 ) { //btn flecha derecha
            irMesaNext();
        }
    
        // mesa anterior a la seleccionada del listado de mesas
        if (code == 37 ) { // boton flecha izq
            irMesaPrev();
        }
    }

    var oldTimeOut;
    function onKeyPress(e) {
        var code = e.which;
        if ( code > 47){ // desde el numero 0 hasta la ultima letra con simbolos
        
            // buscar la mesa con ese numero, busca por accesskey
            Risto.Adition.mesaBuscarAccessKey += String.fromCharCode( code );
            var domFinded = $("[accesskey^='"+Risto.Adition.mesaBuscarAccessKey+"']", $.mobile.activePage);
            if ( domFinded.length ) {
                Risto.Adition.mesaCurrentIndex = $(domFinded[0]);
                domFinded[0].focus();
            }
        
            if(oldTimeOut){
                clearTimeout(oldTimeOut);
            }
            oldTimeOut = setTimeout(function(){
                Risto.Adition.mesaBuscarAccessKey = '';
            },1000);
        }
    }



    /**
     *  para que no titile el cursor. Que no se pueda hacer click
     */
    function hacerQueNoFuncioneElClickEnPagina() {
        return 1;
        if(document.all){
            document.onselectstart = function(e) {return false;} // ie
        } else {
            document.onmousedown = function(e)
            {
                if(e.target.type!='text' && e.target.type!='button' && e.target.type!='textarea') return false;
                else return true;
            } // mozilla
        }
    }
})
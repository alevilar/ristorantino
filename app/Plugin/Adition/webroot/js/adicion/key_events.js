

$('#listado-mesas').live('pageshow',function(event, ui){
    $('#listado-mesas').on('keydown',onKeyDown);
    $('#listado-mesas').on('keypress',onKeyPress);

    /**
     *
     *@param String to. es una funcion de jQuery que hace ir para adelante o para atras en la dom 
     *se puede poner: 
     *                  'next' (por default) busca el siguiente elemento
     *                  'prev' busca el anterior
     */
    var mesaCurrentContainer = null;
    function __irMesaTo(to) {
        var toWhat = to || 'next';
        
    
        var mesaContainer = $('.listado-adicion', $.mobile.activePage );
    
        if ( !mesaContainer ) {
            return;
        }

        if ( mesaCurrentContainer && mesaCurrentContainer.attr('id') != mesaContainer.attr('id') ){
            mesaCurrentIndex = null;
        }
    
        mesaCurrentContainer = mesaContainer;
        
        if ( mesaCurrentIndex !== null) {
            var aaa = mesaCurrentIndex.parent()[toWhat]().find('a');
            if ( aaa.length ) {
                mesaCurrentIndex = aaa;
            } else {
                return;
            }
        } else {
            mesaCurrentIndex = mesaCurrentContainer.find('a').first();
        }
        mesaCurrentIndex.focus();
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
    
    
        // Ctrol DERECHO + L ir a modo Cajero
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
    var mesaBuscarAccessKey = '';
    var mesaCurrentIndex = null;
    function onKeyPress(e) {
        var code = e.which;
        if ( code > 47){ // desde el numero 0 hasta la ultima letra con simbolos
        
            // buscar la mesa con ese numero, busca por accesskey
            mesaBuscarAccessKey += String.fromCharCode( code );
            var domFinded = $("[accesskey^='"+mesaBuscarAccessKey+"']", $.mobile.activePage);
            if ( domFinded.length ) {
                mesaCurrentIndex = $(domFinded[0]);
                domFinded[0].focus();
            }
        
            if(oldTimeOut){
                clearTimeout(oldTimeOut);
            }
            oldTimeOut = setTimeout(function(){
                mesaBuscarAccessKey = '';
            },1000);
        }
    }
    
    
});



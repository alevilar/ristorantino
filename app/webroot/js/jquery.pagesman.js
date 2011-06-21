
/**
 *
 * Se necesita Prototype para que funcione
 *
 * Esta clase lo que hace es tener un contenedor de paginas "pages"
 * para ir poniendo  la pagina que yo quiera como principal, Por lo general yo
 * voy a tener un monton de divs de clase "page". Todos estos divs serian mis
 * paginas. Pero yo quiero qe solo 1 se muestre en el contenedor "pages"
 * mientras que las otras deberan permanecer ocultas.
 *
 *
 */
( function($) {

    var  pagesContainer;
    var  pagesSelector;
    var pagesmanHistory = [];
    var current;


    var __doChange = function(pageToInsert){
        $(pagesContainer + ' > '+pagesSelector).hide().removeClass('current');
        $(pagesContainer).append(pageToInsert);
        pageToInsert.addClass('page').addClass('current').show('fade');
        current = pageToInsert;
    }

    
    $.fn.pagesman = function(opciones_user) {
        // meto loqu eestaba en el history;                
        
        // Ponemos la variable de opciones antes de la iteración (each) para ahorrar recursos
        var opc = $.extend( $.fn.pagesman.opc_default, opciones_user );

        // inicializo las variables globales de este plugin
        pagesmanHistory.push($(opc.pagesContainer +' > .page:visible'));
        pagesContainer = opc.pagesContainer;
        pagesSelector = opc.pagesSelector;

        
        __doChange(this);
        return this;
    };


    $.fn.pagesmanCurrentPage = function(opciones_user) {
        return $(current);
    };


    $.fn.pagesmanBack = function(){
        if (pagesmanHistory.length) {
            var page = pagesmanHistory.pop();

            __doChange(page);

        }
    }


    $.fn.pagesman.opc_default = {
        pagesContainer : '#pages',
        pagesSelector  : '.page'
    };
})(jQuery);

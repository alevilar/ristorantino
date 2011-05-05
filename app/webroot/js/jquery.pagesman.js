
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
    $.fn.pagesman = function(opciones_user) {
        // Ponemos la variable de opciones antes de la iteración (each) para ahorrar recursos
        var opc = $.extend( $.fn.pagesman.opc_default, opciones_user );

        $(opc.pagesContainer + ' > '+opc.pagesSelector).hide();
        $(opc.pagesContainer).append(this);
        this.show('bliss').addClass('page');
        return this;
    };

    $.fn.pagesman.opc_default = {
        pagesContainer : '#pages',
        pagesSelector  : '.page'
    };
})(jQuery);

(function($){
    
    // variables globales para este plugin
    var $input;
    var $kbdContainer = null;
    
    
    
    // inicializacion de la desactivacin del teclado
    // por ahora solo se ocultaria si el input no esta en foco, y tampoco estoy con el mousse arriba
    // del teclado
    var inputEnfocado = false;
    var tecladoConHover = false;
    
    
    
    $(function(){
        function verSiLoOculto(){
            if ( !inputEnfocado && !tecladoConHover ) {
                $kbdContainer.desactivar();
            }
        }
        
        $("input[type='text']").live('focus', function() {
                inputEnfocado = true;
                verSiLoOculto();
        });
        $("input[type='text']").live('focusout', function() {
                    inputEnfocado = false;
                    verSiLoOculto();
        });  
        $kbdContainer.hover(
            function(){tecladoConHover = true;verSiLoOculto();}, 
            function(){tecladoConHover = false;verSiLoOculto();}
        );
    });
    /////////////
    
    
    
    /**
     * Cada layout es un tipo de teclado
     *
     *
     */
    var $layouts = [
        /* 0 */ {name: 'numpad', 'cssClass': 'numpad', keyMap: [[1, 2, 3, 4, 5, 6, 7, 8, 9, 0]]},
        /* 1 */ {name: 'spanish', 'cssClass': 'words', keyMap: [['q','w','e','r','t','y','u','i','o','p'], ['a','s','d','f','g','h','j','k','l','ñ'], ['z','x','c','v','b','n','m'], [' ']]}
    ];
    

    $kbd = {
//      // Seleccionar un layout
        keys: $layouts[0],
        keyWrapper: 'button',
        enterKey: 'Listo',
        backKey: '<-',
        
        container: null,
        activo: false,
        

        init: function(){
            $kbdContainer = $('<div>').addClass('alekeyboard '+$kbd.keys.cssClass).hide();            
            
            // inicializar el contenedor con aulgunas funciones y eventos bindeados
            $kbdContainer.activar = $kbd.activar;
            $kbdContainer.desactivar = $kbd.desactivar;
            
            $("input[type='text']").live('focus', function(){
                    $kbdContainer.activar( this );
            });            
            
            
            var $lineContainer, $keyContainer;
            for ( var line in $kbd.keys.keyMap ) {
                $lineContainer = $('<div class="keyboard-line">');
                for(var k in $kbd.keys.keyMap[line]) {
                    $keyContainer = $( '<'+$kbd.keyWrapper+'>' ).html( $kbd.keys.keyMap[line][k] ).addClass( 'key-'+$kbd.keys.keyMap[line][k] )
                                                               .click( function(){
                                                                   $input.val( $input.val() + $(this).html() ) ;
                                                                   $input.focus();
                                                               });
                    $kbdContainer.append( $lineContainer.append($keyContainer) );
                }
            }
            
            var enterKey = $( '<'+$kbd.keyWrapper+'>' ).html( $kbd.enterKey ).addClass( 'key-enter' )
                                                       .click( function(){
                                                           if ( $input ) {
                                                               $input.focusout();
                                                               $kbdContainer.hide();
                                                           }
                                                       });
            var backKey = $( '<'+$kbd.keyWrapper+'>' ).html( $kbd.backKey ).addClass( 'key-back' )
                                                       .click( function(){
                                                           if ( $input ) {
                                                               $input.val(  $input.val().slice(0, $input.val().length-1 ) );
                                                               $input.focus();
                                                           }
                                                       });
            $kbdContainer.append( backKey );
            $kbdContainer.append( enterKey );
            
            
            
            // ponerlo en el cuerpo del body ni bien haya cargado la DOM
            $(document).ready( function(){
                $( 'body' ).append( $kbdContainer );
            });
            
            return $kbdContainer;
        },
        
        // extiende la DOM para el DIV contenedor del teclado. lo activa mostranbdolo y
        // enviando triggers por cada tecla tocada
        activar: function( input ){
            if ( !$kbd.activo ) {
                activo = true;
                var keybdContainer = this;
                keybdContainer.show();
                $input = $( input );


            }
            return false;
        },
        
        // extiende la DOM para el DIV contenedor del teclado. lo activa mostranbdolo y
        // enviando triggers por cada tecla tocada
        desactivar: function( input ){
            $kbdContainer.hide();
            activo = false;
        }
    }
    
    $kbd.init();
})(jQuery);

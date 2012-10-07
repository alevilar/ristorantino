
if ( !jQuery ) {
    console.error("esto no funciona sin jQuery");
}

( function($){
    
//    // variables globales para este plugin
    var $input;
//    var $kbdContainer = null;
    
    
    
    // inicializacion de la desactivacin del teclado
    // por ahora solo se ocultaria si el input no esta en foco, y tampoco estoy con el mousse arriba
    // del teclado
//    var inputEnfocado = false;
//    var tecladoConHover = false;
//    
//    
    /////////////
    
    
    
    /**
     * Cada layout es un tipo de teclado
     *
     *
     */
    var $layouts = [
        /* 0 */ {
                    name: 'numpad',
                    'cssClass': 'numpad', 
                    keyMap: [[1, 2, 3, 4, 5, 6, 7, 8, 9, 0]],
                    types: ['input[type="number"]'] // es un selector css que utilizara Jquery para encontrar al inputs
                },
                    
        /* 1 */ {
                    name: 'spanish',
                    'cssClass': 'words', 
                    types: ['input[type="text"]', 'textarea', 'input[type="password"]'], // es un selector css que utilizara Jquery para encontrar al inputs
                    keyMap: [['1','2','3','4','5','6','7','8','9','0'], 
                             ['q','w','e','r','t','y','u','i','o','p'], 
                             ['a','s','d','f','g','h','j','k','l','ñ'], 
                             [',','z','x','c','v','b','n','m','.','@'], 
                             [' ']]
                }                            
    ];
    

    $kbd = {
//      // Seleccionar un layout
        keys: $layouts[0],
        keyWrapper: 'button',
        enterKey: 'Listo',
        backKey: '<-',
        
        container: null,
        activo: false,
        

        init: function( layout ){
            if ( !layout.types ) {
                return null;
            }
            
            var $kbdContainer,
                inputEnfocado   = false,
                tecladoConHover = false 
            ;
            
            function verSiLoOculto(){
                if ( !inputEnfocado && !tecladoConHover ) {
                    $kbdContainer.desactivar();
                }
            }
            

            // inicializo cada uno de los layouts
            $kbdContainer = $('<div id="alekeyboard-'+layout.name+'" class="'+'alekeyboard '+layout.cssClass+'">').hide(); 
            
            
            // extiende la DOM para el DIV contenedor del teclado. lo activa mostranbdolo y
            // enviando triggers por cada tecla tocada
            $kbdContainer.activar = function( input ){
                if ( !$kbd.activo ) {
                    $kbd.activo = true;
                    var keybdContainer = this;
                    keybdContainer.show();
                    $input = $( input );


                }
                return false;
            }

            // extiende la DOM para el DIV contenedor del teclado. lo activa mostranbdolo y
            // enviando triggers por cada tecla tocada
            $kbdContainer.desactivar = function( input ){
                $kbdContainer.hide();
                $kbd.activo = false;
            }          

            // cache de los inputs a bindear
            
            // bindeo eventos en la dom
            $(document).ready( function(){
                for ( var t in layout.types ) {
                    $domInput = $( layout.types[t] );
                    
                    $domInput.live('click', function(){
                        $kbdContainer.activar( this );
                        inputEnfocado = true;
                        verSiLoOculto();
                    });  
                    
                    $domInput.live('focus', function(){
                        $kbdContainer.activar( this );
                        inputEnfocado = true;
                        verSiLoOculto();
                    });  

                    $domInput.live('focusout', function() {
                            inputEnfocado = false;
                            verSiLoOculto();
                    });  
                }
            });
            
            $kbdContainer.hover(
                function(){
                    tecladoConHover = true;
                    verSiLoOculto();
                }, 
                function(){
                    tecladoConHover = false;
                    $kbdContainer.desactivar();
                }
            );


            var $lineContainer, $keyContainer;
            for ( var line in layout.keyMap ) {
                $lineContainer = $('<div class="keyboard-line">');
                for(var k in layout.keyMap[line]) {
                    $keyContainer = $( '<'+$kbd.keyWrapper+'>' ).html( layout.keyMap[line][k] ).addClass( 'key-'+layout.keyMap[line][k] )
                                                               .click( function(){
                                                                   var character = $(this).html();
                                                                   $input.val( $input.val() + character ) ;
                                                                   $input.focus();
                                                                   
                                                                   var e = $.Event('change');
                                                                   e.which = character.charCodeAt();
                                                                   $input.trigger(e);
                                                               });
                    $kbdContainer.append( $lineContainer.append($keyContainer) );
                }
            }

            var enterKey = $( '<'+$kbd.keyWrapper+' class="key-enter">'+ $kbd.enterKey +'</'+$kbd.keyWrapper )
                                                       .click( function(){
                                                           if ( $input ) {
                                                               $input.focusout();
                                                               $kbdContainer.hide();
                                                               
                                                               var e = $.Event('change');
                                                               e.which = 10;
                                                               $input.trigger(e)
                                                           }
                                                       });
            var backKey = $( '<'+$kbd.keyWrapper+'>' ).html( $kbd.backKey ).addClass( 'key-back' )
                                                       .click( function(){
                                                           if ( $input ) {
                                                               $input.val(  $input.val().slice(0, $input.val().length-1 ) );
                                                               $input.focus();
                                                               
                                                               var e = $.Event('change');
                                                               e.which = 32;
                                                               $input.trigger(e)
                                                           }
                                                       });
            $kbdContainer.append( backKey )
            $kbdContainer.append( enterKey );

            // ponerlo en el cuerpo del body ni bien haya cargado la DOM
            $(document).ready( function(){
                $( 'body' ).append( $kbdContainer );
            });
        }
        
    }
    
    for ( var l in $layouts ) {
        $kbd.init( $layouts[l] );
    }
})(jQuery);

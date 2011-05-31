(function(){

// Agregar el boton el menu-top
    var btn = {
        'text': '¿Mozo o Mesa?',
        'id' : 'listadoMozosyMesas',
        'class': 'cuadrado',
        'onclick': function(){adicion.seleccionarMesa.call(adicion)}
    }

   var strContenedorMesasAbiertas = adicion.addButton(btn, 'menu-top');

    var strContenedorMesasAbiertas = '#listado-de-mesas-abiertas';
    var html = '<span class="mesa-numero">¿MESA?</span><span class="mozo-numero"></span>';
    var botonSeleccionDeMesa = $(document.createElement('button')).html(html).addClass('cuadrado');

    botonSeleccionDeMesa.click(function(){
        $(strContenedorMesasAbiertas).pagesman();
    });


    $(document).ready(function(){    
        $('#menu-top').append(botonSeleccionDeMesa);


        // Click de los botones interno del elemento
        // donde se selecciona Mozos y Mesas
       $(strContenedorMesasAbiertas).click(function(e){
           var tgt = e.target;
           if (tgt && tgt.type && tgt.type.toLowerCase() == 'button'){
               if($(tgt).attr('mozoid') && $(tgt).attr('mesaid')){
                   // es una Mesa asique debo hacer el cambio de mesa en la adicion
                   $(tgt).trigger('mesaSeleccionada');
                   
                   
               } else if($(tgt).attr('mozoid')){
                   // es un Mozo
                   seleccionarMesasDeMozo(tgt, $(tgt).attr('mozoid'));
               }
           } else {
                seleccionarMesasDeTodos();
           }

       });

    });
    

    /**
     * me muestra las mesas de todos los mozos
     */
    function seleccionarMesasDeTodos(){
        $('.li-mozos button').removeClass('boton-apretado');
        $('button[0]').addClass('boton-apretado');
        $('.li-mesas button').show();
    }

    /**
     * me muestra solo las mesas delmozo seleccionado, el resto las oculta
     */
    function seleccionarMesasDeMozo(e, mozoId){
        if (mozoId == 0) {
            seleccionarMesasDeTodos();
            return;
        }
        
        $('.li-mozos button').removeClass('boton-apretado');
        $('button['+mozoId+']').addClass('boton-apretado');
        $('.li-mesas button').hide();
        $('.li-mesas button[mozoid='+mozoId+']').show();
    }


                
})();
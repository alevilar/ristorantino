$(function(){

    // Agregar el boton el menu-top
    var btn = {
        'text': 'Seleccionar Mesa',
        'id' : 'seleccionarMesa',
        'class': 'cuadrado',
        'onclick': function(){adicion.seleccionarMesa.call(adicion)}
    }

   adicion.addButton(btn, 'menu-top');


    /**
    * Esta funcion es para cuando yo abro una nueva mesa, me muestra el form input con un PAD numerico
    */
    adicion.addMethod('seleccionarMesa', function(){
        ventanas.botonizar(this.mesas, 'numero', function(mesa){
            mesa.seleccionar();
        });
    });

    
});
$(function(){

    // Agregar el boton el menu-top
    var btn = {
        'text': 'Seleccionar Mesa',
        'id' : 'f5-refresh',
        'class': 'cuadrado',
        'onclick': function(){parent.location.reload();}
    }

   adicion.addButton(btn, 'menu-top');



});
$(function(){

    // Agregar el boton el menu-top
    var btn = {
        'text': 'F5',
        'id' : 'f5-refresh',
        'class': 'cuadrado f5-refresh',
        'menu' : '.mega_controlls',
        'onclick': function(){parent.location.reload();}
    }

   adicion.addButton(btn);



});

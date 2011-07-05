(function(){

    // Agregar el boton el menu-top
    var btn = {
        'text': 'F5',
        'id' : 'refresh',
        'class': 'cuadrado f5-refresh',
        'menu' : '.mega_controlls',
        'onclick': function(){ parent.location.reload(); }
    }

   adicion.registerButton(btn);

})();

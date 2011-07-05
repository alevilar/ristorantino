//on ready
(function(){

    // Agregar el boton el menu-top
    var btn = {
        'text' : 'Volver',
        'id'   : 'back',
        'class': 'cuadrado',
        'menu' : '.mega_controlls'
    };

    adicion.registerButton(btn, function(){
        $(document).pagesmanBack();

    });
})();

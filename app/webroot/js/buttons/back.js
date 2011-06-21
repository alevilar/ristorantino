//on ready
$(function(){

    // Agregar el boton el menu-top
    var btn = {
        'text' : 'Volver',
        'id'   : 'volver',
        'class': 'cuadrado',
        'menu' : '.mega_controlls'
    };

    adicion.addButton(btn, function(){
        $(document).pagesmanBack();

    });
});

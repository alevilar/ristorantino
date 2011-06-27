(function(){

    // Agregar el boton el menu-top
    var btn = {
        'text':   'Seleccionar Mesa',
        'id' :    'seleccionarMesa',
        'class':  'cuadrado'
    }

   adicion.registerButton(btn, function(){
            // genero el nombre de la clase del contenedor a generar
            var containerclassName = this.id +  'Container';

            var container = $('.' + containerclassName);
            if ( container && container.length > 0) {
                container.html('');
            } else {
                container = $('<div class="'+ containerclassName +'">');
            }

            var mozosContainer = $('<div class="listado-mozos"><h1>Selección de Mozos</h1></div>');
            var mesasContainer = $('<div class="listado-mesas"><h1>Selección de Mesas</h1></div>');
            var btnsMozos = adicion.mozosButonizados();
            var btnsMesas = adicion.mesasButonizadas();

            var btnTodosLosMozos = document.createElement('button');
            btnTodosLosMozos.mozo = {id:0};
            btnTodosLosMozos.innerHTML = 'Todos';
            btnsMozos.unshift(btnTodosLosMozos);

            $(btnsMozos).appendTo(mozosContainer).click(function(){
                $('.listado-mozos > button').removeClass('apretado');
                $(this).addClass('apretado');
                var mozoId = this.mozo.id;
                if (mozoId) {
                    $('.listado-mesas > button').hide();
                    $('.listado-mesas > button[mozo_id='+mozoId+']').show();
                } else {
                    $('.listado-mesas > button').show();
                }
                
            });

            $(btnsMesas).appendTo(mesasContainer);

            container.append(mozosContainer).append(mesasContainer);
            return container;
        });
})();
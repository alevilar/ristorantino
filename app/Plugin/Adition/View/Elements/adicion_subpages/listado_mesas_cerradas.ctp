<!-- Pagina 1, Home Page por default segun JQM: Listado de Mesas -->
<div data-role="page" id="listado-mesas-cerradas">

	<div  data-role="header">
            <h1><span style="color: #fcf0b5" data-bind="text: adn().mesasCerradas().length">0</span> <?php echo Inflector::pluralize( Configure::read('Mesa.tituloMesa') )?> Cerradas
                y <span data-bind="text: Math.abs(adn().mesasCerradas().length - adn().mesas().length)"></span> abiertas
            </h1>

            <a href='#cajero-opciones' data-icon="gear" data-rel="dialog" class="ui-btn-right">Opciones</a>
        </div>

                    
        <div  data-role="content" class="content_mesas">
                
                <!-- @template listaMesasCajero -->
                <ul id="ul-mesas-cajero" class="listado-adicion" data-bind='template: { name: "listaMesasCajero", foreach: adn().mesasCerradas }'></ul>
                
        </div><!-- /navbar -->
            
</div>
<!-- Fin Pagina Cajero -->


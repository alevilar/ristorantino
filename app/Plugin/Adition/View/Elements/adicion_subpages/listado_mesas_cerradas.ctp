<!-- Pagina 1, Home Page por default segun JQM: Listado de Mesas -->

<?php $this->start('jquery-tmpl'); ?>
<!-- Template: 
listado de mesas que será refrescado continuamente mediante 
es igual al de las mesas de la adicion salvo que al hacer click tienen otro comportamiento
-->
<script id="listaMesasCajero" type="text/x-jquery-tmpl">
    <li data-bind="attr: {mozo: mozo().id(), 'class': estado().icon}">
        <a  data-bind="click: seleccionar, attr: {accesskey: numero, id: 'mesa-id-'+id()}" 
            data-theme="c"
            data-rel="dialog"
            data-role="button" 
            data-transition="none"
            data-icon="none"
            href="#mesa-cobrar" 
            class="ui-btn ui-btn-up-c">
            <span class="mesa-mozo" data-bind="text: mozo().numero"></span>
            
            <span class="mesa-descuento" data-bind="visible: clienteDescuentoText(),text: clienteDescuentoText()"></span>
            <span  class="mesa-tipofactura" data-bind="visible: clienteTipoFacturaText()">
                "<span data-bind="text: clienteTipoFacturaText()"></span>"
            </span>
            
            <span class="mesa-numero" data-bind="text: numero"></span>
            
            <span class="mesa-descuento" data-bind="visible: clienteDescuentoText(),text: clienteDescuentoText()"></span>
            
            <br />
            <br />
            <span class="mesa-total">$ <span data-bind="text: totalCalculado()"></span></span><br />
            
            
            <span class="mesa-time" data-bind="text: textoHora()"></span>
        </a>
    </li>
</script>



<?php $this->end(); ?>

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


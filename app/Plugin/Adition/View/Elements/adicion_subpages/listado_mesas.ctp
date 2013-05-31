<!-- Template: 
listado de mesas que será refrescado continuamente mediante 
el ajax que verifica el estado de las mesas (si fue abierta o cerrada alguna. -->
<script id="mini-mesa-view" type="text/x-template">
        <button
            data-theme="c"
            data-role="button" 
            class="ui-btn ui-btn-up-c">
            <span class="mesa-span ui-btn-inner">
                <span class="ui-btn-text">
                    <span class="mesa-numero"><%= numero %></span>
                </span>
            </span>
            <span class="mesa-cliente"><%= cliente_abr %></span>
            
            <span class="mesa-time mesa-time-abrio"><%= time_abrio_abr %></span>
            <span class="mesa-time mesa-time-cerro"><%= time_cerro_abr %></span>
        </button>
</script>


<script id="mozo-view" type="text/x-template">
	<div>Mozo <%= numero %></div>
	<b>listado de mesas</b>
	<ul class="mesas-list"></ul>
</script>

<script id="mesa-app-layout" type="text/x-template">
	<div data-role="page" id="listado-mesas">
	    <header  data-role="header" class="header">
	        <h1><span class="wow cant_mesas">0</span> <?php echo Inflector::pluralize(Configure::read('Mesa.tituloMesa')) ?></h1>
	        <a href='#adicion-opciones' data-icon="gear" data-rel="dialog" class="ui-btn-right">Opciones</a>
	    </header>
	    <div  data-role="content" class="content"></div><!-- /navbar -->
	</div>
</script>
<!-- Template: listado de mesas que será refrescado continuamente mediante el ajax que verifica el estado de las mesas (si fue abierta o cerrada alguna. -->
<script id="listaMesas" type="text/x-jquery-tmpl">
    <li class="grid_1">
        <a href="mesas/view/${id}" data-role="none" class="mesa" >
            (<span class="mesa-mozo" data-bind="text: mozo().numero" style="color: red"></span>)
            <span class="mesa-numero" data-bind="text: numero"></span>
        </a>
    </li>
</script>


<script id="listaMozos" type="text/x-jquery-tmpl">
    <li data-mesa-numero="${numero}" data-mozo-id="${id}" class="grid_1">
        <a href="mozos/view/${id}" data-role="none" class="mesa" >
            (<span class="mozo-numero" data-bind="text: numero()" style="color: red"></span>)
            <span class="mozo-cant-mesas" data-bind="text: mesas().length"></span> mesas
        </a>
    </li>
</script>



<!-- Pagina 1, Home Page por default segun JQM: Listado de Mesas -->
<div data-role="page" data-add-back-btn="true" id="listado-mesas">

	<div  data-role="header" data-position="inline">

                <h1><strong data-bind="text: mesas().length"></strong> Mesas Abiertas</h1>

                <a rel="external" href='#listado-mesas' data-icon="home" data-iconpos="notext" data-direction="reverse" class="">Home</a>
                
                <div data-role="navbar">
                        <ul>
                            <li><a href="#listado-mozos">Mozos</a></li>
                            <li><a href="#listado-mesas" class="ui-btn-active">Mesas</a></li>
                        </ul>
                </div>
        </div>

        <div  data-role="content" class="">

            <div> </div>
            <!-- aca va el listado de mesas que se carga dinamicamente en un script de abajo -->
            <ul id="mesas_container" class="container_12 listado-mesas"
                data-bind='template: { name: "listaMesas", foreach: mesas }'>
            </ul>
        </div><!-- /navbar -->
            
        <div  data-role="footer" data-position="fixed">
            <div data-role="navbar">
                    <ul>
                        <li><a onclick="adicion.mozosOrder('numero')">Ordenar Por Numero</a></li>
                        <li><a onclick="adicion.mozosOrder('mozo_id')">Ordenar Por Mozo</a></li>
                        <li><a onclick="adicion.mozosOrder('created')">Ordenar Por Cierre</a></li>
                    </ul>
                </div>
            Ristorantino Mágico</div>

</div>
<!-- Fin Pagina 1 -->


<!-- Pagina 2: Listado de Mozos -->
<div data-role="page" data-add-back-btn="true" id="listado-mozos">

	<div  data-role="header" data-position="inline">
                <h1>Mozos</h1>
                
                <a rel="external" href='<?= $html->url('/adition/adicionar') ?>' data-icon="home" data-iconpos="notext" data-direction="reverse" class="">Home</a>

                <div data-role="navbar">
                        <ul>
                            <li><a href="#listado-mozos">Mozos</a></li>
                            <li><a href="#listado-mesas">Mesas</a></li>
                        </ul>
                </div>
        </div>

        <div data-role="content" class="container_12">

                <!-- aca va el listado de mesas que se carga dinamicamente en un script de abajo -->
                <ul id="mesas_container" class="container_12 listado-mesas"
                    data-bind='template: { name: "listaMozos", foreach: mozos }'>
                </ul>
        </div>

        <div  data-role="footer" data-position="fixed">
            Ristorantino Mágico</div>
</div>
<!-- Fin Pagina 2: Listado de Mozos -->




<!-- Pagina Comanda -->
<div data-role="page" data-add-back-btn="true" id="hacer-comanda">

	<div  data-role="header" data-position="inline">
            <h1>Comanda de la Mesa <span class="mesa-numero" data-bind="text: currentMesa.numero">Nu</span></h1>
        </div>

        <div  data-role="content" class="">
            Probannndodoooo
        </div><!-- /navbar -->

        <div  data-role="footer" data-position="fixed">Ristorantino Mágico</div>

</div>
<!-- Fin Pagina 1 -->


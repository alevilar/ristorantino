<!-- Template: listado de mesas que será refrescado continuamente mediante el ajax que verifica el estado de las mesas (si fue abierta o cerrada alguna. -->
<script id="listItems" type="text/x-jquery-tmpl">
    <li data-mesa-numero="${numero}" data-mozo-id="${mozo.id}" class="grid_1">
        <a href="mesas/view/${id}" data-role="none" class="mesa" >
            <span class="numero-mesa">${numero}</span>
        </a>
    </li>
</script>



<!-- Pagina 1, Home Page por default segun JQM: Listado de Mesas -->
<div data-role="page" data-add-back-btn="true" id="listado-mesas">

	<div  data-role="header" data-position="inline">

                <h1><strong><?= count($mesasabiertas)?></strong> Mesas Abiertas</h1>

                <a rel="external" href='#listado-mesas' data-icon="home" data-iconpos="notext" data-direction="reverse" class="">Home</a>
                
                <div data-role="navbar">
                        <ul>
                            <li><a href="#listado-mozos">Mozos</a></li>
                            <li><a href="#listado-mesas" class="ui-btn-active">Mesas</a></li>
                        </ul>
                </div>
        </div>

        <div  data-role="content" class="">
            <!-- aca va el listado de mesas que se carga dinamicamente en un script de abajo -->
            <ul id="mesas_container" class="container_12 listado-mesas"></ul>
        </div><!-- /navbar -->
            
        <div  data-role="footer" data-position="fixed">Ristorantino Mágico</div>

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
                <? foreach ($mozos as $mo) {?>
                    <div class="grid_2">
                        <a  class="mozo"
                            href="#ver-mesas-de-mozo-id-<?= $mo['Mozo']['id']?>"
                            data-role="button"
                            data-mozo-id="<?= $mo['Mozo']['id']?>">
                            <?= $mo['Mozo']['numero']?>
                        </a>
                    </div>
                <? } ?>
        </div>

        <div  data-role="footer" data-position="fixed">Ristorantino Mágico</div>
</div>
<!-- Fin Pagina 2: Listado de Mozos -->






<!-- Pagina 1, Home Page por default segun JQM: Listado de Mesas -->
<div data-role="page" data-add-back-btn="true" id="hacer-comanda">

	<div  data-role="header" data-position="inline">
            <h1>Comanda de la Mesa <span class="mesa-numero"></span></h1>
        </div>

        <div  data-role="content" class="">
            Probannndodoooo
        </div><!-- /navbar -->

        <div  data-role="footer" data-position="fixed">Ristorantino Mágico</div>

</div>
<!-- Fin Pagina 1 -->





<!--scripts Extras , luego deberia moverlas a un js externo-->
<script type="text/javascript">
            // agrego las mesas dinamicamente
            $(document).bind('adicionMesasActualizadas', function(){
                var mesitas = adicion.mesasEnTag( $( "#listItems" ) );

                var mesasContainer = $('#mesas_container');

                $(mesitas).appendTo(mesasContainer);
            });
</script>


<script type="text/javascript">
//            $('.mozo').click(function(e) {
//                e.preventDefault();
//
//                var mozoId = $(this).attr('data-mozo-id');
//                console.debug(mozoId);
//                if (mozoId > 0) {
//                    $('.mesa').hide();
//                    $('.mesa[data-mozo-id="'+mozoId+'"]').show();
//                } else {
//                    $('.mesa').show();
//                }
//
//                return false;
//            });

</script>
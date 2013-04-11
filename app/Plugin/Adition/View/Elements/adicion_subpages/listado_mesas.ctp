<!-- Pagina 1, Home Page por default segun JQM: Listado de Mesas -->
<div data-role="page" id="listado-mesas">

	<div  data-role="header">
            <h1><span class="wow" data-bind="text: adn().mesas().length">0</span> <?php echo Inflector::pluralize( Configure::read('Mesa.tituloMesa') )?></h1>

            <a href='#adicion-opciones' data-icon="gear" data-rel="dialog" class="ui-btn-right">Opciones</a>
            
            <div data-role="navbar">
                <ul id="listado-mozos-para-mesas">
                    <?php 
                    $anchoCalculadoPorcentual = floor( 100/ (count($mozos) + 1 ));
                    $anchoCalculadoPorcentualPrimero = 100 - ($anchoCalculadoPorcentual*count($mozos) );
                    ?>
                    <li  style="width: <?php echo $anchoCalculadoPorcentualPrimero.'%'?>"><a href="#" class="ui-btn-active">Todos</a></li>
                    <?php
                        foreach ($mozos as $m) {
                            $k = $m['Mozo']['id'];
                            $n = $m['Mozo']['numero'];
                            ?>
                    <li  style="width: <?php echo $anchoCalculadoPorcentual.'%'?>">
                                <a href="#" data-mozo-id="<?php echo $k?>"><?php echo $n?></a>
                            </li>
                        <?
                        }
                    ?>
                </ul>
            </div>
        </div>

                    
        <div  data-role="content" class="content_mesas">           

                <!-- aca va el listado de mesas que se carga dinamicamente en un script de abajo -->
                <a href="#mesa-add" id="mesa-abrir-mesa-btn" data-rel="dialog"  class="abrir-mesa" data-role="button" data-theme="a">Abrir<br><?php echo Configure::read('Mesa.tituloMesa')?></a>  

                <!-- @template listaMesas -->
                <ul id="mesas_container" class="listado-adicion" data-bind='template: { name: "listaMesas", foreach: adn().mesas }'></ul>
        </div><!-- /navbar -->

</div>
<!-- Fin Pagina 1 -->

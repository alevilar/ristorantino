
    
<div data-role="page" data-add-back-btn="true" id="mesa-view">

	<div  data-role="header" data-position="inline">

            <h1>Mesa N°<span data-bind="text: currentMesa().numero"></span>, Mozo <span data-bind="text: currentMesa().mozo().numero"></span></h1>

                <a rel="external" href='#listado-mesas' data-icon="home" data-iconpos="notext" data-direction="reverse" class="">Home</a>
                
                <div data-role="navbar">
                        <ul>
                            <li><a href="#mesa-view" class="ui-btn-active">Vista Común</a></li>
                            <li><a href="#mesa-view-ticket">Vista Ticket</a></li>
                        </ul>
                </div>
        </div>

        <div  data-role="content" class="">
            
            <!-- Template: listado de comandas con sus productos-->
            <script id="listaComandas" type="text/x-jquery-tmpl">
                <li>   
                   <span>Comanda ${id}</span>
                   <ul>
                       <li></li>
                   </ul>
                </li>
            </script>

            <script type="text/javascript">
                (function($){
                    <?php if ( !empty($mesa['Mesa']['id']) ) { ?>
                    var mesa = Risto.Adition.adicionar.setCurrentMesa( <? echo $mesa['Mesa']['id']?> );
                    mesa.comandas( <?= $javascript->object($items);?> );
                    <?php }?>

                    Risto.Adition.koAdicionModel.refreshBinding();
                    
                })(jQuery);
                
            </script>

            <div class="" style="width: 28%; float: left;">
                <ul data-role="listview" style="width: 100%">
                    <li><a data-bind="attr: {href: currentMesa().urlComandaAdd()}" ><?= $html->image('/adition/css/img/chef_64.png')?>Comanda</a></li>
                    <li><a href="<?= $html->url('/pages/panel')?>" >PAnel</a></li>
                    <li><a href="#sacar-item" >Sacar Item</a></li>
                    <li><a href="#Agregar Cliente" >Agregar Cliente</a></li>
                    <li><a href="#Agragar Descuento" >Agregar Descuento</a></li>
                    <li><a href="#Cerrar-mesa" >Cerrar Mesa</a></li>
                    <li><a href="#cambiar-mozo" >Cambiar Mozo</a></li>
                    <li><a href="#Cambiar N° Mesa" >Cambiar N°</a></li>
                    <li><a href="#re-print" >Re imprimir Ticket</a></li>
                    <li><a href="#Borrar-mesa" >Borrar Mesa</a></li>
                    <li><a href="#testiesto" >De la pagina de atras</a></li>
                </ul>
            </div>

            <div class="mesas view " style="width: 70%; float:right;" >
                <h1>Mesa N° <span data-bind="text: currentMesa().numero"><? echo $mesa['Mesa']['numero']?></span> - Mozo <? echo $mesa['Mozo']['numero']?></h1>
                <div class="">
                    <h4 id="mesa-total"><?php echo "Total: $".$mesa_total; ?></h4>

                    <div>
                        <form action="form.php" method="post">
                            <div data-role="fieldcontain">
                                <label for="search">Search Input:</label>
                                <input type="search" name="password" id="search" value="" />
                            </div>
                        </form>

                    </div>

                    <ul data-bind="template: {name: 'listaComandas', foreach: currentMesa().comandas}"></ul>
              
                </div>

            </div>
            
        </div>
    
    <div data-role="footer">Pie de página</div>
</div>
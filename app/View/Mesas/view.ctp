
    
<div data-role="page">

	<div  data-role="header" data-position="inline">
            <a data-rel="back" data-transition="reverse" href="#">Back</a>
            
            <h1>Mesa N°<span data-bind="text: currentMesa().numero"></span>, Mozo <span data-bind="text: currentMesa().mozo().numero"></span>
                <span class="mesa-total" style="color: red;">$<span data-bind="text: currentMesa().total"></span></span>
            </h1>
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
                   <span>Comanda ${Comanda.id}</span>
                   Producto: ${Producto.name} Cant: ${DetalleComanda.cant-DetalleComanda.cant_eliminada}
                </li>
            </script>

            <script type="text/javascript">
                if ( !Risto.Adition.koAdicionModel.tieneCurrentMesa() ) {
//                            document.location = urlDomain+'adition/adicionar';
                }
                    
                (function($){
                    Risto.Adition.koAdicionModel.refreshBinding();
                })(jQuery);
                
            </script>

            <div class="" style="width: 28%; float: left;">
                <ul data-role="listview" style="width: 100%">
                    <li><a href="<?php echo $this->Html->url('/comandas/add')?>" daxta-bind="attr: {href: currentMesa().urlComandaAdd()}" ><?= $this->Html->image('/adition/css/img/chef_64.png')?>Comanda</a></li>
                    <li><a href="<?= $this->Html->url('/pages/panel')?>" >PAnel</a></li>
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
                <h1>Detalle de comsumición</h1>
                <div class="">

                    <ul data-bind="template: {name: 'listaComandas', foreach: currentMesa().comandas}"></ul>
              
                </div>

            </div>
            
        </div>
    
    <div data-role="footer">Pie de página</div>
</div>
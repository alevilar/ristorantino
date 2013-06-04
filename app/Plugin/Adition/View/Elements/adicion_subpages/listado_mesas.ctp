<!-- Template: 
listado de mesas que será refrescado continuamente mediante 
el ajax que verifica el estado de las mesas (si fue abierta o cerrada alguna. -->
<script id="mesa-view" type="text/x-template">
        	<header>
        		<span class="mesa-cliente"><%= cliente_abr %></span>
        		<span class="mesa-numero"><%= numero %></span>
        	</header>
        	
            <div class="content"></div>
            
            <footer>
            	<span class="mesa-time mesa-time-abrio"><%= time_abrio_abr %></span>
            	<span class="mesa-time mesa-time-cerro"><%= time_cerro_abr %></span>
            </footer>
</script>



<script id="mesa-extra-view" type="text/x-template">
    <header class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <a href="#" data-rel="back" data-direction="reverse">Volver</a>
        <h3 class="header">
            <span class="mesa-numero"><%= numero %></span>
            <?php
            echo $this->Html->image('mesa-abrio.png') . " " . Configure::read('Mesa.tituloMesa') . " - " .
            Configure::read('Mesa.tituloMozo') . " " . $this->Html->image('mozomoniob.png')
            ?>
            <span class="mozo-numero"><%= Mozo.numero %></span>

            <span class="mesa-estado">Abierta</span>

        </h3>
    </header>

    <div  data-role="content" class="" data-scroll="true">

        <div class="mesa-actions">

            <a id="btn-mesa-comanda" href="#comanda-add" data-role="button">
                Comanda
            </a>

            <a id="btn-mesa-cerrar" href="mesas/cerrarMesa" data-direction="reverse" data-role="button">
                Cerrar
            </a>

            <a id="btn-mesa-cobrar" href="#mesa-cobrar" data-role="button">
                Cobrar
            </a>

            <a id="btn-mesa-reabrir" href="mesas/reabrir" data-direction="reverse" data-role="button">
                Re Abrir
            </a>


            <a id="btn-mesa-clientes" href="<?php echo $this->Html->url('/clientes/all_clientes') ?>" data-rel="dialog" data-role="button">
                <span>Cliente</span>
            </a>

            <a id="btn-mesa-descuento" href="<?php echo $this->Html->url('/descuentos') ?>" data-rel="dialog" data-role="button">
                <span>Descuento</span>
            </a>


            <a id="btn-mesa-ticket" href="mesas/imprimirTicket" data-direction="reverse" data-role="button">
                Imprimir Ticket
            </a>

            <a id="btn-mesa-borrar" href="#listado-mesas" data-direction="reverse" data-role="button">
                Borrar
            </a>




            <a id="btn-mesa-menu" href="#mesa-menu" data-rel="dialog" data-role="button">
                <span style="color: red"></span> Menú
            </a>

            <a  id="btn-mesa-edit" href="<? echo $this->Html->url('/mesas/edit/') ?>" data-role="button">
                Editar
            </a>

            <a id="btn-mesa-mozo" href="#mesa-cambiar-mozo" data-role="button">
                <?php echo Configure::read('Mesa.tituloMozo') ?>
            </a>

            <a id="btn-mesa-numero" href="#mesa-cambiar-numero" data-rel="dialog" data-role="button">
                Número
            </a>

            <a id="btn-mesa-cubiertos" href="#mesa-cambiar-cubiertos" data-rel="dialog" data-role="button">
                <span>Cubiertos</span>                            
            </a>
        </div>

    </div>

    <div class="mesa-view">
        <h3 class="titulo-comanda">Listado de Comandas</h3>

        <!-- @template listaComandas -->
        <div id="comanda-detalle-collapsible" data-role="collapsible-set"></div>
    </div>


    <footer data-role="footer" data-position="fixed">
        <h3>
            <span class="mesa-id" style="float: left;">
                #<span class="mesa_id"></span>
            </span>
            <span class="mesa-total"></span>
            <span class="hora-abrio"></span>
        </h3>
    </footer>
</script>


<script id="mozo-view" type="text/x-template">
	<button class='mozo'><%= numero %></button>
	<div class="mesas-list"></div>
</script>


<script id="mesa-add" type="text/x-template">
	  <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Abrir Mesa</h3>
	  </div>
	  <div class="modal-body">
	    <form id="mesa-add-form" action="#">
			<label for="mesa-add-numero-mesa">Número de Mesa</label>
			<input type="number" name="numero" id="mesa-add-numero-mesa" required="required"/>
			
			<label for="mesa-add-cant-cubiertos">Cantidad de Cubiertos</label>
			<input type="number" name="cant_comensales" id="mesa-add-cant-cubierto"/>
			
			<input type="hidden" name="mozo_id" value="<%= id%>"/>
		</form>
	  </div>
	  <div class="modal-footer">
	  	<h4 style="float: left">Mozo <%= numero %></h4>
	  		<button type="submit" class="btn-primary" form="mesa-add-form">Abrir Mesa</button>
	  </div>	
</script>

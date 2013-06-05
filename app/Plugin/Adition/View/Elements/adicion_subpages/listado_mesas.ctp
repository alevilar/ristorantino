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
    	<img src="<?= IMAGES_URL?>thumb_<%= Mozo.image_url %>" width="64"  class="img-circle" style="position: absolute; top: 10px; left: 10px;"/>
        <h3 class="header text-center">
            <?php
            echo $this->Html->image('mesa-abrio.png') . " " . Configure::read('Mesa.tituloMesa')
            ?>
            <span class="mesa-numero"><%= numero %></span>
        </h3>
        <span class="mesa-estado">Abierta</span>
    </header>

    <div class="modal-body">
        <div class="mesa-actions">
            <a id="btn-mesa-cerrar" href="mesas/cerrarMesa" class="btn">
                Cerrar
            </a>

            <a id="btn-mesa-cobrar" href="#mesa-cobrar" class="btn">
                Cobrar
            </a>

            <a id="btn-mesa-reabrir" href="mesas/reabrir" class="btn">
                Re Abrir
            </a>


            <a id="btn-mesa-clientes" href="<?php echo $this->Html->url('/clientes/all_clientes') ?>" class="btn">
                <span>Cliente</span>
            </a>

            <a id="btn-mesa-descuento" href="<?php echo $this->Html->url('/descuentos') ?>" class="btn">
                <span>Descuento</span>
            </a>


            <a id="btn-mesa-ticket" href="mesas/imprimirTicket" class="btn">
                Imprimir Ticket
            </a>

            <a id="btn-mesa-borrar" href="#listado-mesas" class="btn">
                Borrar
            </a>

            <a id="btn-mesa-menu" href="#mesa-menu" class="btn">
                <span style="color: red"></span> Menú
            </a>

            <a  id="btn-mesa-edit" href="<? echo $this->Html->url('/mesas/edit/') ?>" class="btn">
                Editar
            </a>

            <a id="btn-mesa-mozo" href="#mesa-cambiar-mozo" class="btn">
                <?php echo Configure::read('Mesa.tituloMozo') ?>
            </a>

            <a id="btn-mesa-numero" href="#mesa-cambiar-numero" class="btn">
                Número
            </a>

            <a id="btn-mesa-cubiertos" href="#mesa-cambiar-cubiertos" class="btn">
                <span>Cubiertos</span>                            
            </a>
        </div>
        
        
		<div>
	        <h4>Listado de Comandas</h4>
	
	        <button id="btn-comanda-add" class="btn">Nueva Comanda</button>
	    </div>
    </div>

    


    <footer class="modal-footer">
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
	<button class='mozo'><img src="<?= IMAGES_URL ?>/thumb_<%= image_url %>" /><%= numero %></button>
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

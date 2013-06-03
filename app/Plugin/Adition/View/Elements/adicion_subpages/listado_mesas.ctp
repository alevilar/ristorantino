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

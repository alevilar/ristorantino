<!-- Template: 
listado de mesas que será refrescado continuamente mediante 
el ajax que verifica el estado de las mesas (si fue abierta o cerrada alguna. -->
<script id="mesa-list-layout" type="text/x-template">
    			
		    	<header class="navbar navbar-inverse">
			      <div class="navbar-inner">
			        <div class="container">
			          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			          </button>
			          <span class="brand">COQUS :: El Ristorantino Mágico</span>
			          <nav class="nav-collapse collapse nav">
			            <ul class="nav nav-pill pull-right">	              
			              <li class="dropdown">
			                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Opciones <b class="caret"></b></a>
			                <ul class="dropdown-menu">
			                  <li><?= $this->Html->link('Ir a la página principal','/')?></li>
			                  <li class="divider"></li>
			                  <li class="nav-header">Opciones</li>
			                  <li><a href="#">Separated link</a></li>
			                  <li><a href="#">One more separated link</a></li>
			                </ul>
			              </li>
			            </ul>	           
			          </nav><!--/.nav-collapse -->
			        </div>
			      </div>
			    </header>
			    
	    		<div id="listado-mesas-body" class="body container-fluid"></div>
		    	
		    	<footer></footer>
		    	
	    	</script>
	    	
	    	


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

<script id="mesa-comandas" type="text/x-template">
    <h4>Listado de Comandas</h4>

    <a id="btn-comanda-add"  class="btn">Nueva Comanda</a>

    <a id="btn-mesa-cobrar" href="#mesa-cobrar" class="btn">
        Cobrar
    </a>
    
    <div class="listado-comandas">
    
    </div>
</script>


<script id="comanda-detalle-comanda"  type="text/x-template">
    <h4>Comanda</h4>
    <div class='detalle-comandas'></div>
</script>

<script id="mesa-actions" type="text/x-template">
<div class="mesa-actions">
    <ul class="nav nav-tabs nav-stacked">
        <li><a id="btn-mesa-cerrar" href="mesas/cerrarMesa" class="">
            <i class="icon-usd icon-large"></i>
            Cerrar
        </a>
        </li>

        <li>
        <a id="btn-mesa-reabrir" href="mesas/reabrir" class="">
            <i class="icon-share icon-large"></i>
            Re Abrir
        </a>
        </li>

        <li>
        <a id="btn-mesa-clientes" href="<?php echo $this->Html->url('/clientes/all_clientes') ?>" class="">
            <i class="icon-user icon-large"></i>
            <span>Cliente</span>
        </a>
        </li>

        <li>
        <a id="btn-mesa-descuento" href="<?php echo $this->Html->url('/descuentos') ?>" class="">
            <i class="icon-download-alt icon-large"></i>
            <span>Descuento</span>
        </a>
        </li>

        <li>
        <a id="btn-mesa-ticket" href="mesas/imprimirTicket" class="">
            <i class="icon-print icon-large"></i>
            Imprimir Ticket
        </a>
        </li>

        <li>
        <a id="btn-mesa-borrar" href="#listado-mesas" class="closemodal">
            <i class="icon-remove icon-large"></i>
            Borrar
        </a>
        </li>

        <li>
        <a id="btn-mesa-menu" href="#mesa-menu" class="">
            <i class="icon-maxcdn icon-large"></i>
            <span style="color: red"></span> Menú
        </a>
        </li>

        <li>
        <a  id="btn-mesa-edit" href="<? echo $this->Html->url('/mesas/edit/') ?>" class="">
            <i class="icon-edit icon-large"></i>
            Editar
        </a>
        </li>            
    </div>
</script>

<script id="mesa-layout-view" type="text/x-template">
    <div class="row-fluid">
        <div class="span4">
            
            <nav class="actions"></nav>
        </div>
        
        <div class="span8">
            <div class="body">
                <div id="seleccionar-mozo" class="hide">
                        <div data-role="content">           
                                <input type="hidden" name="mesa_id" data-bind="value: adn().currentMesa().id"/>
                                <fieldset data-role="controlgroup" data-type="horizontal">
                                    <legend>Seleccionar <?php echo Configure::read('Mesa.tituloMozo') ?></legend>
                                    <?php
                                    foreach ($mozos as $m) {
                                        $k = $m['Mozo']['id'];
                                        $n = $m['Mozo']['numero'];
                                        echo "<input type='radio' name='mozo_id' id='radio-mozo-cambiar-id-$k' value='$k' class='select-mozo'/>";
                                        echo "<label for='radio-mozo-cambiar-id-$k'  style='display:inline'>$n</label>";
                                    }
                                    ?>
                                </fieldset>

                                <a href="#" class="btn pull-right" onclick="$('#seleccionar-mozo').toggle('slideUp');">Cancelar</a>
                        <div class="clearfix"></div>
                        </div>
                </div>

                <div class="content"></div>
                
            </div>
        </div>
    </div>
</script>


<script id="mozo-view" type="text/x-template">
	<% if ( _.isEmpty( image_url ) ) {%>
		<button class='mozo'>
			<img src="adition/img/frame.png" width="64"/>
			<span style="position: absolute;margin-left: -34px;margin-top: 23px;"><%= numero %></span>
		</button>    		
	<% } else { %>
		<button class='mozo'><img src="<?= IMAGES_URL?>thumb_<%= image_url %>" width="64"  class="img-circle"/></button>
	<% } %>
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



<script id="mesa-label" type="text/x-template">
    <header>
        <span class="mesa-estado"><%= "Estado" %></span>

        <% if ( _.isEmpty( Mozo.image_url ) ) {%>
                <button class='mozo'>
                        <img src="adition/img/frame.png" width="64" style="position: relative; top: 10px; left: 10px;"/>
                        <span style="position: relative; margin-left: 17px;margin-top: 13px;" class="mozo-numero"><%= Mozo.numero %></span>
                </button>    		
        <% } else { %>
                <button class='mozo'><img src="<?= IMAGES_URL?>thumb_<%= Mozo.image_url %>" width="64"  class="img-circle" style="position: absolute; top: 10px; left: 10px;"/></button>
        <% } %>

        <h3 class="header text-center">
            <?php
            echo $this->Html->image('mesa-abrio.png') . " " . Configure::read('Mesa.tituloMesa')
            ?>
            <span class="mesa-numero"><%= numero %></span>
        </h3>
    </header>
</script>


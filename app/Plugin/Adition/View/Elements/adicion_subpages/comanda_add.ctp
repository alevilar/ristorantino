
<script id="categorias-tree" type="text/x-template">
		<ol class="tree">
	        	<?php
	        	foreach ($categorias as $c) {
			        echo $this->element('comanda_add/listar_categorias', array('categoria' => $c));
			    }
				?>
        </ol>
</script>


<script id="comanda-add" type="text/x-template">
	    <header>
	        <h1>
	            <span class="mesa-numero"><%= numero %></span>
					<?php
					echo $this->Html->image('mesa-abrio.png') . " " . Configure::read('Mesa.tituloMesa')
					?>
	        </h1>
	    </header>
	
	    <div class="row">
	    	
	    	<div class="span2" class="well	" id="listado_categorias"></div>
	        	
	        <div class="span6" id="listado_productos"></div>
	
	        <div class="span4" id="detalle_productos"></div>
	    </div>    
</script>
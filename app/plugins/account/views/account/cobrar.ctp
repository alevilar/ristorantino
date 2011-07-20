<script type="text/javascript">

var cajero = new Cajero();
cajero.tiposDePagos = <?php echo json_encode($tipo_de_pagos)?>;
cajero.urlGuardar = "<?php echo $html->url('/pagos/add');?>";


// LOS SCROLL BARS !!!!
//var mesas_scrollbar = 0; //este es el que contiene los datos de la mesa. la comanda
//var mesas_listado = 0;//este es el del listado de mesas horizontal
</script>



<div id="listado-mesas-cerradas">
	<div class="listado-mesas">
		<ul id="listado-mesas">
			
		</ul>
	</div>
</div>


<?php echo $this->renderElement('cierre_efectivo_tarjeta');?>

<?php echo $this->renderElement('mesas_scroll');?>

<!--  Script para manejar la actualizacin via ajaxa delas mesas que van cerrando-->
<script type="text/javascript">
<!--

new PeriodicalExecuter(function(pe) {
	 
		new Ajax.Request('<?php echo $html->url('ajax_mesas_x_cobrar.json')?>', {
			  onSuccess: function(transport) {
			  
			   // var mesas_cerradas_json = transport.headerJSON;
			    var mesas_cerradas_json = eval(transport.responseText);
                            cajero.mergearMesasCerradas(mesas_cerradas_json);
                            cajero.eliminarMesasNoCerradas(mesas_cerradas_json);
			    
			    mesas_scrollbar = 0; //este es el que contiene los datos de la mesa. la comanda
			    mesas_listado = 0;//este es el del listado de mesas horizontal
			  }
			});
	}, 2);
//-->
</script>


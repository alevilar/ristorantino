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


<!--  Esta es la ventana que se muesta cuando se hace click sobre una Mesa cerrada
		Es la que muestra los tipos de pagos -->
<div id="cierre-efectivo-tarjeta" style="width: 600px; height: 400px;">
	<div id="cierre-title"></div>
	<h2 style="clear: both;">Tipo de Pago / Cierre</h2>
	<div id="cierre-listado-tipos-de-pago">
	<?php while(list($tipo_de_id,$v) = each($tipo_de_pagos)): ?>
		<a class="boton-tipo-de-pago boton-tipo-de-pago-<?= $tipo_de_id ?>" href="#Cierre" onclick="cajero.guardarCobroDeUna(<?= $tipo_de_id?>)"><?= $v?></a>
	<?php endwhile;?>
	</div>
	
	<h2 style="clear: both;">Acciones</h2>
	<div>
		<a href="#Cobrar" onclick="ventanaSeleccionPago.hide()">Cancel</a>
	</div>
	
	<div>	
		<a href="#Reimprimir" onclick="cajero.reimprimir('<?= $html->url('/mesas/imprimirTicket')?>')">Re Print Ticket</a>
	
	
		<a href="#cancelarCierreDeMesa" onclick="cajero.cancelarCierreDeMesa('<?= $html->url('/mesas/ajax_edit')?>')">Re Abrir Mesa</a>
		
		
		<a href="javascript:" onclick="window.location.href='<?php echo $html->url('/mesas/edit/')?>'+cajero.mesa_id">Editar Mesa</a>
	 	
	 	
		<dl id="cobro-estado"></dl>
	</div>
</div>



<?php echo $this->renderElement('mesas_scroll');?>






<!--  Script para manejar la actualizacin via ajaxa delas mesas que van cerrando-->
<script type="text/javascript">
<!--
var ventanaSeleccionPago;
ventanaSeleccionPago = new Window({
					maximizable: false, 
					resizable: false, 
					hideEffect:Element.hide, 
					showEffect:Element.show,
					destroyOnClose: false
				});
	
ventanaSeleccionPago.setContent('cierre-efectivo-tarjeta', true, true);




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


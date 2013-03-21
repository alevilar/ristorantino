<!--  Esta es la ventana que se muesta cuando se hace click sobre una Mesa cerrada
		Es la que muestra los tipos de pagos -->
<div id="cierre-efectivo-tarjeta" style="width: 600px; height: 400px;">
	<div id="cierre-title"></div>
        <?php if (!empty($tipo_de_pagos) && count($tipo_de_pagos)){ ?>
	<h2 style="clear: both;">Tipo de Egreso / Cierre</h2>
	<div id="cierre-listado-tipos-de-pago">
	<?php while(list($tipo_de_id,$v) = each($tipo_de_pagos)): ?>
		<a class="boton-tipo-de-pago boton-tipo-de-pago-<?= $tipo_de_id ?>" href="#Cierre" onclick="cajero.guardarCobroDeUna(<?= $tipo_de_id?>)"><?= $v?></a>
	<?php endwhile;?>
	</div>
        <?php } ?>

	<h2 style="clear: both;">Acciones</h2>
	<div>
		<a href="#Cobrar" onclick="ventanaSeleccionPago.hide()">Cancel</a>
	</div>

	<div>
            <a href="#Reimprimir" onclick="cajero.reimprimir('<?= $html->url('/mesas/imprimirTicket')?>')">Re Print Ticket</a>
            <a href="#reAbrirMesa" onclick="cajero.cancelarCierreDeMesa('<?= $html->url('/mesas/ajax_edit')?>')">Re Abrir Mesa</a>
            <a href="#cerrarMesa" onclick="cajero.enviarACajero('<?= $html->url('/mesas/ajax_edit')?>')">Cerrar (envia al cajero)</a>
            <a href="javascript:" onclick="window.location.href='<?php echo $html->url('/mesas/edit/')?>'+cajero.mesa_id">Editar Mesa</a>
            <dl id="cobro-estado"></dl>
	</div>
</div>




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



</script>
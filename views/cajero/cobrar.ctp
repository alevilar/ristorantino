<script type="text/javascript">

var cajero = new Cajero();
cajero.tiposDePagos = <?php echo json_encode($tipo_de_pagos)?>;
cajero.urlGuardar = "<?php echo $html->url('/pagos/add');?>";
</script>


<div id="navegador">
	<?php echo $html->link('HOME','/pages/home',array('class'=> 'boton letra-chica'));?>

</div>

<div id="listado-mesas-cerradas">

</div>



<div id="cierre-efectivo-tarjeta" style="display:  width: 400px; height: 300px;">
<?php while(list($k,$v) = each($tipo_de_pagos)): ?>
	<a href="#Cierre" onclick="cajero.guardarCobroDeUna(<?= $k?>)"><?= $v?></a>
<?php endwhile;?>
	
	<div>

		<a href="#Cobrar" onclick="ventanaSeleccionPago.hide()">Cancelar</a>
	</div>
	
	<dl id="cobro-estado">
	
	</dl>
	
</div>



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


new Ajax.PeriodicalUpdater('listado-mesas-cerradas', '<?php echo $html->url('/cajero/mesas_x_cobrar')?>', {
	  method: 'get', frequency: 3, decay: 2
	});


//-->
</script>




<div id="sacar-item-container" style="display: none; width: 460px; height: 200px" class="letra-chica">
	<div class="menu-horizontal">
		<ul id="sacar-item-ul" ></ul>
	</div>
	
	<br>
	<p style="margin-top: 80px; margin-left: 130px;">
		<a href="#" class="boton" onclick="adicion.comandaSacar.enviarComanda(); return false;">Guardar Cambios</a>
	</p>
</div>


<script type="text/javascript">
		sacarItemWindow = new Window({
							maximizable: false, 
							resizable: false, 
							hideEffect:Element.hide, 
							showEffect:Element.show, 
							//minWidth: 100,
							//width: 400,
							//heigth: 500,
							destroyOnClose: false
						});
			
		sacarItemWindow.setContent('sacar-item-container', true, true);



		function callComandaSacar(){
			adicion.comandaSacar = new ComandaSacar(this.currentMozo);
			adicion.comandaSacar.urlEnviarComanda = '<?php echo $html->url('/DetalleComandas/sacarProductos');?>';	

			if(adicion.tieneMesaSeleccionada()){
				adicion.comandaSacar.actualizarComanda(adicion.currentMesa.productos);
				
				adicion.comandaSacar.resetearComanda(adicion.currentMozo, adicion.currentMesa);
				
				sacarItemWindow.showCenter();
			}	
		}
				


</script>
		
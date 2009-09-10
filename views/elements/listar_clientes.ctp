<div id="clientes-listar-container" style="width: 100%; height: 400px;">
	<div id="clientes-listar-header">
		<ul class="menu-horizontal letra-grande"><li><?php echo $ajax->link('Factura A', '/clientes/ajax_clientes_factura_a', array('update'=>'clientes-listado'));?></li></ul>
	</div>
	
	<div id="clientes-listado"></div>

<?php ?>
</div>



<script type="text/javascript">
		var listadoClientesWindow;
		listadoClientesWindow = new Window({
							maximizable: false, 
							resizable: false, 
							//hideEffect:Element.hide, 
							//showEffect:Element.show, 
							//minWidth: 100,
							//width: 400,
							//heigth: 500,
							destroyOnClose: false
						});
			
		listadoClientesWindow.setContent('clientes-listar-container', true, true);


		function callListarClientes(){
			listadoClientesWindow.showCenter();
		}


		function agregarClienteACurrentMesa(cliente_id){

			//uso lavariable global
			//@Global adicion
			new Ajax.Request("<?php echo $html->url('/mesas/ajax_edit')?>", {
				  parameters: { 'data[Mesa][id]': adicion.currentMesa.id, 'data[Mesa][cliente_id]': cliente_id},
				  method: 'post',
				  onSuccess: function(){
					  listadoClientesWindow.hide();
						$('boton-cliente').addClassName('boton-apretado');
					  }
				});				
			
			
		}


</script>


		
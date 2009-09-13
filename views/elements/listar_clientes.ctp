<div id="clientes-listar-container" style="width: 100%; height: 500px;">
	<div id="clientes-listar-header">
		<ul class="menu-horizontal letra-grande"><li><?php echo $ajax->link('Factura A', '/clientes/ajax_clientes_factura_a', array('update'=>'clientes-listado'));?></li></ul>
		<ul class="menu-horizontal letra-grande"><li><?php echo $ajax->link('Cliente Con Descuento', '/clientes/ajax_clientes_con_descuento', array('update'=>'clientes-listado'));?></li></ul>
	
	</div>
	
	<div id="clientes-listado"></div>

<?php ?>
</div>



<script type="text/javascript">

/*******************************************************************************************
 * 
*				INICIALIZACION
* 
 ********************************************************************************************/
		var listadoClientesWindow;
		listadoClientesWindow = new Window({
							maximizable: false, 
							resizable: false, 
							//hideEffect:Element.hide, 
							//showEffect:Element.show,
							destroyOnClose: false
						});
			
		listadoClientesWindow.setContent('clientes-listar-container', true, true);



	

/*******************************************************************************************
 * 
*				DECLARACION DE FUNCIONES
* 
 ********************************************************************************************/

 // esta funcion es para ser usada en el link que llama a este modulo es el callback del onclick
	function callListarClientes(){
		if(adicion.tieneMesaSeleccionada()){
			if(adicion.currentMesa.cliente.id == null || adicion.currentMesa.cliente.id == 0){
				listadoClientesWindow.showCenter();
			}
			else {
				if(adicion.currentMesa.cliente.nombre){
					Dialog.confirm("<h1>Cliente: </h1>"+adicion.currentMesa.cliente.nombre,{width:300, height:150, okLabel: "Cerrar"} );
				}
				
				if( adicion.currentMesa.cliente.denominacion){
					Dialog.confirm("<h1>Factura 'A' a nombre de: </h1><br>"+adicion.currentMesa.cliente.denominacion,{
						width:300, 
						height:150, 
						okLabel: "Eliminar Cliente",
						cancelLabel: "Cerrar",
						//cancel:function() {},
						ok: borrarCliente
					} );
				}
			}
		}
	}


	function borrarCliente(){
		adicion.currentMesa.cliente.id = null; 
		
		// lo mando via ajax para que se guarde
		borrarClienteACurrentMesa();

	}

// esta es la funcion AJAX que hace que se envien los datos al modelo
	function agregarClienteACurrentMesa(cliente_id){

		//uso lavariable global
		//@Global adicion
		new Ajax.Request("<?php echo $html->url('/mesas/ajax_edit')?>", {
			  parameters: { 'data[Mesa][id]': adicion.currentMesa.id, 'data[Mesa][cliente_id]': cliente_id},
			  method: 'post',
			  onSuccess: function(){
				  listadoClientesWindow.hide();
				  adicion.resetear();
				  }
			});	
	}


	// esta es la funcion AJAX que hace que se envien los datos al modelo
	function borrarClienteACurrentMesa(){
		//uso lavariable global
		//@Global adicion
		new Ajax.Request("<?php echo $html->url('/mesas/ajax_edit')?>", {
			  parameters: { 'data[Mesa][id]': adicion.currentMesa.id, 'data[Mesa][cliente_id]': 0},
			  method: 'post',
			  onSuccess: function(){
				  listadoClientesWindow.hide();
					$('boton-cliente').removeClassName('boton-apretado');
					adicion.resetear();
					Dialog.closeInfo();
				  }
			});	
	}
</script>


		


	<div id="mesa-imprimir-como-menu" style="display: none; width: 400px; height: 300px;">
		<form action="javascript:return false;" id="mesa-menu-form" name="mesa-menu-form" onsubmit="sendImprimirComoMenu();">
			<input type="text" name="mesa-menu" id="mesa-menu">
			<input type="submit" value="Guardar">
		</form>
		<div id="contenedor-numPad-menu"></div>
	</div>
	



<script type="text/javascript">
		var imprimirComoMenuWindow;
		imprimirComoMenuWindow = new Window({
							maximizable: false, 
							resizable: false, 
							hideEffect:Element.hide, 
							showEffect:Element.show,
							destroyOnClose: false
						});
			
		imprimirComoMenuWindow.setContent('mesa-imprimir-como-menu', true, true);


		function callImprimirComoMenu(){
			if (adicion.tieneMesaSeleccionada()){
		
				//NUMPAD ------------------------------------------------------		
				//numPad es una variable global
				$('contenedor-numPad-menu').update();
				numPad = new NumpadControl('contenedor-numPad-menu');   
				    			    	
				numPad.show($('mesa-menu'));		        
				
				//---------------------------------------  -------------------------
				$('mesa-menu-form').focusFirstElement();
	
				// contenedorImprimirComoMenu es una variable declarada como global
				imprimirComoMenuWindow.showCenter();
			}
		}


		function sendImprimirComoMenu(){

			//uso lavariable global
			//@Global adicion
			new Ajax.Request("<?php echo $html->url('/mesas/ajax_edit')?>", {
				  parameters: { 'data[Mesa][id]': adicion.currentMesa.id, 'data[Mesa][menu]': $F('mesa-menu')},
				  method: 'post',
				  onSuccess: function(){
					  imprimirComoMenuWindow.hide();
						$('boton-menu').addClassName('boton-apretado');

						mensajero.show("La mesa "+adicion.currentMesa.numero+" se imprimirá como menú x "+$F('mesa-menu'));
						adicion.resetear();
					  }
				});				
			
			
		}


</script>
	
	
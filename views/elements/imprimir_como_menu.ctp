

	<div id="mesa-imprimir-como-menu" style="display: none; width: 400px; height: 300px;">
		<?php 			
			echo $ajax->form('imprimir_como_menu','post',array(
				'type' => 'post',
				'id' => 'MesaImprimirComoMenu',
			    'options' => array(
			        'model'=>'Mesa',
			        'url' => array(
			            'controller' => 'mesas',
			            'action' => 'imprimir_como_menu'
			        ),
			        'complete'=>'$$("href:#ConvertirEnMenu").addClassName("boton-apretado")'
			    )
			));
			
			
			echo $form->input('id',array('type'=>'hidden','value'=>$current_mesa_id));
			echo $form->input('menu');
			echo $form->button('Cancelar',array('onclick'=>'contenedorImprimirComoMenu.hide();'));
			echo $form->end('Guardar');
		?>
		<div id="contenedor-numPad-menu"></div>
	</div>
	


<script type="text/javascript">
		var contenedorImprimirComoMenu = null;

		
		contenedorImprimirComoMenu = new Window({
								maximizable: false, 
								resizable: false, 
								hideEffect:Element.hide, 
								showEffect:Element.show, 
								minWidth: 10,
								destroyOnClose: false
					});
		
		contenedorImprimirComoMenu.setContent('mesa-imprimir-como-menu', true, true);

		function mostrarContenedorImprimirComoMenu(){
			//reseteo el ID de la mesa
			$('MesaAbrirMesaForm')

			$('contenedor-numPad-menu').update();
			
			//NUMPAD ------------------------------------------------------		
			//numPad es una variable global
			numPad = new NumpadControl('contenedor-numPad-menu');   
			    			    	
			numPad.show($('menu'));		        
			
			//---------------------------------------  -------------------------
			$('MesaAbrirMesaForm').focusFirstElement();

			// contenedorImprimirComoMenu es una variable declarada como global
			contenedorImprimirComoMenu.showCenter();
		}
			
</script>
	
	
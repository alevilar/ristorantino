
<script type="text/javascript">
<!--

//console.info('Iniciando aplicacion');


var fabricaMozo = new FabricaMozo(<?php echo $current_mozo?>);

var adicion = new Adicion(fabricaMozo.getMozo());





//NUMPAD ------------------------------------------------------
var txtNumber = null;
var numPad = null; //este se tiene que llamar asi para que funcione

//-->
</script>


<?php 

	/*------------------------------------------------------------------------------------------------------------------------------------*/
/*-****************************************************-------------------
 * ACA RENDERIZO ELEMENTOS QUE NO SE VEN HASTA QUE SON LLAMADOS
 * 
 * por lo general se usan con los modal windows ventanas y cosas por el estilo
 */
	echo $this->renderElement('listar_clientes');		
	echo $this->renderElement('loading');
	
	echo $this->renderElement('adicion/comanda_cocina');	
	echo $this->renderElement('adicion/comanda_sacar');	
	echo $this->renderElement('adicion/abrir_mesa');		
	echo $this->renderElement('adicion/imprimir_como_menu');
	//echo $this->renderElement('adicion/set_comensales');
	
	/*------------------------------------------------------------------------------------------------------------------------------------*/
?>

	<div id="adicion-cabecera">
		

		<a href="#F5Refresh" id="f5-refresh" class="boton" style="float: left" onclick="parent.location.reload();">
		Refresh
		</a>
		<?php echo $this->renderElement('adicion/cambiar_mesa_listar_todas_abiertas');?>	
			
		<?php echo $this->renderElement('mensajes');?>		
	</div>	

	
	
	
	
	
<div id="mesas-listado">
	<?php echo $this->renderElement('adicion/cambiar_mozo');?>	
	
    <div id="LeftArrow">
       <?= $html->link("Izquierda",      					
       					'#moveLeft',
       					//opciones extra 
       					 array(	'escape' => false,
       					 		'class'=>'arrow boton-simple',
       					 		'onClick'=>"MoveMesaLeft()",
       					 		'alt'=>'Mover a la izquierda'
       					 ));?>
    </div>     
    <div id="ScrollMesaBox">
        <ul  id="mesas-contenedor">
        	<li><?php echo $html->link(' + ','#AbrirMesa',array('onclick'=>"adicion.abrirMesa(); return false;",
																'class'=>'boton-simple','id'=>'abrir-mesa'))?></li>
																
		<?php foreach ($this->data['Mesa'] as $m):?>																
			<?php $add_class = ($m['time_cerro'] !=  '0000-00-00 00:00:00')?' mesa-cerrada':'';?>
			<?php echo '<li>'.$ajax->link($m['numero'],'/mesas/view/'.$m['id'], array( 	'update'=>'mesa-scroll',
																						'id'=>'mesa-ver-'.$m['id'],
																						'class'=>'boton redondeado-arriba '.$add_class,
																						'evalScripts'=>true
							)).'</li>'
			?>
		<?php endforeach; ?>
		</ul>
    </div>
  		
		
    <div id="RightArrow">
     <?= $html->link("Derecha",      					
       					'#moveRight',
       					//opciones extra 
       					 array(	'escape' => false,
       					 		'class'=>'arrow boton-simple',
       					 		'onClick'=>"MoveMesaRight()",
       					 		'alt'=>'Mover a la derecha'));?>
        
    </div>  
</div>

	
	<script type="text/javascript">
<!--
	Event.observe('mesas-contenedor', 'click', function(event) {
		  var element = Event.element(event);
		  //removeClassName,'mesa-seleccionada'
		  $$('.mesa-seleccionada').each(function(e){e.removeClassName('mesa-seleccionada')});
		  
		  //element.addClassName('mesa-seleccionada');
		  if(element.id){
		  	$(element.id).addClassName('mesa-seleccionada');
		  }
		});

//-->
</script>
	
	


<div id="mesa-container">
	<div id="mesa-acciones" class="menu-vertical">
		<ul>
			<li><?php echo $html->link('Comanda','#AgregarProducto',array('onClick'=>'callComandaCocina(); return false;','boton-comanda'));?></li>
			<li><?php echo $html->link('Sacar Item','#SacarProducto',array('onclick'=>'callComandaSacar(); return false;','id'=>'boton-sacar-item'));?></li>
			<li><?php echo $html->link('Cliente','#SeleccionCliente',array('onclick'=>'callListarClientes(); return false;','id'=>'boton-cliente'));?></li>
			<li><?php echo $html->link('Menú','#ConvertirEnMenu',array('onclick'=>'callImprimirComoMenu(); return false;','id'=>'boton-menu'));?></li>
			
			<!-- <li><?php echo $html->link('Comensales','#Comensales',array('id'=>'btn-comensales'));?></li> -->
			
			<li><?php echo $html->link('Cerrar Mesa',"#cerrarMesa",array('onClick'=>'adicion.cerrarCurrentMesa()'));?></li>
		</ul>
	</div>
	
	
	<div id="mesa-acciones-2" class="menu-vertical">
		<ul>
		<!-- ESTOS VAN A ESTAR EN LA PROXIMA VERSION -->
		<!-- <li><?php echo $html->link('Comensales','#Comensales',array('alt','ingrese datos estadisticos'));?></li> -->
		<!-- <li><?php echo $html->link('Nº Mesa','#CambiarNumeroDeMesa');?></li> -->	
		<!-- <li><?php echo $html->link('Mozo Socio','#MozoSocio');?></li> -->				
		</ul>
	</div>
	
	<div id="mesa-data">	
		<div  id="mesa-scroll">	</div>
	</div>
</div>


<?php echo $this->renderElement('mesas_scroll');?> -->


<div id="sistem-nav">
	<?php echo $html->link('SALIR','/pages/home')?>
</div>
 
 



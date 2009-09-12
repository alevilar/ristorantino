
<script type="text/javascript">
<!--

console.info('Iniciando aplicacion');


var fabricaMozo = new FabricaMozo(<?php echo $current_mozo?>);

var adicion = new Adicion(fabricaMozo.getMozo());



//inicializalizo los scrollbars
var mesas_scrollbar = 0; //este es el que contiene los datos de la mesa. la comanda
var mesas_listado = 0;//este es el del listado de mesas horizontal


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
	
	echo $this->renderElement('adicion/comanda');	
	echo $this->renderElement('adicion/sacar_item');	
	echo $this->renderElement('adicion/abrir_mesa');		
	echo $this->renderElement('adicion/imprimir_como_menu');	
	
	/*------------------------------------------------------------------------------------------------------------------------------------*/
?>

	<div id="adicion-cabecera">
		<?php echo $this->renderElement('adicion/cambiar_mozo');?>		
		<?php echo $this->renderElement('mensajes');?>		
	</div>	

	
	
	
	
	
<div id="mesas-listado">
    <div id="LeftArrow">
       <?= $html->link($html->image('left.png'),      					
       					'#moveLeft',
       					//opciones extra 
       					 array(	'escape' => false,
       					 		'class'=>'arrow boton',
       					 		'onClick'=>"MoveMesaLeft()",
       					 		'alt'=>'Mover a la izquierda'
       					 ));?>
    </div>     
    <div id="ScrollMesaBox">
        <ul  id="mesas-contenedor">
		<?php foreach ($this->data['Mesa'] as $m):?>
			<?php $add_class = ($m['time_cerro_mesa'] !=  '0000-00-00 00:00:00')?' mesa-cerrada':'';?>
			<?php echo '<li>'.$ajax->link($m['numero'],'/mesas/view/'.$m['id'], array( 	'update'=>'mesa-scroll',
																						'id'=>'mesa-ver-'.$m['id'],
																						'class'=>'boton'.$add_class,
																						'evalScripts'=>true
							)).'</li>'
			?>
		<?php endforeach; ?>
			<li><?php echo $html->link(' + ','#AbrirMesa',array('onclick'=>"adicion.abrirMesa(); return false;",
																'class'=>'boton'))?></li>
		</ul>
    </div>
  		
		
    <div id="RightArrow">
     <?= $html->link($html->image('right.png'),      					
       					'#moveRight',
       					//opciones extra 
       					 array(	'escape' => false,
       					 		'class'=>'arrow boton',
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
		  $(element.id).addClassName('mesa-seleccionada');
		});

//-->
</script>
	
	


<div id="mesa-container">
	<div id="mesa-acciones" class="menu-vertical">
		<ul>
			<li><?php echo $html->link('Comanda','#AgregarProducto',array('onClick'=>'adicion.hacerComanda(); return false;','boton-comanda'));?></li>
			<li><?php echo $html->link('Sacar Item','#SacarProducto',array('onclick'=>'adicion.hacerComandaSacar(); return false;','id'=>'boton-sacar-item'));?></li>
			
			<li><?php echo $html->link('Nº Mesa','#CambiarNumeroDeMesa');?></li>	
			<li><?php echo $html->link('Mozo Socio','#MozoSocio');?></li>
			<li><?php echo $html->link('Cerrar Mesa',"#cerrarMesa",array('onClick'=>'adicion.cerrarCurrentMesa()'));?></li>
		</ul>
	</div>
	
	<div id="mesa-acciones-2" class="menu-vertical">
		<ul>
			<li><?php echo $html->link('Comensales','#Comensales',array('alt','ingrese datos estadisticos'));?></li>
			<li><?php echo $html->link('Cliente','#SeleccionCliente',array('onclick'=>'callListarClientes(); return false;','id'=>'boton-cliente'));?></li>
			<li><?php echo $html->link('Menú','#ConvertirEnMenu',array('onclick'=>'callImprimirComoMenu(); return false;','id'=>'boton-menu'));?></li>	
		</ul>
	</div>
	
	<div id="mesa-data">	
		<div  id="mesa-scroll">	</div>
	</div>
</div>


<div id="mesas-scrollbar" class="arrow">
		<div id="UpArrow">
	       <?= $html->link($html->image('up.png'),      					
	       					 array('action' => '#moveUp'),
	       					//opciones extra 
	       					 array(	'escape' => false, 
	       					 		'onClick'=>'MoveMesaUp();return false;',
	       					 		'class'=>'arrow',
	       					 		'alt'=>'Mover hacia arriba'
	       					 ));?>
	    </div>
	    <div id="DownArrow">
	     <?= $html->link($html->image('down.png'),      					
	       					 array('action' => '#moveDown'),
	       					//opciones extra 
	       					 array(	'escape' => false, 
	       					 		'onClick'=>'MoveMesaDown();return false;',
	       					 		'class'=>'arrow',
	       					 		'alt'=>'Mover hacia abajo'));?>
	        
	    </div>  
</div>


<div id="sistem-nav">
	<?php echo $html->link('SALIR','/pages/home')?>
</div>
 
 



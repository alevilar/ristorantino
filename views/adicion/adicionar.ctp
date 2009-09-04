
<script type="text/javascript">
<!--

console.info('Iniciando aplicacion');

var mensajero = new Mensaje('mensajes');
mensajero.setImageLoading('<? echo $html->url('/img/loader.gif',true)?>');

//este es para el navegador de categorias de productos que se lo llma desde ajax
this.manejadorCategorias = null; 


var fabricaMesa = new FabricaMesa(<?php echo $current_mesa?>);
var fabricaMozo = new FabricaMozo(<?php echo $current_mozo?>);

var adicion = new Adicion(fabricaMozo.getMozo(), fabricaMesa.getMesa());



//inicializalizo los scrollbars
var mesas_scrollbar = 0; //este es el que contiene los datos de la mesa. la comanda
var mesas_listado = 0;//este es el del listado de mesas horizontal


//NUMPAD ------------------------------------------------------
var txtNumber = null;
var numPad = null; //este se tiene que llamar asi para que funcione

//-->
</script>


<?php 
	echo $this->renderElement('loading');
?>

<div id="adicion-cabecera">
	<div id="cambiar-mozos" class="menu-horizontal" style="display: none; width: 280px">
		<ul>
			<?php foreach ($mozos as $mozo):?>
				<li><?php echo $html->link($mozo['Mozo']['numero'],'/adicion/cambiarMozo/'.$mozo['Mozo']['id'],array('class'=>'boton letra-grande'));?></li>
			<?php endforeach;?>
		</ul>
	</div>
	<script type="text/javascript">
		var contenedorMozos = null;

		contenedorMozos = new Window({
						maximizable: false, 
						resizable: false, 
						hideEffect:Element.hide, 
						showEffect:Element.show, 
						minWidth: 10,
						width: 400,
						heigth: 400,
						destroyOnClose: false
					});
		
		contenedorMozos.setContent('cambiar-mozos', true, true);
				//contentWin.getContent().innerHTML= $('cambiar-mozos-template').innerHTML;
			
	</script>
	
	<a href="#cambiarMozo" id="mozo-numero" class="boton" style="float: left" onclick="contenedorMozos.showCenter();">Mozo</a>
	
	<script type="text/javascript">
		if(adicion.currentMozo){
			$("mozo-numero").update("Mozo "+adicion.currentMozo.numero);
		}
	</script>
	
	
	
	
	
	
	<div id="numero-mesa"></div>
	
	
	<div id="mensajes"><?php $session->flash(); ?></div>
	<script type="text/javascript">
		var canMesas = "<?= sizeof($this->data['Mesa'])?>";
		mensajero.show(canMesas+" Mesas Abiertas");
	</script>	
	
	
</div>	
	
	<div id="mesa-abrir" style="display: none">
		<?php 
			echo $form->create('Mesa',array('action'=>'abrirMesa'));
			echo $form->input('mozo_id',array('type'=>'hidden','value'=>$current_mozo_id));
			echo $form->input('numero',array('label'=>'','style'=>'float:left;'));
			echo $form->button('Cancelar',array('onclick'=>'Dialog.closeInfo();'));
			echo $form->end('Abrir mesa');
		?>
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
			<?php echo '<li>'.$ajax->link($m['numero'],'/mesas/view/'.$m['id'], array( 	'update'=>'mesa-scroll',
																						'id'=>'mesa-ver-'.$m['id'],
																						'class'=>'boton',
																						'evalScripts'=>true,
																						'complete' => 'adicion.cambiarMesa();'
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


<div id="mesa-container">
	<div id="mesa-acciones" class="menu-vertical">
		<ul>
			<li><?php echo $html->link('Comanda','#AgregarProducto',array('onClick'=>'adicion.hacerComanda(); return false;'));?></li>
			<li><?php echo $html->link('Factura "A"','#TipoFactura');?></li>
			<li><?php echo $html->link('Cliente','#SetearCliente');?></li>
			<li><?php echo $html->link('Menú','#ConvertirEnMenu');?></li>
			<li><?php echo $html->link('Invitación','#AplicarInvitacion');?></li>
			
			<li><?php echo $html->link('Cerrar Mesa',"#cerrarMesa",array('onClick'=>'adicion.cerrarCurrentMesa();'));?></li>
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

 
 
 <div id="contenedor-comandas"></div>


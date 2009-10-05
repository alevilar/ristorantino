<script type="text/javascript">
<!--
//inicializalizo los scrollbars
var mesas_scrollbar = 0; //este es el que contiene los datos de la mesa. la comanda
var mesas_listado = 0;//este es el del listado de mesas horizontal

//-->
</script>

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
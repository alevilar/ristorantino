

 <div id="contenedor-comandas" style="display: none;"></div>
 

<script type="text/javascript">
<!--

/*****************************************************************************
 * 
 *				COMANDA ----  Modulo para armar la comanda y mandarla usando Ajax
 *
 *****************************************************************************/
/**
 * 


 Se hace todo desde el javascript /comanda.class.js
 */

 

//este es para el navegador de categorias de productos que se lo llma desde ajax
//this.manejadorCategorias = null; 


// la calase AAdicion tiene una comanda, yo la inicializo desde aca y se la meto a la adicion cuando se cargó la pagina
Event.observe(window, 'load', function() {
	// creo la comanda y su vista
	adicion.comanda = new ComandaCocina(adicion.currentMozo);	
	adicion.comanda.urlEnviarComanda = '<? echo $html->url('/DetalleComandas/add');?>';
	
	var menuDiv = new Element('div',{'id':'productos-contenedor'});
	
	$('contenedor-comandas').appendChild(menuDiv);
	
	// esto hace que se cargen las categorias y productos de productos-contenedor
	new Ajax.Updater(menuDiv, '<?php echo $html->url('/categorias/listar')?>', { method: 'get', 'evalScripts' :true });	
	

});



//-->
</script>

 
 
 <script type="text/javascript">
<!--

comandaCocinaWindow = new Window({
	maximizable: false, 
	resizable: false, 
	hideEffect:Element.hide, 
	showEffect:Element.show, 
	//minWidth: 100,
	//width: 400,
	//heigth: 500,
	destroyOnClose: false
});

comandaCocinaWindow.setContent('contenedor-comandas', true, true);



function callComandaCocina(){
	if(adicion.tieneMesaSeleccionada()){
		comandaCocinaWindow.showCenter();
	}	
}

//-->
</script>
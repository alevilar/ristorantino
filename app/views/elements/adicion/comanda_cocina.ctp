

 <div id="contenedor-comandas" style="display: none;">
 	<div id="comanda">
 		<h1 id="comanda-prioridad-titulo">Comanda</h1>
 		
 		
 		<ul id="comanda-enviar" class="menu-horizontal">
			<li><a id="btn-imprimir-comanda" class="boton-chico letra-chica" href="#EnviarComanda" onclick="adicion.comanda.imprimirComanda(); return false;">Mandar Comanda</a></li>
			<li><a id="btn-sinimprimir-comanda" class="boton-chico letra-chica" href="#EnviarComandaNoImprimir" onclick="adicion.comanda.guardarComanda(); return false;">Sin imprimir</a></li>
			<li><a id="btn-observacion-comanda" class="boton-chico letra-chica" href="#AgregarObservacion" onclick="adicion.comanda.agregarObservacion(); return false;">Agregar Observación</a></li>
			<li><a id="btn-seleccionar-entradas" class="boton-chico letra-chica" href="#SeleccionarEntradas" onclick="adicion.comanda.seleccionarEntradas(); return false;">Entradas</a></li>
		</ul>

		<ul id="comanda-ul" class="menu-horizontal"></ul>

 	</div>
 	
 	<div><h1 id="comanda-productos-titulo">Categorias</h1></div>
 	
 	<div id="productos-contenedor"></div>
 	<div id="comanda-observacion-div" style="display:none">
 		<h2>Escriba una observación sobre ésta comanda</h2>
 		<textarea id="comanda-observacion" name="data[Comanda][observacion]" COLS=40 ROWS=6></TEXTAREA>
 	</div>
 </div>
 

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
	
    $("comanda-prioridad-titulo").observe('click', function(){adicion.comanda.tooglePrioridad();});
        

    
	// creo la comanda y su vista
	adicion.comanda = new ComandaCocina(adicion.currentMozo);	
	adicion.comanda.urlEnviarComanda = '<? echo $html->url('/DetalleComandas/add');?>';
	
	// esto hace que se cargen las categorias y productos de productos-contenedor
	new Ajax.Updater('productos-contenedor', '<?php echo $html->url('/categorias/listar')?>', { method: 'get', 'evalScripts' :true });	
	
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



function callComandaCocina()
{
	if(adicion.tieneMesaSeleccionada()){
		 
		adicion.comanda.resetearComanda(adicion.currentMozo, adicion.currentMesa);
	
		comandaCocinaWindow.showCenter();
	}	
}

//-->
</script>
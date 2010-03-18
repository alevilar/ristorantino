

<div id="contenedor-comandas" style="display: none;">


    <div id="comanda">
        <h1 id="comanda-prioridad-titulo">Comanda</h1>

        <ul id="comanda-enviar" class="menu-horizontal">
            <li>
                <a id="btn-imprimir-comanda" class="boton-chico letra-chica" href="#EnviarComanda"
                   ondblclick="alert('Cuidado! hiciste doble click y esto hacia que \nse envien 2 comandas a la cocina. Vuelva a intentar haciendo solo 1 click.');"
                   onclick="adicion.comanda.imprimirComanda(); return false;">Mandar Comanda
                </a>
            </li>
            <li><a id="btn-sinimprimir-comanda" class="boton-chico letra-chica" href="#EnviarComandaNoImprimir" onclick="adicion.comanda.guardarComanda(); return false;">Sin imprimir</a></li>
            <li><a id="btn-observacion-comanda" class="boton-chico letra-chica" href="#AgregarObservacion" onclick="adicion.comanda.agregarObservacion(); return false;">Agregar Observación</a></li>
            <li><a id="btn-seleccionar-entradas" class="boton-chico letra-chica" href="#SeleccionarEntradas" onclick="adicion.comanda.seleccionarEntradas(); return false;">Entradas</a></li>
        </ul>



        <ul id="comanda-ul" class="menu-horizontal"></ul>

    </div>

    <ul class="menu-horizontal">
        <li><a href="#" onclick="$('buscar-productos-contenedor').hide();">Categorias</a></li>
        <li><a href="#" onclick="$('buscar-productos-contenedor').show();">Buscar</a></li>
    </ul>

    <div id="buscar-productos-contenedor" style="display: none;">
        <br><br>
        <form id="form-buscador-producto-nombre" action="javascript:"	>
            <input id="buscador-producto-nombre" />
        </form>
        <ul class="menu-horizontal" id="buscar-productos-listado"></ul>
    </div>

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



    // la calase AAdicion tiene una comanda, yo la inicializo desde aca y se la meto a la adicion cuando se cargó la pagina
    Event.observe(window, 'load', function() {

        $('boton-comanda').observe('click',function(){
            callComandaCocina();
        });

        $("comanda-prioridad-titulo").observe('click', function(){adicion.comanda.tooglePrioridad();});



        // creo la comanda y su vista
        adicion.comanda = new ComandaCocina(adicion.currentMozo);
        adicion.comanda.urlEnviarComanda = '<? echo $html->url('/DetalleComandas/add');?>';

        // esto hace que se cargen las categorias y productos de productos-contenedor
        new Ajax.Updater('productos-contenedor', '<?php echo $html->url('/categorias/listar')?>', { method: 'get', 'evalScripts' :true });

    });





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

        Event.observe(
        'form-buscador-producto-nombre',
        'submit',
        function(event) {
            manejadorCategorias.urlBuscarPorNombre = "<?php echo $html->url("/productos/buscar_por_nombre");?>";
            //$('buscador-producto-nombre').value = $('buscador-producto-nombre').value+String.fromCharCode(event.charCode)
            manejadorCategorias.buscarProductoNombre($('buscador-producto-nombre').value);
        });
    }

    //-->
</script>
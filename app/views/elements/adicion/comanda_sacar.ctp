

<div id="sacar-item-container" style="display: none; width: 600px; height: 500px;" class="letra-chica">
    <p>
        <a href="#" class="boton" onclick="adicion.comandaSacar.enviarComanda(); return false;">Guardar Cambios</a>
    </p>

    <div class="menu-horizontal">
        <ul id="sacar-item-ul"></ul>
    </div>

    <br>

</div>


<script type="text/javascript">
    sacarItemWindow = new Window({
        maximizable: true,
        resizable: true,
        hideEffect:Element.hide,
        showEffect:Element.show,
        //minWidth: 100,
        //width: 400,
        //heigth: 500,
        destroyOnClose: false
    });

    sacarItemWindow.setContent('sacar-item-container', true, true);


    function callComandaSacar(){
        //Sound.play(urlSonido,{replace:true});
        
        adicion.comandaSacar = new ComandaSacar(this.currentMozo);
        adicion.comandaSacar.urlEnviarComanda = '<?php echo $html->url('/DetalleComandas/sacarProductos');?>';
        
        if(adicion.tieneMesaSeleccionada()){
            adicion.comandaSacar.inicializarComanda(adicion.currentMesa.productos); // me arma la parte grafica con los links observados por prototype
        
            adicion.comandaSacar.actualizarComanda(adicion.currentMesa.productos);

            //me carga el mozo,la mesa, y me hace unnew ARray() del array de productos this.productos
            adicion.comandaSacar.resetearComanda(adicion.currentMozo, adicion.currentMesa);

            sacarItemWindow.showCenter();
        }
    }




    Event.observe(window, 'load', function(){
       $('boton-sacar-item').observe('click', callComandaSacar);
    });



</script>

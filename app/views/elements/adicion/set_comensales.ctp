<div id="div-comensales" style="display: none; width: 500px; height: 500px;">
    <form action="javascript:return false;" 
          id="mesa-cant-comensales-form" name="mesa-menu-form"
          onsubmit="guardarDatosDeLosComensales();">
        <input type="text" name="mesa-cant-comensales" id="mesa-cant-comensales">
        <input type="submit" value="Guardar">
    </form>
    <div id="contenedor-numPad-menu-comensales"></div>
</div>



<script type="text/javascript">

    function showComensalesWindow(){
        if(adicion.tieneMesaSeleccionada()){
            $('div-comensales').show();
            var ops = {
                hideEffect:Element.hide,
                showEffect:Element.show,
                //className: 'alert_simple',
                zIndex: 2000,
                width:400,
                height:400,
                showProgress: false,
                destroyOnClose: true
            };
            Dialog.info("<h1>Comensales</h1>"+$('div-comensales').innerHTML, ops);

            //NUMPAD ------------------------------------------------------
            //numPad es una variable global
            $('contenedor-numPad-menu-comensales').update();
            numPad = new NumpadControl('contenedor-numPad-menu-comensales');

            numPad.show($('mesa-cant-comensales'));

            //---------------------------------------  -------------------------
            $('mesa-cant-comensales').focus();
        }
    }
    
    Event.observe(window,'load',function(){
        $('btn-comensales').observe('click', showComensalesWindow);
    });



    var setComensalesWindow;
    setComensalesWindow = new Window({
        maximizable: false,
        resizable: false,
        hideEffect:Element.hide,
        showEffect:Element.show,
        destroyOnClose: false
    });

    setComensalesWindow.setContent('div-comensales', true, true);


    function guardarDatosDeLosComensales(){
        //uso lavariable global
        //@Global adicion
        var cantComensales = 0;
        if ($F('mesa-cant-comensales')) {
            cantComensales = $F('mesa-cant-comensales');
        }

        new Ajax.Request("<?php echo $html->url('/mesas/ajax_edit')?>",
        {
            parameters: {
                'data[Mesa][id]': adicion.currentMesa.id,
                'data[Mesa][cant_comensales]': cantComensales
            },
            method: 'post',
            onSuccess: function(){
                setComensalesWindow.hide();
                Dialog.closeInfo();
                $('btn-comensales').addClassName('boton-apretado');
                $('btn-comensales').update(cantComensales + ' Comansales')
                mensajero.show("La mesa "+adicion.currentMesa.numero+" tiene "+cantComensales+ " comensales.");
                adicion.resetear();
            },
            onFailure: function(){
                alert("Se ha perdido conexion con el server. Reintente.");
                setComensalesWindow.hide();
                Dialog.closeInfo();
            }
        }
    );
    }


</script>
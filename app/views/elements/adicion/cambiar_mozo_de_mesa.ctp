
<div id="cambiar-mozo-de-mesa" class="menu-horizontal" style="display: none; width: 300px">
    <ul>
        <?php foreach ($mozos as $mozo):?>
        <li>
                <?php
                echo $html->link(
                        $mozo['Mozo']['numero'],
                        '/adition/adicionar/mozo_id:'.$mozo['Mozo']['id'],
                        array(
                            'class'=>'boton redondeado letra-grande',
                            'style'=> 'font-size: xx-large',
                            'onclick' => 'cambiarMozoDeMesa('.$mozo['Mozo']['id'].');'
                        )
                );
                ?>
        </li>
        <?php endforeach;?>
    </ul>
</div>

<script type="text/javascript">

    var contenedorCambiarMozosDeMesa = null;

    contenedorCambiarMozosDeMesa = new Window({
        maximizable: false,
        resizable: false,
        hideEffect:Element.hide,
        showEffect:Element.show,
        minWidth: 10,
        width: 400,
        heigth: 400,
        destroyOnClose: false
    });


    contenedorCambiarMozosDeMesa.setContent('cambiar-mozo-de-mesa', true, true);


    function cambiarMozoDeMesa(nuevoMozoId){
        if (nuevoMozoId == null) {
            contenedorCambiarMozosDeMesa.showCenter();
            return true;
        }

        new Ajax.Request("<?php echo $html->url('/mesas/ajax_edit')?>",
        {
            parameters: {
                'data[Mesa][id]': adicion.currentMesa.id,
                'data[Mesa][mozo_id]': nuevoMozoId
            },
            method: 'post',
            onSuccess: function(){
                adicion.refrescarMesaView();
                contenedorCambiarMozosDeMesa.hide();
                mensajero.show("Número de mozo modificado correctamente");
                //adicion.resetear();
            },
            onFailure: function(){
                alert("Se ha perdido conexion con el server. Reintente.");
                contenedorCambiarMozosDeMesa.hide();
            }
        }
    );
    }



</script>













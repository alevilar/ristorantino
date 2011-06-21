<script type="text/javascript">
    adicion.addButton('abrirMesa');
    adicion.addButton('seleccionarMesa');
</script>

<?php

/*------------------------------------------------------------------------------------------------------------------------------------*/
/*-****************************************************-------------------
 * ACA RENDERIZO ELEMENTOS QUE NO SE VEN HASTA QUE SON LLAMADOS
 * 
 * por lo general se usan con los modal windows ventanas y cosas por el estilo
*/
//echo $this->renderElement('adicion/seleccion_de_mozos_y_mesas');

//echo $this->renderElement('listar_clientes');
//echo $this->renderElement('loading');
//echo $this->renderElement('adicion/comanda_cocina');
//echo $this->renderElement('adicion/comanda_sacar');

//echo $this->renderElement('adicion/imprimir_como_menu');
//echo $this->renderElement('adicion/set_comensales');
//echo $this->renderElement('adicion/seleccionar_mozo');
//echo $this->renderElement('adicion/cambiar_mozo_de_mesa');
/*------------------------------------------------------------------------------------------------------------------------------------*/
?>



<?php //echo $this->renderElement('adicion/mesas_listado_para_mozo');?>


<div class="grid_12 window_content">
    <div id="menu-1" class="acciones grid_2">&nbsp;aaa
    <!--    <button type="button" value="adicion.AgregarProducto" id="boton-comanda">Comanda</button>
        <button type="button" value="adicion.Comensales" id="btn-comensales">Cubiertos</button>
        <button type="button" value="adicion.SeleccionCliente" id="boton-cliente">Cliente</button>
        <button type="button" value="adicion.ConvertirEnMenu" id="boton-menu">Menú</button>
        <button type="button" value="adicion.cerrarCurrentMesa('<?php echo Configure::read('Adicion.cantidadCubiertosObligatorio') ?>')">Cerrar Mesa</button>
        <button type="button" value="adicion.SacarProducto" id="boton-sacar-item">Sacar Item</button>-->
    </div>

    <div  id="mesa-scroll" class="grid_8">bbbbd</div>

    <div id="menu-2" class="acciones grid_2">&nbsp;cccccd
    <!--        <button type="button" value="adicion.ticketView" id="boton-vistasimple">Vista Simple</button>
            <button type="button" value="cambiarMozoDeMesa" id="boton-cambiar-mozo">Cambiar de Mozo</button>
            <button type="button" value="adicion.cambiarNumeroMesa" id="boton-cambiar-nromesa">Cambiar N° Mesa</button>
            <hr />
            <button type="button" value="adicion.reabrirMesa" id="boton-cancelar-cierre">Re Abrir Mesa</button>
            <button type="button" value="adicion.enviarACajero" id="">Cerrado Veloz</button>
            <button type="button" value="adicion.currentMesa.reimprimir" id="boton-reimprimir">Re Print Ticket</button>
            <button type="button" value="adicion.borrarMesa" id="boton-borrar">Borrar</button>-->
    </div>
</div>

<?php echo $html->link('SALIR','/pages/home')?>


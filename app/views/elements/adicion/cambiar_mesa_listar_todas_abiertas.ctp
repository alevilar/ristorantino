

<div id="todas-las-mesas-abiertas" style="float: left;">

    <ul class="menu-horizontal">
        <?php foreach ($mozos as $mozo):?>
        <li class="boton redondo letra-grande mozo" onclick="seleccionarMesasDeMozo(this,<?php echo $mozo['Mozo']['id']?>);" style="width: 40px">
            <div style="font-size: 16pt;">
                <?php echo $mozo['Mozo']['numero']?>
            </div>
                <?php
                echo $html->image('ico_mozo.png', array(
                    'width' => '40px',
                   // 'style' => 'margin-top: -6px'
                ));
                ?>
        </li>
        <?php endforeach;?>
    </ul>

    <div class="clear"></div>
    
    <ul class="menu-horizontal">
        <?php foreach ($mesasabiertas as $mesa): ?>
            <li>
            <?php
            echo $ajax->link(
                    $mesa['Mesa']['numero'],
                    '/mesas/view/' . $mesa['Mesa']['id'],
                    array(
                        'update' => 'mesa-scroll',
                        'id' => 'todas-las-mesas-ver-' . $mesa['Mesa']['id'],
                        'class' => 'boton-mini mesa',
                        'onclick' => 'hacer_cambio_rapido_de_mesa_mozo(' . $mesa['Mesa']['numero'] . ', ' . $mesa['Mozo']['numero'] . ');',
                        'evalScripts' => true,
                        'mozo' => $mesa['Mesa']['mozo_id'],
                    )
            );
            ?>
        </li>
<?php endforeach; ?>
    </ul>
</div>


<script type="text/javascript">
    var contenedorMesasAbiertas = null;

    contenedorMesasAbiertas = new Window({
        maximizable: false,
        resizable: false,
        hideEffect:Element.hide,
        showEffect:Element.show,
        minWidth: 10,
        width: 800,
        heigth: 600,
        destroyOnClose: false
    });
		
    contenedorMesasAbiertas.setContent('todas-las-mesas-abiertas', true, true);
				
    function hacer_cambio_rapido_de_mesa_mozo(mesa, mozo){
        //Sound.play(urlSonido,{replace:true});
        contenedorMesasAbiertas.hide();
        $("btn-cambio-rapido-de-mesa").update("Mesa "+mesa+"<br />Mozo "+mozo);
    }

    /**
     * me muestra solo las mesas delmozo seleccionado, el resto las oculta
     */
    function seleccionarMesasDeMozo(element, mozoId){
        $$('.mozo').each(function(e) {
            e.removeClassName('boton-apretado');
        });
        element.addClassName('boton-apretado');
        $$('.mesa').each(Element.hide);
        $$('.mesa[mozo="'+mozoId+'"]').each(Element.show);
    }
			
</script>


<ul class="menu-horizontal letra-grande">
    <li>
        <a href="#MostrarMesasABiertas" id="btn-cambio-rapido-de-mesa" class="boton-ancho-largo" onclick="contenedorMesasAbiertas.showCenter()">
            Mesa<br />
            Mozo
        </a>
    </li>

     <li>
        <a href="#AbrirMesaRapida" id="btn-add-rapido-de-mesa" class="boton-ancho-largo" onclick="seleccionadorMozos.showCenter();">
            Abrir<br />
            Mesa
        </a>
    </li>
</ul>



<div id="seleccionar-mozos" class="menu-horizontal" style="display: none; width: 300px">
    <h1>Seleccione Mozo</h1>
    <ul>
        <?php foreach ($mozos as $mozo):?>
        <li>
                <?php
                $mozojson = json_encode($mozo);
                echo $html->link(
                        $mozo['Mozo']['numero'],
                        '#',
                        array(
                            'onclick' => 'seleccionarMozo(new FabricaMozo('.$mozojson.'))',
                            'mozo' => $mozo['Mozo']['id'],
                            'class'=>'boton redondeado letra-grande',
                            'style'=> 'font-size: xx-large'
                        )
                );
                ?>
        </li>
        <?php endforeach;?>
    </ul>
</div>

<script type="text/javascript">
    var seleccionadorMozos = null;
    
    seleccionadorMozos = new Window({
        maximizable: false,
        resizable: false,
        hideEffect:Element.hide,
        showEffect:Element.show,
        minWidth: 10,
        width: 400,
        heigth: 400,
        destroyOnClose: false
    });

    seleccionadorMozos.setContent('seleccionar-mozos', true, true);



    function seleccionarMozo(mozo){
        //Sound.play(urlSonido,{replace:true});
        adicion.setCurrentMozo(mozo);

        adicion.abrirMesa();
    }
</script>

<a href="#cambiarMozo" class="boton" style="float: left" onclick="seleccionadorMozos.showCenter();">Mozo</a>











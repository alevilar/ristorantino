<?php //echo $this->Html->script('/adition/js/adicion/elements/mesa_cambiar_mozo');  ?>
<script id="seleccionar-mozo" type="text/x-template">
        <div data-role="header">
            <h1>Seleccionar nuevo <?php echo Configure::read('Mesa.tituloMozo') ?> para la <?php echo Configure::read('Mesa.tituloMesa') ?> <span data-bind="text: adn().currentMesa().numero()"></span></h1>
        </div>

        <div data-role="content">           

            <form name="cambiar-mozo" id="form-cambiar-mozo" action="#" data-ajax="false"  data-direction="reverse">
                <input type="hidden" name="mesa_id" data-bind="value: adn().currentMesa().id"/>

                <fieldset data-role="controlgroup" data-type="horizontal">
                    <legend>Seleccionar <?php echo Configure::read('Mesa.tituloMozo') ?></legend>
                    <?php
                    foreach ($mozos as $m) {
                        $k = $m['Mozo']['id'];
                        $n = $m['Mozo']['numero'];
                        echo "<input type='radio' name='mozo_id' id='radio-mozo-cambiar-id-$k' value='$k' class='select-mozo'/>";
                        echo "<label for='radio-mozo-cambiar-id-$k'>$n</label>";
                    }
                    ?>
                </fieldset>

                <a href="#" data-role="button" data-rel="back" data-theme="e">Cancelar</a>
            </form>
        </div>
</script>
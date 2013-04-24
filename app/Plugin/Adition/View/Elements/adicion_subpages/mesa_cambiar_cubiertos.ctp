<?php //echo $this->Html->script('/adition/js/adicion/elements/mesa_cambiar_cubiertos'); ?>
<div data-role="page" id="mesa-cambiar-cubiertos" data-theme="e">
    <div data-role="header">
        <h1>Cambiar cubiertos de la <?php echo Configure::read('Mesa.tituloMesa') ?> <span data-bind="text: adn().currentMesa().cant_comensales"></span></h1>
    </div>

    <div data-role="content">    
        <p>
        La cantidad de cubiertos actuales es <span data-bind="text: adn().currentMesa().cant_comensales"></span>
        </p>
        <form name="cambiar-cubiertos" id="form-cambiar-cubiertos" action="#mesa-view" data-ajax="false"  data-transition="reverse">
            <fieldset data-role="controlgroup" data-type="horizontal">
                <label for="numeroacambiar">Ingresar nueva cantidad</label>
                <input type="number" name="numero" id="numeroacambiar" />
            </fieldset>
            
            <fieldset class="ui-grid-a">
                <div class="ui-block-a"><a href="#" data-role="button" data-rel="back" data-theme="e">Cancelar</a></div>
                <div class="ui-block-b"><button type="submit" data-theme="b">Modificar</button></div>
	    </fieldset>
            
        </form>
    </div>
</div>  

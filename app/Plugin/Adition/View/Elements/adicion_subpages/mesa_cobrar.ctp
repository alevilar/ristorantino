<?php echo $this->Html->script('/adition/js/adicion/elements/mesa_cobrar'); ?>
<div data-role="page" id="mesa-cobrar" data-theme="e">
    <div data-role="header">
        <h1><?php echo Configure::read('Mesa.tituloMesa')?> <span data-bind="text: adn().currentMesa().numero()"></span> | <span data-bind="text: adn().vueltoText()"></span></h1>
        <a data-icon="back" href="#mesa-view" data-direction="reverse" data-theme="e">Ir a la <?php echo Configure::read('Mesa.tituloMesa')?></a>
    </div>

    <div data-role="content">                  
        <h2>Cobrar la <?php echo Configure::read('Mesa.tituloMesa')?> <span data-bind="text: adn().currentMesa().numero"></span> <span class="mesa-total" style="float: right; color: red;">Total $<span data-bind="text: adn().currentMesa().total()"></span></span></h2>
        
        <ul class="tipo_de_pagos">
        <?php 
        foreach ( $tipo_de_pagos as $tp ){
            $pago = $tp['TipoDePago'];
            $pagoJson =  json_encode($pago);
            ?>
            <li>
                <a href="#" onclick='new Risto.Adition.pago(<?php echo $pagoJson?>)'>
            <?php
            echo $this->Html->image($tp['TipoDePago']['image_url']);
            echo '<br />';
            echo $pago['name'];
            ?>
                </a>
                </li>
                <?php
        }
        ?>
        </ul>
        
        <h4>Pagos Seleccionados <span style="float: right; font-size: 24px; color: #003366">Vuelto: $<span data-bind="text: adn().vuelto()"></span></span></h4>
        <ul class="pagos_creados"
            data-bind='template: { name: "li-pagos-creados", foreach: adn().pagos }'>
        </ul>
        
            <div class="ui-grid-c">
                <div class="ui-block-a"><a href="#" data-role="button" data-rel="back" data-icon="back">Cancelar</a></div>
                <div class="ui-block-b"><a href="#" data-role="button" data-rel="back" data-icon="back" id="mesa-cajero-reabrir">Re Abrir</a></div>
                <div class="ui-block-c"><a href="#" data-role="button" class="mesa-reimprimir">Imprimir Ticket</a></div>
                <div class="ui-block-d"><a href="#" data-role="button" data-rel="back" data-theme="b" id="mesa-pagos-procesar">Cobrar</a></div>
	    </div>
    </div>
</div>  


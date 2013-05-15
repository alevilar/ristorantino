<?php $this->start('jquery-tmpl'); ?>
<?php echo $this->Html->script('/adition/js/View/ComandaAddConfirmacionView'); ?>
<?php $this->end(); ?>

<div data-role="dialog" id="comanda-add-confirmacion">
    <div data-role="header" data-id="mesa-header" data-position="fixed">
        <h1>Confirmar Comanda</h1>
    </div>

    <div data-role="content" data-enhance="false">
        <div style="float: left; width: 30%">
            <?php
            echo $this->Form->create('Comanda');
            echo $this->Form->input('observacion');
            echo $this->Form->end();
            ?>

            <div class="observaciones-list">
                <?php foreach ($observacionesComanda as $o) { ?>
                    <button data-inline="true" value="<?php echo $o ?>"><?php echo $o ?></>
                <?php } ?>
            </div>
        </div>
        <div id="comanda-add-detalle-comanda-list" style="float: left; width: 70%">
            
        </div>
    </div>
</div>
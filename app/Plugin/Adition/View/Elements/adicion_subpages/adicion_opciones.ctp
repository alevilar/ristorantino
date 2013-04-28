<?php $this->start('jquery-tmpl'); ?>
<?php echo $this->Html->script('/adition/js/jqm_events/adicion-opciones'); ?>
<?php $this->end(); ?>


<div data-role="page" id="adicion-opciones">
    <div data-role="header">
        <h1>Opciones</h1>
    </div>
    <div data-role="content">

        <div>
            
            <label for="modo-cajero-adicionista">Seleccionar Modo <a href="#help-cajero" data-rel="popup">ayuda?</a></label>
            <select name="modo-cajero-adicionista" id="modo-cajero-adicionista" data-role="slider">
                <option value="adicion">Adicion</option>
                <option value="cajero">Cajero</option>
            </select>
        </div>
        <div data-role="popup" id="help-cajero">
            <p>El modo cajero lo que hace es crear un atajo para los pagos de la mesa.<br>
            Cuando se clickea la mesa cerrada, se va directamente a la pantalla de pagos.
            </p>
            En cambio, si se estuviese en modo adicionista, al clickear la mesa cerrada<br>
            se va a la pantalla de la mesa.<br>
            Asi como el modo adicionista, al clickear una mesa abierta abre directamente </p>
            la Creación de Comandas.
        </div>

        <a href="<?php echo $this->Html->url('/mesas/cobradas') ?>" data-role="button">Últimas Mesas Cobradas</a>

        <a href="<?php echo $this->Html->url('adition/adicionar') ?>" rel="external" data-role="button" data-icon="refresh">Refrescar Adición</a>

        <a href="#" data-role="button" title="Actualizar Menú" onclick="Risto.Adition.menu.update()"><?php echo $this->Html->image('refresh.png', array('class' => 'btn-comanda-icon')) ?> Actualizar Menú</a>



        <div class="ui-grid-a">
            <div class="ui-block-a"><a href="#" data-rel="back" data-role="button">Cancelar</a></div>
            <div class="ui-block-b"><a data-icon="home" data-role="button" href="<?php echo $this->Html->url('/'); ?>" rel="external" data-theme="b">Ir a Página Principal</a></div>
        </div>

    </div>
</div>

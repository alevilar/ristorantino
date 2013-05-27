<?php $this->start('jquery-tmpl'); ?>
<?php echo $this->Html->script('/adition/js/Model/DetalleComandaModel'); ?>
<?php echo $this->Html->script('/adition/js/Collection/ComandaCollection'); ?>

<?php echo $this->Html->script('/adition/js/jqm_events/comanda_add'); ?>


<?php echo $this->Html->script('/adition/js/View/ComandaAddDetalleComandaView'); ?>
<?php echo $this->Html->script('/adition/js/View/ComandaAddCategoriasView'); ?>
<?php echo $this->Html->script('/adition/js/View/ComandaAddConfirmacionView'); ?>
<?php echo $this->Html->script('/adition/js/View/ComandaAddFabricaView'); ?>

<?php echo $this->Html->script('/adition/js/View/ComandaAddView'); ?>
<?php echo $this->Html->script('/adition/js/View/ComandaAddProductosView'); ?>

<?php $this->end(); ?>

<div data-role="page" id="comanda-add" class="comanda" data-enhance="false">
<?php echo $this->Html->css('/adition/css/comanda_add'); ?>
    <div data-role="header" data-id="mesa-header" data-position="fixed">
        <a href="#mesa-view" data-rel="back" data-transition="reverse">Volver</a>
        <h1>
            <span class="mesa-numero"></span>
<?php
echo $this->Html->image('mesa-abrio.png') . " " . Configure::read('Mesa.tituloMesa') . " - " .
 Configure::read('Mesa.tituloMozo') . " " . $this->Html->image('mozomoniob.png')
?>
            <span class="mozo-numero"></span>

            <span class="hora-abrio">Estado: <span class="mesa-estado"></span></span>
        </h1>
        <a href="#comanda-add-confirmacion" id="confirmar-comanda" data-rel="dialog">Enviar Comanda</a>
    </div>

    <div data-role="content" data-enhance="false">
        <div id="listado_categorias">
<?php echo $this->element('comanda_add/listar_categorias', array('categorias' => array('Hijos' => $categorias))); ?>
        </div>

        <div id="listado_productos">
<?php echo $this->element('comanda_add/listar_productos'); ?>
        </div>

        <div id="detalle_productos">
<?php echo $this->element('comanda_add/detalle_producto'); ?>
        </div>
    </div>    
</div>


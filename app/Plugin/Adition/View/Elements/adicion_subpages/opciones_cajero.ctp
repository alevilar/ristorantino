<?php echo $this->Html->script('/adition/js/adicion/elements/cajero_opciones'); ?>
<div data-role="page" id="cajero-opciones" class="dialog-arriba">
    <div data-role="header">
        <h1>Opciones de Cajero</h1>
    </div>
    <div data-role="content">
        
            <a href="#listado-mesas" data-role="button">Modo Adicionista</a>
            
            <a href="<?php echo $this->Html->url('/adition/adicionar#listado-mesas-cerradas')?>" rel="external" data-role="button" data-icon="refresh">Refrescar Cajero</a>
            
            <h3>Informes Fiscales</h3>
            <div class="ui-grid-a">
                <div class="ui-block-a"><a href="#listado-mesas-cerradas" data-role="button" data-href="<?php echo $this->Html->url('/adition/cashier/cierre_x');?>" data-direction="reverse">Imprimir informe "X"</a></div>
                <div class="ui-block-b"><a href="#listado-mesas-cerradas" data-role="button" data-href="<?php echo $this->Html->url('/adition/cashier/cierre_z');?>" data-direction="reverse">Imprimir informe "Z"</a></div>
            </div>
            <a href="<?php echo $this->Html->url('/adition/cashier/nota_credito');?>" data-role="button">Nota de crédito</a>
            
            
            <hr />
            <h3>Impresoras</h3>
            <div data-role="fieldcontain">
                    <label for="slider">Imprime Encuesta:</label>
                    <select name="slider" id="modo-k" data-role="slider">
                            
                            <option value="0" <?php echo Configure::read('Mesa.imprimePrimeroRemito')?'':'selected="selected"'?>>No</option>
                            <option value="1" <?php echo Configure::read('Mesa.imprimePrimeroRemito')?'selected="selected"':''?>>Si</option>
                    </select> 
            </div>
            <a href="#listado-mesas-cerradas" data-role="button" data-href="<?php echo $this->Html->url('/adition/cashier/vaciar_cola_impresion_fiscal');?>" class="silent-click" >Vaciar cola de impresión</a>
            
            <hr />
            
            <div class="ui-grid-a">
                <div class="ui-block-a"><a href="#" data-rel="back" data-role="button">Cancelar</a></div>
                <div class="ui-block-b"><a data-icon="home" data-role="button" href="<?php echo $this->Html->url('/');?>" rel="external" data-theme="b">Ir a Página Principal</a></div>
            </div>
    </div>
</div>

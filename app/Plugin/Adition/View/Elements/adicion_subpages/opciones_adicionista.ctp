
<!-- 
            Opciones ADICIONISTA
-->
<div data-role="page" id="adicion-opciones">
    <div data-role="header">
        <h1>Opciones</h1>
    </div>
    <div data-role="content">
        
            <a href="#listado-mesas-cerradas" data-role="button">Modo Cajero</a>
            
            <a href="<?php echo $this->Html->url('/mesas/cobradas.jqm')?>" data-role="button">Últimas Mesas Cobradas</a>
            
            <a href="<?php echo $this->Html->url('adition/adicionar')?>" rel="external" data-role="button" data-icon="refresh">Refrescar Adición</a>
            
            <a href="#" data-role="button" title="Actualizar Menú" onclick="Risto.Adition.menu.update()"><?php echo $this->Html->image('refresh.png', array('class'=> 'btn-comanda-icon'))?> Actualizar Menú</a>
            
            
            
             <div class="ui-grid-a">
                <div class="ui-block-a"><a href="#" data-rel="back" data-role="button">Cancelar</a></div>
                <div class="ui-block-b"><a data-icon="home" data-role="button" href="<?php echo $this->Html->url('/');?>" rel="external" data-theme="b">Ir a Página Principal</a></div>
            </div>
            
    </div>
</div>

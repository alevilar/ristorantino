<div>
    
    <div id="mesajes"><?php echo $this->Session->flash(); echo $this->Session->flash('auth'); ?></div>    
    
    <p>
        <a href="#mesa-view" rel="back" data-rel="reverse" data-role="button" data-theme="c">Volver</a>
        <br />
        <?php if ( !empty($cliente_id) ) { ?>
            <a href="#mesa-view" rel="back" data-rel="reverse" data-role="button" data-theme="b" onclick="Risto.Adition.adicionar.currentMesa().setCliente( <? echo "{id:".$cliente_id.", nombre: '".$this->request->data['Cliente']['nombre'] ."', tipofactura: 'A', porcentaje: null}";?> )">Agregar a <b>"<?php echo $this->request->data['Cliente']['nombre'] ?>"</b> a la mesa</a>
        <?php } ?>
    </p>
</div>
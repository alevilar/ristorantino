<div>
    
    <div id="mesajes"><?php $session->flash(); $session->flash('auth'); ?></div>    
    
    <p>
        <a href="#mesa-view" rel="back" data-rel="reverse" data-role="button">Volver</a>
        <br />
        <?php if ( !empty($cliente_id) ) { ?>
            <a href="#mesa-view" rel="back" data-rel="reverse" data-role="button" onclick="Risto.Adition.adicionar.currentMesa().setCliente( <? echo "{id:".$cliente_id.", nombre: '".$this->data['Cliente']['nombre'] ."', tipofactura: 'A', porcentaje: null}";?> )">Agregar a <?php echo $this->data['Cliente']['nombre'] ?> a la mesa</a>
        <?php } ?>
    </p>
</div>
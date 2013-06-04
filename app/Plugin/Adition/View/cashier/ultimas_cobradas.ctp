<script type="text/javascript">
var cajero = new Cajero();

cajero.urlGuardar = "<?php echo $html->url('/pagos/add');?>";


function cobrarMesa(mesa, total){
    cajero.cobrarMesa(mesa,total);
    return false;
}
</script>



<div id="listado-mesas" class="listado-mesas">
    <ul>
        <?php foreach($mesa as $m):?>
        <li id="mesa-id-<?=  $m['Mesa']['id']?>" onclick="cobrarMesa(<?php echo $m['Mesa']['id']?>,<?php echo $m['Mesa']['total']?>)">
            <span class="mesa-numero"><?= $m['Mesa']['numero']?></span>
            <span class="mozo-numero"><?= $m['Mozo']['numero']?></span>
            <div class="mesa-time-created">Abrió: <?= date('H:i',strtotime($m['Mesa']['created'])) ?></div>
            <div class="mesa-time-created">Cerró: <?= date('H:i',strtotime($m['Mesa']['time_cerro'])) ?></div>
            <div class="mesa-time-created">Cobró: <?= date('H:i',strtotime($m['Mesa']['time_cobro'])) ?></div>
            <span style="font-size: 9px;"><?php echo (!empty($m['Cliente']['Descuento']))?"Dto: ".$m['Cliente']['Descuento']['porcentaje']."%":''; ?></span>
        </li>
        <?php endforeach;?>
    </ul>
</div>

<?php echo $this->renderElement('cierre_efectivo_tarjeta');?>
<?php echo $this->renderElement('mesas_scroll');?>

<div id="mesas-paginador">
	<?php echo $paginator->prev(); ?> 
	<?php echo $paginator->numbers(); ?> 
	<?php echo $paginator->next(); ?>
</div>
<script type="text/javascript">
var cajero = new Cajero();

cajero.urlGuardar = "<?php echo $html->url('/pagos/add');?>";


function abrirVentana(mesa, total){
    var t = total || 0;
    cajero.cobrarMesa(mesa, t);
    return false;
}
</script>


<div id="listado-mesas" class="listado-mesas">
	<ul>
		<?php foreach($mesas_abiertas as $m):?>
		
			<li id="mesa-id-<?=  $m['Mesa']['id']?>" onclick="return abrirVentana(<?=  $m['Mesa']['id']?>);">
					
				<span class="mesa-numero"><?= $m['Mesa']['numero']?></span>
				<span class="mozo-numero"><?= $m['Mozo']['numero']?></span>
				<div class="mesa-time-created">Abrió: <?= date('H:i',strtotime($m['Mesa']['created'])) ?></div>	
				<span style="font-size: 9px;"><?php echo (!empty($m['Cliente']['Descuento']))?"Dto: ".$m['Cliente']['Descuento']['porcentaje']."%":''; ?></span>
				<div style="font-size: 9px;"><?php echo "Tiene ".count($m['Comanda'])." comandas";?></div>
				
			</li>
		<?php endforeach;?>
	</ul>
</div>



<?php echo $this->renderElement('mesas_scroll');?>

<div id="mesas-paginador">
	<?php echo $paginator->prev(); ?> 
	<?php echo $paginator->numbers(); ?> 
	<?php echo $paginator->next(); ?>
</div>


<?php echo $this->renderElement('cierre_efectivo_tarjeta');?>

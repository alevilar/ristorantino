<div id="listado-mesas" class="listado-mesas">
	<ul>
		<?php foreach($mesas_abiertas as $m):?>
			<li id="mesa-id-<?=  $m['Mesa']['id']?>" onclick="window.location.href='<?=  $html->url('/Mesas/edit/'.$m['Mesa']['id']);?>'; return false;">
					
				<span class="mesa-numero"><?= $m['Mesa']['numero']?></span>
				<span class="mozo-numero"><?= $m['Mozo']['numero']?></span>
				<div class="mozo-subtotal">$<?= (int)$m['subtotal']?></div>
				<div class="mesa-time-created">Abrió: <?= date('H:i',strtotime($m['Mesa']['created'])) ?></div>	
					
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
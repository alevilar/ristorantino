
<ul>

	<?php foreach($mesas_cerradas as $m):?>
		<li id="mesa-id-<?=  $m['Mesa']['id']?>" onclick="cajero.cobrarMesa('<?=  $m['Mesa']['id']?>','<?= $m['Mesa']['total']?>'); return false;">
		
			<div class="mesa-numero"><?= $m['Mesa']['numero']?></div>
			<div class="mozo-numero">(Mozo <?= $m['Mozo']['numero']?>)</div>
			<div class="mozo-total">$<?= $m['Mesa']['total']?></div>
			
		</li>
	<?php endforeach;?>
</ul>
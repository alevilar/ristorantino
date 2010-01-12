<div class="comandas index">
<h2>Listado de Comandas Activas</h2>

<div>
<dl>
<?php foreach($comandas as $c): ?>
	<dt>#Número#</dt><dd><?php echo $c['Comanda']['id']?></dd>
	<dt>Mesa</dt><dd><?php echo $c['Mesa']['numero']?></dd>
	<dt>Hora impresión</dt><dd><?php echo date('H:i:s',strtotime($c['Comanda']['created']))?></dd>
	<dt>impresa</dt><dd><?php echo $c['Comanda']['impresa']?'SI':'NO'?></dd>
	<?php echo $html->link('Reimprimir comanda',array('action'=>'imprimir',$c['Comanda']['id'])); ?>
	<hr />
<?php endforeach;?>
</dl>
</div>
</div>


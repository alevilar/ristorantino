        <?php    
            echo $this->element('menuadmin');
        ?>
<div class="comandas index">

<h2>Listado de Comandas de mesas activas</h2>

<div>
<dl>
<?php 
if(!empty($comandas)){
        foreach($comandas as $c): ?>
	<dt>#Número</dt><dd><?php echo $c['Comanda']['id']?></dd>
	<dt>Mesa</dt><dd><?php echo $c['Mesa']['numero']?></dd>
	<dt>Hora impresión</dt><dd><?php echo date('H:i:s',strtotime($c['Comanda']['created']))?></dd>
	<?php echo $html->link(' Reimprimir comanda',array('action'=>'imprimir',$c['Comanda']['id']), array('style'=>'color:red;font-weight:bold')  ); ?>
        
        <hr />
<?php endforeach;
}else {
    echo ('No hay comandas activas');
}
?>
</dl>
</div>
</div>


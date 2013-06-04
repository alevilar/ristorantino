
<div class="comandas index">
<h2><?php __('Comandas');?></h2>

<?php
        echo $this->Form->create('DetalleComanda', array('url' => '/detalle_comandas/index'));
?>
<p>
    <div> 
        <?
        echo $this->Form->input('ProductoTag.tag_id', array('options' => $tags, 'empty' => 'Seleccionar', 'label'=>'Tags'));
        echo $this->Form->input('Producto.categoria_id', array('options' => $categorias, 'empty' => 'Seleccionar', 'label'=>'Categoria'));
        echo $this->Form->input('Producto.id', array('options' => $productos, 'empty' => 'Seleccionar', 'label'=>'Producto'));
        ?>
    </div>

    <div>
    <?
        echo $this->Jqm->datepicker('desde');
    ?>
    </div>

    <div>
    <?
        echo $this->Jqm->datepicker('hasta');
    ?>
    </div>

    <div>
    <?
        echo $this->Form->submit('buscar');
    ?>
    </div>
</p>

<?
        echo $this->Form->end();
?>

<table cellpadding="0" cellspacing="0">

    
<?php
$i = 0;
foreach ($comandas as $comanda):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $comanda['Producto']['name']; ?>
		</td>
		<td>
			<?php echo $comanda[0]['cant'];?>
		</td>
                
	</tr>
<?php endforeach; ?>
</table>
</div>

<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('New Comanda', true), array('action'=>'add')); ?></li>
	</ul>
</div>

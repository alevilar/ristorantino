<?php
echo $html->css('protoplasm',false);
echo $javascript->link('protoplasm/protoplasm', false);
echo $javascript->link('mesas/index_head', false);
?>


<?php 
        echo $this->element('menuadmin');
    ?>


<div class="comandas index">
<h2><?php __('Comandas');?></h2>



<p>
    <?php
        echo $form->create('DetalleComanda', array('url' => '/detalle_comandas/index'));
        ?>
    <div class="grid_2 alpha"> 
    <?
        echo $form->input('Producto.id', array('options' => $productos, 'empty' => 'Seleccionar', 'label'=>'Producto'));
      ?>  
    </div>
    <div class="grid_2">
        <?php
        echo $form->input('Producto.categoria_id', array('options' => $categorias, 'empty' => 'Seleccionar', 'label'=>'Categoria'));
        ?>
    </div>
    <div class="grid_2">
    <?
        echo $form->input('desde', array( 'class' =>'datepicker') );
    ?>
    </div>

    <div class="grid_2">
    <?
        echo $form->input('hasta', array( 'class' =>'datepicker') );
    ?>
    </div>

    <div class="grid_2 push_1 omega">
    <?
        echo $form->end('buscar');
    ?>
    </div>
</p>
<table cellpadding="0" cellspacing="0">

    
<?php
$i = 0;
$cantTotal = 0;
foreach ($comandas as $comanda):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
        $cantTotal += $comanda[0]['cant'];
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
        <?php echo "Cantidad TOTAL (suma de totales) = $cantTotal"; ?>
	<ul>
		<li><?php echo $html->link(__('New Comanda', true), array('action'=>'add')); ?></li>
	</ul>
</div>

<?php
echo $javascript->link('jquery/jquery.jeditable.mini', false);
echo $javascript->link('ale_fieldupdates', false);


echo $this->element('menu');

?>



<script type="text/javascript">
    new Afups('<?php echo $html->url('/inventory/products/update')?>');
</script>


<h1>Listado de Productos</h1>

<?
$paginator->options(array('url' => $this->passedArgs));
echo $paginator->sort('Product.name');
?>

<?php echo $paginator->counter(array(    'format' => 'Pagina %page% de %pages%, mostrando %current% registros de %count% encontrados, starting on record %start%')); ?>

<table>
    <thead>
        <tr>
        <?php
        echo "<th>".$form->create('Product',array('action'=>'index'));
        echo $form->input('Product.name', array('label' => 'Producto')).'</th>';
        echo "<th>".$form->input('Category.name', array('label' => 'Categoria')).'</th>';
        echo "<th>".$form->end('Buscar')."</th>";
        echo "<th></th>";
?>
            </tr>
        <tr>
            <th>Nombre</th><th>Categoria</th><th>fecha creación</th><th>Acciones</th>
        </tr>
    </thead>
<?php
foreach ($products as $p){
    $prodId = $p['Product']['id'];
    
    echo "<tr>";
     
    echo "<td class='edit' field='name' product_id='$prodId'>".$p['Product']['name']."</td>"; 
    
    echo "<td class='edit_field_types' options_types='$categoriesJson' field='category_id' product_id='$prodId'>".$p['Category']['name']."</td>";
    
    echo "<td>".date('d-m-Y H:i:s',strtotime($p['Product']['created']))."</td>";
    
    echo "<td>". $html->link('Ver inventario', '/inventory/products/view/'.$p['Product']['id']) ."</td>";
    
    
    echo "</tr>";
}

?>

</table>


<div class="">
	<?php echo $paginator->prev('<< '.__('anterior', true), array(), null, array('class'=>''));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('próximo', true).' >>', array(), null, array('class'=>''));?>
</div>

<div class="actions">
    <ul>
        <li><?php echo $html->link('Nuevo Producto', '/inventory/products/add')?></li>
        <li><?php echo $html->link('Nueva Categoria', '/inventory/categories/add')?></li>
        
        <li><?php echo $html->link('Listado de categorias', '/inventory/categories')?></li>
        <li><?php echo $html->link('Listado de inventario', '/inventory/counts')?></li>
    </ul>
</div>
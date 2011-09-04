<?php
echo $javascript->link('jquery/jquery.jeditable.mini', false);

?>
<script type="text/javascript">

    (function($){
        $(document).ready(function() {
             $('.edit').editable('<?php echo $html->url('/inventory/products/update')?>', {
                 submit: 'OK',
                 submitdata: function(){
                     return {
                         field: $(this).attr('field'),
                         product_id: $(this).attr('product_id')
                     }
                 }
             });


             $('.edit_field_types').editable('<?php echo $html->url('/inventory/products/update')?>', {
                 data: function() {return $(this).attr('options_types')},
                 type: 'select',
                 submit: 'OK',
                 submitdata: function(){
                     return {
                         field: $(this).attr('field'),
                         product_id: $(this).attr('product_id'),
                         text: $(this).find('select :selected').text()
                     }
                 }
             });
         });

    })(jQuery);
    
</script>

<h1>Listado de Productos</h1>

<?
$paginator->options(array('url' => $this->passedArgs));
echo $paginator->sort('Product.name');
?>

<table>
    <thead>
        <tr>
        <?php
        echo "<th>".$form->create('Product',array('action'=>'index'));
        echo $form->input('Product.name', array('label' => 'Producto')).'</th>';
        echo "<th>".$form->input('Category.name', array('label' => 'Categoria')).'</th>';
        echo "<th>".$form->end('Buscar')."</th>";
?>
            </tr>
        <tr>
            <th>Nombre</th><th>Categoria</th><th>fecha creación</th>
        </tr>
    </thead>
<?php
foreach ($products as $p){
    $prodId = $p['Product']['id'];
    
    echo "<tr>";
     
    echo "<td class='edit' field='name' product_id='$prodId'>".$p['Product']['name']."</td>"; 
    
    echo "<td class='edit_field_types' options_types='$categoriesJson' field='category_id' product_id='$prodId'>".$p['Category']['name']."</td>";
    
    echo "<td>".date('d-m-Y H:i:s',strtotime($p['Product']['created']))."</td>";
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
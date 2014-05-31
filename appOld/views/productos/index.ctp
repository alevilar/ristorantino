

    <?php    
    echo $javascript->link('jquery/jquery.jeditable.mini', false);
    echo $javascript->link('ale_fieldupdates', false);

        $menubread=array();   
        echo $this->element('menuadmin', array('menubread'=>$menubread));
        ?>


<script type="text/javascript">
    new Afups('<?php echo $html->url('/productos/update')?>');
</script>


<div class="productos index">
<h2><?php __('Productos');?></h2>

<div>
    <?php
    echo $html->link('Aplicar Precios Futuros', '/productos/actualizarPreciosFuturos', array('class' => 'button' ), 'Está por modificar todos los precios, por su valor futuro. ¿Seguro?');
    ?>
</div>
<br>
<p>
    <?php
echo $paginator->options(array('url'=>$this->params['PaginateConditions']));
//debug($paginator->params['paging']['Producto']['count']);
echo $paginator->counter(array('format' => __('Pagina %page% de %pages%, mostrando %current% elementos de %count%.', true)));?></p>
<table class="productos table">
        <tr>
	<?php echo $form->create("Producto",array("action"=>"index")); echo $form->input("id") ?>
	<th><?php echo $form->input('name',array('placeholder'=>'Nombre del producto', 'label'=>false));?></th>
        <th><?php echo $form->input('comandera_id',array('placeholder'=>'Comandera','label'=>false, 'empty'=>'Comandera'));?></th>
	<th><?php echo $form->input('Categoria.name',array('placeholder'=>'Categoria','label'=>false));?></th>
	<th><?php echo $form->input('precio',array('placeholder'=>'Precio','label'=>false));?></th>
        <th><?php echo $form->input('order',array('placeholder'=>'Orden','label'=>false));?></th>
	<th>&nbsp;</th>
	<th class="actions"><?php echo $form->end("Buscar")?></th>
        </tr>

<tr>
	<th><?php echo $paginator->sort('Nombre','name');?></th>
	<th><?php echo $paginator->sort('Comandera','Comandera.description');?></th>
	<th><?php echo $paginator->sort('Categoria','Categoria.name');?></th>
	<th><?php echo $paginator->sort('Precio','precio');?></th>
	<th><?php echo $paginator->sort('Precio Futuro','ProductosPreciosFuturo.precio');?></th>
        <th><?php echo $paginator->sort('Orden','order');?></th>
	<th><?php echo $paginator->sort('Creado','created');?></th>
	<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php
if ($paginator->params['paging']['Producto']['count']!=0) {
$i = 0;
foreach ($productos as $producto):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
        $prodId = $producto['Producto']['id'];
?>
	<tr<?php echo $class;?>>
		<td class='edit' field='name' product_id='<?php echo $prodId ?>'><?php 
                         $name = ($producto['Producto']['deleted'])? 
                            $producto['Producto']['name']." (borrado el ".date("d/m/y H:i:s", strtotime($producto['Producto']['deleted_date']))." )"
                            :
                            $producto['Producto']['name'];

                        echo trim($name);
                        echo "<br>";
                        echo "<small>Ticket:<cite>".$producto['Producto']['abrev']."</cite></small>"; 
                ?></td>
                
                
		<td class="edit_field_types" options_types='<?php print json_encode($comanderas) ?>' field="comandera_id" product_id="<?php echo $prodId; ?>">
			<?php echo $producto['Comandera']['description']; ?>
		</td>
		<td class="edit_field_types" options_types='<?php print json_encode($categorias) ?>' field="categoria_id" product_id="<?php echo $prodId; ?>">
			<?php echo $producto['Categoria']['name']; ?>
		</td>
		<td  class='edit' field='precio' product_id='<?php echo $prodId ?>'><?php 
                        echo $number->currency( $producto['Producto']['precio'] );                        
                ?></td>
                
                
                <td  class='edit text text-success'  field='precio_futuro' 
                     product_id='<?php echo $prodId ?>'><?php 
                        if ( isset($producto['ProductosPreciosFuturo']['precio']) ) {
                          echo $number->currency( $producto['ProductosPreciosFuturo']['precio'] );
                        }
                ?></td>
                
                <td  class='edit' field='order' product_id='<?php echo $prodId ?>'><?php 
                    echo $producto['Producto']['order']; 
                ?></td>
		<td>
			<?php echo date('d-m-y',strtotime($producto['Producto']['created'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Editar', true), array('action'=>'edit', $producto['Producto']['id'])); ?>
			<?php echo $html->link(__('Borrar', true), array('action'=>'delete', $producto['Producto']['id']), null, sprintf(__('¿Esta seguro que desea borrar el producto: %s?', true), $producto['Producto']['name'])); ?>
		</td>
	</tr>
<?php 
endforeach; 

}else{
    echo('<td>No se encontraron elementos</td>');
}
    
?>
       
</table>


</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('anterior', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('próximo', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Nuevo Producto', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('Listar Categorias', true), '/Categorias/index'); ?></li>
		<li><?php echo $html->link(__('Agregar Nueva Categoria', true), '/Categorias/add'); ?></li>
	</ul>
</div>



<?php
echo $this->Html->script('jquery/jquery.jeditable.mini', false);
echo $this->Html->script('ale_fieldupdates', false);
?>


<script type="text/javascript">
    var options = {urlParam: '<?php echo $this->Html->url('/productos/update') ?>'};
    new Afups( options );
</script>


<div class="productos index">
    <h2><?php echo __('Productos'); ?></h2>

    <div>
<?php
echo $this->Html->link('Aplicar Precios Futuros', '/productos/actualizarPreciosFuturos', array('class' => 'button'), 'Está por modificar todos los precios, por su valor futuro. ¿Seguro?');
?>
    </div>
    <br>
    <p>
<?php
echo $this->Paginator->options(array('url' => $this->request->params['PaginateConditions']));
//debug($this->Paginator->params['paging']['Producto']['count']);
echo $this->Paginator->counter(array('format' => __('Pagina %page% de %pages%, mostrando %current% elementos de %count%.')));
?></p>
    <table class="productos" cellpadding="0" cellspacing="0">
        <tr>
            <?php echo $this->Form->create("Producto", array("action" => "index"));
            echo $this->Form->input("id") ?>
            <th><?php echo $this->Form->input('name', array('style' => 'width:170px;', 'placeholder' => 'Nombre del producto', 'label' => false)); ?></th>
            <th><?php echo $this->Form->input('abrev', array('style' => 'width:145px;', 'placeholder' => 'Abreviatura', 'label' => false)); ?></th>
            <th><?php echo $this->Form->input('comandera_id', array('empty'=> 'Seleccione', 'style' => 'width:85px;', 'placeholder' => 'Comandera', 'label' => false)); ?></th>
            <th><?php echo $this->Form->input('categoria_id', array('empty'=> 'Seleccione', 'style' => 'width:85px;', 'placeholder' => 'Categoria', 'label' => false)); ?></th>
            <th><?php echo $this->Form->input('tag', array('style' => 'width:85px;', 'placeholder' => 'Tag', 'label' => false)); ?></th>
            <th><?php echo $this->Form->input('precio', array('style' => 'width:40px;', 'placeholder' => 'Precio', 'label' => false)); ?></th>
            <th><?php echo $this->Form->input('order', array('style' => 'width:35px;', 'placeholder' => 'Orden', 'label' => false)); ?></th>
            <th>&nbsp;</th>
            <th class="actions"><?php echo $this->Form->end("Buscar") ?></th>
        </tr>

        <tr>
            <th><?php echo $this->Paginator->sort('Nombre', 'name'); ?></th>
            <th><?php echo $this->Paginator->sort('Abreviatura', 'abrev'); ?></th>
            <th><?php echo $this->Paginator->sort('Comandera', 'Comandera.description'); ?></th>
            <th><?php echo $this->Paginator->sort('Categoria', 'Categoria.name'); ?></th>
            <th><?php echo $this->Paginator->sort('Tag', 'Tag.name'); ?></th>
            <th><?php echo $this->Paginator->sort('Precio', 'precio'); ?></th>
            <th><?php echo $this->Paginator->sort('Orden', 'order'); ?></th>
            <th><?php echo $this->Paginator->sort('Creado', 'created'); ?></th>
            <th class="actions"><?php echo __('Acciones'); ?></th>
        </tr>
        <?php
        if ($this->Paginator->params['paging']['Producto']['count'] != 0) {
            $i = 0;
            foreach ($productos as $producto):
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }
                $prodId = $producto['Producto']['id'];
                ?>
                <tr<?php echo $class; ?>>
                    <td class='edit' data-field='name' data-item-id='<?php echo $prodId ?>'><?php
        $name = ($producto['Producto']['deleted']) ?
                $producto['Producto']['name'] . " (borrado el " . date("d/m/y H:i:s", strtotime($producto['Producto']['deleted_date'])) . " )" :
                $producto['Producto']['name'];

        echo trim($name);
                ?></td>

                    <td class='edit' data-field='abrev' data-item-id='<?php echo $prodId ?>'><?php
                echo $producto['Producto']['abrev'];
                ?></td>

                    <td class="edit_field_types"  data-options='<?php print json_encode($comanderas) ?>' data-field="comandera_id" data-item-id="<?php echo $prodId; ?>">
        <?php echo $producto['Comandera']['description']; ?>
                    </td>
                    <td class="edit_field_types"  data-options='<?php print json_encode($categorias) ?>' data-field="categoria_id" data-item-id="<?php echo $prodId; ?>">
        <?php echo $producto['Categoria']['name']; ?>
                    </td>
                    <td class="">
                        <?php foreach($producto['Tag'] as $tag): ?>
                        <?php echo "{$tag['name']}, "; ?>
                        <?php                                endforeach; ?>
                    </td>
                    <td  class='edit' data-field='precio' data-item-id='<?php echo $prodId ?>'><?php
                echo trim("$" . $producto['Producto']['precio']);
                if (!empty($producto['ProductosPreciosFuturo']['precio'])) {
                    echo " <b>[$" . $producto['ProductosPreciosFuturo']['precio'] . "]</b>";
                }
        ?></td>

                    <td  class='edit' data-field='order' data-item-id='<?php echo $prodId ?>'><?php
                echo $producto['Producto']['order'];
                ?></td>
                    <td>
                        <?php echo date('d-m-y', strtotime($producto['Producto']['created'])); ?>
                    </td>
                    <td class="actions">
        <?php echo $this->Html->link(__('Ver'), array('action' => 'view', $producto['Producto']['id'])); ?>
                        <?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $producto['Producto']['id'])); ?>
                        <?php echo $this->Form->postLink(__('Borrar'), array('action' => 'delete', $producto['Producto']['id']), null, sprintf(__('¿Esta seguro que desea borrar el producto: %s?'), $producto['Producto']['name'])); ?>
                    </td>
                </tr>
        <?php
    endforeach;
} else {
    echo('<td>No se encontraron elementos</td>');
}
?>

    </table>


</div>
<div class="paging">
<?php echo $this->Paginator->prev('<< ' . __('anterior'), array(), null, array('class' => 'disabled')); ?>
    | 	<?php echo $this->Paginator->numbers(); ?>
<?php echo $this->Paginator->next(__('próximo') . ' >>', array(), null, array('class' => 'disabled')); ?>
</div>
<div class="actions">
    <ul>
        <li><?php echo $this->Html->link(__('Nuevo Producto'), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('Listar Categorias'), '/Categorias/index'); ?></li>
        <li><?php echo $this->Html->link(__('Agregar Nueva Categoria'), '/Categorias/add'); ?></li>
    </ul>
</div>

<div class="tags view">
    
    <div class="col-md-3 well">
        <h2><span class="text-muted"><?php  echo __('Tag');?></span> <?php echo h($tag['Tag']['name']); ?></h2>
        <div class="actions">
            <h3><?php echo __('Actions'); ?></h3>
            <ul>
                    <li><?php echo $html->link(__('Edit Tag',1), array('action' => 'edit', $tag['Tag']['id'])); ?> </li>
                    <li><?php echo $html->link(__('Delete Tag',1), array('action' => 'delete', $tag['Tag']['id']), null, __('Are you sure you want to delete # %s?', $tag['Tag']['id'])); ?> </li>
                    <li><?php echo $html->link(__('List Tags',1), array('action' => 'index')); ?> </li>
                    <li><?php echo $html->link(__('New Tag',1), array('action' => 'add')); ?> </li>
                    <li><?php echo $html->link(__('List Productos',1), array('controller' => 'productos', 'action' => 'index')); ?> </li>
                    <li><?php echo $html->link(__('New Producto',1), array('controller' => 'productos', 'action' => 'add')); ?> </li>
            </ul>
        </div>
    </div>

    <div class="col-md-9">
    <div class="related">
            <h3><?php echo __('Productos');?></h3>
            <?php if (!empty($tag['Producto'])):?>
            <table cellpadding = "0" cellspacing = "0" class="table">
            <tr>
                    <th><?php echo __('Id'); ?></th>
                    <th><?php echo __('Name'); ?></th>
                    <th><?php echo __('Abrev'); ?></th>
                    <th><?php echo __('Precio'); ?></th>
                    <th class="actions"><?php echo __('Actions');?></th>
            </tr>
            <?php
                    $i = 0;
                    foreach ($tag['Producto'] as $producto): ?>
                    <tr>
                            <td><?php echo $producto['id'];?></td>
                            <td><?php echo $producto['name'];?></td>
                            <td><?php echo $producto['abrev'];?></td>
                            <td><?php echo $producto['precio'];?></td>
                            <td class="actions">
                                    <?php echo $html->link(__('Edit', 1), array('controller' => 'productos', 'action' => 'edit', $producto['id'])); ?>
                                    <?php echo $html->link(__('Delete', 1), array('controller' => 'productos', 'action' => 'delete', $producto['id']), null, __('Are you sure you want to delete # %s?', $producto['id'])); ?>
                            </td>
                    </tr>
            <?php endforeach; ?>
            </table>
    <?php endif; ?>

    </div>
</div>
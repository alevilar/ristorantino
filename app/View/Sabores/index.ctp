<div class="sabores index">
    <h2><?php echo __('Sabores'); ?></h2>
    <table cellpadding="0" cellspacing="0">

        <?php echo $this->Form->create('Sabor', array('action' => 'index')); ?>
        <tr>
            <th></th>
            <th><?php echo $this->Form->input('Sabor.name', array('style' => 'width:170px;', 'placeholder' => 'Sabor', 'label' => false)); ?></th>
            <th><?php echo $this->Form->input('categoria', array('style' => 'width:120px;', 'placeholder' => 'Categoría', 'label' => false)); ?></th>
            <th><?php echo $this->Form->input('Sabor.precio', array('style' => 'width:40px;', 'placeholder' => 'Precio', 'label' => false)); ?></th>
            <th>&nbsp; </th>
            <th></th>
            <th></th>
            <th><?php echo $this->Form->end('Buscar'); ?></th>

        </tr>

        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('name'); ?></th>
            <th><?php echo $this->Paginator->sort('categoria_id'); ?></th>
            <th><?php echo $this->Paginator->sort('precio'); ?></th>
            <th><?php echo $this->Paginator->sort('created'); ?></th>
            <th><?php echo $this->Paginator->sort('modified'); ?></th>
            <th><?php echo $this->Paginator->sort('deleted_date'); ?></th>
            <th><?php echo $this->Paginator->sort('deleted'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($sabores as $sabor): ?>
            <tr>
                <td><?php echo h($sabor['Sabor']['id']); ?>&nbsp;</td>
                <td><?php echo h($sabor['Sabor']['name']); ?>&nbsp;</td>
                <td>
                    <?php echo $this->Html->link($sabor['Categoria']['name'], array('controller' => 'categorias', 'action' => 'view', $sabor['Categoria']['id'])); ?>
                </td>
                <td><?php echo h($sabor['Sabor']['precio']); ?>&nbsp;</td>
                <td><?php echo h($sabor['Sabor']['created']); ?>&nbsp;</td>
                <td><?php echo h($sabor['Sabor']['modified']); ?>&nbsp;</td>
                <td><?php echo h($sabor['Sabor']['deleted_date']); ?>&nbsp;</td>
                <td><?php echo h($sabor['Sabor']['deleted']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $sabor['Sabor']['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $sabor['Sabor']['id'])); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $sabor['Sabor']['id']), null, __('Are you sure you want to delete # %s?', $sabor['Sabor']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?>	</p>

    <div class="paging">
        <?php
        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('New Sabor'), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('List Categorias'), array('controller' => 'categorias', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Categoria'), array('controller' => 'categorias', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Detalle Sabores'), array('controller' => 'detalle_sabores', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Detalle Sabor'), array('controller' => 'detalle_sabores', 'action' => 'add')); ?> </li>
    </ul>
</div>

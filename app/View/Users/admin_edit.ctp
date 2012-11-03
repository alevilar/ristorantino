<?php echo $this->Form->create('User'); ?>
<div class="users form ui-grid-a">    
    
    <fieldset class="ui-block-a">
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('username');
        echo $this->Form->input('rol_id', array(
            'type' => "radio",
            'label' => array(
                'fieldset' => array(
                    'class' => 'papspas',
                    'data-type' => "horizontal"))
        ));
        ?>
    </fieldset>
    <fieldset class="ui-block-b">
        <?php
        echo $this->Form->input('nombre');
        echo $this->Form->input('apellido');
        echo $this->Form->input('telefono');
        echo $this->Form->input('domicilio');
        ?>
    </fieldset>
</div>
<?php echo $this->Form->end(__('Submit')); ?>

<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
        <li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Rol'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Clientes'), array('controller' => 'clientes', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Cliente'), array('controller' => 'clientes', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Egresos'), array('controller' => 'egresos', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Egreso'), array('controller' => 'egresos', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Mozos'), array('controller' => 'mozos', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Mozo'), array('controller' => 'mozos', 'action' => 'add')); ?> </li>
    </ul>
</div>

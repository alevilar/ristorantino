<?php echo $this->Form->create('User'); ?>
<div class="users form">    
    
    <div class="col-md-6">
        <fieldset>
            <?php
            echo $this->Form->input('id');
            echo $this->Form->input('username');
            echo $this->Form->input('nombre');
            echo $this->Form->input('apellido');
            echo $this->Form->input('telefono');
            echo $this->Form->input('domicilio');
            ?>
        </fieldset>
    </div>
    
    <div class="col-md-6">
            <?php
            echo $this->Form->input('rol_id', array(
                'type' => "radio",
                ));
            
            ?>
    </div>
</div>
<?php echo $this->Form->submit(__('Submit'), array('class'=>'btn btn-success')); ?>
<?php echo $this->Form->end(); ?>

<div class="actions">
    <br>
    <?php echo $this->Form->postLink(__('Delete')
                , array('action' => 'delete', $this->Form->value('User.id'))
                , array('class'=>'btn btn-danger')
                , __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?>    
</div>

<?php
//debug($this);

echo $this->Form->create('Clasificacion', array('action'=>$this->action, $clasificacion_id));

echo $this->Form->input('id', array('value' => $clasificacion_id));
echo $this->Form->input('parent_id', array('options'=>$clasificaciones, 'empty'=>'Seleccionar'));
echo $this->Form->input('name');
echo $this->Form->end('Guardar');


if (!empty($clasificacion_id)){
    echo $this->Html->link('- eliminar -', array('action'=>'delete', $clasificacion_id), null, sprintf(__('¿Esta seguro que desea borrar?', true)));
}
<?php
//debug($this);

echo $form->create('Clasificacion', array('action'=>$this->action, $clasificacion_id));

if (!empty($clasificacion_id)){
            echo $form->input('id', array('value' => $clasificacion_id));
}

echo $form->input('parent_id', array('options'=>$clasificaciones, 'empty'=>'Seleccionar'));
echo $form->input('name');
echo $form->end('Guardar');


if (!empty($clasificacion_id)){
    echo $html->link('- eliminar -', array('action'=>'delete', $clasificacion_id), null, sprintf(__('¿Esta seguro que desea borrar?', true)));
}
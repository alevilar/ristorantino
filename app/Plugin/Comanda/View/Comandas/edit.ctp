<h1>Editando Comanda</h1>

<?php

echo $this->Form->create('Comanda');
echo $this->Form->input('id');
echo $this->Form->input('mesa_id');
echo $this->Form->input('observacion');
echo $this->Form->hidden('redirect');


echo $this->Html->link(
    __('Delete'),
    array('action' => 'delete', $this->request->data['Comanda']['id']),
    array('class'=>'btn btn-danger pull-right'),
    "Si acepta eliminará la comanda"
);

echo $this->Form->submit('Guardar', array('class'=>'btn btn-success'));

echo $this->Form->end();




?>



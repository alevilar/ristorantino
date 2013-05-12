<h3>Editando el Pago</h3>
    <?php    
echo $form->create('Egreso', array('action'=>'edit',  'data-ajax' => "false", 'type'=>'file'));

echo $form->input('id');

echo $form->input('fecha');
echo $form->input('observacion');
echo $form->input('tipo_de_pago_id');

if (!empty($this->data['Egreso']['file'])) {
    echo $html->image($this->data['Egreso']['file'], array('width'=>150));
}

echo $form->input('file', array('type'=>'file'));
echo $form->input('total', array('disabled'=>true));

echo $form->end('guardar');

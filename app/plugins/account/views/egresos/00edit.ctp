<h3>Editando el Pago</h3>
    <?php    
echo $form->create('Egreso', array('action'=>'edit',  'data-ajax' => "false", 'type'=>'file'));

echo $form->input('id');

echo $form->input('fecha');
echo $form->input('observacion');
echo $form->input('tipo_de_pago_id');


$ext = substr(strrchr($this->data['Egreso']['file'],'.'),1);
if ( in_array(low($ext), array('jpg', 'png', 'gif', 'jpeg')) ) {
    $iii = $html->image($this->data['Egreso']['file'], array('width' => 150, 'alt' => 'Bajar', 'escape' => false));
} else {
    $iii = "Descargar $ext";
}
if (!empty($this->data['Egreso']['file'])) {
    echo $html->link($iii, "/" . IMAGES_URL . $this->data['Egreso']['file'], array('target' => '_blank', 'escape' => false));
}



echo $form->hidden('file');
echo $form->input('_file', array('type'=>'file', 'label' => 'PDF, Imagen, Archivo'));
echo $form->input('total', array('disabled'=>true));

echo $form->end('guardar');

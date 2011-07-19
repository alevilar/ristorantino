<br><br><br><br>

	<div class="listado-mesas">

<?php

echo $form->create('Cajero', array('url'=>'nota_credito'));

echo $form->input('tipo', array('options'=> array('B'=>'"B"', 'A' => '"A"')));

$cc = $form->input('Cliente.razonsocial', array('label'=>'Razon Social (sin acentos ni eñies, ningún carácter "raro")'));
$cc .= $form->input('Cliente.numerodoc', array('label'=>'CUIT'));
$cc .= $form->input('Cliente.respo_iva', array('type'=>'hidden', 'value'=>'I'));
$cc .= $form->input('Cliente.tipodoc', array('type'=>'hidden', 'value'=>'C'));

echo $html->div('factura_a',$cc,array('style'=>'display:none'),false);

echo $form->input('numero_ticket');

echo $form->input('importe');

echo $form->input('descripcion', array('default'=>'Error Corregido'));

echo $form->end('Enviar');

?>

    </div>


<script type="text/javascript">
    $('CajeroTipo').observe('change', function(){
        if (this.value == 'A') {
            $$('.factura_a').each(Element.show);
        } else {
            $$('.factura_a').each(Element.hide);
        }
    });
</script>


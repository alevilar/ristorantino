<div data-role="header">
    <h1>Nota de crédito</h1>
    <a href="#listado-mesas-cerradas">Cancelar</a>
</div>

<div data-role="content">
	<div class="listado-mesas">
           <div><?php $session->flash(); $session->flash('auth'); ?></div>

<?php

echo $form->create('Cajero', array(
    'url'=>'nota_credito', 
    'type' =>'post', 
    'data-rel' => 'back', 
    'data-direction' =>"reverse",
    ));

echo $form->input('tipo', array('options'=> array('B'=>'"B"', 'A' => '"A"')));

$cc = $form->input('Cliente.razonsocial', array('label'=>'Razon Social (sin acentos ni eñies, ningún carácter "raro")'));
$cc .= $form->input('Cliente.numerodoc', array('label'=>'CUIT'));
$cc .= $form->input('Cliente.respo_iva', array('type'=>'hidden', 'value'=>'I'));
$cc .= $form->input('Cliente.tipodoc', array('type'=>'hidden', 'value'=>'C'));

echo $html->div('factura_a',$cc,array('style'=>'display:none'),false);

echo $form->input('numero_ticket');

echo $form->input('importe');

echo $form->input('descripcion', array('default'=>'Error Corregido'));

?>
            <div class="ui-grid-a">
                <div class="ui-block-a">
                    <a href="#listado-mesas-cerradas" data-role="button">Volver</a>
                </div>
                <div class="ui-block-b">
                    <button type="submit" data-theme="b">Imprimir Nota de Crédito</button>
                </div>
            </div>
            
   <?php echo $form->end() ?>         
<script type="text/javascript">
    $('#CajeroTipo').bind('change', function(){
        if ($(this).val() == 'A') {
            $('.factura_a').show();
        } else {
            $('.factura_a').hide();
        }
    });
</script>



    </div>
</div>

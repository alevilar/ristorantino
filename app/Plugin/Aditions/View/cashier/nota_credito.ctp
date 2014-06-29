<div data-role="header">
    <h1>Nota de crédito</h1>
    <a href="#listado-mesas-cerradas">Cancelar</a>
</div>

<div data-role="content">
	<div class="listado-mesas">
           <div><?php $session->flash(); $session->flash('auth'); ?></div>

<?php

echo $this->Form->create('Cajero', array(
    'url'=>'nota_credito', 
    'type' =>'post', 
    'data-rel' => 'back', 
    'data-direction' =>"reverse",
    ));

?>
           <fieldset data-role="controlgroup" data-type="horizontal">
           <?php
echo $this->Form->input('tipo', array('label' => 'Seleccionar Tipo de Factura','options'=> array('B'=>'"B"', 'A' => '"A"'), 'type'=>'radio', 'required'=>'required'));
?>
           </fieldset>
<?
$cc = $this->Form->input('Cliente.razonsocial', array('label'=>'Razon Social (sin acentos ni eñies, ningún carácter "raro")'));
$cc .= $this->Form->input('Cliente.numerodoc', array('label'=>'CUIT'));
$cc .= $this->Form->input('Cliente.respo_iva', array('type'=>'hidden', 'value'=>'I'));
$cc .= $this->Form->input('Cliente.tipodoc', array('type'=>'hidden', 'value'=>'C'));

echo $this->Html->div('factura_a',$cc,array('style'=>'display:none'),false);

echo $this->Form->input('numero_ticket', array('label' => 'Número de Ticket (sin guiones "-")'));

echo $this->Form->input('importe');

echo $this->Form->input('descripcion', array('default'=>'Error Corregido', 'label' => 'Ingresar una pequeña descripción'));

?>
            <div class="ui-grid-a">
                <div class="ui-block-a">
                    <a href="#listado-mesas-cerradas" data-role="button">Volver</a>
                </div>
                <div class="ui-block-b">
                    <button type="submit" data-theme="b">Imprimir Nota de Crédito</button>
                </div>
            </div>
            
   <?php echo $this->Form->end() ?>         
<script type="text/javascript">
    jQuery('#CajeroTipoA').live('change', function(){
            jQuery('.factura_a').show();
    });
    
    jQuery('#CajeroTipoB').live('change', function(){
        jQuery('.factura_a').hide();
    });
</script>



    </div>
</div>

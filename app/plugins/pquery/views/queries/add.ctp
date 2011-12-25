<?php
echo $javascript->link('jquery-ui-1.8.5.custom.min', false);
echo $html->css('smoothness/jquery-ui-1.8.6.custom',null, false);
?>
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery("#vigenciaDatePicker").datepicker({ minDate: 1, dateFormat: 'dd/mm/yy' });

    toogleVigencia();
});

function toogleVigencia() {
    if (jQuery("#categoria").val() == '2') {
        jQuery('.vigenciaDatePickerDiv').show();
    }
    else {
        jQuery('.vigenciaDatePickerDiv').hide();
    }
}
</script>

<h2><?php __('Crear Descarga');?></h2>
<div class="queries form">
<?php echo $form->create('Query');?>
	<fieldset>
	<?php
		echo $form->input('name');
		echo $form->input('description');
                echo $form->input('pquery_category_id', array(
                                            'label' => 'Category',
                                            'type' => 'select',
                                            'id' => 'categoria',
                                            'options' => $pquery_categories,
                                            'style' => 'width:150px; clear:none; float:left;',
                                            'onchange' => 'toogleVigencia();',
                                            'default' => '1'));
                echo $form->input('expiration_time', array('id'=>'vigenciaDatePicker',
                                                    'type'=>'text',
                                                    'div' => 'vigenciaDatePickerDiv',
                                                    'style' => 'width:100px; clear:none; float:left;'));

		echo $form->input('query');
	?>
	</fieldset>
<?php echo $form->end('Guardar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Listado de Descargas', true), array('action'=>'index'));?></li>
	</ul>
</div>

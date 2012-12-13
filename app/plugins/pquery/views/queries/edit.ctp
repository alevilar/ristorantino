
<script type="text/javascript">
    (function(){
        jQuery(document).ready(function() {
            jQuery("#vigenciaDatePicker").datepicker({ 
                minDate: 1, 
                dateFormat: 'yy/mm/dd' 
            });
        });
        
    })();
    
    
    
</script>
<h2><?php __('Editar Descarga');?></h2>
<div class="queries form">
<?php echo $form->create('Query');?>
	<fieldset>
	<?php
		echo $form->input('id');
                if ( !empty($urlFrom) ) {
                    echo $form->hidden('url_from', array('value' => $urlFrom) );
                }
		echo $form->input('name');
		echo $form->input('description');

                echo $form->input('pquery_category_id', array(
                                            'label' => 'Category',
                                            'type' => 'select',
                                            'id' => 'categoria',
                                            'options' => $pquery_categories,
                                            'default' => '1'));
                
                echo $form->input('expiration_time', array(
                                                    'label' => 'Fecha de expiración',
                                                    'id'=>'vigenciaDatePicker',
                                                    'type'=>'text',
                    ));

		
		echo $form->input('query');
	?>
	</fieldset>
<?php echo $form->end('Editar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Eliminar', true), array('action'=>'delete', $form->value('Query.id')), null, sprintf(__('Seguro deseas eliminar esta Descarga?', true), $form->value('Query.id'))); ?></li>
		<li><?php echo $html->link(__('Listado de Descargas', true), array('action'=>'index'));?></li>
	</ul>
</div>

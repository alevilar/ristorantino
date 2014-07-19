<?php
echo $javascript->link('jquery-ui-1.8.5.custom.min', false);
echo $html->css('smoothness/jquery-ui-1.8.5.custom',null, false);
?>

<div class="queries form">
<?php echo $form->create('Query');?>
	<fieldset>
 		<legend><?php __('Add Query');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('description');
		
                /* @var $ajax AjaxHelper */
		echo $ajax->autoComplete('categoria', '/pquery/queries/listado_categorias');
		
		echo $form->input('ver_online',array('label'=>'¿Ver Online?','after'=>'si se tilda esta opcion se habiiltara la query para ver de forma online como una pagina normal.'));
		
		
		echo $form->input('query');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Queries', true), array('action'=>'index'));?></li>
	</ul>
</div>

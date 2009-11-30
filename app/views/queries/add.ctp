<?php echo $javascript->link('scriptaculous-js-1.8.3/src/scriptaculous'); ?>

<div class="queries form">
<?php echo $form->create('Query');?>
	<fieldset>
 		<legend><?php __('Add Query');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('description');
		
		echo "<label>Categoria </label>";
		echo $ajax->autoComplete('categoria', '/queries/listado_categorias');
		
		echo $form->input('ver_online',array('label'=>'¿Ver Online?','after'=>'si se tilda esta opción se habiiltará la query para ver de forma online como una página normal.'));
		
		
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

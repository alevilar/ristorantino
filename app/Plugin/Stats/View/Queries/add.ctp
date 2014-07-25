<?php
echo $this->Html->script('jquery-ui-1.8.5.custom.min', false);
echo $this->Html->css('smoothness/jquery-ui-1.8.5.custom',null, false);
?>

<div class="queries form">
<?php echo $this->Form->create('Query');?>
	<fieldset>
 		<legend><?php __('Add Query');?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		
                /* @var $ajax AjaxHelper */
		echo $ajax->autoComplete('categoria', '/pquery/queries/listado_categorias');
		
		echo $this->Form->input('ver_online',array('label'=>'¿Ver Online?','after'=>'si se tilda esta opcion se habiiltara la query para ver de forma online como una pagina normal.'));
		
		
		echo $this->Form->input('query');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('List Queries', true), array('action'=>'index'));?></li>
	</ul>
</div>

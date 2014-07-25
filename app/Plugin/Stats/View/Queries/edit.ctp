<?php
echo $this->Html->script('jquery-ui-1.8.5.custom.min', false);
echo $this->Html->css('smoothness/jquery-ui-1.8.5.custom',null, false);
?>

<script type="text/javascript">
        $(function(){
            jQUery('.editable').editable();
        })
</script>


<div class="queries form">
<?php echo $this->Form->create('Query');?>
	<fieldset>
 		<legend><?php __('Editar Query');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');

		 /* @var $ajax AjaxHelper */
		echo $ajax->autoComplete('categoria', '/pquery/queries/listado_categorias');
                
		echo "<div>";
		echo $this->Form->input('ver_online',array('label'=>'¿Ver Online?','after'=>'si se tilda esta opcion se habiiltara la query para ver de forma online como una pagina normal.'));
		echo "</div>";
		
		echo $this->Form->input('query');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action'=>'delete', $this->Form->value('Query.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Query.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Queries', true), array('action'=>'index'));?></li>
	</ul>
</div>

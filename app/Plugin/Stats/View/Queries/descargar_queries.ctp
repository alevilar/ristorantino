<h1>Informacion</h1>

<script type="text/javascript">
<!--
	Event.observe(window, "keypress", function(e){ 
		var cKeyCode = e.keyCode || e.which; 
		if (cKeyCode == Event.KEY_RETURN){ 
			$('FormCategorias').submit();
		} 
	});
//-->
</script>

<h2>Buscador</h2>
<?php


?>

<?php echo $this->Form->create('Pquery.Query',array(	'url'=>'/pquery/queries/descargar_queries/'.$categoria,
										'id'=>'FormCategorias'));?>
<?php		
		echo $this->Form->input('categoria', array('type'=>'select',
											 'label'=>'Categoria',
											 'value'=>$categoria,
											 'options'=>$categorias,
											 'onChange'=>'$("FormCategorias").submit();'
											 ));
											 
		echo $this->Form->input('description', array( 'label'=> 'Ingrese criterio de busqueda',
												'type'=>'text',
										 		'after'=> '<cite>Busca tanto en el nombre del archivo como en la descripcion.</cite>'));
		echo $this->Form->end('Buscar');										 
?>

<h2>Descargas Excel</h2>
<div>
<br />
<ul>
<?
foreach ($queries as $q):?>
	<li>
		<?= $this->Html->link($q['Query']['name'].'.xls','contruye_excel/'.$q['Query']['id']); ?>
		<?= "(".date("j F, Y, g:i a",strtotime($q['Query']['modified'])).")"; ?>
		<? if($q['Query']['ver_online']) 
			echo $this->Html->link('ver online', array('action'=>'list_view',$q['Query']['id']));?>
		<br /><?=  $q['Query']['description'] ?>
	</li>
	<?php 
endforeach;
?>
</ul>
</div>
<div class="queries index">
<br><p style="text-align: left"><?php
echo $descripcion;
?></p>

<p style="text-align: center;">
<?php
if (isset($paginator)){
$paginator->options(array('url' => $url_conditions));
}
//echo $paginator->counter(array(
//'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
//));

if (isset($paginator)){
echo $paginator->counter(array(
	'format' => __('Página %page% de %pages% Mostrando %current% registros de %count% encontrados', true)
));
}
//debug($url_conditions);
?></p>

<p>
<?php 
if ($viewAll){
	echo $html->link('Ver Todos','/Queries/list_view/query.id:'.$url_conditions['query.id'] . '/viewAll:true/',array('class'=>'clearTag'));
} else {
	echo $html->link('Ver por pagina','/Queries/list_view/query.id:'.$url_conditions['query.id'] . '/viewAll:false/',array('class'=>'clearTag'));	
}	
?>

<?php echo " | "?>
<?php echo $html->link('descargar excel','/Queries/contruye_excel/'.$url_conditions['query.id'] ,array('class'=>'clearTag'));?>

<?php echo " | "?>
<?php echo $html->link('Volver','/Queries/descargar_queries/',array('class'=>'clearTag'));?>

</p>

<table cellpadding="0" cellspacing="0">

<tr>
	<?php foreach ($cols as $col): ?>
	<th><?php echo $col;?></th>
	<?php endforeach; ?>
</tr>
<?php
$i = 0;
foreach ($queries as $query):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
	   <?php foreach($query as $line):?>	
		<td>
			<?php echo $line; ?>
		</td>
		<?php endforeach; ?>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php 
	if (isset($paginator)){
		echo $paginator->prev('<<', array(), null, array('class'=>'disabled'));
		echo "&nbsp;";
		echo $paginator->numbers();
		echo "&nbsp;";
		echo $paginator->next(' >>', array(), null, array('class'=>'disabled'));
	}		
	?>
</div>
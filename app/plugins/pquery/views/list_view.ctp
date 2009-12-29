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
	'format' => __('Pagina %page% de %pages% Mostrando %current% registros de %count% encontrados', true)
));
}
//debug($url_conditions);
?></p>

<p>
<?php 
if ($viewAll){
	echo $html->link('Ver Todos','/pquery/Queries/list_view/query.id:'.$url_conditions['query.id'] . '/viewAll:true/',array('class'=>'clearTag'));
} else {
	echo $html->link('Ver por pagina','/pquery/Queries/list_view/query.id:'.$url_conditions['query.id'] . '/viewAll:false/',array('class'=>'clearTag'));	
}	
?>

<?php echo " | "?>
<?php echo $html->link('descargar excel','/Queries/contruye_excel/'.$url_conditions['query.id'] ,array('class'=>'clearTag'));?>

<?php echo " | "?>
<?php echo $html->link('Imprimir','#Imprimir',array('class'=>'clearTag','onclick'=>'window.print()'));?>

<?php echo " | "?>
<?php echo $html->link('Volver','/pquery/Queries/descargar_queries/',array('class'=>'clearTag'));?>

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
	   <?php foreach($query[0] as $line):?>	
		<td>
			<?php echo $line; ?>
		</td>
		<?php endforeach; ?>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging" style="background-color: #F0F7FC; height: 60px; padding-top: 20px; text-align: center;border-top: 3px solid #DBEBF6">
	<?php 
	if (isset($paginator)){
		echo $paginator->prev('<<');
		echo "&nbsp;";
		echo $paginator->numbers();
		echo "&nbsp;";
		echo $paginator->next('>>');
	}		
	?>
</div>
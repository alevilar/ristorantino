<?php
$catId = $categoria['Categoria']['id'];
$catName = $categoria['Categoria']['name'];
?>
<li id='categoria-id-<?= $catId ?>'>

	<label for="categoria_tree_view_<?= $catId ?>" class="btn"><?= $catName ?></label>
	<input type="checkbox" id="categoria_tree_view_<?= $catId ?>" value="<?= $catId ?>"/>

	<?php if ( !empty($categoria['Hijos']) ) { ?>
		<ol class="body">    		
		<?php
		    foreach ($categoria['Hijos'] as $c) {
		        echo $this->element('comanda_add/listar_categorias', array('categoria' => $c));
		    }
		?>
		</ol>
	<?php } ?>

</li>


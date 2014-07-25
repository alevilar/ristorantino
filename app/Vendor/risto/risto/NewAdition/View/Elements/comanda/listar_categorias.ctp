<?php
$catId = $categoria['Categoria']['id'];
$catName = $categoria['Categoria']['name'];
?>
<button id='categoria-id-<?= $catId ?>' value="<?= $catId ?>" class="btn btn-primary">
    <?= $catName ?>
</button>

<?php if ( !empty($categoria['Hijos']) ) { ?>
    <div class="body" id='categoria-hijos-<?= $catId ?>' style="display:none">
    <?php
        foreach ($categoria['Hijos'] as $c) {
            echo $this->element('comanda/listar_categorias', array('categoria' => $c));
        }
    ?>
    </div>
<?php } ?>


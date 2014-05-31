
<style>
    .horizontal li{
        display: inline;
    }
</style>


<? echo $this->element('menu')?>

<h2>Modificar inventario de <?  $prod['Product']['name']; ?></h2>

<div>

    <?php
    
    echo $form->create('Count');
    echo $form->input('product_id', array('type'=>'hidden', 'value'=>$prod['Product']['id']));
    echo $form->input('count', array('label'=>"Ingresar cantidad de <span style='font-size: 24px;'>".$prod['Product']['name']."</span>"));
    echo $form->end('Guardar');
    
?>
</div>

<script type="text/javascript">
    jQuery('#CountCount').focus();
</script>

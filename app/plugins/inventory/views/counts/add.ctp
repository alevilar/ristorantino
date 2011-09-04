
<style>
    .horizontal li{
        display: inline;
    }
</style>


<? echo $this->element('menu')?>

<h2>Agregar Cantidad a inventario</h2>

<div class="clear" style="height: 30px;"></div>
<div>

<?php

if (empty($prod)) {
    echo "<h1 style='color: red'>Tarea Terminada</h1>";
} else {
    ?>
    <h1 style="padding: 0px; margin: 0px; color: red;">Vamos que faltan solo <?php echo count($prodsQueFaltan)?></h1>
    <?php
    $prodName = $prod['Product']['name'];
    
    echo $form->create('Count');
    echo $form->input('product_id', array('type'=>'hidden', 'value'=>$prod['Product']['id']));
    echo $form->input('count', array('label'=>"Ingresar cantidad de <span style='font-size: 24px;'>$prodName</span>"));
    echo $form->end('Guardar');
    
    ?>
    

    <div class="clear" style="height: 30px;"></div>
    <div class="">
        <h3>Productos que aún faltan cargar</h3>
    <?php
    foreach ($prodsQueFaltan as $pqf){
        echo $html->link($pqf['Product']['name'], '/inventory/counts/add/'.$pqf['Product']['id']).' - ';
    }
    ?>
    </div>    
    
    
    
    <?php
    
    
}

?>
</div>

<script type="text/javascript">
    jQuery('#CountCount').focus();
</script>




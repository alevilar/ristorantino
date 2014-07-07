<script type="text/javascript">
<?php
if (!empty($mozos)) {
    $data = array();
    $i = 0;
    foreach ($mozos as $m) {
        $data[$i] = $m['Mozo'];
        $data[$i]['Mesa'] = aplanar_mesas($m['Mesa']);

        $i++;
    }
    $mozos = $data;
    ?> 

            
<?php
} else {
    $mozos = array();
}
?>
    App.mozos = <?php echo json_encode($data); ?>;      
    
    
    
<?php
if (!empty($categoriasTree)) {
    ?>
                    
    <?php
} else {
    $categoriasTree = [];
}
?>
    App.categoriasTree = <?php echo json_encode($categoriasTree, JSON_NUMERIC_CHECK); ?>;      
  
    
    
    
     
    
    App.productos = {};
<?php
if (!empty($productos)) {
    foreach ($productos as $prod) {
        ?> 
                        App.productos[<?= $prod['Producto']['id'] ?>] = <?= json_encode($prod['Producto'], JSON_NUMERIC_CHECK); ?>;
        <?php
    }
}
?>


    
    App.TITULO_MESA = "<?php echo Configure::read('Mesa.tituloMesa') ?>";
    App.TITULO_MOZO = "<?php echo Configure::read('Mesa.tituloMozo') ?>";
        
        
    // intervalo en milisegundos en el que seran renovadas las mesas
    App.MESAS_RELOAD_INTERVAL = <?php echo Configure::read('Adicion.reload_interval') ?>;
    App.MESAS_COBRADA_HIDE_MS = <?php echo Configure::read('Adicion.cobrada_hide_ms') ?>;
    //        App.MESA_RELOAD_TIMEOUT = <?php echo Configure::read('Adicion.reload_interval_timeout') ?>;
        
    App.VALOR_POR_CUBIERTO = <?php
                            $valorCubierto = Configure::read('Restaurante.valorCubierto');
                            echo $valorCubierto > 0 ? $valorCubierto : 0;
                            ?>;
        
    // hace que luego de cobrar una mesa, esta quede activa durante X segundos
    //        App.ESPERAR_DESPUES_DE_COBRAR = 0;
        
        
    App.IMPRIME_REMITO_PRIMERO = <?php echo Configure::read('Mesa.imprimePrimeroRemito') ? 1 : 0 ?>;

    //Parametros de configuracion
    App.cubiertosObligatorios   = <?php echo Configure::read('Adicion.cantidadCubiertosObligatorio') ? 'true' : 'false' ?>;
  
</script>
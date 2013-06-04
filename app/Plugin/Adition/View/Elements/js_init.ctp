<script type="text/javascript">
    <!--
                   
    (function(){
        
        var jqmOps = {
        }
<?php
$animar = Configure::read('Adicion.jqm_page_transition');
if (empty($animar)) {
    if (!$animar) {
        ?>
                        jqmOps.defaultPageTransition =  'none';
                        jqmOps.defaultDialogTransition = 'none';
    <?php }
} ?>
        $.extend(  $.mobile , jqmOps);
    })();
    
<?php
if (!empty($mozos)) {
    $mozos_aplanados = array();
    foreach ($mozos as $mz) {
        $mozos_aplanado[] = $mz['Mozo'];
    }
    ?>
        

        App.mozos = <?php echo json_encode($mozos_aplanado); ?>;      
<?php } ?>
    
    
    
    App.categoriasTree = {};
<?php
if (!empty($categoriasTree[0])) {
        ?>
                App.categoriasTree = <?php echo json_encode($categoriasTree[0]); ?>;      
        <?php
}
?>
    
        App.categorias = {};
<?php
if (!empty($categorias)) {
    foreach ($categorias as $cas) {
        ?>
                App.categorias[<?= $cas['Categoria']['id']; ?>] = <?php echo json_encode($cas); ?>;      
        <?php
    }
}
?>
    
    
    
    App.productos = {};
<?php
if (!empty($productos)) {
    foreach ($productos as $prod) {
        ?> 
                        App.productos[<?= $prod['Producto']['id'] ?>] = <?= json_encode($prod['Producto']); ?>;
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
  
    -->
</script>
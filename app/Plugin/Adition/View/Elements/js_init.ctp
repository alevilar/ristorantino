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
    

                R$.mozos = <?php echo json_encode($mozos_aplanado); ?>;      
<?php } ?>
    
        R$.TITULO_MESA = "<?php echo Configure::read('Mesa.tituloMesa') ?>";
        R$.TITULO_MOZO = "<?php echo Configure::read('Mesa.tituloMozo') ?>";
        
        
        // intervalo en milisegundos en el que seran renovadas las mesas
        R$.MESAS_RELOAD_INTERVAL = <?php echo Configure::read('Adicion.reload_interval') ?>;
        R$.MESAS_COBRADA_HIDE_MS = <?php echo Configure::read('Adicion.cobrada_hide_ms') ?>;
        //        R$.MESA_RELOAD_TIMEOUT = <?php echo Configure::read('Adicion.reload_interval_timeout') ?>;
        
        R$.VALOR_POR_CUBIERTO = <?php
$valorCubierto = Configure::read('Restaurante.valorCubierto');
echo $valorCubierto > 0 ? $valorCubierto : 0;
?>;
        
    // hace que luego de cobrar una mesa, esta quede activa durante X segundos
    //        R$.ESPERAR_DESPUES_DE_COBRAR = 0;
        
        
    R$.IMPRIME_REMITO_PRIMERO = <?php echo Configure::read('Mesa.imprimePrimeroRemito') ? 1 : 0 ?>;

    //Parametros de configuracion
    R$.cubiertosObligatorios   = <?php echo Configure::read('Adicion.cantidadCubiertosObligatorio') ? 'true' : 'false' ?>;
  
    -->
</script>
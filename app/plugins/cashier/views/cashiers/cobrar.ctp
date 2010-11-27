<script type="text/javascript">

var cajero = new Cajero();
cajero.tiposDePagos = <?php echo json_encode($tipo_de_pagos)?>;
cajero.urlGuardar = "<?php echo $html->url('/pagos/add');?>";

    console.log(cajero);
    cajero.setMesasCerradas();
    console.info(cajero);

                cajero.setMesasAbiertas();
    console.info(cajero);


    $(document).ready(function(){
        console.info("empezo");
       cajero.mesasCerradasToLi();
       cajero.mesasAbiertasToLi();
       console.info("termino");
    });
    
</script>

<ul id="mesas-cerradas"></ul>

<ul id="mesas-abiertas"></ul>
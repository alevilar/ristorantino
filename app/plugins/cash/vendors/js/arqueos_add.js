(function() {
    var elContainer = document.getElementById("arqueoContainer"),
            $arqSaldo = jQuery("#ArqueoSaldo"),
            $arqInicial = jQuery("#ArqueoImporteInicial"),
            $arqIngreso = jQuery("#ArqueoIngreso"),
            $arqEgreso = jQuery("#ArqueoEgreso"),
            $arqOtrosIngresos = jQuery("#ArqueoOtrosIngresos"),
            $arqOtrosEgresos = jQuery("#ArqueoOtrosEgresos"),
            $arqImporteFinal = jQuery("#ArqueoImporteFinal")
            ;


    function $v($el) {
        var val = new Number($el.val());
        return val;
    }

    function calcularSaldo() {
        var saldo = $v($arqInicial) + $v($arqIngreso) - $v($arqEgreso) + $v($arqOtrosIngresos) - $v($arqOtrosEgresos) - $v($arqImporteFinal);
        $arqSaldo.val(saldo);

        if (saldo == 0) {
            elContainer.style.background = '#AFE0A8';
        } else {
            if (Math.abs(saldo) < 11) {
                elContainer.style.background = '#FFFFCC';
            } else {
                elContainer.style.background = '#FFCCFF';
            }
        }
    }


    calcularSaldo();


    jQuery($arqSaldo).bind('change', calcularSaldo);
    jQuery($arqInicial).bind('change', calcularSaldo);
    jQuery($arqIngreso).bind('change', calcularSaldo);
    jQuery($arqEgreso).bind('change', calcularSaldo);
    jQuery($arqOtrosIngresos).bind('change', calcularSaldo);
    jQuery($arqOtrosEgresos).bind('change', calcularSaldo);
    jQuery($arqImporteFinal).bind('change', calcularSaldo);


    jQuery(function() {
        jQuery(".datepicker").datetimepicker({
            dateFormat: 'yy-mm-dd'            
         });
        /*
         jQuery( ".datepicker" ).datepicker({
         defaultDate: "+1w",
         changeMonth: true,
         numberOfMonths: 1,              
         dateFormat: 'yy-mm-dd'
         }); 
         */
        jQuery("#ArqueoHacerCierreZeta").change(function() {
            if (this.checked) {
                jQuery('.mostrar_zeta').show();
            } else {
                jQuery('.mostrar_zeta').hide();
            }

        });
        
        
        jQuery('#ZetaMontoNeto').change(function(){
            var valor = new Number(this.value);
            jQuery('#ZetaMontoIva').val(parseInt(valor * 0.21 * 100)/100);
        });
        
        jQuery('#ZetaNotaCreditoNeto').change(function(){
            var valor = new Number(this.value);
            jQuery('#ZetaNotaCreditoIva').val(parseInt(valor * 0.21 * 100)/100);
        });

    });


})();

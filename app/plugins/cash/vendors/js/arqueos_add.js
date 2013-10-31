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
        
        jQuery("#ArqueoImporteFinal").focusin(function(){
            jQuery("#billetines").show();            
        });
        
        jQuery('#ZetaMontoNeto').change(function(){
            var valor = new Number(this.value);
            jQuery('#ZetaMontoIva').val(parseInt(valor * 0.21 * 100)/100);
        });
        
        jQuery('#ZetaNotaCreditoNeto').change(function(){
            var valor = new Number(this.value);
            jQuery('#ZetaNotaCreditoIva').val(parseInt(valor * 0.21 * 100)/100);
        });
        
        
        function sumarBilletes(){
            var b100 = new Number(jQuery('#BilletesB100').val())*100;
            var b50 = new Number(jQuery('#BilletesB50').val())*50;
            var b20 = new Number(jQuery('#BilletesB20').val())*20;
            var b10 = new Number(jQuery('#BilletesB10').val())*10;
            var b5 = new Number(jQuery('#BilletesB5').val())*5;
            var b2 = new Number(jQuery('#BilletesB2').val())*2;
            var b1 = new Number(jQuery('#BilletesB1').val())*1;
            var b0 = new Number(jQuery('#BilletesB0').val())*0.5;
            var bA = new Number(jQuery('#BilletesBA').val());
            
            jQuery('#ArqueoImporteFinal').val(b100+b50+b20+b10+b5+b2+b1+b0+bA);
        }
        
        jQuery('#BilletesB100').change(sumarBilletes);
        jQuery('#BilletesB50').change(sumarBilletes);
        jQuery('#BilletesB20').change(sumarBilletes);
        jQuery('#BilletesB10').change(sumarBilletes);
        jQuery('#BilletesB5').change(sumarBilletes);
        jQuery('#BilletesB2').change(sumarBilletes);
        jQuery('#BilletesB1').change(sumarBilletes);
        jQuery('#BilletesB0').change(sumarBilletes);
        jQuery('#BilletesBA').change(sumarBilletes);

    });


})();

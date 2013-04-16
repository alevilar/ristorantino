(function() {
    var $importes = jQuery(".importe");
    
    
    function redondeo(valor){
        return Math.round(valor*10000)/10000
    }
    
    
    
    function sumaNetos(){
        var $importes = jQuery('#GastoAddForm input.calc_impuesto, #GastoAddForm input.calc_neto');
        var total = 0;
        jQuery.each($importes, function (v){
            total += Number(jQuery($importes[v]).val());
        })
        return total;
    }
    
    $('#GastoAddForm').bind('submit', function(){
        if  ( sumaNetos() != $('#importe-total').val() ) {
            return confirm("El importe Total no es igual a la Suma de todos los netos!! ¿Seguro que desea guardar?");
        }
        return true;
    });
    
    
    $('.calc_neto, .calc_impuesto').bind('change', function(){
        $('#account-total-sumado').html(sumaNetos());
    });
        
        
    jQuery("#GastoAddForm input.calc_impuesto").click(function(e){
        if (!jQuery(this).val()) {
            var porcent = jQuery(this).attr('data-porcent');
            var valor;
            if (porcent){
                valor = jQuery( this.form.elements['data[Gasto][importe_total]'] ).val() / ((100/porcent)+1);
                if (valor) {
                    jQuery(this).val(redondeo(valor));
                }
            }
        }
    });


    jQuery("#GastoAddForm input.calc_neto").click(function(e){   
        var porcent = jQuery(this).attr('data-porcent');
        var valor;

        if (!jQuery(this).val()) {
            if (porcent){
                valor = jQuery( this.form.elements['data[Gasto][importe_total]'] ).val() / ((porcent/100)+1);
                if (valor) {
                    jQuery(this).val(redondeo(valor));
                }
            }
        }
    });


    jQuery("#GastoAddForm input.calc_neto").change(function(e){
        var porcent = jQuery(this).attr('data-porcent');
        var valor = jQuery(this).val()*porcent/100;
        var $impuesto = jQuery(this).parents('fieldset').find('input.calc_impuesto');
        if ( !$impuesto.val() ) {
            jQuery(this).parents('fieldset').find('input.calc_impuesto').val(redondeo(valor));
        }
    });


    jQuery("#btn-guardar-sin-pagar").click(function(e){      
        $(this.form.elements['data[Gasto][pagar]']).val(0);
        return $('#GastoAddForm').submit(); 
    });
    
    jQuery("#btn-guardar-y-pagar").click(function(e){      
        $(this.form.elements['data[Gasto][pagar]']).val(1);
        return $('#GastoAddForm').submit(); 
    });

})();

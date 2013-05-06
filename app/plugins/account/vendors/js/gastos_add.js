(function() {
    
    function redondeo(valor){
        return Math.round(valor*100)/100
    }
     
    
    function sumaNetos() {
        var $importes = jQuery('#GastoAddForm input.calc_impuesto, #GastoAddForm input.calc_neto');
        var total = 0;
        jQuery.each($importes, function (v){
            total += Number(jQuery($importes[v]).val());
        })
        return redondeo(total);
    }
    
    function modificarTotalesSumados(){
        $('#importes-sumados').text( sumaNetos() );
    }
    
    
    $('input','#GastoAddForm').bind('keyup', modificarTotalesSumados);
    
    
    $('#GastoAddForm').bind('submit', function(){
        if  ( sumaNetos() != $('#importe-total').val() ) {
            return confirm("El importe Total no es igual a la Suma de todos los netos!! ¿Seguro que desea guardar?");
        }
        return true;
    });
       
        
        
    jQuery("input.calc_impuesto", "#GastoAddForm").bind('click', function(e){
        var porcent = Number( jQuery(this).attr('data-porcent') );
        if (porcent && !jQuery(this).val()) {
            var valor;
            if (porcent){
                valor = jQuery( this.form.elements['data[Gasto][importe_total]'] ).val() / ((100/porcent)+1);
                if (valor) {
                    jQuery(this).val(redondeo(valor));
                }
            }
            modificarTotalesSumados();
        }
    });

    jQuery("input.calc_neto", '#GastoAddForm').bind('click', function(e){   
        var porcent = Number( jQuery(this).attr('data-porcent') );
        var valor;
        if (porcent && !jQuery(this).val()) {
            if (porcent){
                valor = jQuery( this.form.elements['data[Gasto][importe_total]'] ).val() / ((porcent/100)+1);
                if (valor) {
                    jQuery(this).val(redondeo(valor));
                }
            }
            modificarTotalesSumados();
        }
    });


    jQuery("input.calc_neto", '#GastoAddForm').bind('change', function(e){
        var porcent = jQuery(this).attr('data-porcent');
        var valor = jQuery(this).val()*porcent/100;
        var $impuesto = jQuery(this).parents('fieldset').find('input.calc_impuesto');
        if ( porcent && !$impuesto.val() ) {
            jQuery(this).parents('fieldset').find('input.calc_impuesto').val(redondeo(valor));
            modificarTotalesSumados();
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
    
    modificarTotalesSumados();

})();

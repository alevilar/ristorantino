(function() {
    
    function redondeo(valor){
        return Math.round(valor*100)/100;
    }
    
    function __sumaByTag( tagName ){
        var $importes = jQuery( tagName );
        
        var total = 0;           
        
        if ($importes) {
            jQuery.each($importes, function (v){
                total += Number(jQuery($importes[v]).val());
            });
        }
        return redondeo(total);
    }
    
    
    function sumaImpuestos () {
        return __sumaByTag('#GastoAddForm input.calc_impuesto');
    };
     
    
    function sumaNetos() {
        return __sumaByTag('#GastoAddForm input.calc_neto');        
    };
    
    function sumaTotal () {
        return redondeo( sumaNetos()+sumaImpuestos() );
    }
    
    function modificarTotalesSumados(){
        var vsumaNetos = sumaNetos();
        var vsumaTotal = sumaTotal();        
        
        if ( vsumaTotal ) {
            $('#importe-total').val( vsumaTotal );
        } else {
            $('#importe-total').val( null );
        }
        
        if ( vsumaNetos ) {
            $('#importe-neto').val( vsumaNetos );
        } else {
            $('#importe-neto').val( null );
        }
    }
    
    
    $('input.importe','#GastoAddForm').bind('keyup', modificarTotalesSumados);
    
    
    $('#GastoAddForm').bind('submit', function(){
        var okNeto = true,
            okTotal = true;
            
        if  ( sumaNetos() != 0 && sumaNetos() != $('#importe-neto').val() ) {
            okNeto = confirm("El importe NETO no es igual a la Suma de todos los netos!! ¿Seguro que desea guardar?");
        }
        if  ( sumaTotal() != 0 && sumaTotal() != $('#importe-total').val() ) {
            okTotal = confirm("El importe Total no es igual a la Suma de todos los importes!! ¿Seguro que desea guardar?");
        }
        if ( !okNeto || !okTotal ) {
            return false
        } else {
            return true;
        }
    });
       
        
        
    jQuery("input.calc_impuesto", "#GastoAddForm").bind('click', function(e){
        var porcent = Number( jQuery(this).attr('data-porcent') );
        var $parent = jQuery(this).parents('fieldset');
        var neto = $parent.find('input.calc_neto').val();
        var valor;
        if (porcent && !jQuery(this).val() && neto) {
            valor = neto *  (porcent/100) ;
            if (valor > 0) {
                jQuery(this).val(redondeo(valor));
            }
            modificarTotalesSumados();
        }
    });

    jQuery("input.calc_neto", '#GastoAddForm').bind('click', function(e){   
        var porcent = Number( jQuery(this).attr('data-porcent') );
        var $parent = jQuery(this).parents('fieldset');
        var impuesto = $parent.find('input.calc_impuesto').val();
        var valor;
        if (porcent && !jQuery(this).val() && impuesto) {
            valor = impuesto / ( porcent/100 );
            if (valor > 0) {
                jQuery(this).val(redondeo(valor));
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
    
//    modificarTotalesSumados();

})();

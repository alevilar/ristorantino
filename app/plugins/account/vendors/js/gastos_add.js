(function($) {
    
    function redondeo(valor){
        return Math.round(valor*100)/100;
    }
    
    function __sumaByTag( tagName ){
        var $importes = $( tagName );
        
        var total = 0;           
        
        if ($importes) {
            jQuery.each($importes, function (v){
                total += Number($($importes[v]).val());
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
    
    
    
    function $netoVecino (el) {
        var $parent = $(el).parents('fieldset');
        return $parent.find('input.calc_neto')
    }
    
    function $impuestoVecino (el) {
        var $parent = $(el).parents('fieldset');
        return $parent.find('input.calc_impuesto');
    }
    
    
    function calcularImpuestoSegunNetoVecino(elImpuesto){
        var porcent = Number( $(elImpuesto).attr('data-porcent') );
        var neto = $netoVecino(elImpuesto).val();
        var valor;
        if (porcent && !$(elImpuesto).val() && neto) {
            valor = neto *  (porcent/100) ;
            if (valor > 0) {
                $(elImpuesto).val(redondeo(valor));
            }
            modificarTotalesSumados();
        }
    }
    
    
    function calcularNetoSegunImpuestoVecino(elNeto) {
        var porcent = Number( $(elNeto).attr('data-porcent') );
        var impuesto = $impuestoVecino().val();
        var valor;
        if (porcent && !$(elNeto).val() && impuesto) {
            valor = impuesto / ( porcent/100 );
            if (valor > 0) {
                $(elNeto).val(redondeo(valor));
            }
            modificarTotalesSumados();
        }
    }
       
       
    $(".calc_impuesto", "#GastoAddForm").bind('focus', function(e){
        calcularImpuestoSegunNetoVecino(this);
    });

    $(".calc_neto", '#GastoAddForm').bind('focus', function(e){   
        calcularNetoSegunImpuestoVecino(this);
    });


    $("input.calc_neto", '#GastoAddForm').bind('change', function(e){
        var porcent = $(this).attr('data-porcent');
        var valor = $(this).val()*porcent/100;
        var $impuesto = $(this).parents('fieldset').find('input.calc_impuesto');
        if ( porcent && !$impuesto.val() ) {
            $(this).parents('fieldset').find('input.calc_impuesto').val(redondeo(valor));
            modificarTotalesSumados();
        }
    });


    $("#btn-guardar-sin-pagar").click(function(e){      
        $(this.form.elements['data[Gasto][pagar]']).val(0);
        return $('#GastoAddForm').submit(); 
    });
    
    $("#btn-guardar-y-pagar").click(function(e){      
        $(this.form.elements['data[Gasto][pagar]']).val(1);
        return $('#GastoAddForm').submit(); 
    });
    



        // Autocomplete
        $('input.auto-complete').on('change',function(){
            // borrar cuando se elimina el texto del proveedor
            if ( !this.value ) {
                $("#GastoProveedorId").attr('value','');
            }
        });
        $('input.auto-complete').on('focusout', function(){
            $('input.auto-complete').popover('hide');
        });
        // popover con informacion para crear nuevos proveedores
        $('input.auto-complete').popover({
                        html: true,
                        trigger: 'manual',
                        title: '<span class="text-danger">No Existe<span>',
                        container: 'body',
                        content: 'Se va a guardar como nuevo Proveedor automáticamente. \n\
                                    <br><br><p>Puede agregar el CUIT al final, si lo desea<br><cite>Ej: "LA SERENISIMA 33-34343434-2 (funciona con y sin guiones)"'
                    });
        $('input.auto-complete').typeahead({
            source: function(a,b ){
                var obj = {
                    'data[Proveedor][buscar_proveedor]': a
                };
                $.post(urlDomain+'account/proveedores/index.json', obj).done(function(data, state){
                    if (!data.length) {                        
                        $('input.auto-complete').popover('show');                        
                        $('#nuevo-proveedor').show('fade');
                    } else {
                        $('#nuevo-proveedor').hide('fade');
                    }
                    
                    b(data, state);
                });
            }
        }).on('select', function(a,b,c){
            var id = $(b).attr('data-id');
            if (id) {
                $("#GastoProveedorId").val(id);
            }
        });
      
})(jQuery);


( function($) {
        $.jsDate.config.defaultLocale = 'es';

        $(document).ready(function(){
            
            
            mesas.getCoordenadas = function(){

                    var lineas = [];
                    $.each(mesas,function(l){  
                       var coordxLinea = [];
                        $.each(mesas[l],function(i){
                            var coordMesa = [mesas[l][i].Mesa.fecha, parseFloat(mesas[l][i].Mesa.total)];
                            coordxLinea.push(coordMesa);  
                        })
                        lineas.push(coordxLinea);
                    });

                    return lineas; 

            } 
            
            egresos.getCoordenadas = function(){
                    var lineas = [];
                    $.each(egresos,function(l){  
                       var coordxLinea = [];
                        $.each(egresos[l],function(i){
                            var coordMesa = [egresos[l][i].Egreso.fecha, parseFloat(egresos[l][i].Egreso.importe)];
                            coordxLinea.push(coordMesa);  
                        })
                        lineas.push(coordxLinea);
                    });
                    return lineas; 
            } 
      
 
            $.jqplot.config.enablePlugins = true;    
            
                 
     
    //s1 = [['2011-03',220],['2011-04',290],['2011-05',330],['2011-06',330]];
    var cords1 = mesas.getCoordenadas();
    
    var cords2 = egresos.getCoordenadas();
    
    var cords = [cords1[0], cords2[0]];
    
               plot1 = $.jqplot('chart1',  cords,{
                   
                   title: 'Ventas y Pagos',
                   axes: {
                       xaxis: {
                           renderer: $.jqplot.DateAxisRenderer,
                           tickOptions: {
                               formatString: '%a %e de %b'
                                               //formato de la fecha
                           }
                       },
                       yaxis: {
                           tickOptions: {
                               formatString: '$%.0f'
                           }
                       }
                   }
               });
               
               
               
               

        });

    $(document).ready(
          function() {
       
        $("#otrafecha").click(function () {
            $("#seg_fecha").toggle("fast");
        });
    }
    );
    
})(jQuery); 
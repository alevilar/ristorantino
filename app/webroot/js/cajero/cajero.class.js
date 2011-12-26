function Cajero(){
    this.mesasAbiertas= new Array();
    this.mesasCerradas= new Array();

    this.mesasCerradasLi = new Array();

    this.setMesasCerradas = function(){
       this.mesasCerradas = $.parseJSON($.ajax({
                                url: htmlHelper.url('mesas', 'cerradas.json'),
                                async: false
                            }).responseText);
    }

    this.setMesasAbiertas = function(){
       this.mesasAbiertas = $.parseJSON($.ajax({
                                url: htmlHelper.url('mesas', 'abiertas.json'),
                                async: false
                            }).responseText);
    }







// VIEWS
    this.mesasCerradasToLi = function(){
       $.each(this.mesasCerradas, function(k,m){
           var elemm = $('<li mesa="'+m.Mesa.numero+'">'+m.Mesa.numero+'</li>');
           elemm.click(function(e){
               if (!m.Mesa.cant) m.Mesa.cant = 0;
               m.Mesa.cant++;
           });

           $('#mesas-cerradas').append(elemm);
        });
    }


    this.mesasAbiertasToLi = function(){
       $.each(this.mesasAbiertas, function(k,m){
           $('#mesas-abiertas').append('<li>'+m.Mesa.numero+'</li>');
        });
    }
  
}

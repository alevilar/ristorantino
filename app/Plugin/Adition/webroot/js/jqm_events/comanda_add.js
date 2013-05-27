$.mobile.ignoreContentEnabled = true;
// enrquiqueecr con JQM el listado ed comandas de la mesa en msa-view
$(document).on('pageshow', '#comanda-add',function(event, ui){
        
        R$.app.resetState();
        
        
        // inicializar listado del Menu con la clase root-ul
        document.getElementById('listado_categorias').firstElementChild.className = 'root-ul';
});

// enrquiqueecr con JQM el listado ed comandas de la mesa en msa-view
$(document).on('pagehide', '#comanda-add',function(event, ui){     
});
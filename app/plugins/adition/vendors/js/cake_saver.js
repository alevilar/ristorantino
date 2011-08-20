var $cakeSaver = {
    
    method: 'POST',
    
    /**
     * 
     * Objeto a mandar, debe tener como minimo:
     *  'url' => es la url donde se enviara el post
     *  'obj' => es el objeto que voy a enviar
     */
    send: function( sendObj ){
        var obj = sendObj['obj'];
        var url = sendObj['url'];
        var model = sendObj['model'];
        var method = sendObj['method'] || this.method;
        var ob = this.__processObj(obj, model);
        
        $.ajax({
            'url': url,
            'data': ob,
            'type': method,
            success: function(){
            }
        });
       
    },
    
    __processObj: function(obj, model){
        var auxObj = ko.toJS(obj);
        var ooo = {};
        
        for (var i in auxObj ) {
            if ( typeof auxObj[i] != 'object' && typeof auxObj[i] != 'function') {
                ooo['data['+model+']['+i+']'] = auxObj[i];
            }
        }
//        ooo = ko.toJSON(ooo);
        ooo = $.param(ooo);
        return ooo;
    }
    
}
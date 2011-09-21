/*--------------------------------------------------------------------------------------------------- CakeSaver
 *
 *
 * Clase CakeSaver
 * 
 * Convierte objetos de javascript en algo que CakePhp pueda leer bajo el $this->data
 * o sea, convierte los objetos a un array para enviar via method POST en ajax
 */
var $cakeSaver = {
    
    method: 'POST',
    
    /**
     * 
     * @param sendObje Objeto a mandar, debe tener como minimo:
     *  'url' => es la url donde se enviara el post
     *  'obj' => es el objeto que voy a enviar$cakeSaver
     *  'error' => function handler
     *  @param fn funcion callback a ejecutar onSuccess
     */
    send: function( sendObj , fn){
        var obj = sendObj['obj'];
        var url = sendObj['url'];
        var errorHandler = sendObj.error || function(){};
        var method = sendObj['method'] || this.method;
        var ob = this.__processObj(obj, obj.model);

        $.ajax({
            'url': url,
            'data': ob,
            'type': method,
            error: errorHandler,
            success: function(data){
                if (typeof fn == 'function'){
                    fn.call(data);
                } else {
                    try { 
                    if ( obj.handleAjaxSuccess ) {
                            obj.handleAjaxSuccess(data, url, method);
                        } else {
                            throw "$cakeSaver:: EL objeto '"+obj.model+"' pasado para enviar vía ajax no tiene una función llamada 'handleAjaxSuccess'. La misma es indispensable para tratar la respuesta.";
                        }
                    }
                    catch(er) {
                        jQuery.error(er);
                    }
                }
            }
        });
       
    },
    
    
    /**
     *
     * @param auxObj es el objeto que voy a aplanar
     * @param recursivObj es el objeto resultado de este proceso. Sirve cuando quiero hacerlo de forma recursiva
     * @key es un string, la continuacion del $this[data][blah][blah] que deseo crear automaticamente
     */
    __aplanarObj: function(auxObj, recursivObj, key) {
        var cont,
            ooo = recursivObj || {},
            model = auxObj.model,
            arrayKey,
            siEsArrayKey;
        
        for (var i in auxObj ) {
            if ( typeof auxObj[i] != 'object' && typeof auxObj[i] != 'function' && auxObj[i] != undefined && auxObj[i] != null) {
                arrayKey = key || 'data['+model+']'; 
                arrayKey = arrayKey+'['+i+']';
                ooo[arrayKey] = auxObj[i];
            }
            
            // si es Array
            if ( typeof auxObj[i] == 'object' && $.isArray(auxObj[i]) ) {
                cont = 0;
                siEsArrayKey = key || 'data';
                for (var scnd in auxObj[i]) {
                    this.__aplanarObj(auxObj[i][scnd], ooo, siEsArrayKey+'['+auxObj[i][scnd].model+']'+'['+cont+']');
                    cont++;
                }
            }
            
            // si es un objeto Model , o sea si tiene el atributo 'model''
            if ( typeof auxObj[i] == 'object' && auxObj[i] && auxObj[i].model ) {
                this.__aplanarObj(auxObj[i], ooo); 
            }
        }
        return ooo;
    },
    
    __processObj: function(obj, model){
        var auxObj = ko.toJS(obj);
        var aa = this.__aplanarObj(auxObj);
        return $.param( aa );
    }
    
}
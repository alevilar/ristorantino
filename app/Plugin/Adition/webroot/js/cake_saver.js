/*--------------------------------------------------------------------------------------------------- CakeSaver
 *
 *
 * Clase CakeSaver
 * 
 * Convierte objetos de javascript en algo que CakePhp pueda leer bajo el $this->request->data
 * o sea, convierte los objetos a un array para enviar via method POST en ajax
 * 
 * EL objeto debe tener un atributo (key denominada: "Model", con el nombre del modelo.
 * 
 * Objeto a enviar, ejemplo:
 * 
 * var product = {
 *      model: 'Producto',
 *      name: 'Zapatillas Nike',
 *      precio: 34.76
 *      observacion: 'una observacion re copada ...'
 * }
 * 
 * var objetoEnviar = {
 *      obj: product,
 *      method: 'post', // por defecto ya viene en post, puede ser get tambien. no es obligatorio ponerlo
 *      url: '/url/enviar' // es la url a donde se enviara el ajax
 * }
 * 
 * Envia un ajax post para que Cake pueda crear 
 *      $this->request->data['Producto']['name']
 *      $this->request->data['Producto']['precio']
 *      $this->request->data['Producto']['observacion']
 *      
 *      
 *      El objeto debe tener lso siguientes atributos o claves:
 *      'obj': Obligatorio, Objeto js a enviar
 *      'url': Obligatorio, es la url donde se enviara el ajax
 *      'method': puede ser get o post, es el method de envio ajax
 */
var $cakeSaver = {
    
    method: 'POST',
    
    /**
     * 
     * @param sendObje Objeto a mandar, debe tener como minimo:
     *  'url' => es la url donde se enviara el post
     *  'obj' => es el objeto que voy a enviar$cakeSaver
     *  'error' => function handler
     *  'if'    => es una funcion que devuelve un boolean, Si el boolean da false, entonces el envio se posterga hasta que sea "true"
     *  'ifDo'  => es una funcion que se ejecuta cuando devuelve true el IF y pasa como parametro el objeto aplanado para hacerle los cambios que sean 
     *  @param fn funcion callback a ejecutar onSuccess
     */
    send: function( sendObj , fn){
        var i = 0;
        var obj = sendObj['obj'];
        
        var url = sendObj['url'];
        var errorHandler = sendObj.error || function(){};
        var method = sendObj['method'] || this.method;       
        var obAplanado = this.__processObj(obj, obj.model); // objeto aplanado
        this.__doSend(url, obAplanado, method, errorHandler, fn, obj);
       
    },
    
    
    
    __doSend: function(url, ob, method, errorHandler, fn, obj){
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
                            if ( typeof obj.handleAjaxSuccess == 'function' ) {
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
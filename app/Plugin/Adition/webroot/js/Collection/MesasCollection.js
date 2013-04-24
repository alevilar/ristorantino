(function( window, undefined ) {

    // Namespace koModel
    var MesasCollection = Backbone.Collection.extend({
        
        url: 'mesas',
        
        model: R$.MesaModel,


        getMesas: function () {
            if ( Worker ) {  
                try{
                    _getWithWorker();
                } catch(e){
                    console.log(e);
                }                
            } else {
                throw "Web Workers no esta soportado";
            }
            return promise();
        }
    
    
    });

    R$.mesasCollection = new MesasCollection();
   
})(window);

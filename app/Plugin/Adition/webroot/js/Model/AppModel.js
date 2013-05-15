/**
 * Esta vista funciona como un manejador de vistas.
 * No se encuentra relacionada con la BBDD y no deberia ser utilizada para
 * guardar, modificar o traer objectos del servidor
 *
 */
R$.Model.App = Backbone.Model.extend({
        defaults: {
                /**
                 * Current Mesa
                 */
                mesa: null,


                /**
                 * Current Comanda por Fabricar
                 */
                comanda: null,
                
                
                categoria: null,
                
                producto: null,
                
                sabor: null
        }
    });
    
R$.app = new R$.Model.App;
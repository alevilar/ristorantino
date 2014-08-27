/**
 * 
 * Comanda Module
 * 
 */
App.module("appComanda", function(appComanda, App, Backbone, Marionette, $, _) {

    
    appComanda.Sabor = Backbone.RelationalModel.extend({});
    
    appComanda.Sabores = Backbone.Collection.extend({
        model: appComanda.Sabor
    });
    
    
    appComanda.DetalleSabor = Backbone.RelationalModel.extend({
        relation: [ {
                type: Backbone.HasOne,
                key: 'Sabor',
                relatedModel: appComanda.Sabor
		}
        ]
    });
    
     /**
     * DetalleComandas Collection
     */
    appComanda.DetalleSabores = Backbone.Collection.extend({
        model: appComanda.DetalleSabor
    });
    
    
    appComanda.GrupoSabor = Backbone.RelationalModel.extend({
        relations: [{
            type: Backbone.HasMany,
            key: 'Sabor',
            relatedModel: appComanda.Sabor,
            collectionType: appComanda.Sabores
        }]
    });
    
    
    
    appComanda.GrupoSabores = Backbone.Collection.extend({
        model: appComanda.GrupoSabor
    });


    /**
    * Producto Model
    */
   appComanda.Producto = Backbone.RelationalModel.extend({
       relations: [{
            type: Backbone.HasMany,
            key: 'GrupoSabor',
            relatedModel: appComanda.GrupoSabor,
            collectionType: appComanda.GrupoSabores
        }],
        tieneGrupoSabor: function () {
            var ret = false;
            if ( this.get('GrupoSabor') && this.get('GrupoSabor').length) {
                ret = this.get('GrupoSabor').length;
            }
            return ret;
        }
   });


   /**
    * Productos Collection
    */
   appComanda.Productos = Backbone.Collection.extend({
           model: appComanda.Producto
   });
   
   

    /**
     * DetalleComanda Model
     */
    appComanda.DetalleComanda =  Backbone.RelationalModel.extend({
        relations: [
		{ // Create a (recursive) one-to-one relationship
			type: Backbone.HasOne,
			key: 'Producto',
			relatedModel: appComanda.Producto
		},
                {
                    type: Backbone.HasMany,
                    key: 'DetalleSabor',
                    relatedModel: appComanda.DetalleSabor,
                    collectionType: appComanda.DetalleSabores
                }
	],
        url: function() {
            var url = 'detalle_comandas';
            if (!this.isNew()) {
                url += '/' + this.get('id');
            }
            return url;
        },
        defaults: {
            es_entrada: false,
            cant: 0,
            Producto: null,
            DetalleSabor: new appComanda.DetalleSabores,
        },
        initialize: function(data)
        {
            if (!data && !data.Producto) {
                throw new Error('Se debe pasar un Producto como parametro');
            }
        },
        addSabor: function ( sabor ) {
            var ds = new appComanda.DetalleSabor({
                Sabor: sabor
            });
            this.get('DetalleSabor').add( ds );
        },
        removeSabor: function ( sabor ) {
            var ds = this.get('DetalleSabor').where({Sabor: sabor});
            this.get('DetalleSabor').remove(ds);
        }

    });




    /**
     * DetalleComandas Collection
     */
    appComanda.DetalleComandas = Backbone.Collection.extend({
        url: 'detalle_comandas',
        model: appComanda.DetalleComanda        
    });


    /**
     * Comanda Model
     */
    appComanda.Comanda = Backbone.RelationalModel.extend({
        url: 'comandas',
        __productos: [],        
        relations: [{
                type: Backbone.HasMany,
                key: 'DetalleComanda',
                relatedModel: appComanda.DetalleComanda,
                collectionType: appComanda.DetalleComandas
        }
        ],
        addProducto: function(producto) {
            
            // agregar producto al detalleComanda
            var dc = new appComanda.DetalleComanda({
                Producto: producto,
                producto_id: producto.id,
                cant: 1
            });
            
            dc.get('DetalleSabor').reset();
            
            this.get('DetalleComanda').add(dc);
            
            console.debug( this.get('DetalleComanda') );
            
            return dc;
        }
    });
    
    
    appComanda.Comandas = Backbone.Collection.extend({
        url: 'comandas',
        model: appComanda.Comanda        
    });



    /**
     * ComandaLayout View
     * 
     * model: Comanda Model
     */
    appComanda.ComandaLayout = Marionette.Layout.extend({
        template: "#comanda-add",
        regions: {
            mesaLabelRegion: ".mesa-label",
            detalleComandaRegion: ".detalle_comanda",
            comandaRegion: ".comandas",
            productosRegion: "#productos-container",
            saboresRegion: "#sabores-container"
        },
        initialize: function () {
            this.listenTo(this.model, 'ready', this.storeComanda);
            
            var onDetalleComandaChange = function (dc){
               var detalleComandaView = new appComanda.DetalleComandaView({model: dc});
               this.detalleComandaRegion.show( detalleComandaView );
            }
            
            this.listenTo(this.model.get('DetalleComanda'), 'add', onDetalleComandaChange);
            this.listenTo(this.model.get('DetalleComanda'), 'change', onDetalleComandaChange);
        },
        onShow: function () {
            // definicion de variables
            var productosLayout = new App.appMenu.ProductosLayout,
                mesaLabel = new App.mesaApp.MesaLabelView( {model: this.model.get('Mesa')} ),
                comandaView = new appComanda.ComandaView({model: this.model})                
                ;
                
            this.productosRegion.show( productosLayout );
            this.mesaLabelRegion.show( mesaLabel );
            this.comandaRegion.show( comandaView );
            
            // crear nuevo DetalleComanda con el producto seleccionado
            this.listenTo(productosLayout, 'ProductosLayout:ProductoView:click', this.procesarProductoSeleccionado);
            
            this.listenTo(this.model, 'all', function(a){console.info(a)});
            
            this.listenTo(this.model, 'add:DetalleComanda ', this.procesarNuevoDetalleComanda);
        },
                
        procesarNuevoDetalleComanda: function ( detalleComanda ) {
            var p = detalleComanda.get('Producto');
             if ( p.tieneGrupoSabor() ) {
                // crear vista de Sabores
                var saboresView = new App.appMenu.GrupoSaboresView({
                    collection: p.get('GrupoSabor')
                });
                this.saboresRegion.show( saboresView );

                this.listenTo(saboresView, 'GrupoSabor:Sabor:checked', function(view, obj){
                    detalleComanda.addSabor(obj.model);
                });
                this.listenTo(saboresView, 'GrupoSabor:Sabor:unchecked', function(view, obj){
                    detalleComanda.removeSabor(obj.model);
                });                    

            } else {
                this.saboresRegion.close();
            }
        },
                
        /**
         * agregar el producto al detalleComanda de esta comanda
         * 
         * @param {type} productoView
         * @param {type} obj
         */        
        procesarProductoSeleccionado: function ( productoView, obj){
                this.model.addProducto( obj.model );
        },
                
        storeComanda: function () {
//             this.model.set('mesa_id', mesa.id);
//             mesa.get('Comanda').create(comanda);
            if (this.model.get('DetalleComanda').length ) {
                this.model.save();
            }
        }
                
    });
    


    /**
     * 
     */
    appComanda.DetalleComandaView = Marionette.ItemView.extend({
        template: "#detalle_comanda",
        events: {
            "click .up": "subirCant",
            "click .down": "bajarCant",
            "blur textarea#comanda-observacion": "agregarObservacion",
            "change input#comanda-es-entrada": "esEntradaToggle"
        },
        initialize: function () {
            this.$('textarea').val(this.model.get('observacion'));
            
            this.listenTo(this.model, 'change', this.render);
        },
        subirCant: function () {
            this.model.set('cant',this.model.get('cant')+1)
        },
        bajarCant: function () {
            this.model.set('cant',this.model.get('cant')-1)
        },
        agregarObservacion: function () {
            var obs = this.$('#comanda-observacion').val();
            if ( obs ) {
                this.model.set('observacion', obs);
            }
            return true;
        },
        esEntradaToggle: function (a) {
            this.model.set('es_entrada', a.target.checked);            
        }
    });



    /**
     * 
     */
    appComanda.ComandaView = Marionette.CompositeView.extend({
        template: "#comanda",
        events: {
            'click .ok': "mostrarOpciones",
            'dblclick .ok': "guardar",
        },
        itemView: Backbone.Marionette.View.extend({
            tagName: "li",
            initialize: function (a) {          
                var prodName = a.model.get('Producto').get('name');
                this.el.innerHTML = "<span class='cant badge'></span>"+prodName+" <span class='sabores'></span>";
                this.model.on('all', function(a){console.info(a)});
                this.listenTo(this.model, 'change', this.renderCant);
                this.listenTo(this.model, 'add:DetalleSabor remove:DetalleSabor', this.renderSabores);
            },           
            renderCant: function () {
                this.$('.cant').html( this.model.get('cant') );
            },
            renderSabores: function () {
                var ds = this.model.get('DetalleSabor');
                if ( ds.length ) {
                    var name = ds.reduce(function(memo, sab){
                        if ( memo ) {
                            memo += ", ";
                        }
                        return memo + sab.get('Sabor').get('name');
                    }, '');

                    name = "(" + name + ")";
                    this.$('.sabores').html( name );
                } else {
                    this.$('.sabores').html( '' );
                }
            },
            onShow: function () {
                this.renderCant();
                this.renderSabores();
            }
        }),
        itemViewContainer: "ul",
        initialize: function ( data ) {
            this.collection = data.model.get('DetalleComanda');
        },
        mostrarOpciones: function () {
            var $el = this.$('.ops');
            if ( $el.is(':visible') ) {
                this.guardar();
            }
            $el.toggleClass('hidden'); 
        },
        guardar: function () {
            this.model.trigger('ready');
            App.router.navigate("/", {trigger: true});
        }
    });
});
/**
 * Comanda Module
 */
App.module("appMenu", function (appMenu, App, Backbone, Marionette, $, _, appComanda) {
	
      
	
	/**
	 * Categoria Model
	 */
	appMenu.Categoria = Backbone.Model.extend({          
            initialize: function ( obj, padre ) {               
                if ( obj && obj.Categorias && obj.Categorias.length ) {                
                    this.set('Categorias', new appMenu.Categorias(obj.Categorias) );
                }
                if ( obj && obj.Producto ) {
                    this.set('Producto', new appComanda.Productos( _.toArray( obj.Producto ) ) );
                }
            }
        });
       
	
	/**
	 * Categorias Collection
	 */
	appMenu.Categorias = Backbone.Collection.extend({
		model: appMenu.Categoria
	});
        
        
	
	
        
        /**
         * 
	 */
	appMenu.CategoriasListView = Marionette.CollectionView.extend({	
            itemView: Marionette.View.extend({
                    tagName: "button",
                    triggers: {
                        click: "categoria:click"
                    },
                    id: function () {
                        return "btn-categoria-id-"+this.model.get("id");
                    },
                    attributes: {
                        "class": "btn"
                    },
                    initialize: function () {                        
                        this.el.innerHTML = this.model.get('name');
                    }
            })
        });
        
        
        
         appMenu.ProductoView = Marionette.View.extend({
		tagName: "button",
                triggers: {
                    click: "click"
                },
                id: function () {
                    return "btn-producto-id-"+this.model.get("id");
                },
                attributes: {
                    "class": "btn btn-success"
                }, 
                initialize: function () {
                    this.el.innerHTML = this.model.get('name');
                }
        });
        
        
        appMenu.ProductosLayout = Marionette.Layout.extend({
            template: '#tmp-productos',    
            itemViewEventPrefix: "ProductosLayout",
            
            modelEvents: {
                'change:Producto': 'renderProducto',
                'change:Categorias': 'renderCategoria'
            },
                    
            regions: {                
                categoriasPathRegion: "#categorias_path",
                categoriasRegion: "#listado_categorias",
                productosRegion: "#listado_productos",
                detalleProductoRegion: "#detalle_productos"
            },
                    
            renderCurrentCategoriaTitle: function ( name ) {
                if ( !name ) {
                    name = this.model.get('name');
                }
                this.$(".current_categoria_title").html( name );
            },
                     
            renderProducto: function () {
                // set productos
                this.productosView = new appMenu.ProductosView({
                    collection: this.model.get('Producto')
                });   
                this.productosRegion.show(this.productosView);
                
                this.listenTo(this.productosView, "all", function(name,a, b, c){
                    this.trigger(this.itemViewEventPrefix+":"+name, a, b, c);
                });
            },
                    
            renderCategoria: function () {
                // set categorias
                var cats = this.model.get('Categorias');
                if ( cats && cats.length ) {
                    this.categoriasListView = new appMenu.CategoriasListView({
                        collection: this.model.get('Categorias')
                    });  
                    this.listenTo( this.categoriasListView, 'itemview:categoria:click', this.__cambiarCategoria);
                    this.categoriasRegion.show( this.categoriasListView );
                }
            },
                    
            __cambiarCategoria: function ( view, data ) {
                var newCat = view.model;
                this.model.clear();
                this.model.set(newCat.attributes);
                this.renderCurrentCategoriaTitle();
            },
                    
            initialize: function (obj) {
                
                // store root for ROOT PATH
                this.model = new appMenu.Categoria( App.categoriasTree );
                
                this.categoriaPathView = new appMenu.CategoriasPathView({                   
                        model: new appMenu.Categoria( App.categoriasTree )
                });
                
                this.listenTo( this.categoriaPathView, 'categoria:click', this.__cambiarCategoria);
            },
                    
            onRender: function() {
                this.categoriasPathRegion.show( this.categoriaPathView );
                                                           
                this.renderCategoria();
                this.renderProducto();
                
                this.renderCurrentCategoriaTitle();
            }
        });
        
        /**
         * 
	 */
	appMenu.ProductosView = Marionette.CollectionView.extend({	
            itemViewEventPrefix: "ProductoView",
            itemView: appMenu.ProductoView            
        });
        
        
        appMenu.CategoriasPathView = Marionette.View.extend({
                tagName: "button",
                triggers: {
                    click: "categoria:click"
                },
                initialize: function(obj){
                   this.el.innerHTML = this.model.get('name');
                }
        });
        
        
        
        
    appMenu.SaboresRadioView = Marionette.CollectionView.extend({
        itemViewEventPrefix: "Sabor",
        itemView: Marionette.ItemView.extend({
                template: "#tmp-sabor-radio",
                triggers: {
                    'change input': 'checked'
                }
        })  ,
        initialize: function () {
            this.listenTo(this, 'Sabor:checked', this.__notificarTodosLosRadio);
        },
                
        /**
         * Como los input radio no envian evento al unchecked (mientras que los checkboxes si lo hacen)
         * entonces tengo que hacer esto para notificar los radio unchecked
         * 
         * @param SaborView grupsab
         * @param Mixed  saborObj es un objeto con 
         *                              {
         *                                  model:
         *                                  collection:
         *                                  view:
         *                              }
         */
        __notificarTodosLosRadio: function (grupsab, saborObj) {
            // recorrer vistas (cada ItemView)
            this.children.each( function( a ){
                // distintas al sabor seleccionado
                if (a != saborObj.view) {
                    // y que no esten checked, porque es un Radio. Entonces solo 1 deberia estar chequeado
                    if ( !a.$('input')[0].checked ) {
                        a.trigger('unchecked');
                    }
                }
            });
        }
    });
    
    appMenu.SaboresCheckboxView = Marionette.CollectionView.extend({    
        itemViewEventPrefix: "Sabor",
        itemView: Marionette.ItemView.extend({
            template: "#tmp-sabor-checkbox",
            events: {
                'change input': 'changeNotify'
            },
            changeNotify: function () {
                if ( this.$('input')[0].checked ) {
                    this.trigger('checked');
                } else {
                    this.trigger('unchecked');
                }
            }
        })
    });
    
    /**
     * 
     */
    appMenu.GrupoSaborView = Marionette.Layout.extend({
        tagName: 'fieldset',
        template: "#tmp-grupo-sabor",
        saboresView: null,
        regions: {
            saboresRegion: ".ops-sabores",
        },
        initialize: function () {
    
            if ( this.model.get('tipo_de_seleccion') == 0 ) {
                this.saboresView = new appMenu.SaboresCheckboxView({collection: this.model.get('Sabor')});
            } else {
                this.saboresView = new appMenu.SaboresRadioView({collection: this.model.get('Sabor')});
            }
            
            this.listenTo(this.saboresView, 'all', this.trigger);
        },
        onRender: function () {
            this.saboresRegion.show( this.saboresView );
        }
        
    });
    
    
     
    /**
     * 
     */
    appMenu.GrupoSaboresView = Marionette.CollectionView.extend({
        itemViewEventPrefix: "GrupoSabor",
        itemView: appMenu.GrupoSaborView
    });
        
    
   
        
        
		
},  App.module('appComanda'));
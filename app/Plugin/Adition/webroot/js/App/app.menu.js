/**
 * Comanda Module
 */
App.module("appMenu", function (appMenu, App, Backbone, Marionette, $, _) {
	
      
	
	/**
	 * Categoria Model
	 */
	appMenu.Categoria = Backbone.Model.extend({          
            initialize: function ( obj, padre ) {               
                if ( obj && obj.Categorias && obj.Categorias.length ) {                
                    this.set('Categorias', new appMenu.Categorias(obj.Categorias) );
                }
                if ( obj && obj.Producto ) {
                    this.set('Producto', new appMenu.Productos( _.toArray( obj.Producto ) ) );
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
	 * Producto Model
	 */
	appMenu.Producto = Backbone.Model.extend({
	});
	
	
	/**
	 * Productos Collection
	 */
	appMenu.Productos = Backbone.Collection.extend({
		model: appMenu.Producto
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
                        "class": "btn btn-primary"
                    },
                    initialize: function () {                        
                        this.el.innerHTML = this.model.get('name');
                    }
            })
        });
        
        
        
         appMenu.ProductoView = Marionette.View.extend({
		tagName: "button",
                triggers: {
                    click: "producto:click"
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
                     
            renderProducto: function () {
                
                // set productos
                this.productosView = new appMenu.ProductosView({
                    collection: this.model.get('Producto')
                });   
                this.productosRegion.show(this.productosView);
                
                this.listenTo(this.productosView, "itemview:producto:click", function(a){
                    appMenu.trigger("producto:click", a.model);
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
            },
                    
            initialize: function (obj) {
                this.model =  new appMenu.Categoria( App.categoriasTree );
                
                // store root for ROOT PATH
                this.categoriaRoot = new appMenu.Categoria( App.categoriasTree );
                
                
                this.categoriaPathView = new appMenu.CategoriasPathView({                   
                        model: this.categoriaRoot
                });
                this.listenTo( this.categoriaPathView, 'categoria:click', this.__cambiarCategoria);
                
               
              
            },
                    
            onRender: function() {
                this.categoriasPathRegion.show( this.categoriaPathView );
                              
                this.renderCategoria();
                this.renderProducto();
            }
        });
        
        /**
         * 
	 */
	appMenu.ProductosView = Marionette.CollectionView.extend({	
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
        
        
        
		
});
/**
 * Comanda Module
 */
App.module("comandaApp", function (comandaApp, App, Backbone, Marionette, $, _) {
	 
	
	/**
	 * Categoria Model
	 */
	var Categoria = Backbone.Model.extend({});
	
	
	/**
	 * Categorias Collection
	 */
	var Categorias = Backbone.Collection.extend({
		model: Categoria
	});
	var categorias = new Categorias();
	
	/**
	 * Producto Model
	 */
	var Producto = Backbone.Model.extend({
	});
	
	
	/**
	 * Productos Collection
	 */
	var Productos = Backbone.Collection.extend({
		model: Producto
	});
	
	
	
	/**
	 * Sabor Model
	 */
	var Sabor = Backbone.Model.extend({
	});
	
	
	/**
	 * Sabores Collection
	 */
	var Sabores = Backbone.Collection.extend({
		model: Sabor
	});
	
	
	/**
	 * DetalleComanda Model
	 */
	var DetalleComanda = Backbone.Model.extend({
		defaults: {
			cant: 0			
		},
		Producto: null,
		DetalleSabor: [],
		initialize: function ( data )
		{
			if ( !data.hasOwnProperty('Producto') ) {
				throw new Error('Se debe pasar un Producto como parametro');
			}
		}
		
	});
	
	
	/**
	 * DetalleComandas Collection
	 */
	var DetalleComandas = Backbone.Collection.extend({
		model: DetalleComanda
	});
	
	
	/**
	 * Comanda Model
	 */
	var Comanda = Backbone.Model.extend({
		url: 'comandas',
		
		initialize: function ( data )
		{
			if ( !data.hasOwnProperty('Mesa') ) {
				throw new Error('Se debe pasar una Mesa como parametro');
			}
			this.set('mesa_id', data.Mesa.get('id'));
		}
	});
	
	
	
	/**
	 * ComandaLayout View
	 */
	var ComandaLayout = Marionette.Layout.extend({
	  template: "#comanda-add",
	
	  regions: {
	    categoriasRegion: "#listado_categorias",
	    productosRegion: "#listado_productos",
	    detalleProductoRegion: "#detalle_productos"
	  }
	});
	
	
	/**
	 * Categoria View
	 */
	var CategoriasTreeView = Marionette.ItemView.extend({
		template: "#categorias-tree",
		
		lastChanged: null,
		
		triggers: {
			'change input': 'categoria:select'
		},
		
		events: {
			'change input': 'cambioCategoria',
		},
		
		onClose: function () {
			this.$('input').attr('checked', false);
		},
		
		cambioCategoria: function(a) {
			papa = a.target;
			console.info("el valor: %f y el objeto es %o y el valor del checked", a.target.value, a.target, a.target.checked);
		}
		
	});


	/**
	 * Controller	
	 */
	var Controller = Marionette.Controller.extend({
		tagName: 'ul',
		className: 'tree',
		
		// Add Comanda View
		add: function ( mesa ) {
			var comandaLayout = new ComandaLayout({model: mesa});
			
			var categoriasView = new CategoriasTreeView({});
			
			App.contentRegion.show( comandaLayout ) ;
			comandaLayout.categoriasRegion.show( categoriasView );
			
			return comandaLayout;
		}
	});
	var controller = new Controller;
	
	
	
	/**
	 * Define Function to Load Categorias Collection
	 */
	function loadCategorias ( categoriasTree ) {
		if ( _.isArray(categoriasTree) ) {
			categorias = new Categorias(categoriasTree);
		} else if ( _.isObject(categoriasTree) ) {
			categorias = new Categorias([categoriasTree]);
		} else {
			throw Error('Se debe pasar un array o un objeto como parámetro');
		}
		
		return categorias;
	}
	
	
	/**
	 * 
	 * Set Public Methods
	 * @return View
	 */
	comandaApp.hacerComandaParaMesa = function ( mesa ) {
		return controller.add( mesa );
	}
	
	
	comandaApp.categorias = function () {
		return categorias;
	}
	
	
	comandaApp.onStart = function () {
		// call funcion to load categorias with App´s categorias
		var cats = loadCategorias( App.categoriasTree );
		console.debug("estas son las CATS %o", cats);
	}
});
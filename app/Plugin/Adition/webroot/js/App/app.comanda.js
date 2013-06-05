/**
 * Comanda Module
 */
//App.module("Comanda", function (comanda, App, Backbone, Marionette, $, _) {
	
	// load Categorias
	var categorias = [];
	if ( _.isObject(App.categoriasTree) ) {
		categorias = [App.categoriasTree];
	} else if ( _.isArray(App.categoriasTree) ) {
		categorias = App.categoriasTree;
	}
	
	
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
	
	var comandaLayout = new ComandaLayout();
	
	
	/**
	 * 
	 * Set Public Methods
	 * 
	 */
	this.hacerComandaParaMesa = function (mesa) {
		comandaLayout.render();
		var defComanda = jQuery.Deferred();
		
		// gives resolve(new Comanda)
		return defComanda.promise;
	}
	
	prod1 = new Producto({id:1, name:"bananas"});
	prod2 = new Producto({id:1, name:"bananas"});
	prod3 = new Producto({id:3, name:"manzanas"});
	dv1 = new DetalleComanda({Producto: prod1, DetalleSabor:[{id:3,name:"dulce"}]});
	dv2 = new DetalleComanda({Producto: prod2});
	dv22 = new DetalleComanda({Producto: prod2});
	dv3 = new DetalleComanda({Producto:prod3});
	dv1.set('cant',dv1.get('cant'+1));
	dv2.set('cant',dv2.get('cant'+1));
	dcs = new DetalleComandas();
	ccc = new Comanda({DetalleComanda: dcs});
//});
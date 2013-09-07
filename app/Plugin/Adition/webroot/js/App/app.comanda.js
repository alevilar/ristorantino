/**
 * 
 * Comanda Module
 * 
 */
App.module("appComanda", function (appComanda, App, Backbone, Marionette, $, _) {
	      
	
	
	/**
	 * DetalleComanda Model
	 */
	appComanda.DetalleComanda = Backbone.Model.extend({
                url: function() {
                    var url = 'detalle_comandas';
                    if (!this.isNew()) {
                        url += '/' + this.get('id');
                    }
                    return url;
                },
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
	appComanda.DetalleComandas = Backbone.Collection.extend({
                url: 'detalle_comandas',
		model: appComanda.DetalleComanda
	});
	
	
	/**
	 * Comanda Model
	 */
	appComanda.Comanda = Backbone.Model.extend({
		url: 'comandas',
		
		initialize: function ( data )
		{
			if ( !data.hasOwnProperty('Mesa') ) {
				throw new Error('Se debe pasar una Mesa como parametro');
			}
			this.set('mesa_id', data.Mesa.get('id'));
		},
                relations: [{
                    type: Backbone.HasMany,
                    key: 'detalle_comanda',
                    relatedModel: appComanda.DetalleComanda,
                    collectionType: appComanda.DetalleComandas,
                    reverseRelation: {
                        key: 'comanda',
                        includeInJSON: 'id'
                    }
                }]
	});
	
	
	
	/**
	 * ComandaLayout View
	 */
	appComanda.ComandaLayout = Marionette.Layout.extend({
	  template: "#comanda-add",
	
	  regions: {
                mesaLabelRegion: ".mesa-label",
                detalleComandaRegion: ".detalle_comanda",
                comandaRegion: ".comandas",
                productosRegion: "#productos-container"
	  }
	});
                


        /**
         * 
	 */
	appComanda.DetalleComandaView = Marionette.ItemView.extend({
		template: "#detalle_comanda"
        });

            
        /**
         * 
	 */
	appComanda.ComandaView = Marionette.ItemView.extend({
		template: "#comanda"
        });
        
	
        
});
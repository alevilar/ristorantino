
// Start Marionette Ristorantino App
(function(App, mesaApp, appComanda, appMenu){
    
    
        var Controller = Marionette.Controller.extend({
            
            /**
             *  Getter and Setter of _currentCategoria
             *  @param {type} newCategoria
             *  @returns {unresolved}
             */
            categoria: function( newCategoria ) {
                if ( newCategoria ) {                          
                      var oldCat = this._currentCategoria; 
                      this._currentCategoria = newCategoria;
                      this.trigger("categoria:change", newCategoria, oldCat);
                }
                return this._currentCategoria;
            },
                
            view: function(mozoId, mesaCid) {

                var mesa = mesaApp.getMozoMesa(mozoId, mesaCid),
                    actionsView = new mesaApp.MesaActionsView({model: mesa}),
                    comandasView = new mesaApp.MesaComandasView({model: mesa}),
                    mesaView = App.mesaViewLayout(mesa);

                App.body.show( mesaView );
                mesaView.actions.show( actionsView );
                mesaView.content.show( comandasView );
            },
                    
                    
            index: function() {
                var mesaAppLayout = new mesaApp.MesaAppMainLayout();
                App.body.show(mesaAppLayout);
                var mozosView = new mesaApp.MozosView({collection: mesaApp.mozos});
                mesaAppLayout.body.show(mozosView);
            },
                    
                    
            // Add Comanda View
            comandaAdd: function ( mozoId, mesaCid ) {
                    
                    var comandaLayout = new appComanda.ComandaLayout,
                        productosLayout = new appMenu.ProductosLayout,
                        mesa = mesaApp.getMozoMesa( mozoId, mesaCid ),
                        mesaLabel = new mesaApp.MesaLabelView( {model: mesa} ),
                        detalleComandaView = new appComanda.DetalleComandaView,
                        comandaView = new appComanda.ComandaView;
                    
                    App.body.show(comandaLayout);
                    comandaLayout.productosRegion.show( productosLayout );
                    comandaLayout.mesaLabelRegion.show( mesaLabel );
                    comandaLayout.detalleComandaRegion.show( detalleComandaView );
                    comandaLayout.comandaRegion.show( comandaView );
                    
                    
                    appMenu.on("all", function(a, b){
                        console.info("iasjas %o y %o", a, b);
                    });
                    
		}
        });

        var Router = Backbone.Marionette.AppRouter.extend({
            controller: new Controller,
            appRoutes: {
                "": "index",
                "mesa/view/:mid/:cid": "view",
                "comanda/add/:mozo/:mesa": "comandaAdd"
            }
        });

       
	// run on DOM Loaded
        App.start();
        new Router;
        
       
        mesaApp.mozos.reset(App.mozos);
        
        Backbone.history.start();
        //mesaApp.router.navigate("mesa/index", {trigger: true});
	
	
	mesaApp.on('all', function(a){
		console.log("mesaApp: %o", a);
	});
        
	App.on('all', function(a) {
		console.log("APP: %o", a);
	});
	
	
	
})(App, App.module('mesaApp'), App.module('appComanda'), App.module('appMenu') );





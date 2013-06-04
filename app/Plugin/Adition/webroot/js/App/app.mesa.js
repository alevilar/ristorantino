/**
 * 
 *  mesaApp Module
 * 
 */

App.module("mesaApp", function () {
		var mesaApp = this;
		
		
		/**
		 *  Mesa Model
		 */
		var Mesa = Backbone.RelationalModel.extend({
	        defaults: {
	                estado_id: 1,
	                cliente_abr: '"B"',
	                time_abrio_abr: "-",
	                time_cerro_abr: "-"
	        }
	    });
	
	
		/**
		 * Mozo Model
		 */
		var Mozo = Backbone.RelationalModel.extend({
			relations: [{
				type: Backbone.HasMany,
				key: 'mesas',
				relatedModel: Mesa,
				collectionType: Mesas,
				reverseRelation: {
					key: 'mozo',
					includeInJSON: 'id'
					// 'relatedModel' is automatically set to 'Zoo'; the 'relationType' to 'HasOne'.
				}
			}]
		    
		});
	
	
		/**
		 * Mesas Collection
		 */
		var Mesas = Backbone.Collection.extend({
		        
		    url: 'mesas',
		        
		    model: Mesa,
		        
		    parse: function ( a )
		    {
		        return a.mesas;
		    },
		        
		    comparator: function ( a )
		    {
		        return -a.id;
		    },
		        
		    // Filter down the list of all todo items that are finished.
		    deMozo: function ( mozo_id )
		    {
		        return this.where({
		            mozo_id: mozo_id
		        });
		    },
		    
		    findMesaById: function ( mesaId )
		    {
		        return this.find(function(m){
		            return m.id == mesaId;
		        })
		    }
		});
	
	
	
		/**
		 * Mpzos Collection
		 */
		var Mozos = Backbone.Collection.extend({
		        
		    url: 'mozos',
		        
		    model: Mozo,
		});
		
		
		/**
		 * Mesa View
		 */
		var MesaView = Backbone.Marionette.ItemView.extend({
		
		    template: '#mesa-view',
		    
		    tagName:  "article",
		    
		    triggers: {
		    	"click": 'mesa:select'
		  	},
		    
		    modelEvents:{
		        'change:estado_id'  :   'cambiarEstado',
		        'change:mozo_id'    :   'cambiarMozo',
		        'change:numero'     :   'cambiarNumero',
		        'change:time_cerro' :   'cambiarTimeCerro',
		        'change:Cliente'    :   'render',
		        'remove destroy'    :   'remove',
		    },
		    
		 
		    id: function(){
		        return "listado-mesa-id-"+this.model.id;  
		    },
		    
		    //    el: ,
		    className:  function ()
		    {
		        var estado = this.model.get('estado_id'),
		        mozo   = this.model.get('mozo_id')
		        
		        return "mesa estado_"+estado+" mozo_"+mozo;
		    },
		    
		    cambiarTimeCerro: function(){
		        var time = this.model.get('time_cerro_abr');
		        this.$('.mesa-time-cerro').text(time);
		    },
		    
		    cambiarMozo: function(){
		        this.changeContainer();
		    },
		    
		    cambiarNumero: function(){
		        this.$('.mesa-numero').text( this.model.get('numero') );
		    },
		    
		    cambiarEstado: function(){
		        var $a = this.$('a');
		        var pEid = this.model.previous('estado_id');
		        if (pEid) {
		            $a.removeClass(this.jqmThemeByEstado(  ));
		        }
		        
		        $a.attr('data-theme', App._jqmThemeMap[this.model.get('estado_id')]);
		        
		        $a.addClass(this.jqmThemeByEstado());
		    } 
		});
		
		
		/** 
		 * Mozo View
		 */
		var MozoView = Backbone.Marionette.CompositeView.extend({
			
			template: '#mozo-view',
			className: 'mozo-column',
			
			// este no funciona ACA. no se porque. Por ese motivo esta inicializado en el metodo initialize:
			itemView: MesaView,
			
		    itemViewContainer: '.mesas-list',
		  
		    triggers: {
		    	"click button.mozo": 'mozo:select'
		  	},
		   
		    initialize: function(e){
		    	var mesas = this.model.get('mesas');
		    	if (mesas) {
		    		this.collection = mesas;
		    	}
		    	
		    	// sets width porporcionaly
		    	var width = 100/mozosMesas.length;
		    	this.el.style.width = width+"%";
		    }
		});
		
		
		/**
		 * Mozos View
		 */		
		var MozosView = Backbone.Marionette.CollectionView.extend({
			itemView: MozoView,
		});
		
		
		/**
		 * MesaForm View
		 */
		var MesaFormView = Backbone.Marionette.ItemView.extend({
			
			template: '#mesa-add',
			
		  	triggers: {
		  		"submit form": 'submit'
		  	}
		});
		
		
		/**
		 * MesaExtra View
		 */
		var MesaExtraView = Marionette.ItemView.extend({
		
		    template: "#mesa-extra-view",		   
		    
		    events: {
		        "click #btn-mesa-cerrar"    :   "mandarAjaxYVolverAListadoDeMesas",
		        "click #btn-mesa-reabrir"   :   "mandarAjaxYVolverAListadoDeMesas",
		        "click #btn-mesa-ticket"    :   "mandarAjaxYVolverAListadoDeMesas",
		        "click #btn-mesa-borrar"    :   "eliminarMesa",
		        "click #btn-mesa-numero"    :   "cambiarNumero",
		        "click #btn-mesa-menu"      :   "cambiarMenu",
		        "click #btn-mesa-cubiertos" :   "cambiarCubiertos",
		        "click #btn-mesa-mozo"      :   "cambiarMozo"
		    },
		    
		    modelEvents: {
		        'change:numero'             :   'renderHeader',
		        'change:Mozo'               :   'renderMozo',
		        'change:estado_id'          :   'renderEstado',
		        'change:id'                 :   'render',
		        'change:cliente_id'         :   'renderCliente',
		        'change:Cliente'            :   'renderCliente',
		        'change:Descuento'          :   'renderDescuento',
		        'change:menu'               :   'renderMenu',
		        'change:cant_comensales'    :   'renderCubiertos'
		    },
		
		    eliminarMesa: function(){
		        this.model.destroy();
		        return this;
		    },
		    
		    cambiarMenu: function(){
		        var oldNum = this.model.get('menu');
		        var num = window.prompt("Cantidad MENU", oldNum);
		        if ( num && oldNum != num) {
		            this.model.save({
		                'menu': num
		            });
		        }
		        return this;
		    },
		    
		    
		    cambiarCubiertos: function(){
		        var oldNum = this.model.get('cant_comensales');
		        var num = window.prompt("Cantidad de Cubiertos", oldNum);
		        if ( num && oldNum != num) {
		            this.model.save({
		                'cant_comensales': num
		            });
		        }
		        return this;
		    },
		        
		    cambiarNumero: function(){
		        var oldNum = this.model.get('numero');
		        var num = window.prompt("Numero de mesa", oldNum);
		        if ( num && oldNum != num) {
		            this.model.save({
		                'numero': num
		            });
		        }
		        return this;
		    },
		    
		    mandarAjaxYVolverAListadoDeMesas: function(e){        
		        var href = e.currentTarget.getAttribute('href');
		        href += "/"+this.model.id;
		        
		        if (href) {
		            $.getJSON( href );
		        }
		        $.mobile.changePage("#listado-mesas");
		        return false;
		    },
		        
		    renderMozo: function(e) {
		        var mozo = this.model.get('Mozo');
		        if (mozo) {
		            this.$(".mozo-numero").text( mozo.numero );
		        }
		        return this;
		    },
		    
		    renderNumMesa: function(e) {       
		        this.$(".mesa-numero").text( this.model.get('numero'));
		        return this;
		    },
		    
		    renderEstadoMesa: function(e) {       
		        this.$(".mesa-estado").text( this.model.get('estado_name'));
		        return this;
		    },
		        
		    renderHeader: function(e){        
		        this.renderMozo()
		            .renderNumMesa()
		            .renderEstadoMesa();
		            
		        this.$("header").removeClass(this.className);
		        return this;
		    },
		    
		    _estadoAnt: null,
		        
		    renderEstado: function(){
		        if ( this._estadoAnt ) {
		            this.$el.removeClass( 'estado_'+this._estadoAnt );
		        }
		        this._estadoAnt = this.model.get('estado_id');
		        this.$el.addClass( 'estado_'+this._estadoAnt );
		        return this;
		    },
		    
		    
		    renderFooter: function(e){
		        var times = this.model.get('time_abrio_abr') + " " +this.model.get('time_cerro_abr') +" "+this.model.get('time_cobro_abr');
		        this.$("footer .hora-abrio").text( times );
		        this.$("footer .mesa-total").text(  this.model.get('importe_abr') );
		        
		        return this;
		    },
		    
		    renderMenu: function(){
		        var cc = this.model.get('menu');
		        if ( cc ) {
		            $('.ui-btn-text','#btn-mesa-menu').text( cc );
		        } else {
		            $('.ui-btn-text','#btn-mesa-menu').text( "Menú" );
		        }
		        return this;
		    },
		    
		    
		    renderDescuento: function() {
		        var cc = this.model.get('Descuento');
		        if ( cc && cc.id ) {
		            $('.ui-btn-text','#btn-mesa-descuento').text( cc.name );
		        } else {
		            $('.ui-btn-text','#btn-mesa-descuento').text( "Descuento" );
		        }
		        return this;
		    },
		    
		    renderCliente: function() {
		        var cc = this.model.get('Cliente');
		        if ( cc && cc.id ) {
		            this.$('#btn-mesa-clientes').text( cc.nombre );
		        } else {
		            this.$('#btn-mesa-clientes').text( "Cliente" );
		        }
		        return this;
		    },
		    
		    renderCubiertos: function() {
		        var cc = this.model.get('cant_comensales');
		        if ( cc ) {
		            this.$('#btn-mesa-cubiertos').text( cc );
		        } else {
		            this.$('#btn-mesa-cubiertos').text( "Cubiertos" );
		        }
		        return this;
		    },
		    
		    renderId: function(){
		        if (this.model.isNew()){
		            this.$('footer .mesa_id').html( this.tmp_loader() );
		        } else {
		            this.$('footer .mesa_id').text(this.model.get('id'));
		        }
		        return this;
		    },
		    
		    cambiarMozo: function() {
		        var $form;
		        
		        function offAll() {
		            $form.off('submit');
		            $form.off('change', 'input');
		        }
		
		        var self = this;
		        $(document).on('pageshow', '#mesa-cambiar-mozo', function(){       
		            $form = $("#form-cambiar-mozo");
		            $form.find('input').prop('checked', false);
		            
		            $('#radio-mozo-cambiar-id-'+self.model.get('mozo_id')).prop('checked', true);
		            $form.trigger('create');
		            
		            $form.on('submit', function(e){
		                e.preventDefault();
		            });
		        
		            $form.on('change', 'input', function(){
		                self.model.save({
		                    mozo_id: this.value
		                }, {
		                    success: function(e,data) {
		                        e.set('Mozo', data.mesa.Mozo);
		                    }
		                });
		                $('.ui-dialog').dialog('close');
		            });
		        });
		        
		        
		        $(document).on('pagehide', '#mesa-cambiar-mozo', function(){
		            offAll();
		        });
		    }	   
		   
		});	
		
		
		/**
		 * mesaApp Controller
		 * 
		 * controlls how views are rendered
		 * bassicaly, sets models and controll in views tnat needs some controll flown
		 */		
		var MesaController = Marionette.Controller.extend({
						
			mesaFormView: function (view , e)
			{
				var mozoModel = view.model,
					mesaFormView = new MesaFormView({model: mozoModel});
					
				mesaFormView.once('submit', function( data ) {
					var mesaObj = App.formToObject( data.view.$('form') );
					App.dialog.close(mesaFormView);
					mozoModel.get('mesas').create(mesaObj);	
				});
				App.dialog.show(mesaFormView);
			},
						
			mesaExtraView: function (view , e)
			{
	    		// instanciar nueva vista
	    		// @TODO store each mesa view in cache
	    		var extraView = new MesaExtraView({model: view.model});
	    			
				App.bigDialog.show(extraView);
			},
			
			/**
			 * calls the function by name
			 */
			show: function ( mesaViewName )
			{
				if ( _.isFunction(this[mesaViewName]) ){
					this[mesaViewName].call(arguments[1], arguments[2]);	
				} else {
					throw new Error("View '" + mesaViewName + "' is not a function in this controller");
				}
				
			}
		});
		
		
		
		/**
		 * 
		 * ----------------------------------------------------------------------
		 *  STARTS Module obects
		 */
		// instanciates controller
		var controller = new MesaController;
		
		// load data
		var mozosMesas = new Mozos;
		
		// create main views
		var mozosView = new MozosView( {collection: mozosMesas} );
		
		// Load Mesas
		mozosMesas.fetch().success( function () {
			App.contentRegion.show(mozosView);
		});
		
		this.onStart = function () {
			mozosView.on('itemview:mozo:select', function( e , view ) {
				controller.show('mesaFormView', e , view);
			});	
				
			mozosView.on('itemview:itemview:mesa:select', function( e , view ) {
				controller.show('mesaExtraView', e , view);
			});			
		}

	});


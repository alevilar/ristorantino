(function(mesaApp){
	mesaApp.View = Backbone.Marionette.ItemView.extend({
	
	    template: "#mesa-view",
	    
	    
	    estadoClass: 'estado_1', // por default la mesa esta abierta
	    
	    jqmThemeMap: {
	        'estado_1': 'ui-bar-a',
	        'estado_2': 'ui-bar-f'
	    },
	    
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
})(App.mesaApp);

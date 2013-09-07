/*--------------------------------------------------------------------------------------------------- Risto
 *
 * Ristorantino App
 * 
 * Aplicacion que maneja la Adicion del Ristorantino Mágico
 * 
 */
App = (function(Backbone, Marionette) {


    var DialogRegion = Marionette.Region.extend({
        onClose: function()
        {
            if (this.$el && this.$el.length) {
                this.$el.modal('hide');
            }
            this.reset();
        },
        onShow: function()
        {
            var self = this;
            this.$el.on('shown', function(e) {
                self.trigger('modal:shown', e);
            });
            this.$el.on('hidden', function(e) {
                self.trigger('modal:hidden', e);
                self.reset();
            });

            this.$el.modal('show');
        }
    });


    /**
     * Layout for Mesa
     */
    var MesaViewLayout = Marionette.Layout.extend({
        template: "#mesa-layout-view",
        regions: {
            header: "header",
            actions: ".actions",
            body: ".body",
            content: ".content"
        },
        events: {
            "click button.mozo": "cambiarMozo",
            "click .select-mozo": "doChangeMozo"
        },
        modelEvents: {
            'change:numero': 'renderHeader',
            'change:Mozo': 'renderMozo',
            'change:estado_id': 'renderEstado',
            'change:id': 'render',            
            'change:cant_comensales': 'renderCubiertos'
        },
        //    el: ,
        className: function()
        {
            var estado = this.model.get('estado_id'),
                    mozo = this.model.get('mozo_id');
            return "mesa estado_" + estado + " mozo_" + mozo;
        },
        doChangeMozo: function(e) {
            $("#seleccionar-mozo").hide('slideUp');
            var newId = e.target.value;
            this.model.save('mozo_id', newId);
        },
        renderMozo: function(e) {
            var mozo = this.model.get('Mozo');
            if (mozo) {
                this.$(".mozo-numero").text(mozo.numero);
            }
            return this;
        },
        renderNumMesa: function(e) {
            this.$(".mesa-numero").text(this.model.get('numero'));
            return this;
        },
        renderEstadoMesa: function(e) {
            this.$(".mesa-estado").text(this.model.get('estado_name'));
            return this;
        },
        renderHeader: function(e) {
            this.renderMozo()
                    .renderNumMesa()
                    .renderEstadoMesa();

            this.$("header").removeClass(this.className);
            return this;
        },
        renderEstado: function() {
            this.$el.removeClass();
            this.$el.addClass(this.className());
            this.renderEstadoMesa();
            return this;
        },
        renderFooter: function(e) {
            var times = this.model.get('time_abrio_abr') + " " + this.model.get('time_cerro_abr') + " " + this.model.get('time_cobro_abr');
            this.$("footer .hora-abrio").text(times);
            this.$("footer .mesa-total").text(this.model.get('importe_abr'));

            return this;
        },
        renderCubiertos: function() {
            var cc = this.model.get('cant_comensales');
            if (cc) {
                this.$('#btn-mesa-cubiertos').text(cc);
            } else {
                this.$('#btn-mesa-cubiertos').text("Cubiertos");
            }
            return this;
        },
        renderId: function() {
            if (this.model.isNew()) {
                this.$('footer .mesa_id').html(this.tmp_loader());
            } else {
                this.$('footer .mesa_id').text(this.model.get('id'));
            }
            return this;
        },
        cambiarMozo: function() {
            $("#seleccionar-mozo").toggle('slideUp');
        }

    });
    
    
    
    var mesaViewLayout;


    var App = new Marionette.Application({
        regions: {
            body: '#body-container',
            dialog: {
                regionType: DialogRegion,
                selector: '#dialog'
            },
            bigDialog: {
                regionType: DialogRegion,
                selector: '#big-dialog'
            }
        },
        mesaViewLayout: function( model ) {
            if (!mesaViewLayout && !model){
                throwError("Se debe pasar un modelo como parámetro", "ModelMissing");
            }
            if ( model && !mesaViewLayout ) {                
                mesaViewLayout = new MesaViewLayout({model: model})                
            } else {
                mesaViewLayout.model;
            }
            return mesaViewLayout;
        },
        formToObject: function($form)
        {
            var rta = $form.serializeArray(),
                    newObj = {}; // json modelo, para crear la mesa
            for (var r in rta) {
                newObj[rta[r].name] = rta[r].value;
            }
            return newObj;
        },
        findProductoByname: function(nombre)
        {
            var nomRegex = new RegExp(nombre, 'i'); // i = case insensitive
            return _.filter(this.productos, function(p) {
                return  p.name.match(nomRegex) || p.abrev.match(nomRegex);
            });
        },
        observer: function(eventName, initialValue)
        {
            var _latestValue = initialValue;
            function observable() {
                if (arguments.length > 0) {
                    // Write
                    App.trigger(eventName, arguments[0]);
                    if (arguments[0].hasOwnProperty('id')) {
                        App.trigger(eventName + 'id:' + arguments[0].id, arguments[0]);
                    }
                    // Ignore writes if the value hasn't changed
                    _latestValue = arguments[0];
                    return this; // Permits chained assignments
                }
                else {
                    // Read
                    return _latestValue;
                }
            }
            return observable;
        },
        addCss: function(cssCode)
        {
            var styleElement = document.createElement("style");
            styleElement.type = "text/css";
            if (styleElement.styleSheet) {
                styleElement.styleSheet.cssText = cssCode;
            } else {
                styleElement.appendChild(document.createTextNode(cssCode));
            }
            document.getElementsByTagName("head")[0].appendChild(styleElement);
        },
        onInitializeAfter: function() {
            App.addRegions(this.regions);            
        }

    });

    return App;

})(Backbone, Backbone.Marionette);




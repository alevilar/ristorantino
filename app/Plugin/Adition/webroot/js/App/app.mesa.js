/**
 * mesaApp Module
 * @param string Module name param1
 * @param function module initializacion
 */
App.module("mesaApp", function(mesaApp, App, Backbone, Marionette, $, _) {

    /**
     *  Mesa Model
     */
    mesaApp.Mesa = Backbone.RelationalModel.extend({
        url: function() {
            var url = 'mesas';
            if (!this.isNew()) {
                url += '/' + this.get('id');
            }
            return url;
        },
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
    mesaApp.Mozo = Backbone.RelationalModel.extend({
        url: function() {
            var url = 'mozos';
            if (!this.isNew()) {
                url += '/' + this.get('id');
            }
            return url;
        },
        relations: [{
                type: Backbone.HasMany,
                key: 'mesas',
                relatedModel: mesaApp.Mesa,
                collectionType: mesaApp.Mesas,
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
    mesaApp.Mesas = Backbone.Collection.extend({
        url: 'mesas',
        model: mesaApp.Mesa,
        parse: function(a)
        {
            return a.mesas;
        },
        comparator: function(a)
        {
            return -a.id;
        },
        // Filter down the list of all todo items that are finished.
        deMozo: function(mozo_id)
        {
            return this.where({
                mozo_id: mozo_id
            });
        }
    });



    /**
     * Mpzos Collection
     */
    mesaApp.Mozos = Backbone.Collection.extend({
        url: 'mozos',
        model: mesaApp.Mozo
    });


    /**
     * Mesa View
     */
    mesaApp.MesaView = Backbone.Marionette.ItemView.extend({
        template: '#mesa-view',
        tagName: "a",
        attributes: function() {
            var id = this.model.cid;
            if ( !this.model.isNew()) {
                id = this.model.id;
            }
            return {
                href: '#mesa/view/' + this.model.get('mozo_id') + "/" + id
            }
        },
        modelEvents: {
            'change:estado_id': 'cambiarEstado',
            'change:numero': 'cambiarNumero',
            'change:time_cerro': 'cambiarTimeCerro',
            'change:Cliente': 'render',
            'remove destroy': 'remove'
        },
        id: function() {
            return "listado-mesa-id-" + this.model.id;
        },
        //    el: ,
        className: function()
        {
            var estado = this.model.get('estado_id'),
                    mozo = this.model.get('mozo_id')
            return "mesa estado_" + estado + " mozo_" + mozo;
        },
        cambiarTimeCerro: function() {
            var time = this.model.get('time_cerro_abr');
            this.$('.mesa-time-cerro').text(time);
        },
        cambiarNumero: function() {
            this.$('.mesa-numero').text(this.model.get('numero'));
        },
        cambiarEstado: function() {
            this.$el.removeClass();
            this.$el.addClass(this.className());
        }
    });


    /**
     *  main Layout it´s a kind of body page wrapper where is going to be all the modules´s views
     */
    mesaApp.MesaAppMainLayout = Marionette.Layout.extend({
        template: "#mesa-list-layout",
        regions: {
            nav: "header nav",
            //body: ".body"
            body: "#listado-mesas-body"
        }
    });



    /** 
     * Mozo View
     */
    mesaApp.MozoView = Backbone.Marionette.CompositeView.extend({
        template: '#mozo-view',
        className: 'mozo-column',
        itemView: mesaApp.MesaView,
        itemViewContainer: '.mesas-list',
        events: {
            "click button.mozo": 'mozoSelect'
        },
        id: function() {
            return "colum-mozo-" + this.model.id;
        },
        initialize: function(e) {
            var mesas = this.model.get('mesas');
            if (mesas) {
                this.collection = mesas;
            }

            // sets width porporcionaly
            var width = 100 / mesaApp.mozos.length;
            this.el.style.width = width + "%";
        },
        mozoSelect: function() {
            this.trigger('mozo:select');
            var mozoModel = this.model,
                    mesaFormView = new mesaApp.MesaFormView({model: mozoModel});

            App.dialog.on('modal:shown', function() {
                $('input:first', mesaFormView.$el).focus();
            });

            App.dialog.show(mesaFormView);
        }
    });


    /**
     * Mozos View
     */
    mesaApp.MozosView = Backbone.Marionette.CollectionView.extend({
        itemView: mesaApp.MozoView
    });
    
    
    /**
     * MesaForm View
     */
    mesaApp.MesaLabelView = Backbone.Marionette.ItemView.extend({
        template: '#mesa-label'
    });


    /**
     * MesaForm View
     */
    mesaApp.MesaFormView = Backbone.Marionette.ItemView.extend({
        template: '#mesa-add',
        events: {
            "submit form": 'doSubmit'
        },
        doSubmit: function(e) {
            App.dialog.close();
            e.preventDefault();
            var mesaObj = App.formToObject($(e.target));
            this.model.get('mesas').create(mesaObj);
            return false;
        }
    });


    /**
     * MesaActions Menu View
     */
    mesaApp.MesaActionsView = Marionette.ItemView.extend({
        template: "#mesa-actions",
        events: {
            "click #btn-mesa-cerrar": "mandarAjaxYVolverAListadoDeMesas",
            "click #btn-mesa-reabrir": "mandarAjaxYVolverAListadoDeMesas",
            "click #btn-mesa-ticket": "mandarAjaxYVolverAListadoDeMesas",
            "click #btn-mesa-borrar": "eliminarMesa",
            "click #btn-mesa-numero": "cambiarNumero",
            "click #btn-mesa-menu": "cambiarMenu",
            "click #btn-mesa-cubiertos": "cambiarCubiertos"
    
        },
        modelEvents: {
            'change:cliente_id': 'renderCliente',
            'change:Cliente': 'renderCliente',
            'change:Descuento': 'renderDescuento',
            'change:menu': 'renderMenu'
        },
        eliminarMesa: function()
        {
            this.model.destroy();
            App.bigDialog.close();
            return false;
        },
        cambiarMenu: function() {
            var oldNum = this.model.get('menu');
            var num = window.prompt("Cantidad MENU", oldNum);
            if (num && oldNum != num) {
                this.model.save({
                    'menu': num
                });
            }
            return this;
        },
        cambiarCubiertos: function() {
            var oldNum = this.model.get('cant_comensales');
            var num = window.prompt("Cantidad de Cubiertos", oldNum);
            if (num && oldNum != num) {
                this.model.save({
                    'cant_comensales': num
                });
            }
            return this;
        },
        cambiarNumero: function() {
            var oldNum = this.model.get('numero');
            var num = window.prompt("Numero de mesa", oldNum);
            if (num && oldNum != num) {
                this.model.save({
                    'numero': num
                });
            }
            return this;
        },
        mandarAjaxYVolverAListadoDeMesas: function(e) {
            //    Request URL:http://localhost/works/ristorantino/mesas/cerrarMesa/77
            var href = e.currentTarget.getAttribute('href');
            href += "/" + this.model.id;
            if (href) {
                $.getJSON(href);
            }
            App.bigDialog.close();
            return false;
        },
                
        renderMenu: function() {
            var cc = parseInt(this.model.get('menu'));
            if (cc > 0) {
                this.$('#btn-mesa-menu span').text(cc);
            }
            return this;
        },
        renderDescuento: function() {
            var cc = this.model.get('Descuento');
            if (cc && cc.id) {
                $('.ui-btn-text', '#btn-mesa-descuento').text(cc.name);
            } else {
                $('.ui-btn-text', '#btn-mesa-descuento').text("Descuento");
            }
            return this;
        },
        renderCliente: function() {
            var cc = this.model.get('Cliente');
            if (cc && cc.id) {
                this.$('#btn-mesa-clientes').text(cc.nombre);
            } else {
                this.$('#btn-mesa-clientes').text("Cliente");
            }
            return this;
        }
    });

    /**
     * MesaExtra View
     */
    mesaApp.MesaComandasView = Marionette.ItemView.extend({
        template: "#mesa-comandas",
        onRender: function () {            
            var url = '#comanda/add/' + this.model.get('Mozo').id + "/" + this.model.cid;
            this.$('#btn-comanda-add').attr('href', url);            
        }
    });






    /**
     * Data Fetch
     */
    var mesasInterval;

    mesaApp.stopMesasInterval = function () {
        clearInterval(mesasInterval);
        return this;
    };

    mesaApp.startMesasInterval = function () {
        mesasInterval = setInterval(function() {
            mesaApp.mozos.fetch();
        }, App.MESAS_RELOAD_INTERVAL);
        return this;
    };



    /**
     * 
     * ----------------------------------------------------------------------
     *  STARTS Module objects
     */

    /**
     * Start Event
     */

    // Mozos Collection
    mesaApp.mozos = new mesaApp.Mozos;

//                App.mozos = undefined;
    mesaApp.mozos.on('sync', function() {
        mesaApp.trigger('mozos:sync');
    });




    /**
     * 
     * @param {id, cid or Mozo} mozo
     * @param {id, cid or Mesa} mesa
     * @returns Mesa
     */
    mesaApp.getMozoMesa = function(mozo, mesa) {
        var mozo = mesaApp.mozos.get(mozo);
        return  mozo.get('mesas').get(mesa);
    };

    mesaApp.onStart = function(options) {        
        mesaApp.startMesasInterval();
    };


    /**
     * Stop Event
     */
    mesaApp.onStop = function(options) {
        mesaApp.stopMesasInterval();
    };

});

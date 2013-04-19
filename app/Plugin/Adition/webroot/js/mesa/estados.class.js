/**
 * @var Static MESAS_POSIBLES_ESTADOS
 * 
 *  esta variable es simplemenete un catalogo de estados posibles que
 *  la mesa pude adoptar,
 *  
 *  utiliza el objeto adicion.event_handler: EventHandler 
 *
 **/

var MESA_ESTADOS_POSIBLES =  {
    abierta : {
        msg: 'Abierta',
        event: Risto.EventHandler.mesaAbierta ,
        id: 1,
        icon: 'mesa-abierta',
        url: urlDomain+'mesas/add'
    },
    reabierta : {
        msg: 'Re-Abierta',
        event: Risto.EventHandler.mesaAbierta ,
        id: 1,
        icon: 'mesa-abierta',
        url: urlDomain+'mesas/reabrir'
    },
    cerrada: {
        msg: 'Cerrada',
        event: Risto.EventHandler.mesaCerrada,
        id: 2,
        icon: 'mesa-cerrada',
        url: urlDomain+'mesas/cerrarMesa'
    },
    cuponPendiente: {
        msg: 'con Cupón Pendiente',
        event: Risto.EventHandler.mesaCuponPendiente,
        id: 0,
        icon: 'mesa-cobrada'
    },
    cobrada: {
        msg: 'Cobrada',
        event: Risto.EventHandler.mesaCobrada,
        id: 3,
        icon: 'mesa-cobrada'
    },
    borrada: {
        msg: 'Borrada',
        event: Risto.EventHandler.mesaBorrada,
        id: 0,
        icon: '',
        url: urlDomain+'mesas/delete'
    },
    seleccionada: {
        msg: 'Seleccionada',
        event: Risto.EventHandler.mesaSeleccionada,
        id: 0,
        icon: ''
    }
};

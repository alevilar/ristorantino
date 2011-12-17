/**
 * @var Static MESAS_POSIBLES_ESTADOS
 * 
 *  esta variable es simplemenete un catalogo de estados posibles que
 *  la mesa pude adoptar
 *
 **/

var MESA_ESTADOS_POSIBLES =  {
    abierta : {
        msg: 'Abierta',
        event: 'mesaAbierta',
        id: 1,
        icon: 'mesa-abierta',
        url: urlDomain+'mesas/add'
    },
    reabierta : {
        msg: 'Re-Abierta',
        event: 'mesaAbierta',
        id: 1,
        icon: 'mesa-abierta',
        url: urlDomain+'mesas/reabrir'
    },
    cerrada: {
        msg: 'Cerrada',
        event: 'mesaCerrada',
        id: 2,
        icon: 'mesa-cerrada',
        url: urlDomain+'mesas/cerrarMesa'
    },
    cuponPendiente: {
        msg: 'con Cupón Pendiente',
        event: 'mesaCuponPendiente',
        id: 0,
        icon: 'mesa-cobrada'
    },
    cobrada: {
        msg: 'Cobrada',
        event: 'mesaCobrada',
        id: 3,
        icon: 'mesa-cobrada'
    },
    borrada: {
        msg: 'Borrada',
        event: 'mesaBorrada',
        id: 0,
        icon: '',
        url: urlDomain+'mesas/delete'
    },
    seleccionada: {
        msg: 'Seleccionada',
        event: 'mesaSeleccionada',
        id: 0,
        icon: ''
    }
};

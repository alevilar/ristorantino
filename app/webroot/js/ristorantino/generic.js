
/**
 * Con esto evito que al usar la pantalla touchscreen puedan seleccionar texto haciendo
 * que la vista quede horrible y nadie entienda lo que paso
 */
Event.observe(window, 'load', function(){
    document.onselectstart = function() {return false;} // ie
    document.onmousedown = function() {return false;} // mozilla
});




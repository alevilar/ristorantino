
/**
 * Con esto evito que al usar la pantalla touchscreen puedan seleccionar texto haciendo
 * que la vista quede horrible y nadie entienda lo que paso
 */
//Event.observe(window, 'load', function(){
//    document.onselectstart = function() {return false;} // ie
//    document.onmousedown = function() {return false;} // mozilla
//});





window.onload = function() {
   if(document.all){
      document.onselectstart = function(e) { return false; } // ie
   } else {
      document.onmousedown = function(e)
      {
         if(e.target.type!='text' && e.target.type!='button' && e.target.type!='textarea') return false;
         else return true;
      } // mozilla
   }
}



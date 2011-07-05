/**
 *
 * @var Constant DATETIME_CERO
 */
var DATETIME_CERO = '0000-00-00 00:00:00';


// para que no titile el cursor. Que no se pueda hacer click
window.onload = function() {
   if(document.all){
      document.onselectstart = function(e) {return false;} // ie
   } else {
      document.onmousedown = function(e)
      {
         if(e.target.type!='text' && e.target.type!='button' && e.target.type!='textarea') return false;
         else return true;
      } // mozilla
   }
}


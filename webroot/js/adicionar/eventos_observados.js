
/**
 *  
 *  Crear la comandera y el menu 
 *  para el mozo actual y la mesa actual
 *  
 * @TODO hay que hacer que cuando el mozo no tiene mesa, que no me tirre error esto 
 */
Event.observe(window, 'load', function() {
	comanda = new Comanda(currentMozo, currentMesa);		
	
	var menuDiv = new Element('div',{'id':'productos-contenedor'});
	$('content').appendChild(menuDiv);
	menuDiv.hide();
	
	new Ajax.Updater(menuDiv, 'http://localhost/ristorantino/categorias/listar', { method: 'get', 'evalScripts' :true });

});






//NUMPAD ------------------------------------------------------
var txtNumber = null;
var numPad = null;

Event.observe(window, 'load', function() {
    numPad = new NumpadControl();   
            
    $('MesaNumero').onfocus = function (){
        numPad.Show(this);
    }        
});

//---------------------------------------  -------------------------
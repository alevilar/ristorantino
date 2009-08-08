

Event.observe(window, 'load', function() {
	comanda = new Comanda(currentMozo, currentMesa);	
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
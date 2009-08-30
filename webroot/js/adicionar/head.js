

    
   


/**
 * funcion scriptaculous que mueve hacia la izquierda 
 * @return
 */
function MoveMesaLeft()
{
	if (mesas_listado>0){
		new Effect.MoveBy('mesas-contenedor', 0, 630 , 
                              {
                                  duration: 0.4,  
                                  transition: Effect.Transitions.sinoidal
                              });
		mesas_listado--;
	}
}


/**
 * funcion scriptaculous que mueve hacia la derecha 
 * @return
 */
function MoveMesaRight()
{
	
	var cantScrolls = (adicion.currentMozo.mesas.length*50)/630;
	
	
	
	if(cantScrolls > (parseInt(cantScrolls)+1)){
		cantScrolls = parseInt(cantScrolls)+ 1;
	}
	else{
		cantScrolls = parseInt(cantScrolls);
	}
	
	if (mesas_listado<cantScrolls){
		new Effect.MoveBy('mesas-contenedor', 0, -630 , 
                              {
                                  duration: 0.4,  
                                  transition: Effect.Transitions.sinoidal
                              });
		mesas_listado++;
	}
}


//mesa-scroll
function MoveMesaUp()
{
	if (mesas_scrollbar>0){
	    new Effect.MoveBy('mesa-scroll', 350, 0 , 
	                              {
	                                  duration: 0.1,  
	                                  transition: Effect.Transitions.sinoidal
	                              });
	    mesas_scrollbar--;
	}
}

function MoveMesaDown()
{
	var alto = $('mesa-scroll').getHeight();
	var cantScrolls = alto/350;
	
	if(cantScrolls > (parseInt(cantScrolls)+1)){
		cantScrolls = parseInt(cantScrolls)+ 1;
	}
	else{
		cantScrolls = parseInt(cantScrolls);
	}
	
	if (mesas_scrollbar<=cantScrolls){
	    new Effect.MoveBy('mesa-scroll', -350, 0 , 
	                              {
	                                  duration: 0.1,  
	                                  transition: Effect.Transitions.sinoidal
	                              });
	    mesas_scrollbar++;
	}
}
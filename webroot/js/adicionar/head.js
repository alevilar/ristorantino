

    
   


/**
 * funcion scriptaculous que mueve hacia la izquierda 
 * @return
 */
function MoveMesaLeft()
{
	//es el tamaño del div que contiene el listado de mesas
	var width_de_las_mesas = 560;
	
	if (mesas_listado>0){
		new Effect.MoveBy('mesas-contenedor', 0, width_de_las_mesas , 
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
	// este numerocorresponde al numero de mesas que entran en la vista de bavegacion de mesas
	var mesasQueEntran = 8;
	//es el tamaño del div que contiene el listado de mesas
	var width_de_las_mesas = 560;
		
		
	//entran 8 mesas
	var cantMesas = adicion.currentMozo.mesas.length;
	// le sumo 1 que corresponde al TAB de Agregar mesa (+)
	cantMesas += 1;
	
	var cantScrolls = adicion.currentMozo.mesas.length/mesasQueEntran;	
	
	if(cantScrolls > (parseInt(cantScrolls)+1)){
		cantScrolls = parseInt(cantScrolls)+ 1;
	}
	else{
		cantScrolls = parseInt(cantScrolls);
	}
	
	if (mesas_listado<cantScrolls){
		new Effect.MoveBy('mesas-contenedor', 0, -(width_de_las_mesas) , 
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


// esta es la varizable que me dice de a cuantos px quiero mover
var mover_de_a_x = 100;

//mesa-scroll
function MoveMesaUp()
{
	
	if (mesas_scrollbar>0){
	    new Effect.MoveBy('listado-mesas',mover_de_a_x, 0 , 
	                              {
	                                  duration: 0.1,  
	                                  transition: Effect.Transitions.sinoidal
	                              });
	    mesas_scrollbar--;
	}
	return false;
}

function MoveMesaDown()
{
	var alto = $('listado-mesas').getHeight();
	if(alto == 0){
		alto = mover_de_a_x;
	}
	var cantScrolls = alto/mover_de_a_x;
	
	if(cantScrolls > (parseInt(cantScrolls)+1)){
		cantScrolls = parseInt(cantScrolls)+ 1;
	}
	else{
		cantScrolls = parseInt(cantScrolls);
	}
	
	if (mesas_scrollbar<cantScrolls){
	    new Effect.MoveBy('listado-mesas', -mover_de_a_x, 0 , 
	                              {
	                                  duration: 0.1,  
	                                  transition: Effect.Transitions.sinoidal
	                              });
	    mesas_scrollbar++;
	}
	return false;
}


function cambiarMesa(mesaCambiar){
	
	currentMesa = mesaCambiar;

	comanda.resetearComanda(currentMozo, currentMesa);
	actualizar_numero_mesa_div();
	
}
    
    
    
function cerrarMesa(){
	window.location.href = "/ristorantino/mesas/cerrarMesa/"+currentMesa.id+"/mozo_id:"+currentMozo.id;
}

    
    
function agregarProducto(){
	$("productos-contenedor").show(); 
	$("comanda").show();
	
}    
    
    
    
    
    
    
    /**
     * Esta funcion es para cuando yo abro una nueva mesa, me muestra el form input con un PAD numerico
     */
function abrirMesa(){ 
	$('mesa-abrir').toggle();Field.activate('MesaNumero');
}    
    
    
    
    

    /**
     * cuando hago click en una mesa, esta llama via ajax a la informacion
     * para que se actualicen algunas variables globales, es necesario que se ejectute esta funcion
     */
function actualizar_numero_mesa_div(){
	if (currentMesa){
		$("numero-mesa").update("Mesa: "+currentMesa.numero)
	}	
}



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
	
	var cantScrolls = (currentMozo.mesas.length*50)/630;
	
	
	
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
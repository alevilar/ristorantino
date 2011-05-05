
/**
 * 
 *  esta clase es bascicamente un producto con la salvedad que se le agrega un campo de cantidad.

 *  Es para la comanda.
 *  vendrioa a ser la equivalencia con la tabla mesas-productos -> comanda de cada mesa
 * 
 */
var ProductoComanda = {};

ProductoComanda = {
	
    detalle_comanda_id : null,
    cantidad : 0,
    cant_sacar : 0 ,
    modificado : false, // esto es un flag, para solo submitear los productos modificados
    entrada : false,
    sabores : [],
    saboresSeleccionados : [],

    elementolink : null,
    elementoCantidad : null,
	
	
	getCantidadEliminada: function(){
		return this.cant_sacar;
	},
	
	esProductoConSabor: function(){
		if(this.sabores.length == 0) return false
		else return true;
	},
	
	sumar: function(){
			this.cantidad++;
			this.ponerloModificado();
	},
	
	restar: function(){
		this.cantidad--;
		this.ponerloModificado();
	},
	
	
	/**
	 * Pone al producto como que fue modificado en true
	 */
	ponerloModificado: function(){
		this.modificado = true;
	},
	
	/**
	 * Suma el atributo cant_sacar. Que simboliza la cantidad de productos sacados de la comanda
	 * @param integer cant es la cantidad de este producto que quiero sacar. Por defecto es 1.
	 */
	sacar: function(cant){
		if((this.cantidad - this.cant_sacar) > 0){
			numer = (this.cant_sacar)*1 + cant*1;
			this.cant_sacar = numer;
			this.ponerloModificado(); // lo pongo como modificado
			this.elementoCantidad.update(this.cantidad - this.cant_sacar);
		}
	},
	
	
	copiar: function($super,prod){
		prod = $super(prod);
		return this.convertirEnProductoComanda(prod);
	},
	
	
	/**
	 * Me devuelve la cantidad total restando la que se quito de la que habia pedido
	 */
	cantidadEnComanda: function(){
		return (this.cantidad - this.cant_sacar);
	},
	
	
	/**
	 * Copia un producto para convertirlo en Producto Comanda
	 * @param Producto
	 */
	convertirEnProductoComanda: function(prod){
		if(prod.id ){
			 this.id = prod.id;  
		 }
		 
		 if(prod.name ){
			 this.name = prod.name;  
		 }
		 
		 if(prod.abrev ){
			 this.abrev = prod.abrev;  
		 }
		 
		 if(prod.description ){
			 this.description = prod.description;  
		 }
		 
		 if(prod.categoria_id ){
			 this.categoria_id = prod.categoria_id;  
		 }
		 
		 if(prod.precio ){
			 this.precio = prod.precio;  
		 }
		 
		 if(prod.created ){
			 this.created = prod.created;  
		 }

		 if(prod.modified ){
			 this.modified = prod.modified;  
		 }
 
		 if(prod.cantidad ){
			 this.cantidad = prod.cantidad;  
		 }
		 
		 if(prod.cant_eliminada ){
			 this.cant_sacar = prod.cant_eliminada;  
		 }
		 
		 if(prod.sabores ){
			 this.sabores = prod.sabores;  
		 }
		 
		 if(prod.comandera_id ){
			 this.comandera_id = prod.comandera_id;  
		 }
	},
	
	
	agregarSabor:function(sabor){
		this.saboresSeleccionados.push(sabor);
	},
	
	dameLink: function(){
		if(this.elementoLink == null)
		{
			this.elementoLink = new Element('a',{
				'href':'#Sacar',
				//'onclick':"adicion.comandaSacar.add('"+Object.toJSON(prod_aux)+"')",
				'class':'boton'});
			
			if(this.elementoCantidad == null)
			{
				this.elementoCantidad = new Element('div',{'style':'font-weight: bolder;'});
				this.elementoCantidad.update(this.cantidadEnComanda());
				this.elementoLink.appendChild(this.elementoCantidad);
			}
			this.elementoLink.appendChild(new Element('cite').update(this.name));
			this.elementoLink.observe('click',this.sacar.bind(this,1));
		}
		return this.elementoLink;
	}
	
};

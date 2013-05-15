R$.View.ComandaAdd = Backbone.View.extend({
   
    el: document.getElementById("comanda-add"),
    
    
    categoriasView: new R$.View.ComandaAddCategorias,
    productosView: new R$.View.ComandaAddProductos,
    productoView: new R$.View.ComandaAddDetalleProducto
  
});

R$.comandaAddView = new R$.View.ComandaAdd();
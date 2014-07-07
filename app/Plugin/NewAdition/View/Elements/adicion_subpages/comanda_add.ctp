<script id="comanda-add" type="text/x-template">        	
	    <div class="row-fluid">
                <div class="span7"> 
                    <div class="well productos" id="productos-container"></div>
                </div>
                
                <div class="span3">
                    <div class="mesa-label"></div>
                    <div class="detalle_comanda"></div>
                    <div id="sabores-container"></div>
                </div>
                
                <div class="span2">
                    <div class="comandas">
                    </div>
                </div>
	    </div>   
</script>


<script id="tmp-sabor-radio" type="text/x-template">
    <input type="radio" name="sabor" id="imp-sabor-<%= id %>" value="<%= name %>"><label for="imp-sabor-<%= id %>"><%= name %></label>
</script>

<script id="tmp-sabor-checkbox" type="text/x-template">
    <input type="checkbox" name="sabor<%= id %>" id="imp-sabor-<%= id %>" value="<%= name %>"><label for="imp-sabor-<%= id %>"><%= name %></label>
</script>


<script id="tmp-grupo-sabor" type="text/x-template">
        <legend><%= name %></legend>
        <div class="ops-sabores"></div>
</script>


<script id="detalle_comanda" type="text/x-template">   
    <hr />
    <h4><%= Producto.name %> <span class="precio">$<%= Producto.precio %></span></h4>
    
    <div>
        <button class="btn up" value="up"> <i class="icon-long-arrow-up"></i> </button>
        <span>Cantidad: </span><%= cant %>
        <button class="btn down" value="down" > <i class="icon-long-arrow-down"></i> </button>
        <span class="entradas">
            <label for="comanda-es-entrada">Es Entrada</label>
            <% if (es_entrada) { %>
            <input type="checkbox" id="comanda-es-entrada" name="es_entrada" checked/>
            <% } else { %>
            <input type="checkbox" id="comanda-es-entrada" name="es_entrada" />
            <% }%>
        </span>
    </div>
    <div>
        <textarea id="comanda-observacion" style="width: 90%" placeholder="Ingrese aqui una observación..."></textarea>
    </div>
    
    <hr />
    <div class="grupo_sabores">
    
    </div>
</script>


<script id="comanda" type="text/x-template">
    <header>
        <h3>Nueva Comanda</h3>
        <button class="ok btn btn-primary">Enviar</button>
        <div class="ops hidden">
            <label for="comanda-observacion">Observación</label>
            <textarea id="comanda-observacion" style="width: 90%"></textarea>
        </div>
    </header>    
    <ul class="unstyled">
    </ul>
    <footer>
        
    </footer>
</script>

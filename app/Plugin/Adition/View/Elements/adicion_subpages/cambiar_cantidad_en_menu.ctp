<div data-role="page" id="mesa-menu" data-theme="e">
    <div data-role="header">
        <h1>Seleccionar cantidad de Menú</h1>
    </div>

    <div data-role="content">    
        <p>
        La cantidad de menú actual es <span data-bind="text: adn().currentMesa().menu"></span>
        </p>
        <form name="cambiar-menu" action="#mesa-view" data-ajax="false"  data-transition="reverse">
            <fieldset data-role="controlgroup" data-type="horizontal">
                <label for="numeroacambiar">Ingresar nuevo número</label>
                <input type="number" name="menu" id="menuacambiar" />
            </fieldset>
            
            <fieldset class="ui-grid-a">
                <div class="ui-block-a"><a href="#" data-role="button" data-rel="back" data-theme="e">Cancelar</a></div>
                <div class="ui-block-b"><button type="submit" data-theme="b">Modificar</button></div>
	    </fieldset>
            
        </form>
    </div>
            
</div>  
